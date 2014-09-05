<?php

$I = new FunctionalTester($scenario);
$I->am('a talent4startups memeber');
$I->wantTo('create a project');

$I->amOnPage('/projects/new');

$name = 'My first project';
$description = 'Project\'s Description Information';

$I->createAProject($name, $description);

$I->seeRecord('projects', [
	'name' => $name,
	'description' => $description
]);

//$I->seeCurrentUrlEquals('profile');
//$I->see('My first project');
