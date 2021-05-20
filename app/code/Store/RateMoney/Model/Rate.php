<?php


namespace Store\RateMoney\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

class Rate extends AbstractModel implements IdentityInterface
{
    const CACHE_TAG = 'store_rate_money';

    protected $_cacheTag = 'store_rate_money';

    protected $_eventPrefix = 'store_rate_money';

    protected function _construct()
    {
        $this->_init('Store\RateMoney\Model\ResourceModel\Rate');
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