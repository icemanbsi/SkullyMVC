<?php
/**
 * Created by Jay from Trio Design (jay@tgitriodesign.com).
 * Date: 4/24/13
 * Time: 3:09 PM
 * Description: Url function
 * $params:
 * - path: url string
 * - pass other items as array items.
 */
function smarty_function_url($params = array(), &$smarty) {
	$path = '';
	if (!empty($params['path'])) {
		$path = $params['path'];
		unset($params['path']);
	}
	return url($path, $params);
}