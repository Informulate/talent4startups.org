<?php
return array( 

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
    'consumers' => array(

        /**
         * Facebook
         */
        'Facebook' => array(
            'client_id'     => '',
            'client_secret' => '',
            'scope'         => array(),
        ),  
		
		/**
         * Linkedin
         */		
		'Linkedin' => array(
		'client_id'     => getenv('CLIENT_ID'),
		'client_secret' => getenv('CLIENT_SECRET'),
		),  		

    )

);