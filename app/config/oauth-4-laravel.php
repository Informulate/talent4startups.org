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
		 * linked_in
		 */
		'Linkedin' => [
			'client_id' => getenv('LINKED_IN_CLIENT_ID'),
			'client_secret' => getenv('LINKED_IN_CLIENT_SECRET'),
		],

	]

];
