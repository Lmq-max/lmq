@extends('admin.layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>分类修改</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h2>---分类添加---</h2>
<form class="layui-form" action="">
    <input type="hidden" name="cate_id" value="{{$data['cate_id']}}">
    <div class="layui-form-item">
        <label class="layui-form-label">分类名称</label>
        <div class="layui-input-block">
            <input type="text" name="cate_name" value="{{$data['cate_name']}}" lay-verify="required" placeholder="请输入标题" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">父类id</label>
            <div class="layui-input-inline">
                <select name="pid" >
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
                <input type="checkbox" name="cate_show" value="{{$data['cate_show']}}" id="cate_show" lay-skin="switch" lay-text="ON|OFF">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">是否在导航栏上展示</label>
            <div class="layui-input-block">
                <input type="checkbox" name="cate_navshow" value="{{$data['cate_navshow']}}" id="cate_navshow" lay-skin="switch"  lay-text="ON|OFF">
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
<script>
    $(function(){
        $.ajaxSetup({ headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        })



        /*是否展示*/
        var cate_show=$('#cate_show').val();
        if(cate_show==1){
            $('#cate_show').attr('checked',true);
        }else{
            $('#cate_show').attr('checked',false);
        }
        /*是否在导航栏展示*/
        var cate_navshow=$('#cate_navshow').val();
        if(cate_navshow==1){
            $('#cate_navshow').attr('checked',true);
        }else{
            $('#cate_navshow').attr('checked',false);
        }


        layui.use(['form','layer'],function(){
            var layer=layui.layer;
            var form=layui.form;

            //监听提交
            form.on('submit(*)', function(data){
                $.ajax({
                    url:"{{url('admin/cateUpdo')}}",
                    data:data.field,
                    dataType:'json',
                    type:'post',
                    success:function(json_info){
                        if(json_info.status==1000){
                            alert('修改成功');
                            location.href="{{url('admin/CategoryList')}}";
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