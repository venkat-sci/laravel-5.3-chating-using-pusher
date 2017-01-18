<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/postpush','pusherController@index');
Route::post('/postpush','pusherController@postpush');
Route::get('/pusherview','pusherController@pusherview');

Route::get('chat','ChatController@getIndex');
Route::post('chat/message','ChatController@postMessage');
