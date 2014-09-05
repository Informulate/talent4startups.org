<?php
namespace Codeception\Module;

use Laracasts\TestDummy\Factory as TestDummy;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class FunctionalHelper extends \Codeception\Module
{

	public function signIn()
	{
		$email = 'foo@example.com';
		$password = 'foo';

		$this->haveAnAccount(compact('email', 'password'));

		$I = $this->getModule('Laravel4');

		$I->amOnPage('/login');
		$I->fillField('email', $email);
		$I->fillField('Password:', $password);
		$I->click('#submit-login');
	}

	public function createAProject($name, $description)
	{
		$I = $this->getModule('Laravel4');
		$I->fillField('name', $name);
		$I->fillField('description', $description);
		$I->click('#submit-project');
	}

	public function have($model, $overrides = [])
	{
		return TestDummy::create($model, $overrides);
	}

	public function haveAnAccount($overrides = [])
	{
		return $this->have('Informulate\Users\User', $overrides);
	}

}
