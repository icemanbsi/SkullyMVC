<?php
if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}
function autoload($className)
{
	$className = ltrim($className, '\\');
	$fileName  = '';
	if ($lastNsPos = strrpos($className, '\\')) {
		$namespace = substr($className, 0, $lastNsPos);
		$className = substr($className, $lastNsPos + 1);
		$namespace_r = explode('\\', $namespace);
		if (!empty($namespace_r)) {
			$fileName = BASE_PATH;
			foreach($namespace_r as $namespacePart) {
				$fileName .= lcfirst($namespacePart) . DIRECTORY_SEPARATOR;
			}
		}
//		$fileName  = BASE_PATH . str_replace('\\', DIRECTORY_SEPARATOR, strtolower($namespace)) . DIRECTORY_SEPARATOR;
	}
	$fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

//	errorLog("filename: $fileName");

	if (file_exists($fileName)) {
		require $fileName;
	}
}

spl_autoload_register('autoload');

require(BASE_PATH . '/shared/global_functions/globals.php');
$app = null;

function dispatch($config, $clientConfig) {
	app($config);
	app()->clientConfig = $clientConfig;
}