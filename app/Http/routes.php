<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::group(['prefix' => 'api/v1'], function() {       


	// auth routing..             

	Route::post('/auth/login', "AuthenticationController@postLogin");
	Route::post('/auth/register', "AuthenticationController@postRegister");

});



