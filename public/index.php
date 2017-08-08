<?php

chdir(dirname(__DIR__));

require_once './vendor/autoload.php';
require_once __DIR__ . '/../application/setup/bootstrap.php';

session_start();

(new \App\Runner())->run();