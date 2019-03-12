@extends('admin.layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>分类添加</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h2>---分类添加---</h2>
<form class="layui-form" action="">
    <div class="layui-form-item">
        <label class="layui-form-label">分类名称</label>
        <div class="layui-input-block">
            <input type="text" name="cate_name"  placeholder="请输入标题" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">父类id</label>
            <div class="layui-input-inline">
                <select name="pid">

                    <option value="">--请选择--</option>
                    @foreach($info as $v)
                    <option value="{{$v['cate_id']}}">{{str_repeat('-',$v['level']*2)}}{{$v['cate_name']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">是否展示</label>
            <div class="layui-input-block">
                <input type="checkbox" name="cate_show" value="1" lay-skin="switch" lay-text="ON|OFF">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">是否在导航栏上展示</label>
            <div class="layui-input-block">
                <input type="checkbox" name="cate_navshow" value="1" lay-skin="switch"  lay-text="ON|OFF">
            </div>
        </div>
    </div>
    <div class="layui-input-block">
        <button class="layui-btn" lay-submit lay-filter="*">提交</button>
        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
</form>
</body>
</html>
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

        layui.use(['form','layer'],function(){
            var layer=layui.layer;
            var form=layui.form;

            form.on('submit(*)', function(data){

                $.ajax({
                    url:"{{url('admin/Category')}}",
                    data:data.field,
                    dataType:'json',
                    type:'post',
                    success:function(json_info){
                        if(json_info.status==1000){
                            alert('添加成功');
                            location.href="{{url('admin/CategoryList')}}"
                        }else{
                            alert(json_info.data);
                        }
                    }
                });
                return false;
            });



        })


    })

</script>
@endsection