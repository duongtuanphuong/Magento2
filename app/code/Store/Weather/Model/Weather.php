<?php


namespace Store\Weather\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Weather extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'store_weather_weather';

    protected $_cacheTag = 'store_weather_weather';

    protected $_eventPrefix = 'store_weather_weather';

    protected function _construct()
    {
        $this->_init('Store\Weather\Model\ResourceModel\Weather');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}