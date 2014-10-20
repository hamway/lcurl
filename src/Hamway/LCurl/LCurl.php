<?php
/**
 * Created by PhpStorm.
 * User: Hamway
 * Date: 13.09.14
 * Time: 18:24
 */
namespace Hamway\LCurl;

class LCurl {
	protected $ch;
	protected $buffer = 128;
	protected $url;
	protected $charset = 'utf-8';

	/**
	 * Build an URL with an optional query string.
	 *
	 * @param  string $url   the base URL without any query string
	 * @param  array  $query array of GET parameters
	 *
	 * @return string
	 */
	public function buildUrl($url, array $query)
	{
		// append the query string
		if (!empty($query)) {
			$queryString = http_build_query($query);
			$url .= '?' . $queryString;
		}

		return $url;
	}

	/**
	 * Send get request.
	 *
	 * @param $url
	 * @param $buffer
	 * @return bool
	 */
	public function get($url) {
		if (!$url) return false;

		$this->init();
		$this->setUrl($url);

		$result = curl_exec($this->ch);

		if (!$result) {
			var_dump(curl_error($this->ch));
			return false;
		}

		curl_close($this->ch);
		$this->ch = false;

		return $result;
	}

	public function getImage($url, $saveTo = false) {
		if (!$url) return false;

		$this->initForImage();
		$this->setUrl($url);

		$result = curl_exec($this->ch);

		if (!$result) {
			var_dump(curl_error($this->ch));
			return false;
		}

		curl_close($this->ch);
		$this->ch = false;

		if($saveTo) {
			return file_put_contents($saveTo, $result);
		}

		return $result;
	}

	/**
	 * Set buffer size for curl request
	 *
	 * @param $buffer
	 */
	public function setBuffer($buffer) {
		$this->buffer = $buffer;
	}

	public function setUrl($url){
		$this->url = $url;
		curl_setopt($this->ch, CURLOPT_URL, $url);
	}

	protected function init() {
		if (!extension_loaded('curl'))
			exit('Need curl extension');

		if ($this->ch)
			return true;

		try {
			$this->ch = curl_init();
			curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
			if (!empty($this->buffer)) {
				curl_setopt($this->ch, CURLOPT_BUFFERSIZE, $this->buffer);
			}
			if(\Config::get('parser.userAgent')) {
				curl_setopt($this->ch, CURLOPT_USERAGENT, UserAgent::random_user_agent());
			}
			if(\Config::get('parser.proxy')) {
				curl_setopt($this->ch, CURLOPT_PROXY, $this->getProxy());
			}
			if(\Config::get('parser.timeout')) {
				curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, \Config::get('parser.timeout'));
			}
		} catch (\Exception $e) {
			return $e;
		}

		return true;
	}

	protected function initForImage() {
		if ($this->init()) {
			curl_setopt($this->ch, CURLOPT_HEADER, 0);
			curl_setopt($this->ch, CURLOPT_BINARYTRANSFER, 1);
			return true;
		} else {
			return false;
		}
	}

	private function getProxy()
	{
		$proxies = \Config::get('parser.proxyList');

		$max = count($proxies);
		$item = rand(0,$max);

		return $proxies[$item];
	}
}