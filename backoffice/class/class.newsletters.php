<?php

class newsletters {

	protected $id;
	protected $email;
	protected $code;
	protected $date;
	protected $date_update;
	protected $state;

	public function __construct() {

	}

	public function setId($i) {
		$this->id = $i;
	}

	public function setEmail($e) {
		$this->email = $e;
	}

	public function setCode($c = null) {
		$this->code = sha1(md5(sha1(md5(time() . "_" . $c))));
	}

	public function setDate() {
		$this->date = date('Y-m-d H:i:s', time());
	}

	public function setDateUpdate() {
		$this->date_update = date('Y-m-d H:i:s', time());
	}

	public function insert() {
		global $configuration, $mysqli;

		$query = sprintf("INSERT INTO %s_newsletters (email, code, date) VALUES ('%s','%s','%s')", $configuration['mysql-prefix'], $this->email, $this->code, $this->date);

		$toReturn = $mysqli->query($query);

		$this->id = $mysqli->insert_id;

		return $toReturn;
	}

	public function update() {
		global $configuration, $mysqli;

		$query = sprintf("UPDATE %s_newsletters SET email = '%s', code = '%s', date_update = '%s' WHERE id = '%s'", $configuration['mysql-prefix'], $this->email, $this->code, $this->date_update, $this->id);

		return $mysqli->query($query);
	}

	public function delete() {
		global $configuration, $mysqli;

		$query = sprintf("DELETE FROM %s_newsletters WHERE id = '%s'", $configuration['mysql-prefix'], $this->id);

		return $mysqli->query($query);
	}

	public function returnObject() {
		return array(
			'email' => $this->email,
			'code' => $this->code,
			'date' => $this->date,
			'date_update' => $this->date_update
		);
	}

	public function returnOneRegistry() {
		global $configuration, $mysqli;

		$query = sprintf("SELECT * FROM %s_newsletters WHERE id = '%s' LIMIT 1", $configuration['mysql-prefix'], $this->id);
		$source = $mysqli->query($query);

		return $source->fetch_assoc();
	}

	public function returnOneRegistryByEmail() {
		global $configuration, $mysqli;

		$query = sprintf("SELECT * FROM %s_newsletters WHERE email = '%s' LIMIT 1", $configuration['mysql-prefix'], $this->email);
		$source = $mysqli->query($query);

		return $source->fetch_assoc();
	}

	public function existRegistryByEmail() {
		global $configuration, $mysqli;

		$query = sprintf("SELECT * FROM %s_newsletters WHERE email = '%s' LIMIT 1", $configuration['mysql-prefix'], $this->email);
		$source = $mysqli->query($query);

		return $source->num_rows;
	}

	public function existRegistryByCode() {
		global $configuration, $mysqli;

		$query = sprintf("SELECT * FROM %s_newsletters WHERE code = '%s' LIMIT 1", $configuration['mysql-prefix'], $this->code);
		$source = $mysqli->query($query);

		return $source->num_rows;
	}

	public function returnAllRegistries() {
		global $configuration, $mysqli;

		$query = sprintf("SELECT * FROM %s_newsletters WHERE true", $configuration['mysql-prefix']);
		$source = $mysqli->query($query);

		$toReturn = array();
		$i = 0;

		while ($data = $source->fetch_assoc()) {
			$toReturn[$i] = $data;
			$i++;
		}

		return $toReturn;
	}

	public function enable() {
		global $configuration, $mysqli;

		$query = sprintf("UPDATE %s_newsletters SET active = '%s' WHERE id = '%s'", $configuration['mysql-prefix'], true, $this->id);
		return $mysqli->query($query);
	}

	public function disable() {
		global $configuration, $mysqli;

		$query = sprintf("UPDATE %s_newsletters SET active = '%s' WHERE id = '%s'", $configuration['mysql-prefix'], false, $this->id);
		return $mysqli->query($query);
	}

}
