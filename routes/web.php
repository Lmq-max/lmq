<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*验证码*/
Route::any('captcha-test', function()
{
    if (Request::getMethod() == 'POST')
    {
        $rules = ['captcha' => 'required|captcha'];

        $validator = \Illuminate\Support\Facades\Validator::make(\Illuminate\Support\Facades\Input::all(), $rules);
        if ($validator->fails())
        {
            echo '<p style="color: #ff0000;">Incorrect!</p>';
        }
        else
        {
            echo '<p style="color: #00ff30;">Matched :)</p>';
        }
    }
    $form = '<form method="post" action="captcha-test">';
    $form .= '<input type="hidden" name="_token" value="' . csrf_token() . '">';
    $form .= '<p>' . captcha_img() . '</p>';
    $form .= '<p><input type="text" name="captcha"></p>';
    $form .= '<p><button type="submit" name="check">Check</button></p>';
    $form .= '</form>';
    return $form;
});
Route::group(['namespace' => 'Index'], function(){
    // 默认访问index控制器下的index方法
    /*首页*/
    Route::get('/', [
        'as' => 'index', 'uses' => 'IndexController@index'
    ]);
    Route::get('/index', [
        'as' => 'index', 'uses' => 'IndexController@index'
    ]);
    /*流加载*/
    Route::any('/productlist', [
        'as' => 'productlist', 'uses' => 'IndexController@productlist'
    ]);
    /*登录*/
    Route::any('/login', [
        'as' => 'login', 'uses' => 'AccountController@login'
    ]);
    /*注册*/
    Route::any('/register', [
        'as' => 'register', 'uses' => 'AccountController@register'
    ]);

    Route::any('/regauth', [
        'as' => 'regauth', 'uses' => 'AccountController@regauth'
    ]);
    Route::any('/sendCode', [
        'as' => 'sendCode', 'uses' => 'AccountController@sendCode'
    ]);
    Route::any('/regauths', [
        'as' => 'regauths', 'uses' => 'AccountController@regauths'
    ]);
    Route::any('/shopcontent', [
        'as' => 'shopcontent', 'uses' => 'IndexController@shopcontent'
    ]);
    Route::any('/allshops', [
        'as' => 'allshops', 'uses' => 'IndexController@allshops'
    ]);

    Route::any('/show', [
        'as' => 'show', 'uses' => 'IndexController@show'
    ]);
    Route::any('/goodshow', [
        'as' => 'goodshow', 'uses' => 'IndexController@goodshow'
    ]);
    Route::any('/userpage', [
        'as' => 'userpage', 'uses' => 'IndexController@userpage'
    ]);
    Route::any('/all_show', [
        'as' => 'all_show', 'uses' => 'IndexController@all_show'
    ]);
    /*编辑资料*/
    Route::any('/edituser', [
        'as' => 'edituser', 'uses' => 'IndexController@edituser'
    ]);
    /*退出登录*/
    Route::any('/quit', [
        'as' => 'quit', 'uses' => 'IndexController@quit'
    ]);
    /*所有商品详情页*/
    Route::any('/details', [
        'as' => 'details', 'uses' => 'IndexController@details'
    ]);
    /*购物车*/
    Route::any('/shopcart', [
        'as' => 'shopcart', 'uses' => 'ShopcartController@shopcart'
    ]);




});


//后台路由组 控制器在 "App\Http\Controllers\Admin" 命名空间下
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
    // 后台的首页
    Route::get('/', [
        'as' => 'Admin', 'uses' => 'AdminController@admin'
    ]);
    Route::any('/chart', [
        'as' => 'chart', 'uses' => 'AdminController@chart'
    ]);
    Route::any('/chartUpload', [
        'as' => 'chartUpload', 'uses' => 'AdminController@chartUpload'
    ]);
    Route::any('/chartAdd', [
        'as' => 'chartAdd', 'uses' => 'AdminController@chartAdd'
    ]);
    Route::any('/chartshow', [
        'as' => 'chartshow', 'uses' => 'AdminController@chartshow'
    ]);
    Route::any('/adminAudit', [
        'as' => 'adminAudit', 'uses' => 'AdminController@adminAudit'
    ]);
    Route::any('/goods', [
        'as' => 'goods', 'uses' => 'AdminController@goods'
    ]);

    Route::any('/Power', [
        'as' => 'Power', 'uses' => 'PowerController@power'
    ]);
    Route::any('/Category', [
        'as' => 'Category', 'uses' => 'CategoryController@Category'
    ]);

    Route::any('/CategoryList', [
        'as' => 'CategoryList', 'uses' => 'CategoryController@CategoryList'
    ]);
    /*分类删除*/
     Route::any('/cateDel', [
         'as' => 'cateDel', 'uses' => 'CategoryController@cateDel'
     ]);
    /*分类修改*/
    Route::any('/cateUp', [
        'as' => 'cateUp', 'uses' => 'CategoryController@cateUp'
    ]);
    /*执行修改*/
    Route::any('/cateUpdo', [
        'as' => 'cateUpdo', 'uses' => 'CategoryController@cateUpdo'
    ]);




});