<?php

namespace Elogic\FavoriteProducts\Plugin;

use Elogic\FavoriteProducts\Model\Session as FavoriteProductsSession;
use Magento\Framework\View\LayoutInterface;
use Magento\PageCache\Model\DepersonalizeChecker;

/**
 * Class DepersonalizePlugin
 */
class DepersonalizePlugin
{
    /**
     * @var DepersonalizeChecker
     */
    private $depersonalizeChecker;

    /**
     * @var FavoriteProductsSession
     */
    private $favoriteProductsSession;

    /**
     * @param DepersonalizeChecker $depersonalizeChecker
     * @param FavoriteProductsSession $favoriteProductsSession
     */
    public function __construct(
        DepersonalizeChecker $depersonalizeChecker,
        FavoriteProductsSession $favoriteProductsSession
    ) {
        $this->depersonalizeChecker = $depersonalizeChecker;
        $this->favoriteProductsSession = $favoriteProductsSession;
    }

    /**
     * @param LayoutInterface $subject
     * @param LayoutInterface $result
     * @return LayoutInterface
     */
    public function afterGenerateXml(LayoutInterface $subject, $result)
    {
        if ($this->depersonalizeChecker->checkIfDepersonalize($subject)) {
            $this->favoriteProductsSession->clearStorage();
        }

        return $result;
    }
}
