<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimeController extends Controller
{
    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * author hongwenyang
     * method description : 筹集管理
     */

    public function Tlist(){
        $data = DB::table('time')->where(['is_show'=>1])->get();
        $j = [
            'title'=>'筹集管理',
            'data'=>$data
        ];

        return view('Back.Time.list',$j);
    }

    public function edit(Request $request){
        $data = $request->except('s');
        if($data['id'] == 0){
            $TimeData = json_decode('{}');
            $TimeData->id = $data['id'];
            $TimeData->btc_count = "";
            $TimeData->btc_basic_count = "";
            $TimeData->start_time = time();
            $TimeData->stop_time = time();
        }else{
            $TimeData = DB::table('time')->where($data)->first();
        }

//        dd($TimeData);
        $j = [
            'data'=>$TimeData,
            'title'=>'筹集修改'
        ];
        return view('Back.Time.edit',$j);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * author hongwenyang
     * method description : 保存数据
     */

    public function save(Request $request){
        $data = $request->except(['s','_token']);
        $data['start_time'] = strtotime($data['start_time']);
        $data['stop_time'] = strtotime($data['stop_time']);
        if($data['id'] == 0){
            unset($data['id']);
            $s = DB::table('time')->insert($data);
        }else{
            $map['id'] = $data['id'];
            unset($data['id']);
            $s = DB::table('time')->where($map)->update($data);
        }

        if($s){
            $retJson['code'] = 200;
            $retJson['msg'] = '保存成功';
        }else{
            $retJson['code'] = 404;
            $retJson['msg'] = '保存失败';
        }

        return response()->json($retJson);
    }

    public function del(Request $request){
        $id = $request->except(['s','_token']);
        DB::table('time')->where($id)->update([
            'is_show'=>0
        ]);
        $retJson['code'] = 200;
        return response()->json($retJson);
    }
}
