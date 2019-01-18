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

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

/**
 * user auth
 */
Route::group(['namespace' => 'User'], function () {
    Route::get('register', ['as' => 'user.register', 'uses' => 'AuthController@register']);
    Route::post('register', ['as' => 'user.store', 'uses' => 'AuthController@store']);

    Route::get('login', ['as' => 'user.login', 'uses' => 'AuthController@login']);
    Route::post('login', ['as' => 'user.authorize', 'uses' => 'AuthController@authorize']);

    Route::get('account', ['as' => 'user.account', 'uses' => 'AccountController@account']);
});
