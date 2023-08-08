<?php
namespace Codilar\ScratchDiscount\Block\Adminhtml\Scratchdata\Edit;

/**
 * Admin page left menu
 */
class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('scratchdata_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Scratchdata Information'));
    }
}