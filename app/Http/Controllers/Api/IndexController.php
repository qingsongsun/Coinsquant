<?php
/**
 * Created by PhpStorm.
 * User: baimifan-pc
 * Date: 2017/8/22
 * Time: 14:38
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller {
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * author  hongwenyang
     * method description : 文章
     * param:type 0->认责申明 1->其他文章
     */

    public function article(Request $request){
        $TypeData = $request->except('s');
        if($TypeData['type'] == 0){
            $data = DB::table('article')->where($TypeData)->select('id','title','content')->first();
        }else{
            $data = DB::table('article')->where($TypeData)->select('id','title','content')->get();
        }

        $j = $this->returnData($data);
        return response()->json($j);
    }



    public function Data(){
        //视频数据
        $VideoData = DB::table('video')->first();
        //众筹数据
        $FundingData = DB::table('funding')->where(['is_show'=>1])->first();
//        $FundingData->buyCount = ;
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
}