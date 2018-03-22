<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get('/admin', function (Request $request) {
//    // return $request->admin();
//})->middleware('auth:api');

//Route::group(['prefix' => 'admin'], function ($router) {
//    $router->get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
//    $router->post('login', 'Auth\LoginController@login');
//    $router->post('logout', 'Auth\LoginController@logout');
//    $router->get('logout', 'Auth\LoginController@logout');
//    $router->get('/', 'IndexController@index');
//    $router->post('/porn/seed', 'IndexController@seedPorn')->name('porn.seed');
//});