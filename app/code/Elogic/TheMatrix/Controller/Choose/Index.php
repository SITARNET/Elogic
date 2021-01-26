<?php

namespace Elogic\TheMatrix\Controller\Choose;

use Elogic\TheMatrix\Model\ChoiceSession;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Psr\Log\LoggerInterface;

/**
 * Class Index
 */
class Index extends Action implements HttpPostActionInterface
{
    /**
     * @var ChoiceSession
     */
    private $choiceSession;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param Context $context
     * @param ChoiceSession $choiceSession
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        ChoiceSession $choiceSession,
        LoggerInterface $logger
    ) {
        parent::__construct($context);
        $this->choiceSession = $choiceSession;
        $this->logger = $logger;
    }

    /**
     * {@inheritDoc}
     */
    public function execute()
    {
        $newChoice = $this->_request->getParam(ChoiceSession::CHOICE_PILL_KEY);
        if ($newChoice) {
            try {
                $this->choiceSession->setChoice($newChoice);
            } catch (\Exception $exception) {
                $error = $exception->getMessage();
                $text = 'Could not set new choice "%s", error: "%s"';
                $message = sprintf($text, $newChoice, $error);
                $this->logger->debug($message);
            }
        }

        $refererUrl = $this->_redirect->getRefererUrl();
        return $this->_redirect($refererUrl);
    }
}
