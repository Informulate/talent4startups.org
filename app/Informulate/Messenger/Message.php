<?php namespace Informulate\Messenger;

use Illuminate\Support\Collection;
use Informulate\Messenger\Events\NewMessage;
use Misd\Linkify\Linkify;

class Message extends \Cmgmyr\Messenger\Models\Message
{
    /**
     * The attributes that can be set with Mass Assignment.
     *
     * @var array
     */
    protected $fillable = ['thread_id', 'user_id', 'body', 'type'];

    public function linkify()
    {
        $linkify = new Linkify();
        return $linkify->process($this->body);
    }
}