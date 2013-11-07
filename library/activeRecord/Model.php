<?php
/**
 * Created by Jay from Trio Design (jay@tgitriodesign.com).
 * Date: 8/26/13
 * Time: 4:42 PM
 * Description: A library to handle ActiveRecord. For use with Skully MVC.
 */

namespace Library\ActiveRecord;

// WARNING: The correct way to not allowing some fields to be changed on update/save is by
//          adding them into protectedFields, NOT by setting them to null in beforeUpdate or beforeSave or beforeCreate.
//          See method protectedFields for more details.
class Model extends ActiveRecord {
	const _DEFAULT = 0; // default action on save- not attempt to save and add error message to errors variable
	const _STOP = 1; // stop app when error found on save
	const _IGNORE = 2; // attempt to save without validation when error found on save

	const _ALL_HABTM_IDS = -1; // For example in table users_template_categories, when template category_id is set to -1 that means that user has access to all template categories.

	var $attributes = array();
	var $storedAttributes = array(); // attributes stored in db
	var $errors = array(); // array of array('attribute' => attribute_name, 'message' => error_message) or just error message
	var $newRecord = true; // true if not stored in database

	// Running this method will turn language fields json into array.
	public function setupGetLangFields() {
		$langFields = $this->langFields();
		if(!empty($langFields)){
			foreach($langFields as $langField) {
				$this->attributes[$langField] = json_decode(stripslashes($this->attributes[$langField]), true);
			}
		}
	}

	// Running this method will turn language field arrays into json.
	protected function setupSetLangFields() {
		$langFields = $this->langFields();
		if(!empty($langFields)){
			foreach($langFields as $langField) {
				$this->attributes[$langField] = addslashes(json_encode($this->attributes[$langField]));
			}
		}
	}

	public static function langFields() {
		return array();
	}
	// If params is false means this method was called when model() method called.
	// All inherited methods must have "if ($params !== false)".
	function __construct($params = array(), $force = false) {
		if ($params !== false) {
			$fields = $this->fields();
			if (!empty($fields)) {
				foreach($fields as $field) {
					$this->attributes[$field->name] = '';
				}
			}
			$this->setAttributes($this->defaultAttributes(), true);
			$this->setAttributes($params, $force);
			$this->setupGetLangFields();
		}
	}

	// Inheritable methods returning default attributes.
	function defaultAttributes() {
		return array();
	}

	// clone another model into this instance
	public function cloneFrom($instance) {
		$thisInstance = $this->new();
//		errorLog("clone from " . print_r($instance, true));
		$thisInstance->attributes = $instance->attributes;
		$thisInstance->storedAttributes = $instance->storedAttributes;
		$thisInstance->errors = $instance->errors;
		$thisInstance->newRecord = $instance->newRecord;
//		errorLog("into: ". print_r($thisInstance, true));
		return $thisInstance;
	}

	// Return only the messages from list of errors
	public function errorMessage() {
		$message = '';
		if (!empty($this->errors)) {
			$message = '<ul>';
			foreach($this->errors as $error) {
				if (is_array($error)) {
					$message .= '<li>'.$error['message'].'</li>';
				}
				else {
					$message .= '<li>'.$error.'</li>';
				}
			}
			$message .= '</ul>';
		}
		return $message;
	}

	// Can be called as static or instance function
	public function destroy($conditions = array()) {
		if (empty($conditions)) {
			$oldMe = clone $this;
			//// errorLog('Destroy');
			$this->beforeDestroy();
			$className = get_called_class();
			$tableName = $className::model()->tableName();
			$indexField = $className::model()->indexField();
			$sql = "delete from `$tableName` where `$indexField` = '" . $this->attributes[$indexField] ."'" ;
			$result = false;
			if ($this->validateOnDestroy()) {
				$result = app()->db->execute($sql);
				$this->afterDestroy($oldMe);
			}
			return $result;
		}
		else {
			return parent::destroy($conditions);
		}
	}

	function getId() {
		$className = get_called_class();
		return $this->attributes[$className::model()->indexField()];
	}

	function setId($new_id) {
		$className = get_called_class();
		$this->attributes[$className::model()->indexField()] = $new_id;
	}

