<?php

namespace Elogic\ProductBySku\Block;

use Elogic\ProductBySku\ViewModel\SkuParameter;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\View\Element\Template;

/**
 * Class ProductInfoBlock
 */
class ProductInfoBlock extends Template implements IdentityInterface
{
    /**
     * {@inheritDoc}
     */
    public function getIdentities()
    {
        /** @var SkuParameter $viewModel */
        $viewModel = $this->getData('skuParameter');
        return $viewModel->getIdentities();
    }
}
