<?php
/**
 * Created by TrioDesign (trio@tgitriodesign.com).
 * User: Bobby Stenly Irawan
 * Date: 5/6/13
 * Time: 2:05 PM
 *
 */
namespace App\Helpers;
class TimeHelper{

	// PHP date function with a twist. With standard function, null returned year 1970 date. With this, returns '' instead.
	function date($format, $timestamp) {
		if (empty($timestamp)) {
			return '';
		}
		else {
			return date($format, $timestamp);
		}
	}
	function toLongDateTimeFormat($timestamp){
		return date(app()->config("longDateTimeFormat"), intval($timestamp));
	}

	function toShortDateTimeFormat($timestamp){
		return date(app()->config("shortDateTimeFormat"), intval($timestamp));
	}

	function toLongDateFormat($timestamp){
		return date(app()->config("longDateFormat"), intval($timestamp));
	}

	function toShortDateFormat($timestamp){
		return date(app()->config("shortDateFormat"), intval($timestamp));
	}

	function getDay($timestamp){
		return date("d", $timestamp);
	}

	function getMonth($timestamp){
		return date("m", $timestamp);
	}

	function getYear($timestamp){
		return date("Y", $timestamp);
	}

	function diff($timestampStart, $timestampEnd){
		$diff = array(
			"days"      => 0,
			"hours"     => 0,
			"minutes"   => 0,
			"seconds"   => 0
		);

		$t = $timestampEnd - $timestampStart;
		$diff["days"] = floor($t / 86400);
		$t = $t % 86400;
		$diff["hours"] = floor($t / 3600);
		$t = $t % 3600;
		$diff["minutes"] = floor($t / 60);
		$t = $t % 60;
		$diff["seconds"] = $t;

		return $diff;
	}

	function timeLeft($until) {
		$remaining = "";
		$temp = $this->diff(time(), $until);
		if($temp["days"] > 0)$remaining = $temp["days"]." day" . ($temp["days"] > 1 ? "s" : "");
		else if($temp["hours"] > 0)$remaining = $temp["hours"]." hour" . ($temp["hours"] > 1 ? "s" : "");
		else if($temp["minutes"] > 0)$remaining = $temp["minutes"]." minute" . ($temp["minutes"] > 1 ? "s" : "");
		else if($temp["seconds"] > 0)$remaining = $temp["seconds"]." second" . ($temp["seconds"] > 1 ? "s" : "");
		return $remaining;
	}
}