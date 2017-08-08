<?php

namespace Model\Formatter;

use G4\CleanCore\Formatter\FormatterAbstract;

class PassThrough extends FormatterAbstract
{

    public function format()
    {
        return $this->getResource();
    }
}