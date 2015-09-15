<?php

namespace App\Console\Commands;

use App\Models\Message;
use Illuminate\Console\Command;

class ResendMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 't4s:message:resend
                            {message : The ID of the message to resend}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resends a message via email.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $id = $this->argument('message');

        $message = Message::findOrFail($id);

        foreach($message->participants as $participant) {
            if ($participant->user->id != $message->user->id || $message->type == 'notification') {
                $this->info('Emailing user ' . $participant->user->id);
                Event::fire('App.Events.NewMessage', [new NewMessage($participant)]);
            }
        }
    }
}
