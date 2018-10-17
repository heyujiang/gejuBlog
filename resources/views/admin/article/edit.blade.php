@extends('admin.layout.main')
@section('style')
    <script type="text/javascript" src="{{ asset('static/admin/plugins/wangEditor/release/wangEditor.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('static/admin/static/css/cover_h.css') }}">   {{--覆盖layui框架对H1-H5的重写，避免富文本无法使用H1-H5--}}
    <script type="text/javascript" src="{{ asset('static/admin/plugins/wangEditor-fullscreen/wangEditor-fullscreen.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/admin/plugins/jquery/jquery-3.2.1.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('static/admin/plugins/wangEditor-fullscreen/wangEditor-fullscreen.css') }}"/>
    <style>
        .target{border-radius: 3px;padding-top: 10px;z-index:898;position: relative}
        .target a{display: block;float: left;height: 24px;width: 10.5%;line-height: 22px;overflow: hidden;border: 1px solid #5FB878;border-radius: 4px;font-size: 13px;background: #f5fff8;color: #42b579;text-align: center;margin: 0 5px 10px 5px}
        .target a:hover i{width:16px;height:22px;}
        .target a:hover{line-height:22px;opacity: 0.8;}
        .target a i{ transition: all 200ms ease-in; position: relative; top: 1px; width: 0; overflow: hidden; height: 0; display: block; float: right; margin-right: 2px; }
        .add_shopList{float: left;height: 24px;width: 10.5%;margin: 0 5px 10px 5px; }
        .add-btn{cursor: pointer;display: block;line-height: 24px;border-radius: 4px;font-size: 13px;color: #a2a2a2;text-align: center;border: 1px #a2a2a2 dashed}
        .add-btn i{ margin-right: 3px; }
        .chose-tag{display:none;background-color: #ffffff;overflow: auto;border: 1px #D2D2D2 solid;border-top: 0;max-height: 300px;z-index: inherit}
        .target dl{text-align: center;z-index: inherit}
        .target dl dd{height: 30px;line-height: 30px;z-index: inherit}
        .target dl dd:hover{background-color: #5FB878;}
        .add_shopList:hover > .chose-tag{display:block;}
        /*.target *{-webkit-user-select:none;  -moz-user-select:none;  -ms-user-select:none;  user-select:none;}*/
    </style>
@endsection

@section('body')
    <body class="childrenBody">
    <form class="layui-form" method="POST">
        {{ csrf_field() }}
        <table class="layui-table">
            <colgroup>
                <col width="5%">
                <col width="50%">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>标题</td>
                <td>
                    <input type="text" name="title" class="layui-input" value="{{ $article->title }}" lay-verify="required" placeholder="请输入标题">
                </td>
            </tr>
            <tr>
                <td>副标题</td>
                <td>
                    <input type="text" name="subtitle" class="layui-input" value="{{ $article->subtitle }}" placeholder="请输副标题">
                </td>
            </tr>
            <tr>
                <td>正文</td>
                <td>
                    <div id="content-div">{!! $article->content !!}</div>
                    <textarea name="content" class="layui-textarea layui-hide" id="content-text" cols="30" rows="10"></textarea>
                </td>
            </tr>
            <tr>
                <td>封面</td>
                <td>
                    <div class="layui-upload">
                        <button type="button" class="layui-btn layui-btn-normal" id="choose">上传图片</button>
                        {{--<button type="button" class="layui-btn" id="ok-upload">确认上传</button>--}}
                        <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;min-height: 50px">
                            <div class="layui-upload-list" id="show_img"><img src="{{ asset($article->cover_img) }}" alt=""></div>
                        </blockquote>
                    </div>
                    <input type="hidden" id="cover_img" name="cover_img" value="{{ $article->cover_img }}">
                    <input type="hidden" id="now_cover_img" value="{{ $article->cover_img }}">
                </td>
            </tr>
            <tr>
                <td>分类</td>
                <td>
                    <select name="category_id" class="layui-select"  lay-verify="required">
                        <option value="">请选择分类</option>
                        @foreach($cateList as $cate_list)
                            @if($cate_list['p_id'] == 0)
                                <option value="{{ $cate_list['category_id'] }}" @if($article->category_id == $cate_list['category_id']) selected @endif>{{ $cate_list['name'] }}</option>
                            @else
                                <option value="{{ $cate_list['category_id'] }}" @if($article->category_id == $cate_list['category_id']) selected @endif> ├ {{ $cate_list['name'] }}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>标签</td>
                <td>
                    <div class="target">
                        <div class="tag-area">
                            @foreach($article_tags as $article_tag)
                                <a href="javaScript:void(0);"><input type="hidden" name="tag_ids[]" value="{{ $article_tag->tag_id }}"><span>{{ $article_tag->name }}</span><i class="layui-icon">ဆ</i></a>
                            @endforeach
                            {{--<a href="javaScript:void(0);"><input type="hidden" name="tag_ids[]" value="14"><span>JAVA</span><i class="layui-icon">ဆ</i></a>--}}
                        </div>
                        <ul class="add_shopList">
                            <li class="add-btn"><i class="layui-icon"></i>添加</li>
                            <li class="chose-tag">
                                <dl>
                                    @foreach($tags as $tag)
                                        <dd data-tag-id="{{ $tag->tag_id }}" id="tag-id-{{ $tag->tag_id }}" @if(in_array($tag->tag_id,$article_tag_ids)) style="display: none" @endif>{{ $tag->name }}</dd>
                                    @endforeach
                                    {{--<dd data-tag-id="1" id="tag-id-1">PHP</dd>--}}
                                </dl>
                            </li>
                        </ul>
                        <div style="clear: both"></div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>排序</td>
                <td>
                    <input type="number" name="sort" value="{{ $article->sort }}" class="layui-input sort-input" lay-verify="required" >
                </td>
            </tr>
            <tr>
                <td>是否置顶</td>
                <td>
                    <input type="checkbox" name="is_top" @if($article->is_top == \App\Models\Article::TOP_YES) checked @endif lay-skin="switch" lay-text="是|否">
                </td>
            </tr>
            <tr>
                <td>是否轮播</td>
                <td>
                    <input type="checkbox" name="is_bannel" @if($article->is_bannel == \App\Models\Article::BANNEL_YES) checked @endif lay-skin="switch" lay-text="是|否">
                </td>
            </tr>
            <tr>
                <td>是否推荐</td>
                <td>
                    <input type="checkbox" name="is_recommend" @if($article->is_recommend == \App\Models\Article::RECOMMEND_YES) checked @endif lay-skin="switch" lay-text="是|否">
                </td>
            </tr>
            <tr>
                <td>博文类型</td>
                <td>
                    @foreach($type as $key=>$val)
                        <input type="radio" name="type" value="{{ $key }}" title="{{ $val }}" @if($key == $article->type) checked @endif>
                    @endforeach
                </td>
            </tr>
            </tbody>
        </table>
        <div class="layui-form-item" style="text-align: center;">
            <div class="layui-input-block">
                <button class="layui-btn layui-btn-danger" lay-submit="" lay-filter="submit_from_draft" type="button">保存草稿</button>
                <button class="layui-btn" lay-submit="" lay-filter="submit_from" type="button">立即发布</button>
            </div>
        </div>
    </form>
    <script>
        layui.use(['form', 'layer', 'jquery','upload'], function () {
            var form = layui.form,
                upload = layui.upload,
                layer = parent.layer === undefined ? layui.layer : parent.layer,
                $ = layui.jquery;
            form.render();

            /**
             * 立即发布
             */
            form.on("submit(submit_from)", function (data) {
                if (data.field.content == "<p><br></p>") {
                    layer.msg("请填写博客正文", {icon: 5, time: 1500});
                    return false;
                }
                if (data.field.cover_img == "") {
                    layer.msg("请上传图片", {icon: 5, time: 1500});
                    return false;
                }
                data.field.is_release = {{ \App\Models\Article::RELEASE_YES }};

                storeArticle(data);
            });

            /**
             * 保存草稿
             */
            form.on("submit(submit_from_draft)", function (data) {
                if (data.field.content == "<p><br></p>") {
                    layer.msg("请填写博客正文", {icon: 5, time: 1500});
                    return false;
                }
                if (data.field.cover_img == "") {
                    layer.msg("请上传图片", {icon: 5, time: 1500});
                    return false;
                }
                data.field.is_release = {{ \App\Models\Article::RECOMMEND_NO }};

                storeArticle(data);
            });

            /**
             * 保存数据
             */
            function storeArticle(data) {
                var responseObject;
                $.ajax({
                    type: "put",
                    url: "{{url('admin/article',['id'=>$article->article_id])}}",
                    data: data.field,
                    async: false,
                    error: function (XMLHttpRequest, textStatus, errorThrow) {
                        responseObject = {status: false, message: '请求失败'};
                    },
                    success: function (res, textStatus) {
                        responseObject = {status: res.code, message: (res.message.toString())};
                    },
                    // 请求完成后回调函数 (请求成功或失败之后均调用)
                    complete: function (XMLHttpRequest, textStatus) {
                        if (XMLHttpRequest.status == 422) {
                            var ret_json = XMLHttpRequest.responseJSON;
                            for (var i in ret_json.errors) {
                                responseObject = {status: false, message: (ret_json.errors[i]).toString()};
                                break;
                            }
                        } else if (textStatus == 'error') {
                            responseObject = {status: false, message: '服务器异常，请联系管理员'};
                        }
                    }
                });
                layer.msg(responseObject.message, {
                    icon: responseObject.status == {{ \App\Component\Classes\Code::SUCCESS }} ? 1 : 5,
                    time: 1500
                });
                if (responseObject.status == {{ \App\Component\Classes\Code::SUCCESS }}) {
                    var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                    setTimeout(function () {
                        parent.layer.close(index); //再执行关闭
                        window.parent.location.reload();//在执行父级更新操作
                    }, 1500);
                }
                //弹出loading
                return false;
            }

            /**
             * 上传图片实例
             */
            upload.render({
                elem: '#choose'
                , url: "{{ url('admin/tools/upload-article-image') }}"
                , before: function (obj) {
                    let old_cover_img = $('#cover_img').val();
                    let now_cover_img = $('#now_cover_img').val();
                    //如果存在老图  删除
                    if(old_cover_img && (old_cover_img != now_cover_img)){
                        $.ajax({
                            url:"{{ url('admin/tools/unlink-img') }}",
                            type:"get",
                            data:{path:old_cover_img},
                            success:function () {

                            },error:function () {

                            }
                        })
                    }
                    $('#show_img').html('');
                    $('#cover_img').val('');
                    //预读本地文件示例，不支持ie8
                    obj.preview(function (index, file, result) {
                        $('#show_img').append('<img src="' + result + '" alt="' + file.name + '" class="layui-upload-img" style="width: 100%">')
                    });
                }
                , data: {'_token': $('meta[name="csrf-token"]').attr('content')}
                // ,bindAction: '#ok-upload'
                , done: function (res) {
                    $('#cover_img').val(res.data.path);
                }
            });

            $('body').on('click', '.chose-tag dd', function () {
                let htmlStr = '<a href="javaScript:void(0);"><input type="hidden" name="tag_ids[]" value="' + $(this).data('tag-id') + '"><span>' + $(this).html().trim() + '</span><i class="layui-icon">ဆ</i></a>';
                $('.tag-area').append(htmlStr);
                $(this).hide();
            });

            $('body').on('click', '.tag-area i', function () {
                $(this).parents('a').remove();
                $('#tag-id-' + $(this).parents('a').find('input').val().trim()).show();
            });
        });

    </script>
    <script>
        var E = window.wangEditor
        var editor = new E('#content-div')
        var $text1 = $('#content-text')
        editor.customConfig.onchange = function (html) {
            // 监控变化，同步更新到 textarea
            $text1.val(html)
        };
        editor.customConfig.zIndex = 1;  //避免富文本覆盖下拉选择框
        editor.customConfig.menus = [
            'head',  // 标题
            'bold',  // 粗体
            'fontSize', //字号
            'italic',  // 斜体
            'underline',  // 下划线
            'strikeThrough',  // 删除线
            'foreColor',  // 文字颜色
            'backColor',  // 背景颜色
            'link',     //超链接
            // 'list',  // 列表
            'justify',  // 对齐方式
            'emoticon',//表情
            'image',  // 插入图片
            'table',// 表格
            'code',
            'undo',  // 撤销
            'redo'  // 重复
        ];
        editor.customConfig.uploadImgServer = "{{ url('admin/tools/upload-article-editor-image') }}";  //上传图片到服务器
        editor.customConfig.uploadFileName = 'article_img[]';

        // 设置 headers（举例）
        editor.customConfig.uploadImgHeaders = {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'text/x-json'
        };
        // 隐藏“网络图片”tab
        // editor.customConfig.showLinkImg = false;
        editor.create();
        //增加全屏功能
        E.fullscreen.init('#content-div');
        // 初始化 textarea 的值
        $text1.val(editor.txt.html())
    </script>

    </body>
@endsection

