@extends('admin.layout')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>分类表格</legend>
</fieldset>

<div class="layui-form">
    <table class="layui-table">
        <thead>
        <tr>
            <th>分类id</th>
            <th>分类名称</th>
            <th>时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($info as $user)
        <tr class="showHide" pid="{{$user['pid']}}" cate_id="{{$user['cate_id']}}" style="display: none;">
            <td>
                {{str_repeat('-',$user['level']*2)}}
                <a href="javascript:;" class="showCate">+</a>
                {{$user['cate_id']}}
            </td>
            <td>
                {{str_repeat('-',$user['level']*2)}}
                <span class="showInput">{{$user['cate_name']}}</span>
                <input class="change" style="display: none;" type="text" column="cate_name" cate_id="{{$user['cate_id']}}" value="{{$user['cate_name']}}">
            </td>
            <td>{{date("Y-m-d H:i:s",$user['cate_time'])}}</td>
            <td>
                <a href="{{url('admin/cateUp')}}?cate_id={{$user['cate_id']}}" cate_id="{{$user['cate_id']}}" pid="{{$user['pid']}}">编辑</a>
                <button class="layui-btn layui-btn-xs" lay-event="del" name="del" cate_id="{{$user['cate_id']}}" pid="{{$user['pid']}}">删除</button>
            </td>

        </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script>
    $(function(){

        $.ajaxSetup({ headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        })
        layui.use(['layer','table'],function(){
            var layer=layui.layer;
            var table=layui.table;
            /*删除*/
            $("button[name='del']").click(function(){
                var _this = $(this);
                var cate_id = $(this).attr('cate_id');
                $.post("{{url('admin/cateDel')}}",{cate_id:cate_id},function(msg){
                    layer.msg(msg.font,{icon:msg.code})
                    if(msg.code==1){
                        _this.parents('tr').remove();
                    }
                },'json')
            })




            showTr(0);
            //展示
            function showTr(cate_id){
                var _tr=$('.showHide');
                _tr.each(function(index){
                    if($(this).attr('pid')==cate_id){
                        $(this).show();
                    }
                })
            }
            //隐藏
            function hideTr(cate_id){
                var _tr=$('.showHide');
                _tr.each(function(index){
                    var pid=$(this).attr('pid');
                    if(pid==cate_id){
                        var new_cateId=$(this).attr('cate_id');
                        hideTr(new_cateId);
                        $(this).hide();
                    }
                })
            }

            //给超链接绑定点击事件
            $('.showCate').click(function(){
                //获取当前对象的文本值  +  -
                var sign=$(this).html();
                //获取当前分类的id
                var cate_id=$(this).parents('tr').attr('cate_id');
                if(sign=='+'){
                    //展示此分类的子类
                    showTr(cate_id);
                    $(this).html('-');
                }else{
                    //隐藏此分类的子类
                    hideTr(cate_id);
                    $(this).html('+');
                }
            });

            //给showInput绑定点击事件
            $('.showInput').click(function(){
                $(this).next('input').show();
                $(this).hide();
            });

            //文本框绑定失去焦点事件
            $('.change').blur(function(){
                var column=$(this).attr('column');
                var cate_id=$(this).attr('cate_id');
                var _value=$(this).val();
                var _this=$(this);
                $.post(
                    "{:url('Category/cateChange')}",
                    {column:column,cate_id:cate_id,value:_value},
                    function(msg){
                        layer.msg(msg.font,{icon:msg.code});
                        if(msg.code==1){
                            _this.hide();
                            _this.prev('span').html(_value);
                            _this.prev('span').show();
                        }
                    },
                    'json'
                )




            })

        })
    })
</script>
@endsection

