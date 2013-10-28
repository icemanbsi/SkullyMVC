<?php
namespace Library\Database;
class DB {
	public $dbh;
	public $error_code;
	public $debug = false;
	public $err;

	public function __construct($server, $username, $password, $database) {
		$this->error_code=0;
		$this->dbh = mysqli_connect($server, $username, $password);
		if (!$this->dbh) {
			$this->error_code=-1;
		}
		else {
			@mysqli_query($this->dbh, "SET NAMES utf8");
		}
		if (!mysqli_select_db($this->dbh, $database)) {
			$this->error_code=-2;
		}
	}

	public function sanitizeName($name = '') {
		if (!empty($name)) {
			return preg_replace('/[^0-9a-zA-Z\.\_\-s]/i','',str_replace(' ', '_', $name));
		}
		else {
			return '';
		}
	}

	public function getFields($tableName) {
		$query = "SELECT * from ".$tableName." LIMIT 1";
		if ($result = @mysqli_query($this->dbh, $query)) {

			/* Get field information for all columns */
			$fields = mysqli_fetch_fields($result);
			return $fields;
		}
		return null;
	}

	public function execute($sql) {
		$sth = mysqli_query($this->dbh, $sql);
		$err = mysqli_error($this->dbh);

		if ($err) {
			errorLog("error is $err");
			errorLog("full query: $sql");
			debugBacktrace();
			$this->err = "<b>SQL error</b>: ".$err."<br>";
		}

		if (!$sth) {
			return false;
		};
		return $sth;
	}
	function lastInsertId() {
		return mysqli_insert_id($this->dbh);
	}

	function select($sql) {
		$result = array();

		$sth = $this->execute($sql);
		if (!$sth) return $result;

		while ($row=mysqli_fetch_array($sth, MYSQLI_ASSOC)) {
//			errorLog("row is " . print_r($row,true));
			$result[] = $row;
		}
		return $result;
	}

	// public function count($sql, $count="0") {
	// 	if ($sth = mysqli_query($this->dbh, $sql)) {
	// 		if ($count) {
	// 			$row=mysqli_fetch_array($this->dbh, $sth);
	// 			return (isset($row[0]) ? $row[0] : 0);
	// 		} else return mysqli_num_rows($sth);
	// 	} else return 0;
	// }

	// Fields: result of mysqli_fetch_fields
	public function getSqlInsert($table, $fields, &$val) {
		$usedFields = array();
		$val=(is_array($val) ? $val : ($val ? explode(", ", $val) : array()));
		$array=array();
		for ($i=0; $i<count($fields); $i++) {
			if (!empty($fields[$i]) && !empty($val[$fields[$i]->name])) {
				$usedFields[]= $fields[$i]->name;
				$val[$fields[$i]->name] = $this->sanitize($val[$fields[$i]->name], $fields[$i]->type);
				$array[]= "'".$val[$fields[$i]->name]."'";
			}
		}
		return (count($fields) ? "insert into `$table` (".implode(", ", $usedFields).") values (".implode(", ", $array).")" : "");
	}

	// Fields: result of mysqli_fetch_fields
	public function getSqlUpdate($table, $fields, &$val, $where) {
//		errorLog("val are " . print_r($val, true));
		if (count($fields)) {
			$sql="update $table set ";
			$count = 0;
			foreach($fields as $field) {
				$val[$field->name] = $this->sanitize($val[$field->name], $field->type);
				$sql.=($count!=0 ? ", " : "")."`".$field->name."`= '".$val[$field->name]."'";
				$count++;
			}
			$sql.=" $where";
			return $sql;
		}
		return "";
	}

	function sanitize($data, $type = MYSQLI_TYPE_STRING)
	{
		// remove whitespaces
		$data = trim($data);
		if (in_array($type, array(MYSQLI_TYPE_DOUBLE, MYSQLI_TYPE_LONG, MYSQLI_TYPE_LONGLONG, MYSQLI_TYPE_DECIMAL, MYSQLI_TYPE_TINY, MYSQLI_TYPE_SHORT, MYSQLI_TYPE_FLOAT))) {
			if (!is_numeric($data)) {
				$data = strtotime($data);
				if (!is_numeric($data)) {
					$data = 0;
				}
			}
		}
		elseif (in_array($type, array(MYSQLI_TYPE_DATETIME))) {
			if ((string) $data == '0000-00-00 00:00:00') {
				$data = date(app()->config('dateFormatDb'), 0);
			}
		}
		else {
			// apply stripslashes if magic_quotes_gpc is enabled
			if(get_magic_quotes_gpc())
			{
				$data = stripslashes($data);
			}

			// a mySQL connection is required before using this function
			$data = mysqli_real_escape_string($this->dbh, $data);
		}

		return $data;
	}

	function tstart() { }
	function tcommit() { }
	function trollback() { }

	function close() {
		@mysqli_close($this->dbh);
	}
}

?>