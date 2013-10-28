<?php
/**
 * Created by Jay from Trio Design (jay@tgitriodesign.com).
 * Date: 10/13/13
 * Time: 1:16 PM
 * Description: Pass a url and array of params, returns a modified url with its parameters.
 */

function smarty_function_addUrlParams($params = array(), &$smarty) {
	$url = '';
	if (!empty($params['url'])) {
		$parsedUrl = parse_url($params['url']);
		unset($params['url']);
		$queries = array();
		if (!empty($parsedUrl['query'])) {
			parse_str($parsedUrl['query'], $queries);
		}
		foreach($params as $key=>$value) {
			$queries[$key]=$value;
		}
		$parsedUrl['query'] = http_build_query($queries);
		$url = http_build_url($parsedUrl);
	}
	return $url;
}