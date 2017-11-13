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

function routes()
{
    return function () {
        Route::get('/', 'Page@home');
        Route::get('/login', 'Page@login');
        Route::get('/register', 'Page@register');
        Route::get('/purchase', 'Page@purchase');
        Route::get('/user', 'Page@user');
        Route::get('/user-auth', 'Page@userAuth');
        Route::get('/change-pwd/{user_id?}/{method}', 'Page@changePwd');
        Route::get('/email-auth', 'Page@emailAuth');
        Route::get('/pwd-auth', 'Page@pwdFind');
        Route::get('/news/{id}', 'Page@news');
        Route::get('/login/captcha/{tmp}', 'Page@captcha');
    };
}

Route::group(['middleware' => ['lang'], 'namespace' => 'Frontend'], routes());

Route::group(['prefix' => 'cn', 'namespace' => 'Frontend'], routes());

Route::group(['prefix' => 'en', 'namespace' => 'Frontend'], routes());

Route::get('/canvas', function () {
    return view('frontend.canvas');
});


Route::group(['prefix'=>'api','namespace'=>'Api','middleware'=>'VerifyCsrfToken'],function(){
    Route::post('/index','IndexController@index');
    Route::post('/register','RegisterController@register');
    Route::post('/demo','RegisterController@demo_mail');
    Route::post('/login','RegisterController@login');
    Route::post('/forget','RegisterController@forget');
    Route::post('/sendMail','RegisterController@mail');
    Route::post('/login_out','RegisterController@loginout');
    Route::get('/checkMail/{token}','RegisterController@checkMail');
    Route::post('/mail','RegisterController@MoreMail');
    Route::post('/userInfo','UserController@ChangeUserInfo');
    Route::post('/changepwd','UserController@ChangePwd');
    Route::post('/phoneCheck','UserController@UserPhoneCheck');
    Route::post('/suserInfo','UserController@UserInfo');
    Route::post('/code','UserController@code');
    Route::post('/foreign','UserController@Foreign');
    Route::post('/feedback','UserController@feedback');
    Route::post('/registerCheck','RegisterController@registerCheck');
    Route::post('/find-pwd','RegisterController@FindPwd');
    Route::post('/userMail','RegisterController@userMail');

});


Route::group(['prefix'=>'back','namespace'=>'Back'],function(){
    Route::get('/login','LoginController@index');
    Route::post('/login/check','LoginController@check');
    Route::get('/loginout','LoginController@loginout');
});


Route::group(['prefix'=>'back','namespace'=>'Back','middleware'=>'IsLogin'],function(){
    Route::get('/','IndexController@index');
    Route::get('/index/list','IndexController@FeedBackIndex');
    Route::get('/coin/list','CoinController@Clist');
    Route::get('/coin/change','CoinController@change');
    Route::post('/coin/del','CoinController@del');
    Route::get('/coin/edit','CoinController@edit');
    Route::post('/coin/excel','CoinController@excel');
    Route::post('/coin/save','CoinController@save');
    Route::post('/coin/csave','CoinController@csave');
    Route::get('/time/list','TimeController@Tlist');


    Route::get('/time/edit','TimeController@edit');
    Route::post('/time/save','TimeController@save');
    Route::post('/time/del','TimeController@del');

    Route::get('/user/list','UserController@Ulist');
    Route::get('/user/read/{id}','UserController@read');


    Route::get('/blog/list','BlogController@Blist');
    Route::post('/blog/del','BlogController@del');
    Route::get('/blog/edit/{id}','BlogController@edit');
    Route::post('/blog/pic','BlogController@pic');
    Route::post('/blog/save','BlogController@save');
});