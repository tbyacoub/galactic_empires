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
    return view('welcome');
});

//Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'visitors'], function(){
    // Registration Routes
    Route::get('/register', 'RegistrationController@register');
    Route::post('/register', 'RegistrationController@postRegister');


    // Login Routes
    Route::get('/login', 'LoginController@login');
    Route::post('/login', 'LoginController@postLogin');
});




// Logout Route
Route::post('/logout', 'LoginController@postLogout');

// Admin Routes
Route::get('/admin', 'AdminController@adminHome')->middleware('admin');

// Player Routes
Route::get('/player', 'PlayerController@playerHome')->middleware('players');

// Activation
Route::get('/activate/{email}/{activationCode}', 'ActivationController@activate');