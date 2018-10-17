var blackcandy = (function () {

    var pagMoreFlag = 1;

    var init = function () {
        scroll2Top();
        handlePagination();
        handleSearch();
        showDescendantMenu();
        showVendor();
        noticeCarousel();
        showSidebar();
        showSupport();
        showWechat();
        handleImgBox();
        handleVideo();
        setLayoutType();
    };
    var scroll2Top = function () {
        $('.scrollTop').click(function(){
            $('body,html').animate({scrollTop:0},600);
            return false;
        });
    };
    var handlePagination = function () {
        $(window).scroll(function() {
            if (pagType == "infinite" && $(document).scrollTop() + $(window).height() > $(document).height() - 80 && pagMoreFlag == 1) {
                getMoreByPagination($(".pagination .more a"));
            }
        });
        $(".pagination .more a").click(function(){
            getMoreByPagination($(this));
            return false;
        });
    };

    var getMoreByPagination = function (_this) {
        let page = _this.attr('data-page');
        let type = _this.data('type');
        let url = _this.data("href");
        if(url.indexOf("?") != -1){
            url += "&page="+page;
        }else{
            url += "?page="+page;
        }
        pagMoreFlag = 0;
        _this.text("加载中...");
        $.ajax({
            type: "get",
            url: url,
            contentType:"application/x-www-form-urlencoded",
            success: function(data){
                if(data.code == success_code){
                    if(type == 'index'){
                        indexArticleHtml(data.data.articles);
                    }else{
                        otherArticleHtml(data.data.articles);
                    }
                    pagMoreFlag = 1;
                    _this.attr('data-page',data.data.next_page);
                    _this.text("加载更多");
                }else{
                    _this.remove();
                    pagMoreFlag = 0;
                    $(".pagination .more").append("没有更多文章了");
                }


                // alert(data);
                // alert(JSON.stringify(data));
                // result = $(data).find(".post-wrap").children();
                // nextHref = $(data).find(".pagination .more a").attr("href");
                // alert(nextHref);
                // // ajax content fadeIn
                // $(".post-wrap").append(result.fadeIn(500));
                //
                // if ( nextHref != undefined ) {
                //     _this.attr("href", nextHref);
                // } else {
                //     // without more articles, remove the pagination navigatino
                //
                // }
            }
        });
    };

    var indexArticleHtml = function (data) {
        let htmlStr = '';
        for (var i = 0; i < data.length; i++) {
                htmlStr += '<div class="post post-style-image">';
                htmlStr += '    <a class="post-img img-response d-block gradient-mask" href="'+ siteUrl + 'article/' + data[i].article_id +'" style="background-image: url('+ imgUrl + data[i].cover_img +')"></a>'
                htmlStr += '    <div class="post-style-image-content">'
                htmlStr += '        <div class="post-meta-top">'
                htmlStr += '            <a class="post-meta-categories" href="'+ siteUrl + 'category/' + data[i].category.category_id +'">';
                htmlStr += '                <i class="czs-bookmark"></i>' + data[i].category.name;
                htmlStr += '            </a>'
                htmlStr += '            <span class="post-meta-time">• '+ data[i].created_at.substr(0,10) +'    </span>'
                htmlStr += '        </div>'
                htmlStr += '        <div class="post-title">'
                htmlStr += '            <a href="'+ siteUrl + 'article/' + data[i].article_id +'">'+ data[i].title +'</a>'
                htmlStr += '        </div>'
                htmlStr += '        <ul class="post-meta-bottom">'
                htmlStr += '            <li class="post-meta-author">'
                htmlStr += '                <a class="d-block" href="'+ siteUrl + 'user/' + data[i].user.id +'" target="_blank">'
                if(data[i].user.avatar){
                    htmlStr += '                   <img alt="" src="'+ imgUrl + data[i].user.avatar +'" class="avatar avatar-96 photo" height="96" width="96"/> '
                }else{
                    htmlStr += '                   <img alt="" src="' + imgUrl + 'static/picture/avatar_user_1_1494903592-96x96.png' + '" class="avatar avatar-96 photo" height="96" width="96"/> '
                }
                htmlStr += '                   <span class="d-inline-block">'+ data[i].user.name +'</span>'
                htmlStr += '                </a>'
                htmlStr += '            </li>'
                htmlStr += '            <li class="post-meta-view pull-right ">'
                htmlStr += '                <i class="czs-eye-l"></i> ' + data[i].readed_num
                htmlStr += '            </li>'
                htmlStr += '            <li class="post-meta-comments pull-right ">'
                htmlStr += '            <i class="czs-comment-l"></i> '  + data[i].comment_num
                htmlStr += '            </li>'
                htmlStr += '            <li class="post-meta-like pull-right ">'
                htmlStr += '                <i class="czs-heart-l"></i> ' + data[i].collect_num
                htmlStr += '            </li>'
                htmlStr += '        </ul>'
                htmlStr += '    </div>'
                htmlStr += '</div>'
        }
        $(".post-wrap").append(htmlStr);
    }


    var otherArticleHtml = function (data) {
        let htmlStr = '';
        for (var i = 0; i < data.length; i++) {
            htmlStr += '<div class="col-md-4 col-sm-6">';
            htmlStr += '    <div class="post post-style-card">';
            htmlStr += '        <a class="post-img img-response gradient-mask" href="'+ siteUrl + 'article/' + data[i].article_id +'" style="background-image: url('+ imgUrl + data[i].cover_img +')">';
            htmlStr += '        </a>';
            htmlStr += '        <div class="post-top">';
            htmlStr += '            <div class="post-title">';
            htmlStr += '                <a href=""> '+ data[i].title +' </a>';
            htmlStr += '            </div>';
            htmlStr += '            <div class="post-top-meta mb-2">';
            htmlStr += '                <span class="post-tag">';
            htmlStr += '                    <i class="czs-bookmark"></i>';
            htmlStr += '                    <a href="' + siteUrl + 'category/' + data[i].category.category_id + '">'+ data[i].category.name +'</a>';
            htmlStr += '                </span>';
            htmlStr += '                <span class="post-time">';
            htmlStr +=                    data[i].created_at.substr(0,10);
            htmlStr += '                </span>';
            htmlStr += '            </div>';
            htmlStr += '        </div>';
            htmlStr += '        <div class="p-3">';
            htmlStr += '            <ul class="post-meta-bottom">';
            htmlStr += '                <li class="post-meta-author">';
            htmlStr += '                    <a class="d-block" href="" target="_blank">';
            if(data[i].user.avatar){
                htmlStr += '                    <img alt="" src="'+ imgUrl + data[i].user.avatar +'" class="avatar avatar-96 photo" height="96" width="96"/> ';
            }else{
                htmlStr += '                    <img alt="" src="' + imgUrl + 'static/picture/avatar_user_1_1494903592-96x96.png' + '" class="avatar avatar-96 photo" height="96" width="96"/> ';
            }
            htmlStr += '                    <span class="d-inline-block">'+ data[i].user.name +'</span>';
            htmlStr += '                    </a>';
            htmlStr += '                </li>';
            htmlStr += '                <li class="post-meta-view pull-right ">';
            htmlStr += '                    <i class="czs-eye-l"></i> ' + data[i].readed_num;
            htmlStr += '                </li>';
            htmlStr += '                <li class="post-meta-comments pull-right ">';
            htmlStr += '                    <i class="czs-comment-l"></i> '+data[i].comment_num;
            htmlStr += '                </li>';
            htmlStr += '                <li class="post-meta-like pull-right ">';
            htmlStr += '                    <i class="czs-heart-l"></i> '+data[i].collect_num;
            htmlStr += '                </li>';
            htmlStr += '            </ul>';
            htmlStr += '        </div>';
            htmlStr += '    </div>';
            htmlStr += '</div>';
        }
        $(".post-wrap").append(htmlStr);
    }


    var handleSearch = function () {
        var searchWrap = $(".search-wrap");
        $(".search-button").on("click", function (e) {
            searchWrap.toggleClass("search-wrap-animate");
            $(".backdrop").toggleClass("backdrop-animate");
            $(this).find("i.czs-search-l").toggleClass("hidden");
            $(this).find("i.czs-close-l").parent().toggleClass("opacity-0 rotate-90");
        });
    };
    var showDescendantMenu = function () {
        // show sub/child/grand menu
        $(".menu-wrap .menu-item-has-children").click(function (e) {
            e.stopPropagation();
            if ($(this).hasClass("active")) {
                $(this).children(".sub-menu").slideUp(300);
                $(this).removeClass("active");
            } else {
                $(this).addClass("active");
                $(this).children(".sub-menu").slideDown(300);
            }
        });

        $('.header-menu .menu-item-has-children').bind({
            mouseenter: function() {
                $(this).children("a").addClass("active");
                $(this).children('.sub-menu').css({
                    'transform': 'scale3d(1,1,1)',
                    'opacity': 1
                });
            },mouseleave: function() {
                $(this).children("a").removeClass("active");
                $(this).children('.sub-menu').css({
                    'transform': 'scale3d(0,0,0)',
                    'opacity': 0
                });
            }
        });
    };
    var showVendor = function () {
        var vendorDom = $(".vendor");
        $(".btn-vendor").click(function () {
            vendorDom.toggleClass("hidden");
        });
    };
    var noticeCarousel = function () {
        var noticeUl = $(".notice-wrap").find("ul");
        var noticeEvent = function () {
            noticeUl.animate({
                "top": "-24px"
            }, 450, function () {
                $(this).css("top", 0);
                $(this).append($(this).find("li:first"));
            });
        };
        var noticeNumbers = noticeUl.find("li").length;
        if (noticeNumbers > 1) {
            setInterval(noticeEvent, 3000);
        }
    };

    var showSidebar = function () {
        $(".menu-button").click(function(){
            if ($(this).find(".nav-bar").hasClass("nav-bar-animate")) {
                $(this).find(".nav-bar").removeClass("nav-bar-animate");
                $(".menu-wrap").removeClass("open-menu-wrap");
                $(".menu-wrap-backdrop").animate({
                    opacity: 0
                }, 430, function(){
                    $(this).remove();
                });
            } else {
                $(this).find(".nav-bar").addClass("nav-bar-animate");
                $(".menu-wrap").addClass("open-menu-wrap");
                $(this).append("<div class='menu-wrap-backdrop fixed-fluid'></div>")
            }
        });
    };

    var showSupport = function () {
        var supportImg = $(".article-support-img");
        $('.article-support-button .btn').bind({
            mouseenter: function(){
                supportImg.show();
                supportImg.animate({
                    bottom: '46px',
                    opacity: 1
                }, 300);
            }, mouseleave: function() {
                supportImg.animate({
                    bottom: '58px',
                    opacity: 0
                }, 300, function(){
                    $(this).hide();
                });
            }
        });
    };

    var showWechat = function () {
        $(".follow-wechat").bind({
            mouseenter: function () {
                $(this).find('.follow-wechat-popup').show();
                $(this).find('.follow-wechat-popup').animate({
                    bottom: '48px',
                    opacity: 1
                }, 300);
            }, mouseleave: function () {
                $(this).find('.follow-wechat-popup').animate({
                    bottom: '58px',
                    opacity: 0
                }, 300, function () {
                    $(this).hide();
                });
            }
        });
    };

    var handleImgBox = function () {
        if (typeof fancyboxSwitcher != 'undefined' && fancyboxSwitcher && !isHomePage) {
            var siteTitle = $("title").html();
            $(".article-body img, .page-common img").not(".gallery-item img").each(function () {
                var alt = this.alt;
                var src = $(this).attr("src");
                if (!alt) {
                    $(this).attr("alt", siteTitle);
                }
                $(this).wrap("<a href='"+ src +"' class='fancybox' rel='fancybox-group' title='"+ alt +"'></a>");
            });

            $(".fancybox").fancybox({
                'padding': 0,
                'opacity': true,
                'cyclic': true
            });
        }
    };
    var handleVideo = function () {
        if ($(window).width() < 576) {
            $(".article-body iframe").each(function () {
                $(this).height(200);
            });
        }
    };
    var setLayoutType = function () {
        $(".layout-type i").click(function () {
            document.cookie = "layout=" + $(this).data("type");
            window.location.reload(true);
        });
    };
    return {
        init: init
    }
})();
blackcandy.init();

