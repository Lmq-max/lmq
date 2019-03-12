<?php

namespace App\Http\Controllers\Index;
use App\Http\Controllers\CommonController;
use App\Models\User;
use Illuminate\Http\Request;

class ShopcartController extends CommonController{
    /*展示*/
    public function shopcart(){
        return view('index.shopcart')->with(['show_footer'=>1]);
    }
}