<?php
/**
 * Created by Jay from Trio Design (jay@tgitriodesign.com).
 * Date: 7/23/13
 * Time: 11:59 AM
 * Description: Parse HTML inputted from admin (\n, \r, and \r\n converted to <br />, and allow only some html tags).
 *              Inputted text must be coming straight from table fields, not json.
 */

function smarty_modifier_parseHtml($string) {
	$string = str_replace(array("\r\n", "\n", "\r"), array("<br />", "<br />", "<br />"), $string);
	$string = strip_tags($string, "<br><p><a><b><i><u><strong><strike>");
	return $string;
}