<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    public function index(Request $request){


        $admin_id   = $request->session()->get('admin_user');
//        $admin_name = DB::table('admin')->where(['id'=>$admin_id])->value('admin_name');



        $j = [
            'title'     =>'后台管理',
        ];
        return view('Back/index',$j);
    }

}
