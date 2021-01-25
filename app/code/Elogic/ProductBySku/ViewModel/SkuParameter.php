<?php

namespace Elogic\ProductBySku\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Psr\Log\LoggerInterface;

/**
 * Class SkuParameter
 */
class SkuParameter implements ArgumentInterface, IdentityInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param RequestInterface $request
     * @param ProductRepositoryInterface $productRepository
     * @param LoggerInterface $logger
     */
    public function __construct(
        RequestInterface $request,
        ProductRepositoryInterface $productRepository,
        LoggerInterface $logger
    ) {
        $this->request = $request;
        $this->productRepository = $productRepository;
        $this->logger = $logger;
    }

    /**
     * @return string|null
     */
    public function getSkuFromRequest(): ?string
    {
        return $this->request->getParam('sku');
    }

    /**
     * @return ProductInterface|null
     */
    public function getProduct(): ?ProductInterface
    {
        $sku = $this->getSkuFromRequest() ?? '';

        try {
            $product = $this->productRepository->get($sku);
        } catch (\Exception $exception) {
            $product = null;
            $error = $exception->getMessage();
            $text = 'Could not get product by sku: "%s", error: "%s"';
            $message = sprintf($text, $sku, $error);
            $this->logger->debug($message);
        }

        return $product;
    }

    /**
     * {@inheritDoc}
     */
    public function getIdentities()
    {
        /** @var ProductInterface $product */
        $product = $this->getProduct();
        return $product ? $product->getIdentities() : [];
    }
}
