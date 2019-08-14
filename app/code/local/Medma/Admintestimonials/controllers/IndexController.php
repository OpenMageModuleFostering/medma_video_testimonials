<?php
class Medma_Admintestimonials_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {    			$this->loadLayout();     
		$this->renderLayout();
    }
	
	public function vidtestuploadAction(){
	
		$params = $this->getRequest()->getParams();

		$custestModel = Mage::getModel('admintestimonials/customertestimonials');
	
		$custestModel->setData($params)->setStatus(Medma_Admintestimonials_Model_Customerstatus::STATUS_PENDING);

		try{

			$custestModel->save();
			Mage::getSingleton('core/session')->addSuccess($this->__('Video information was successfully saved'));
			$this->_redirectReferer('');
			return;

		}catch(Exception $e){

			Mage::getSingleton('core/session')->addError($this->__('There was some problem in saving data'));
			$this->_redirectReferer('');
			return;

		}

	}


}
