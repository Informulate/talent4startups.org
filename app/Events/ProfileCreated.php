<?php namespace App\Events;

use App\Events\Event;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Queue\SerializesModels;

class ProfileCreated extends Event {

	use SerializesModels;

    /**
     * @var Profile
     */
    public $profile;
    /**
     * @var User $user
     */
    public $user;

    /**
     * @param Profile $profile
     * @param User $user
     */
    function __construct(Profile $profile, User $user)
    {
        $this->profile = $profile;
        $this->user = $user;
    }

}
