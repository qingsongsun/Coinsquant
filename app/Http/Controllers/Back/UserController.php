<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * author  hongwenyang
     * method description : 比特币账号列表
     */

    public function Ulist(){
        $data = DB::table('user')->get();
        $j = [
            'data'=>$data,
            'title'=>'用户列表'
        ];
        return view('Back.User.Ulist',$j);
    }


    public function read($id){
        $data = DB::table('user')->where(['id'=>$id])->first();
        $BtcRage = DB::table('coin')->where(['type'=>0])->first();
        $BtcRageCount = $BtcRage->coin/$BtcRage->lhb;
        $data->count = floor($data->btc_count * $BtcRageCount);
        $j = [
            'title'=>'用户详情',
            'data'=>$data
        ];
        return view('Back.User.read',$j);
    }
}
