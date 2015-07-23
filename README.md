lcurl
=========
Author: Evgeny Anoykin <hamway0611@gmail.com>

A Laravel Curl library for get content via proxy or direct (support random user agents, random interval between requests).

Requirements
------------

* curl
* laravel >=4.2 (Laravel 5 not supported)

Soon
----
* Support Laravel 5
* Post request supported

How to install?
---------------
Require this package with composer using the following command:

    composer require hamway/lcurl
    
After updating composer, add the service provider to the providers array in config/app.php

    'Hamway\LCurl\LCurlServiceProvider',

And alias

    'LCurl' => 'Hamway\LCurl\Facades\LCurl',

How to configure?
-----------------
After install library ready to use. But may be configure. For publish package config use command:

    php artisan config:publish hamway/lcurl

Package configuration file example:
    
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

How to use?
-----------
Build url for request:

    LCurl::buildUrl($url, array $query)

Get page content:
    
    LCurl::get($url)

Get image from page (saveTo - path to image if need save):
    
    LCurl::getImage($url, $saveTo)

License
-------
    
lcurl is offered under the MIT license. See the LICENSE file.