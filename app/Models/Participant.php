<?php

namespace App\Models;

use App\Events\NewMessage;
use Cmgmyr\Messenger\Models\Participant as CmgmyrParticipant;
use Illuminate\Support\Facades\Event;

class Participant extends CmgmyrParticipant
{

	public static function boot()
	{
		parent::boot();

		Participant::created(self::raiseEvent());
		// When adding participants, the model used is the original Cmgmyr\Messenger and the created event doesn't triggered for ours so listen for it here.
		CmgmyrParticipant::created(self::raiseEvent());
	}

	/**
	 * @return callable
	 */
	private static function raiseEvent()
	{
		return function ($participant) {
			Event::fire(new NewMessage($participant));

			return $participant;
		};
	}
}
