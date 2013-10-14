<?php
/**
 * Created by Jay from Trio Design (jay@tgitriodesign.com).
 * Date: 2/27/13
 * Time: 10:00 AM
 * Description: This is the only configuration file ever needed for this app.
 */
if(empty($serverName)) $serverName = $_SERVER["SERVER_NAME"];

if ($serverName == 'localhost') {
	date_default_timezone_set('Asia/Jakarta');
	$config=array(
		'serverName' => $serverName,
		"db" => array (
			"server"	=> "127.0.0.1",
			"username"	=> "user",
			"password"	=> "pass",
			"port"		=> "",
			"database"	=> "db_name"
		)
	);
}
else {
	date_default_timezone_set('Asia/Jakarta');
	$config=array(
		'serverName' => $serverName,
		"db" => array (
			"server"	=> "localhost",
			"username"	=> "user",
			"password"	=> 'pass',
			"port"		=> "3306",
			"database"	=> "db_name"
		)
	);
}

if ($serverName == 'localhost') {
	$clientAndServerConfig = array(
	);
}
else {
	$clientAndServerConfig = array(
	);
}


$config = array_merge($config, $clientAndServerConfig);