	// Set this model instance's attributes from an associative array.
	// You can set the attributes one-by-one, but this is quicker when you
	// need to create a model from POST parameters.
	// Remember to set protectedFields.
	// If force is true, set attributes even for protected ones.
	function setAttributes($attributes, $force = false) {
		//// errorLog('setting old me to:');
		//// errorLog(print_r($this->oldMe, true));
		// make sure protected attributes can't be set from mass assignment
		$protectedFields = $this->protectedFields();
		//// errorLog('attempt to nullify protected fields');
		//// errorLog('$protectedFields:');
		//// errorLog(print_r($protectedFields, true));
		// remove all attributes which key included in protected fields
		if (!empty($attributes)) {
			foreach($attributes as $key => $value) {
				//// errorLog('checking if ' . $key . ' is in list');
				if (in_array($key, $protectedFields) && $force == false) {
					if ($key != 0) {
						// errorLog("Warning: protected field $key set to null.");
					}
					//// errorLog('it is, so remove');
					unset($attributes[$key]);
				}
			}
		}

		$this->attributes = array_merge($this->attributes, $attributes);
	}

	// array of fields / attributes that are protected
	// WARNING: The correct way to not allowing some fields to be changed on update/save is by
	//          adding them into protectedFields, NOT by setting them to null in beforeUpdate or beforeSave or beforeCreate.
	//          Because with the latter these fields would not be usable after saving since they are set to null,
	//          that is UNLESS if you do $instance->save(array('retrieve' => true)) To retrieve data from db.
	protected function protectedFields() {
		return array();
	}

	private function validatesUniquenessOnCreate($unique_attributes) {
		$className = get_called_class();
		// unique check - without id check
		foreach ($unique_attributes as $unique_attribute_r) {
			// empty is ok
			if (is_array($unique_attribute_r)) {
				$unique_attribute = $unique_attribute_r[0];
				$message = $unique_attribute_r[1];
			}
			else {
				$unique_attribute = $unique_attribute_r;
			}
			if (!empty($this->attributes[$unique_attribute])) {
				//// errorLog("count similar $unique_attribute on create");
				if ($className::model()->count(array("where" => "$unique_attribute ='".$this->attributes[$unique_attribute]."'")) > 0) {
					//// errorLog("error: Duplicate $unique_attribute found on create");
					if (empty($message)) {
						$this->errors[] = array('attribute' => $unique_attribute, 'message' => "Duplicate $unique_attribute found");
					}
					else {
						debugBacktrace();
						$this->errors[] = array('attribute' => $unique_attribute, 'message' => $message);
					}
				}
			}
		}
	}

	private function validatesUniquenessOnUpdate($unique_attributes) {
		$className = get_called_class();
		$indexField = $className::model()->indexField();
		// unique check - with id check since it is on update
		foreach ($unique_attributes as $unique_attribute_r) {
			// empty is ok
			if (is_array($unique_attribute_r)) {
				$unique_attribute = $unique_attribute_r[0];
				$message = $unique_attribute_r[1];
			}
			else {
				$unique_attribute = $unique_attribute_r;
			}
			if (!empty($this->attributes[$unique_attribute])) {
				//// errorLog("count similar $unique_attribute on update");
				if ($className::model()->count(array("where" => "$unique_attribute ='".$this->attributes[$unique_attribute]."' and $indexField != '".$this->attributes[$indexField]."'")) > 1) {
					//// errorLog("error: Duplicate $unique_attribute found on update");
					if (empty($message)) {
						$this->errors[] = array('attribute' => $unique_attribute, 'message' => "Duplicate $unique_attribute found");
					}
					else {
						debugBacktrace();
						$this->errors[] = array('attribute' => $unique_attribute, 'message' => $message);
					}
				}
			}
		}
	}

	private function validatesExistence($attribute) {
		if (is_array($attribute)) {
			if (!$this->attributes[$attribute[0]]) $this->errors[] = array('attribute' => $attribute[0], 'message' => $attribute[1]);
		}
		else {
			if (!$this->attributes[$attribute]) $this->errors[] = array('attribute' => $attribute, 'message' => $attribute . " cannot be empty.");
		}
	}

