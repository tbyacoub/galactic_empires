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

Auth::routes();

Route::get('/', function () {
    return redirect('/home');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', 'HomeController@index');

    Route::get('/inbox', 'PrivateMessageController@index');

    Route::get('/galaxy-map', 'GalaxyMapController@index');
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

Route::get('/facilities', function () {
    $user = Auth::user();
    return view('content.facilities', compact('user'));
});

Route::group(['prefix' => 'test'], function () {

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
        event(new \App\Events\EmailSentEvent($mail, $sender, $user));
        return "event fired";
    });
});
