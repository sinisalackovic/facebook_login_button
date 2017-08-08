<?php

namespace App;

use G4\Constants\Parameters;
use G4\CleanCore\Request\Request;

class Application extends \G4\Runner\Application
{
    public function __construct(\G4\Runner\RunnerInterface $appRunner = null)
    {
        if(null !== $appRunner && $appRunner instanceof \G4\Runner\RunnerInterface) {
            $request = new Request();
            $request
                ->setModule($appRunner->getApplicationModule())
                ->setMethod($appRunner->getApplicationMethod())
                ->setResourceName($appRunner->getApplicationService())
                ->setParams($appRunner->getApplicationParams())
                ->setAjaxCall($appRunner->getHttpRequest()->isAjax())
                ->setRawInput(file_get_contents("php://input"))
                ->setServerVariables($_SERVER);

            $this
                ->setRequest($request)
                ->setAppNamespace($appRunner->getApplicationModule());
        }
    }
}   