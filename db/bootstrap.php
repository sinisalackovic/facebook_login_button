<?php

chdir(dirname(__DIR__));

$options = getopt('', array('env:'));

foreach ($argv as $argument) {
    preg_match('~^env=(.*)$~uxsi', $argument, $matches);
    if (!empty($matches)) {
        $options['env'] = $matches[1];
    }
}

if (empty($options['env'])) {
    die("\nEnv param is empty\n\n");
}
define('APPLICATION_ENV', $options['env']);

require_once realpath(join(DIRECTORY_SEPARATOR, ['vendor', 'autoload.php']));

require_once realpath(join(DIRECTORY_SEPARATOR, ['application', 'setup', 'bootstrap.php']));

try {
    $applicationIniConf = new \G4\Config\Config();
    $applicationIniData = $applicationIniConf
        ->setPath(APPLICATION_CONFIG)
        ->setSection(APPLICATION_ENV)
        ->setCachingEnabled(false)
        ->getData(true);
} catch (\Exception $exception) {
    die("\n application.ini: " . $exception->getMessage() . "\n\n");
}

if(!isset($applicationIniData['resources']['db']['params']['host'])) {
    die("\nDB host param is not set\n\n");
}
if(!isset($applicationIniData['resources']['db']['params']['port'])) {
    die("\nDB port param is not set\n\n");
}
if(!isset($applicationIniData['resources']['db']['params']['dbname'])) {
    die("\nDB dbname param is not set\n\n");
}
if(!isset($applicationIniData['resources']['db']['params']['username'])) {
    die("\nDB username param is not set\n\n");
}
if(!isset($applicationIniData['resources']['db']['params']['password'])) {
    die("\nDB password param is not set\n\n");
}

$dbConfigData = $applicationIniData['resources']['db']['params'];

echo "params: {$dbConfigData['host']} | {$dbConfigData['dbname']} | {$dbConfigData['username']} | {$dbConfigData['password']}";

chdir(__DIR__);