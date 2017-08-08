<?php

namespace Front\Service\Facebook;

use Library\Parameters;
use G4\CleanCore\Validator\Validator;
use G4\CleanCore\Service\ServiceAbstract;

class Index extends ServiceAbstract
{
    public function getMeta()
    {
        return [
            Parameters::CODE => [
                Parameters::TYPE     => Validator::TYPE_STRING,
                Parameters::REQUIRED => true,
            ],
            Parameters::STATE => [
                Parameters::TYPE     => Validator::TYPE_STRING,
                Parameters::REQUIRED => true,
            ],
        ];
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