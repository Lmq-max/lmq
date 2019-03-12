@extends('admin.layout')
@section('content')
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>商品添加</title>
</head>
<body>
<fieldset class="layui-elem-field layui-field-title" >
    <legend>商品添加</legend>
</fieldset>

    <div >

        <div class="layui-form-item" style="width: 300px">
            <label class="layui-form-label">商品名字</label>
            <div class="layui-input-block">
                <input type="text" id="username" lay-verify="username" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item" style="width: 300px">
            <label class="layui-form-label">底价</label>
            <div class="layui-input-block">
                <input type="text" id="base_price" lay-verify="pwd" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item" style="width: 300px">
            <label class="layui-form-label">每次加价</label>
            <div class="layui-input-block">
                <input type="text" id="price" lay-verify="pwd"   class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">竞拍时间</label>
            <div class="layui-input-inline">
                <input type="DATETIME-LOCAL" id="start_time" placeholder="开始时间" class="layui-input">
            </div>
            <div class="layui-form-mid">-----</div>
            <div class="layui-input-inline">
                <input type="DATETIME-LOCAL" id="end_time" placeholder="结束时间" class="layui-input">
            </div>
        </div>
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit lay-filter="*">提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>

    </div>

</body>
</html>
@endsection
<link rel="stylesheet" href="{{env('__STATIC__')}}/layui/css/layui.css">
<script src="{{env('__STATIC__')}}/layui/layui.js"></script>
<script src="{{env('__STATIC__')}}/admins/jquery-3.2.1.min.js"></script>
<script>
    $(function(){
        $.ajaxSetup({ headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        })

            //监听提交
            $('.layui-btn').click(function(){
                var username=$('#username').val();
                var base_price=$('#base_price').val();
                var price=$('#price').val();
                var start_time=$('#start_time').val();
                var end_time=$('#end_time').val();
                $.ajax({
                     url:"{{url('admin/goods')}}",
                    data:'username='+username+'&base_price='+base_price+'&price='+price+'&start_time='+start_time+'&end_time='+end_time,
                    dataType:'json',
                    type:'post',
                    success:function(json_info){
                        if(json_info.status == 1000){
                            alert('添加成功');
                        }
                    }
                })
            });
        })
</script>
