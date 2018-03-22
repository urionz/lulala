<?php

namespace App\Modules\Admin\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use App\Models\User;

class AuthController extends Controller
{
    public function getAuthenticatedUser(Request $request)
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'token_expired']);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'token_invalid']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'token_absent']);
        }
        $status_code = 200;
        return response()->json(compact('user','status_code'));
    }

    public function refreshToken () {
        $old_token = JWTAuth::getToken();
        $token = JWTAuth::refresh($old_token);
        $status_code = 200;
        return response()->json(compact('token','status_code'));
    }

    public function logout()
    {
        $token = JWTAuth::getToken();
        JWTAuth::invalidate($token);
        return response()->json(['error'=>'退出成功','status_code'=>200]);
    }
}
