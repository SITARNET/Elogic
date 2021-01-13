<?php

declare(strict_types=1);

namespace Elogic\FavoriteProducts\Api;

use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * Interface FavoriteProductsViewInterface
 */
interface FavoriteProductsViewInterface extends ArgumentInterface
{
    /**
     * @return string[]
     */
    public function getSkus(): array;

    /**
     * @return string
     */
    public function getSkusInJson(): string;

    /**
     * @param string $sku
     * @return void
     */
    public function addBySku(string $sku): void;

    /**
     * @param string $sku
     * @return void
     */
    public function removeBySku(string $sku): void;
}
