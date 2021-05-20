<?php

namespace Store\ShopApi\Api;
use Store\ShopApi\Api\Data\ProductInterface;
use Magento\Framework\Exception\NoSuchEntityException;


interface ProductRepositoryInterface
{
    /**
     *
     * @param int $id
     * @return ProductInterface
     * @throws NoSuchEntityException
     */
    public function getProductById($id);

}
