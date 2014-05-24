<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'PagesController@index']);
Route::get('/projects', ['as' => 'projects', 'uses' => 'PagesController@projects']);

Route::group(['prefix' => 'api/v1'], function()
{
	Route::resource('skills', 'SkillController');
	Route::resource('projects', 'ProjectController');
	Route::resource('users', 'UserController');
	Route::group(['prefix' => 'users/{username}'], function () {
		Route::get('skills', ['as' => 'api.v1.users.skills.index', 'uses' => 'SkillSetController@index']);
		Route::get('skills/experience', ['as' => 'api.v1.users.skills.experience', 'uses' => 'SkillSetController@experience']);
		Route::get('skills/interest', ['as' => 'api.v1.users.skills.interest', 'uses' => 'SkillSetController@interest']);
		Route::get('tags', ['as' => 'api.v1.users.tags', 'uses' => 'UserController@tags']);
	});
});

// Confide routes
Route::get( 'user/create',                 'UserController@create');
Route::get( 'user/{id}',                   'UserController@show');
Route::post('user',                        'UserController@store');
Route::get( '/login',                      'UserController@login');
Route::post('/login',                      'UserController@do_login');
Route::get( 'user/confirm/{code}',         'UserController@confirm');
Route::get( 'user/forgot_password',        'UserController@forgot_password');
Route::post('user/forgot_password',        'UserController@do_forgot_password');
Route::get( 'user/reset_password/{token}', 'UserController@reset_password');
Route::post('user/reset_password',         'UserController@do_reset_password');
Route::get( '/logout',                     'UserController@logout');
