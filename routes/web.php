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

    Route::get('/home', 'HomeController@index');

    Route::get('/galaxy-map', 'GalaxyMapController@index');

    Route::get('/facilities', 'BuildingViewController@indexFacilities');

    Route::get('/resources', 'BuildingViewController@indexResources');

    Route::get('/planetary-defenses', 'BuildingViewController@indexDefenses');

    Route::post('/upgrade-building/{id}', 'BuildingViewController@upgradeBuilding');
//    Route::get('/upgrade-building/{building}', 'BuildingViewController@upgrade');
});

Route::group(['prefix' => 'mail', 'middleware' => 'auth'], function () {

    Route::get('/', 'MailController@index');

    Route::get('/sent', 'MailController@sentIndex');

    Route::get('/create/{email?}', 'MailController@create');

    Route::post('/create', 'MailController@forward');

    Route::post('/', 'MailController@store');

    Route::get('/{mail}', 'MailController@show');

    Route::delete('/{mail}', 'MailController@destroy');

    Route::get('/api/get-notifications', 'MailController@getUserNotifications');

    Route::post('/api', 'MailController@mailApi');
});

Route::group(['prefix' => 'api', 'middleware' => 'auth'], function() {

    Route::get('planets', 'ApiController@planets');

    Route::get('planet/{planet}/resources', 'ApiController@resources');

    Route::get('planet/{planet}/facilities', 'ApiController@facilities');

    Route::get('planet/{planet}/planetary_defenses', 'ApiController@planetaryDefenses');
});

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {

    /*
     * Route group for admin views.
     */
    Route::get('/game-settings', 'GameSettingsController@index');

    Route::get('/players-list', 'PlayerListController@index');

    Route::get('/push-notifications', 'PushNotificationsController@index');

    Route::get('/edit-player/{user}', 'EditPlayerController@index');

    /*
     * Route group for admin requests.
     */
    Route::post('/posts', 'PushNotificationsController@store');

    Route::put('/posts/{post}', 'PushNotificationsController@update');

    Route::delete('/posts/{post}', 'PushNotificationsController@destroy');
});

// TESTING

Route::post('admin/edit-player/modify-resource/{planet_id}', 'EditPlayerController@modifyResource');

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
