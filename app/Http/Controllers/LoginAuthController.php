<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
}
