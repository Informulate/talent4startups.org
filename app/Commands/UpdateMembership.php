<?php namespace App\Commands;

use App\Models\Startup;
use App\Models\User;
use App\Repositories\StartupRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Flash;

class UpdateMembership extends Command implements SelfHandling {

	protected $user, $startup, $action;

	/**
	 * Create a new command instance.
	 *
	 * @param User $user
	 * @param Startup $startup
	 * @param $action
	 */
	public function __construct(User $user, Startup $startup, $action)
	{
		$this->user = $user;
		$this->startup = $startup;
		$this->action = $action;
	}

	/**
	 * Execute the command.
	 *
	 * @param StartupRepository $repository
	 * @return static
	 */
	public function handle(StartupRepository $repository)
	{
		switch ($this->action) {
			case 'approve':
				$repository->approveMemberRequest($this->user, $this->startup);
				Flash::message("Congratulations! {$this->user->first_name} {$this->user->last_name} has been accepted into your startup!");
				break;
			case 'reject':
				$repository->rejectMemberRequest($this->user, $this->startup);
				Flash::message("{$this->user->first_name} {$this->user->last_name} has been rejected from your startup!");
				break;
		}

		return $this->startup;
	}

}
