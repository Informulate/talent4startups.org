<?php
namespace Codeception\Module;

use Informulate\Skills\Skill;
use Laracasts\TestDummy\Factory as TestDummy;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class FunctionalHelper extends \Codeception\Module
{

	public function signIn()
	{
		$data = [
			'email' => 'foo@example.com',
			'password' => 'password',
		];

		$this->haveAnAccount($data);

		$I = $this->getModule('Laravel4');

		$I->amOnPage('/login');
		$I->fillField('email', $data['email']);
		$I->fillField('Password:', $data['password']);
		$I->click('#submit-login');
	}

	public function createAProject($name, $description)
	{
		$I = $this->getModule('Laravel4');

		$I->fillField('name', $name);
		$I->fillField('description', $description);
		$I->click('#submit-startup');
	}

	public function have($model, $overrides = [])
	{
		return TestDummy::create($model, $overrides);
	}

	public function haveAnAccount($overrides = [])
	{
		$user = $this->have('Informulate\Users\User', $overrides);
		$skill = $this->haveSkills();

		$data = [
			'first_name' => 'Foo',
			'last_name' => 'Bar',
			'user_id' => $user->id,
			'skill_id' => $skill->id,
		];

		$profile = $this->have('Informulate\Users\Profile', $data);
		$user->profile = $profile;

		return $user;
	}

	public function haveSkills()
	{
		$skills = Skill::find(1);

		if (! $skills) {
			$id = 1;
			$name = 'developer';
			$overrides = compact('name', 'id');

			return $this->have('Informulate\Skills\Skill', $overrides);
		}

		return $skills;
	}
}
