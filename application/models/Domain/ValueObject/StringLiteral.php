<?php

namespace Model\Domain\ValueObject;

use Model\Domain\ValueObject\Exception\InvalidStringLiteralException;

class StringLiteral
{
    private $value;

    public function __construct($value)
    {
        if(!\is_string($value)) {
            throw new InvalidStringLiteralException($value);
        }
        $this->value = $value;
    }
    public function __toString()
    {
        return $this->value;
    }
}