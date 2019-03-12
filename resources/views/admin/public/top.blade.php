<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="layui-header">
    <div class="layui-logo">layui 后台布局</div>
    <ul class="layui-nav layui-layout-right">
        <li class="layui-nav-item">
            <a href="javascript:;">
                <img src="{{env('__STATIC__')}}/layui/images/face/7.gif">
                <span></span>
            </a>
            <dl class="layui-nav-child">
                <dd><a href="">基本资料</a></dd>
                <dd><a href="">安全设置</a></dd>
            </dl>
        </li>
        <li class="layui-nav-item"><a href="{:url('Login/quit')}">注销</a></li>
    </ul>
</div>
</body>
</html>