<?php

class Medma_Admintestimonials_Model_Mysql4_Customertestimonials_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('admintestimonials/customertestimonials');
    }
}
