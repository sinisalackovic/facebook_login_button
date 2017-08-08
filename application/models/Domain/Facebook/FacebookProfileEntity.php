<?php

namespace Model\Domain\Facebook;

use Model\Domain\ValueObject\IntegerNumber;
use Model\Domain\ValueObject\StringLiteral;
use Model\Domain\ValueObject\Url;

class FacebookProfileEntity
{
    private $id;
    private $firstName;
    private $lastName;
    private $gender;
    private $locale;
    private $pictureUrl;
    private $token;
    private $link;
    private $tsUpdated;
    private $tsCreated;

    public function getId()
    {
        return $this->id->getValue();
    }

    public function setId(IntegerNumber $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getFirstName()
    {
        return (string) $this->firstName;
    }

    public function setFirstName(StringLiteral $firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getLastName()
    {
        return (string) $this->lastName;
    }

    public function setLastName(StringLiteral $lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getGender()
    {
        return (string) $this->gender;
    }

    public function setGender(StringLiteral $gender)
    {
        $this->gender = $gender;
        return $this;
    }

    public function getLocale()
    {
        return (string) $this->locale;
    }

    public function setLocale(StringLiteral $locale)
    {
        $this->locale = $locale;
        return $this;
    }

    public function getPictureUrl()
    {
        return (string) $this->pictureUrl;
    }

    public function setPictureUrl(Url $pictureUrl)
    {
        $this->pictureUrl = $pictureUrl;
        return $this;
    }

    public function getToken()
    {
        return (string) $this->token;
    }

    public function setToken(StringLiteral $token)
    {
        $this->token = $token;
        return $this;
    }

    public function getLink()
    {
        return (string) $this->link;
    }

    public function setLink(StringLiteral $link)
    {
        $this->link = $link;
        return $this;
    }

    public function getTsUpdated()
    {
        return $this->tsUpdated->getValue();
    }

    public function setTsUpdated(IntegerNumber $tsUpdated)
    {
        $this->tsUpdated = $tsUpdated;
        return $this;
    }

    public function getTsCreated()
    {
        return $this->tsCreated->getValue();
    }

    public function setTsCreated(IntegerNumber$tsCreated)
    {
        $this->tsCreated = $tsCreated;
        return $this;
    }
}