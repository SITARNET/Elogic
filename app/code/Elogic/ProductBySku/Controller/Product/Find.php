<?php

namespace Elogic\ProductBySku\Controller\Product;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Find
 */
class Find extends Action implements HttpPostActionInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param Context $context
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->logger = $logger;
    }

    /**
     * {@inheritDoc}
     */
    public function execute()
    {
        $sku = $this->_request->getParam('sku');
        $redirectUrl = $this->_url->getUrl('show/product/by', ['sku' => $sku]);
        return $this->_redirect($redirectUrl);
    }
}
