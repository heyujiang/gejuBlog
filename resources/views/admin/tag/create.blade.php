@extends('admin.layout.main')

@section('style')

@endsection

@section('body')
<body class="childrenBody">
    <form class="layui-form" method="post" action="{{ url('admin/nav/nav-store') }}">
        <table class="layui-table">
            <colgroup>
                <col width="5%">
                <col width="50%">
                <col>
            </colgroup>
            <thead>
                <th></th>
                <th></th>
            </thead>
            <tbody>
            <tr>
                <td>标签</td>
                <td><input type="text" name="name" class="layui-input" placeholder="请输入标签" lay-verify="required"></td>
            </tr>
            <tr>
                <td>排序</td>
                <td>
                    <input type="number" name="sort" class="layui-input col-md-2" placeholder="请输入排序值" value="1" lay-verify="sort"></td>
            </tr>

            </tbody>
        </table>

        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button  class="layui-btn" type="button" lay-filter="add" lay-submit="">
                确认
            </button>
        </div>
    </form>

    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
            var form = layui.form
                ,layer = layui.layer;

            //自定义验证规则
            form.verify({

            });
            var returnObj;
            //监听提交
            form.on('submit(add)', function(data){
                console.log(JSON.stringify(data.field));
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url:"{{url('admin/tag')}}",
                    data:data.field,
                    type:'post',
                    async:false,
                    success:function (res) {
                        returnObj = res;
                    },
                    error:function (res) {
                        returnObj = {"code":false,"message":"请求错误"};
                    }
                });

                if(returnObj.code == 200){
                    layer.msg(returnObj.message, {icon: 6,time:500},function () {
                        // 获得frame索引
                        var index = parent.layer.getFrameIndex(window.name);
                        //关闭当前frame
                        parent.layer.close(index);

                        window.parent.location.reload();//在执行父级更新操作
                    });
                }else{
                    layer.alert(returnObj.message,{icon: 2});
                }

                return true;
            });


        });
    </script>
</body>
@endsection
