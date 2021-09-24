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

use Eloom\Bling\Lib\Exception\BlingException;
use GuzzleHttp\Client as GuzzleClient;

class BlingClient {
	
	private $client;
	
	private $apiKey;
	
	public function __construct(string $apiKey) {
		$this->apiKey = $apiKey;
		
		$this->client = new GuzzleClient([
			'base_uri' => 'https://bling.com.br/Api/v2/',
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
			$options['query'] = array_merge(['apikey' => $this->apiKey], $options);
		} elseif ($method == 'POST' || $method == 'PUT') {
			$options['form_params'] = array_merge(['apikey' => $this->apiKey], $options);
		}
		$response = $this->client->request($method, $uri, $options);
		if (!$response || !$response->getBody()) {
			throw new BlingException('Error on create Bling NF-e.');
		}
		
		return $response->getBody()->getContents();
	}
}