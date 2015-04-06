<?php namespace App\Commands;

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

		$user = $this->users->findOrCreate($this->getLinkedinUser(), $type);

		$this->auth->login($user, true);

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
