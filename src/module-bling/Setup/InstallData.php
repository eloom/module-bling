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

namespace Eloom\Bling\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface {

	private $eavSetupFactory;

	public function __construct(EavSetupFactory $eavSetupFactory) {
		$this->eavSetupFactory = $eavSetupFactory;
	}
}