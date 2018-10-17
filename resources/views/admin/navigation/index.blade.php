@extends('admin.layout.main')

@section('style')
@endsection

@section('body')

    <body class="childrenBody">
    <blockquote class="layui-elem-quote">
        <div class="layui-inline">
            <a class="layui-btn layui-btn-normal tableAdd_btn">添加导航</a>
        </div>
    </blockquote>
    <table class="layui-table">
        <colgroup>
            <col width="5%">
            <col width="20%">
            <col width="20%">
            <col width="5%">
            <col width="10%">
            <col width="10%">
            <col>
        </colgroup>
        <thead>
        <tr>
            <th>ID</th>
            <th>导航名称</th>
            <th>连接</th>
            <th>排序</th>
            <th>发布时间</th>
            <th>修改时间</th>
            <th>操作</th>
        </thead>
        <tbody>
            @foreach($navigations as $navigation)
                <tr nav-id="{{ $navigation['navigation_id'] }}" data-id="{{ $navigation['navigation_id'] }}" pid={{ $navigation['navigation_pid'] }} @if($navigation['navigation_pid'])class="layui-hide"@endif>
                    <td>{{ $navigation['navigation_id'] }}</td>
                    <td>
                        @if($navigation['navigation_pid'] == 0)
                            <i class="layui-icon x-show" status='true'>&#xe623;</i>{{ $navigation['name'] }}
                            @else
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;├{{ $navigation['name'] }}
                        @endif
                    </td>
                    <td><a href="{{ $navigation['link'] }}" target="_blank">{{ $navigation['link'] }}</a></td>
                    <td><input type="number" class="layui-input sort-input table-sort" value="{{ $navigation['sort'] }}"></td>
                    <td>{{ $navigation['created_at'] }}</td>
                    <td>{{ $navigation['updated_at'] }}</td>
                    <td class="td-manage">
                        <div class="layui-btn-group">
                            <a title='删除' class='layui-btn layui-btn-danger layui-btn-xs table-delete' href='javascript:;'>删除</a>
                            <a title='编辑' class='layui-btn layui-btn-normal layui-btn-xs table-edit' href='javascript:;'>编辑</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>

        layui.use(['form','laydate','jquery','laypage'], function () {
            var laypage = layui.laypage,
                form = layui.form,
                $ = layui.jquery,
                old_sort;

            form.render();

            $('.x-show').click(function () {
                let cateId = $(this).parents('tr').attr('nav-id');
                if($(this).attr('status')=='true'){
                    $(this).html('&#xe625;');
                    $(this).attr('status','false');
                    let cateId = $(this).parents('tr').attr('nav-id');
                    $("tbody tr[pid="+cateId+"]").removeClass('layui-hide');
                }else{
                    $(this).html('&#xe623;');
                    $(this).attr('status','true');
                    getCateIds(cateId);
                }
            })

            function getCateIds(cateId) {
                $("tbody tr[pid="+cateId+"]").each(function () {
                    if(!$(this).hasClass('layui-hide')){
                        $(this).addClass('layui-hide');
                        if($(this).find('.x-show')){
                            $(this).find('.x-show').html('&#xe623;');
                            $(this).find('.x-show').attr('status','true');
                        }
                        getCateIds($(this).attr('nav-id'));
                    }
                })
            }


            /**
             * 添加标签
             */
            $(".tableAdd_btn").click(function () {
                var index = layui.layer.open({
                    title: "添加导航",
                    type: 2,
                    content: "navigation/create",
                    success: function (layero, index) {
                        setTimeout(function () {
                            layui.layer.tips('点击此处返回列表', '.layui-layer-setwin .layui-layer-close', {
                                tips: 3
                            });
                        }, 500);
                    }
                });
                layui.layer.full(index);
            });


            /**
             * 修改
             */
            $('body').on('click','.table-edit',function () {
                let id = $(this).parents('tr').data('id');
                var index = layui.layer.open({
                    title: "修改导航",
                    type: 2,
                    content: "navigation/edit/"+id,
                    success: function (layero, index) {
                        setTimeout(function () {
                            layui.layer.tips('点击此处返回列表', '.layui-layer-setwin .layui-layer-close', {
                                tips: 3
                            });
                        }, 500);
                    }
                });
                layui.layer.full(index);
            });
            /**
             * 删除
             */
            $('body').on('click','.table-delete',function () {
                let id = $(this).parents('tr').data('id');
                layer.confirm('确认要删除吗？', function (index) {
                    let load = layer.load();
                    $.ajax({
                        url:"{{url('admin/navigation/del')}}" + "/"+id,
                        type:"get",
                        dataType:"json",
                        success:function (response) {
                            if(response.code == '{{ \App\Component\Classes\Code::SUCCESS }}'){
                                layer.msg(response.message, {icon: 1, time: 1000},function () {
                                    window.location.reload();
                                });
                            }else{
                                layer.msg(response.message, {icon: 2, time: 1000});
                            }
                            layer.close(load);
                        },
                        error:function (response) {
                            layer.msg(response.message, {icon: 1, time: 1000});
                            layer.close(load);
                        }
                    })
                });
            });
            /**
             * 排序获得焦点
             */
            $('body').on('focus','.table-sort',function () {
                old_sort = $(this).val();
            });
            /**
             * 排序失去焦点
             */
            $('body').on('blur','.table-sort',function () {
                let sort = $(this).val();
                let id = $(this).parents('tr').data('id');
                if(parseInt(old_sort) != parseInt(sort)){
                    let load = layer.load();
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url:"{{ url('admin/navigation/up-sort') }}" + "/" + id,
                        type:"get",
                        data:{sort:sort},
                        dataType:'json',
                        success:function (response) {
                            if(response.code == '{{\App\Component\Classes\Code::SUCCESS}}'){
                                layer.msg(response.message ,{icon: 1,time:500},function () {
                                    window.location.reload()
                                });
                            }else{
                                layer.msg(response.message ,{icon: 2,time:500},function () {
                                    $(this).val(old_sort);
                                });
                            }
                            layer.close(load);
                        },
                        error:function (response) {
                            layer.close(load);
                            layer.msg(response.message, {icon: 2,time:500},function () {
                                $(this).val(old_sort);
                            });
                        }
                    })
                }
            });

        });
    </script>
    </body>

@endsection

