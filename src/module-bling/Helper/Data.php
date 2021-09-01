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

namespace Eloom\Bling\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class Data extends AbstractHelper {
	
	const XML_PATH_API_KEY = 'eloom_bling/general/api_key';
	
	const XML_PATH_ACCESS_TOKEN = 'eloom_bling/general/access_token';
	
	protected $storeManager;
	
	public function __construct(Context               $context,
	                            StoreManagerInterface $storeManager) {
		$this->storeManager = $storeManager;
		parent::__construct($context);
	}
	
	public function getRestUrl() {
		$storeUrl = $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_WEB);
		
		return "{$storeUrl}rest/V1/";
	}
	
	public function getApiKey($storeId = null) {
		$value = $this->scopeConfig->getValue(self::XML_PATH_API_KEY, ScopeInterface::SCOPE_STORE, $storeId);
		
		return trim($value);
	}
	
	public function getAccessToken($storeId = null) {
		$value = $this->scopeConfig->getValue(self::XML_PATH_ACCESS_TOKEN, ScopeInterface::SCOPE_STORE, $storeId);
		
		return trim($value);
	}
}