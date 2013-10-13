<?php
/**
 * Created by Jay from Trio Design (jay@tgitriodesign.com).
 * Date: 5/4/13
 * Time: 3:09 PM
 * Description: Global lang() function for tinymce.
 */
function smarty_function_lang($params = array(), &$smarty) {
	$value = $params['value'];
	unset($params['value']);

	$numerical = array();
	foreach($params as $k=>$v)
	{
		$numerical[] = $v;
	}

	return lang($value, $numerical);
}