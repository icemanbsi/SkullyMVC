<?php
/*-------------------------------------------------\
 * Created by TrioDesign (trio@tgitriodesign.com).
 * User: Bobby Stenly Irawan
 * Date: 10/28/13
 * Time: 10:15 AM
 * 
 \------------------------------------------------*/
namespace App\Models;
class Page extends \Library\ActiveRecord\Model
{
	const TYPE_INTRODUCTION = "introduction";
	const TYPE_SERVICES = "services";

	public static function model($className = __CLASS__){
		return parent::model($className);
	}

	public static function langFields() {
		return array('content', 'title');
	}

	public function getPage( $type, $asArray = false ){
		return Page::model()->find(array(
			"where" => "type='$type'"
		))->first($asArray);
	}
}
