<?php


namespace Store\RateMoney\Model\ResourceModel\Rate;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'store_rate_money_collection';
    protected $_eventObject = 'rate_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Store\RateMoney\Model\Rate', 'Store\RateMoney\Model\ResourceModel\Rate');
    }

}