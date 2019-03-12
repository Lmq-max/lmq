<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\CommonController;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Good;
use App\Models\GoodsSku;
use App\Models\Logo;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class IndexController extends CommonController {
    /*首页*/
    public function index(){
        $product_obj=GoodsSku::with('goods')->where(['status'=>4])->paginate();

        return view('index.index',['product_list'=>$product_obj])->with(['title'=>'电商首页1','show_footer'=>1]);
    }
    /*列表展示*/
    public function productlist(){
        $product_obj=GoodsSku::with('goods')->where(['status'=>4])->paginate();

        $view = view('index.list') -> with('product_list' , $product_obj);

        $data['view_content'] = response($view) -> getContent();
        $data['page_count'] = $product_obj -> lastPage();
//dump($data);exit;
        return $data;

    }
    /*详情页*/
    public function shopcontent(){
        $sku_id=request()->get('sku_id');
        if( empty($sku_id)){
          return  $this->fail('要查看的商品的不在');
        }
        $where=[
            'sku_id'=>$sku_id
        ];
        $info=GoodsSku::join('shop_goods','shop_goods_sku.goods_id','=','shop_goods.goods_id')
                ->where($where)
            ->first();
        $product_info=$info->toArray();
        return view('index.shopcontent',['info'=>$product_info]);
    }

    /*分类页*/
    public function allshops(){
        //查询一级分类
        $cate_where=[
            'cate_show'=>1
        ];
        $cate=Category::where($cate_where)->get()->toArray();

        $cateInfo=$this->getIndexCateInfo($cate);
        return view('index.allshops',['cateInfo'=>$cateInfo])->with(['show_footer'=>1]);
    }
    /*分类详情页*/
    public function all_show(Request $request){
        $cate_id=$request->all('cate_id');
        $where=[
            'shop_category.cate_id'=>$cate_id
        ];
        $users =Category::
            join('shop_goods', 'shop_category.cate_id', '=', 'shop_goods.cate_id')
            ->join('shop_goods_sku', 'shop_goods_sku.goods_id', '=', 'shop_goods.goods_id')
            ->select('shop_goods_sku.*', 'shop_goods.goods_img')
            ->where($where)
            ->get()->toArray();
        if(empty($users)){
            return '该分类下货品不存在';
        }

        return view('index.all_show',['users'=>$users])->with(['show_footer'=>1]);
    }

    public function show(){
        $logo=Logo::where('status',1)
        ->orderBy('sort','desc')
        ->get();
        return view('index.show',['logo'=>$logo]);
    }

    public function goodshow(){
        $res=Good::where('id',5)->first();

        return view('index.goodsshow',['res'=>$res]);
    }

    /*我的潮购*/
    public function userpage(){
        return view('index.userpage')->with(['show_footer'=>1]);
    }
    /*编辑资料*/
    public function edituser(){
        return view('index.edituser');
    }
    /*退出登录*/
    public function quit(Request $request){
        $request->session()->forget('user_info');
        return redirect('userpage');
    }
    /*所有商品详情页*/
    public function details(){
        $sku_id=request()->get('sku_id');
        $where=[
            'sku_id'=>$sku_id
        ];
        $info=GoodsSku::join('shop_goods','shop_goods_sku.goods_id','=','shop_goods.goods_id')
            ->where($where)
            ->first();
        $product_info=$info->toArray();
        return view('index.details',['info'=>$product_info]);
    }


}
