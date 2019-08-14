<?php

class Medma_Admintestimonials_Block_Adminhtml_Customertestimonials_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('customertestimonials_form', array('legend'=>Mage::helper('admintestimonials')->__('Item information')));
     
      $fieldset->addField('customer_title', 'text', array(
		'label'     => Mage::helper('admintestimonials')->__('Title'),
		'class'     => 'required-entry',
		'required'  => true,
	    'disabled'  => true,
		'name'      => 'customer_title',
      ));

      $fieldset->addField('customer_name', 'text', array(
		'label'     => Mage::helper('admintestimonials')->__('Name'),
		'class'     => 'required-entry',
		'required'  => true,
	    'disabled'  => true,
		'name'      => 'customer_name',
      ));


      $fieldset->addField('customer_email', 'text', array(
		'label'     => Mage::helper('admintestimonials')->__('Email'),
		'class'     => 'required-entry',
		'required'  => true,
	    'disabled'  => true,
		'name'      => 'customer_email',
      ));


      $fieldset->addField('customer_comment', 'editor', array(
		'label'     => Mage::helper('admintestimonials')->__('Comments'),
		'class'     => 'required-entry',
		'required'  => true,
	    'disabled'  => true,
        'style'     => 'width:300px; height:100px;',
		'name'      => 'customer_comment',
      ));


	  $fieldset->addField('product_id', 'select', array(
		'label'     => Mage::helper('admintestimonials')->__('Product Name'),
		'name'      => 'product_id',
		'required'  =>true,
	    'disabled'  => true,
		'values'    => Mage::getModel('admintestimonials/customerproduct')->toOptionArray(),

	  ));  

	
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('admintestimonials')->__('Status'),
          'name'      => 'status',
          'values'    => array(
				array(
					'value'     => 0,
					'label'     => Mage::helper('admintestimonials')->__('Pending'),
				),
				array(
					'value'     => 1,
					'label'     => Mage::helper('admintestimonials')->__('Enabled'),
				),

				array(
					'value'     => 2,
					'label'     => Mage::helper('admintestimonials')->__('Disabled'),
				),
          ),
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getCustomertestimonialsData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getCustomertestimonialsData());
          Mage::getSingleton('adminhtml/session')->setCustomertestimonialsData(null);
      } elseif ( Mage::registry('customertestimonials_data') ) {
          $form->setValues(Mage::registry('customertestimonials_data')->getData());
      }
      return parent::_prepareForm();
  }
}
