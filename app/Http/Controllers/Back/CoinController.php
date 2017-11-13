<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CoinController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * author  hongwenyang
     * method description : 比特币账号列表
     */

    public function Clist(){
        $data = DB::table('account_btc')->where(['is_del'=>0])->get();
        $j = [
            'data'=>$data,
            'title'=>'比特币账号列表'
        ];
        return view('Back.Coin.Clist',$j);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * author  hongwenyang
     * method description : 删除账号
     */

    public function del(Request $request){
        $map['id'] = $request->input('id');
        DB::table('account_btc')->where($map)->update([
            'is_del'=>1
        ]);
        return response()->json(200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * author  hongwenyang
     * method description : 编辑分类
     */

    public function edit(Request $request){
        $map['id']  = $request->input('id');
        $data       = DB::table('product_cat')->where($map)->first();
        if($map['id']  == 0){
            $data           = json_decode('{}');
            $data->cat_name = "";
            $data->cat_pic  = "";
            $data->id       = 0;
        }

        $j = [
            'data'=>$data
        ];

        return view('Back.Coin.edit',$j);
    }



    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * author hongwenyang
     * method description : 保存账号数据
     */

    public function save(Request $request){
        $data = $request->except(['s','_token']);
        $data['is_use'] = 0;
        DB::table('account_btc')->insert($data);
        return response()->json(200);
    }


    /**
     * @param Request $request
     * @return string
     * author hongwenyang
     * method description : 批量上传账号
     */

    public function excel(Request $request){
        $file = $request->file('file');
        Excel::load($file, function($reader) use ($file){
            $reader = $reader->getSheet(0);
            $data = $reader->toArray();
            foreach ($data as $k=>$v){
                $save['account'] = $v[0];
                DB::table('account_btc')->insert($save);
            }
        });
        return "<script>
    alert('上传成功');
    location.href = '/back/coin/list';
</script>";
    }

    public function change(){
        $data = DB::table('coin')->first();
        $j= [
            'title'=>'汇率转换',
            'data'=>$data
        ];

        return view('Back.Coin.change',$j);
    }


    public function csave(Request $request){
        $data = $request->except(['s','_token']);
        if($data['type'] == 1){
            $save['lhb'] = $data['data'];
        }else{
            $save['coin'] = $data['data'];
        }

        DB::table('coin')->where(['id'=>$data['id']])->update($save);
        $retJson['code'] = 200;

        return response()->json($retJson);
    }
}
