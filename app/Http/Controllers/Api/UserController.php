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

class UserController extends Controller {

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * author hongwenyang
     * method description : 保存资料
     * param:user_id nickName user_pic
     */

    public function ChangeUserInfo(Request $request){
        $ChangeUserInfo = $request->except('s');
        if(!empty($ChangeUserInfo['user_pic'])){
            $user_pic = $request->file('user_pic')->store('imgs','img');
        }

        $ChangeUserInfo['user_pic'] = empty($user_pic) ? DB::table('user')->where(['id'=>$ChangeUserInfo['user_id']])
            ->value('user_pic') : '/uploads/'.$user_pic;
        $map['id'] = $ChangeUserInfo['user_id'];
        unset($ChangeUserInfo['user_id']);
        $s = DB::table('user')->where($map)->update($ChangeUserInfo);

        if($s){
            $retJson['code'] = 200;
            $retJson['msg']  = '资料保存成功';
        }else{
            $retJson['code'] = 404;
            $retJson['msg']  = '资料保存失败';
        }
        return response()->json($retJson);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * author hongwenyang
     * method description : 修改密码
     * param:user_id  old_pwd  new_pwd
     */

    public function ChangePwd(Request $request){
        $PwdData = $request->except('s');
        if($PwdData['oldpassword'] != "HeIsNoOldPassWord"){
            $IsOldPassword = DB::table('user')->where(['id'=>session('user_id'),'user_pwd'=>sha1($PwdData['oldpassword'])])->first();
            if(!empty($IsOldPassword)){
                DB::table('user')->where(['id'=>session('user_id')])->update([
                    'user_pwd'=>sha1($PwdData['password'])
                ]);
                $retJson['code'] = 200;
                $retJson['msg']  = '修改成功';
            }else{
                $retJson['code'] = 403;
                $retJson['msg']  = '旧密码输入错误';
            }

        }else{
            DB::table('user')->where(['id'=>$PwdData['user_id']])->update([
                'user_pwd'=>sha1($PwdData['password'])
            ]);
            $retJson['code'] = 400;
            $retJson['msg']  = '修改成功';
        }
        return response()->json($retJson);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * author hongwenyang
     * method description : 我的资料
     * param: user_id
     */

    public function UserInfo($user_id){
        $UserData = $user_id;
        //用户个人资料
        $data = DB::table('user')->where(['id'=>$UserData])->select('user_name','user_unique_eth','user_unique_eth','is_check_mail')->first();

        $BtcRage = DB::table('coin')->where(['type'=>0])->first();

        $BtcRageCount = $BtcRage->lhb/$BtcRage->coin;
        if($data->user_unique_eth == 0){
            return 0;
        }else{
            //获取用户上一次查询的时间戳
            $user_search_time = DB::table('user')->where(['id'=>$user_id])->first();
            if(time() - $user_search_time->user_search_time < 120){
                $user_search_time->btc_count = $user_search_time->btc_count * $BtcRageCount;
                return floor($user_search_time->btc_count);
            }else{
                //以太币
                $EthData = json_decode($this->curl(1,$data->user_unique_eth),true);

                if(count($EthData) < 3){
                    return 404;
                }else{
                    $userBtc = DB::table('user_btc')->where(['user_id'=>$user_id])->first();
                    if(!empty($userBtc)){
                        DB::table('user_btc')->where(['user_id'=>$user_id])->delete();
                    }
                    //获取确认部分的数据
                    foreach($EthData['txrefs'] as $k=>$v){
                        if($v['tx_input_n'] == -1){
                            DB::table('user_btc')->insert([
                                'user_id'=>$user_id,
                                'value' => $v['value'] / 1000000000000000000,
                                'status' => 1,
                                'create_time' => $v['confirmed'],
                            ]);
                        }
                    }
                    //获取未确认的部分
                    if(!empty($EthData['unconfirmed_txrefs'])){
                        DB::table('user_btc')->insert([
                            'user_id'=>$user_id,
                            'value' => $v['value'] / 1000000000000000000,
                            'status' => 0,
                            'create_time' => $v['confirmed'],
                        ]);
                    }
//                    $data->count = $EthData['final_balance'] / 1000000000000000000 *$BtcRageCount ;
                    $data->count = DB::table('user_btc')->where(['user_id'=>session('user_id'),'status'=>1])->sum('value') * $BtcRageCount;
//                    dd($data->count);
                    //添加用户查询时间戳
                    DB::table('user')->where(['id'=>$user_id])->update([
                        'user_search_time'=>time(),
                        'btc_count'       => $EthData['total_received'] / 1000000000000000000
                    ]);
                    return floor($data->count);
                }
            }
        }
    }


    /**
     * @param $type
     * @param $user_unique
     * @return mixed
     * author hongwenyang
     * method description : curl方法
     */

    public function curl($type,$user_unique,$name = "",$idCard = "",$phone = "",$code=""){
        $showapi_appid = 44372;
        $showapi_sign = "05aee77ddd534a3c80643a72cc8c9b09";
        if($type == 0){
            $url = "https://api.blockcypher.com/v1/btc/main/addrs/".$user_unique;
        }else if($type == 1){
            $url = "https://api.blockcypher.com/v1/eth/main/addrs/".$user_unique;
        }else if($type == 2){
            $url = "http://route.showapi.com/1389-1?showapi_appid=".$showapi_appid."&showapi_sign=".$showapi_sign."&idCard=".$idCard."&name=".$name."&phone=".$phone."&needBelongArea=true";
        }else if($type == 3){
            $url = "http://route.showapi.com/28-1?showapi_appid=".$showapi_appid."&showapi_sign=".$showapi_sign."&mobile=".$phone."&content={code:'".$code."'}&tNum=T170317001242";
        }
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_HEADER,0);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * author hongwenyang
     * method description :身份认证
     */


    public function UserPhoneCheck(Request $request){
        $SFData = $request->except('s');
        if($SFData['code'] != session('code')){
            $retJson['code'] = 403;
            $retJson['msg'] = "验证码错误";
        }else{
            $is_checked = DB::table('user')->where(['user_phone'=>$SFData['user_phone']])->first();
            $user_no_is_check = DB::table('user')->where(['user_no'=>$SFData['user_no']])->first();
            if(!empty($is_checked)){
                $retJson['code'] = 403;
                $retJson['msg'] = "该手机号已认证";
            }else if(!empty($user_no_is_check)){
                $retJson['code'] = 405;
                $retJson['msg'] = "该身份证已认证";
            }else{
                $user_name = urlencode($SFData['user_name']);
                $output = $this->curl(2,0,$user_name,$SFData['user_no'],$SFData['user_phone']);
                $result = json_decode($output,true);

                if($result['showapi_res_body']['msg'] == "认证成功"){
                    unset($SFData['code']);
                    $SFData['user_real_name'] = $SFData['user_name'];
                    unset($SFData['user_name']);
                    //分配币种账号
                    $SFData['user_unique_eth'] = DB::table('account_eth')->where(['is_use'=>0])->value('account');
                    DB::table('user')->where(['id'=>session('user_id')])->update($SFData);
                    DB::table('account_eth')->where(['account'=>$SFData['user_unique_eth']])->update(['is_use'=>1]);
                    $retJson['code'] = 200;
                    $retJson['msg'] = "用户身份认证成功";
                }else{
                    $retJson['code'] = 404;
                    $retJson['msg'] = "用户身份认证失败";
                }
            }
        }

        return response()->json($retJson);
    }



    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * author hongwenyang
     * method description : 获取短信
     */

    public function code(Request $request){
        $PhoneData = $request->except('s');
        $code      = rand(1000,9999);
        $result = json_decode($this->curl(3,0,0,0,$PhoneData['user_phone'],$code),true);


        //后面删除
        session(['code'=>1]);
        if($result['showapi_res_body']['ret_code'] == 0){
            session(['code'=>$code]);
            $retJson['code'] = 200;
            $retJson['msg'] = "短息发送成功";
        }else{
            $retJson['code'] = 404;
            $retJson['msg'] = "短息发送失败";
        }
        return response()->json($retJson);
    }

    protected function returnData($data){
        if(empty($data)){
            $retJson['code'] = 404;
            $retJson['msg'] = "数据为空";
        }else{
            $retJson['code'] = 200;
            $retJson['msg'] = "获取数据成功";
        }

        $j = [
            'data'=>$data,
            'code'=>$retJson
        ];

        return $j;
    }

    public function img(Request $request){
        $imgData = $request->except('s');
        if(!empty($imgData['user_pic'])){
            $user_pic = $request->file('user_pic')->store('imgs','img');
        }
    }


    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * author hongwenyang
     * method description : 提交留言
     */

    public function feedback(Request $request){
        $FeedBackData = $request->except('s');
        $s = DB::table('feedback')->insert([
            'nickname'=>$FeedBackData['data'][0],
            'email'=>$FeedBackData['data'][1],
            'content'=>$FeedBackData['data'][2],
        ]);

        if($s){
            $retJson['code'] = 200;
            $retJson['msg'] = "留言提交成功";
        }else{
            $retJson['code'] = 404;
            $retJson['msg'] = "获取数据失败";
        }

        return response()->json($retJson);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     * author hongwenyang
     * method description : 外国人身份认证
     */

    public function Foreign(){
        $UserId = session('user_id');
        $isPass = DB::table('user')->where(['id'=>$UserId])->value('user_phone');
        if($isPass){
            $retJson['code'] = 403;
            $retJson['msg']  = '您已经通过身份验证';
        }else{
            DB::table('user')->where(['id'=>$UserId])->update([
                'user_phone'=>'外国人',
                'user_no'=>'外国人'
            ]);
            $retJson['code'] = 200;
            $retJson['msg']  = "通过成功";
        }

        return response()->json($retJson);
    }
}