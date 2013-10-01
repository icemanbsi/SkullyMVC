<?php
/**
 * Created by Trio Design (trio@tgitriodesign.com).
 * Date: 7/23/13
 * Time: 12:10 PM
 * Description: Parse text from admin inputs to be placed as pure text (i.e. at meta tags and title attributes).
 */

function smarty_modifier_parseText($string) {
	$string = str_replace('"', '', $string);
	return strip_tags($string);
}