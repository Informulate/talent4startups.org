<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

use Informulate\Messenger\Events\NewMessage;
use Informulate\Ratings\Events\StartupRated;
use Informulate\Ratings\Events\UserRated;
use Informulate\Registration\Events\UserRegistered;
use Informulate\Startups\Events\StartupCreated;
use Informulate\Startups\Events\UserApplied;
use Informulate\Startups\Events\UserDenied;
use Informulate\Startups\Events\UserJoined;
use Informulate\Startups\Events\UserLeft;
use Informulate\Users\Events\ProfileCreated;
use Informulate\Users\ThreadRepository;

ClassLoader::addDirectories(array(

    app_path() . '/commands',
    app_path() . '/controllers',
    app_path() . '/models',
    app_path() . '/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path() . '/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function (Exception $exception, $code) {
    Log::error($exception);
});

App::error(function (Laracasts\Validation\FormValidationException $exception, $code) {
    return Redirect::back()->withInput()->withErrors($exception->getErrors());
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function () {
    return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path() . '/filters.php';

/*
|--------------------------------------------------------------------------
| Event Listeners
|--------------------------------------------------------------------------
|
*/

Event::listen('Informulate.Users.Events.ProfileCreated', function (ProfileCreated $profileCreated) {
    switch ($profileCreated->user->type) {
        case 'talent':
            ThreadRepository::notification('auth.registration.talent', $profileCreated->user, array('user' => $profileCreated->user));
            break;
        case 'startup':
            ThreadRepository::notification('auth.registration.startup', $profileCreated->user, array('user' => $profileCreated->user));
            break;
    }
});

Event::listen('Informulate.Startups.Events.StartupCreated', function (StartupCreated $startupCreated) {
    ThreadRepository::notification('startup.created.owner', $startupCreated->startup->owner, array('startup' => $startupCreated->startup));
});

Event::listen('Informulate.Startups.Events.UserApplied', function (UserApplied $userApplied) {
    ThreadRepository::notification('startup.join.request.owner', $userApplied->startup->owner, array('startup' => $userApplied->startup, 'talent' => $userApplied->user));
});

Event::listen('Informulate.Startups.Events.UserJoined', function (UserJoined $userJoined) {
    ThreadRepository::notification('startup.join.talent', $userJoined->user, array('startup' => $userJoined->startup));
    ThreadRepository::notification('startup.join.owner', $userJoined->startup->owner, array('startup' => $userJoined->startup, 'talent' => $userJoined->user));
});

Event::listen('Informulate.Startups.Events.UserLeft', function (UserLeft $userLeft) {
    ThreadRepository::notification('startup.left.talent', $userLeft->user, array('startup' => $userLeft->startup));
    ThreadRepository::notification('startup.left.founder', $userLeft->startup->owner, array('startup' => $userLeft->startup, 'talent' => $userLeft->user));
});

Event::listen('Informulate.Startups.Events.UserDenied', function (UserDenied $userDenied) {
    ThreadRepository::notification('startup.join.request.deny.talent', $userDenied->user, array('startup' => $userDenied->startup));
});

Event::listen('Informulate.Ratings.Events.StartupRated', function (StartupRated $startupRated) {
    ThreadRepository::notification('startup.rating.owner', $startupRated->startup->owner, array('startup' => $startupRated->startup));
});

Event::listen('Informulate.Ratings.Events.UserRated', function (UserRated $userRated) {
    ThreadRepository::notification('talent.rating.talent', $userRated->user, array());
});

Event::listen('Informulate.Messenger.Events.NewMessage', function (NewMessage $newMessage) {
    $participant = $newMessage->participant;

    try {
        Mail::send('emails.message', array('subject' => $participant->thread->subject, 'body' => $participant->thread->latestMessage()->body), function ($message) use ($participant) {
            $message->from('noreply@talent4startups.org', 'Talent4Startups')
                ->to($participant->user->email, $participant->user->profile->first_name . ' ' . $participant->user->profile->last_name)
                ->subject($participant->thread->subject);
        });
    } catch (Exception $e) {

    }
});
