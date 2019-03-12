<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController;
use App\Models\Power;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Pow;

class PowerController extends CommonController {


    public function power(Request $request){
        if($request->isMethod('post')){
           $info= $request->post();
           $where=[
               'status'=>1,
               'node_name'=>$info['node_name']
           ];

           $res=Power::where($where)->first();

           if(!empty($res)){
               return $this->fail('分类已存在');
           }
           if($info['pid']==0){
               $info['level']=1;
           }else{
               $info['level']=2;
           }
            $info['ctime']=time();
           $data=Power::insert($info);
           if($data){
              return $this->success();
           }else{
               return $this->fail('添加失败');
           }
        }else{
            $where=[
                'status'=>1,
                'pid'=>0
            ];
            $res=Power::where($where)->get()->toArray();
            return view('admin.power.powers',['res'=>$res]);
        }


    }


}
