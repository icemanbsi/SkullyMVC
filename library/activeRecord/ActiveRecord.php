<?php
/**
 * Created by Trio Design (trio@tgitriodesign.com).
 * Date: 4/25/13
 * Time: 10:07 AM
 * Description: Tiny active record object.
 * Supports HABTM relationships.
 * Extend a model with this class to let it harness its power.
 * Uses Singleton pattern (to call this class' functions, use ModelName::model()->...)
 * Feel free to override any method in this class within child classes, or even editing this file directly.
 */

namespace Library\ActiveRecord;

class ActiveRecord
{
	static $_models = array(); // Contains all loaded models.
	static $_modelFields = array(); // Contains all loaded models' fields, kept this in static to keep models from re-retrieve fields from database.

	public static function model($className = __CLASS__) {
		if (empty(self::$_models[$className])) {
			self::$_models[$className] = new $className(false);
		}
		return self::$_models[$className];
	}

	function _new($args = array(), $force = false) {
		$classname = get_called_class();
		$instance = new $classname($args, $force);
		return $instance;
	}

	// So that Model::model()->new can be called
	function __call( $methodName, $arguments ) {
		if( $methodName == 'new' ) {
			if (!empty($arguments[0])) {
				if (!empty($arguments[1])) {
					return $this->_new($arguments[0], $arguments[1]);
				}
				else {
					return $this->_new($arguments[0]);
				}
			}
			else {
				return $this->_new();
			}
		}
	}

	// Wanted to write function new but can't :|
	public function construct() {

	}

	// convert field constant to displayable text
	public function constText($field_name, $const) {
		$className = get_called_class();
		$setup = $className::model()->constTextSetup();
		$text = '';
		foreach($setup as $fieldSetup => $constSetups) {
			if ($field_name == $fieldSetup) {
				foreach($constSetups as $constSetup => $textSetup) {
					if ($const == $constSetup) {
						$text = $textSetup;
					}
				}
			}
		}

		return $text;
	}

	// should return csv of fields. Define this in all inherited class.
	public function fieldNames() {
		$className = get_called_class();
		$fieldNames = array();
		foreach($className::model()->fields() as $field) {
			$fieldNames[] = $field->name;
		}
		return $fieldNames;
	}

	// if forceUpdate is true, force update model fields. This is used in migrations when table
	// operations need to be done after adding or deleting fields.
	public function fields($forceUpdate = false) {
		$className = get_called_class();
		if (empty(self::$_modelFields[$className]) || $forceUpdate) {
			self::$_modelFields[$className] = app()->db->getFields($className::model()->tableName());
		}
		return self::$_modelFields[$className];
	}
	// should return table name this model connected to.
	public function tableName() {
		$class_r = explode('\\', get_called_class());
		return app()->table($class_r[count($class_r)-1]);
	}

	// should return field used as index
	public function indexField() {
		return "id";
	}

	// converts ("size" => '', "description" => "%nice%", "name" => ["one", "two", "three"], "age" => ">12", "bad" => false, "balls" => "!2")
	// into "description like('%nice%') and name in('one', 'two') and age > 12 and bad = false and balls != 2"
	public function arrayToWhereConditions($array) {
		$conditions = "";
		$counter = 0;
		if (is_array($array)) {
			foreach($array as $field => $value) {
				if ($value !== null) {
					if ($counter > 0) {
						$conditions .= " and ";
					}
					// ["one", "two", "three"]
					if (is_array($value) and !empty($value)) {
						$conditions .= "$field in('" . implode("', '", $value) . "')";
					}
					// "%nice%"
					elseif (strstr($value, '%')) {
						$conditions .= "$field like($value)";
					}
					// ">12" or "!2"
					elseif (substr($value, 0, 2) == ">=") {
						$conditions .= "$field >= '$value'";
					}
					elseif(substr($value, 0, 2) == "<=") {
						$conditions .= "$field <= '$value'";
					}
					elseif(substr($value, 0, 2) == "!=") {
						$conditions .= "$field != '$value'";
					}
					elseif(substr($value, 0, 1) == ">") {
						$conditions .= "$field > '$value'";
					}
					elseif(substr($value, 0, 1) == "<") {
						$conditions .= "$field < '$value'";
					}
					elseif(substr($value, 0, 1) == "!") {
						$conditions .= "$field != '$value'";
					}
					else {
						// true
						if (strcmp((string)$value, "true") == 0) {
							$conditions .= "$field = true";
						}
						elseif (strcmp((string)$value, "false") == 0) {
							$conditions .= "$field = false";
						}
						else {
							$conditions .= "$field = '$value'";
						}
					}
					$counter++;
				}
			}
		}
		return $conditions;
	}

