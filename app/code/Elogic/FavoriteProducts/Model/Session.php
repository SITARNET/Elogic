<?php

namespace Elogic\FavoriteProducts\Model;

use Magento\Framework\Session\SessionManager;

/**
 * Class Session
 */
class Session extends SessionManager
{
    /**
     * Constant key for the favorite skus array
     */
    public const FAVORITE_SKUS = 'favorite_skus';

    /**
     * @return array
     */
    public function getFavoriteSkus(): array
    {
        return $this->storage->getData(self::FAVORITE_SKUS) ?? [];
    }

    /**
     * @param string $sku
     * @return void
     */
    public function addFavoriteSku(string $sku): void
    {
        $skus = $this->getFavoriteSkus();
        if (!in_array($sku, $skus)) {
            $skus[] = $sku;
            $this->storage->setData(self::FAVORITE_SKUS, $skus);
        }
    }

    /**
     * @param string $skuToBeRemoved
     * @return void
     */
    public function removeFavoriteSku(string $skuToBeRemoved): void
    {
        $skus = $this->getFavoriteSkus();
        foreach ($skus as $index => $sku) {
            if ($sku === $skuToBeRemoved) {
                unset($skus[$index]);
                break;
            }
        }

        $this->storage->setData(self::FAVORITE_SKUS, $skus);
    }
}
