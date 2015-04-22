<?php namespace App\Events;

use App\Events\Event;
use Cmgmyr\Messenger\Models\Participant;
use Illuminate\Queue\SerializesModels;

class NewMessage extends Event {

	use SerializesModels;

	/**
	 * @var Participant
	 */
	public $participant;

	/**
	 * Create a new event instance.
	 *
	 * @param Participant $participant
	 */
	public function __construct(Participant $participant)
	{
		$this->participant = $participant;
	}

}
