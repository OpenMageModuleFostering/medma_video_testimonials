<?php
class Medma_Admintestimonials_Block_Admintestimonials extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getAdmintestimonials()     
     { 
        if (!$this->hasData('admintestimonials')) {
            $this->setData('admintestimonials', Mage::registry('admintestimonials'));
        }
        return $this->getData('admintestimonials');
        
    }
}