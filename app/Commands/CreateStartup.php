<?php namespace App\Commands;

use App\Models\Startup;
use App\Models\User;
use App\Commands\Command;
use App\Repositories\StartupRepository;
use Cocur\Slugify\Slugify;
use Illuminate\Contracts\Bus\SelfHandling;

class CreateStartup extends Command implements SelfHandling {

	protected $user, $startup;

	/**
	 * Create a new command instance.
	 *
	 * @param User $user
	 * @param $startup
	 */
	public function __construct(User $user, $startup)
	{
		$this->user = $user;
		$this->startup = $startup;
	}

	/**
	 * Execute the command.
	 *
	 * @param StartupRepository $repository
	 * @return static
	 */
	public function handle(StartupRepository $repository)
	{
		$slugify = Slugify::create();
		$startup = Startup::create(
			[
				'user_id' => $this->user->id,
				'name' => $this->startup->name,
				'description' => $this->startup->description,
				'url' => $slugify->slugify($this->startup->name),
				// 'stage_id' => $this->startup->stage_id,
				'video' => $this->startup->video,
				'published' => true
			]
		);

		$repository->save($startup);

		if (isset($this->startup->tags)) {
			$repository->updateTags($startup, $this->startup->tags);
		}

		if (isset($this->startup->needs)) {
			$repository->updateNeeds($startup, $this->startup->needs);
		}

		if (isset($this->startup->image)) {
			$repository->updateImage($startup, $this->startup->image);
		}

		return $startup;
	}

}
