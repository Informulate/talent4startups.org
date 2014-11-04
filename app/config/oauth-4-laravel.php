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
		'client_id'     => '753icicqfipaa2',
		'client_secret' => 'vJZ6HKbfP14w6JCx',
		),  		

    )

);