var mainWidth = $('#main').innerWidth();
window.onload = function () {
    $(window).trigger("scroll");
};
$(window).resize(function () {
    mainWidth = $('#main').innerWidth();
    $(window).trigger("scroll");
    handleCarousel();
});

$(".vendor-search").click(function () {
    $(".search-button").click();
});

if (isHomePage) {
    var customCarouselDom = $(".custom-carousel");
    customCarouselDom.owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        items: 1,
        responsive: {
            0:{
                items: 1,
                nav: false
            },
            576:{
                items: 2
            },
            992:{
                items: 3,
                nav:true
            }
        }
    });
}
// carousel
handleCarousel();
function handleCarousel() {
    if (carouselSwitcher && isHomePage) {
        var carouselDom = $("#carousel");
        var margin = 0;
        $(".carousel-overlay").css("opacity", parseInt(carouselOpacity) / 100);
        if (carouselType == "slide" || carouselType == "image") {
            if (carouselType == "slide") {
                margin = 15;
            }
            carouselDom.find(".carousel-item").each(function() {
                $(this).innerWidth(mainWidth);
            });
            carouselDom.owlCarousel({
                autoplay: true,
                autoplayTimeout: carouselSpeed,
                smartSpeed: carouselAnimateSpeed,
                loop: true,
                autoplayHoverPause: true,
                navText: '',
                nav : true,
                autoWidth:true,
                center: true,
                margin: margin
            });
        }
        if (carouselType == "one") {
            if (carouselAnimation == "fade") {
                carouselDom.owlCarousel({
                    items: 1,
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: carouselSpeed,
                    smartSpeed: carouselAnimateSpeed,
                    autoplayHoverPause: true,
                    nav : true,
                    navText:'',
                    animateOut: "fadeOut",
                    animateIn: "fadeIn"
                });
            } else {
                carouselDom.owlCarousel({
                    items: 1,
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: carouselSpeed,
                    smartSpeed: carouselAnimateSpeed,
                    autoplayHoverPause: true,
                    nav : true,
                    navText:''
                });
            }

        }

        var carouselNavDom = carouselDom.find(".owl-next, .owl-prev");
        carouselNavDom.addClass("hidden");
        carouselDom.bind({
            mouseenter: function() {
                carouselNavDom.removeClass("hidden");
                $(this).addClass("hover");
            }, mouseleave: function() {
                carouselNavDom.addClass("hidden");
                $(this).removeClass("hover");
            }
        });
    }
}

