<?php
namespace Codilar\ScratchDiscount\Model\ResourceModel;

class Scratchdata extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('custom_product_question', 'entity_id');
    }
}
?>