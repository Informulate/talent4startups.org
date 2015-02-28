<?php

use Cocur\Slugify\Slugify;

$I = new FunctionalTester($scenario);

$I->am('a talent4startups memeber');
$I->wantTo('create a startup');

$I->signIn();

$I->assertTrue(Auth::check(), 'User is logged in');

$I->amOnPage('/startups/create');

// The site is currently so dependant on JS that is impossible to run tests without installing a server like Selenium or PhantomJS.
// Until I have time to figure that out, this test will not run due to the new needs requirements that are added via javascript only.

//$name = 'My first project';
//$description = 'Startup\'s Description Information';
//$slugify = Slugify::create();
//$url = $slugify->slugify($name);
//
//$I->fillField('name', $name);
//$I->fillField('description', $description);
//$I->click('#add-need');
//$I->selectOption('needs[1][role]', 1);
//$I->click('#submit-startup');
//
//$I->seeRecord('startups', [
//	'name' => $name,
//	'description' => $description,
//	'url' => $url
//]);
//
//$I->seeCurrentUrlEquals('/startups/'.$url);
//$I->see($name);
