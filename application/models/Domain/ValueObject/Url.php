<?php

namespace Model\Domain\ValueObject;

use Model\Domain\ValueObject\Exception\InvalidUrlException;

class Url
{
    private $value;

    public function __construct($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_URL) === false) {
            $this->value = $value;
        } else {
            throw new InvalidUrlException($value);
        }
    }

    public function __toString()
    {
        return $this->value;
    }
}