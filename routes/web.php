<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['auth']], function() {

    Route::get('/videos', 'VideoController@index')->name('videos');
    Route::post('/videos', 'VideoController@store');
    Route::put('/videos/{video}', 'VideoController@update');

    Route::get('/video/{video}', 'VideoController@view')->name('video');

    Route::get('/videos/upload', 'VideoUploadController@index')->name('videos.upload');
    Route::post('/videos/upload', 'VideoUploadController@store')->name('videos.upload.store');
    
    Route::get('/channel/{channel}/edit', 'ChannelSettingsController@edit');
    Route::put('/channel/{channel}/edit', 'ChannelSettingsController@update');
});