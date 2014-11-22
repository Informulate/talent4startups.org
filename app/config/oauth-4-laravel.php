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
			'client_id' => getenv('linked_in_CLIENT_ID'),
			'client_secret' => getenv('linked_in_CLIENT_SECRET'),
		],

	]

];
