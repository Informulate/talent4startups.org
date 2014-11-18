<?php

return [

	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session',

	/**
	 * Consumers
	 */
	'consumers' => [

		/**
		 * Linkedin
		 */
		'LinkedIn' => [
			'client_id' => getenv('LINKEDIN_CLIENT_ID'),
			'client_secret' => getenv('LINKEDIN_CLIENT_SECRET'),
		],

	]

];
