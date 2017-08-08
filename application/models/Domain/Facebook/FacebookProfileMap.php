<?php

namespace Model\Domain\Facebook;

use G4\DataMapper\Common\MappingInterface;

class FacebookProfileMap implements MappingInterface
{
    private $profile;

    public function __construct(FacebookProfileEntity $profile)
    {
        $this->profile = $profile;
    }

    public function map()
    {
        return [
            FacebookConstants::ID           => $this->profile->getId(),
            FacebookConstants::FIRST_NAME   => $this->profile->getFirstName(),
            FacebookConstants::LAST_NAME    => $this->profile->getLastName(),
            FacebookConstants::GENDER       => $this->profile->getGender(),
            FacebookConstants::LOCALE       => $this->profile->getLocale(),
            FacebookConstants::PICTURE      => $this->profile->getPictureUrl(),
            FacebookConstants::TOKEN        => $this->profile->getToken(),
            FacebookConstants::LINK         => $this->profile->getLink(),
            FacebookConstants::URL          => $this->profile->getPictureUrl(),
            FacebookConstants::TS_UPDATED   => time(),
            FacebookConstants::TS_CREATED   => time(),
        ];
    }

    public function format()
    {
        return [
            FacebookConstants::ID           => $this->profile->getId(),
            FacebookConstants::FIRST_NAME   => $this->profile->getFirstName(),
            FacebookConstants::LAST_NAME    => $this->profile->getLastName(),
            FacebookConstants::GENDER       => $this->profile->getGender(),
            FacebookConstants::LOCALE       => $this->profile->getLocale(),
            FacebookConstants::PICTURE      => $this->profile->getPictureUrl(),
            FacebookConstants::TOKEN        => $this->profile->getToken(),
            FacebookConstants::LINK         => $this->profile->getLink(),
            FacebookConstants::URL          => $this->profile->getPictureUrl(),
            FacebookConstants::TS_UPDATED   => $this->profile->getTsUpdated(),
            FacebookConstants::TS_CREATED   => $this->profile->getTsCreated(),
        ];
    }
}