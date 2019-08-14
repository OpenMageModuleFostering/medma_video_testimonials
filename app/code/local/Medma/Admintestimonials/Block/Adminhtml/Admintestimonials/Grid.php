<?php

class Medma_Admintestimonials_Block_Adminhtml_Admintestimonials_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
  public function __construct()
  {
      parent::__construct();
      $this->setId('admintestimonialsGrid');
      $this->setDefaultSort('admintestimonials_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }

  protected function _prepareCollection()
  {
      $collection = Mage::getModel('admintestimonials/admintestimonials')->getCollection()->addFieldToSelect('admintestimonials_id')->addFieldToSelect('category_id');
		
	  $collection->getSelect()->group('category_id');
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }

  protected function _prepareColumns()
  {
      $this->addColumn('admintestimonials_id', array(
          'header'    => Mage::helper('admintestimonials')->__('ID'),
          'align'     =>'right',
          'width'     => '50px',
          'index'     => 'admintestimonials_id',
      ));

      /*$this->addColumn('video_url', array(
          'header'    => Mage::helper('admintestimonials')->__('Youtube Video Url'),
          'align'     =>'left',
          'index'     => 'video_url',
      ));*/


      /*$this->addColumn('position', array(
			'header'    => Mage::helper('admintestimonials')->__('Position'),
          	'align'     =>'left',
			'index'     => 'position',
      ));*/
	  

	$this->addColumn('category_id', array(
		    'header'    => Mage::helper('sales')->__('Category '),
		    'renderer'  =>'Medma_Admintestimonials_Block_Adminhtml_Admintestimonials_Renderer_Category',
		    'type'      => 'text',
	));

	$this->addColumn('', array(
		    'header'    => Mage::helper('sales')->__('Number Of Records '),
		    'renderer'  =>'Medma_Admintestimonials_Block_Adminhtml_Admintestimonials_Renderer_CountCategory',
		    'type'      => 'text',
	));

      /*$this->addColumn('status', array(
          'header'    => Mage::helper('admintestimonials')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));*/
	  
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
        $this->setMassactionIdField('admintestimonials_id');
        $this->getMassactionBlock()->setFormFieldName('admintestimonials');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('admintestimonials')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('admintestimonials')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('admintestimonials/status')->getOptionArray();

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
