<?php


namespace Store\RateMoney\Block;

use Magento\Framework\View\Element\Template;
use Store\RateMoney\Model\RateFactory;

class Rate extends Template
{
    private $factory;

    public function __construct(
        Template\Context $context,
        RateFactory $factory
    )
    {
        parent::__construct($context);
        $this->factory = $factory;
    }

    public function getRate()
    {
       $factory = $this->factory->create();
        $rate = $factory
            ->getCollection()
            ->addOrder('created_at', 'ASC')
            ->getLastItem();

        if ($rate->isEmpty()) {
            return null;
        }

        return $rate;
    }
}
