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
Route::resource('projects', 'ProjectController');
Route::get('projects/{id}/membership', [
	'as' => 'project_membership_request',
	'uses' => 'MembershipController@request'
]);
Route::get('projects/{project}/membership/{user}/{action}', [
	'as' => 'project_membership_update',
	'uses' => 'MembershipController@update'
]);
Route::get('projects/{id}/membership/cancel', [
	'as' => 'project_membership_request_cancel',
	'uses' => 'MembershipController@destroy'
]);

/**
 * Talents!
 */
Route::resource('talents', 'TalentController');

/**
 * Profile!
 */
Route::get('profile', [
	'as' => 'edit_profile',
	'uses' => 'ProfileController@edit'
]);

Route::post('profile', [
	'as' => 'edit_profile',
	'uses' => 'ProfileController@store'
]);
/**
* Reset password
*/

Route::get('reset_password', [
	'as' => 'reset_password',
	'uses' => 'ProfileController@resetPasswordForm'
]);


Route::post('reset_password', [
	'as' => 'reset_password',
	'uses' => 'ProfileController@resetPassword'
]);