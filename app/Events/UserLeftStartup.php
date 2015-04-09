<?php namespace App\Events;

use App\Events\Event;

use App\Models\Startup;
use App\Models\User;
use Illuminate\Queue\SerializesModels;

class UserLeftStartup extends Event {

	use SerializesModels;

    /**
     * @var Startup
     */
    public $startup;

    /**
     * @var User
     */
    public $user;

    /**
     * @param Startup $startup
     * @param User $user
     */
    function __construct(Startup $startup, User $user)
    {
        $this->startup = $startup;
        $this->user = $user;
    }

}
