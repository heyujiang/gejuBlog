@extends('admin.layout.main')

@section('style')

@endsection

@section('body')
<body class="body">
    <form class="layui-form layui-form-pane" action="">
        <div class="layui-form-item">
            <label class="layui-form-label">主题</label>
            <div class="layui-input-block">
                <select name="skin" lay-verify="required" lay-filter="skin">
                    <option value="1">默认</option>
                    <option value="2">蓝白</option>
                    <option value="3">黄色</option>
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">解屏密码</label>
            <div class="layui-input-block">
                <input type="password" name="lockPass" placeholder="请输入" autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">菜单方向</label>
            <div class="layui-input-block">
                <input type="radio" name="direction" value="1" title="上" lay-filter="main-nav">
                <input type="radio" name="direction" value="2" title="下" lay-filter="main-nav">
                <input type="radio" name="direction" value="3" title="左" lay-filter="main-nav">
                <input type="radio" name="direction" value="4" title="右" lay-filter="main-nav">
            </div>
        </div>
    </form>

    <script type="text/javascript">
        // 方法
        layui.use(['form'], function(){
            var form    = layui.form
                ,$          = layui.jquery;

            form.render();
            // 监听提交
            form.on('submit(formDemo)', function(data){
                layer.msg(JSON.stringify(data.field));
                return false;
            });

            // 监听主题
            form.on('select(skin)', function(data){
                var idx = data.value;
                // console.log(idx); //得到被选中的值
                if(idx > 0 && idx < 4){
                    // 设置皮肤
                    parent.setSkin(idx);
                }
            });

            // 监听解屏密码
            $(document).on('blur','input[name="lockPass"]', function(){
                parent.setLockPass($(this).val());
            });

            // 监听导航栏方向
            form.on('radio(main-nav)', function(data){
                //console.log(data.value); //被点击的radio的value值
                if(data.value > 0 && data.value < 5){
                    // 设置方向
                    parent.setNav(data.value);
                } else {
                    layer.msg('导航栏方向值不在范围内');
                }
            });
        });
    </script>
</body>
@endsection