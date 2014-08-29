<?php namespace Informulate\Registration;

class RegisterUserCommand {

	/**
	 * @var string username
	 */
	public $username;

	/**
	 * @var string email
	 */
	public $email;

	/**
	 * @var string password
	 */
	public $password;

	/**
	 * @param $email
	 * @param $password
	 * @param $username
	 */
	function __construct($username, $email, $password)
	{
		$this->username = $username;
		$this->email = $email;
		$this->password = $password;
	}

}
