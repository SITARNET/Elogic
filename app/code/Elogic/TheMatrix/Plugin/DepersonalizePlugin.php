<?php

namespace Elogic\TheMatrix\Plugin;

use Elogic\TheMatrix\Model\ChoiceSession;
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
     * @var ChoiceSession
     */
    private $choiceSession;

    /**
     * @var string|null
     */
    private $choice;

    /**
     * @param DepersonalizeChecker $depersonalizeChecker
     * @param ChoiceSession $choiceSession
     */
    public function __construct(
        DepersonalizeChecker $depersonalizeChecker,
        ChoiceSession $choiceSession
    ) {
        $this->depersonalizeChecker = $depersonalizeChecker;
        $this->choiceSession = $choiceSession;
    }

    /**
     * @param LayoutInterface $subject
     */
    public function beforeGenerateXml(LayoutInterface $subject)
    {
        if ($this->depersonalizeChecker->checkIfDepersonalize($subject)) {
            $this->choice = $this->choiceSession->getChoice();
        }
    }

    /**
     * @param LayoutInterface $subject
     * @param LayoutInterface $result
     * @return LayoutInterface
     */
    public function afterGenerateXml(LayoutInterface $subject, $result)
    {
        if ($this->choice && $this->depersonalizeChecker->checkIfDepersonalize($subject)) {
            $this->choiceSession->setChoice($this->choice);
        }

        return $result;
    }
}
