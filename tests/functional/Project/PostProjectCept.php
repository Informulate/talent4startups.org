<?php

use Cocur\Slugify\Slugify;

$I = new FunctionalTester($scenario);
$I->am('a talent4startups memeber');
$I->wantTo('create a project');

$I->amOnPage('/login');
$I->fillField('#email', 'test@gmail.com');
$I->fillField('#password', '12345');
$I->click('#submit-login');
$I->amOnPage('/projects/create');

$name = 'My first project';
$description = 'Project\'s Description Information';
$slugify = Slugify::create();
$url = $slugify->slugify($name);

$I->createAProject($name, $description);

$I->seeRecord('projects', [
	'name' => $name,
	'description' => $description,
	'url' => $url
]);

$I->seeCurrentUrlEquals('/projects/'.$url);
$I->see($name);
