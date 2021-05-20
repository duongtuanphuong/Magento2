<?php


namespace Store\Weather\Model\ResourceModel\Weather;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'store_weather_weather_collection';
    protected $_eventObject = 'weather_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Store\Weather\Model\Weather', 'Store\Weather\Model\ResourceModel\Weather');
    }

}