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

/*
 * Route group for players, by default admins also, for game views.
 */
Route::group(['middleware' => 'auth'], function () {

    Route::get('/complete-tutorial', 'HomeController@completeTutorial');

    Route::get('/notifications', 'NotificationController@index');

    Route::get('/api/get-notifications', 'NotificationController@getUserNotifications');

    Route::get('/home', 'HomeController@index');

    Route::get('/planets/{user_id}', 'HomeController@planets');

    Route::get('/planet/{planet_id}', 'HomeController@planet');

    Route::get('/galaxy-map', 'GalaxyMapController@index');

    Route::get('/facilities', 'BuildingController@indexFacilities');

    Route::get('/resources', 'BuildingController@indexResources');

    Route::get('/planetary-defenses', 'BuildingController@indexDefenses');

    Route::get('/fleets', 'FleetsController@index');

    Route::get('/research', 'BuildingController@indexResearch');

    Route::get('/shipyard', 'BuildingController@indexShipyard');

    Route::post('/building/{building}/upgrade', 'BuildingController@upgrade');

    Route::get('/building/{building}/cost', 'BuildingController@cost');

    //Route::get('/planet-overview/{planet}', 'HomeController@indexPlanetOverview');
    Route::get('/launch-attack/{from_planet}/{to_planet}', 'HomeController@indexLaunchAttack');
    Route::post('/launch-attack/{from_planet}/{to_planet}', 'HomeController@attack');
	
	Route::get('/planet-overview', 'PlanetOverviewController@viewPlanetOverview');
	
    Route::get('/galaxy-map', 'GalaxyMapController@index');

    Route::get('/galaxy-map/{system_id}', 'SolarSystemViewController@viewSystemFromGalaxyMap');

    Route::get('/galaxy-map/{system_id}/{planet_id}', 'PlanetOverviewController@viewPlanet');
});

Route::group(['prefix' => 'mail', 'middleware' => 'auth'], function () {

    Route::get('/', 'MailController@index');

    Route::get('/sent', 'MailController@sentIndex');

    Route::get('/create/{email?}', 'MailController@create');

    Route::post('/create', 'MailController@forward');

    Route::post('/', 'MailController@store');

    Route::get('/{mail}', 'MailController@show');

    Route::delete('/{mail}', 'MailController@destroy');

    Route::get('/api/get-mail', 'MailController@getUserNotifications');

    Route::post('/api', 'MailController@mailApi');
});

Route::group(['prefix' => 'api', 'middleware' => 'auth'], function() {

    Route::get('planets', 'ApiController@planets');

    Route::get('planet/{planet}/resources', 'ApiController@resources');

    Route::get('planet/{planet}/facilities', 'ApiController@facilities');

    Route::get('planet/{planet}/planetary_defenses', 'ApiController@planetaryDefenses');

    Route::get('planet/{planet}/research', 'ApiController@research');

    Route::get('planet/{planet}/shipyard', 'ApiController@shipyard');

});

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {

    /*
     * Route group for admin views.
     */
    Route::get('/game-settings', 'GameSettingsController@index');

    Route::post('/game-settings', 'GameSettingsController@store');

    Route::get('/players-list', 'PlayerListController@index');

    Route::get('/push-notifications', 'PushNotificationsController@index');

    Route::get('/edit-player/{user}', 'EditPlayerController@index');

    /*
     * Route group for admin requests.
     */
    Route::post('/posts', 'PushNotificationsController@store');

    Route::put('/posts/{post}', 'PushNotificationsController@update');

    Route::delete('/posts/{post}', 'PushNotificationsController@destroy');

    Route::post('/edit-player/modify-metal/{planet}', 'EditPlayerController@modifyMetal');
    Route::post('/edit-player/modify-crystal/{planet}', 'EditPlayerController@modifyCrystal');
    Route::post('/edit-player/modify-energy/{planet}', 'EditPlayerController@modifyEnergy');

});

Route::group(['prefix' => 'test'], function () {

    Route::get('mineral', function (){

       return \App\BuildingPrototype::where('name', '=', 'Mineral Mine')->first()->max_level;

    });

    Route::get('send-email/{user}', function (\App\User $user) {
        $sender = \App\User::find(10);
        $mail = new \App\Mail([
            "subject" => "test",
            "message" => "testeadbhjasdbhjasbdhjasbd",
            "read" => 0,
            "favorite" => 0,
        ]);
        $mail->sender()->associate($sender);
        $mail->receiver()->associate($user);
        $mail->save();
        event(new \App\Events\EmailSentEvent($user->id));
        return "event fired";
    });

    Route::get('welcome-queue/{user}', function(\App\User $user) {
        // run the following command to dispatch Jobs
        // 1.redis-server
        // 2.laravel-echo-server start
        // 3.php artisan SoapServer
        // 4.php artisan queue:work
        //      4.1 php artisan queue:restart if any code was changed
        $job = (new \App\Jobs\SendWelcomEmail($user))->delay(Carbon::now()->addMinutes(1));
        dispatch($job);
        return 'jobs dispatched';
    });

});

Route::get('/index', 'IndexController@index');