	// should return an array containing:
	// - array of:
	//	 - associated instance name
	//	 - "class_name" => associated Model's name
	//	 - "join_table" => join table
	//	 - "foreign_key" => this Model's foreign key
	//	 - "association_foreign_key" => associated Model's foreign key
	//	 - "ids" => flattened ids attribute name, contains id of associated instances as comma separated string when called by getAttributes() method.
	//	 - "all_ids_value" =>
	//
	// example: array(array("dogs", "class_name" => "Dog", "join_table" => "owners_dogs", "foreign_key" => "creator_id", "association_foreign_key" => "dog_id", "ids" => "dog_ids"), array([another association]))
	// in the example's case, passing "dogs" parameter which is an array of Dog will be inserted to database.
	// To get instances use method getHabtmAttributes()

	public function hasAndBelongsToMany() {
		return array();
	}

	public function findById($id) {
		$tableName = $this->tableName();
		$where = "where " . $this->indexField() . " = '".$id."'";
		$modelQuery = new ModelQuery($this, "select * from $tableName $where limit 1");
		return $modelQuery->first();
	}

	public function find($conditions = array()) {
		//// errorLog(print_r($conditions, true));
		$className = get_called_class();
		if (!empty($conditions["from"])) {
			$from = "from " . $conditions["from"];
		}
		else {
			$from = "from " . $className::model()->tableName();
		}

		if (!empty($conditions["where"])) {
			$where = "where " . $conditions["where"];
		}
		else {
			$where = "";
		}
		//// errorLog("where is");
		//// errorLog($where);

		if (!empty($conditions["order"])) {
			$order = "order by " . $conditions["order"];
		}
		else {
			$order = '';
		}

		if (!empty($conditions["offset"])) {
			$offset = $conditions["offset"];
		}

		if (!empty($conditions["limit"])) {
			$limit = $conditions["limit"];
		}

		if (!isset($offset) && isset($limit)) {
			$limit_str = "limit 0, $limit";
		}
		elseif (isset($offset) && isset($limit)) {
			$limit_str = "limit $offset, $limit";
		}
		elseif (isset($offset) && !isset($limit)) {
			$limit_str = "limit $offset";
		}
		else {
			$limit_str = "";
		}
		if (!empty($conditions["join"])) {
			$join = "left join ".$conditions["join"];
		}
		else {
			$join = "";
		}

		if (!empty($conditions["select"])) {
			$select = $conditions["select"];
		}
		else {
			// only show this object's fields, otherwise when we use from with multiple tables,
			// if both of these two tables have similar fieldnames, fieldnames of main table will get
			// overwritten (e.g. in case of templates and template_categories, both have dir_path, dir_path
			// of templates get overwritten and so the returned template model instance have wrong dir_path value).
			$select = "select ".$className::model()->tableName().".*";
		}
		if (!empty($conditions["group"])) {
			$group = "group by " . $conditions["group"];
		}
		else {
			$group = "";
		}
//		// errorLog("$select $from $join $where $group $order $limit_str");
//echo "$select $from $join $where $group $order $limit_str<br/>";
		$modelQuery = new ModelQuery($className, "$select $from $join $where $group $order $limit_str");
		return $modelQuery;
	}

	public function count($conditions = array()) {
//		errorLog("count conditions " . print_r($conditions, true));
		$className = get_called_class();
		$results = $className::model()->find(array_merge(array('select' => "SELECT count(*)"), $conditions));
		return $results->count();
	}

	public function max($field, $conditions = array()) {
		$className = get_called_class();
		if (!empty($conditions["where"])) {
			$where = "where " . $conditions["where"];
		}
		else {
			$where = "";
		}
		try {
			$sql = "select max($field) as max from ".$className::model()->tableName()." $where";
			//// errorLog($sql);
			$rs = app()->db->select($sql);
			//// errorLog(print_r($rs, true));
			return ($rs[0]["max"] ? $rs[0]["max"] : 0);
		}
		catch (\Exception $e) {
			//// errorLog("max function returned error: " . $e->getMessage());
			return 0;
		}
	}

	public function destroyAll() {
		$className = get_called_class();
		$tableName = $className::model()->tableName();
		$sql = "TRUNCATE " . $tableName;
		return app()->db->execute($sql);
	}

	// Can be called as static or instance function
	public function destroy($conditions = array()) {
		$className = get_called_class();
		$tableName = $className::model()->tableName();
		if (empty($conditions["from"])) {
			$from = "from " . $tableName;
		}
		else {
			$from = "from " . $conditions["from"];
		}
		$sql = "delete $from where " . $conditions['where'];
		//// errorLog("delete");
		//// errorLog($sql);
		return app()->db->execute($sql);
	}

	// returns an array of unique attributes
	protected function validatesUniquenessOf() {
		return array();
	}

	// returns an array of not-null attributes
	protected function validatesExistenceOf() {
		return array();
	}

	protected function validatesExistenceOnCreateOf() {
		return array();
	}

	protected function validatesExistenceOnUpdateOf() {
		return array();
	}
}
