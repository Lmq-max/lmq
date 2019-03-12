<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>layout 后台大布局 - Layui</title>
    <link rel="stylesheet" href="{{env('__STATIC__')}}/layui/css/layui.css">
    <script src="{{env('__STATIC__')}}/layui/layui.js"></script>
    <script src="{{env('__STATIC__')}}/admins/jquery-3.2.1.min.js"></script>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">

    <!-- 头部导航区域（可配合layui已有的垂直导航） -->
    @include ('admin.public.top')

    <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
    @include ('admin.public.left')

    <!-- 内容主体区域 -->
    <div class="layui-body">
        <div style="padding: 15px;width:1000px;">
            @section('content')

            @show
        </div>
    </div>

</div>

<script>
    //JavaScript代码区域
    layui.use(['element'], function(){
        var element = layui.element;
    });
</script>
</body>
</html>