<?php

class Medma_Admintestimonials_Adminhtml_AdmintestimonialsController extends Mage_Adminhtml_Controller_action
{
	public function preDispatch(){

        	#register domain event starts
        
		$generalEmail = Mage::getStoreConfig('trans_email/ident_general/email');
          $domainName = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
		

		Mage::dispatchEvent('medma_domain_authentication',
						array(
						'email' => $generalEmail,
                              'domain_name'=>$domainName,
						)

		);
		#register domain event ends

		parent::preDispatch();
    }

	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('admintestimonials/items')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
		
		return $this;
	}   
 
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}

	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('admintestimonials/admintestimonials')->load($id);
		$category_id = $model->getCategoryId();
		Mage::getSingleton('adminhtml/session')->setCategoryId($category_id);
		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('admintestimonials_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('admintestimonials/items');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('admintestimonials/adminhtml_admintestimonials_edit'))
				->_addLeft($this->getLayout()->createBlock('admintestimonials/adminhtml_admintestimonials_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('admintestimonials')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}
 
	public function newAction() {
		$this->_forward('edit');
	}
 
	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {
			
			$id = '';
			if($data['video_link_length']>0){
	
				for($i=1;$i<=$data['video_link_length'];$i++)
				{
					if($data['video_url_'.$i]!= ""){
						$id =  $data['video_row_id_'.$i];
						$data['video_url'] = $data['video_url_'.$i];
						$data['position'] = $data['position_'.$i];
						$data['status'] = $data['status_'.$i];
						$model = Mage::getModel('admintestimonials/admintestimonials');		
						$model->setData($data)
						->setId($id);
						try{

							$model->save();

						}catch (Exception $e) {

						    Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
						    Mage::getSingleton('adminhtml/session')->setFormData($data);
						    $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
						    return;

            			}
						
					}

				}

			}else {
				$data['category_id'] = $data['category_id'];
				$data['video_url'] = $data['video_url_1'];
				$data['position'] = $data['position_1'];
				$data['status'] = $data['status_1'];
				$model = Mage::getModel('admintestimonials/admintestimonials');		
				$model->setData($data)
				;//->setId($id);
				try{

					$model->save();

				}catch (Exception $e) {

		            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
		            Mage::getSingleton('adminhtml/session')->setFormData($data);
		            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
		            return;
            	}
			}

				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('admintestimonials')->__('Item was successfully saved'));
				Mage::getSingleton('adminhtml/session')->setFormData(false);

				if ($this->getRequest()->getParam('back')) {
					$this->_redirect('*/*/edit', array('id' => $model->getId()));
					return;
				}
				$this->_redirect('*/*/');
				return;
           }

	}
 
	public function deleteAction() {
		if( $this->getRequest()->getParam('id') > 0 ) {
			try {
				$model = Mage::getModel('admintestimonials/admintestimonials');
				 
				$model->setId($this->getRequest()->getParam('id'))
					->delete();
					 
				Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Item was successfully deleted'));
				$this->_redirect('*/*/');
			} catch (Exception $e) {
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
			}
		}
		$this->_redirect('*/*/');
	}

    public function massDeleteAction() {
        $admintestimonialsIds = $this->getRequest()->getParam('admintestimonials');
        if(!is_array($admintestimonialsIds)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
                foreach ($admintestimonialsIds as $admintestimonialsId) {
                    $admintestimonials = Mage::getModel('admintestimonials/admintestimonials')->load($admintestimonialsId);
                    $admintestimonials->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($admintestimonialsIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	
    public function massStatusAction()
    {
        $admintestimonialsIds = $this->getRequest()->getParam('admintestimonials');
        if(!is_array($admintestimonialsIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select item(s)'));
        } else {
            try {
                foreach ($admintestimonialsIds as $admintestimonialsId) {
                    $admintestimonials = Mage::getSingleton('admintestimonials/admintestimonials')
                        ->load($admintestimonialsId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($admintestimonialsIds))
                );
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
  
    public function exportCsvAction()
    {
        $fileName   = 'admintestimonials.csv';
        $content    = $this->getLayout()->createBlock('admintestimonials/adminhtml_admintestimonials_grid')
            ->getCsv();

        $this->_sendUploadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'admintestimonials.xml';
        $content    = $this->getLayout()->createBlock('admintestimonials/adminhtml_admintestimonials_grid')
            ->getXml();

        $this->_sendUploadResponse($fileName, $content);
    }

    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $response = $this->getResponse();
        $response->setHeader('HTTP/1.1 200 OK','');
        $response->setHeader('Pragma', 'public', true);
        $response->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0', true);
        $response->setHeader('Content-Disposition', 'attachment; filename='.$fileName);
        $response->setHeader('Last-Modified', date('r'));
        $response->setHeader('Accept-Ranges', 'bytes');
        $response->setHeader('Content-Length', strlen($content));
        $response->setHeader('Content-type', $contentType);
        $response->setBody($content);
        $response->sendResponse();
        die;
    }
}
