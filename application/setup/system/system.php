<?php

ob_start();
gc_enable();
mb_internal_encoding('UTF-8');

defined('PATH_ROOT')             || define('PATH_ROOT',        realpath('./') . DIRECTORY_SEPARATOR);
defined('APPLICATION_ENV')       || define('APPLICATION_ENV',  (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));
defined('APP_NAME')              || define('APP_NAME',         'Application');
defined('VENDOR_NAME')           || define('VENDOR_NAME',      'DynamicProject');
defined('DEFAULT_TIMEZONE')      || define('DEFAULT_TIMEZONE', 'Europe/Belgrade');


defined('PATH_PUBLIC')           || define('PATH_PUBLIC',           PATH_ROOT    . 'public/');
defined('PATH_LIBRARY')          || define('PATH_LIBRARY',          PATH_ROOT    . 'library/');
defined('PATH_MODULE')           || define('PATH_MODULE',           PATH_ROOT    . 'module/');
defined('PATH_APP')              || define('PATH_APP',              PATH_ROOT    . 'application/');
defined('PATH_SETUP')            || define('PATH_SETUP',            PATH_APP     . 'setup/');
defined('PATH_SYSTEM')           || define('PATH_SYSTEM',           PATH_SETUP   . 'system/');
defined('PATH_CONFIG')           || define('PATH_CONFIG',           PATH_SETUP   . 'config/');
defined('PATH_PRIVATE')          || define('PATH_PRIVATE',          PATH_ROOT    . 'private/');
defined('PATH_CACHE')            || define('PATH_CACHE',            PATH_PRIVATE . '_cache/');

defined('APPLICATION_CONFIG')    || define('APPLICATION_CONFIG',    PATH_CONFIG . 'application.ini');