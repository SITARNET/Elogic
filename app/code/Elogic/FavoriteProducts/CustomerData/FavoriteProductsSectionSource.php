<?php

declare(strict_types=1);

namespace Elogic\FavoriteProducts\CustomerData;

use Elogic\FavoriteProducts\Api\FavoriteProductsViewInterface;
use Magento\Customer\CustomerData\SectionSourceInterface;

/**
 * Class FavoriteProductsSectionSource
 */
class FavoriteProductsSectionSource implements SectionSourceInterface
{
    /**
     * @var FavoriteProductsViewInterface
     */
    private $favoriteProductsView;

    /**
     * @param FavoriteProductsViewInterface $favoriteProductsView
     */
    public function __construct(
        FavoriteProductsViewInterface $favoriteProductsView
    ) {
        $this->favoriteProductsView = $favoriteProductsView;
    }

    /**
     * @return array
     */
    public function getSectionData()
    {
        return ['skus' => $this->favoriteProductsView->getSkus()];
    }
}
