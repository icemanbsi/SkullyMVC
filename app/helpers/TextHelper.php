<?php
/**
 * Created by Jay from Trio Design (jay@tgitriodesign.com).
 * Date: 5/12/13
 * Time: 11:56 AM
 * Description: Text-related helper methods.
 */
namespace App\Helpers;

class TextHelper extends BaseHelper
{
	// Php word counting function
	// Has javascript counterpart in function wordCount.
//	public function wordCount($theString)
//	{
//		$char_count = strlen($theString);
//		$fullStr = $theString." ";
//		$initial_whitespace_rExp = "/^[[:alnum:]]$/";
//
//		$left_trimmedStr = preg_replace($initial_whitespace_rExp,"",$fullStr);
//		$non_alphanumerics_rExp = "/^[[:alnum:]]$/";
//		$cleanedStr = preg_replace($non_alphanumerics_rExp," ",$left_trimmedStr);
//		$splitString = explode(" ",$cleanedStr);
//
//		$word_count = count($splitString)-1;
//
//		if(strlen($fullStr)<2)
//		{
//			$word_count=0;
//		}
//		return $word_count;
//	}

	// Format address display. For excel file, for example.
	// Jl. Dharmahusada 12, Surabaya, Jawa Timur, Indonesia, 123123
	public function formatAddress($address, $city = '', $state = '', $country ='', $postalCode = '') {
		$list = array($address, $city, $state, $country, $postalCode);
		$list = array_filter($list);
		return implode(', ', $list);
	}

	// Change "false" or "0" or '' to false, others to true (yes, -1 is true, see http://stackoverflow.com/questions/137487/null-vs-false-vs-0-in-php).
	public function toBoolean($status) {
		if (in_array($status, array('', '0', 'false', 0, false, null), true)) {
			return false;
		}
		else {
			return true;
		}
	}

	public function isValidJson($jsonText) {
		json_decode($jsonText);
		return (json_last_error() == JSON_ERROR_NONE);
	}

	// Prepare json to be inputted to fields.
	public function prepareJSON($text){
		return addslashes($text);
	}
}
