﻿@extends('index.main')

@section('title')
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>格局-私人博客 分类</title>
@endsection

@section('style')
@endsection

@section('body')
    <main class="container pt-6" id="main">
        <div class="row">
            <section class="search-title">
                <h3 class="page-title">搜索：{{ $title }}</h3>
            </section>
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
                                            @if(!empty($article->tags[0]))
                                                <i class="czs-tag-l"></i>
                                                <a href='{{ url('tag',['id'=>$article->tags[0]->tag_id]) }}'>{{ $article->tags[0]->name}}</a>
                                            @endif
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
            <div class="container">
                <div class="row">
                    <div class="pagination">
                        <span class="more d-inline-block">
                            <a href="javascript:;" data-href="{{ url('article_page') }}?title={{ $title }}" data-type="title" data-page="{{ $next_page }}">加载更多</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('script')
@endsection

