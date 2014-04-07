<?php

class db {
	private static $_instance = null;
	private $_pdo,
	$_query,
	$_results,
	$_count = 0,
	$_error = false;


	public function __construct() {
		try {
			$this->_pdo = new PDO("sqlite:includes/baza.db");
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public static function getInstance() {
		if (!isset(self::$_instance))
			self::$_instance = new db();

		return self::$_instance;
	}

	public function query($sql, $params = array()) {
		$this->_error = false;
		$spremi = $this->_query = $this->_pdo->prepare($sql);

		if ($spremi) {
			$x = 1;

			if (count($params)) {
				foreach($params as $param) {
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}

			$exec = $this->_query->execute();

			if ($exec) {
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			} else
				$this->_error = true;
		}

		return $this;
	}

	public function action($action, $table, $where = array()) {
		if(count($where) == 3) {
			$operators = array('=','>','<','>=','<=');

			$field = $where[0];
			$operator = $where[1];
			$value = $where[2];

			if (in_array($operator, $operators)) {
				$sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

				$query = $this->query($sql, array($value))->error();
				if (!$query)	return $this;
			}
		}
		return false;
	}

	public function error() {
		return $this->_error;
	}

	public function results() {
		return $this->_results;
	}

	public function count() {
		return $this->_count;
	}

	public function first() {
		return $this->results()[0];
	}

	public function get($table, $where) {
		return $this->action("SELECT *", $table, $where);
	}

	public function delete($table, $where) {
		return $this->action("DELETE", $table, $where);
	}

	public function insert($table, $fields = array()) {
		$keys = array_keys($fields);
		$values = '';
		$x = 1;

		foreach ($fields as $field) {
			$values .= "?";

			if ($x < count($fields))
				$values .= ", ";

			$x++;
		}

		$sql = "INSERT INTO `{$table}` (`" . implode('`, `', $keys) . "`) VALUES ({$values})";

		if(!$this->query($sql, $fields)->error())
			return true;

		return false;
	}

	public function update($table, $id, $fields) {
		$set = '';
		$x = 1;

		foreach ($fields as $name => $value) {
			$set .= "{$name} = ?";

			if ($x < count($fields))
				$set .= ', ';

			$x++;
		}

		$sql = "UPDATE `{$table}` SET {$set} WHERE `id` = '$id'";

		if (!$this->query($sql, $fields)->error())
			return true;

		return false;
	}

	public function rowCount($sql) {
		$count = $this->_pdo->query($sql)->fetchColumn();
		return $count;
	}
}

?>