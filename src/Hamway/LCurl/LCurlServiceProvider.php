<?php
namespace Hamway\LCurl;

use Illuminate\Support\ServiceProvider;

class LCurlServiceProvider extends ServiceProvider {
	protected $defer = false;
	public function boot()
	{
		$config_path = function_exists('config_path') ? config_path('lcurl.php') : 'lcurl.php';
		$this->publishes([
			__DIR__.'/../../config/config.php' => $config_path
		], 'config');
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