<?php

namespace App\Events;

use App\Models\Startup;
use Illuminate\Queue\SerializesModels;

class StartupCreated extends Event
{

	use SerializesModels;

	/**
	 * @var Startup
	 */
	public $startup;

	/**
	 * @param Startup $startup
	 */
	function __construct(Startup $startup)
	{
		$this->startup = $startup;
	}

}
