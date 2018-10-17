@extends('admin.layout.main')
@section('style')
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
                <td>父分类</td>
                <td>
                    <select name="p_id" class="layui-select">
                        <option value="0">选择父分类</option>
                        @foreach($parentCategorys as $parentCategory)
                            <option value="{{$parentCategory->category_id}}">{{ $parentCategory->name }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>分类名称</td>
                <td>
                    <input type="text" name="name" class="layui-input" lay-verify="required" placeholder="请输分类标题">
                </td>
            </tr>
            <tr>
                <td>排序</td>
                <td>
                    <input type="number" name="sort" value="1" class="layui-input sort-input" lay-verify="required" placeholder="请输入排序">
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
                $.ajax({
                    type: "POST",
                    url: "{{url('admin/category')}}",
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

</body>
@endsection

