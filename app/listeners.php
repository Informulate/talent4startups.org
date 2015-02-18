<?php

/*
|--------------------------------------------------------------------------
| Event Listeners
|--------------------------------------------------------------------------
|
*/

use Informulate\Messenger\Events\NewMessage;
use Informulate\Ratings\Events\StartupRated;
use Informulate\Ratings\Events\UserRated;
use Informulate\Startups\Events\StartupCreated;
use Informulate\Startups\Events\UserApplied;
use Informulate\Startups\Events\UserDenied;
use Informulate\Startups\Events\UserJoined;
use Informulate\Startups\Events\UserLeft;
use Informulate\Users\Events\ProfileCreated;
use Informulate\Users\ThreadRepository;

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
