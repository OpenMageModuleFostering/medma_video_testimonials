<?php

class Medma_Admintestimonials_Block_Adminhtml_Customertestimonials_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('customertestimonials_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('admintestimonials')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('admintestimonials')->__('Item Information'),
          'title'     => Mage::helper('admintestimonials')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('admintestimonials/adminhtml_customertestimonials_edit_tab_form')->toHtml(),
      ));
     
$this->addTab('video_section', array(
          'label'     => Mage::helper('admintestimonials')->__('Uploaded Video'),
          'title'     => Mage::helper('admintestimonials')->__('Uploaded Video'),
          'content'   => $this->getLayout()->createBlock('admintestimonials/adminhtml_customertestimonials_edit_tab_video')->toHtml(),
      ));

      return parent::_beforeToHtml();
  }
}
