#!/usr/bin/php
<?php
define("BASE_PATH", realpath(dirname(__FILE__)) . '/../../');
$serverName = 'localhost';
include(BASE_PATH.'shared/config/config.php');
include(BASE_PATH.'shared/config/commonConfig.php');
include(BASE_PATH.'library/encryptionClass/EncryptionClass.php');

$crypt = new \Library\EncryptionClass\EncryptionClass();

$crypt->setAdjustment(2.21); // 1st adjustment value (optional)
$crypt->setModulus(4); // 2nd adjustment value (optional)

if (!empty($argv) && !empty($argv[1])) {
	if ($argv[1] == '-h' || $argv[1] == '--help') {
		echo "Usage: ./encrypt.php [string_to_encrypt]\n";
	}
	else {
		echo $crypt->encrypt($config['salt'], $argv[1])."\n";
	}
}