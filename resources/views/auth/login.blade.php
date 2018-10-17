<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="{{ asset('static/login/css/style.css') }}">
</head>

<body>
<div class="login-page">
    <div class="form">
        <form class="register-form" >
            <input name="name" placeholder="用户名">
            <input name="password" type="password" placeholder="密码">
            <input name="mail" placeholder="邮箱">
            <button>注册</button>
            <p class="message">已有账号? <a href="javascript:">立即登录</a></p>
        </form>
        <form class="login-form" method="post" action="{{ url('login') }}">
            {{ csrf_field() }}
            <input name="name" placeholder="用户名">
            <input name="password" type="password" placeholder="密码">
            <button>登录</button>
            <p class="message">还没有账号？<a href="javascript:">立即注册</a></p>
        </form>
    </div>
</div>
<script src="{{ asset('static/js/jquery.min.js') }}"></script>
<script src="{{ asset('static/login/js/index.js') }}"></script>

</body>

</html>