<?php

namespace App;

use Pimple\Container;
use G4\DataMapper\Engine\MySQL\MySQLAdapter;
use G4\DataMapper\Engine\MySQL\MySQLClientFactory;

class IoCContainer extends Container
{
    public static function mysqlAdapterNew()
    {
        return self::register(function (IoCContainer $c) {
            return new MySQLAdapter(
                new MySQLClientFactory($c->configData()['resources']['db']['params'])
            );
        });
    }
}