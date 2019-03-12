<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <ul class="layui-nav layui-nav-tree"  lay-filter="test">
            <li class="layui-nav-item layui-nav-itemed">
                <a class="" href="javascript:;">轮播图</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{url('admin/chart')}}">轮播图</a></dd>
                    <dd><a href="{{url('admin/chartshow')}}">展示</a></dd>
                    <dd><a href="{{url('admin/goods')}}">商品添加</a></dd>
                </dl>

            </li>
            <li class="layui-nav-item layui-nav-itemed">
                <a class="" href="javascript:;">分类管理</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{url('admin/Category')}}">分类添加</a></dd>
                    <dd><a href="{{url('admin/CategoryList')}}">分类展示</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item layui-nav-itemed">
                <a class="" href="javascript:;">权限节点</a>
                <dl class="layui-nav-child">
                    <dd><a href="{{url('admin/Power')}}">节点添加</a></dd>
                </dl>
            </li>


        </ul>
    </div>


    <div class="layui-footer">
        <!-- 底部固定区域 -->
        <img src="{{env('__STATIC__')}}/layui/images/face/10.gif">
    </div>

</div>
</body>
</html>



