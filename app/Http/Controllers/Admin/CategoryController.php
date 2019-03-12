<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\CommonController;
use App\Models\Category;

use App\Models\Goods;
use App\Models\Power;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Pow;

class CategoryController extends CommonController {

    public function category(Request $request){
        if($request->isMethod('post')){
            $info= $request->post();
            if(!isset($info['cate_navshow'])){
                $info['cate_navshow']=0;
            }

            if(!isset($info['cate_show'])){
                $info['cate_show']=0;
            }
            $cate_info=[
                'cate_name'=>$info['cate_name'],
                'cate_show'=>$info['cate_show'],
                'cate_navshow'=>$info['cate_navshow'],
                'pid'=>$info['pid'],
                'cate_time'=>time(),
                'status'=>1
            ];
            $data=Category::insert($cate_info);
            if($data){
               return $this->success();
            }else{
               return  $this->fail('添加失败');
            }
        }else{
            $where=[
                'cate_show'=>1
            ];
            $info=Category::where($where)->get()->toArray();
            $cate_info=$this->getCateInfo($info);
            return view('admin.category.category',['info'=>$cate_info]);
        }

    }


    public function categoryList(){
        $where=[
            'cate_show'=>1
        ];
        $res=Category::where($where)->get()->toArray();
        $info=$this->getCateInfo($res);
        return view('admin.category.categoryList',['info'=>$info]);
    }

    public function cateDel(Request $request){
        $cate_id = $request->post('cate_id');

        //   检测分类下     子分类
        $cate_where=[
            'pid'=>$cate_id
        ];
        $cate_info = Category::where($cate_where)->first();
        if(!empty($cate_info)){
            echo json_encode(['font'=>'此分类下有子分类或商品不能删除','code'=>0]);
            exit;
        }
        //  检测分类下是否有  商品

        $goods_where=[
            'cate_id'=>$cate_id
        ];
        $goods_info =Goods::where($goods_where)->first();
        if(!empty($goods_info)){
            echo json_encode(['font'=>'此分类下有子分类或商品不能删除','code'=>0]);
            exit;
        }

        //   执行删除
        $res =Category::where($goods_where)->delete();
        if($res){
            echo json_encode(['font'=>'删除成功','code'=>1]);
        }else{
            echo json_encode(['font'=>'删除失败','code'=>2]);
        }
    }


    public function cateUp(Request $request){
        $cate_id = $request->post('cate_id');
        $where=[
            'cate_id' =>$cate_id
        ];
        $data=Category::where($where)->first();
        $where=[
            'cate_show'=>1
        ];
        $res=Category::where($where)->get()->toArray();
        $info=$this->getCateInfo($res);
        return view('admin.category.cateUp',['data'=>$data,'info'=>$info]);
    }
    /*执行修改*/
    public function cateUpdo(Request $request){
        $res=$request->post();
        $where=[
            'cate_id'=>$res['cate_id']
        ];
        $rel=Category::where($where)->update($res);
//        dump($rel);exit;
        if($rel){
            return $this->success('');
        }else{
           return  $this->fail('修改失败');
        }
    }
}
