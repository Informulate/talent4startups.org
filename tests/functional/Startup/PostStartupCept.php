<?php

use Cocur\Slugify\Slugify;

$I = new FunctionalTester($scenario);

$I->am('a talent4startups memeber');
$I->wantTo('create a startup');

$I->signIn();

$I->assertTrue(Auth::check(), 'User is logged in');

$I->amOnPage('/startups/create');

$name = 'My first project';
$description = 'Startup\'s Description Information';
$slugify = Slugify::create();
$url = $slugify->slugify($name);

$I->fillField('name', $name);
$I->fillField('description', $description);
$I->click('#submit-startup');

//$I->createAProject($name, $description);

$I->seeRecord('startups', [
	'name' => $name,
	'description' => $description,
	'url' => $url
]);

$I->seeCurrentUrlEquals('/startups/'.$url);
$I->see($name);