	// Validates this instance
	// This runs all validation methods.
	public function validates($create = null, &$className = null) {
		if (is_null($create)) {
			$create = empty($this->attributes['id']);
		}

		if (is_null($className)) {
			$className = get_called_class();
		}
		$unique_attributes = $className::model()->validatesUniquenessOf();
		if ($create == true) {
			if (!empty($unique_attributes)) {
				$this->validatesUniquenessOnCreate($unique_attributes);
			}
			$this->validateOnCreate();
		}
		else {
			if (!empty($unique_attributes)) {
				$this->validatesUniquenessOnUpdate($unique_attributes);
			}
			$this->validateOnUpdate();
		}

		$requiredAttributes = $className::model()->validatesExistenceOf();
		if (empty($requiredAttributes) && !is_array($requiredAttributes)) {
			trigger_error("Wrong validatesExistenceOf of model $className", E_USER_ERROR);
		}

		if ($create == true) {
			$requiredAttributes = array_merge($requiredAttributes, $className::model()->validatesExistenceOnCreateOf());
		}
		else {
			$requiredAttributes = array_merge($requiredAttributes, $className::model()->validatesExistenceOnUpdateOf());
		}

		if (!empty($requiredAttributes)) {
			foreach($requiredAttributes as $attribute) {
				$this->validatesExistence($attribute);
			}
		}

//		errorLog('checking validation');
		$this->validate();
		return (count($this->errors) == 0);
	}

	private function commonSave(&$className, &$indexField, &$create, &$on_error) {
//		// errorLog('begin common_save');
		$oldMe = clone $this;
		$oldMe->setAttributes($oldMe->storedAttributes, true);

		$this->validates($create, $className);
		if ((count($this->errors) == 0) || $on_error == self::_IGNORE) {
//			// errorLog('passed validation');
			if (empty($this->attributes[$indexField])) {
				$create = true;
				if (empty($this->attributes['createdAt'])) {
					$this->attributes["createdAt"]=time();
				}
				if (empty($this->attributes['updatedAt'])) {
					$this->attributes["updatedAt"]=time();
				}
				$this->beforeCreate();
			}
			else {
				$this->attributes["createdAt"]=null;
				if (empty($this->attributes['updatedAt'])) {
					$this->attributes["updatedAt"]=time();
				}
				$this->beforeUpdate();
			}

			$this->setupSetLangFields();
			$this->beforeSave();

			if (count($this->errors) == 0 || $on_error == self::_IGNORE) {
//				// errorLog('passed before create, update, save');
				if (isset($create)) {
					$sql = app()->db->getSqlInsert($className::model()->tableName(), $className::model()->fields(), $this->attributes);
//					// errorLog('create');
//					// errorLog("attributes are " . print_r($this->attributes, true));
//					// errorLog($sql);
					$status = app()->db->execute($sql);
					if ($status == false) {
						// errorLog("insert failed, query was: $sql");
						debugBacktrace();
						if ($on_error == self::_STOP) {
							echo "insert failed, query was: $sql (maybe association was not setup correctly?)";
							exit;
						}
					}
					$new_id = app()->db->lastInsertId();
					$this->attributes[$indexField] = $new_id;
					//// errorLog('model instance right after create:');
					//// errorLog(print_r($this, true));
					$this->storedAttributes = $this->attributes;
				}
				else {
					// remove nullified fields, needed for protected attributes.
					// To make attributes protected, use method protectedFields()
					// for example of use, try to update user, see if password_hash is updated
					$fields = $className::model()->fields();
//					errorLog('update');
//					// errorLog("before anything, attributes are " . print_r($this->attributes, true));
					if (!empty($this->attributes)) {
						foreach($this->attributes as $key => $value) {
							// if value is null, find that value's key in list of field names
							// DO NOT USE == null since that means value 0 also considered null (php bug)
							// DO NOT USE is_null as well, as 0 is considered null...
							if ($value === null) {
								// find key
								$found_key = false;
								foreach($fields as $id=>$field) {
									if ($field->name == $key) {
										$found_key = $id;
										break;
									}
								}
								if ($found_key !== false) {
									// then remove that key from list of field names
									unset($fields[$found_key]);
								}
							}
						}
					}
					$sql = app()->db->getSqlUpdate($className::model()->tableName(), $fields, $this->attributes,"where id='".$this->attributes[$indexField]."'");
//					errorLog("attributes are " . print_r($this->attributes, true));
//					errorLog($sql);
					$status = app()->db->execute($sql);
					if ($status == false) {
						// errorLog("update failed: " . app()->db->err);
						debugBacktrace();
						if ($on_error == self::_STOP) {
							echo "update failed, query was: $sql (maybe association was not setup correctly?)";
							exit;
						}
					}
					$this->storedAttributes = $this->attributes;
				}
				if (isset($create)) {
					$this->afterCreate($oldMe);
				}
				else {
					$this->afterUpdate($oldMe);
				}
				$this->saveAssociatedModels();
				$this->setupGetLangFields();
				$this->afterSave($oldMe);
			}
			else {
				//// errorLog('right after beforeSave: record not saved nor updated, error was:');
				//// errorLog(print_r($this->errors, true));
			}
		}
		else {
			//// errorLog('right after validation: record not saved nor updated, error was:');
			//// errorLog(print_r($this->errors, true));
		}
	}

