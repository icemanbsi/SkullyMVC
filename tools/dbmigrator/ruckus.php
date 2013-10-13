#!/usr/bin/php
<?php
// require_once(dirname(__FILE__) . '/../../shared/global_functions/globals.php');

// Require main app
// require_once(dirname(__FILE__) . '/../../index.php');
define("BASE_PATH", realpath(dirname(__FILE__)) . '/../../');
include('configure.php');
// Find and initialize Composer
$composer_found = false;
$php53 = version_compare(PHP_VERSION, '5.3.2', '>=');
if ($php53) {
    $files = array(
            __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php',
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php',
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php',
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php',
            __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'autoload.php',
    );

    foreach ($files as $file) {
        if (file_exists($file)) {
            require_once $file;
            break;
        }
    }

    if (class_exists('Composer\Autoload\ClassLoader', false)) {
        $composer_found = true;
    }
}

define('RUCKUSING_WORKING_BASE', realpath(dirname(__FILE__)));
// $db_config = require RUCKUSING_WORKING_BASE . DIRECTORY_SEPARATOR . 'ruckusing.conf.php';
$db_config = require RUCKUSING_WORKING_BASE . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'database.inc.php';

if (isset($db_config['ruckusing_base'])) {
    define('RUCKUSING_BASE', $db_config['ruckusing_base']);
} else {
    define('RUCKUSING_BASE', dirname(__FILE__));
}

require_once RUCKUSING_BASE . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.inc.php';

if (!$composer_found) {

    set_include_path(
            implode(
                    PATH_SEPARATOR,
                    array(
                            RUCKUSING_BASE . DIRECTORY_SEPARATOR . 'lib',
                            get_include_path(),
                    )
            )
    );

    function loader($classname)
    {
	    $file = RUCKUSING_BASE . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . str_replace('_', DIRECTORY_SEPARATOR, $classname) . '.php';
	    if (file_exists($file)) {
		    include $file;
	    }
    }

    if ($php53) {
       spl_autoload_register('loader', true, true);
    } else {
       spl_autoload_register('loader', true);
    }
}

$main = new Ruckusing_FrameworkRunner($db_config, $argv);
echo $main->execute();

app()->closeDb();