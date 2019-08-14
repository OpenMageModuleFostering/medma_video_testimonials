<?php

class Medma_Admintestimonials_Model_Customerstatus extends Varien_Object
{
 	const STATUS_PENDING	= 0;
    const STATUS_ENABLED	= 1;
    const STATUS_DISABLED	= 2;


    static public function getOptionArray()
    {
        return array(
			self::STATUS_PENDING    => Mage::helper('admintestimonials')->__('Pending'),
            self::STATUS_ENABLED    => Mage::helper('admintestimonials')->__('Enabled'),
            self::STATUS_DISABLED   => Mage::helper('admintestimonials')->__('Disabled')
        );
    }
}
