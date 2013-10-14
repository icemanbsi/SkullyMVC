<?php
/**
 * Created by Jay from Trio Design (jay@tgitriodesign.com).
 * Date: 10/12/13
 * Time: 12:19 PM
 * Description: Use this to decide if ruckus application is running on online or local version.
 */

// See if online version's path available on basepath.
// Change online/path to a path to your online version.
if (strpos(BASE_PATH, 'online/path') !== false) {
	$serverName = 'yourSite.com';
}
else {
	$serverName = 'localhost';
}
$session_id = session_id();
session_start();
mb_internal_encoding("UTF-8");

// We are going to drop our dispatch file in here
require(BASE_PATH . 'bootstrap.php');
include(BASE_PATH . 'shared/config/config.php');
include(BASE_PATH . 'shared/config/commonConfig.php');
dispatch($config, $clientAndServerConfig);
