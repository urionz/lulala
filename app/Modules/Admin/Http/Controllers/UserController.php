<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function getAll(Request $request)
    {
        $pageSize = $request->get('pageSize');
        $sortField = $request->get('sortField');
        $sortOrder = $request->get('sortOrder');
        $data = $sortField ? User::where('password', '<>', null)->orderBy($sortField, $sortOrder) : User::where('password', '<>', null);
        $data = $data->paginate($pageSize);
        $status_code = 200;
        return response()->json(compact('data', 'status_code'));
    }

    public function delete(Request $request)
    {
        $id = explode(',', $request->get('id'));
        $status_code = 400;
        $fill = [
            'name' => null,
            'email' => null,
            'password' => null,
            'avatar' => null,
            'province' => null,
            'city' => null,
            'area' => null,
            'nickname' => null,
            'used' => 0,
            'created_at' => null
        ];
        if(User::whereIn('id', $id)->update($fill)){
            $status_code = 200;
        }
        $data = User::where('password', '<>', null)->paginate(10);
        return response()->json(compact('data', 'status_code'));
    }
}
