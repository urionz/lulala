<?php

namespace App\Modules\User\Http\Controllers;


use App\Http\Controllers\AuthController;
use App\Modules\Home\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use Hash;

class SecureController extends AuthController
{
    public function modifyPassword(Request $request, LoginController $login)
    {
        $old_password = $request->get('old_password');
        if(Hash::check($old_password, Auth()->user()->password)){
            Auth()->user()->password = bcrypt($request->get('password'));
            Auth()->user()->save();
            $response = [
                'status' => 200,
                'result' => 'success',
                'location' => route('logout')
            ];
            return Response()->json($response);
        }
        return response('密码修改失败!', 500);
    }
}
