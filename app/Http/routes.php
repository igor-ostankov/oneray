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

/**
 * Workspaces
 */
Route::group(['domain' => '{workspace}.'.env('APP_DOMAIN')], function()
{
	Route::get('/', ['as' => 'workspace.home', 'uses' => 'HomeController@index'] );
	Route::get('login', 'Auth\AuthController@getLogin');
	Route::post('login', 'Auth\AuthController@postLogin');
	Route::get('logout', 'Auth\AuthController@getLogout');
	Route::group(['middleware' => 'workspaceHasDomain'], function() {
		Route::get('register', 'Auth\AuthController@getRegister');
		Route::post('register', 'Auth\AuthController@postRegister');
		Route::get('register/email', 'Auth\AuthController@getMailSent');
		Route::match(['get', 'post'], 'register/{token}', 'Auth\AuthController@storeRegister');
	});
	Route::controllers([
		'password' => 'Auth\PasswordController',
	]);

	/**
	 * Need Auth
	 */
	Route::group(['middleware' => 'auth'], function() {
		Route::get('user/profile', 'UserController@showProfile');
		Route::patch('user/profile', 'UserController@updateProfile');
	});
});

/**
 * Root Domain
 */
Route::match(['get', 'post'], '/', 'WorkspaceController@signIn');

Route::match(['get', 'post'], 'create', 'WorkspaceController@createToken');
Route::get('create/email', 'WorkspaceController@createMailSent');
Route::match(['get', 'post'], 'create/{token}', 'WorkspaceController@create');

