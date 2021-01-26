<?php

namespace Elogic\TheMatrix\Model;

use Magento\Framework\Session\SessionManager;

/**
 * Class ChoiceSession
 */
class ChoiceSession extends SessionManager
{
    /**
     * Pill choice key
     */
    public const CHOICE_PILL_KEY = 'pill_choice';

    /**
     * Red pill choice value
     */
    public const CHOICE_PILL_RED = 'red_pill_chosen';

    /**
     * Blue pill choice value
     */
    public const CHOICE_PILL_BLUE = 'blue_pill_chosen';

    /**
     * @param string $choice
     * @return void
     */
    public function setChoice(string $choice): void
    {
        $this->storage->setData(self::CHOICE_PILL_KEY, $choice);
    }

    /**
     * @return string|null
     */
    public function getChoice(): ?string
    {
        return $this->storage->getData(self::CHOICE_PILL_KEY);
    }
}
