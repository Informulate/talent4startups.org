<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputArgument;

use App\Commands\MatchUser as MatchUserCommand;

class MatchUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 't4s:user:match
                            {user : The ID of the user to generate matches}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate matches for a user';

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
        if ($this->argument('user') == 'all') {
            foreach (User::all(['id']) as $user) {
                $command = new MatchUserCommand($user['id']);
                $command->handle();
            }
        } else {
            $command = new MatchUserCommand($this->argument('user'));
            $command->handle();
        }
    }
}
