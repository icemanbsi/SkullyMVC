<?php
// ==== When you just need to use Application instance without web server use following code and adjust BASE_PATH, and don't forget to do app()->closeDb in the end:
// === START ===
// First let's define our apps root directory
define("BASE_PATH", realpath(dirname(__FILE__)) . '/');
$session_id = session_id();
session_start();
mb_internal_encoding("UTF-8");

// We are going to drop our dispatch file in here
require(BASE_PATH . 'bootstrap.php');
include(BASE_PATH . '/library/smarty-3.1.13/libs/Smarty.class.php'); // Possibly only required for web applications
include(BASE_PATH.'shared/config/config.php');
include(BASE_PATH.'shared/config/commonConfig.php');
dispatch($config, $clientConfig);
// === END ===

//errorLog("index.php, all parameters: " . print_r($_GET, true));
//error_log("index.php all params: ".  print_r($_GET, true));
if (!empty(app()->config['maintenance']) && !empty(app()->config['maintenanceIp']) && app()->config['maintenance'] == true && $_SERVER['REMOTE_ADDR'] != app()->config('maintenanceIp')) {
	header('Location: '.app()->config('maintenancePath'));
}
else {
	if (empty($_GET['_url'])) {
		$_GET['_url'] = '';
	}
//errorLog("url is " . $_GET['_url']);
	app()->runControllerFromRawUrl($_GET['_url']);

// Close db connection
	app()->closeDb();
}
