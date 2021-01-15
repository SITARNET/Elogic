<?php

namespace Elogic\FavoriteProducts\ViewModel;

use Elogic\FavoriteProducts\Api\FavoriteProductsViewInterface;
use Elogic\FavoriteProducts\Model\Session as FavoriteProductsSession;
use Magento\Framework\Serialize\SerializerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class FavoriteProducts
 */
class FavoriteProducts implements FavoriteProductsViewInterface
{
    /**
     * @var FavoriteProductsSession
     */
    private $favoriteProductsSession;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param FavoriteProductsSession $favoriteProductsSession
     * @param SerializerInterface $serializer
     * @param LoggerInterface $logger
     */
    public function __construct(
        FavoriteProductsSession $favoriteProductsSession,
        SerializerInterface $serializer,
        LoggerInterface $logger
    ) {
        $this->favoriteProductsSession = $favoriteProductsSession;
        $this->serializer = $serializer;
        $this->logger = $logger;
    }

    /**
     * @return string[]
     */
    public function getSkus(): array
    {
        return $this->favoriteProductsSession->getFavoriteSkus();
    }

    /**
     * @return string
     */
    public function getSkusInJson(): string
    {
        $result = '';

        try {
            $skus = $this->getSkus();
            $result = $this->serializer->serialize($skus);
        } catch (\Exception $exception) {
            $error = $exception->getMessage();
            $text = 'Favorite Products cannot be retrieved, error: "%s"';
            $message = sprintf($text, $error);
            $this->logger->debug($message);
        }

        return $result;
    }

    /**
     * @param string $sku
     * @return void
     */
    public function addBySku(string $sku): void
    {
        $this->favoriteProductsSession->addFavoriteSku($sku);
    }

    /**
     * @param string $sku
     * @return void
     */
    public function removeBySku(string $sku): void
    {
        $this->favoriteProductsSession->removeFavoriteSku($sku);
    }
}
