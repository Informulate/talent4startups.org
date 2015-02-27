<?php namespace Informulate\Messenger\Events;

use Cmgmyr\Messenger\Models\Participant;

class NewMessage
{
	/**
	 * @var Participant
	 */
	public $participant;

	/**
	 * @param Participant $participant
	 */
	function __construct(Participant $participant)
	{
		$this->participant = $participant;
	}
}