if (carouselSwitcher && carouselMouseSwitcher) {
    var carouselDom = $("#carousel");
    carouselDom.on('mousewheel', '.owl-stage', function (e) {
        if (e.deltaY>0) {
            carouselDom.trigger('next.owl');
        } else {
            carouselDom.trigger('prev.owl');
        }
        e.preventDefault();
    });
}

// sidebar fixed
var sidebarDom = $('#sidebar');
var affixDom = $(".affix");
var headerH = $('#header').height();
var scrollTop = 0;
var sidebarH = sidebarDom.outerHeight();
var sidebar2Top = sidebarDom.length >= 1 && sidebarDom.offset().top;
var bodyH = $(document).height();

$(window).scroll(function() {
    var sidebarW = sidebarDom.width();
    var footerH = $('#footer').innerHeight();
    var windowH = $(window).height();
    var affixH = affixDom.innerHeight();
    var leftH = (windowH - headerH - affixH - 6) > 0 ? (windowH - headerH - affixH - 6) : 0;
    bodyH = $(document).height();
    scrollTop = $(document).scrollTop();
    if (scrollTop > 1200) {
        $('.scrollTop').addClass("active");
    } else {
        $('.scrollTop').removeClass("active");
    }
    var scrollBottom = bodyH - windowH - scrollTop;
    if (scrollTop > sidebar2Top + sidebarH) {
        if (scrollTop < (bodyH - footerH - windowH + leftH)) {
            affixDom.css({
                position: 'fixed',
                top: '88px',
                bottom: '',
                width: sidebarW + 'px'
            });
        } else {
            affixDom.css({
                position: 'fixed',
                top: '',
                bottom: footerH - scrollBottom,
                width: sidebarW + 'px'
            });
        }
    } else {
        affixDom.css({
            position: '',
            width: sidebarW + 'px'
        });
    }
});
/**
 *
 * @returns {boolean}
 */
