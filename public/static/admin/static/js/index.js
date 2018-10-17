/**
 * name: vip-admin 后台模板主入口
 * author: 随丶
 * version: 1.0
 */
layui.use(['layer'], function () {
    // 操作对象
    var layer = layui.layer
        , $ = layui.jquery;

    // 锁屏
    $(document).on('click', '.main-lock-btn', function () {
        // 设置
        layui.data('vip-admin', {
            key: 'lock'
            , value: 'true'
        });
        // 锁屏
        window.setLock(2);
    });

    // 全屏
    $(document).on('click', '.main-full-screen-btn', function () {
        // 全屏方法
        window.fullScreen();
        // 设置
        $(this).children('span').html('退出全屏');
        $(this).removeClass('main-full-screen-btn');
        $(this).addClass('main-exit-full-screen-btn');
    });

    // 退出全屏
    $(document).on('click', '.main-exit-full-screen-btn', function () {
        // 全屏方法
        window.exitFullScreen();
        // 设置
        $(this).children('span').html('全屏');
        $(this).removeClass('main-exit-full-screen-btn');
        $(this).addClass('main-full-screen-btn');
    });

    // 公告
    $(document).on('click', '.main-notice-btn', function () {
        //示范一个公告层
        layer.open({
            type: 1
            ,
            title: false   //不显示标题栏
            ,
            closeBtn: false
            ,
            area: '300px;'
            ,
            shade: 0.8
            ,
            id: 'LAY_layuipro' //设定一个id，防止重复弹出
            ,
            resize: false
            ,
            btn: ['前往', '关闭']
            ,
            btnAlign: 'c'
            ,
            moveType: 1 //拖拽模式，0或者1
            ,
            content: '<div style="padding: 30px; line-height: 20px; background-color: #393D49; color: #fff; font-weight: 300;">公告标题<br/>公告内容</div>'
            ,
            success: function (layero) {
                var btn = layero.find('.layui-layer-btn');
                btn.find('.layui-layer-btn0').attr({
                    href: 'http://www.layui.com/'
                    , target: '_blank'
                });
            }
        });
    });

    // 控制面板
    $(document).on('click', '.main-control-panel-btn', function () {
        var idx = layer.open({
            title: '<i class="layui-icon">&#xe638;</i> 控制面板'
            , type: 2
            , area: ['450px', '300px']
            , content: 'admin/system/control-panel'
        });
        // 弹框ifr层自适应
        layer.iframeAuto(idx);
    });

    // 确认退出询问框
    $(document).on('click', '.main-out-btn', function () {
        layer.confirm('确认退出？', {
            btn: ['确认', '锁屏', '取消']        //按钮
        }, function () {
            layer.msg('已退出');
            location.href = 'demo/login.html';
        }, function () {
            layer.msg('已锁屏');
        }, function (idx) {
            layer.close(idx);
        });
    });

    // 跳转
    $(document).on('click', '.main-nav a', function () {
        if ($(this).attr('href-url')) {
            // 设置
            window.setRUrl($(this).attr('href-url'));
            // 跳转
            $('.main-iframe-body').attr('src', $(this).attr('href-url'));
        }
    });

    // 清理缓存
    $(document).on('click', '.main-clean-btn', function () {
        // 清理
        window.cleanData();
        // 刷新
        location.reload();
    });

    // 直接设置主题
    $(document).on('click', '.main-set-skin-item>li>a', function () {
        var idx = $(this).attr('data-id');
        // 设置皮肤
        window.setSkin(idx);
    });

    // 锁屏方法(1:正常/2:锁屏)
    window.setLock = function (fx) {
        // 初始锁屏状态 默认：2
        layui.data('vip-admin', {
            key: 'lock'
            , value: fx
        });
        if (fx == 2) {
            window.lockIdx = layer.open({
                title: false
                , closeBtn: false
                , type: 2
                , anim: -1
                , shade: [0.9, '#393D49']
                , area: ['300px', '150px']
                , content: 'admin/system/unlock'
            });
        } else {
            layer.close(window.lockIdx);
        }
    };

    // 设置锁屏密码
    window.setLockPass = function (fx) {
        if (fx) {
            // 记录
            layui.data('vip-admin', {
                key: 'lockPass'
                , value: fx
            });
        } else {
            layer.msg('不能设置空密码解锁');
        }
    };

    // 全屏api
    window.fullScreen = function () {
        var el = document.documentElement;
        var rfs = el.requestFullScreen || el.webkitRequestFullScreen;
        if (typeof rfs != "undefined" && rfs) {
            rfs.call(el);
        } else if (typeof window.ActiveXObject != "undefined") {
            var wscript = new ActiveXObject("WScript.Shell");
            if (wscript != null) {
                wscript.SendKeys("{F11}");
            }
        } else if (el.msRequestFullscreen) {
            el.msRequestFullscreen();
        } else if (el.oRequestFullscreen) {
            el.oRequestFullscreen();
        } else {
            layer.msg('该浏览器不支持全屏调用,请手动F11按键全屏', {time: 3000});
        }
    };

    // 退出全屏api
    window.exitFullScreen = function () {
        var el = document;
        var cfs = el.cancelFullScreen || el.webkitCancelFullScreen || el.exitFullScreen;
        if (typeof cfs != "undefined" && cfs) {
            cfs.call(el);
        } else if (typeof window.ActiveXObject != "undefined") {
            var wscript = new ActiveXObject("WScript.Shell");
            if (wscript != null) {
                wscript.SendKeys("{F11}");
            }
        } else if (el.msExitFullscreen) {
            el.msExitFullscreen();
        } else if (el.oRequestFullscreen) {
            el.oCancelFullScreen();
        } else {
            layer.msg('该浏览器不支持全屏调用,请手动F11按键全屏', {time: 3000});
        }
    };

    // 调整导航栏方向
    window.setNav = function (fx) {
        // 设置导航栏方向
        layui.data('vip-admin', {
            key: 'nav'
            , value: fx
        });
        // console.log('setNav方法：'+fx);
        $('.main-hover').removeClass('main-hover-top main-hover-right main-hover-bottom main-hover-left');
        switch (fx) {
            case '1' || 1:
                $('.main-hover').addClass('main-hover-top');
                break;
            case '2' || 2:
                $('.main-hover').addClass('main-hover-bottom');
                break;
            case '3' || 3:
                $('.main-hover').addClass('main-hover-left');
                break;
            case '4' || 4:
                $('.main-hover').addClass('main-hover-right');
                break;
            default :
                $('.main-hover').addClass('main-hover-left');
                break;
        }
    };

    // 设置主题
    window.setSkin = function (fx) {
        if (fx > 0 && fx < 4) {
            // 设置皮肤状态
            layui.data('vip-admin', {
                key: 'skin'
                , value: fx
            });
            $('.main-hover').removeClass('skin-1 skin-2 skin-3');
            $('.main-hover').addClass('skin-' + fx);
        }
    };

    // 设置刷新
    window.setRUrl = function (fx) {
        // 记录
        layui.data('vip-admin', {
            key: 'rUrl'
            , value: fx
        });
        // 跳转
        $('.main-refresh-url-btn').attr('href-url', fx);
        $('.main-iframe-body').attr('src', fx);
    };

    // 清理缓存api
    window.cleanData = function () {
        layui.data('vip-admin', null);
    };

    // 初始config
    function init() {
        // 获取本地数据
        var localData = layui.data('vip-admin');

        console.log(localData);

        if (localData.lock == 2 || localData.lock == '2') {
            window.setLock(2);
        } else {
            window.setLock(1);
        }

        if (localData.skin > 0) {
            window.setSkin(localData.skin);
        } else {
            // 初始皮肤状态 默认：1
            window.setSkin(1);
        }

        if (localData.nav) {
            window.setNav(localData.nav);
        } else {
            // 默认 (1：上/2：下/3：左/4：右)
            window.setNav(3);
        }

        if (localData.rUrl) {
            window.setRUrl(localData.rUrl);
        } else {
            window.setRUrl("admin/console");
        }
    }

    // 执行初始化方法
    init();

    // 提示
    layer.tips('移动到该处显示菜单导航！', '.main-hover', {
        time: 2000
    });

    // 加群下载
    $(document).on('mouseover', '.main-download-btn', function (e) {
        layui.stope(e);
        layer.tips('前50名免费下载！', $(this), {
            time: 1500
        });
    });


});
