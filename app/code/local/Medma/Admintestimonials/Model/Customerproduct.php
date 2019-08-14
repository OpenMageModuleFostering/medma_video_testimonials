<?php

class Medma_Admintestimonials_Model_Customerproduct extends Varien_Object
{
    static public function toOptionArray()
    {

		$productCollection = Mage::getModel('catalog/product')->getCollection()
		   ->addAttributeToSelect('name')
		   ->load();

		$arr = array();
		$arr['-1']='----Please Select----';
		foreach($productCollection as $key=>$product):

			$arr[$product->getId()] = $product->getName();

		endforeach;
		return $arr;
    }
}
