<?php

namespace App\Modules\Admin\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Porn;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';
    protected $guard = 'admin';
    protected $loginView = 'admin.login';
    protected $registerView = 'admin.register';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->get('username'),
            'password' => $request->get('password')
        ];
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                $response = array(
                    'error' => '用户名或密码错误',
                    'status_code' => 401
                );
                return response()->json($response);
            }
        } catch (JWTException $e) {
            $response = array(
                'error' => '创建token时出错',
                'status_code' => 500
            );
            return response()->json($response);
        }
        $user = JWTAuth::authenticate($token);
        $status_code = 200;

        return response()->json(compact('token', 'user', 'status_code'));
    }

    public function showLoginForm()
    {
        return view('admin::index');
    }
//
//    protected function guard()
//    {
//        return auth()->guard('admin');
//    }
}
