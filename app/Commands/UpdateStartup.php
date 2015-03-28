<?php namespace App\Commands;

use App\Commands\Command;

use App\Models\Startup;
use App\Repositories\StartupRepository;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateStartup extends Command implements SelfHandling {

	protected $startup, $data;

	/**
	 * Create a new command instance.
	 *
	 * @param Startup $startup
	 * @param $data
	 */
	public function __construct(Startup $startup, $data)
	{
		$this->startup = $startup;
		$this->data = $data;
	}

	/**
	 * Execute the command.
	 *
	 * @param StartupRepository $repository
	 * @return Startup
	 */
	public function handle(StartupRepository $repository)
	{
		$startup = Startup::updateStartup(
			$this->startup, $this->data
		);

		$repository->save($startup);
		if (isset($this->data['tags'])) {
			$repository->updateTags($startup, $this->data['tags']);
		}

		if (isset($this->data['needs'])) {
			$repository->updateNeeds($startup, $this->data['needs']);
		}

		if (isset($this->data['image'])) {
			$repository->updateImage($startup, $this->data['image']);
		}

		return $startup;
	}

}
