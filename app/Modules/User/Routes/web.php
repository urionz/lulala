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

Route::group(['prefix' => 'user'], function ($router) {
    $router->get('/', 'IndexController@index')->name('user.index');
    $router->get('/faq', 'IndexController@faq')->name('user.faq');
    $router->get('/user_info', 'IndexController@user_info')->name('user.user_info');
    $router->get('/user_account', 'IndexController@user_account')->name('user.user_account');
    $router->get('/about_us', 'IndexController@about_us')->name('user.about_us');
    $router->post('/', 'IndexController@store')->name('profile.store');

    //安全
    $router->group(['prefix' => 'secure'], function ($router) {
        $router->post('/modifyPassword', 'SecureController@modifyPassword')->name('password.modify');
    });


    //材料
    $router->group(['prefix' => 'material'], function ($router){
        $router->post('/remove', 'MaterialController@delete')->name('material.remove');
        $router->post('/upload', 'MaterialController@upload')->name('material.upload');
        $router->post('/borderUpload', 'MaterialController@borderUpload')->name('border.upload');
    });

    //统计
    $router->group(['prefix' => 'statistics'], function ($router){
        $router->get('/', 'StatisticsController@index')->name('statistics.index');
    });
});