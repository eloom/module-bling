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

use Magento\Framework\App\Helper\Context;

class Data extends \Magento\Framework\App\Helper\AbstractHelper {

	public function __construct(Context $context) {
		parent::__construct($context);
	}
}