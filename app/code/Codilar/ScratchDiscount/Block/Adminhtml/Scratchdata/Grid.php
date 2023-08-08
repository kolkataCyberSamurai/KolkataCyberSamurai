<?php
namespace Codilar\ScratchDiscount\Block\Adminhtml\Scratchdata;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Codilar\ScratchDiscount\Model\scratchdataFactory
     */
    protected $_scratchdataFactory;

    /**
     * @var \Codilar\ScratchDiscount\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Codilar\ScratchDiscount\Model\scratchdataFactory $scratchdataFactory
     * @param \Codilar\ScratchDiscount\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Codilar\ScratchDiscount\Model\ScratchdataFactory $ScratchdataFactory,
        \Codilar\ScratchDiscount\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_scratchdataFactory = $ScratchdataFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_scratchdataFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'entity_id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'entity_id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );


		
				$this->addColumn(
					'product_id',
					[
						'header' => __('Product Id'),
						'index' => 'product_id',
					]
				);
				
				$this->addColumn(
					'question',
					[
						'header' => __('Question'),
						'index' => 'question',
					]
				);
				
				$this->addColumn(
					'all_answer',
					[
						'header' => __('All Answer'),
						'index' => 'all_answer',
					]
				);
				
				$this->addColumn(
					'correct_answer',
					[
						'header' => __('Correct Answer'),
						'index' => 'correct_answer',
					]
				);
				


		
        //$this->addColumn(
            //'edit',
            //[
                //'header' => __('Edit'),
                //'type' => 'action',
                //'getter' => 'getId',
                //'actions' => [
                    //[
                        //'caption' => __('Edit'),
                        //'url' => [
                            //'base' => '*/*/edit'
                        //],
                        //'field' => 'entity_id'
                    //]
                //],
                //'filter' => false,
                //'sortable' => false,
                //'index' => 'stores',
                //'header_css_class' => 'col-action',
                //'column_css_class' => 'col-action'
            //]
        //);
		

		
		   $this->addExportType($this->getUrl('scratchdiscount/*/exportCsv', ['_current' => true]),__('CSV'));
		   $this->addExportType($this->getUrl('scratchdiscount/*/exportExcel', ['_current' => true]),__('Excel XML'));

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

	
    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('entity_id');
        //$this->getMassactionBlock()->setTemplate('Codilar_ScratchDiscount::scratchdata/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('scratchdata');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('scratchdiscount/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('scratchdiscount/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    ]
                ]
            ]
        );


        return $this;
    }
		

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('scratchdiscount/*/index', ['_current' => true]);
    }

    /**
     * @param \Codilar\ScratchDiscount\Model\scratchdata|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		
        return $this->getUrl(
            'scratchdiscount/*/edit',
            ['entity_id' => $row->getId()]
        );
		
    }

	

}