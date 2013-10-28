<?php
/**
 * Created by Jay from Trio Design (jay@tgitriodesign.com).
 * Date: 4/28/13
 * Time: 8:36 AM
 * Description: Where queries are actually being run.
 */

namespace Library\ActiveRecord;

class ModelQuery {
	var $sql = ""; // query to run
	var $className = ""; // class name of the model
	function __construct($className, $sql) {
		$this->sql = $sql;
//		errorLog($this->sql);
		$this->class_name = $className;
	}

	function all($asArray = false) {
		$this->sql = trim($this->sql);
//		errorLog("sql: " . $this->sql);
		$rs = app()->db->select($this->sql);
//		errorLog("rs: " . print_r($rs, true));
//		$object_list = new ModelArray();

		$langFields = call_user_func(array($this->class_name, 'langFields'));

		$object_list = array();
		// attempt to remove obscure values, but cancelled
		//$fields_r = explode(',', $className::fieldNames());
		foreach($rs as $data) {
			foreach($data as $key => $value) {
				if (is_string($value)) {
					$data[$key] = stripslashes($value);
				}
			}
			//eval('$object = new ' . $this->class_name . '($data);');

			//lang fields checking and set to array
			foreach($langFields as $langField){
				$data[$langField] = json_decode($data[$langField], true);
			}

			if($asArray)$object_list[] = $data;
			else{
				$object = new $this->class_name();
				//$object->setAttributes($data, true);
				$object->attributes = $data;
				$object->newRecord = false;
				$object->storedAttributes = $object->attributes;
				$object_list[] = $object;
			}
		}
//		errorLog("results of all statement of " . $this->sql);
//		errorLog(print_r($object_list, true));
		return($object_list);
	}
	function first($asArray = false) {
		$this->sql = trim($this->sql);
		// no need for this as there is possibility limit is set but we want to get the first value of that list.
		//$sql_with_one_limit = preg_replace('limit.*$', "limit 1", $this->sql);
		$rs = app()->db->select($this->sql);
//		// errorLog($this->sql);
//		// errorLog("after first called, rs is: " . print_r($rs, true));
//		// errorLog("first sql is " . $this->sql);
		$langFields = call_user_func(array($this->class_name, 'langFields'));
		if (!empty($rs)) {
			if(!$asArray) $object = new $this->class_name();
			foreach($rs[0] as $key => $value) {
				if (is_string($value)) {
					$rs[0][$key] = stripslashes($value);
				}
				if(!$asArray) $object->attributes[$key] =stripslashes($value);
			}
			if($asArray) {
				//lang fields checking and set to array
				foreach($langFields as $langField){
					$rs[0][$langField] = json_decode($rs[0][$langField], true);
				}
				return $rs[0];
			}
			else {
				//lang fields checking and set to array
				foreach($langFields as $langField){
					$object->attributes[$langField] = json_decode($object->attributes[$langField], true);
				}
				$object->newRecord = false;
				$object->storedAttributes = $object->attributes;
//			// errorLog("object is " . print_r($object, true));
				return $object;
			}
		}
		else {
			return null;
		}
	}
	function count() {
		$this->sql = trim($this->sql);
//		errorLog($this->sql);
		$result = app()->db->execute($this->sql);
//		errorLog("result is " . print_r($result, true));
		$result = $result->fetch_array(MYSQLI_NUM);
//		errorLog("count result: $result[0]");
		return (int)$result[0];
	}
}