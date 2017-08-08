<?php

namespace Front;

use G4\CleanCore\Bootstrap\BootstrapAbstract;

class Bootstrap extends BootstrapAbstract
{
    public function init()
    {
        // Needs for Facebook
        if(!session_id()) {
            session_start();
        }
    }
}