$.fn.postLike = function() {
    var id = $(this).data("id"),
        action = $(this).data('action'),
        rateHolder = $(this).children('.count');
    if ($(this).hasClass('done')) {
        $(this).removeClass('done');
        var _this = $(this);
        var ajaxData = {
            action: "subLike",
            um_id: id,
            um_action: action
        };
        $.ajax({
            type: "POST",
            url: siteUrl+"/wp-admin/admin-ajax.php",
            data: ajaxData,
            beforeSend: function () {
                _this.find('i').animate({
                    "fontSize": "15px"
                }, 1, function () {
                    $(this).removeClass("fa-thumbs-up").addClass("fa-thumbs-o-up");
                    $(this).animate({
                        "fontSize": "15px"
                    }, 1);
                });

            },
            success: function(data) {
                $(rateHolder).html(data);
            }
        });
        return false;
    } else {
        $(this).addClass('done');
        var _this = $(this);
        var ajaxData = {
            action: "addLike",
            um_id: id,
            um_action: action
        };
        $.ajax({
            type: "POST",
            url: siteUrl+"/wp-admin/admin-ajax.php",
            data: ajaxData,
            beforeSend: function () {
                _this.find('i').animate({
                    "fontSize": "15px"
                }, 1, function () {
                    $(this).removeClass("fa-thumbs-o-up").addClass("fa-thumbs-up");
                    $(this).animate({
                        "fontSize": "15px"
                    }, 1);
                });

            },
            success: function(data) {
                $(rateHolder).html(data);
            }
        });
        return false;
    }
};
$(document).on("click", ".favorite", function() {
        $(this).postLike();
});

