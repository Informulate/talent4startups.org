<?php

$factory('App\Models\User', [
	'username' => $faker->userName,
	'email' => $faker->email,
	'password' => $faker->password(),
	'type' => $faker->randomElement(['talent', 'startup']),
]);
