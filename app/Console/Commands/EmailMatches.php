<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EmailMatches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 't4s:user:emailMatches
                            {user : The ID of the user to generate matches}
                            {date : Only send matches created after this date}';

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
        $date = new \DateTime($this->argument('date'));
        if ($this->argument('user') == 'all') {
            foreach (User::all(['id']) as $user) {

                $startupMatches = $user->matches()->where('updated_at', '>=', $date)->limit(3)->get();

                $talentMatches = array();

                foreach ($user->startups as $startup) {
                   foreach ($startup->matches()->limit(3)->get() as $userMatch) {
                       $talentMatches[$startup->id] = $userMatch;
                   }
                }

                if ($startupMatches->count() > 0 || $talentMatches->count() > 0) {
                    $content = [
                        'recipient' => [
                            'first_name' => $user->profile->first_name,
                            'last_name' => $user->profile->last_name,
                        ],
                        'startupMatches' => $startupMatches,
                        'talentMatches' => $talentMatches,
                    ];

                    Mail::send(['html' => 'emails.match'], $content, function ($message) use ($user) {
                        $message
                            ->from('noreply@talent4startups.org', 'Talent4Startups')
                            ->to($user->email, $user->profile->first_name . ' ' . $user->profile->last_name)
                            ->subject("T4S: Matches");
                    });
                }
            }
        } else {
            $command = new MatchUserCommand($this->argument('user'));
            $command->handle();
        }
    }
}
