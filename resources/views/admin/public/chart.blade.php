@extends('admin.layout')
@section('content')
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>轮播图添加</title>
</head>
<body>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>轮播图添加</legend>
</fieldset>

    <div style="width: 600px;">

        <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" id="title" lay-verify="username" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">链接</label>
            <div class="layui-input-block">
                <input type="text" id="url" lay-verify="pwd" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-block">
                <input type="text" id="sort" lay-verify="pwd"   class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <div class="layui-inline">
                <label class="layui-form-label">轮播图</label>
                <input type="hidden" name="" id="logo">

                <button type="button" class="layui-btn" id="test1">
                    <i class="layui-icon">&#xe67c;</i>上传图片
                </button>

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
        layui.use(['form','layer','upload'],function() {
            var layer = layui.layer;
            var form = layui.form;
            var upload = layui.upload;

            //执行实例
            var uploadInst = upload.render({
                elem: '#test1' //绑定元素
                ,url: "{{url('admin/chartUpload')}}" //上传接口
                ,field:'photo'
                ,done: function(res, index, upload){ //上传后的回调
                    layer.msg(res.font,{icon:res.code});
                    if(res.code==1){
                        $('#logo').val(res.src);
                    }
                }

            });

            //监听提交
            $('.layui-btn').click(function(){
                var sort=$('#sort').val();
                var logo=$('#logo').val();
                var title=$('#title').val();
                var url=$('#url').val();
                $.ajax({
                     url:"{{url('admin/chartAdd')}}",
                    data:'sort='+sort+'&title='+title+'&url='+url+'&logo='+logo,
                    dataType:'json',
                    type:'post',
                    success:function(json_info){
                        if(json_info.status==1000){
                            location.href="{{url('admin/chartshow')}}"
                        }
                    }
                })
            });
        })
    })
</script>
