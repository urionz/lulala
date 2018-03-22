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


Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');



Route::group(['domain' => '{user}.' . env('APP_DOMAIN')], function(){
    Route::get('/', 'IndexController@show')->name('show')->middleware('access');
});

Route::get('/', 'IndexController@index')->name('home')->middleware(['guest', 'access']);

Route::get('about', 'IndexController@about')->name('about');
