@extends('admin.layout.main')

@section('style')

@endsection

@section('body')
    <body>

    <form class="layui-form main-lock">

        <div class="main-form-item tc">
            <img src="{{ asset('static/admin/static/image/logo.jpg') }}" alt="admin">
        </div>

        <div class="main-form-item main-lock-input tc">
            <div class="layui-input-inline">
                <input type="password" name="lock" lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-input-inline">
                <button class="layui-btn layui-icon layui-btn-normal" lay-submit lay-filter="sub-lock">&#xe602;</button>
            </div>
        </div>
    </form>


    <script type="text/javascript">
        layui.use(['form','layer'], function(){
            // 操作对象
            var form    = layui.form
                ,layer      = layui.layer
                ,$          = layui.jquery;

            // 监听submit提交
            form.on('submit(sub-lock)', function(data){
                // 获取本地数据
                var localData = layui.data('vip-admin');

                // console.log(data.field); //当前容器的全部表单字段，名值对形式：{name: value}
                if(localData.lockPass){
                    if(data.field.lock == localData.lockPass){
                        // 关闭弹框(1:正常/2：锁屏)
                        parent.setLock(1);
                    }else{
                        layer.msg('密码错误');
                    }
                }else{
                    if(data.field.lock){
                        // 关闭弹框(1:正常/2：锁屏)
                        parent.setLock(1);
                    }
                }
                return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
            });

            // you code ...


        });
    </script>
    </body>
@endsection