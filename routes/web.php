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
    Route::get('/home', 'HomeController@index');

    Route::get('/fleets', 'FleetController@index');

    Route::get('/galaxy-map', 'GalaxyMapController@index');

    Route::get('/users/{user}/mails', 'UserController@mails');

    Route::get('/global-rates', 'AdminController@globalRates');

    Route::get('/notifications', 'NotificationController@index');

    Route::get('/users/{user}/planets', 'UserController@planets');

    Route::get('/planets/{planet}/fleets', 'PlanetController@fleets');

    Route::get('/travels/create/{planet}', 'TravelController@create');

    Route::get('/building/{building}/cost', 'BuildingController@cost');

    Route::get('/planets/{planet}/travels', 'PlanetController@travels');

    Route::get('/users/{user}/notifications', 'UserController@notifications');

    Route::get('/solar-systems/{solarSystem}', 'GalaxyMapController@solarSystem');

    Route::get('/planets/{planet}/buildings/{type}', 'PlanetController@buildings');

    Route::get('/travels/planets/{origin}/planets/{destination}', 'TravelController@formattedTime');

    Route::get('/complete-tutorial', 'HomeController@completeTutorial');

    Route::get('planets/{colonize_planet}/colonize', 'PlanetController@colonize');


    /**
     * PUT routes
     */
    Route::put('/global-rates', 'AdminController@updateGlobalRates');

    /**
     * Resource route replacements/extensions
     */
    Route::get('/mail/{box}', 'MailController@index');

    Route::put('/mails', 'MailController@collection');

    Route::put('/fleets/{fleet}', 'FleetController@update');

    Route::get('/building/{type}', 'buildingController@index');

    Route::post('/mails/create', 'MailController@createWParam');

    Route::put('/buildings/{building}/upgrade', 'BuildingController@upgrade');

    Route::put('planets/{planet}/edit/resources/{resource}', 'PlanetController@updateResource');

    Route::put('planets/{colonize_planet}/colonize/{from_planet}', 'PlanetController@updateColonize');

    /**
     * Resource routes
     */
    Route::resource('users', 'UserController');

    Route::resource('posts', 'PostController');

    Route::resource('planets', 'PlanetController');

    Route::resource('travels', 'TravelController');

    Route::resource('mails', 'MailController', ['except' => [
        'index',
    ]]);

    Route::resource('buildings', 'BuildingController', ['except' => [
        'index',
    ]]);

});