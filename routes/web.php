<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['auth']], function() {

    Route::post('/videos', 'VideoController@store');
    Route::put('/videos/{video}', 'VideoController@update');

    Route::get('/videos/upload', 'VideoUploadController@index');
    
    Route::get('/channel/{channel}/edit', 'ChannelSettingsController@edit');
    Route::put('/channel/{channel}/edit', 'ChannelSettingsController@update');
});