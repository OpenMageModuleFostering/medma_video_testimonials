<?php
class Medma_Admintestimonials_Block_Adminhtml_Customertestimonials_Renderer_Category extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
 
	public function render(Varien_Object $row)
	{
	 	$Id = $row->getId();
		
		$collection = Mage::getModel('admintestimonials/customertestimonials')->load($Id)->getData();
		$category_id=$collection['category_id'];
		Mage::getSingleton('adminhtml/session')->setGridCatagoryId($category_id);
		$category=Mage::getModel('catalog/category')->load($category_id)->getName();
		
		return $category;
	 
	}
 
}
?>
