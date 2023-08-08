<?php
/**
 * Codilar
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the marketplace.codilar.com license that is
 * http://marketplace.codilar.com/license-agreement.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category Codilar
 * @package Codilar_ScratchDiscount
 * @module ScratchDiscount
 * @author Codilar Developer*
 * @copyright Copyright (c) 2023 Codilar (https://www.codilar.com/)
 */

namespace Codilar\ScratchDiscount\Controller\Index;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\Request\Http;
use Magento\Customer\Model\Session;

class ApplyDiscount implements ActionInterface
{
    /**
     * @var Context
     */
    private Context $context;

    /**
     * @var PageFactory
     */
    private PageFactory $resultPageFactory;

    /**
     * @var JsonFactory
     */
    private JsonFactory $resultJsonFactory;

    /**
     * @var Http
     */
    private Http $request;

    /**
     * @var Session
     */
    private Session $customerSession;

    /**
     * ApplyDiscount constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param JsonFactory $resultJsonFactory
     * @param Http $request
     * @param Session $customerSession
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        Http $request,
        Session $customerSession,
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->request = $request;
        $this->customerSession = $customerSession;
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        $resultPage = $this->resultPageFactory->create();
        $params = $this->request->getParams();
        $scratchValue = $params['scratchValue'];
        $productId = $params['productId'];
        $messge ='';
        if(isset($scratchValue)){
            $this->customerSession->setScratchValue(array($productId=>$scratchValue));
            //print_r($this->customerSession->getScratchValue());
            $messge = 'Discount has been applied successfully!!!';
        }
        $result->setData(['output' => $messge]);
        return $result;
    }

}
