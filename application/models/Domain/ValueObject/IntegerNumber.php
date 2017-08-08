<?php

namespace Model\Domain\ValueObject;

use InvalidIntegerNumberException;

class IntegerNumber
{
    private $value;

    public function __construct($value)
    {
        if ($value === true || \filter_var($value, FILTER_VALIDATE_INT) === false) {
            throw new InvalidIntegerNumberException($value);
        }
        $this->value = \intval($value);
    }
    public function __toString()
    {
        return (string) $this->getValue();
    }

    public function getValue()
    {
        return $this->value;
    }
}