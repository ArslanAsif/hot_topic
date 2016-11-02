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

//Auth Routes
Auth::routes();

Route::get('auth/facebook', 'Auth\SocialAuthController@fbRedirectToProvider');
Route::get('auth/facebook/callback', 'Auth\SocialAuthController@fbHandleProviderCallback');

Route::get('auth/google', 'Auth\SocialAuthController@googleRedirectToProvider');
Route::get('auth/google/callback', 'Auth\SocialAuthController@googleHandleProviderCallback');

Route::get('auth/twitter', 'Auth\SocialAuthController@twitterRedirectToProvider');
Route::get('auth/twitter/callback', 'Auth\SocialAuthController@twitterHandleProviderCallback');

Route::get('/', 'HomeController@index');
Route::post('/topic/{id}/comment', 'HomeController@postComment');
Route::get('/topic/comment/delete/{id}', 'HomeController@getDeleteComment');

Route::group(['prefix' => 'admin', 'middleware' => ['is_admin']], function () {

    Route::get('/', 'AdminController@index');
    Route::get('/user/all', 'AdminController@getAllUsers');

    Route::get('/topic/all', 'AdminController@getAllTopics');
    Route::get('/topic/view/{id}', 'AdminController@getTopic');

    Route::get('/topic/add', 'AdminController@getAddTopic');
    Route::post('/topic/add', 'AdminController@postAddTopic');
    Route::get('/topic/edit', 'AdminController@getEditTopic');
    Route::post('/topic/edit', 'AdminController@postEditTopic');

    Route::get('/user/ban/{id}', 'AdminController@getBanUser');
});