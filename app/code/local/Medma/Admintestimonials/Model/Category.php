<?php

class Medma_Admintestimonials_Model_Category extends Varien_Object
{
    static public function toOptionArray()
    {
		/*$category = Mage::getModel('catalog/category'); 
		$tree = $category->getTreeModel(); 
		$tree->load();
		$ids = $tree->getCollection()->getAllIds(); 
		$arr = array();
		$arr['-1']='----Please Select----';
		if ($ids)
		{
			foreach ($ids as $id)
			{ 
				$cat = Mage::getModel('catalog/category'); 
				$cat->load($id);
				$arr[$id] = $cat->getName();
			} 
		}
		return $arr;*/

		$categories = Mage::getModel('catalog/category')->getCollection()
           ->addAttributeToSelect('name')
             ->setLoadProductCount(true)
             ->addAttributeToFilter('is_active',array('eq'=>true))
			 ->addAttributeToFilter('level',array('neq'=>'1'))
             ->load();
		$arr = array();
		$arr['-1']='----Please Select----';
		 foreach($categories as $key=>$category):
			$prodCollection = Mage::getResourceModel('catalog/product_collection')->addCategoryFilter($category); // Magento product collection 
			 if(($prodCollection->count())!=0):
					$arr[$category->getId()] = $category->getName();
			endif; 
		  endforeach;
		  return $arr;
    }
}
