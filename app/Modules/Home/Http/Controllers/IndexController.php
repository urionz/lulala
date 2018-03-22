<?php

namespace App\Modules\Home\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginAuthController;
use App\Http\Requests;
use App\Repositories\HomeRepository;
use Agent;

class IndexController extends Controller
{
    protected $homeRepository;

    /**
     * IndexController constructor.
     * @param HomeRepository $homeRepository
     */
    public function __construct(HomeRepository $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * @param $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($user)
    {
        if($user == 'www') return view('auth.login');
        $template = $this->homeRepository->published($user);
        if(!$template) abort(500);
        if(Agent::isPhone()){
            return view('home::mobile', compact('template'));
        }
        return view('home::pc', compact('template'));
    }

    public function about()
    {
        return view('home::about');
    }
}
