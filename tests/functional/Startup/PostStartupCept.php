<?php

use Cocur\Slugify\Slugify;

$I = new FunctionalTester($scenario);

$I->am('a talent4startups memeber');
$I->wantTo('create a startup');

$I->signIn();

$I->amOnPage('/startups/create');

$name = 'My first project';
$description = 'Startup\'s Description Information';
$slugify = Slugify::create();
$url = $slugify->slugify($name);

$I->createAProject($name, $description);

$I->seeRecord('startups', [
	'name' => $name,
	'description' => $description,
	'url' => $url
]);

$I->seeCurrentUrlEquals('/startups/'.$url);
$I->see($name);
