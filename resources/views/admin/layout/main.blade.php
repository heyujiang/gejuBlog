<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>格局-个人博客</title>
    <link rel="stylesheet" href="{{ asset('static/admin/layui/css/layui.css') }}">
    <link rel="stylesheet" href="{{ asset('static/admin/static/css/style.css') }}">
    <link rel="icon" href="{{ asset('static/admin/static/image/logo.jpg') }}">
    <script type="text/javascript" src="{{ asset('static/admin/layui/layui.all.js') }}"></script>
    <script type="text/javascript" src="{{ asset('static/admin/plugins/echarts/echarts.min.js') }}"></script>
    @section('style')
    @show
</head>
    @section('body')
    @show
</html>