<?php

namespace Elogic\TheMatrix\ViewModel;

use Elogic\TheMatrix\Model\ChoiceSession;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * Class ChoiceView
 */
class ChoiceView implements ArgumentInterface
{
    /**
     * @var ChoiceSession
     */
    private $choiceSession;

    /**
     * @param ChoiceSession $choiceSession
     */
    public function __construct(
        ChoiceSession $choiceSession
    ) {
        $this->choiceSession = $choiceSession;
    }

    /**
     * @return string|null
     */
    public function getChoice(): ?string
    {
        return $this->choiceSession->getChoice();
    }

    /**
     * @return string
     */
    public function getBluePillState(): string
    {
        return ChoiceSession::CHOICE_PILL_BLUE;
    }

    /**
     * @return string
     */
    public function getRedPillState(): string
    {
        return ChoiceSession::CHOICE_PILL_RED;
    }

    /**
     * @return string
     */
    public function getChoiceKey(): string
    {
        return ChoiceSession::CHOICE_PILL_KEY;
    }
}
