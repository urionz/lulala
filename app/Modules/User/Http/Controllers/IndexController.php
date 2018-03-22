<?php

namespace App\Modules\User\Http\Controllers;

use App\Http\Controllers\AuthController;
use App\Models\Areas;
use App\Models\Cities;
use App\Models\Provinces;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends AuthController
{
    public function index()
    {
        return view('user::index');
    }

    public function store(Request $request)
    {
        $updater['nickname'] = $request->has('nickname') ? $request->get('nickname') : null;

        if($province = Provinces::where('provinceid', $request->get('province'))->first()){//省份存在
            if($city = Cities::where('cityid', $request->get('city'))->where('provinceid', $request->get('province'))->first()){//市级存在且在此省之下
                if($area = Areas::where('cityid', $request->get('city'))->where('areaid', $request->get('area'))->first()){//区域存在且在此市之下
                    $updater['province'] = $request->get('province');
                    $updater['city'] = $request->get('city');
                    $updater['area'] = $request->get('area');
                }
            }
        }

        Auth()->user()->update($updater);

        return redirect('/user/user_info')->with('200', 'success');
    }

    public function faq()
    {
        return view('user::faq');
    }

    public function user_info()
    {
        return view('user::user_info');
    }

    public function user_account()
    {
        return view('user::user_account');
    }

    public function about_us()
    {
        return view('user::about_us');
    }    
}
