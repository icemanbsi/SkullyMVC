<?php
/**
 * Created by Trio Design (trio@tgitriodesign.com).
 * Date: 4/24/13
 * Time: 3:09 PM
 * Description: Url function
 * $params:
 * - path: url string
 * - pass other items as array items.
 */
function smarty_function_url($params = array(), &$smarty) {
	$path = '';
	$isFb = false;
	$isPageTab = 0;
	if (!empty($params['path'])) {
		$path = $params['path'];
		unset($params['path']);
	}
	if (!empty($params['isFb'])) {
		$isFb = $params['isFb'];
		unset($params['isFb']);
	}
	if (isset($params['isPageTab'])) {
		$isPageTab = $params['isPageTab'];
		unset($params['isPageTab']);
	}
	return url($path, $params, $isFb, $isPageTab);
}