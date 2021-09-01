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

namespace Eloom\Bling\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Config\Block\System\Config\Form\Fieldset;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Information extends Fieldset {
	
	private $userGuide = 'https://docs.eloom.tech/bling/';
	
	protected $fieldRenderer;
	
	public function render(AbstractElement $element) {
		$html = $this->_getHeaderHtml($element);
		$html .= $this->getUserGuide($element);
		$html .= $this->_getFooterHtml($element);
		$html = preg_replace('(onclick=\"Fieldset.toggleCollapse.*?\")', '', $html);
		
		return $html;
	}
	
	private function getUserGuide($fieldset) {
		return $this->getFieldHtml($fieldset, 'magento_path', __('User Guide'), $this->userGuide);
	}
	
	protected function getFieldHtml($fieldset, $fieldName, $label = '', $value = '') {
		$field = $fieldset->addField($fieldName, 'label', [
			'name' => 'dummy',
			'label' => $label,
			'after_element_html' => $value,
		])->setRenderer($this->getFieldRenderer());
		
		return $field->toHtml();
	}
	
	private function getFieldRenderer() {
		if (empty($this->fieldRenderer)) {
			$this->fieldRenderer = $this->_layout->createBlock(Field::class);
		}
		
		return $this->fieldRenderer;
	}
	
}
