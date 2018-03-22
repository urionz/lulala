<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Models\Porn;
use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PornController extends Controller
{
    public function getAll(Request $request)
    {
        $pageSize = $request->has('pageSize') ? $request->get('pageSize') : 10;
        $field = $request->has('field') ? $request->get('field') : '';
        $fieldValue = $request->has('keyword') ? $request->get('keyword') : '';
        switch ($field){
            case 'code':
                $data = Porn::where($field, $fieldValue)->paginate($pageSize);
                break;
            case 'expire_at':
                $data = Porn::where($field, '<', strtotime($fieldValue))->paginate($pageSize);
                break;
            case 'use_id':
                if(!$fieldValue){
                    $data = Porn::where($field, null)->paginate($pageSize);
                }else{
                    $user = User::where('id', 'like', $fieldValue)->orWhere('email', 'like', $fieldValue)->first();
                    $data = Porn::where($field, $user->id)->paginate($pageSize);
                }
                break;
            case 'belong':
                $user = User::where('id', 'like', $fieldValue)->orWhere('email', 'like', $fieldValue)->first();
                $data = Porn::where('user_id', $user->id)->paginate($pageSize);
                break;
            default:
                $data = Porn::paginate($pageSize);
        }

        $status_code = 200;
        return response()->json(compact('data', 'status_code'));
    }

    public function delete(Request $request)
    {
        $id = $request->get('id');
        $status_code = 400;
        if(Porn::find($id)->delete()){
            $status_code = 200;
        }
        $data = Porn::paginate(10);
        return response()->json(compact('data', 'status_code'));
    }

    public function create(Request $request)
    {
        $count = $request->get('count');
        $user_id = $request->has('user_id') ? $request->get('user_id') : null;
        $porn = new Porn();
        foreach($this->getCode($count) as $k => $code){
            $insert[$k]['code'] = $code;
            $insert[$k]['expire_at'] = time() + 60*60*24*365;
            $insert[$k]['user_id'] = $user_id;
        }
        $status_code = $porn->insert($insert) ? 200 : 400;
        $data = Porn::paginate(10);
        return response()->json(compact('data', 'status_code'));
    }

    public function getCode($count = 10)
    {
        for ($i = 0; $i <= $count; $i++){
            yield str_random(floor(rand(10, 20)));
        }
    }
}
