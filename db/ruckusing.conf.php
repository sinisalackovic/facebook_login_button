<?php

$localPath = getcwd();

return [
    'db' => [
        $options['env'] => [
            'type'      => 'mysql',
            'host'      => $dbConfigData['host'],
            // 'port'      => $dbConfigData['port'],
            'database'  => $dbConfigData['dbname'],
            'user'      => $dbConfigData['username'],
            'password'  => $dbConfigData['password'],
            'charset' => 'utf8',
            //'directory' => 'custom_name',
            //'socket' => '/var/run/mysqld/mysqld.sock'
        ]
    ],
    'migrations_dir' => ['default' => $localPath . '/migrations'],
    'db_dir'         => $localPath . '/db',
    'log_dir'        => $localPath . '/logs',
    'ruckusing_base' => $localPath . '/../vendor/ruckusing/ruckusing-migrations'
];
