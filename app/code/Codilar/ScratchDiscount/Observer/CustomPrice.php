<?php
namespace Codilar\ScratchDiscount\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Customer\Model\Session;

class CustomPrice implements ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer) {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create("Magento\Customer\Model\Session");
        $discount = $customerSession->getScratchValue();
        $item = $observer->getEvent()->getData('quote_item');
        $item = ( $item->getParentItem() ? $item->getParentItem() : $item );
        $price = $item->getProduct()->getPrice();
        $prodId = $item->getProduct()->getId();
        if(isset($discount[$prodId]) && array_key_exists($prodId,$discount)){

            $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/mylog.log');
            $logger = new \Zend_Log();
            $logger->addWriter($writer);
            $logger->info("Discount Percentage:".$discount[$prodId]);

            $discountedPrice = $price - ($price*$discount[$prodId])/100;
            $item->setCustomPrice($discountedPrice);
            $item->setOriginalCustomPrice($discountedPrice);
            $item->getProduct()->setIsSuperMode(true);
        }

        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/mylog.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        //$logger->info("Discount Percentage:".$discount[$prodId]);
    }
}
