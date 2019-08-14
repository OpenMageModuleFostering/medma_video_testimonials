<?php

class Medma_Admintestimonials_Block_Adminhtml_Customertestimonials_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('customertestimonialsGrid');
      $this->setDefaultSort('customertestimonials_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('admintestimonials/customertestimonials')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('customertestimonials_id', array(
          'header'    => Mage::helper('admintestimonials')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'customertestimonials_id',
      ));

      $this->addColumn('customer_title', array(
          'header'    => Mage::helper('admintestimonials')->__('Title'),
          'align'     =>'left',
          'index'     => 'customer_title',
      ));

      $this->addColumn('customer_name', array(
          'header'    => Mage::helper('admintestimonials')->__('Name'),
          'align'     =>'left',
          'index'     => 'customer_name',
      ));

      $this->addColumn('customer_email', array(
          'header'    => Mage::helper('admintestimonials')->__('Email'),
          'align'     =>'left',
          'index'     => 'customer_email',
      ));

      $this->addColumn('customer_comment', array(
          'header'    => Mage::helper('admintestimonials')->__('Comments'),
          'align'     =>'left',
          'index'     => 'customer_comment',
      ));

	$this->addColumn('product_id', array(
		    'header'    => Mage::helper('sales')->__('Product Name '),
		    'renderer'  =>'Medma_Admintestimonials_Block_Adminhtml_Customertestimonials_Renderer_Customerproduct',
		    'type'      => 'text',
	));

	  /*
      $this->addColumn('content', array(
			'header'    => Mage::helper('customertestimonials')->__('Item Content'),
			'width'     => '150px',
			'index'     => 'content',
      ));
	  */

      $this->addColumn('status', array(
          'header'    => Mage::helper('admintestimonials')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
			  0 => 'Pending',	
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('admintestimonials')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('admintestimonials')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
		$this->addExportType('*/*/exportCsv', Mage::helper('admintestimonials')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('admintestimonials')->__('XML'));
	  
      return parent::_prepareColumns();
  }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('customertestimonials_id');
        $this->getMassactionBlock()->setFormFieldName('customertestimonials');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('admintestimonials')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('admintestimonials')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('admintestimonials/customerstatus')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('admintestimonials')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('admintestimonials')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

  public function getRowUrl($row)
  {
      return $this->getUrl('*/*/edit', array('id' => $row->getId()));
  }

}
