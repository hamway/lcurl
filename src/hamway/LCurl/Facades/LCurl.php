<?php
/**
 * Created by PhpStorm.
 * User: hamway
 * Date: 13.09.14
 * Time: 17:25
 */

namespace Hamway\LCurl\Facades;
use Illuminate\Support\Facades\Facade;

class LCurl extends Facade {
	protected static function getFacadeAccessor() { return 'LCurl'; }
}