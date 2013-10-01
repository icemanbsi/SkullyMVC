<?php
// Config that can be carried over to any server
if(empty($serverName)) $serverName = $_SERVER["SERVER_NAME"];

if ($serverName == 'localhost') {
	$serverConfigAdd = array(
	);

	$clientAndServerConfigAdd = array(
		'baseUrl' => 'http://localhost/kiookioosponsors/',
		'mainSiteUrl' => 'http://localhost/kiookioo/'
	);
}
else {
	$serverConfigAdd = array(
	);

	$clientAndServerConfigAdd = array(
		'baseUrl' => 'http://sponsors.kiookioo.com/',
		'mainSiteUrl' => 'http://kiookioo.com/'
	);
}

$config = array_merge($config, array(
	'maintenance' => false,
	'maintenanceIp' => '139.195.146.93',
	"tablePrefix"	=> "kioo_",

	"dateFormatDb" => "Y-m-d H:i:s",
	'dateFormat' => 'd M Y',
	'longDateTimeFormat' => 'd M Y H:i:s',
	'shortDateTimeFormat' => 'd/m H:i',
	'longDateFormat' => 'd M Y',
	'shortDateFormat' => 'd/m',
	'urlRules' => array(
		'' => 'home/index',

		// Put all other rules above pages/view rule.
		'%page%' => 'pages/view'
	),
	'language' => 'indonesian',
	'theme' => 'default',
	'salt' => 'hakunamatata',
	'smtpPort' => '465',
	'smtpHost' => 'smtp.gmail.com',
	'smtpPassword' => 'R:m:gr;~M=',
	'smtpUsername' => 'noreply@kiookioo.com',
	'senderEmail' => 'noreply@kiookioo.com',
	'senderName' => 'KiooKioo.com',
	'replyToEmail' => 'contact@kiookioo.com',
	'replyToName' => 'KiooKioo.com Contact',
	'smtpSecurity' => 'ssl'
), $serverConfigAdd);

$clientAndServerConfig = array_merge($clientAndServerConfig, array(
	// used in date forms
	'formDateFormat' => 'M d, yy',
	'serverFormDateFormat' => "%b %e, %Y",

	// used in time forms
	'formTimeFormat' => 'hh:mm TT',
	'serverFormDateTimeFormat' => "%b %e, %Y %I:%M %p"
), $clientAndServerConfigAdd);

$config = array_merge($config, $clientAndServerConfig);

$clientConfig = array(

);

$clientConfig = array_merge($clientConfig, $clientAndServerConfig);