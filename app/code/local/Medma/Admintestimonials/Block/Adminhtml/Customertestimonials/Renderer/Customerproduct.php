<?php
class Medma_Admintestimonials_Block_Adminhtml_Customertestimonials_Renderer_Customerproduct extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
 
	public function render(Varien_Object $row)
	{
	 	$Id = $row->getId();
		
		$collection = Mage::getModel('admintestimonials/customertestimonials')->load($Id)->getData();
		$product_id=$collection['product_id'];
		//Mage::getSingleton('adminhtml/session')->setGridCatagoryId($category_id);
		$productName=Mage::getModel('catalog/product')->load($product_id)->getName();
		
		return $productName;
	 
	}
 
}
?>
