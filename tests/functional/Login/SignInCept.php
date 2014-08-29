<?php

$I = new FunctionalTester($scenario);
$I->am('a talent4startups memeber');
$I->wantTo('login to my talent4startups account');

$I->signIn();

$I->amOnPage('/profile');
$I->assertTrue(Auth::check());
$I->see('Welcome back to Talent4Startups!');
