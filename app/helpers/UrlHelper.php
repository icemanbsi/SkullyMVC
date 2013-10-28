<?php
/**
 * Created by Jay from Trio Design (jay@tgitriodesign.com).
 * Date: 2/27/13
 * Time: 10:38 AM
 * Description: Url-related helpers
 *              This is not put inside mailout because I expect it to be used in other projects.
 */
namespace App\Helpers;

class UrlHelper extends BaseHelper
{
	// Takes a path and parameters, returns url based from the mapping
	// If path is null, get current page's url instead.
	public function url($path = null, $parameters = array()) {
		if ($path == null) {
			$pageURL = 'http';
			if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://";
			if ($_SERVER["SERVER_PORT"] != "80") {
				$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			} else {
				$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			}
			return $pageURL;
		}
		else {
			$answer = $path;
			$urlRules = app()->config('urlRules');
			if (!empty($urlRules)) {
				foreach($urlRules as $displayedPath => $systemPath) {

					if ($systemPath == $path) {
						$answer = $displayedPath;
						break;
					}
					else {
						if (strpos($systemPath, $path) === 0) {
							$answer = $displayedPath;
							break;
						}
					}
				}
				preg_match_all('/%[\w+]*/', $answer, $params);

				if(!empty($params)){
					foreach($params as $pars){
						foreach($pars as $param){
							$temp = substr($param, 1);
							if(isset($parameters[$temp])){
								// Put URL special cases here, for example if you need to replace spaces with dash

								// Special cases END
								$answer = str_replace($param, $parameters[$temp], $answer);
								unset($parameters[$temp]);
							}
						}
					}
				}
			}

			return app()->config('baseUrl').$answer.(!empty($parameters)?"?".http_build_query($parameters):'');
		}
	}

	// Convert url depending on given url rules (url rules are set in BaseHelper options).
	// answer: array('path', array_of_vars)
	public function prepareUrl($url) {
		// if path ended with / for example something/another/ then change it to something/another/index
//		if (substr($url,-1) == '/') {
//			$url .= 'index';
//		}

		$url = str_replace('.php', '', trim($url, '/'));
		$path = $url;
		$params = array();
		$urlRules = app()->config('urlRules');
		if (!empty($urlRules)) {
			// displayedPath Examples: %path/subscribe, subscribe/index, subscribe
			foreach($urlRules as $displayedPath => $systemPath) {
				// First of all, compare the number of elements, this is to avoid url something/is opens up displayedPath something/is/wrong page

				// Split the displayed path: %path / subscribe
				$displayedPath_r = explode('/', $displayedPath);

				// Split the url: mailing-path / subscribe
				$url_r = explode('/', $url);

				if (count($displayedPath_r) == count($url_r)) {
					// If displayed path has no % and == url, set it as path
					if (strpos($displayedPath, '%') === false) {
						if ($displayedPath == $url) {
							$path = $systemPath;
							break;
						}
						else {
//							errorLog("displayedPath: $displayedPath" . " url: $url");
							if (strpos($displayedPath, $url) === 0) {
								$path = $systemPath;
								break;
							}
						}
					}
					else {
						// for each of displayed path element, compare with url.
						// if all parts are correct, then it is correct.
						$correct = true;
						$params = array();
						foreach($displayedPath_r as $key => $element) {
							if (substr($element, 0, 1) == '%') {
								$params[substr($element, 1)] = $url_r[$key];
							}
							else {
								if (!empty($url_r[$key]) && strcmp($element, $url_r[$key]) != 0) {
									$correct = false;
									break;
								}
							}
						}
						if ($correct) {
							$path = $systemPath;
							break;
						}
					}
				}
			}
		}
		return array($path, $params);
	}
}
