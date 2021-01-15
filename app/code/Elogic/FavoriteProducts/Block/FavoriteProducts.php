<?php

namespace Elogic\FavoriteProducts\Block;

use Magento\Framework\View\Element\Template;

/**
 * Class FavoriteProducts
 */
class FavoriteProducts extends Template
{
    /**
     * {@inheritDoc}
     */
    public function isScopePrivate()
    {
        return true;
    }
}