	// Get attributes, including habtm ones.
	// habtm ids attribute is comma separated string of ids, defined by ids field in hasAndBelongsToMany method.
	public function getHabtm($association = '') {
		$attribs = array();
		$habtmAssoc = $this::hasAndBelongsToMany();

		if (!empty($habtmAssoc)) {
			foreach($habtmAssoc as $assoc) {
				if ($association == '' or $assoc[0] == $association) {
					$associated_instances = $assoc['class_name']::model()->find(
						array(
							'from' => $assoc['class_name']::model()->tableName().', '. $assoc['join_table'],
							'where' => $assoc['join_table'].'.'.$assoc['foreign_key']." = '".$this->attributes[$this->indexField()]."' AND ".$assoc['class_name']::model()->tableName().".".$this->indexField()." = ".$assoc['join_table'].".".$assoc['association_foreign_key']
						)
					)->all();
					if (!empty($associated_instances)) {
//						$associated_instances = $associated_instances->getArrayCopy();
						$ids_r = array_map(function($associated_instance) {return $associated_instance->attributes['id'];}, $associated_instances);
						if (!empty($ids_r)) {
							$attribs[$assoc['ids']] = implode(',', $ids_r);
						}
						$attribs[$assoc[0]] = $associated_instances;
					}
				}
			}
		}
		return $attribs;
	}

	// Setup habtm objects from attributes that was set by getAttributes (comma separated value of ids).
	public function setupHabtmObjects() {
		$habtmAssoc = $this::hasAndBelongsToMany();

		if (!empty($habtmAssoc)) {
			foreach($habtmAssoc as $assoc) {
				if (empty($this->attributes[$assoc[0]]) && !empty($this->attributes[$assoc['ids']])) {
					if (!is_array($this->attributes[$assoc['ids']])) {
						$this->attributes[$assoc['ids']] = explode(',', $this->attributes[$assoc['ids']]);
					}
					$this->attributes[$assoc[0]] = array();
					foreach($this->attributes[$assoc['ids']] as $associated_instance_id) {
						if (method_exists($assoc['class_name'], 'userFind')) {
							// Can only enter instances which current active user has access to
							$associated_instance = $assoc['class_name']::userFind(app()->user, array('where' => "id = '$associated_instance_id'"))->first();
						}
						else {
							$associated_instance = $assoc['class_name']::model()->find(array('where' => "id = '$associated_instance_id'"))->first();
						}
						if (!empty($associated_instance)) {
//							// errorLog($assoc[0] . " instance is " . print_r($associated_instance,true));
							$this->attributes[$assoc[0]][] = $associated_instance;
						}
					}

				}
			}
		}

		return $this->attributes;
	}

