<?php

class Medma_Admintestimonials_Model_Mysql4_Admintestimonials_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('admintestimonials/admintestimonials');
    }
}