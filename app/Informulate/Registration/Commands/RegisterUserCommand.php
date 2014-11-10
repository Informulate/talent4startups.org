<?php namespace Informulate\Registration\Commands;

class RegisterUserCommand
{

	/**
	 * @var string $username
	 */
	public $username;

	/**
	 * @var string $email
	 */
	public $email;

	/**
	 * @var string $password
	 */
	public $password;

	/**
	 * @var string $type
	 */
	public $type;

	/**
	 * @param $username
	 * @param $email
	 * @param $password
	 * @param $type
	 */
	function __construct($username, $email, $password, $type)
	{
		$this->username = $username;
		$this->email = $email;
		$this->password = $password;
		$this->type = $type;
	}

}
