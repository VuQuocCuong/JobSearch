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

		'Facebook' => [
			'client_id'     => '981308791934607',
			'client_secret' => '384a6eee69ebde369648aa84942d3bb6',
			'scope'         => ['public_profile']
		],

	]

];