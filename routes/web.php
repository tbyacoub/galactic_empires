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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function (){

    Route::get('game-settings', 'GameSettingsController@index');

    Route::get('players-list', 'PlayerListController@index');

    Route::get('push-notification', 'PushNotificationsController@index');

});