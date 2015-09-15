<?php namespace App\Events;

use App\Events\Event;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Illuminate\Queue\SerializesModels;

class NewMessage extends Event {

	use SerializesModels;

	/**
	 * @var Participant
	 */
	public $participant;

	/**
	 * @var Message
	 */
	public $message;

	/**
	 * Create a new event instance.
	 *
	 * @param Participant $participant
	 * @param Message $message
	 */
	public function __construct(Participant $participant, Message $message)
	{
		$this->participant = $participant;
		$this->message = $message;
	}

}
