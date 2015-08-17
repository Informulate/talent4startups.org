<?php

namespace App\Commands;

use App\Commands\Command;
use App\Models\Match;
use App\Models\Need;
use App\Models\User;
use App\Repositories\MatchRepository;
use App\Repositories\StartupRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MatchUser extends Command implements SelfHandling
{
    protected $user_id;

    /**
     * Create a new command instance.
     *
     * @param $user_id
     */
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Execute the command.
     *
     */
    public function handle()
    {
        try {
            $user = User::findOrFail($this->user_id);
        } catch(ModelNotFoundException $e) {
            die('Could not find user id (' . $this->user_id . ')');
        }
        $startupRepository = new StartupRepository;

        $matchedStartups = [];

        // Find matching startups by skill
        try {
            $skill = $user->profile->skill;

            $needs = Need::where('skill_id', '=', $skill->id);

            foreach ($needs as $need) {
                $match = [
                    'startup_id' => $need->startup->id,
                    'weight' => 10,
                    'debug' => 'Match based on user:skill and startup:need:skill (' . $skill->name . ')',
                    'description' => $skill->name,
                    'need_id' => $need->id,
                ];

                $matchedStartups[$need->startup->id][] = $match;
            }

            // Find matching startups by tags (both startup tags and startup:needs:tags)
            $tags = $user->profile->tags;

            foreach ($tags as $tag) {
                $startups = $startupRepository->allActive($user->profile->tags);

                foreach ($startups as $startup) {
                    foreach ($startup->needs as $need) {
                        foreach($need->tags as $needTag) {
                            if ($needTag->name == $tag->name) {
                                $match = [
                                    'startup_id' => $startup->id,
                                    'weight' => 10,
                                    'debug' => 'Match based on user:tag and startup:need:tag (' . $tag->name . ')',
                                    'description' => $tag->name,
                                    'need_id' => $need->id,
                                ];

                                $matchedStartups[$startup->id][] = $match;
                            }
                        }
                    }
                }

                $needs = Need::wherehas('tags', function ($q) use ($tag) {
                    $q->where('tags.id', '=', $tag->id);

                })->get();

                foreach ($needs as $need) {
                    $match = [
                        'startup_id' => $need->startup->id,
                        'weight' => 10,
                        'debug' => 'Match based on user:tag and startup:need:tag (' . $tag->name . ')',
                        'description' => $tag->name,
                        'need_id' => $need->id,
                    ];

                    $matchedStartups[$need->startup->id][] = $match;
                }
            }

            // Exclude startups

            // Startups you own
            $startups = $user->startups()->get();

            foreach ($startups as $startup) {
                unset($matchedStartups[$startup->id]);
            }

            // Startups you contribute to
            $startups = $user->contributions()->get();

            foreach ($startups as $startup) {
                unset($matchedStartups[$startup->id]);
            }

            // Previous matches
            $matches = Match::where('user_id', '=', $user->id)->get();

            foreach ($matches as $match) {
                unset($matchedStartups[$match->startup_id]);
            }

            // Organize the matches
            $matchesByWeight = [];

            foreach ($matchedStartups as $startup_id => $matchData) {
                $weight = 0;
                foreach ($matchData as $match) {

                    $weight += $match['weight'];
                }
                $matchesByWeight[$startup_id] = $weight;
            }

            asort($matchesByWeight);

            // Store the matches

            foreach ($matchesByWeight as $startup_id => $weightTotal) {
                $description = [];
                foreach ($matchedStartups[$startup_id] as $matchData) {
                    $description[] = $matchData['description'];
                }
                $description = array_unique($description);

                $matchModel = Match::create([
                    'user_id' => $user->id,
                    'startup_id' => $startup_id,
                    'description' => implode(PHP_EOL, $description),
                    'weight' => $weightTotal,
                    'debug' => var_export($matchedStartups[$startup_id], true),
                ]);
                $matchModel->save();
                foreach ($matchedStartups[$startup_id] as $match) {
                    $needModel = Need::findOrFail($match['need_id']);
                    $matchModel->needs()->attach($needModel);
                }

            }

        } catch (\Exception $e) {
            echo 'Error generating matches for user id (' . $this->user_id . '): ' . $e->getMessage();
        }
    }
}
