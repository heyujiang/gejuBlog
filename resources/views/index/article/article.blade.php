@extends('index.main')

@section('title')
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>}格局-私人博客 博文</title>
@endsection

@section('style')
@endsection

@section('body')
    <main class="container pt-xs-6" id="pjax-content">
        <div class="row">
            <div class="col-md-8">
                <div class="row" id="main">
                    <article class="article " id="post-24">
                        <!-- article-img -->
                        <div class="article-img">
                            <img src="{{ asset($article->cover_img) }}">
                        </div>
                        <!-- artisle-title -->
                        <div class="article-title">
                            <a href="{{ url('article',['id'=>$article->article_id]) }}">
                                {{ $article->title }}
                            </a>
                        </div>
                        <!-- article-meta -->
                        <div class="article-meta">
                            <span class="article-meta-time">{{ substr($article->created_at,0,10) }}</span>
                            <i class="czs-bookmark"></i>
                            <a href="{{ url('category',['id'=>$article->category->cotegory_id]) }}" rel="category tag">{{ $article->category->name }}</a>
                            {{--<a href="http://heitang.chuangzaoshi.com/archives/category/hardware" rel="category tag">硬件</a>--}}
                            {{--<a href="http://heitang.chuangzaoshi.com/archives/category/tech" rel="category tag">科技</a>--}}
                            {{--<a href="http://heitang.chuangzaoshi.com/archives/category/design" rel="category tag">设计</a>&nbsp;--}}
                            <i class="czs-heart-l"></i>
                            <span class="count">43</span>&nbsp;
                            <i class="czs-comment-l"></i>
                            <a href="http://heitang.chuangzaoshi.com/archives/24#comments" class="article-meta-comment">1</a>&nbsp;
                            <i class="czs-eye-l"></i>
                            <span class="count">{{ $article->readed_num }}</span>&nbsp;
                            <div class="article-meta-tags">
                                @foreach($article->tags as $tag)
                                    <a href="{{ url('tag',['id'=>$tag->tag_id]) }}" rel="tag">{{ $tag->name }}</a>
                                @endforeach


                                {{--<a href="http://heitang.chuangzaoshi.com/archives/tag/apple" rel="tag">Apple</a>--}}
                                {{--<a href="http://heitang.chuangzaoshi.com/archives/tag/uikit" rel="tag">UIkit</a>--}}
                                {{--<a href="http://heitang.chuangzaoshi.com/archives/tag/creator" rel="tag">创意工作者</a>--}}
                                {{--<a href="http://heitang.chuangzaoshi.com/archives/tag/business" rel="tag">商业</a>--}}
                                {{--<a href="http://heitang.chuangzaoshi.com/archives/tag/app" rel="tag">应用</a>--}}
                                {{--<a href="http://heitang.chuangzaoshi.com/archives/tag/plugin" rel="tag">插件</a>--}}
                                {{--<a href="http://heitang.chuangzaoshi.com/archives/tag/res" rel="tag">模板素材</a>--}}
                                {{--<a href="http://heitang.chuangzaoshi.com/archives/tag/game" rel="tag">游戏</a>--}}
                                {{--<a href="http://heitang.chuangzaoshi.com/archives/tag/vr" rel="tag">虚拟现实</a>--}}
                                {{--<a href="http://heitang.chuangzaoshi.com/archives/tag/blackcandy" rel="tag">黑糖主题</a>--}}
                            </div>
                        </div>
                        <!-- article -->
                        <div class="article-body">
                            {!! $article->content !!}


                            {{--<h3>简介</h3>--}}
                            {{--<p>黑糖(BlackCandy)是<a href="http://chuangzaoshi.com/">创造狮</a>最新开发的一款主题，得益于WordPress这个成熟的平台，整个开发非常的顺利，各种功能实现方法的教程在网上也是层出不穷。主题经过了多次的内部的打磨，我们对于主题的开发也越来越成熟。还是想分享一些主题开发和设计给大家。--}}
                            {{--</p>--}}
                            {{--<h3><strong>开发</strong></h3>--}}
                            {{--<p>--}}
                                {{--WordPress自身的插件很多，基于jquery的插件也很多。但是如果实现的功能全部都用插件解决，那这个主题得多臃肿。所以为了做出一个”清爽”的主题，几乎所有的功能模块都是纯手写代码加不断的调试而不断优化。像侧边栏的固定功能，当页面滑到一定高度，那侧边栏就固定在右边顶部。可是这时你会发现如果侧边栏太长，底部滚动上来时，就会和侧边栏重合在一起了。这时候就要考虑到底部上来时，侧边栏得随着滚动条而动了。这些都是不难实现的，从而提高了用户的使用习惯。如果使用插件的话更是不在话下。我们希望所有的代码是为黑糖主题量身定做的，因此就要结合主题的实际效果而不断完善代码。<br/>--}}
                                {{--CSS的话，语法简单，也很容易写。当代码增多时，那密密麻麻的css简直让人眼花缭乱。因此建议sass，less，stylus这些css框架就很有必要去采用了。对于sass，写的时候根据不同模块分开来写，最后一个命令把他编译成一style.css文件。这样既容易管理也容易修改，何乐而不为呢。<br/>--}}
                                {{--还有一个，对于开发者来说。写代码很需要一个好的编辑器或ide。这里推荐Sublime，atom，vscode这三个编辑器，即美观又优雅，特别是sublime，启动速度极快。不过，开发WordPress主题还是推荐jetbrains家的phpstorm。我觉得一个好的ide对于开发效率的提高还是十分明显的。--}}
                            {{--</p>--}}
                            {{--<p>最后，就是安心的学习PHP编程语言，前端HTML、CSS、JavaScript。同样希望你成为一个优秀的开发者。</p>--}}
                            {{--<h3><strong>设计</strong></h3>--}}
                            {{--<p>这次的黑糖2.0UI，使用的是Adobe出品UI的原型图设计软件AdobeXD (Adobe Experience?Design)设计的。LOGO则使用的是Adobe--}}
                                {{--Illustrator。其次产品的设计定位，黑糖定位是一个自媒体、科技爱好者、数码以及APP应用测评、创意工作者、以及极客的资讯站点，初期参考于少数派，最美应用，36Kr等科技资讯的网站布局，采用了以黑色为主色系，轻卡片式的设计，尽量体现简约、扁平。主题整体的风格和设计细节都极具黑糖特色。我们也单独为网站设计了个LOGO和字体。目前黑糖的一群小伙伴，在QQ群给了我们很多好的建议和意见，黑糖的风格设计细节也不断的优化。黑糖也一直不断的进化，我们希望未来通过对主题持续的更新，逐步提升到完美的使用效果。希望你能够真正的喜欢。1.5x系列版本我们对黑糖主题在速度、性能、功能板块和一些小细节上进行大的优化。也进行了黑糖一年以来从1.0到2.0的全新界面和功能的升级。黑糖用户均免费享受这一福利。</p>--}}
                            {{--<h3><strong>寄语</strong></h3>--}}
                            {{--<p>--}}
                                {{--制作主题也要投入很大的时间和精力去构思以及一步步的完善。黑糖的价格相比于目前国内和国外的主题非常的优惠，<strong>我们始终会保持物美价廉的方案福利于广大的WP爱好者</strong>，也同时真诚的希望大家支持正版，毕竟这个价格已经非常的实惠。--}}
                            {{--</p>--}}
                            {{--<h3></h3>--}}
                            {{--<h3>One more thing</h3>--}}
                            {{--<p>也欢迎大家访问创造狮导航，为创意工作者设计的一个导航。或许在设计和开发的路上能够帮助到你！</p>--}}
                            {{--<p>→ <a href="http://chuangzaoshi.com/" target="_blank" rel="noopener noreferrer">创造狮导航</a>--}}
                                {{--?http://chuangzaoshi.com/</p>--}}
                        </div>
                        <!-- advertisement -->
                        <div class="article-advertisement">
                        </div>
                        <!-- copyright -->
                        <p class="article-copyright">
                            转载原创文章请注明，转载自:
                            <a href="http://heitang.chuangzaoshi.com">
                                格局 - 私人博客 </a> -
                            <a href="http://heitang.chuangzaoshi.com/archives/24">
                                黑糖丨主题开发设计的小分享！ </a>
                            (http://heitang.chuangzaoshi.com/archives/24)
                        </p>
                        <div class="article-support">
                            <div class="article-support-title">
                                「如果你觉得对你有用，欢迎点击下方按钮对我打赏」
                            </div>
                            <div class="article-support-img">
                                <div class="article-support-zhifubao">
                                    <img src="{{ asset('static/picture/wechat_qrcode.png') }}">
                                    <div class="article-support-img-title">
                                        支付宝支付
                                    </div>
                                </div>
                                <div class="article-support-wechat">
                                    <img src="{{ asset('static/picture/wechat_qrcode.png') }}">
                                    <div class="article-support-img-title">
                                        微信支付
                                    </div>
                                </div>
                            </div>
                            <div class="article-support-button">
                                <a class="btn">赞赏</a>
                            </div>
                        </div>
                        <!-- like -->
                        <div class="article-like">
                            <a href="javascript:;" data-action="ding" data-id="24" class="favorite">
                                <i class="czs-heart-l"></i>
                                <span class="count">{{ $article->collect_num }}</span>
                            </a>
                        </div>
                        <!-- share -->
                        <div class="article-share">
                            <span class="article-share-title">分享到:</span>
                            <span class="bdsharebuttonbox d-inline-block">
                                <a href="#" class="bds_weixin czs-weixin" data-cmd="weixin" title="分享到微信"></a>
                                <a href="#" class="bds_tsina czs-weibo" data-cmd="tsina" title="分享到新浪微博"></a>
                                <a href="#" class="bds_sqq czs-qq" data-cmd="sqq" title="分享到QQ"></a>
                                <a href="#" class="bds_more czs-add" data-cmd="more"></a>
                            </span>
                            <script>
                                window._bd_share_config = {
                                    "common": {
                                        "bdSnsKey": {},
                                        "bdText": "",
                                        "bdMini": "1",
                                        "bdMiniList": false,
                                        "bdPic": "",
                                        "bdStyle": "0"
                                    },
                                    "share": {
                                        bdCustomStyle: themeUrl + '/assets/css/share.css'
                                    }
                                };
                                with (document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = themeUrl + '/assets/js/bdshare/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
                            </script>
                        </div>
                    </article>
                    <section id="post-link">
                        @if(empty($prevArticle))
                            <div class="md-6 post-link-previous">
                                上一篇：没有了
                            </div>
                            @else
                            <div class="md-6 post-link-previous">
                                上一篇：<a href="{{ url('article',['id'=>$prevArticle->article_id]) }}" rel="prev">{{ $prevArticle->title }}</a>
                            </div>
                        @endif

                        @if(empty($nextArticle))
                            <div class="md-6 post-link-previous">
                                下一篇：没有了
                            </div>
                        @else
                            <div class="md-6 post-link-previous">
                                下一篇：<a href="{{ url('article',['id'=>$nextArticle->article_id]) }}" rel="prev">{{ $nextArticle->title }}</a>
                            </div>
                        @endif
                    </section>
                    <div class="comments">
                        <div id="respond" class="comment-respond">
                            <h3 id="reply-title" class="comment-reply-title">留言
                                <small><a rel="nofollow" id="cancel-comment-reply-link" href="/archives/24#respond"
                                          style="display:none;">取消回复</a></small>
                            </h3>
                            <form action="http://heitang.chuangzaoshi.com/wp-comments-post.php" method="post"
                                  id="commentform" class="comment-form">
                                <p class="comment-form-comment"><label for="comment">评论</label> <textarea id="comment"
                                                                                                          name="comment"
                                                                                                          cols="45" rows="8"
                                                                                                          maxlength="65525"
                                                                                                          required="required"></textarea>
                                </p>
                                <p class="comment-form-author"><input id="author" name="author" placeholder="昵称" type="text"
                                                                      value="" size="30"/></p>
                                <p class="comment-form-email"><input id="email" name="email" placeholder="邮箱" type="text"
                                                                     value="" size="30"/></p>
                                <p class="comment-form-url"><input id="url" name="url" placeholder="网址" type="text" value=""
                                                                   size="30"/></p>
                                <p class="form-submit"><input name="submit" type="submit" id="submit" class="submit"
                                                              value="确定"/> <input type='hidden' name='comment_post_ID'
                                                                                  value='24' id='comment_post_ID'/>
                                    <input type='hidden' name='comment_parent' id='comment_parent' value='0'/>
                                </p>
                                <p style="display: none;"><input type="hidden" id="akismet_comment_nonce"
                                                                 name="akismet_comment_nonce" value="b93ab0386f"/></p>
                                <p style="display: none;"><input type="hidden" id="ak_js" name="ak_js" value="177"/></p>
                            </form>
                        </div><!-- #respond -->
                        <p class="akismet_comment_form_privacy_notice">This site uses Akismet to reduce spam. <a
                                    href="https://akismet.com/privacy/" target="_blank" rel="nofollow noopener">Learn how
                                your comment data is processed</a>.</p>
                        <div class="comments-title">
                            评论(1)
                        </div>
                        <ul class="comments-list">
                            <li class="comment even thread-even depth-1" id="li-comment-26">
                                <div id="comment-26">
                                    <div class="comment-avatar">
                                        <img src="{{ asset('static/picture/f1216aef332241f992e9c5d5f26175f6.gif') }}" class="avatar avatar-96"
                                             height="96" width="96"></div>
                                    <div class="comment-body">
                                        <span class="comment-user"><a href='http://www.huahuishuo.com'
                                                                      rel='external nofollow' class='url'>花卉说</a></span>
                                        <p>不错的主题。</p>
                                        <div class="comment-meta">
                                            <a href="http://heitang.chuangzaoshi.com/archives/24#comment-26"
                                               class="comment-date">
                                                06-18-2017 </a>
                                            <span class="comment-action">
                            <a rel='nofollow' class='comment-reply-link'
                               href='http://heitang.chuangzaoshi.com/archives/24?replytocom=26#respond'
                               onclick='return addComment.moveForm( "comment-26", "26", "respond", "24" )'
                               aria-label='回复给花卉说'>回复</a>                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </li><!-- #comment-## -->
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-4 ">
                <div class="row" style="padding-left: 30px;">
                    <aside id="sidebar">
                        <div class="sidebar-wrap">
                            <div class="affix">
                            </div>
                            <div class='sidebar-article'>

                                <div class="widget widget-profile-elegant">
                                    <div class="widget-profile-avatar">
                                        <img alt='' src='picture/avatar_user_1_1494903592-60x60.png'
                                             srcset='http://heitang.chuangzaoshi.com/wp-content/uploads/2017/05/avatar_user_1_1494903592.png 2x'
                                             class='avatar avatar-60 photo' height='60' width='60'/></div>
                                    <div class="widget-profile-user text-center f-bold">
                                        <a href="http://chuangzaoshi.com/" target="_blank">
                                            geeker </a>
                                    </div>
                                    <div class="widget-profile-description text-center mb-4">
                                    </div>
                                    <div class='widget-profile-role mb-6'><span>管理员</span></div>
                                    <div class="widget-profile-footer text-center">
                                        <a class="col-6 py-3 d-block"
                                           href="http://heitang.chuangzaoshi.com/archives/author/geeker"
                                           style="border-right: 1px solid #eee;">
                                            <i class="czs-doc-file-l"></i>作品
                                        </a>
                                        <a class="col-6 py-3 d-block" target="_blank" href="http://chuangzaoshi.com/">
                                            <i class="czs-network-l"></i>网站
                                        </a>
                                    </div>
                                </div>
                                <div id="widget-tagcloud-3" class="widget widget-tagcloud">
                                    <div class="widget-title"><span>标签云</span></div>
                                    <div class="tagcloud">
                                        @foreach($tags as $tag)
                                            <a href="{{ url('tag',['id'=>$tag->tag_id]) }}" class="tag-cloud-link tag-link-6 tag-link-position-1" style="font-size: 8pt;"
                                               aria-label="">{{ $tag->name }}</a>
                                        @endforeach
                                       <a class="tagcloud-more" href="http://heitang.chuangzaoshi.com/tags" title="更多标签">更多</a>
                                    </div>
                                </div>
                                <div id="widget-hotpost-4" class="widget widget-hotpost">
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
                               {{--         <li>
                                            <a href="http://heitang.chuangzaoshi.com/archives/30">
                                                黑糖丨用户手册：安装和使用建议 </a>
                                            <div class="widget-hotpost-brief-time">
                                                2017.05.15
                                            </div>
                                        </li>
                                        <li>
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
                                <div class="widget widget-follow">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td class="follow-wechat">
                                                <i class="czs-weixin"></i>
                                                <div class="follow-wechat-popup">
                                                    <img src="picture/wechat_qrcode.png " alt="wechat">
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
        </div>
    </main>
@endsection

@section('script')
@endsection
