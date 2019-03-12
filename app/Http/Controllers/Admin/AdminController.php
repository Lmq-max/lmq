<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use App\Models\Good;
use App\Models\GoodsSku;
use App\Models\Logo;
use App\Models\v2\Region;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class AdminController extends CommonController {
    public function admin(){
        return view('admin.public.admin');
    }

    public function chart(){
        return view('admin.public.chart');
    }

    /*图片上传*/
    public function chartUpload(){
        $file=request()->file('photo');
        $url_path = 'uploads/photo';
        $rule = ['jpg', 'png', 'gif'];
        if ($file->isValid()) {
            $clientName = $file->getClientOriginalName();
            $tmpName = $file->getFileName();
            $realPath = $file->getRealPath();
            $entension = $file->getClientOriginalExtension();
            if (!in_array($entension, $rule)) {
                return '图片格式为jpg,png,gif';
            }
            $newName = md5(date("Y-m-d H:i:s") . $clientName) . "." . $entension;
            $path = $file->move($url_path, $newName);
            $namePath = $url_path . '/' . $newName;
            $res = ["code"=> 1,"font"=> "上传成功",'src'=>$namePath];
            return json_encode($res);
        }

    }
    /*轮播图添加*/
    public function chartAdd(Request $request){
        if($request->isMethod('post')){
            $title=$request->post('title');
            $sort=$request->post('sort');
            $url=$request->post('url');
            $logo=$request->post('logo');

            $info=[
                'title'=>$title,
                'sort'=>$sort,
                'url'=>$url,
                'img'=>$logo
            ];
            $res=Logo::insert($info);
            dump($res);exit;
        }

    }

    /*图片审核*/
    public function chartshow(){

        $img = Logo::where('status' ,0 ) -> get();

        return view('admin.public.chartshow' , ['logo' => $img]);
    }

    public function adminAudit(Request $request){
        if($request -> isMethod('post')){
            $id = $request -> post('id');

            $res = Logo::where('id' , $id)
                ->update(['status'=> 1 ]);

            if($res){
                return $this->success('成功');
            }else{
                return $this->fail('失败');
            }
        }

    }

    public function goods(Request $request){
        if($request->isMethod('post')){
            $username=$request->post('username');
            $base_price=$request->post('base_price');
            $price=$request->post('price');
            $start_time=$request->post('start_time');
            $end_time=$request->post('end_time');
            $info=[
                'username'=>$username,
                'base_price'=>$base_price,
                'price'=>$price,
                'start_time'=>strtotime($start_time),
                'end_time'=>strtotime($end_time)
            ];
            $res=Good::insert($info);
            if($res){
                return $this->success();
            }else{
                return $this->fail('添加失败');
            }

        }
        return view('admin.public.goods');
    }
}
