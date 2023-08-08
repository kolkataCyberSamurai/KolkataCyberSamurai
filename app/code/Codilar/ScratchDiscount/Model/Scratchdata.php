<?php
namespace Codilar\ScratchDiscount\Model;

class Scratchdata extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Codilar\ScratchDiscount\Model\ResourceModel\Scratchdata');
    }
}
?>