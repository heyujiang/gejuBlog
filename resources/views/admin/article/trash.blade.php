@extends('admin.layout.main')
@section('style')
@endsection


@section('body')
<body class="childrenBody">
    <ul class="layui-nav" lay-filter="">
        <li class="layui-nav-item "><a href="{{ url('admin/article') }}">文章</a></li>
        <li class="layui-nav-item"><a href="{{ url('admin/article/draft') }}">草稿</a></li>
        <li class="layui-nav-item layui-this"><a href="javascript:;">废纸篓</a></li>
    </ul>
    <blockquote class="layui-elem-quote">
        <div class="layui-inline">
            <div class="layui-input-inline layui-form">
                <input class="layui-input" name="title" id="select_title" placeholder="请输入标题关键词">
            </div>
            <a class="layui-btn search_btn">查询</a>
        </div>
    </blockquote>
    <div class="table_list">
        <form action="" class="layui-form">
            <table class="layui-table">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="10%">
                    <col width="5%">
                    <col width="12%">
                    <col width="12%">
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>标题</th>
                    <th>图片</th>
                    <th>查看量</th>
                    <th>删除时间</th>
                    <th>创建时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody class="list_content"></tbody>
            </table>
        </form>
    </div>
    <div id="page"></div>

    <script type="text/javascript">
        layui.use(['form', 'layer', 'jquery', 'laypage'], function () {
            var form = layui.form,
                layer = parent.layer === undefined ? layui.layer : parent.layer,
                laypage = layui.laypage,
                $ = layui.jquery;
            var old_sort ;
            //加载页面数据
            var pageConfig = {
                per_page: 10,
                pages: 1,
                where: {},
            };
            tableReload();
            form.render();

            function tableReload() {
                var parameter = '';
                if (pageConfig.where.hasOwnProperty('title')) {
                    parameter += '&title=' + pageConfig.where.title
                }
                if (pageConfig.where.hasOwnProperty('type')) {
                    parameter += '&type=' + pageConfig.where.type
                }
                $.ajax({
                    url: "{{ url('admin/article/trash-list') }}" + "?page=" + pageConfig.pages + parameter,
                    type: "get",
                    dataType: "json",
                    success: function (res) {
                        var data = res.hasOwnProperty('data') ? res.data : [];
                        pageConfig.total =data.hasOwnProperty('total') ? data.total : 0;
                        pageConfig.per_page = data.hasOwnProperty('per_page') ? data.per_page : 10;
                        var article = data.hasOwnProperty('articles') ? data.articles : 10;
                        var dataHtml = '';
                        if (data.length != 0) {
                            for (var i = 0; i < article.length; i++) {
                                dataHtml += '<tr data-id="'+ article[i].article_id +'">';
                                dataHtml += '<td class="notice_id">' + article[i].article_id + '</td>';
                                dataHtml += '<td><a href="javasrcipt:;" class="notice_show"><a href="javasrcipt:;" class="layui-btn layui-btn-xs" style="border-radius: 50%;background-color: '+ article[i].type_color +'">'+ article[i].type_tag +'</a>' + article[i].title + '</a></td>';
                                dataHtml += '<td><img src="'+ article[i].cover_img +'" alt=""></td>';
                                dataHtml += '<td>' + article[i].readed_num + '</td>';
                                dataHtml += '<td>' + article[i].updated_at + '</td>';
                                dataHtml += '<td>' + article[i].created_at + '</td>';
                                dataHtml += '<td>';
                                dataHtml += '<div class="layui-btn-group">';
                                dataHtml += '<a class="layui-btn layui-btn-xs layui-btn-normal table_restore"><i class="iconfont icon-edit"></i> 恢复正常</a>';
                                dataHtml += '<a class="layui-btn layui-btn-xs layui-btn-danger table_discard"><i class="iconfont icon-edit"></i> 彻底删除</a>';
                                dataHtml += '</div>';
                                dataHtml += '</td></tr>';
                            }
                        } else {
                            dataHtml = '<tr><td colspan="8">暂无数据</td></tr>';
                        }
                        $(".list_content").html(dataHtml);
                        laypage.render({
                            elem: 'page',
                            curr: pageConfig.pages || 1, //当前页
                            limit: pageConfig.per_page,//每页条数
                            count: pageConfig.total || 20,//总数
                            theme: '#1E9FFF',
                            layout: ['prev', 'page','next','count'],
                            jump: function (obj, first) {
                                //首次不执行不然死循环
                                if (!first) {
                                    pageConfig.pages = obj.curr;
                                    tableReload();
                                }
                            }
                        });
                        form.render();
                    }
                });
            }

            /**
             * 查询
             */
            $('body').on('click','.search_btn',function () {
                var title = $('#select_title').val();
                if (title) {
                    pageConfig.where.title = title;
                } else {
                    delete pageConfig.where.title;
                }
                pageConfig.pages = 1;
                var index = layer.msg('查询中，请稍候', {icon: 16, time: false, shade: 0.8});
                setTimeout(function () {
                    tableReload();
                    layer.close(index);
                }, 2000);
            });


            /**
             * 删除文章
             */
            $('body').on('click','.table_discard',function () {
                let id = $(this).parents('tr').data('id');
                layer.confirm('确认要彻底删除吗？', function (index) {
                    let load = layer.load();
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        url:"{{url('admin/article')}}" + "/"+id,
                        type:"DELETE",
                        dataType:"json",
                        success:function (response) {
                            if(response.code == '{{ \App\Component\Classes\Code::SUCCESS }}'){
                                layer.msg(response.message, {icon: 1, time: 500},function(){
                                    window.location.reload();
                                });
                            }else{
                                layer.msg(response.message, {icon: 2, time: 500});
                            }
                            layer.close(load);
                        },
                        error:function (response) {
                            layer.msg(response.message, {icon: 2, time: 500});
                            layer.close(load);
                        }
                    })
                });
            })

            /**
             * 恢复文章
             */
            $('body').on('click','.table_restore',function () {
                let id = $(this).parents('tr').data('id');
                layer.confirm('确认要恢复吗？', function (index) {
                    let load = layer.load();
                    $.ajax({
                        url:"{{url('admin/article/restore')}}" + "/"+id,
                        type:"get",
                        dataType:"json",
                        success:function (response) {
                            if(response.code == '{{ \App\Component\Classes\Code::SUCCESS }}'){
                                layer.msg(response.message, {icon: 1, time: 500},function(){
                                    window.location.reload();
                                });
                            }else{
                                layer.msg(response.message, {icon: 2, time: 500});
                            }
                            layer.close(load);
                        },
                        error:function (response) {
                            layer.msg(response.message, {icon: 2, time: 500});
                            layer.close(load);
                        }
                    })
                });
            })

        });

    </script>
</body>
@endsection

