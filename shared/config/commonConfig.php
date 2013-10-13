<?php
// Config that can be carried over to any server
if(empty($serverName)) $serverName = $_SERVER["SERVER_NAME"];

// clientAndServer configs are readable via javascript.
if ($serverName == 'localhost') {
	$serverConfigAdd = array(
		'online' => false
	);

	$clientAndServerConfigAdd = array(
		'baseUrl' => 'http://localhost/skullyMVC/'
	);
}
else {
	$serverConfigAdd = array(
		'online' => true
	);

	$clientAndServerConfigAdd = array(
		'baseUrl' => 'http://yoursite.com/'
	);
}

$config = array_merge($config, array(
	// App can be configured not to use database.
	'useDb' => false,

	// Set these to make your site showing under maintenance page
	'maintenance' => false,
	'maintenanceIp' => '139.195.146.93',

	"tablePrefix"	=> "skully_",

	// Date formats used on the site
	"dateFormatDb" => "Y-m-d H:i:s",
	'dateFormat' => 'd M Y',
	'longDateTimeFormat' => 'd M Y H:i:s',
	'shortDateTimeFormat' => 'd/m H:i',
	'longDateFormat' => 'd M Y',
	'shortDateFormat' => 'd/m',

	// The most important config. This states the mapping of site's urls.
	// If you want to add a parameter, do so by adding another action to
	// the controller. For example instead of adding 'home' parameter here,
	// route to pages/home then from there calls pages/view action.
	'urlRules' => array(
		'' => 'pages/home',
		// -- set all other rules here --
		'editor' => 'langEditor/index',
		'editor/index' => 'langEditor/index',
		'editor/add' => 'langEditor/add',
		'editor/create' => 'langEditor/create',
		'editor/edit' => 'langEditor/edit',
		'editor/update' => 'langEditor/update',
		'editor/destroy' => 'langEditor/destroy',
		// -- end -- //
		'page/%page%' => 'pages/view'
	),
	// default selected language
	'language' => 'english',

	// the key here is used on url i.e. http://sitename.com/en/index
	'languages' => array(
		'en' => 'english',
		'id' => 'indonesian'
	),

	// Theme used on the site, this relates to 'themes' directory.
	'theme' => 'default',

	// Email setting. Note that the password here is encrypted.
	// To encrypt the password, go to terminal, browse to /tools/passEncryptor/, then run:
	// ./encrypt.php your_password
	// Then copy-paste the result here
	'smtpPort' => '465',
	'smtpHost' => 'smtp.yoursite.com',
	'smtpPassword' => '',
	'smtpUsername' => 'noreply@yoursite.com',
	'senderEmail' => 'noreply@yoursite.com',
	'senderName' => 'yoursite.com',
	'replyToEmail' => 'contact@yoursite.com',
	'replyToName' => 'yoursite.com Contact',
	'smtpSecurity' => 'ssl',

	'basePath' => BASE_PATH,
	'notFoundPath' => BASE_PATH.'404.html',
	'maintenancePath' => BASE_PATH.'under-maintenance.html'
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