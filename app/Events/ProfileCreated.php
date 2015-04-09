<?php namespace App\Events;

use App\Events\Event;

use App\Models\Profile;
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
     */
    function __construct(Profile $profile)
    {
        $this->profile = $profile;
        $this->user = $profile->user;
    }

}
