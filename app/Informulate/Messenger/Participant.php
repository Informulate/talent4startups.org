<?php namespace Informulate\Messenger;

use Carbon\Carbon;
use Illuminate\Support\Facades\Event;
use Informulate\Messenger\Events\NewMessage;
use Laracasts\Commander\Events\EventGenerator;

class Participant extends \Cmgmyr\Messenger\Models\Participant
{
    use EventGenerator;

    public static function boot()
    {
        parent::boot();

        Participant::restored(function($participant){
            // For some reason $participant->raise() did not trigger the corrosponding listener
            Event::fire('Informulate.Messenger.Events.NewMessage', array(new NewMessage($participant)));

            return $participant;
        });

        Participant::created(function($participant){
            // For some reason $participant->raise() did not trigger the corrosponding listener
            Event::fire('Informulate.Messenger.Events.NewMessage', array(new NewMessage($participant)));

            return $participant;
        });
    }
}