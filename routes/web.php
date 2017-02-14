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

<<<<<<< HEAD
Route::group(['middleware' => ['role:admin']], function (){

    /*
     * Route group for admin views.
     */
    Route::get('/admin/game-settings', 'GameSettingsController@index');
    Route::get('/admin/players-list', 'PlayerListController@index');
    Route::get('/admin/push-notifications', 'PushNotificationsController@index');
    Route::get('/admin/edit-player/{user_id}',  array('as' => 'user_id', 'uses' => 'EditPlayerController@index'));

    /*
     * Route group for admin requests.
     */
    Route::post('admin/posts/submit', 'PushNotificationsController@submit');
    Route::post('admin/posts/remove/{post_id}', 'PushNotificationsController@remove');
=======
    Route::post('/create', 'MailController@forward');

    Route::post('/', 'MailController@store');

    Route::get('/{mail}', 'MailController@show');

    Route::delete('/{mail}', 'MailController@destroy');

    Route::get('/api/get-notifications', 'MailController@getUserNotifications');

    Route::post('/api', 'MailController@mailApi');
>>>>>>> e8bc6c83e3965dd7efe4b55df8ee59e810dbcd02
});


Route::get('/facilities', function(){
    $user = Auth::user();
    return view('facilities', compact('user'));
});

Route::get('test', function () {
    event(new \App\Events\MyEventNameHere());
    return "event fired";
});

Route::get('/galaxy-map', 'GalaxyMapController@index');

<<<<<<< HEAD
=======
});


//Route::get('get-private-messages', 'privateMessageController@getPrivateMessages');
//Route::get('get-private-message/{user}', 'privateMessageController@getPrivateMessageById');
//Route::get('get-private-message-sent', 'privateMessageController@getPrivateMessageSent');
//Route::post('send-private-message', 'privateMessageController@sendPrivateMessage');
>>>>>>> e8bc6c83e3965dd7efe4b55df8ee59e810dbcd02
