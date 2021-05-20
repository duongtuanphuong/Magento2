<?php
namespace Store\ShopApi\Model;

use Store\ShopApi\Api\ConfigurableProductRepositoryInterface;
use Store\ShopApi\Api\ProductRepositoryInterface;
use Store\ShopApi\Api\Data\ProductInterfaceFactory;
use Store\ShopApi\Helper\ProductHelper;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 *
 */
class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var ProductInterfaceFactory
     */
	private $productInterfaceFactory;
    /**
     * @var ProductHelper
     */
	private $productHelper;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
	private $productRepository;

	/**
* ProductRepository constructor.
* @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
* @param ProductInterfaceFactory $productInterfaceFactory
* @param ProductHelper $productHelper
 */

	public function __construct(
		\Magento\Catalog\Api\ProductRepositoryInterface $productRepository, ProductInterfaceFactory $productInterfaceFactory,
		ProductHelper $productHelper
	)
	{
		$this->productInterfaceFactory=$productInterfaceFactory;
		$this->productHelper= $productHelper;
		$this->productRepository= $productRepository;
	}

	/**
     * @param int $id
     * @return \Store\ShopApi\Api\Data\ProductInterface
     * @throws NoSuchEntityException
     */
	public function getProductById($id)
	{
	    /** @var \Store\ShopApi\Api\Data\ProductInterface $productInterface */
		$productInterface = $this->productInterfaceFactory->create();
		try {
		    /** @var \Magento\Catalog\Api\Data\ProductInterface $product */
			$product = $this->productRepository->getById($id);
			$productInterface->setId($product->getId());
			$productInterface->setSku($product->getSku());
			$productInterface->setName($product->getName());
			$productInterface->setDescription( $product->getDescription() ? $product->getDescription():"" );
			$productInterface->setPrice($this->productHelper->formatPrice($product->getPrice()));
			$productInterface->setImages($this->productHelper->getProductImagesArray($product));
			return $productInterface;
		}catch (NoSuchEntityException $e) {
			throw NoSuchEntityException::singleField('id',$id);


		}
	}
}
?>
