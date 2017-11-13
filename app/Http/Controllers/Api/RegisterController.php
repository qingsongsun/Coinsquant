<?php
/**
 * Created by PhpStorm.
 * User: baimifan-pc
 * Date: 2017/8/22
 * Time: 14:38
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller {

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * author hongwenyang
     * method description : 注册
     * param: user_name user_mail user_pwd
     */

    public function register(Request $request){
        $RequestData             = $request->except('s');
        $checkName = DB::table('user')->where(['user_name'=>$RequestData['user_name']])->first();
        if($checkName){
            $retJson['code'] = 403;
            $retJson['msg'] = '用户名已存在';
        }else{
            $checkMail = DB::table('user')->where(['user_mail'=>$RequestData['user_mail']])->first();
            if(empty($checkMail)){
                $RequestData['user_pwd'] = sha1($RequestData['user_pwd']);
                $s = DB::table('user')->insertGetId($RequestData);
                $this->mail($RequestData['user_mail'],$s,0);
                if($s){
                    $request->session()->put('user_id',$s);
                    $retJson['code'] = 200;
                    $retJson['msg'] = '邮件发送成功';
                }else{
                    $retJson['code'] = 404;
                    $retJson['msg'] = '邮件发送失败';
                }
            }else{
                $retJson['code'] = 402;
                $retJson['msg'] = '该邮箱已被注册';
            }
        }

        return response()->json($retJson);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * author hongwenyang
     * method description : 发送邮箱
     * param :user_id mail
     */

    public function mail($mail,$user_id,$type){

        if($type == 1){
            //找回密码需要找到对应的用户ID
            $user_id = DB::table('user')->where(['user_mail'=>$mail])->value('id');
        }
        $user = $user_id.'@'.sha1($mail).$type."_".rand(1000,9999);
        $email = config('app.url').'api/checkMail/'.$user;

        $s = Mail::to($mail)->send(new Reminder($email,$type));

        if($s == NULL){
            //过期时间 15分钟
            $insert['token_extime'] = time()+60*15;
            $insert['url']          = '/api/checkMail/'.$user;
            $insert['type']         = $type;
            DB::table('mail')->insert($insert);
            $retJson['code'] = 200;
            $retJson['msg']  = '邮件发送成功';
        }else{
            $retJson['code'] = 404;
            $retJson['msg']  = '邮件发送失败';
        }

        return response()->json($retJson);
    }


    public function MoreMail(Request $request){
        $MailData = $request->except('s');
        if(empty($MailData['captcha'])){
            $retJson = $this->CheckMailTime($MailData);
        }else{
            if(Session::get('milkcaptcha')!=$MailData['captcha']){
                $retJson['code'] = 405;
                $retJson['msg']  = '验证码不正确';
            }else{
                $retJson = $this->CheckMailTime($MailData);
            }
        }

        return response()->json($retJson);
    }

    public function CheckMailTime($MailData){
        $t = time();
        $MIN = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
        $MAX = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t));
        $IsOut = DB::table('find_mail')->where(['ip'=>$MailData['ip']])->whereBetween('create_time',["$MIN","$MAX"])->count();

            $isHave = DB::table('user')->where(['user_mail'=>$MailData['user_mail']])->first();
            if($isHave){
                $this->mail($MailData['user_mail'],session('user_id'),1);
                $retJson['code'] = 200;
                $retJson['msg']  = '邮件发送成功';
            }else{
                if($IsOut >= 3){
                    $retJson['code'] = 402;
                    $retJson['msg']  = '当天请求次数超过3次';
                }else{
                    $retJson['code'] = 403;
                    $retJson['msg']  = '该邮箱暂未注册';
                    //保存数据
                    DB::table('find_mail')->insert([
                        'ip'=>$MailData['ip'],
                        'email'=>$MailData['user_mail'],
                        'create_time'=>time()
                    ]);
                }
            }


        return $retJson;
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * author hongwenyang
     * method description :method description : 验证地址
     */

    public function checkMail(Request $request){
        $data = $request->all();
        $email = explode('@',substr($data['s'], 15));
        $map['id'] = $email[0];
        $Email = explode('_',$email[1]);
//        //邮件类型
        $type      = substr($Email[0],-1);
//        //邮箱
        $Cmail     = $Email[0];

        $check = DB::table('mail')->where(['url'=>$data['s'],'is_use'=>0])->first();

        if($check){
            $time = time();

            if($time > $check->token_extime){
                $retJson['code'] = 403;
                $retJson['msg']  = '链接已过期';
            }else{
                //注册
                if($type == 0){
                    DB::table('user')->where($map)->update([
                        'is_check_mail'=>1
                    ]);
                    DB::table('mail')->where(['url'=>$data['s']])->update([
                        'is_use'=>1
                    ]);
                    $retJson['code'] = 200;
                    $retJson['msg']  = '邮件验证成功';

                    return redirect('/login');
                }else if($type == 1){
                    //找回密码
                    $Umail = DB::table('user')->where($map)->value('user_mail');
                    if(empty($Umail)){
                        $retJson['code'] = 402;
                        $retJson['msg']  = '该用户暂未绑定邮箱';
                    }else if(sha1($Umail).$type != $Cmail){
                        $retJson['code'] = 401;
                        $retJson['msg']  = '该用户暂未绑定邮箱';
                    }else{
                        $retJson['code'] = 200;
                        $retJson['msg']  = '邮件验证成功';
                        DB::table('mail')->where(['url'=>$data['s']])->update([
                            'is_use'=>1
                        ]);
                        //处理user_id
                        $user_id = sha1('user_id').'12!@'.$map['id'];
                        $url = "/change-pwd/$user_id/method";
                        //跳转至忘记密码页面
                        return redirect($url);
                    }
                }else{
                    DB::table('user')->where($map)->update([
                        'is_check_mail'=>1
                    ]);
                    $retJson['code'] = 200;
                    $retJson['msg']  = '邮件验证成功';
                    DB::table('mail')->where(['url'=>$data['s']])->update([
                        'is_use'=>1
                    ]);
                    return redirect('/user');
                }
            }
        }else{
            return redirect('/');
        }

        return response()->json($retJson);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * author hongwenyang
     * method description : 登录
     * param: account 账号  user_pwd 密码
     */

    public function login(Request $request){
        $LoginData = $request->except('s');

        $UserData =  DB::table('user')->where(['user_name'=>$LoginData['account']])
                                        ->orWhere(['user_mail'=>$LoginData['account']])
                                        ->orWhere(['user_phone'=>$LoginData['account']])->first();


        if(Session::get('milkcaptcha')!=$LoginData['captcha']){
            $retJson['code'] = 402;
            $retJson['msg']  = '验证码不正确';
        }else{
            if(empty($UserData)){
                $retJson['code'] = 404;
                $retJson['msg']  = '用户未注册';
            }else{
                if(sha1($LoginData['user_pwd']) == $UserData->user_pwd){
                    $request->session()->put('user_id',$UserData->id);
//                    session(['user_id' => $UserData->id]);
//                    dd(session('user_id'));
                    $retJson['code'] = 200;
                    $retJson['msg']  = '登录成功';
                }else{
                    $retJson['code'] = 403;
                    $retJson['msg']  = '密码错误';
                }
            }
        }
        return response()->json($retJson);
    }


    public function forget(Request $request){
        $ForgetData = $request->except('s');
        $s = $this->mail($ForgetData['user_mail'],$ForgetData['user_id'],1);

        if($s->original['code']){
            $retJson['code'] = 200;
            $retJson['msg']  = '邮件发送成功';
        }else{
            $retJson['code'] = 403;
            $retJson['msg']  = '邮件发送失败';
        }

        return response()->json($retJson);
    }

    /**
     * @param Request $request
     * @return mixed
     * author hongwenyang
     * method description : 退出
     */

    public function loginout(Request $request){
        $request->session()->put('user_id','');
        $retJson['code'] = 200;
        $retJson['msg']  = '退出成功';
        return $request->json($retJson);
    }


    public function registerCheck(Request $request){
        $data = $request->except('s');
        switch ($data['type']){
            case 1:
                $map['user_name'] = $data['value'];
                break;
            case 2:
                $map['user_mail'] = $data['value'];
                break;
        }
        $checkData = DB::table('user')->where($map)->first();
        if(!empty($checkData)){
            $retJson['code'] = 404;
            $retJson['msg'] = "数据重复";
        }else{
            $retJson['code'] = 200;
            $retJson['msg'] = "通过";
        }

        return response()->json($retJson);
    }


    public function demo_mail(){
        Mail::to('792528966@qq.com')->send(new Reminder(1,1000));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * author hongwenyang
     * method description : 找回密码
     */

    public function FindPwd(Request $request){
        $FindData = $request->except('s');
        $data = DB::table('user')->where($FindData)->first();
        if($data){
            DB::table('user')->where($FindData)->update([
                'user_pwd'=>sha1('123456')
            ]);
            $request->session()->put('user_id',$data->id);
            $retJson['code'] = 200;
            $retJson['msg'] = "密码找回成功";
        }else{
            $retJson['code'] = 404;
            $retJson['msg'] = "用户信息未找到";
        }

        return response()->json($retJson);
    }


    public function userMail(){
        $user_id = session('user_id');
        $userMail = DB::table('user')->where(['id'=>$user_id])->value('user_mail');
        $s= $this->mail($userMail,$user_id,2);
        if($s){
            $retJson['code'] = 200;
            $retJson['msg'] = "邮箱发送成功";
        }else{
            $retJson['code'] = 404;
            $retJson['msg'] = "邮箱发送失败";
        }

        return response()->json($retJson);
    }
}