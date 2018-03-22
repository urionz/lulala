<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//Route::group(['prefix' => 'admin'], function ($router) {
//    $router->get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
//    $router->post('login', 'Auth\LoginController@login');
//    $router->post('logout', 'Auth\LoginController@logout');
//    $router->get('logout', 'Auth\LoginController@logout');
//    $router->get('/', 'IndexController@index');
//    $router->post('/porn/seed', 'IndexController@seedPorn')->name('porn.seed');
//});

Route::group(['prefix' => 'admin'], function ($router) {
    $router->get('login', 'Auth\LoginController@showLoginForm');
    Route::group(['prefix' => 'api'], function ($router) {
        $router->post('login', 'Auth\LoginController@login')->middleware('lu.throttle:5');//admin/api/login
        $router->group(['prefix' => 'auth'], function ($router) {
            $router->get('get', 'Auth\AuthController@getAuthenticatedUser');//admin/api/auth/get
            $router->get('logout', 'Auth\AuthController@logout');//admin/api/auth/logout
            $router->get('refresh-token', 'Auth\AuthController@refreshToken');
        });
        $router->group(['middleware' => 'jwt.auth'], function ($router) {
            $router->get('dashboard', function () {
                $regAndSignIn = \App\Models\User::select(DB::raw("DATE_FORMAT(FROM_UNIXTIME(`created_at`, '%Y-%m-%d %H:%i:%S'), '%Y-%m-%d') as days,count(id) as count"))
                                                ->where('created_at', '<>', null)
                                                ->groupBy('days')
                                                ->get();
                return response()->json(compact('regAndSignIn'));
            });
            $router->group(['prefix' => 'user'], function ($router) {
                $router->get('users', 'UserController@getAll');//admin/api/user/users
                $router->delete('users', 'UserController@delete');
            });

            $router->group(['prefix' => 'porn'], function ($router) {
                $router->get('porns', 'PornController@getAll');//admin/api/porn/porns
                $router->delete('porns', 'PornController@delete');
                $router->post('porns', 'PornController@create');
            });
        });
    });
});


//
//$api = app('Dingo\Api\Routing\Router');
//
//$api->version('v1', function($api){
//    $api->group(['prefix' => 'admin', 'namespace' => 'App\Modules\Admin\Http\Controllers'], function($api){
//        $api->get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
//        $api->post('login', 'Auth\LoginController@login');
//        $api->post('logout', 'Auth\LoginController@logout');
//        $api->get('logout', 'Auth\LoginController@logout');
//        $api->get('/', 'IndexController@index');
//        $api->post('/porn/seed', 'IndexController@seedPorn')->name('porn.seed');
//    });
//});