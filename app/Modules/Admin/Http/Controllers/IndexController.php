<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Models\Porn;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Auth;

class IndexController extends BaseController
{
    public function index(){
        return view('admin::index');
//        dd(Auth::guard('admin')->user());
    }

    public function seedPorn(Request $request)
    {
        $count = $request->get('count');
        $porn = new Porn();
        foreach($this->getCode($count) as $k => $code){
            $insert[$k]['code'] = $code;
            $insert[$k]['expire_at'] = time() + 60*60*24*365;
        }
        return $porn->insert($insert) ? redirect('/admin')->with('message', '生成成功..') : redirect('/admin')->with('message', '生成失败..');
    }

    public function getCode($count = 10)
    {
        for ($i = 0; $i <= $count; $i++){
            yield str_random(floor(rand(10, 20)));
        }
    }
}
