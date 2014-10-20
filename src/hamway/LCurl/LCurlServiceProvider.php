<?php
/**
 * Created by PhpStorm.
 * User: hamway
 * Date: 13.09.14
 * Time: 18:41
 */

namespace Hamway\LCurl;

use Illuminate\Support\ServiceProvider;

class LCurlServiceProvider extends ServiceProvider {
	protected $defer = false;
	public function boot()
	{
		$this->package('hamway/lcurl');
	}
	public function register()
	{
		$this->app['LCurl'] = $this->app->share(function($app){
			return new LCurl;
		});
		$this->app->booting(function(){
			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('LCurl', 'Hamway\LCurl\Facades\LCurl');
		});
	}
	public function provides() {
		return array('LCurl');
	}
} 