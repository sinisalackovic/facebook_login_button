<?php

namespace Front\Service\Index;

use G4\CleanCore\Service\ServiceAbstract;

class Index extends ServiceAbstract
{
    public function getMeta()
    {
        return [];
    }

    public function getFormatterInstance()
    {
        return new \Model\Formatter\PassThrough();
    }

    public function getUseCaseInstance()
    {
        return new \Model\UseCase\Index\Index();
    }
}