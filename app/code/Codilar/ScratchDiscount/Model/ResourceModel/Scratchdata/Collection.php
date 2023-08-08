<?php

namespace Codilar\ScratchDiscount\Model\ResourceModel\Scratchdata;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Codilar\ScratchDiscount\Model\Scratchdata', 'Codilar\ScratchDiscount\Model\ResourceModel\Scratchdata');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>