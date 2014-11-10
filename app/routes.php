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

Route::get('register/linkedin', [
	'as' => 'register_linkedin',
	'uses' => 'RegistrationController@registerWithLinkedin'
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

Route::get('login/linkedin', [
	'as' => 'login_linkedin',
	'uses' => 'SessionsController@loginWithLinkedin'
]);

Route::get('logout', [
	'as' => 'logout_path',
	'uses' => 'SessionsController@destroy'
]);

/**
 * Startups!
 */
Route::resource('startups', 'StartupController');

Route::post('startups/search', [
	'as' => 'startups_search',
	'uses' => 'StartupController@search'
]);

Route::get('startups/{id}/membership', [
	'as' => 'startup_membership_request',
	'uses' => 'MembershipController@request'
]);
Route::get('startups/{startup}/membership/{user}/{action}', [
	'as' => 'startup_membership_update',
	'uses' => 'MembershipController@update'
]);
Route::get('startups/{id}/membership/cancel', [
	'as' => 'startup_membership_request_cancel',
	'uses' => 'MembershipController@destroy'
]);

/**
 * Talents!
 */
Route::resource('talents', 'TalentController');

Route::post('talent/findTalents', [
	'as' => 'talent_find',
	'uses' => 'TalentController@findTalents'
]);
/**
 * Profile!
 */
Route::get('profile', [
	'as' => 'edit_profile',
	'uses' => 'ProfileController@edit'
]);
Route::get('@{username}', [
	'as' => 'profile_path',
	'uses' => 'ProfileController@show'
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


/**
* Forgot password
*/
Route::get('password/reset', array(
  'uses' => 'PasswordController@remind',
  'as' => 'password.remind'
));
Route::post('password/reset', array(
  'uses' => 'PasswordController@request',
  'as' => 'password.request'
));
Route::get('password/reset/{token}', array(
  'uses' => 'PasswordController@reset',
  'as' => 'password.reset'
));
Route::post('password/reset/{token}', array(
  'uses' => 'PasswordController@update',
  'as' => 'password.update'
));
