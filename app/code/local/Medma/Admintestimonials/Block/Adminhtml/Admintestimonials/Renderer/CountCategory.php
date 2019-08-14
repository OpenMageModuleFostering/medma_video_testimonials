<?php
class Medma_Admintestimonials_Block_Adminhtml_Admintestimonials_Renderer_CountCategory extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
 
	public function render(Varien_Object $row)
	{
	 	$Id = Mage::getSingleton('adminhtml/session')->getGridCatagoryId();
		$collection = Mage::getModel('admintestimonials/admintestimonials')->getCollection()->addFieldToFilter('category_id', $Id);
		
		return count($collection);
	 
	}
 
}
?>
