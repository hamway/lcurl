<?php
/**
 * Created by PhpStorm.
 * User: Hamway
 * Date: 21.10.14
 * Time: 1:48
 */
return array(
	'timeout'   => 50,				// Max curl timeout
	'userAgent' => true,			// Generate useragent
	'sleep'     => [				// pause between requests in seconds
		'min' => 0,
		'max' => 0
	],
	'proxy'     => false,			// use proxy
	'proxyList' => [				// proxy list
		'118.97.194.49:8080'
	]
);