<?php

$I = new FunctionalTester($scenario);
$I->am('a talent4startups memeber');
$I->wantTo('create a project');

$I->amOnPage('/profile');
$I->createAProject('My first project', 'Project\'s Description Information');

$I->seeCurrentUrlEquals('profile');
$I->see('My first project');
