<?php

use App\Repositories\ProfileRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Input;
use App\Models\User;

class MessageTableSeeder extends Seeder
{

    /**
     * @param UserRepository $userRepository
     * @param ProfileRepository $profileRepository
     */
    function __construct(UserRepository $userRepository, ProfileRepository $profileRepository)
    {
        $this->userRepository = $userRepository;
        $this->profileRepository = $profileRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $faker = Faker\Factory::create();
        $slugify = Slugify::create();
        $users = User::all();

        // Create message threads for all users
        foreach ($users as $user) {
            for ($x = rand(2, 4); $x < 5; $x++) {
                $thread = Thread::create(
                    [
                        'subject' => $faker->sentence(),
                    ]
                );
                // Message
                Message::create(
                    [
                        'thread_id' => $thread->id,
                        'user_id' => $user->id,
                        'body' => implode($faker->paragraphs()),
                    ]
                );

                // Sender
                Participant::create(
                    [
                        'thread_id' => $thread->id,
                        'user_id' => $user->id,
                    ]
                );

                // Recipients
                if (Input::has('recipients')) {
                    for ($i = rand(3, 4); $i < 5; $i++) {
                        $participant = array_rand($users->toArray());
                        $thread->addParticipants($users[$participant]->id);
                    }
                }

                // Create thread replies
                for ($k = rand(2, 5); $k < 5; $k++) {
                    $thread->activateAllParticipants();
                    $randUser = array_rand($users->toArray());

                    // Message
                    Message::create(
                        [
                            'thread_id' => $thread->id,
                            'user_id'   => $users[$randUser]->id,
                            'body'      => implode($faker->paragraphs()),
                        ]
                    );

                    // Add replier as a participant
                    $participant = Participant::firstOrCreate(
                        [
                            'thread_id' => $thread->id,
                            'user_id'   => $users[$randUser]->id
                        ]
                    );
                    //$participant->last_read = new Carbon;
                    $participant->save();

                    // Recipients
                    if (Input::has('recipients')) {
                        $thread->addParticipants($user->id);
                    }
                }

                if ($thread->getLatestMessageAttribute()->user->id == $user->id) {
                    $thread->markAsRead($user->id);
                }
            }
        }
    }
}
