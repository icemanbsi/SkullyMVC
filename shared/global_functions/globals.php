<?php
/**
 * Created by Trio Design (trio@tgitriodesign.com).
 * Date: 2/27/13
 * Time: 11:18 PM
 * Description: Global (usually shortcut) functions are stored here.
 */

// Use this instead of errorLog, so that messages triggered from cron may also be logged
// Remember that php's thrown errors are still displayed in error log file configured from php.ini.
function errorLog($message) {
	if (filesize(BASE_PATH.'logs/error.log') > 10000000) {
		$count = 1;
		while(file_exists(BASE_PATH.'logs/error'.$count.'.log')) {
			$count+=1;
		}
		copy(BASE_PATH.'logs/error.log', BASE_PATH.'logs/error'.$count.'.log');
		unlink(BASE_PATH.'logs/error.log');
	}
	file_put_contents(BASE_PATH.'logs/error.log', $message."\n", FILE_APPEND);
}

function app($config = null) {
	return \App\Application::instantiate($config);
}

function isHttps() {
	return ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (!empty($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443));
}

// This is a shortcut to app()->helper('UrlHelper')->url method
function url($path = null, $params=array(), $isFb=false, $isPageTab=0) {
	return app()->helper('UrlHelper')->url($path, $params, $isFb, $isPageTab);
}

// Gets language as defined in directory "Languages" within template.
// This also available in smarty using function "lang"
function lang($lang, $args = array()) {
	if (!empty(app()->lang[$lang])) {
		$string = app()->lang[$lang];
		if (!empty($args)) {
			foreach($args as $index => $arg) {
				$string = str_replace('{$'.($index+1).'}', $arg, $string);
			}
		}
		return $string;
	}
	else {
		return $lang;
	}
}

function debugBacktrace($asString = false) {
	$func = function($value) {
		if (!empty($value['file'])) {
			return $value['file'] . ' line ' . $value['line'];
		}
		elseif (!empty($value['class'])) {
			return "class " . $value['class'] . " function " . $value['function'];
		}
		else {
			return '(unknown file)' . $value['function'] . '('.implode(', ', $value['args']).')';
		}
	};

	if ($asString) {
		return "debug backtrace: " . print_r(array_map($func, debug_backtrace()), true);
	}
	else {
		return errorLog("debug backtrace: " . print_r(array_map($func, debug_backtrace()), true));
	}
}