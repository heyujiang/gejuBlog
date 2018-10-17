@extends('admin.layout.main')

@section('style')
@endsection

@section('body')

<body class="childrenBody">
    <blockquote class="layui-elem-quote">
        <div class="layui-inline">
            <a class="layui-btn layui-btn-normal tableAdd_btn">添加标签</a>
        </div>
    </blockquote>
     <table class="layui-table">
     <colgroup>
         <col width="5%">
         <col width="20%">
         <col width="20%">
         <col width="20%">
         <col>
     </colgroup>
     <thead>
     <tr>
         <th>ID</th>
         <th>标签</th>
         <th>排序</th>
         <th>发布时间</th>
         <th>操作</th>
     </thead>
     <tbody></tbody>
    </table>
    <div id="page"></div>

    <script>
        var pageConfig = {
            per_page: 15,
            pages: 1,
            where: {},
        };
        layui.use(['form','laydate','jquery','laypage'], function () {
            var form = layui.form,
                $ = layui.jquery,
                old_sort;
            form.render();
            tableReload();

            function tableReload() {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:"{{url('admin/tag/tag-list')}}",
                    type:"post",
                    data:'',
                    dataType: "json",
                    success:function (response) {
                        if(response.code == '{{\App\Component\Classes\Code::SUCCESS}}'){
                            var data = response.data.hasOwnProperty('tags') ? response.data.tags : [];
                            var dataHtml = '';
                            if (data.length != 0) {
                                for (var i = 0; i < data.length; i++) {
                                    dataHtml += "<tr data-id=\""+ data[i].tag_id +"\">";
                                    dataHtml += "<td>" + data[i].tag_id + "</td>";
                                    dataHtml += "<td>"+ data[i].name +"</td>";
                                    dataHtml += " <td><input type='number' class='layui-input sort-input table-sort' value='"+ data[i].sort +"'></td>";
                                    dataHtml += "<td>" + data[i].created_at+ "</td>";
                                    dataHtml += "<td class=\"td-manage\">";
                                    dataHtml += '<div class="layui-btn-group">';
                                    dataHtml += " <a title='删除' class='layui-btn layui-btn-danger layui-btn-xs table-delete' href='javascript:;'>删除</a>"
                                    dataHtml += " <a title='编辑' class='layui-btn layui-btn-normal layui-btn-xs table-edit' href='javascript:;'>编辑</a>"
                                    dataHtml += '</div>';
                                    dataHtml += "</td>";
                                    dataHtml += "</tr>";
                                }
                            }else{
                                dataHtml += "<tr><td colspan='5'>暂无数据</td></tr>"
                            }
                            $('tbody').html(dataHtml);
                        }else{
                            layer.alert(response.message,{icon:2})
                        }
                    },
                    error:function (response) {
                        layer.alert('请求错误',{icon:2})
                    }
                });
            };

            /**
             * 添加标签
             */
            $(".tableAdd_btn").click(function () {
                var index = layui.layer.open({
                    title: "添加公告",
                    type: 2,
                    content: "tag/create",
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
                    title: "添加公告",
                    type: 2,
                    content: "tag/"+ id +"/edit",
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
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url:"{{url('admin/tag')}}" + "/"+id,
                        type:"DELETE",
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
                        url:"{{ url('admin/tag/up-sort') }}" + "/" + id,
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

