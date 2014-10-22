<?php

$I = new FunctionalTester($scenario);
$I->am('a talent4startups memeber');
$I->wantTo('login to my talent4startups account');
$I->amOnPage('/login');
$I->fillField('#email', 'test@gmail.com');
$I->fillField('#password', '12345');
$I->click('#submit-login');
$I->amOnPage('/profile');
$I->assertTrue(Auth::check());
$I->see('Welcome back to Talent4Startups!');
