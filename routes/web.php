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

Route::group(['middleware' => ['role:admin']], function (){

    /*
     * Route group for admin views.
     */
    Route::get('/admin/game-settings', 'GameSettingsController@index');
    Route::get('/admin/players-list', 'PlayerListController@index');
    Route::get('/admin/push-notifications', 'PushNotificationsController@index');

    /*
     * Route group for admin requests.
     */
    Route::post('admin/posts/submit', 'PushNotificationsController@submit');
});