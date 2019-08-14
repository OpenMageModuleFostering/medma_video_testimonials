<?php

class Medma_Admintestimonials_Model_Customertestimonials extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('admintestimonials/customertestimonials');
    }
}
