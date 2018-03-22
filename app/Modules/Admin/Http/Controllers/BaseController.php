<?php

namespace App\Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin:admin');
    }
}
