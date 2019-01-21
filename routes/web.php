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
    Route::get('logout', ['as' => 'user.logout', 'uses' => 'AuthController@logout']);

    Route::group(['middleware' => 'guest'], function (){
        Route::get('account', ['as' => 'user.account', 'uses' => 'AccountController@account']);
//        Route::get('game', ['as' => 'game', 'uses' => 'GameController@index']);
//        Route::get('move', ['as' => 'move', 'uses' => 'GameController@move']);
//        Route::post('move', ['as' => 'move', 'uses' => 'GameController@move']);


        Route::get('game', ['as' => 'game', 'uses' => 'GameController@index']);
        Route::get('game/{game}', ['as' => 'game.game', 'uses' => 'GameController@game']);
        Route::post('game/{game}/move', ['as' => 'game.move', 'uses' => 'GameController@move']);
        Route::get('game/{game}/test', ['as' => 'game.test', 'uses' => 'GameController@test']);
    });
});
