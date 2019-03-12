@extends('layouts.main')
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black" />
    <meta name="format-detection" content="telephone=no" />
    <meta charset="utf-8">
    <title>所有分类</title>
    <link rel="stylesheet" type="text/css" href="http://cdn.bootcss.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{env('STATIC_URL')}}/allshops/css/swiper-3.2.5.min.css" />
    <link rel="stylesheet" href="{{env('STATIC_URL')}}/allshops/css/ectouch.css" />
    <link rel="stylesheet" href="{{env('STATIC_URL')}}/allshops/css/search.css" />
</head>
<body style="max-width:640px;font-size: 14px;">
@section('content')
<div id="loading"><img src="{{env('STATIC_URL')}}/allshops/images/loading.gif" /></div>
<div class="con">
    <div class="category-top">
        <header>
            <section class="search">
                <div class="text-all dis-box j-text-all">
                    <div class="box-flex input-text"> <a class="a-search-input j-search-input" href="javascript:void(0)"></a>
                        <input type="text" placeholder="商品搜索" />
                        <i class="iconfont icon-guanbi is-null j-is-null"></i> </div>
                </div>
            </section>
        </header>
    </div>
    <aside>
        <div class="menu-left scrollbar-none" id="sidebar">
            <ul>
                @foreach($cateInfo as $user)
                <li  class="active">{{$user['cate_name']}}</li>
                @endforeach
            </ul>
        </div>
    </aside>
    @foreach($cateInfo as $v)
    <section class="menu-right padding-all j-content" style="display:none">
        @foreach($v['son'] as $vv)
        <h5>{{$vv['cate_name']}}/车品</h5>
        <ul>
            @foreach($vv['son'] as $vvv)
            <li class="w-3">
                <a href="{{url('all_show')}}?cate_id={{$vvv['cate_id']}}"></a>
                <img src="{{env('STATIC_URL')}}/allshops/images/tp.png" />
                <span>{{$vvv['cate_name']}}</span>
            </li>
            @endforeach
        </ul>
            @endforeach
    </section>
    @endforeach
</div>
<div class="search-div j-search-div ts-3">
    <section class="search">
        <form action="/index.php?m=default&c=category&a=index&u=0" method="post">
            <div class="text-all dis-box j-text-all">
                <div class="box-flex input-texts">
                    <input class="j-input-text" type="text" name="keywords" placeholder="请输入搜索关键词！" />
                    <i class="iconfont icon-guanbi is-null j-is-null"></i> </div>
                <button type="submit" class="btn-submit">搜索</button>
            </div>
        </form>
    </section>
    <section class="search-con">
        <div class="swiper-scroll history-search">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <p>
                        <label class="fl">热门搜索</label>
                    </p>
                    <ul class="hot-search a-text-more">
                        <li class="w-3"><a href="#"><span>美国</span></a></li>
                        <li class="w-3"><a href="#"><span>新生婴儿</span></a></li>
                    </ul>
                    <p class="hos-search">
                        <label class="fl">最近搜索</label>
                        <span class="fr" onClick="javascript:clearHistroy();"><i class="fr"></i></span> </p>
                    <ul class="hot-search a-text-more a-text-one" id="search_histroy">
                    </ul>
                </div>
            </div>
            <div class="swiper-scrollbar"></div>
        </div>
    </section>
    <footer class="close-search j-clse-search"> 点击关闭 </footer>
</div>
@endsection
<script type="text/javascript">
    //设置cookie
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    }
    function clearHistroy(){
        setCookie('ECS[keywords]', '', -1);
        document.getElementById("search_histroy").style.visibility = "hidden";
    }
</script>
<script type="text/javascript" src="{{env('STATIC_URL')}}/allshops/js/jquery.min.js"></script>
<script type="text/javascript" src="{{env('STATIC_URL')}}/allshops/js/swiper-3.2.5.min.js"></script>
<script type="text/javascript" src="{{env('STATIC_URL')}}/allshops/js/ectouch.js"></script>
<script type="text/javascript" src="{{env('STATIC_URL')}}/allshops/js/jquery.json.js"></script>
<script type="text/javascript" src="{{env('STATIC_URL')}}/allshops/js/common.js"></script>
<script type="text/javascript">
    $(function($){
        $('#sidebar ul li').click(function(){
            $(this).addClass('active').siblings('li').removeClass('active');
            var index = $(this).index();
            $('.j-content').eq(index).show().siblings('.j-content').hide();
        })
    })
</script>
</body>
</html>