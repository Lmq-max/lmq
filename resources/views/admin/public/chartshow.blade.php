@extends('admin.layout')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <table border="1" >
        <tr>
            <td>id</td>
            <td>图片</td>
            <td>审核</td>
        </tr>
        @foreach($logo as $v)
            <tr>
                <td class="id"  >{{$v -> id}}</td>
                <td>
                    <img src="{{env('__STATIC__')}}/{{$v -> img}}" alt="" style="width:100px">
                </td>
                <td>
                    <p class="buss" aid="{{$v -> id}}">通过</p>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

<link rel="stylesheet" href="{{env('__STATIC__')}}/layui/css/layui.css">
<script src="{{env('__STATIC__')}}/layui/layui.js"></script>
<script src="{{env('__STATIC__')}}/admins/jquery-3.2.1.min.js"></script>

<script type="text/javascript">
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.buss').click(function(){
            var id = $(this).attr('aid');
            $.ajax({
                url:"{{url('admin/adminAudit')}}",
                dataType:'json',
                data:"id="+id,
                type:"post",
                success:function(json_info){
                    if(json_info.status == 1000){
                        location.href ="{{'chartshow'}}" ;
                    }
                }
            })
        })
    })

</script>

