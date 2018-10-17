<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>格局 · 个人博客后台</title>
    <link rel="stylesheet" href="{{ asset('static/admin/layui/css/layui.css') }}">
    <link rel="stylesheet" href="{{ asset('static/admin/static/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('static/admin/static/css/skin.css') }}">
    <link rel="icon" href="{{ asset('static/admin/static/image/logo.jpg') }}">
</head>
<body class="main-body">

<!-- nav -->
<div class="main-hover main-hover-left skin-1">
    <ul class="main-nav">
        <li>
            <a href="javascript:;" class="main-index-btn" href-url="{{ url('admin/console') }}">
                <i class="layui-icon layui-icon-home"></i><span class="layui-elip" title="首页">首页</span>
            </a>
        </li>
        <li>
            <a href="javascript:;">
                <i class="layui-icon layui-icon-website"></i><span class="layui-elip" title="站点">站点</span>
            </a>
            <ul>
                <li>
                    <a href="javascript:;" href-url=" {{ url('admin/navigation') }}">
                        <i class="layui-icon layui-icon-more"></i><span class="layui-elip" title="导航">导航</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" href-url="{{ url('admin/placard') }}" >
                        <i class="layui-icon layui-icon-list"></i><span class="layui-elip" title="公告">公告</span>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
                <i class="layui-icon layui-icon-app"></i><span class="layui-elip" title="站点">博客</span>
            </a>
            <ul>
                <li>
                    <a href="javascript:;" href-url="{{ url('admin/article') }}" >
                        <i class="layui-icon layui-icon-read"></i><span class="layui-elip" title="文章">文章</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" href-url="{{ url('admin/comment') }}" >
                        <i class="layui-icon layui-icon-edit"></i><span class="layui-elip" title="评论">评论</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" href-url=" {{ url('admin/tag') }}">
                        <i class="layui-icon layui-icon-note"></i><span class="layui-elip" title="标签">标签</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" href-url=" {{ url('admin/category') }}">
                        <i class="layui-icon layui-icon-tabs"></i><span class="layui-elip" title="分类">分类</span>
                    </a>
                </li>

            </ul>
        </li>
        <li>
            <a href="javascript:;">
                <i class="layui-icon">&#xe612;</i><span class="layui-elip" title="我的">我的</span>
            </a>
            <ul>
                <li>
                    <a href="javascript:;">
                        <i class="layui-icon">&#xe606;</i><span class="layui-elip" title="个人信息">个人信息</span>
                    </a>
                </li>
                <li>
                    <a href="{{ url('admin/logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="layui-icon">&#xe609;</i><span class="layui-elip" title="退出">退出</span>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
                <i class="layui-icon">&#xe620;</i><span class="layui-elip" title="系统">系统</span>
            </a>
            <ul>
                <li>
                    <a href="javascript:;" class="main-refresh-url-btn" href-url="demo/new.html">
                        <i class="layui-icon layui-icon-refresh"></i><span class="layui-elip" title="刷新">刷新</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="main-clean-btn">
                        <i class="layui-icon">&#x1007;</i><span class="layui-elip" title="清理缓存">清理缓存</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="main-lock-btn">
                        <i class="layui-icon">&#xe629;</i><span class="layui-elip" title="锁屏">锁屏</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" class="main-full-screen-btn">
                        <i class="layui-icon">&#xe626;</i><span class="layui-elip" title="全屏(IE不支持)">全屏</span>
                    </a>
                </li>

                <li>
                    <a href="javascript:;">
                        <i class="layui-icon">&#xe61b;</i><span class="layui-elip" title="主题">主题</span>
                    </a>
                    <ul class="main-set-skin-item">
                        <li>
                            <a href="javascript:;" data-id="1">
                                <i class="layui-icon">&#xe63f;</i><span class="layui-elip" title="默认">默认</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" data-id="2">
                                <i class="layui-icon">&#xe63f;</i><span class="layui-elip" title="蓝白">蓝白</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:;" data-id="3">
                                <i class="layui-icon">&#xe63f;</i><span class="layui-elip" title="黄色">黄色</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;" class="main-control-panel-btn">
                        <i class="layui-icon">&#xe632;</i><span class="layui-elip" title="控制面板">控制面板</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>

<!-- iframe box -->
<div class="main-iframe-box">
    <iframe class="main-iframe-body" src="" frameborder="0"></iframe>
</div>

</body>
<script type="text/javascript" src="{{ asset('static/admin/layui/layui.js') }}"></script>
<script type="text/javascript" src="{{ asset('static/admin/static/js/index.js') }}"></script>
</html>