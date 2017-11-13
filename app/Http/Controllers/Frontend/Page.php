<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Api\UserController;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class Page extends Controller
{


    // 首页
    public function home()  {
        //倒计时
        $time = DB::table('time')->where(['is_show'=>1])->first();
        if(empty($time)){
            $time = json_decode('{}');
            $time->start_time = time();
            $time->stop_time = time();
            $time->btc_count = 0;
        }
        $returnTime = date('Y/m/d H:i:s',$time->start_time);
        $begin = false;
        if($time->start_time < time()){
            $returnTime = date('Y/m/d H:i:s',$time->stop_time);
            $begin = true;
        }

        $BlogData   = array_chunk(DB::table('blog')->where(['is_del'=>0])->get()->toArray(),6);
        $BlogCount  = count($BlogData);
        //获取已参与的数量
        $btc = round(DB::table('user_btc')->sum('value'),2);

        //参与人数  和 参与次数
        //立即参与数据
        $person = json_decode('{}');
        $person->count = count(DB::table('user_btc')->groupBy('user_id')->get());
        $person->time = count(DB::table('user_btc')->get());

        //计算完成度
        $sum = DB::table('user_btc')->sum('value');
        if($sum > $time->btc_basic_count){
            $basic = 1;
            $final = floor($sum / $time->btc_count);
        }else{
            $basic = floor($sum / $time->btc_basic_count);
            $final = 0;
        }

        if($basic < 0.01){
            $basic = 0.01;
        }

        if($final<0.01 && $final != 0){
            $final = 0.01;
        }
        $j = [
            'BlogData'  =>$BlogData,
            'BlogCount' =>$BlogCount,
            'time'      =>$returnTime,
            'btc_count' =>$time,
            'btc'       =>$btc,
            'person'    =>$person,
            'basic'=>$basic,
            'final'=>$final,
            'begin'=>$begin
        ];
//        dd($j);
        return view('frontend.pages.home',$j);
    }

    // 注册
    public function register()  {
        return view('frontend.pages.register');
    }

    // 登录
    public function login()  {
        return view('frontend.pages.login');
    }

    // 用户认证
    public function userAuth()  {
        return view('frontend.pages.userAuth');
    }

    public function captcha(){
        $builder = new CaptchaBuilder();
        $builder->build($width = 100, $height = 40, $font = null);
        $phrase = $builder->getPhrase();
        Session::flash('milkcaptcha', $phrase);
//        ob_clean();
        return response($builder->output())->header('Content-type','image/jpeg');
    }


    // 个人中心
    public function user()  {

        //倒计时
        $time = DB::table('time')->where(['is_show'=>1])->first();
        if(empty($time)){
            $time = json_decode('{}');
            $time->start_time = time();
            $time->stop_time = time();
            $time->btc_count = 0;
        }
        $returnTime = date('Y/m/d  H:i:s',$time->start_time);
        //判断认购是否开始
        $begin = false;
        if($time->start_time < time()){

            $returnTime = date('Y/m/d H:i:s',$time->stop_time);
            $begin = true;
        }

        $user_id = session('user_id');
        $UserData = DB::table('user')->where(['id'=>$user_id])->first();

        $User = new UserController();
        if(empty(session('user_id'))){
            return "<script>
            location.href = '/login'; 
</script>";

        }else{
            //以太币总数
            $count = $User->UserInfo(session('user_id')) ;

            $BtcRage = DB::table('coin')->where(['type'=>0])->first();
            $BtcRageCount = $BtcRage->lhb/$BtcRage->coin;

            //认购记录
            $list = DB::table('user_btc')->where(['user_id'=>session('user_id')])->get();
            foreach($list as $k=>$v){
                //计算后的数据取下限
                $v->lhb_count = floor($v->value * $BtcRageCount);
            }


            if($count == 404){
                $user = DB::table('user')->where(['id'=>session('user_id')])->first();

                if(!empty($user->user_unique_eth)){
                    $count = floor($user->btc_count * $BtcRageCount);

                }else{
                    $count = 0;
                }
            }
            //立即参与数据
            $person = json_decode('{}');
            $person->count = count(DB::table('user_btc')->groupBy('user_id')->get());
            $person->time = count(DB::table('user_btc')->get());
            //计算完成度
            $sum = round(DB::table('user_btc')->sum('value'),2);
            if($sum > $time->btc_basic_count){
                $basic = 1;
                $final = $sum / $time->btc_count;
            }else{
                $basic = $sum / $time->btc_basic_count;
                $final = 0;
            }
            if($basic < 0.01){
                $basic = 0.01;
            }

            if($final<0.01 && $final != 0){
                $final = 0.01;
            }
            $can = 0;
            if(!empty($UserData->user_no) && ($UserData->is_check_mail == 1)){
                $can = 1;
            }
            $j = [
                'user'=>$UserData,
                'count'=>$count,
                'time'=>$returnTime,
                'btc_count'=>$time,
                'list'=>$list,
                'person'=>$person,
                'basic'=>$basic,
                'final'=>$final,
                'sum'=>$sum,
                'can'=>$can,
                'begin'=>$begin
            ];

            return view('frontend.pages.user',$j);
        }

    }

    // 邮箱安全验证
    public function emailAuth()  {
        return view('frontend.pages.emailAuth');
    }

    // 认购
    public function purchase()  {
        $UserData = DB::table('user')->where(['id'=>session('user_id')])->first();

        $BtcRage = DB::table('coin')->where(['type'=>0])->first();
        $BtcRageCount = $BtcRage->lhb/$BtcRage->coin;


        $j = [
            'user'=>$UserData,
            'range'=>$BtcRageCount
        ];
        return view('frontend.pages.purchase',$j);
    }

    // 修改密码
    public function changePwd($user_id)  {
        $user_id_use = "";
        if($user_id != "coinlbhchage"){
            $user = explode('!@',$user_id);
            $user_id_use = $user[1];
        }

        $j = [
            'user_id'=>$user_id_use
        ];
        return view('frontend.pages.changePwd',$j);
    }

    public function pwdFind()  {
        return view('frontend.pages.pwdFind');
    }
    // 修改密码
    public function news()  {
        return view('frontend.pages.news');
    }



}
