<?php

Route::get('/', [
	'as' => 'home',
	'uses' => 'PagesController@home'
]);

/**
 * Registration!
 */
Route::get('register', [
	'as' => 'register_path',
	'uses' => 'RegistrationController@create'
]);

Route::post('register', [
	'as' => 'register_path',
	'uses' => 'RegistrationController@store'
]);

/**
 * Sessions!
 */
Route::get('login', [
	'as' => 'login_path',
	'uses' => 'SessionsController@create'
]);

Route::post('login', [
	'as' => 'login_path',
	'uses' => 'SessionsController@store'
]);

Route::get('logout', [
	'as' => 'logout_path',
	'uses' => 'SessionsController@destroy'
]);

/**
 * Projects!
 */

Route::get('projects', [
	'as' => 'project_index',
	'uses' => 'ProjectController@index'
]);

Route::get('projects/{id}', [
	'as' => 'project_show',
	'uses' => 'ProjectController@show'
]);

Route::get('projects/edit', [
	'as' => 'project_edit',
	'uses' => 'ProjectController@edit'
]);

Route::get('projects/new', [
	'as' => 'new_project_path',
	'uses' => 'ProjectController@create'
]);

Route::post('projects/new', [
	'as' => 'new_project_path',
	'uses' => 'ProjectController@store'
]);

Route::delete('projects/{id}', [
	'as' => 'project_destroy',
	'uses' => 'ProjectController@destroy'
]);

/**
 * Profile!
 */
Route::get('profile', [
	'as' => 'edit_profile',
	'uses' => 'ProfileController@edit'
]);
