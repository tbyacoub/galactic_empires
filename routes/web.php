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

Route::group(['middleware' => 'auth'], function (){

    Route::get('/home', 'HomeController@index');

    Route::get('/inbox', 'PrivateMessageController@index');

});

Route::group(['prefix' => 'mail', 'middleware' => 'auth'], function (){

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

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function (){

    Route::get('game-settings', 'GameSettingsController@index');

    Route::get('players-list', 'PlayerListController@index');

    Route::get('push-notification', 'PushNotificationsController@index');

});


//Route::get('get-private-messages', 'privateMessageController@getPrivateMessages');
//Route::get('get-private-message/{user}', 'privateMessageController@getPrivateMessageById');
//Route::get('get-private-message-sent', 'privateMessageController@getPrivateMessageSent');
//Route::post('send-private-message', 'privateMessageController@sendPrivateMessage');