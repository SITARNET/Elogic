<?php

namespace Elogic\FavoriteProducts\Controller\Products;

use Elogic\FavoriteProducts\Api\FavoriteProductsViewInterface;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Psr\Log\LoggerInterface;

/**
 * Class Remove
 */
class Remove extends Action implements HttpPostActionInterface
{
    /**
     * @var JsonFactory
     */
    private $jsonResultFactory;

    /**
     * @var FavoriteProductsViewInterface
     */
    private $favoriteProductsView;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param Context $context
     * @param JsonFactory $jsonResultFactory
     * @param FavoriteProductsViewInterface $favoriteProductsView
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        JsonFactory $jsonResultFactory,
        FavoriteProductsViewInterface $favoriteProductsView,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->jsonResultFactory = $jsonResultFactory;
        $this->favoriteProductsView = $favoriteProductsView;
        $this->logger = $logger;
    }

    /**
     * {@inheritDoc}
     */
    public function execute()
    {
        if (!$this->_request->isAjax()) {
            /** @var Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/*/');
        }

        /** @var Json $jsonResult */
        $jsonResult = $this->jsonResultFactory->create();
        $jsonResult->setData(['result' => false]);
        if (!($favoriteSku = (string)$this->_request->getParam('favorite_sku'))) {
            return $jsonResult;
        }

        try {
            $this->favoriteProductsView->removeBySku($favoriteSku);
            $skus = $this->favoriteProductsView->getSkus();
            $jsonResult->setData(['result' => true, 'count' => count($skus)]);
        } catch (\Exception $exception) {
            $error = $exception->getMessage();
            $text = 'Sku %s has not been added to Favorite Products, error: "%s"';
            $message = sprintf($text, $favoriteSku, $error);
            $this->logger->debug($message);
        }

        return $jsonResult;
    }
}
