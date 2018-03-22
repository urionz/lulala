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

Route::group(['prefix' => 'file'], function ($router) {
    $router->post('/crop', 'FileController@Crop')->name('crop');
    $router->post('/upload', 'FileController@upload')->name('crop.upload');
    $router->post('/setAvatar', 'FileController@setAvatar')->name('setAvatar');
});