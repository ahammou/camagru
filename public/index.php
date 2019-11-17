<?php

/**
 * ------------------- PATH CONSTANTS ------------------- *
 */
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'camagru' . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'app' . DIRECTORY_SEPARATOR);
define('CONFIG', ROOT . 'app' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR);
define('CONTROLLER', ROOT . 'app' . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR);
define('CORE', ROOT . 'app' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR);
define('MODEL', ROOT . 'app' . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR);
define('MANAGER', ROOT . 'app' . DIRECTORY_SEPARATOR . 'manager' . DIRECTORY_SEPARATOR);
define('VIEW', ROOT . 'app' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
define('URL', "/camagru/public/");

// $modules = [ROOT, APP, CORE, CONFIG, CONTROLLER];
// set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $modules));
// spl_autoload_register('spl_autoload', false); // start doing the autoloading automatically

require_once(APP . "init.php");

new App();
