<?php

namespace Elogic\TheMatrix\Plugin;

use Elogic\TheMatrix\Model\ChoiceSession;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\Http\Context as HttpContext;

/**
 * Class MatrixChoiceCacheSegmentationPlugin
 */
class MatrixChoiceCacheSegmentationPlugin
{
    /**
     * @var HttpContext
     */
    private $httpContext;

    /**
     * @var ChoiceSession
     */
    private $choiceSession;

    /**
     * @param HttpContext $httpContext
     * @param ChoiceSession $choiceSession
     */
    public function __construct(
        HttpContext $httpContext,
        ChoiceSession $choiceSession
    ) {
        $this->httpContext = $httpContext;
        $this->choiceSession = $choiceSession;
    }

    /**
     * @param ActionInterface $subject
     * @param $result
     * @return mixed
     */
    public function afterExecute(ActionInterface $subject, $result)
    {
        $currentValue = $this->choiceSession->getChoice();
        $this->httpContext->setValue(ChoiceSession::CHOICE_PILL_KEY, $currentValue, '');
        return $result;
    }
}
