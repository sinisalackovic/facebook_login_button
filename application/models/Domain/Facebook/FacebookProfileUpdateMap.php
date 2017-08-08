<?php

namespace Model\Domain\Facebook;

use G4\DataMapper\Common\MappingInterface;

class FacebookProfileUpdateMap implements MappingInterface
{
    public function map()
    {
        return [
            FacebookConstants::IS_ACTIVE  => 0,
            FacebookConstants::TS_UPDATED => time(),
        ];
    }
}