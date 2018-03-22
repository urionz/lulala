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

Route::group(['prefix' => 'tpl'], function () {
    Route::get('/', 'IndexController@edit')->name('tpl.edit');
    Route::get('/cors', 'IndexController@cors')->name('tpl.cors');
    Route::post('/remove', 'IndexController@delete')->name('tpl.remove');
    Route::post('/save', 'IndexController@save')->name('tpl.save');
    Route::post('/publish', 'IndexController@publish')->name('tpl.publish');
    Route::post('/preview', 'IndexController@postPreview')->name('tpl.post.preview');
    Route::get('/preview/{hash}', 'IndexController@preview')->name('tpl.preview');
    Route::post('/remove', 'IndexController@delete')->name('tpl.remove');
});
