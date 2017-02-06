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


<<<<<<< HEAD
Route::group(['middleware' => ['role:admin']], function (){
=======
Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function (){
>>>>>>> e21f87be6b0ce7b5a69f5f8806cf8523cc63437a

    Route::get('game-settings', 'GameSettingsController@index');

<<<<<<< HEAD
    Route::get('/admin/players-list', 'PlayerListController@index');
=======
    Route::get('players-list', 'PlayerListController@index');
>>>>>>> e21f87be6b0ce7b5a69f5f8806cf8523cc63437a

    Route::get('push-notification', 'PushNotificationsController@index');

});

