<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    @section('title')
    @show
    <link rel='stylesheet' id='style-css' href="{{ asset('static/css/style.css') }}" type='text/css' media='all'/>
    <link rel='stylesheet' id='style-css' href="{{ asset('static/css/czs.css') }}" type='text/css' media='all'/>
    <link rel='stylesheet' id='PrismCss-css' href="{{ asset('static/css/prism.css') }}" type='text/css' media='all'/>
    <link rel='stylesheet' id='owlcss-css' href="{{ asset('static/css/owl.carousel.min.css') }}" type='text/css' media='all'/>
    <link rel='stylesheet' id='FancyboxCss-css' href="{{ asset('static/css/jquery.fancybox.min.css') }}" type='text/css' media='all'/>
    <style type="text/css">
        .post-meta-categories, .custom-carousel, .custom-carousel .owl-prev, .custom-carousel .owl-next, .site-record:hover, .header-menu li a:hover, .post .post-title a:hover, #footer .footer-friends li a span:hover, #footer .footer-feature .footer-menu li a:hover, .widget-hotpost a:hover, .article-body a, .article-like .done, .comments .comments-list .comment .comment-body .comment-user a, .comments .comments-list .comment .children .comment-user a, #comment-nav-below .nav-inside .current, .widget-hotpost-brief i, .archive-header .archive-header-title {
            color: #171717;
        }

        .admin-login a:hover, .carousel-info-meta .carousel-info-category, .tagcloud a:hover, .calendar_wrap table td a, .article-meta .article-meta-tags a, .article-support .article-support-button a, .comments #respond .form-submit input {
            background-color: #171717;
        }

        .article-body h2, .article-body h3 {
            border-left: 5px solid #171717;
        }

        .admin-login a:hover, .article-like .done {
            border: 1px solid #171717;
        }

        .page-category-img:after {
            background: #171717;
            opacity: 0.8;
        }
    </style>
    @section('style')
    @show
    <script>
        var carouselSwitcher = "1";
        var carouselType = "image";
        var carouselOpacity = "10";
        var carouselSpeed = 3000;
        var carouselAnimateSpeed = 600;
        var carouselAnimation = "slide";
        var carouselMouseSwitcher = "";
        var siteUrl = "{{ url('') }}"+"/";
        var imgUrl = "{{ url('') }}"+"/";
        var fancyboxSwitcher = "1";
        var isHomePage = "1";
        var pagType = "more";
        var layoutType = "dcolumn";
        var themeUrl = "http://heitang.chuangzaoshi.com/wp-content/themes/BlackCandy";
        var success_code = "{{ \App\Component\Classes\Code::SUCCESS }}";
        var error_code = "{{ \App\Component\Classes\Code::FAILED }}";
    </script>
