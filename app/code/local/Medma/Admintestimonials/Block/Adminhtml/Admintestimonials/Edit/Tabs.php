<?php

class Medma_Admintestimonials_Block_Adminhtml_Admintestimonials_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('admintestimonials_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('admintestimonials')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('admintestimonials')->__('Item Information'),
          'title'     => Mage::helper('admintestimonials')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('admintestimonials/adminhtml_admintestimonials_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}