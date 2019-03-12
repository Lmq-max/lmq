<form action="">

    <table>
        <tr>
            <td>商品名称:</td>
            <td>{{$res['username']}}</td>
        </tr>
        <tr>
            <td>竞拍开始时间:</td>
            <td>{{date("Y-m-d H:i:s",$res['start_time'])}}</td>
        </tr>
        <tr>
            <td>起拍价格:</td>
            <td>{{$res['base_price']}}</td>
        </tr>
        <tr>
            <td>最低加价:</td>
            <td>{{$res['price']}}</td>
        </tr>
        <tr>
            <td>说明:</td>
            <td></td>
        </tr>
        <tr>
            <td>当前状态:</td>
            <td></td>
        </tr>
    </table>
</form>
<hr/>
<form action="">
    <table>
        <tr>
            <td>当前价格</td>
            <td>{{$res['base_price']}}</td>
        </tr>
        <tr>
            <td>价格</td>
            <td><input type="text" placeholder="不低于当前价格"></td>
        </tr>
        <tr>
            <td><input type="button" value="出价"></td>
            <td></td>
        </tr>
    </table>
</form>
