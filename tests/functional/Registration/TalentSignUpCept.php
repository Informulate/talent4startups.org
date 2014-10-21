<?php
$I = new FunctionalTester($scenario);
$I->am('a guest');
$I->wantTo('sign up for a Talent4Startups account');

$I->amOnPage('/');
$I->click('Sign Up');
$I->click('#talent');
$I->click('#agree');
$I->click('Or sign up with email instead');

$I->amOnPage('/register');

$I->click('Sign Up As a StartUp');

$I->amOnPage('/register?userType=startup');

$I->fillField('Username:', 'JaneDoe');
$I->fillField('Email:', 'jane@example.com');
$I->fillField('Password:', 'demo');
$I->fillField('Password Confirmation:', 'demo');
$I->click('#submit-registration'); // Since we have a "Sign Up" link on the top navigation bar and the submit button also has the text "Sign Up" we need to target the input by an ID instead.

$I->amOnPage('/profile');
$I->assertTrue(Auth::check());
$I->see('Welcome to Talent4Startups');
$I->seeRecord('users', [
	'username' => 'JaneDoe',
	'email' => 'jane@example.com'
]);

$I->fillField('First Name:', 'Jane');
$I->fillField('Last Name:', 'Doe');
$I->selectOption('#agerange', '30-above');
$I->selectOption('#describe', '1');
$I->selectOption('skills[]', 'non-profie');
$I->fillField('workexperience', 'My Work experience');
$I->fillField('about', 'This is my about summary');
$I->click('#submit-profile');

$I->amOnPage('/projects/create');
$I->seeRecord('profiles', [
	'first_name' => 'Jane',
	'last_name' => 'Doe'
]);
