#!/usr/bin/php
<?php
date_default_timezone_set('Asia/Jakarta');

// First let's define our apps root directory
define("BASE_PATH", realpath(dirname(__FILE__) . '/../../') . '/');


if (!empty($argv) && !empty($argv[1])) {
	if ($argv[1] == '-h' || $argv[1] == '--help') {
		die( "Usage: ./base.php server_name\n");
	}
	else {
		$serverName = $argv[1];
	}
}
else{
	die("Usage: ./base.php server_name \n");
}

// === START ===
// First let's define our apps root directory
//define("BASE_PATH", realpath(dirname(__FILE__)) . '/');
$session_id = session_id();
session_start();
mb_internal_encoding("UTF-8");

// We are going to drop our dispatch file in here
require(BASE_PATH . 'bootstrap.php');
include(BASE_PATH . '/library/smarty-3.1.13/libs/Smarty.class.php'); // Possibly only required for web applications
include(BASE_PATH.'shared/config/config.php');
include(BASE_PATH.'shared/config/commonConfig.php');
dispatch($config, $clientConfig);
//errorLog("base.php cron starting");
// === END ===

// Include the cron files here
// include(BASE_PATH . "app/crons/cronfile.php");
