@extends('index.main')

@section('title')
    <meta name="keywords" content="">
    <meta name="description" content="">
    <title>格局-私人博客 分类</title>
@endsection

@section('style')
@endsection

@section('body')
    <main class="container pt-6" id="main">
        <div class="page-tags page-common row">
            <h1 class="page-title">标签云</h1>
            @foreach($tags as $tag)
                <a href="{{ url('tag',['id'=>$tag->tag_id]) }}" class="tag-cloud-link tag-link-6 tag-link-position-1" style="font-size: 8pt;" >{{ $tag->name }}</a>
            @endforeach
            {{--<a href="http://heitang.chuangzaoshi.com/archives/tag/apple" class="tag-cloud-link tag-link-7 tag-link-position-2" style="font-size: 8pt;" aria-label="Apple (6个项目)">Apple</a>--}}
    </main>
@endsection

@section('script')
@endsection

