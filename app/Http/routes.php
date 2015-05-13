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

Route::get('/', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


/**
 * Need Auth
 */
Route::group(['middleware' => 'auth'], function() {
	Route::get('user/profile', 'UserController@showProfile');
	Route::patch('user/profile', 'UserController@updateProfile');

	Route::resource('workspace', 'WorkspaceController');
});


