@extends('admin.layout.main')
@section('style')
    <script type="text/javascript" src="{{ asset('static/admin/plugins/wangEditor/release/wangEditor.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('static/admin/static/css/cover_h.css') }}">   {{--覆盖layui框架对H1-H5的重写，避免富文本无法使用H1-H5--}}
    <script type="text/javascript" src="{{ asset('static/admin/plugins/wangEditor-fullscreen/wangEditor-fullscreen.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/admin/plugins/jquery/jquery-3.2.1.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('static/admin/plugins/wangEditor-fullscreen/wangEditor-fullscreen.css') }}"/>
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
                    <input type="text" name="title" class="layui-input" value="{{ $placard->title }}" lay-verify="required" placeholder="请输公告标题">
                </td>
            </tr>
            <tr>
                <td>正文</td>
                <td>
                    <div id="content-div">{!! $placard->content !!}</div>
                    <textarea name="content" class="layui-textarea layui-hide" lay-verify="required" id="content-text" cols="30" rows="10"></textarea>
                </td>
            </tr>
            <tr>
                <td>排序</td>
                <td>
                    <input type="number" name="sort" value="{{ $placard->sort }}" class="layui-input" lay-verify="required" placeholder="请输入排序">
                </td>
            </tr>
            <tr>
                <td>显示/隐藏</td>
                <td>
                    <input type="checkbox" name="is_show" value="1" @if($placard->is_show == \App\models\Placard::SHOW_STATUS_YES) checked @endif lay-skin="switch" lay-text="显示|隐藏">
                </td>
            </tr>
            </tbody>
        </table>
        <div class="layui-form-item" style="text-align: center;">
            <div class="layui-input-block">
                <button class="layui-btn" lay-submit="" lay-filter="submit_from" type="button">立即提交</button>
            </div>
        </div>
    </form>
    <script>
        layui.use(['form', 'layer', 'jquery'], function () {
            var form = layui.form,
                layer = parent.layer === undefined ? layui.layer : parent.layer,
                $ = layui.jquery;
            form.render();
            var responseObject;
            form.on("submit(submit_from)", function (data) {
                if (data.field.content == "<p><br></p>") {
                    layer.msg("请填写公告正文", {icon: 5, time: 1500});
                    return false;
                }
                $.ajax({
                    type: "POST",
                    url: "{{url('admin/placard/update',['id'=>$placard->placard_id])}}",
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
                layer.msg(responseObject.message, {icon: responseObject.status == {{ \App\Component\Classes\Code::SUCCESS }} ? 1 : 5, time: 1500});
                if (responseObject.status == {{ \App\Component\Classes\Code::SUCCESS }}) {
                    var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                    setTimeout(function () {
                        parent.layer.close(index); //再执行关闭
                        window.parent.location.reload();//在执行父级更新操作
                    }, 1500);
                }
                //弹出loading
                return false;
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
            'undo',  // 撤销
            'redo'  // 重复
        ];
        editor.customConfig.uploadImgServer = "{{ url('admin/tools/upload-image') }}";  //上传图片到服务器
        editor.customConfig.uploadFileName = 'placard_img[]';

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

