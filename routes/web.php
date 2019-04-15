<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group([], function () {
    Route::get('login', [
        'as' => 'login',
        'uses' => 'AuthController@showAdminLoginForm'
    ]);
    Route::post('login', [
        'as' => 'postAdminLogin',
        'uses' => 'AuthController@adminLogin'
    ]);
    Route::post('logout', [
        'as' => 'logout',
        'uses' => 'AuthController@adminLogout'
    ]);
    Route::post('/upload', 'MarkerController@postUpload');
    Route::get('/upload', 'MarkerController@showUploadForm');
    Route::get('color/{start_time?}', [
        'as' => 'color',
        'uses' => 'MarkerController@showColorXML',
    ]);
    Route::get('colorJson/{start_time?}', [
        'as' => 'colorJson',
        'uses' => 'MarkerController@showColorJson',
    ]);
    Route::get('current', [
        'as' => 'current',
        'uses' => 'MarkerController@showCurrent',
    ]);
    Route::get('future', [
        'as' => 'future',
        'uses' => 'MarkerController@showFuture',
    ]);
    Route::get('history/{start_time?}', [
        'as' => 'history',
        'uses' => 'MarkerController@showHistory',
    ]);


    Route::get('profile', [
        'as' => 'profile',
        'uses' => 'UserController@showProfile',
    ]);

    Route::post('profile', [
        'uses' => 'UserController@editProfile',
    ]);
    Route::resource('users', 'UsersController', ['except' => ['destroy', 'create', 'edit', 'show']]);
    Route::post('users/delete', [
        'as' => 'users.delete',
        'uses' => 'UsersController@destroy',
        'middleware' => 'aminRoleMiddleware',
    ]);
    Route::get('users/create', [
        'middleware' => 'adminRole',
        'as' => 'users.create',
        'uses' => 'UsersController@create',
    ]);

    Route::get('profile', [
        'as' => 'users.profile',
        'uses' => 'UsersController@edit',
    ]);
    Route::get('reset', [
        'as' => 'reset',
        'uses' => 'MarkerController@reset',
    ]);
    Route::post('overwrite', [
        'as' => 'overwrite',
        'uses' => 'MarkerController@overwrite',
    ]);
    Route::get('saveToHistory', [
        'as' => 'saveToHistory',
        'uses' => 'MarkerController@saveToHistory',
    ]);
    Route::get('/', [
        'as' => 'homepage',
        'uses' => 'MarkerController@index',
    ]);
});