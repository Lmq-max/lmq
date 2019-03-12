@extends('layouts.main')
<link rel="stylesheet" href="{{env('STATIC_URL')}}/css/mui.min_1.css">
<link href="{{env('STATIC_URL')}}/css/comm.css" rel="stylesheet" type="text/css" />
<link href="{{env('STATIC_URL')}}/css/goods.css" rel="stylesheet" type="text/css" />
@section('content')

    <div id="pullrefresh" class="good-list-box  mui-content mui-scroll-wrapper">
        <div class="goodList mui-scroll">
            <ul id="ulGoodsList" class="mui-table-view mui-table-view-chevron">
            @foreach($users as $v)
                <li id="23468">
                    <span class="gList_l fl">
                        <img src="{{env('PUBLIC_URL')}}{{$v['goods_img']}}">
                    </span>
                    <div class="gList_r">
                        <h3 class="gray6"><a href="{{url('details')}}?sku_id={{$v['sku_id']}}">{{$v['sku_name']}}</a></h3>
                        <em class="gray9">价值：￥{{$v['sku_price']}}</em>
                        <div class="gRate">
                            <div class="Progress-bar">
                                <p class="u-progress">
                                    <span style="width: 91.91286930395593%;" class="pgbar">
                                        <span class="pging"></span>
                                    </span>
                                </p>
                                <ul class="Pro-bar-li">
                                    <li class="P-bar01"><em>7342</em>已参与</li>
                                    <li class="P-bar02"><em>7988</em>总需人次</li>
                                    <li class="P-bar03"><em>646</em>剩余</li>
                                </ul>
                            </div>
                            <a codeid="12785750" class="" canbuy="646"><s></s></a>
                        </div>
                    </div>
                </li>
            @endforeach
            </ul>
        </div>
    </div>
    @endsection