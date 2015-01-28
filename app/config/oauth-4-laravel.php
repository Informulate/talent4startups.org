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
		'linked_in' => [
			'client_id' => getenv('LINKED_IN_CLIENT_ID'),
			'client_secret' => getenv('LINKED_IN_CLIENT_SECRET'),
		],

	]

];
