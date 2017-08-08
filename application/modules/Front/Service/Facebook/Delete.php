<?php

namespace Front\Service\Facebook;

use G4\CleanCore\Service\ServiceAbstract;

class Delete extends ServiceAbstract
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
        return new \Model\UseCase\Facebook\Index();
    }
}