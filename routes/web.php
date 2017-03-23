<?php

use Carbon\Carbon;

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

Auth::routes();

Route::get('/', function () {
    return redirect('/home');
});

Route::group(['middleware' => 'auth'], function () {

    /**
     * GET routes
     */
    Route::get('/home', function () {
        return view('layouts.home');
    });

    Route::get('/users/{user}/mails', 'UserController@mails');

    Route::get('/notifications', 'NotificationController@index');

    Route::get('/users/{user}/planets', 'UserController@planets');

    Route::get('/users/{user}/notifications', 'UserController@notifications');

    Route::get('/planets/{planet}/buildings/{type}', 'PlanetController@buildings');

    /**
     * Resource route replacements/extensions
     */
    Route::get('/mail/{box}', 'MailController@index');

    Route::put('/mails', 'MailController@collection');

    Route::get('/building/{type}', 'buildingController@index');

    Route::post('/mails/create', 'MailController@createWParam');

    Route::put('/building/{building}/upgrade', 'BuildingController@upgrade');

    /**
     * Resource routes
     */
    Route::resource('mails', 'MailController', ['except' => [
        'index',
    ]]);

    Route::resource('users', 'UserController');

    Route::resource('planets', 'PlanetController');

    Route::resource('buildings', 'BuildingController', ['except' => [
        'index',
    ]]);

});