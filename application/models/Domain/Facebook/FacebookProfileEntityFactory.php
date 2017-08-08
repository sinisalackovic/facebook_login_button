<?php

namespace Model\Domain\Facebook;

use Model\Domain\ValueObject\Url;
use Model\Domain\ValueObject\ArrayValue;
use Model\Domain\ValueObject\IntegerNumber;
use Model\Domain\ValueObject\StringLiteral;

class FacebookProfileEntityFactory
{
    public static function create(array $data)
    {
        $arrayValue = new ArrayValue($data);

        $entity = new FacebookProfileEntity();

        if($arrayValue->has(FacebookConstants::ID)) {
            $entity->setId(new IntegerNumber($arrayValue->get(FacebookConstants::ID)));
        }

        if($arrayValue->has(FacebookConstants::FIRST_NAME)) {
            $entity->setFirstName(new StringLiteral($arrayValue->get(FacebookConstants::FIRST_NAME)));
        }

        if($arrayValue->has(FacebookConstants::LAST_NAME)) {
            $entity->setLastName(new StringLiteral($arrayValue->get(FacebookConstants::LAST_NAME)));
        }

        if($arrayValue->has(FacebookConstants::GENDER)) {
            $entity->setGender(new StringLiteral($arrayValue->get(FacebookConstants::GENDER)));
        }

        if($arrayValue->has(FacebookConstants::LOCALE)) {
            $entity->setLocale(new StringLiteral($arrayValue->get(FacebookConstants::LOCALE)));
        }

        if($arrayValue->has(FacebookConstants::PICTURE)) {
            $entity->setPictureUrl(new Url($arrayValue->get(FacebookConstants::PICTURE)[FacebookConstants::URL]));
        }

        if($arrayValue->has(FacebookConstants::TOKEN)) {
            $entity->setToken(new StringLiteral($arrayValue->get(FacebookConstants::TOKEN)));
        }

        if($arrayValue->has(FacebookConstants::LINK)) {
            $entity->setLink(new StringLiteral($arrayValue->get(FacebookConstants::LINK)));
        }

        return $entity;
    }
}