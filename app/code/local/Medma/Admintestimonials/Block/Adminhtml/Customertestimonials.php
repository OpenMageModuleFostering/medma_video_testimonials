<?php
class Medma_Admintestimonials_Block_Adminhtml_Customertestimonials extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_customertestimonials';
    $this->_blockGroup = 'admintestimonials';
    $this->_headerText = Mage::helper('admintestimonials')->__('Item Manager');
    //$this->_addButtonLabel = Mage::helper('admintestimonials')->__('Add Item');
    parent::__construct();
	$this->_removeButton('add');
  }
}
