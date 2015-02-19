<?php

Route::get('/', [
	'as' => 'home',
	'uses' => 'PagesController@home'
]);

Route::get('/launch', [
	'as' => 'launch',
	'uses' => 'PagesController@launch'
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

Route::get('register/linked_in', [
	'as' => 'finish_linked_in_path',
	'uses' => 'RegistrationController@linkedIn'
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

Route::get('login/linkedIn', [
	'as' => 'login_linked_in',
	'uses' => 'SessionsController@loginWithLinkedIn'
]);

Route::get('register/linkedIn', [
	'as' => 'register_linked_in',
	'uses' => 'SessionsController@loginWithLinkedIn'
]);

Route::get('logout', [
	'as' => 'logout_path',
	'uses' => 'SessionsController@destroy'
]);

Route::get('session/type', [
	'as' => 'store_type_path',
	'uses' => 'SessionsController@storeUserType'
]);

/**
 * Startups!
 */
Route::resource('startups', 'StartupController');
Route::get('startups/{id}', [
    'as' => 'startup_profile',
    'uses' => 'StartupController@request'
]);
Route::get('startups/create', [
	'as' => 'startup_create',
	'uses' => 'StartupController@create'
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
/**
 * Profile!
 */
Route::get('profile', [
	'as' => 'edit_profile',
	'uses' => 'ProfileController@edit'
]);
Route::get('/users/{id}', [
	'as' => 'profile_path',
	'uses' => 'ProfileController@show'
]);
Route::get('/profile/image', [
	'as' => 'profile_image_path',
	'uses' => 'ProfileController@image'
]);
Route::post('/profile/image', [
	'as' => 'profile_image_path',
	'uses' => 'ProfileController@image'
]);
Route::post('profile', [
	'as' => 'edit_profile',
	'uses' => 'ProfileController@store'
]);
Route::post('/profile/invite/', [
	'as' => 'invite_to_startup',
	'uses' => 'ProfileController@invite'
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


/**
 * Static Pages
 */
Route::get('about', array(
    'uses' => 'StaticController@about',
    'as' => 'about'
));
Route::get('contact', array(
    'uses' => 'StaticController@contact',
    'as' => 'contact'
));
Route::get('manifesto', array(
	'uses' => 'StaticController@manifesto',
	'as' => 'manifesto'
));
Route::get('faq', array(
    'uses' => 'StaticController@faq',
    'as' => 'faq'
));
Route::get('sponsors', array(
    'uses' => 'StaticController@sponsors',
    'as' => 'sponsors'
));
Route::get('knowledge-base', array(
    'uses' => 'StaticController@knowledgebase',
    'as' => 'knowledgebase'
));
Route::get('terms', array(
	'uses' => 'StaticController@about',
	'as' => 'terms'
));


/**
 * Ratings
 */
Route::post('rating', [
	'as' => 'rating',
	'uses' => 'RatingController@rate'
]);

/**
 * Messaging
 */
Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create/{recipient?}', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::get('search/{query?}', ['as' => 'messages.search', 'uses' => 'MessagesController@searchRecipients']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('markread/{threadId}', ['as' => 'messages.markRead', 'uses' => 'MessagesController@markRead']);
    Route::get('unread/{threadId}', ['as' => 'messages.unread', 'uses' => 'MessagesController@markUnread']);
    Route::get('delete/{threadId}', ['as' => 'messages.delete', 'uses' => 'MessagesController@delete']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});
