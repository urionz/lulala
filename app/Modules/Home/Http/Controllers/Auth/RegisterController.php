<?php

namespace App\Modules\Home\Http\Controllers\Auth;

use App\Models\Porn;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/tpl';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rules = [
            'email' =>  'required|email|max:255|unique:users',
            'password'  =>  'required|min:6|confirmed',
            'porn' => 'required|porn_lose'
        ];
        $messages = [
            'email.required'    =>  '用户名为必填字段',
            'email.email'   =>  '用户名必须为邮箱格式',
            'email.unique'  =>  '此用户已存在',
            'password.required'  =>  '密码为必填字段',
            'password.min'  =>  '密码最小长度为6位字符',
            'password.confirm'  =>  '两次密码不一致',
            'porn.required' => '邀请码为必填字段',
            'porn.porn_lose' => '此邀请码已失效或不存在'
        ];
        return Validator::make($data, $rules, $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $payload = [
//            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'used' => 1
        ];
        $porn =  Porn::where('code', $data['porn'])->where('use_id', null)->where('expire_at', '>', time())->lockForUpdate()->first();
        if($updateid = User::where('used', 0)->lockForUpdate()->min('id')){
            $user = User::where('id', $updateid)->lockForUpdate()->first();
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->used = 1;
            $porn->use_at = time();
            $porn->use_id = $updateid;
            $porn->save();
            return $user->save() ? $user : null;
        }
        return User::create($payload);
    }
}
