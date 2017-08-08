<?php

namespace Model\Formatter;

use Model\Domain\Facebook\FacebookConstants;
use G4\CleanCore\Formatter\FormatterAbstract;
use Model\Domain\Facebook\FacebookProfileMap;

class Facebook extends FormatterAbstract
{
    public function format()
    {
        $profileEntity = $this->getResource(FacebookConstants::PROFILE_RESPONSE);

        return [
            FacebookConstants::PROFILE_RESPONSE => (new FacebookProfileMap($profileEntity))->format(),
            FacebookConstants::LOGOUT_RESPONSE  => $this->getResource(FacebookConstants::LOGOUT_RESPONSE)
        ];
    }
}