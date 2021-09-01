<?php
/**
* 
* Bling para Magento 2
* 
* @category     elOOm
* @package      Modulo Bling
* @copyright    Copyright (c) 2021 elOOm (https://eloom.tech)
* @version      1.0.0
* @license      https://opensource.org/licenses/OSL-3.0
* @license      https://opensource.org/licenses/AFL-3.0
*
*/

declare(strict_types=1);

namespace Eloom\Bling\Lib\Http;

use Eloom\Bling\Helper\Data as Helper;
use GuzzleHttp\Client as GuzzleClient;
use Magento\Framework\App\ObjectManager;

class StoreClient {
	
	private $client;
	
	/**
	 * @var Helper
	 */
	private $helper;
	
	private $accessToken;
	
	public function __construct($storeId) {
		$this->helper = ObjectManager::getInstance()->get(Helper::class);
		$this->accessToken = $this->helper->getAccessToken($storeId);
		$url = $this->helper->getRestUrl();
		
		$this->client = new GuzzleClient([
			'base_uri' => $url
		]);
	}
	
	public function __call($method, $args) {
		if (count($args) < 1) {
			throw new \InvalidArgumentException(
				'Magic request methods require a URI and optional options array'
			);
		}
		
		$uri = $args[0];
		$options = $args[1] ?? [];
		
		return $this->request($method, $uri, $options);
	}
	
	public function request($method, $uri, $options) {
		$method = strtoupper($method);
		if ($method == 'GET' || $method == 'DELETE') {
			//$options['query'] = $options;
		} elseif ($method == 'POST' || $method == 'PUT') {
			$options['body'] = json_encode($options);
		}
		
		$options['headers'] = [
			'Content-Type' => 'application/json',
			'Accept' => 'application/json',
			'Authorization' => 'Bearer ' . $this->accessToken
		];
		
		$response = $this->client->request($method, $uri, $options);
		if (!$response || !$response->getBody()) {
			throw new Exception('Error in communication with the store.');
		}
		
		return $response->getBody()->getContents();
	}
}