	// Insert associated habtm instances only if the ids attribute is $this::_ALL_HABTM_IDS.
	// For example users_template_categories with template_category_ids attribute equals to -1.
	// Do this only after doing setupHabtmObjects and saving the instance.
	public function insertAllHabtm() {
		$habtmAssoc = $this::hasAndBelongsToMany();

		if (!empty($habtmAssoc)) {
			foreach ($habtmAssoc as $assoc) {
				if (!empty($this->attributes[$assoc['ids']])) {
					if (is_array($this->attributes[$assoc['ids']])) {
						$associated_instance_ids = $this->attributes[$assoc['ids']];
					}
					else {
						$associated_instance_ids = explode(',', $this->attributes[$assoc['ids']]);
					}

					if (!empty($associated_instance_ids)) {
						$added = false;
						foreach ($associated_instance_ids as $associated_instance_id) {
							// if not "" and parsed int result is ALL constant...
							// Should only be added once, so we set $added to true.
							if (strcmp($associated_instance_id, '') !== 0 && (int)$associated_instance_id === $this::_ALL_HABTM_IDS && $added == false) {
								$added = true;
								$foreignKey = (object) array('name' => $assoc['foreign_key'], 'type' => MYSQLI_TYPE_LONG);
								$assocForeignKey = (object) array('name' => $assoc['association_foreign_key'], 'type' => MYSQLI_TYPE_LONG);

								$sql = app()->db->getSqlInsert(
									$assoc['join_table'],
									array($foreignKey, $assocForeignKey),
									array($assoc['foreign_key'] => $this->attributes['id'], $assoc['association_foreign_key'] => $this::_ALL_HABTM_IDS)
								);
								app()->db->execute($sql);
							}
						}
					}
				}
			}
		}
	}

	// Options:
	// 'force' => boolean (false)
	// 'retrieve' => boolean (false)
	//
	// 'force' MUST be used to force save associated models. Force could mean two things:
	// 1. Forces saving even when no change is made to instance attributes (the changes may be made in associated models that we can't detect).
	// 2. Forces keeping instance attributes. This is so that afterSave or afterCreate methods that used to
	//    store associated models can use passed associated params, i.e. if you set Model(array('associated_param_ids'))
	//    that associated_param_ids can be accessed in afterSave or afterCreate.
	//
	// When 'retrieve' is true, select data from database after saving. This is to make sure all variables are instantiated.
	public function save($options = array()) {
		$options = array_merge(array('on_error' => self::_DEFAULT, 'force' => false, 'retrieve' => false), $options);
//		// errorLog('begin save');
		// only saves when there are changes
		if ($this->attributes != $this->storedAttributes || $options['force'] == true) {
//			// errorLog('attributes ok');
			$className = get_called_class();
//			// errorLog("before index Field");
			$indexField = $className::model()->indexField();

			if (empty($this->attributes[$indexField])) {
//				// errorLog("empty  index field");
				$create = true;
				$this->beforeValidateOnCreate();
			}
			else {
//				// errorLog("not empty index field");
				$this->attributes[$indexField] = intval($this->attributes[$indexField]);
//				// errorLog("after get attributes index field");
				$this->beforeValidateOnUpdate();
//				// errorLog("after beforeValidateOnUpdate");
			}
			$this->beforeValidateOnSave();
//			// errorLog('before common save');
			$this->commonSave($className, $indexField, $create, $options['on_error']);
			if (empty($this->errors)) {
				if ($options['retrieve']) {
					$where = $indexField . " = '" . $this->attributes[$indexField] . "'";
					//eval('$new_instance_q = ' . $className . '::model()->find(array("where" => $where));');
					$new_instance_q = $className::model()->find(array("where" => $where));
					$new_instance = $new_instance_q->first();
					$this->newRecord = $new_instance->newRecord;
					$this->attributes = array_merge($this->attributes, $new_instance->attributes);
					$this->storedAttributes = $new_instance->storedAttributes;
					return $this;
				}
				else {
					return true;
				}
			}
			else {
//				errorLog("save failed, error was: ".print_r($this->errors, true));
				debugBacktrace();
				if ($options['on_error'] == self::_STOP) {
					echo "save failed, error was: ".print_r($this->errors, true)." (If you are unsure, please check save method happened in object $className, remember that when you save a model instance with association, associated objects must have no error)";
					exit;
				}
				return false;
			}
		}
		else {
			return $this;
		}
	}

	protected function validate() {
		return(true);
	}
	protected function validateOnDestroy() {
		return (true);
	}