</head>
<body class="home blog">
<header id="header">
    <nav class="container">
        <div class="logo hidden-sm">
            <a href="http://heitang.chuangzaoshi.com" class="d-block">
                <img src="{{ asset('static/picture/logo.png') }}" alt="">
            </a>
        </div>
        <div class="mobile-logo show-sm">
            <a href="http://heitang.chuangzaoshi.com" class="d-inline-block">
                <img src="{{ asset('static/picture/logo_mobile.png') }}" alt="">
            </a>
        </div>
        <div class="header-menu-wrap clear">
            <ul id="menu" class="header-menu">
                @foreach($navigations as $navigation)
                    <li id="menu-item-{{ $navigation['navigation_id'] }}" class="menu-item menu-item-type-custom menu-item-object-custom @if($navigation['children']) menu-item-has-children @endif menu-item-{{ $navigation['navigation_id'] }}">
                        <a href="@if($navigation['children']) javascript:; @else {{ $navigation['link'] }} @endif"> @if($navigation['icon']) <i class="{{ $navigation['icon'] }}"></i> @endif{{ $navigation['name'] }}</a>
                        @if($navigation['children'])
                            <ul class="sub-menu child-menu depth_0">
                            @foreach($navigation['children'] as $child)
                                    <li id="menu-item-{{ $child['navigation_id'] }}" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-{{ $child['navigation_id'] }}">
                                        <a href="{{ $child['link'] }}">
                                            @if($child['icon'])<i class="{{ $child['icon'] }}"></i>@endif{{ $child['name'] }}
                                        </a>
                                    </li>
                            @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="admin-login hidden-sm">
            @guest
                <a href="{{ url('login') }}" target="_blank" class="btn-line btn-line-geek">登录</a>
            @else
                <img class="btn-nav-avatar" src="{{ asset('static/picture/avatar_user_1_1494903592-24x24.png') }}" alt="{{ Auth::user()->name }}">
            @endguest
        </div>
        <div class="search-button cursor-pointer">
            <i class="czs-search-l"></i>
            <span class="d-inline-block transition opacity-0"><i class="czs-close-l"></i></span>
        </div>
        <div class="menu-button">
            <div class="nav-bar">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>
    <div class="menu-wrap">
        <div class="mobile-menu">
            <ul id="menu-1" class="mobile-menu-nav">
                @foreach($navigations as $navigation)
                    <li id="menu-item-{{ $navigation['navigation_id'] }}" class="menu-item menu-item-type-custom menu-item-object-custom @if($navigation['children']) menu-item-has-children @endif menu-item-{{ $navigation['navigation_id'] }}">
                        <a href="@if($navigation['children']) javascript:; @else {{ $navigation['link'] }} @endif"> @if($navigation['icon']) <i class="{{ $navigation['icon'] }}"></i> @endif{{ $navigation['name'] }}</a>
                        @if($navigation['children'])
                            <ul class="sub-menu child-menu depth_0 ">
                                @foreach($navigation['children'] as $child)
                                    <li id="menu-item-{{ $child['navigation_id'] }}" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-{{ $child['navigation_id'] }}">
                                        <a href="{{ $child['link'] }}">
                                            @if($child['icon'])<i class="{{ $child['icon'] }}"></i>@endif{{ $child['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="mobile-admin-login text-center mt-3">
            @guest
                <a href="{{ url('login') }}" target="_blank" class="btn-line btn-line-geek">登录</a>
            @else
                <img class="btn-nav-avatar" src="{{ asset('static/picture/avatar_user_1_1494903592-24x24.png') }}" alt="{{ Auth::user()->name }}">
            @endguest
        </div>
    </div>
</header>
<div class="search-wrap transition">
    <div class="container">
        <div class="row">
            <form role="search" method="get" action="{{ url('s') }}" class="header-search">
                <input data-url="Q0JBVkI=" type="search" name="s" title="Search" placeholder="搜索..." value="">
            </form>
        </div>
    </div>
</div>

@section('body')
@show

<footer id="footer">
    <div class="container" style="position: relative; margin-top: 22px;" data-position="42b7fa582ea7decb">
        <div class="footer-theme hidden-xs">
            <strong class="d-inline-block">黑糖主题<span class="hidden-xs">：</span></strong>
            <span>为极客科技自媒体而设计</span>
        </div>
        <div class="footer-feature">
            <strong class="pull-left d-inline-block">功能菜单<span class="hidden-xs">：</span></strong>
            <ul id="menu-%e5%8a%9f%e8%83%bd%e8%8f%9c%e5%8d%95" class="footer-menu">
                <li id="menu-item-77" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-77"><a
                            href="http://heitang.chuangzaoshi.com/74-2">联系我们</a></li>
                <li id="menu-item-79" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-79"><a
                            href="http://heitang.chuangzaoshi.com/%e6%8a%95%e7%a8%bf">投稿</a></li>
                <li id="menu-item-80" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-80"><a
                            href="http://heitang.chuangzaoshi.com/%e5%bd%92%e6%a1%a3">归档</a></li>
                <li id="menu-item-81" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-81"><a
                            href="http://heitang.chuangzaoshi.com/%e5%8f%8b%e6%83%85%e9%93%be%e6%8e%a5">友情链接</a></li>
                <li id="menu-item-82" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-82"><a
                            href="http://heitang.chuangzaoshi.com/%e5%85%b3%e4%ba%8e%e6%88%91%e4%bb%ac">关于我们</a></li>
            </ul>
        </div>

        <ul class="footer-follow">
            <li class="animate-bg-success animate-bg follow-wechat">
                <a>
                    <i class="czs-weixin"></i>
                </a>
                <div class="follow-wechat-popup">
                    <img src="{{ asset('static/picture/wechat_qrcode.png') }} " alt="wechat">
                </div>
            </li>
            <li class="animate-bg-error animate-bg">
                <a target="blank" href="">
                    <i class="czs-weibo"></i>
                </a>
            </li>
            <li class="animate-bg-primary animate-bg">
                <a href="tencent://AddContact/?fromId=50&fromSubId=1&subcmd=all&uin=164903112" target="_blank">
                    <i class="czs-qq"></i>
                </a>
            </li>
            <li class="animate-bg-warning animate-bg">
                <a href="http://heitang.chuangzaoshi.com/feed/atom" target="_blank">
                    <i class="czs-rss"></i>
                </a>
            </li>
        </ul>

        <div class="footer-friends hidden-xs">
            <strong class='pull-left'>友情链接<span class="hidden-xs">：</span></strong>
            <li><a href="https://wordpress.org/download/" target="_blank"><span>WordPress官网</span></a></li>
            <li><a href="https://www.ziisp.com" target="_blank"><span>ziisp服务团队</span></a></li>
            <li><a href="http://www.buxiping.com/" target="_blank"><span>不喜平网页设计</span></a></li>
            <li><a href="http://chuangzaoshi.com/" target="_blank"><span>创造狮导航</span></a></li>
            <li><a href="http://chuangzaoshi.com/icon/" target="_blank"><span>草莓图标库</span></a></li>
            <li><a href="https://icss.me/" target="_blank"><span>阿乞</span></a></li>
            <li><a href="http://heijing.chuangzaoshi.com/" target="_blank"><span>黑镜主题</span></a></li>
        </div>
    </div>
    <div class="container">
    </div>
    <div class="copyright">
        <div class="container">
            <p>
                Copyright © 2017-2018 格局个人博客 / 版本 V 2.0
                <span style="margin-right: 12px;" class="hidden-xs">
                    <a class="site-record" target="_blank" href="http://www.miitbeian.gov.cn" style="color: #818181;">
                        赣ICP备14004527号-2
                    </a>
				</span>
            </p>
        </div>
    </div>
</footer>

<div class="scrollTop transition">
    <i class="czs-arrow-up-l"></i>
</div>
<script type='text/javascript' src="{{asset('static/js/jquery.min.js')}}"></script>
<script type='text/javascript' src="{{ asset('static/js/prism.js') }}"></script>
<script type='text/javascript' src="{{ asset('static/js/owl.carousel.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('static/js/jquery.fancybox.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('static/js/main.js') }}"></script>
<div class="overlay"></div>
<div class="backdrop transition"></div>
</body>
@section('script')
@show
</html>
