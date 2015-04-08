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

Route::get('/', [
	'as' => 'home',
	'uses' => 'WelcomeController@index'
]);

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/404', [
	'as' => '404',
	'uses' => 'PagesController@missing'
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

Route::get('auth/linkedin', [
	'as' => 'linked_in',
	'uses' => 'Auth\\AuthController@linkedin'
]);

Route::get('logout', [
	'as' => 'logout_path',
	'uses' => 'SessionsController@destroy'
]);

Route::get('auth/type', [
	'as' => 'store_type_path',
	'uses' => 'Auth\\AuthController@type'
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
 * Static Pages
 */
Route::get('about', array(
	'uses' => 'PagesController@about',
	'as' => 'about'
));
Route::get('contact', array(
	'uses' => 'PagesController@contact',
	'as' => 'contact'
));
Route::get('manifesto', array(
	'uses' => 'PagesController@manifesto',
	'as' => 'manifesto'
));
Route::get('faq', array(
	'uses' => 'PagesController@faq',
	'as' => 'faq'
));
Route::get('sponsors', array(
	'uses' => 'PagesController@sponsors',
	'as' => 'sponsors'
));
Route::get('knowledge-base', array(
	'uses' => 'PagesController@knowledgebase',
	'as' => 'knowledgebase'
));
Route::get('terms', array(
	'uses' => 'PagesController@about',
	'as' => 'terms'
));
Route::get('privacy', array(
	'uses' => 'PagesController@privacy',
	'as' => 'privacy'
));
Route::get('termsofservice', array(
	'uses' => 'PagesController@termsOfService',
	'as' => 'termsOfService'
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
