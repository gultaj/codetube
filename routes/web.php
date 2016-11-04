<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::get('/videos/{video}', 'VideoController@view')->name('video')->middleware('can:view,video');
Route::get('/channel/{channel}', 'ChannelController@view')->name('channel');

Route::group(['middleware' => ['auth']], function() {

    Route::get('/videos', 'VideoController@index')->name('videos');
    Route::post('/videos', 'VideoController@store');
    Route::put('/videos/{video}', 'VideoController@update')->name('video.update');
    Route::delete('/videos/{video}', 'VideoController@delete')->name('video.delete');

    Route::get('/videos/{video}/edit', 'VideoController@edit')->name('video.edit');

    Route::get('/videos/upload', 'VideoUploadController@index')->name('videos.upload');
    Route::post('/videos/upload', 'VideoUploadController@store')->name('videos.upload.store');
    
    Route::get('/channel/{channel}/edit', 'ChannelSettingsController@edit');
    Route::put('/channel/{channel}/edit', 'ChannelSettingsController@update');
});