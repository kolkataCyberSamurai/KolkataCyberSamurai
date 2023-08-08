<?php
namespace Codilar\ScratchDiscount\Block;

use Magento\Framework\View\Element\Template;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Registry;
use Codilar\ScratchDiscount\Model\ResourceModel\Scratchdata\Collection;

class Popup extends Template
{
    protected $_productRepository;
    protected $_registry;
    protected $Collection;
    public function __construct(
        Collection $Collection,
        Template\Context $context,
        ProductRepositoryInterface $productRepository,
        Registry $registry,

          array $data = []
    ) {
        $this->Collection=$Collection;
        $this->_productRepository = $productRepository;
        $this->_registry = $registry;
        parent::__construct($context, $data);
    }

    public function getCurrentProduct()
    {
        return $this->_registry->registry('current_product');
    }
    public function getCollectionData():array
    {
        $id=$this->getCurrentProduct();
        $product_id=($id->getData('entity_id'));
        $filteredArray = array_filter($this->Collection->getData(), function($item) use ($product_id) {
            return $item['product_id'] == $product_id;
        });
        $questions = [];
        foreach ($filteredArray as $index => $item) {
            $options = explode(',', $item['all_answer']);
            $question = [
                'numb' => $index + 1,
                'question' => $item['question'],
                'answer' => $item['correct_answer'],
                'options' => array_map('trim', $options),
            ];
            $questions[] = $question;
        }
        if(count($questions)){
            $randomKeys = array_rand($questions, 4);
            $randomOptions = array();
            foreach ($randomKeys as $key) {
                $randomOptions[] = $questions[$key];
            }
            return $randomOptions;
        }
        else
        {
            return $questions;
        }
    }
}
