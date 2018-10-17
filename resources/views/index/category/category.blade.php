@extends('index.main')

@section('title')
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>格局-私人博客 分类</title>
@endsection

@section('style')
@endsection

@section('body')
    <div class="page-category">
        <div class="container-fluid mb-6">
            <div class="row">
                <div class="page-category-img img-response mask" style="background-image: url({{ asset('static/images/c-4.png') }})">
                    <div class="page-category-info">

                        <div class="page-category-description mb-2">
                            {{ $category->name }}
                        </div>

                        <div class="mb-1">
                            {{ $count }} 篇
                        </div>
                        {{--<div class="page-category-title btn-line">--}}
                            {{--创意--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>

        <main class="container">
            <div class="row">
                <div class="archive-body">
                    <div class="row">
                        <div class="post-wrap">
                            @foreach($articles as $article)
                                <div class="col-md-4 col-sm-6">
                                    <div class="post post-style-card">
                                        <a class="post-img img-response gradient-mask"
                                           href=" {{ url('article',['id'=>$article->article_id]) }}"
                                           style="background-image: url({{ asset($article->cover_img) }})">
                                        </a>
                                        <div class="post-top">
                                            <div class="post-title">
                                                <a href="{{ url('article',['id'=>$article->article_id]) }}"> {{ $article->title }} </a>
                                            </div>
                                            <div class="post-top-meta mb-2">
                                            <span class="post-tag">
                                                <i class="czs-bookmark"></i>
                                                <a href='{{ url('category',['id'=>$article->category->category_id]) }}'>{{ $article->category->name}}</a>
                                            </span>
                                                <span class="post-time">
                                                 {{ substr($article->created_at,0,10) }}
                                            </span>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <ul class="post-meta-bottom">
                                                <li class="post-meta-author">
                                                    <a class="d-block"
                                                       href="{{url('user',['id'=>$article->user->id])}}"
                                                       target="_blank">
                                                        <img alt=''
                                                             src="{{ asset($article->user->avatar?:'static/picture/avatar_user_1_1494903592-96x96.png')}}"
                                                             srcset="{{ asset($article->user->avatar?:'static/picture/avatar_user_1_1494903592-96x96.png') }}"
                                                             class='avatar avatar-96 photo' height='96' width='96'/> <span
                                                                class="d-inline-block">{{ $article->user->name }}</span>
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
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="pagination">
                    <span class="more d-inline-block">
                        <a href="javascript:;" data-href="{{ url('article_page') }}?category_id={{ $category->category_id }}" data-type="category" data-page="{{ $next_page }}">加载更多</a>
                    </span>
                </div>
            </div>
        </main>
    </div>
@endsection

@section('script')
@endsection

