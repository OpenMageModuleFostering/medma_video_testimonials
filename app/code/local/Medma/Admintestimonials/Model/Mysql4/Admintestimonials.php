<?php

class Medma_Admintestimonials_Model_Mysql4_Admintestimonials extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the admintestimonials_id refers to the key field in your database table.
        $this->_init('admintestimonials/admintestimonials', 'admintestimonials_id');
    }
}