<?php

require_once realpath(join(DIRECTORY_SEPARATOR, [__DIR__, 'bootstrap.php']));

$mysqlConnectCommand = "mysql -u {$dbConfigData['username']} -p{$dbConfigData['password']} -h {$dbConfigData['host']}";

$dbSourceFilePath = realpath(join(DIRECTORY_SEPARATOR, [__DIR__, 'db', 'initial_database_v1.0.0.sql']));

$command = '/bin/echo nothing to execute';

// CREATE DATABASE
if (in_array('create:database', $argv)) {
    $command = $mysqlConnectCommand . " --execute=\"CREATE DATABASE IF NOT EXISTS {$dbConfigData['dbname']} DEFAULT CHARSET UTF8;\"";
}

// DROP DATABASE
if (in_array('drop:database', $argv)) {
    $command = $mysqlConnectCommand . " --execute=\"DROP DATABASE IF EXISTS {$dbConfigData['dbname']};\" --force";
}

// IMPORT DATA
if (in_array('import:data', $argv)) {
    $command = $mysqlConnectCommand . " {$dbConfigData['dbname']} --execute=\"source {$dbSourceFilePath}\" --force";
}

$output = shell_exec($command);
echo("\n" . $output . "\n");