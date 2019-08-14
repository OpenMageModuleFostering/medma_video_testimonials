<?php

class Medma_Admintestimonials_Block_Adminhtml_Admintestimonials_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);

      $categoryArr = $this->_categotyFilter();

      $fieldset = $form->addFieldset('admintestimonials_form', array('legend'=>Mage::helper('admintestimonials')->__('Item information')));

	  if(count($categoryArr) > 0){

		$this->setTemplate('admintestimonials/form.phtml');

      }else {

			$fieldset->addField('category_id', 'select', array(
			'label'     => Mage::helper('admintestimonials')->__('Category'),
			'name'      => 'category_id',
			'required'  =>true,
			'values'    => Mage::getModel('admintestimonials/category')->toOptionArray(),

			));     


			$fieldset->addField('addmore', 'note', array(
			'text'      => $this->getLayout()->createBlock('adminhtml/widget_button')->setData(array(
			'label'     => Mage::helper('admintestimonials')->__('Add More Video '),
			'onclick'   => "addNewDiv();",
			'class' 	  => '',
			))    ->toHtml(),
			));	


			$fieldset->addField('video_link_length', 'hidden', array(
			'label'     => Mage::helper('admintestimonials')->__('Youtube Video Url'),
			'name'      => 'video_link_length',
			));

			$fieldset->addField('video_url', 'text', array(
			  'label'     => Mage::helper('admintestimonials')->__('Youtube Video Url'),
			  'class'     => 'required-entry',
			  'required'  => true,
			  'name'      => 'video_url_1',
			));

			$fieldset->addField('position', 'text', array(
			'label'     => Mage::helper('admintestimonials')->__('Position'),
			'required'  =>  true,
			'name'      => 'position_1',
			));

			/*$fieldset->addField('filename', 'file', array(
			  'label'     => Mage::helper('admintestimonials')->__('File'),
			  'required'  => false,
			  'name'      => 'filename',
			));*/

			$fieldset->addField('status', 'select', array(
			  'label'     => Mage::helper('admintestimonials')->__('Status'),
			  'name'      => 'status_1',
			  'values'    => array(
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
      }

      /*$fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('admintestimonials')->__('Content'),
          'title'     => Mage::helper('admintestimonials')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));*/
     
      if ( Mage::getSingleton('adminhtml/session')->getAdmintestimonialsData() )
      {
         // $form->setValues(Mage::getSingleton('adminhtml/session')->getAdmintestimonialsData());
          Mage::getSingleton('adminhtml/session')->setAdmintestimonialsData(null);
      } elseif ( Mage::registry('admintestimonials_data') ) {
         // $form->setValues(Mage::registry('admintestimonials_data')->getData());
      }
      return parent::_prepareForm();
  }

  public function _categotyFilter()
  {
      $category_id = Mage::getSingleton('adminhtml/session')->getCategoryId();		

	  $categoryFilterCollections = Mage::getModel('admintestimonials/admintestimonials')->getCollection()->addFieldToFilter('category_id', $category_id)->getData();

	  return $categoryFilterCollections;

  }

}
