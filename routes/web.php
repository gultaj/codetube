<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/channel/{channel}', 'ChannelController@view')->name('channel');
Route::get('/videos/{video}', 'VideoController@view')->name('video');
Route::post('/videos/{video}/view', 'VideoViewController@store');

Route::get('/videos/{video}/votes', 'VideoVotesController@show');

Route::get('/search', 'SearchController@index')->name('search');

Route::get('/videos/{video}/comments', 'VideoCommentsController@index');

Route::get('/subscription/{channel}', 'ChannelSubscriptionController@show');

Route::group(['middleware' => ['auth']], function() {

    Route::get('/videos', 'VideoController@index')->name('videos');
    Route::post('/videos', 'VideoController@store');
    Route::put('/videos/{video}', 'VideoController@update')->name('video.update');
    Route::delete('/videos/{video}', 'VideoController@delete')->name('video.delete');

    Route::get('/videos/{video}/edit', 'VideoController@edit')->name('video.edit');

    Route::get('/upload', 'VideoUploadController@index')->name('videos.upload');
    Route::post('/videos/upload', 'VideoUploadController@store')->name('videos.upload.store');
    
    Route::get('/channel/{channel}/edit', 'ChannelSettingsController@edit');
    Route::put('/channel/{channel}/edit', 'ChannelSettingsController@update');

    Route::post('/videos/{video}/votes', 'VideoVotesController@create');
    Route::delete('/videos/{video}/votes', 'VideoVotesController@remove');

    Route::post('/videos/{video}/comments', 'VideoCommentsController@create');
    Route::delete('/videos/{video}/comments/{comment}', 'VideoCommentsController@delete');

    Route::post('/subscription/{channel}', 'ChannelSubscriptionController@create');
    Route::delete('/subscription/{channel}', 'ChannelSubscriptionController@delete');
});