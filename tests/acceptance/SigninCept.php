<?php

use Laracasts\TestDummy\Factory;

$I = new AcceptanceTester($scenario);
$I->am('talent4startups member');
$I->wantTo('login to my talent4startups account');

$user = Factory::create('App\Models\User', ['password' => 'password']);

$I->amOnPage('/');
$I->click('#login-link');
$I->canSeeCurrentUrlEquals('/auth/login');
$I->submitForm('form', ['email' => $user->email, 'password' => '']);
$I->dontSeeAuthentication();
$I->submitForm('form', ['email' => $user->email, 'password' => 'wrong_password']);
$I->dontSeeAuthentication();
$I->submitForm('form', ['email' => $user->email, 'password' => 'password']);
$I->amLoggedAs($user);
