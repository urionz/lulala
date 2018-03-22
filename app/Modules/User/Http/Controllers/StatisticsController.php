<?php

namespace App\Modules\User\Http\Controllers;

use App\Models\AccessLog;
use App\Modules\Admin\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;

use App\Http\Requests;

class StatisticsController extends AuthController
{
    public function index()
    {
        $pv = AccessLog::where('user_id', Auth()->user()->id)->get()->sum('refresh');
        $uv = AccessLog::select('user_id')->where('user_id', Auth()->user()->id)->groupBy('ip')->get()->count();
        dd('pv：'.$pv.' uv：'.$uv);
    }
}
