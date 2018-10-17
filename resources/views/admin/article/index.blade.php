@extends('admin.layout.main')
@section('style')
@endsection


@section('body')
<body class="childrenBody">
    <ul class="layui-nav" lay-filter="">
        <li class="layui-nav-item layui-this"><a href="javascript:;">文章</a></li>
        <li class="layui-nav-item"><a href="{{ url('admin/article/draft') }}">草稿</a></li>
        <li class="layui-nav-item"><a href="{{ url('admin/article/trash') }}">废纸篓</a></li>
    </ul>
    <blockquote class="layui-elem-quote">
        <div class="layui-inline">
            <div class="layui-input-inline layui-form">
                <input class="layui-input" name="title" id="select_title" placeholder="请输入标题关键词">
            </div>
            <a class="layui-btn search_btn">查询</a>
        </div>
        <div class="layui-inline">
            <a class="layui-btn layui-btn-normal tableAdd_btn">写博客</a>
        </div>
    </blockquote>
    <div class="table_list">
        <form action="" class="layui-form">
            <table class="layui-table">
                <colgroup>
                    <col width="5%">
                    <col width="25%">
                    <col width="10%">
                    <col width="5%">
                    <col width="5%">
                    <col width="5%">
                    <col width="5%">
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
                    <th>排序</th>
                    <th>置顶</th>
                    <th>推荐</th>
                    <th>轮播</th>
                    <th>修改时间</th>
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
                    url: "{{ url('admin/article/article-list') }}" + "?page=" + pageConfig.pages + parameter,
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
                                dataHtml += '<td>' +
                                    '<a href="javasrcipt:;" class="layui-btn layui-btn-xs" style="border-radius: 50%;background-color: '+ article[i].type_color +'">'+ article[i].type_tag +'</a>' +
                                    '<a href="javasrcipt:;" class="article_show">' + article[i].title + '</a> ' +
                                    // '<p style="text-align: right">' +
                                    // '<a href="javascript:;" class="layui-btn layui-btn-radius layui-btn-xs layui-btn-danger"><i class="layui-icon layui-icon-note"></i>PHP</a>' +
                                    // '<a href="javascript:;" class="layui-btn layui-btn-radius layui-btn-xs layui-btn-danger"><i class="layui-icon layui-icon-note"></i>PHP</a>' +
                                    // '<a href="javascript:;" class="layui-btn layui-btn-radius layui-btn-xs layui-btn-danger"><i class="layui-icon layui-icon-note"></i>PHP</a>' +
                                    // '</p> ' +
                                    '</td>';
                                dataHtml += '<td><img src="'+ article[i].cover_img +'" alt=""></td>';
                                dataHtml += '<td>' + article[i].readed_num + '</td>';
                                dataHtml += '<td>' + '<input class="layui-input sort-input" type="number" value="'+ article[i].sort +'">' + '</td>';
                                if(article[i].is_top == {{ \App\models\Article::TOP_YES }}){
                                    dataHtml += '<td><input type="checkbox" lay-filter="table_is_top" name="is_show" checked lay-skin="switch" lay-text="{{ \App\Models\Article::TOP_STATUS[\App\Models\Article::TOP_YES] }}|{{ \App\Models\Article::TOP_STATUS[\App\Models\Article::TOP_NO] }}"></td>';
                                }else{
                                    dataHtml += '<td><input type="checkbox" lay-filter="table_is_top"  name="is_show" lay-skin="switch" lay-text="{{ \App\Models\Article::TOP_STATUS[\App\Models\Article::TOP_YES] }}|{{ \App\Models\Article::TOP_STATUS[\App\Models\Article::TOP_NO] }}"></td>';
                                }
                                if(article[i].is_recommend == {{ \App\models\Article::RECOMMEND_YES }}){
                                    dataHtml += '<td><input type="checkbox" lay-filter="table_is_recommend" name="is_show" checked lay-skin="switch" lay-text="{{ \App\Models\Article::RECOMMEND_STATUS[\App\Models\Article::RECOMMEND_YES] }}|{{ \App\Models\Article::RECOMMEND_STATUS[\App\Models\Article::RECOMMEND_NO] }}"></td>';
                                }else{
                                    dataHtml += '<td><input type="checkbox" lay-filter="table_is_recommend"  name="is_show" lay-skin="switch" lay-text="{{ \App\Models\Article::RECOMMEND_STATUS[\App\Models\Article::RECOMMEND_YES] }}|{{ \App\Models\Article::RECOMMEND_STATUS[\App\Models\Article::RECOMMEND_NO] }}"></td>';
                                }
                                if(article[i].is_bannel == {{ \App\models\Article::BANNEL_YES }}){
                                    dataHtml += '<td><input type="checkbox" lay-filter="table_is_bannel" name="is_show" checked lay-skin="switch" lay-text="{{ \App\Models\Article::BANNEL_STATUS[\App\Models\Article::BANNEL_YES] }}|{{ \App\Models\Article::BANNEL_STATUS[\App\Models\Article::BANNEL_NO] }}"></td>';
                                }else{
                                    dataHtml += '<td><input type="checkbox" lay-filter="table_is_bannel"  name="is_show" lay-skin="switch" lay-text="{{ \App\Models\Article::BANNEL_STATUS[\App\Models\Article::BANNEL_YES] }}|{{ \App\Models\Article::BANNEL_STATUS[\App\Models\Article::BANNEL_NO] }}"></td>';
                                }
                                dataHtml += '<td>' + article[i].updated_at + '</td>';
                                dataHtml += '<td>' + article[i].created_at + '</td>';
                                dataHtml += '<td>';
                                dataHtml += '<div class="layui-btn-group">';
                                dataHtml += '<a class="layui-btn layui-btn-xs table_edit"><i class="iconfont icon-edit"></i> 编辑</a>';
                                dataHtml += '<a class="layui-btn layui-btn-xs layui-btn-danger table_delete"><i class="iconfont icon-edit"></i> 删除</a>';
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
             * 搜索
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

            //添加文章
            $(".tableAdd_btn").click(function () {
                var index = layui.layer.open({
                    title: "添加文章",
                    type: 2,
                    content: "article/create",
                    area:['100%','100%'],
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


            //编辑文章
            $("body").on("click", ".table_edit", function () {  //编辑
                let id = $(this).parents('tr').data('id');
                var index = layui.layer.open({
                    title: "编辑文章",
                    type: 2,
                    content: "article/" + id + '/edit',
                    area:['100%','100%'],
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


            //当前获得焦点的文章的原始排序
            $("body").on("focus", ".sort-input",function () {
                old_sort = $(this).val();
            });

            //修改文章的排序
            $("body").on("blur", ".sort-input",function () {
                let sort = $(this).val();
                let id = $(this).parents('tr').data('id');
                if(parseInt(old_sort) != parseInt(sort)){
                    let load = layer.load();
                    $.ajax({
                        url:"{{ url('admin/article/up-top') }}" + "/" + id,
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

            /**
             * 删除文章
             */
            $('body').on('click','.table_delete',function () {
                let id = $(this).parents('tr').data('id');
                layer.confirm('确认要删除吗？', function (index) {
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
             * 置顶 是 | 否
             */
            form.on('switch(table_is_top)',function () {
                let id = $(this).parents('tr').data('id');
                let load = layer.load();
                $.ajax({
                    url:"{{ url('admin/article/up-top') }}" + "/" + id,
                    type:"get",
                    dataAttr:"json",
                    success:function (response) {
                        if(response.code == "{{ \App\Component\Classes\Code::SUCCESS }}"){
                            layer.msg(response.message, {icon: 1, time: 1000});
                        }else{
                            layer.msg(response.message, {icon: 2, time: 1000});
                        }
                        layer.close(load);
                    },
                    error:function (response) {
                        layer.msg(response.message, {icon: 2, time: 1000});
                        layer.close(load);
                    }

                })
            })


            /**
             * 轮播 是 | 否
             */
            form.on('switch(table_is_bannel)',function () {
                let id = $(this).parents('tr').data('id');
                let load = layer.load();
                $.ajax({
                    url:"{{ url('admin/article/up-bannel') }}" + "/" + id,
                    type:"get",
                    dataAttr:"json",
                    success:function (response) {
                        if(response.code == "{{ \App\Component\Classes\Code::SUCCESS }}"){
                            layer.msg(response.message, {icon: 1, time: 1000});
                        }else{
                            layer.msg(response.message, {icon: 2, time: 1000});
                        }
                        layer.close(load);
                    },
                    error:function (response) {
                        layer.msg(response.message, {icon: 2, time: 1000});
                        layer.close(load);
                    }

                })
            })


            /**
             * 推荐 是 | 否
             */
            form.on('switch(table_is_recommend)',function () {
                let id = $(this).parents('tr').data('id');
                let load = layer.load();
                $.ajax({
                    url:"{{ url('admin/article/up-recommend') }}" + "/" + id,
                    type:"get",
                    dataAttr:"json",
                    success:function (response) {
                        if(response.code == "{{ \App\Component\Classes\Code::SUCCESS }}"){
                            layer.msg(response.message, {icon: 1, time: 1000});
                        }else{
                            layer.msg(response.message, {icon: 2, time: 1000});
                        }
                        layer.close(load);
                    },
                    error:function (response) {
                        layer.msg(response.message, {icon: 2, time: 1000});
                        layer.close(load);
                    }

                })
            })

        });

    </script>
</body>
@endsection