	protected function validateOnCreate() {
		return(true);
	}

	protected function validateOnUpdate() {
		return(true);
	}

	protected function beforeValidateOnCreate() {

	}
	protected function beforeValidateOnUpdate() {

	}
	protected function beforeValidateOnSave() {

	}

// WARNING: The correct way to not allowing some fields to be changed on update/save is by
//          adding them into protectedFields, NOT by setting them to null in beforeUpdate or beforeSave or beforeCreate.
//          See method protectedFields for more details.

	protected function beforeCreate() {

	}
	protected function beforeUpdate() {

	}
	protected function beforeSave() {

	}
	protected function afterCreate($old_record = '') {

	}
	protected function afterUpdate($old_record = '') {

	}
	protected function afterSave($old_record = '') {

	}

	protected function beforeDestroy() {

	}

	protected function afterDestroy($old_record = '') {

	}

	private function saveAssociatedModels() {
		$className = get_called_class();
		$indexField = $className::model()->indexField();

		$habtmAssoc = $this::hasAndBelongsToMany();
		if (!empty($habtmAssoc)) {
			foreach($habtmAssoc as $assoc) {
				// for each association, find join tables, and save them according to ids.

				// test code for non-believers
				//// errorLog('assoc is');
				//// errorLog(print_r($assoc, true));
				//// errorLog('this attributes is');
				//// errorLog(print_r($this->attributes, true));
				//// errorLog('$this->attributes[$assoc[0]] is:');
				//// errorLog(print_r($this->attributes[$assoc[0]], true));
				//$this->attributes[$assoc[0]];
				// PHP GOTCHA: Arrays in php retained their indexes.
				// So if there is an array ([0] => 'a', [1] => 'b') then unset position 0 of that array,
				// what is left is array([1] => 'b'), that's why calling $assoc_objects[0] returns empty in some cases.
				// array_values fixes this by resetting the indexes.
				if (!empty($this->attributes[$assoc[0]])) {
					$assoc_objects = array_values($this->attributes[$assoc[0]]);
				}
				else {
					$assoc_objects = array();
				}
				//// errorLog("after reindex:");
				//// errorLog(print_r($assoc_objects, true));
				if (!empty($assoc_objects[0])) {

					// example if subscriber object has attribute 'template_categories' that is list of template categories
					// then below codes return first item of that attribute, which is a template category object
					$assoc_object_class_name = get_class($assoc_objects[0]);

					// test code for non-believers
					//// errorLog('assoc_objects / $this->attributes[$assoc[0]] is:');
					//// errorLog(print_r($assoc_objects, true));
					//// errorLog($assoc_object_class_name);

					$assoc_index_field = $assoc_object_class_name::model()->indexField();
					foreach($assoc_objects as $assoc_object) {
						if (!empty($assoc_object)) {
							$sql = "select * from " . $assoc['join_table'] . " where " . $assoc['foreign_key'] . " = '" . $this->attributes[$indexField] . "' and " . $assoc['association_foreign_key'] . " = '" . $assoc_object->attributes[$assoc_index_field] . "'";
							// check if associated rows exists
							$rs = app()->db->select($sql);

							// create / update associated object (need to do this before saving associated row to get id)
							// make sure no error is found, otherwise association record will be wrong.
							$assoc_object->save(array('on_error' => self::_STOP));
							//// errorLog('saved assoc object:');
							//// errorLog(print_r($assoc_object, true));

							if (empty($rs[0])) {
								// create join record if not exist
								// in cases where association id is 0, it is because assoc object to save.
								$foreignKey = (object) array('name' => $assoc['foreign_key'], 'type' => MYSQLI_TYPE_LONG);
								$assocForeignKey = (object) array('name' => $assoc['association_foreign_key'], 'type' => MYSQLI_TYPE_LONG);
								$sql = app()->db->getSqlInsert($assoc['join_table'], array($foreignKey, $assocForeignKey), array($assoc['foreign_key'] => $this->attributes[$indexField], $assoc['association_foreign_key'] => $assoc_object->attributes[$assoc_index_field]));
								//// errorLog($sql);
								app()->db->execute($sql);
							}
						}
					}
				}
			}
		}
	}
}