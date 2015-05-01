<?php namespace App\Commands;

use App\Models\Profile;
use App\Listeners\AuthenticateUserListener;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Bus\SelfHandling;
use Laravel\Socialite\Contracts\Factory as Socialite;
use Illuminate\Auth\Guard as Auth;

class AuthenticateUser extends Command implements SelfHandling {

	/**
	 * @var UserRepository
	 */
	private $users;

	/**
	 * @var Socialite
	 */
	private $socialite;

	/**
	 * @var Auth
	 */
	private $auth;

	/**
	 * @param UserRepository $users
	 * @param Socialite $socialite
	 * @param Auth $auth
	 */
	public function __construct(UserRepository $users, Socialite $socialite, Auth $auth)
	{
		$this->users = $users;
		$this->socialite = $socialite;
		$this->auth = $auth;
	}

	/**
	 * @param boolean $hasCode
	 * @param AuthenticateUserListener $listener
	 * @param $type
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	public function execute($hasCode, AuthenticateUserListener $listener, $type)
	{
		if ( ! $hasCode) return $this->getAuthorizationFirst();

		$linkedInData = $this->getLinkedinUser();

		$user = $this->users->findOrCreate($linkedInData, $type);

		$this->auth->login($user, true);

		if (is_null($user->profile)) {
			$name = explode(' ', $linkedInData->name);
			$profile = new Profile(['first_name' => head($name), 'last_name' => last($name)]);
			$user->profile()->save($profile);
		}

		return $listener->userHasLoggedIn($user);
	}

	/**
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	private function getAuthorizationFirst()
	{
		return $this->socialite->driver('linkedin')->redirect();
	}

	/**
	 * @return \Laravel\Socialite\Contracts\User
	 */
	private function getLinkedinUser()
	{
		return $this->socialite->driver('linkedin')->user();
	}

}
