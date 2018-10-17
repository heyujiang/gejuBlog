@extends('index.main')

@section('title')
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>格局 - 个人博客</title>
@endsection

@section('style')
@endsection

@section('body')
    <div class="container-fluid carousel-wrap">
        <div class="row">
            <div id="carousel" class="owl-carousel owl-carousel-image">
                @foreach($bannels as $bannel)
                    <a class="carousel-item img-response" target="_blank" href="{{ url('article',['id'=>$bannel->article_id])  }}" style="background-image: url({{ asset($bannel->cover_img) }})">
                        <div class="carousel-info vertical-middle ">
                            {{--<div class="carousel-info-meta">--}}
                            {{--<span class="carousel-info-category mr-1" href="">创意</span>--}}
                            {{--<span class="carousel-info-time">{{ substr($bannel->created_at,10) }}</span>--}}
                            {{--</div>--}}
                            <div class="carousel-info-title">
                                {{ $bannel->title }}
                            </div>
                            <div class="carousel-info-meta">
                                {{--<span class="carousel-info-category mr-1" href="">创意</span>--}}
                                <span class="carousel-info-time">{{ $bannel->subtitle }}</span>
                            </div>
                            <div class="carousel-info-meta">
                            <span class="carousel-info-category">{{ substr($bannel->created_at,0,10) }}</span>
                            </div>
                        </div>
                        <div class="carousel-overlay"></div>
                    </a>
                @endforeach
               {{-- <a class="carousel-item img-response" href="http://heitang.chuangzaoshi.com/archives/30"
                   title="黑糖丨用户手册：安装和使用建议" style="background-image: url({{ asset('static/picture/a-3.png') }})">
                    <div class="carousel-info vertical-middle ">
                        --}}{{--<div class="carousel-info-meta">--}}{{--
                        --}}{{--<span class="carousel-info-category mr-1"--}}{{--
                              --}}{{--href="http://heitang.chuangzaoshi.com/archives/category/creativity">创意</span> <span--}}{{--
                                    --}}{{--class="carousel-info-time">--}}{{--
                                    --}}{{--2017.05.15                                </span>--}}{{--
                        --}}{{--</div>--}}{{--
                        <div class="carousel-info-title">
                            黑糖丨用户手册：安装和使用建议
                        </div>
                    </div>
                    <div class="carousel-overlay"></div>
                </a>--}}
            </div>
        </div>
    </div>
    <div class="notice mb-6 py-3">
        <div class="container">
            <div class="notice-wrap">
                <i class="czs-volume-l notice-icon"></i>
                <ul>
                    @foreach($placards as $placard)
                        <li class="notice-item">
                            <a target="_blank" href="{{ url('placard',['id'=>$placard->placard_id]) }}">{{ $placard->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
  {{--  <div class="container ps-r mb-10 hidden-xs mt-6">
        <div class="custom-carousel">
            <a href="http://heitang.chuangzaoshi.com/archives/category/creativity"
               class="mask-animate d-block carousel-item"
               style="background: url({{ asset('static/images/c-4.png') }}); background-repeat: no-repeat; background-size: cover; background-position: center top">
                <div class="text-center custom-carousel-info vertical-middle">
                    <div class="mb-1">
                        11篇
                    </div>
                    <div class="mb-3 custom-carousel-info-description">
                        发现灵感创意品味艺术生活
                    </div>
                    <div class="custom-carousel-info-name btn-line">
                        创意
                    </div>
                </div>
            </a>
            <a href="http://heitang.chuangzaoshi.com/archives/category/hardware" class="mask-animate d-block carousel-item"
               style="background: url({{ asset('static/images/c-2.png') }}); background-repeat: no-repeat; background-size: cover; background-position: center top">
                <div class="text-center custom-carousel-info vertical-middle">
                    <div class="mb-1">
                        11篇
                    </div>
                    <div class="mb-3 custom-carousel-info-description">
                        极客科技迷的各种折腾教程
                    </div>
                    <div class="custom-carousel-info-name btn-line">
                        硬件
                    </div>
                </div>
            </a>
            <a href="http://heitang.chuangzaoshi.com/archives/category/tech" class="mask-animate d-block carousel-item"
               style="background: url({{ asset('static/images/c-1.png') }}); background-repeat: no-repeat; background-size: cover; background-position: center top">
                <div class="text-center custom-carousel-info vertical-middle">
                    <div class="mb-1">
                        11篇
                    </div>
                    <div class="mb-3 custom-carousel-info-description">
                        关注人工智能读懂未来
                    </div>
                    <div class="custom-carousel-info-name btn-line">
                        科技
                    </div>
                </div>
            </a>
            <a href="http://heitang.chuangzaoshi.com/archives/category/design" class="mask-animate d-block carousel-item"
               style="background: url({{ asset('static/images/c-3.png') }}); background-repeat: no-repeat; background-size: cover; background-position: center top">
                <div class="text-center custom-carousel-info vertical-middle">
                    <div class="mb-1">
                        11篇
                    </div>
                    <div class="mb-3 custom-carousel-info-description">
                        把握界面和交互设计的潮流趋势
                    </div>
                    <div class="custom-carousel-info-name btn-line">
                        设计
                    </div>
                </div>
            </a>
        </div>
    </div>--}}
    <main class="container" id="main">
        <div class="row">
            <div class="col-md-8 no-gutter-xs">
                <div class="post-wrap">
                    {{--  <div class="post post-type-aside">
                        <div class="post-left pull-left">
                            <a class="post-img img-response d-block gradient-mask"
                               href=" http://heitang.chuangzaoshi.com/archives/22"
                               style="background-image: url({{ asset('static/picture/a-3.png') }})">
                            </a>
                        </div>
                        <div class="post-right">
                            <div class="post-title">
                                <a href="http://heitang.chuangzaoshi.com/archives/22">黑糖丨主题的介绍和购买！</a>
                            </div>
                            <div class="post-meta-top">
                                <a class="post-meta-categories"
                                   href="http://heitang.chuangzaoshi.com/archives/category/creativity">
                                    <i class="czs-bookmark"></i>
                                    创意 </a>
                                <span class="post-meta-time">
             • 2017.05.15    </span>
                            </div>
                            <div class="post-body">
                                <a href="http://heitang.chuangzaoshi.com/archives/22">主题介绍
                                    你现在所看到的是黑糖主题的官方2.0演示站点。这次是黑糖主题的全新升级！黑糖(BlackCandy)是创…</a>
                            </div>
                            <ul class="post-meta-bottom">
                                <li class="post-meta-author">
                                    <a class="d-block" href="http://heitang.chuangzaoshi.com/archives/author/geeker"
                                       target="_blank">
                                        <img alt='' src="{{ asset('static/picture/avatar_user_1_1494903592-96x96.png') }}"
                                             srcset="{{ asset('static/picture/avatar_user_1_1494903592-96x96.png') }} 2x"
                                             class='avatar avatar-96 photo' height='96' width='96'/> <span
                                                class="d-inline-block">geeker</span>
                                    </a>
                                </li>
                                <li class="post-meta-view pull-right ">
                                    <i class="czs-eye-l"></i> 14270
                                </li>
                                <li class="post-meta-comments pull-right ">
                                    <i class="czs-comment-l"></i> 12
                                </li>
                                <li class="post-meta-like pull-right ">
                                    <i class="czs-heart-l"></i>
                                    <span class="count">
                                72                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>--}}
                    {{--          <div class="post post-style-standard">
                        <div class="post-title">
                            <a href="http://heitang.chuangzaoshi.com/archives/20"> 黑糖丨特色的[专题首推]板块，让分类更漂亮优雅！ </a>
                        </div>
                        <div class="post-meta-top">
                            <a class="post-meta-categories"
                               href="http://heitang.chuangzaoshi.com/archives/category/creativity">
                                <i class="czs-bookmark"></i>
                                创意 </a>
                            <span class="post-meta-time">
             • 2017.05.15    </span>
                        </div>
                        <a class="gradient-mask post-img img-response"
                           href=" http://heitang.chuangzaoshi.com/archives/20"
                           style="background-image: url({{ asset('static/images/b-3.png') }})"></a>
                        <div class="post-body hidden-xs">
                            <a href="http://heitang.chuangzaoshi.com/archives/20">专题设置：分类目录-设置标题丨描述丨图片 丰富的专题
                                通过光标拖拽内容左右滑动或黑方格切换。展示更多…</a>
                        </div>
                        <ul class="post-meta-bottom">
                            <li class="post-meta-author">
                                <a class="d-block" href="http://heitang.chuangzaoshi.com/archives/author/geeker"
                                   target="_blank">
                                    <img alt='' src="{{ asset('static/picture/avatar_user_1_1494903592-96x96.png') }}"
                                         srcset= "{{ asset('static/picture/avatar_user_1_1494903592-96x96.png') }} 2x"
                                         class='avatar avatar-96 photo' height='96' width='96'/> <span
                                            class="d-inline-block">geeker</span>
                                </a>
                            </li>
                            <li class="post-meta-view pull-right ">
                                <i class="czs-eye-l"></i> 9129
                            </li>
                            <li class="post-meta-comments pull-right ">
                                <i class="czs-comment-l"></i> 0
                            </li>
                            <li class="post-meta-like pull-right ">
                                <i class="czs-heart-l"></i>
                                <span class="count">
                                68                    </span>
                            </li>
                        </ul>
                    </div>--}}
                    {{--  <div class="post post-type-status">
                       <div class="post-title">
                           <a href="http://heitang.chuangzaoshi.com/archives/14">黑糖丨首页文章形式4+1种显示模式</a>
                       </div>
                       <div class="post-meta-top">
                           <a class="post-meta-categories"
                              href="http://heitang.chuangzaoshi.com/archives/category/creativity">
                               <i class="czs-bookmark"></i>
                               创意 </a>
                           <span class="post-meta-time">
            • 2017.05.15    </span>
                       </div>
                       <div class="post-body">
                           <a href="http://heitang.chuangzaoshi.com/archives/14">这是一篇首页纯文字的信息板块，在编辑文章-形式中选择-状态即可！
                               首页左右双栏
                               四种文章类型：文…</a>
                       </div>
                       <ul class="post-meta-bottom">
                           <li class="post-meta-author">
                               <a class="d-block" href="http://heitang.chuangzaoshi.com/archives/author/geeker"
                                  target="_blank">
                                   <img alt='' src="{{ asset('static/picture/avatar_user_1_1494903592-96x96.png') }}"
                                        srcset="{{ asset('static/picture/avatar_user_1_1494903592-96x96.png') }} 2x"
                                        class='avatar avatar-96 photo' height='96' width='96'/> <span
                                           class="d-inline-block">geeker</span>
                               </a>
                           </li>
                           <li class="post-meta-view pull-right ">
                               <i class="czs-eye-l"></i> 4467
                           </li>
                           <li class="post-meta-comments pull-right ">
                               <i class="czs-comment-l"></i> 0
                           </li>
                           <li class="post-meta-like pull-right ">
                               <i class="czs-heart-l"></i>
                               <span class="count">
                               33                    </span>
                           </li>
                       </ul>
                   </div>--}}
                    @foreach($articles as $article)
                        <div class="post post-style-image">
                            <a class="post-img img-response d-block gradient-mask" href="{{ url('article',['id'=>$article->article_id]) }}" style="background-image: url({{ asset($article->cover_img) }})"></a>
                            <div class="post-style-image-content">
                                <div class="post-meta-top">
                                    <a class="post-meta-categories"
                                       href="{{ url('category',['id'=>$article->category->category_id]) }}">
                                        <i class="czs-bookmark"></i>
                                        {{ $article->category->name }} </a>
                                    <span class="post-meta-time">• {{ substr($article->created_at,0,10) }}    </span>
                                </div>
                                <div class="post-title">
                                    <a href="{{ url('article',['id'=>$article->article_id]) }}">{{ $article->title }}</a>
                                </div>
                                <ul class="post-meta-bottom">
                                    <li class="post-meta-author">
                                        <a class="d-block" href="http://heitang.chuangzaoshi.com/archives/author/geeker"
                                           target="_blank">
                                            <img alt='' src="{{ asset('static/picture/avatar_user_1_1494903592-96x96.png') }}"
                                                 srcset="{{ asset('static/picture/avatar_user_1_1494903592-96x96.png') }} 2x"
                                                 class='avatar avatar-96 photo' height='96' width='96'/> <span
                                                    class="d-inline-block">geeker</span>
                                        </a>
                                    </li>
                                    <li class="post-meta-view pull-right ">
                                        <i class="czs-eye-l"></i> {{ $article->readed_num }}
                                    </li>
                                    <li class="post-meta-comments pull-right ">
                                        <i class="czs-comment-l"></i> {{ $article->comment_num }}
                                    </li>
                                    <li class="post-meta-like pull-right ">
                                        <i class="czs-heart-l"></i> {{ $article->collect_num }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination">
                    <span class="more d-inline-block">
                        <a href="javascript:;" data-href="{{ url('article_page') }}" data-type="index" data-page="{{ $next_page }}">加载更多</a>
                    </span>
                </div>
            </div>
            <div class="col-md-4">
                <div>
                    <aside id="sidebar">
                        <div class="sidebar-wrap">
                            <div class="affix">
                            </div>
                            <div class='sidebar-index'>

                                <div class="widget widget-wechat"
                                     style="background-repeat: no-repeat;background-size: cover;background-position: center top;">
                                    <div class="widget-title"><span>微信公众号</span></div>
                                    <div class="widget-wechat-body">
                                        <div class="widget-wechat-img">
                                            <img src="{{ asset('static/picture/wechat_qrcode.png') }}" alt="wechat">
                                        </div>
                                        <div class="widget-wechat-content">
                                            <h4 class="widget-wechat-title">创造狮</h4>
                                            <p class="widget-wechat-account">微信号：chuangzaoshi</p>
                                            <p class="widget-wechat-description">扫描关注我们</p>
                                        </div>
                                    </div>
                                </div>

                                <div id="widget-tagcloud-2" class="widget widget-tagcloud">
                                    <div class="widget-title"><span>标签云</span></div>
                                    <div class="tagcloud">
                                        @foreach($tags as $tag)
                                            <a href="{{ url('tag',['id'=>$tag->tag_id]) }}" class="tag-cloud-link tag-link-6 tag-link-position-1" style="font-size: 8pt;"
                                               aria-label="">{{ $tag->name }}</a>
                                        @endforeach

                                        {{--<a href="http://heitang.chuangzaoshi.com/archives/tag/apple"--}}
                                           {{--class="tag-cloud-link tag-link-7 tag-link-position-2" style="font-size: 8pt;"--}}
                                           {{--aria-label="Apple (6个项目)">Apple</a>--}}

                                     <a class="tagcloud-more" href="{{ url('tag') }}" title="更多标签">更多</a>
                                    </div>
                                </div>

                                <div id="widget-hotpost-2" class="widget widget-hotpost">
                                    <div class="widget-title"><span>推荐文章</span></div>
                                    <ul class="widget-hotpost-image">
                                        @foreach($recommends as $recommend)
                                            <a href="{{ url('article',['id'=>$recommend->article_id]) }}" class="mask-animate widget-hotpost-image-item">
                                                <div class="recent-post-img">
                                                    <img width="1110" height="400" src="{{ asset($recommend->cover_img) }}"
                                                         class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                                                         alt=""
                                                         srcset="{{ asset($recommend->cover_img) }} 1110w, {{ asset($recommend->cover_img) }} 300w, {{ asset($recommend->cover_img) }} 768w, {{ asset($recommend->cover_img) }} 1024w"
                                                         sizes="(max-width: 1110px) 100vw, 1110px"/>
                                                </div>
                                                <div class="widget-hotpost-meta">
                                                    <div class="widget-hotpost-image-title mb-1">{{ $recommend->title }}</div>
                                                    <div style="font-size: 12px;">
                                                         <span class="d-inline-block">
                                                             <i class="czs-bookmark"></i> {{ $recommend->category->name }}
                                                         </span>
                                                        <span class="d-inline-block pull-right">
                                                             {{ substr($recommend->created_at,0,10) }}
                                                        </span>
                                                    </div>
                                                </div>

                                            </a>
                                        @endforeach


                                     {{--   <a href="http://heitang.chuangzaoshi.com/archives/30"
                                           class="mask-animate widget-hotpost-image-item">
                                            <div class="recent-post-img">
                                                <img width="1110" height="400" src="{{ asset('static/picture/a-3.png') }}"
                                                     class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                                                     alt=""
                                                     srcset="{{ asset('static/picture/a-3.png') }} 1110w, http://heitang.chuangzaoshi.com/wp-content/uploads/2017/05/A-1-300x108.png 300w, http://heitang.chuangzaoshi.com/wp-content/uploads/2017/05/A-1-768x277.png 768w, http://heitang.chuangzaoshi.com/wp-content/uploads/2017/05/A-1-1024x369.png 1024w"
                                                     sizes="(max-width: 1110px) 100vw, 1110px"/></div>
                                            <div class="widget-hotpost-meta">
                                                <div class="widget-hotpost-image-title mb-1">黑糖丨用户手册：安装和使用建议</div>
                                                <div style="font-size: 12px;">
                                        <span class="d-inline-block">
                                            <i class="czs-bookmark"></i>
                                            创意                                    </span>
                                                    <span class="d-inline-block pull-right">
                                            2017.05.15                                    </span>
                                                </div>
                                            </div>

                                        </a>
                                        <a href="http://heitang.chuangzaoshi.com/archives/28"
                                           class="mask-animate widget-hotpost-image-item">
                                            <div class="recent-post-img">
                                                <img width="1110" height="400" src="{{ asset('static/picture/a-3.png') }}"
                                                     class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                                                     alt=""
                                                     srcset="{{ asset('static/picture/a-3.png') }} 1110w, http://heitang.chuangzaoshi.com/wp-content/uploads/2017/05/A-5-300x108.png 300w, http://heitang.chuangzaoshi.com/wp-content/uploads/2017/05/A-5-768x277.png 768w, http://heitang.chuangzaoshi.com/wp-content/uploads/2017/05/A-5-1024x369.png 1024w"
                                                     sizes="(max-width: 1110px) 100vw, 1110px"/></div>
                                            <div class="widget-hotpost-meta">
                                                <div class="widget-hotpost-image-title mb-1">黑糖丨主题版本更新</div>
                                                <div style="font-size: 12px;">
                                        <span class="d-inline-block">
                                            <i class="czs-bookmark"></i>
                                            创意                                    </span>
                                                    <span class="d-inline-block pull-right">
                                            2017.05.15                                    </span>
                                                </div>
                                            </div>

                                        </a>
                                        <a href="http://heitang.chuangzaoshi.com/archives/9"
                                           class="mask-animate widget-hotpost-image-item">
                                            <div class="recent-post-img">
                                                <img width="750" height="400" src="{{asset('static/picture/caomei.png')}}"
                                                     class="attachment-post-thumbnail size-post-thumbnail wp-post-image"
                                                     alt=""
                                                     srcset="{{asset('static/picture/caomei.png')}} 750w, http://heitang.chuangzaoshi.com/wp-content/uploads/2017/05/caomei-300x160.png 300w"
                                                     sizes="(max-width: 750px) 100vw, 750px"/></div>
                                            <div class="widget-hotpost-meta">
                                                <div class="widget-hotpost-image-title mb-1">创造狮丨草莓图标库</div>
                                                <div style="font-size: 12px;">
                                        <span class="d-inline-block">
                                            <i class="czs-bookmark"></i>
                                            创意                                    </span>
                                                    <span class="d-inline-block pull-right">
                                            2017.05.15                                    </span>
                                                </div>
                                            </div>

                                        </a>--}}
                                    </ul>
                                </div>
                                <div id="widget-hotpost-3" class="widget widget-hotpost">
                                    <div class="widget-title"><span>热门文章</span></div>
                                    <ul class="widget-hotpost-brief">
                                        @foreach($hots as $hot)
                                            <li>
                                                <a href="{{ url('article',['id'=>$hot->article_id]) }}">
                                                    {{ $hot->title }} </a>
                                                <div class="widget-hotpost-brief-time">
                                                    {{ substr($hot->created_at,0,10) }}
                                                </div>
                                            </li>
                                        @endforeach

                                      {{--  <li>
                                            <a href="http://heitang.chuangzaoshi.com/archives/22">
                                                黑糖丨主题的介绍和购买！ </a>
                                            <div class="widget-hotpost-brief-time">
                                                2017.05.15
                                            </div>
                                        </li>
                                        <li>
                                            <a href="http://heitang.chuangzaoshi.com/archives/28">
                                                黑糖丨主题版本更新 </a>
                                            <div class="widget-hotpost-brief-time">
                                                2017.05.15
                                            </div>
                                        </li>
                                        <li>
                                            <a href="http://heitang.chuangzaoshi.com/archives/20">
                                                黑糖丨特色的[专题首推]板块，让分类更漂亮优雅！ </a>
                                            <div class="widget-hotpost-brief-time">
                                                2017.05.15
                                            </div>
                                        </li>
                                        <li>
                                            <a href="http://heitang.chuangzaoshi.com/archives/26">
                                                黑糖丨主题用户购买须知 </a>
                                            <div class="widget-hotpost-brief-time">
                                                2017.05.15
                                            </div>
                                        </li>--}}
                                    </ul>
                                </div>
                                <div id="widget-comments-2" class="widget widget-comments">
                                    <div class="widget-title"><span>近期评论</span></div>
                                    <ul>
                                        <li class="widget-comments-item mb-2">
                                            <div class="comment-item-avatar mb-2">
                                                <img alt='ybzbxcc@163.com'
                                                     src="{{ asset('static/picture/avatar_user_1_1494903592-24x24.png') }}"
                                                     srcset='http://heitang.chuangzaoshi.com/wp-content/uploads/2017/05/avatar_user_1_1494903592-48x48.png 2x'
                                                     class='avatar avatar-24 photo' height='24' width='24'/> <a
                                                        class="widget-comment-author">
                                                    geeker </a>
                                            </div>
                                            <a href="http://heitang.chuangzaoshi.com/archives/22"
                                               class="widget-comment-content">
                                                官方客服Q：164903112 </a>
                                            <div class="widget-comment-meta">

                                                <!--                        <span class="widget-comment-date">-->
                                                <!--</span>-->
                                                评价于
                                                <a class="widget-comment-title"
                                                   href="http://heitang.chuangzaoshi.com/archives/22">
                                                    黑糖丨主题的介绍和购买！ </a>
                                            </div>
                                        </li>
                                        <li class="widget-comments-item mb-2">
                                            <div class="comment-item-avatar mb-2">
                                                <img src="{{ asset('static/picture/9a5cf5e02c17400aabf2ecd53660a7d4.gif') }}"
                                                     class="avatar avatar-48" height="48" width="48"> <a
                                                        class="widget-comment-author">
                                                    CandyAnt </a>
                                            </div>
                                            <a href="http://heitang.chuangzaoshi.com/archives/30"
                                               class="widget-comment-content">
                                                用了一段时间，很满意。页面简洁大方，功能&hellip; </a>
                                            <div class="widget-comment-meta">

                                                <!--                        <span class="widget-comment-date">-->
                                                <!--</span>-->
                                                评价于
                                                <a class="widget-comment-title"
                                                   href="http://heitang.chuangzaoshi.com/archives/30">
                                                    黑糖丨用户手册：安装和使用建议 </a>
                                            </div>
                                        </li>
                                        <li class="widget-comments-item mb-2">
                                            <div class="comment-item-avatar mb-2">
                                                <img src="{{ asset('static/picture/2f7e63c155534e6dbf7a842dd20ca697.gif') }}"
                                                     class="avatar avatar-48" height="48" width="48"> <a
                                                        class="widget-comment-author">
                                                    小河 </a>
                                            </div>
                                            <a href="http://heitang.chuangzaoshi.com/archives/28"
                                               class="widget-comment-content">
                                                可以很强 </a>
                                            <div class="widget-comment-meta">

                                                <!--                        <span class="widget-comment-date">-->
                                                <!--</span>-->
                                                评价于
                                                <a class="widget-comment-title"
                                                   href="http://heitang.chuangzaoshi.com/archives/28">
                                                    黑糖丨主题版本更新 </a>
                                            </div>
                                        </li>
                                        <li class="widget-comments-item mb-2">
                                            <div class="comment-item-avatar mb-2">
                                                <img src="{{ asset('static/picture/2d8ddbad2d0b469e87cfefbcd6c2ab7b.gif') }}"
                                                     class="avatar avatar-48" height="48" width="48"> <a
                                                        class="widget-comment-author">
                                                    嘟嘟爱小绵羊 </a>
                                            </div>
                                            <a href="http://heitang.chuangzaoshi.com/archives/22"
                                               class="widget-comment-content">
                                                稀饭稀饭 </a>
                                            <div class="widget-comment-meta">

                                                <!--                        <span class="widget-comment-date">-->
                                                <!--</span>-->
                                                评价于
                                                <a class="widget-comment-title"
                                                   href="http://heitang.chuangzaoshi.com/archives/22">
                                                    黑糖丨主题的介绍和购买！ </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget widget-follow">
                                <table>
                                    <tbody>
                                    <tr>
                                        <td class="follow-wechat">
                                            <i class="czs-weixin"></i>
                                            <div class="follow-wechat-popup">
                                                <img src="{{ asset('static/picture/wechat_qrcode.png') }}" alt="wechat">
                                            </div>
                                        </td>
                                        <td class="follow-weibo">
                                            <a target="blank" href="">
                                                <i class="czs-weibo"></i>
                                            </a>
                                        </td>
                                        <td class="follow-qq">
                                            <a target="_blank"
                                               href="tencent://AddContact/?fromId=50&fromSubId=1&subcmd=all&uin=164903112">
                                                <i class="czs-qq"></i>
                                            </a>
                                        </td>
                                        <td class="follow-rss">
                                            <a target="_blank" href="/feed/atom"><i class="czs-rss"></i></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
                </aside>

            </div>
        </div>
        <!-- cascade -->
        </div>
    </main>
@endsection


@section('script')

@endsection

