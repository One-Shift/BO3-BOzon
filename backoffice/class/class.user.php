<?php

class user {
	protected $id;
	protected $username;
	protected $password;
	protected $email;
	protected $rank;
	protected $code;
	protected $active = FALSE;

	public function __construct() {

	}

	public function setUsername($u) {
		$this->username = $u;
	}

	public function setPassword($p) {
		$this->password = sha1(md5(sha1(md5($p))));
	}

	public function setOldPassword($p) {
		$this->password = $p;
	}

	public function setId($i) {
		$this->id = $i;
	}

	public function setEmail($e) {
		$this->email = $e;
	}

	public function setRank($r) {
		switch ($r) {
			case "manager": $this->rank = "manager";
				break;
			case "member": $this->rank = "member";
				break;
			default: $this->rank = "member";
		}
	}

	public function setCode($c) {
		$this->code = $c;
	}

	public function setActive($a) {
		if ($a) {
			$this->active = TRUE;
		} else {
			$this->active = FALSE;
		}
	}

	public function insert() {
		global $cfg, $mysqli;

		$query = sprintf("INSERT INTO %s_users (name, password, email, rank, code)
                VALUES ('%s','%s','%s','%s','%s')", $cfg->db->prefix, $this->username, $this->password, $this->email, $this->rank, $this->code);

		$toReturn = $mysqli->query($query);

		$this->id = $mysqli->insert_id;

		return $toReturn;
	}

	public function update() {
		global $cfg, $mysqli;

		$query = sprintf("UPDATE %s_users SET name = '%s', password = '%s', email = '%s', rank = '%s', code = '%s'
            WHERE id = '%s'", $cfg->db->prefix, $this->username, $this->password, $this->email, $this->rank, $this->code, $this->id);

		return $mysqli->query($query);
	}

	public function delete() {
		global $cfg, $mysqli;

		$query = sprintf("DELETE FROM %s_users WHERE id = '%s'", $cfg->db->prefix, $this->id);

		return $mysqli->query($query);
	}

	public function returnObject() {
		return array(
			"name" => $this->username,
			"password" => $this->password,
			"email" => $this->email,
			"rank" => $this->rank
		);
	}

	public function returnOneUser() {
		global $cfg, $mysqli;

		$query = sprintf("SELECT * FROM %s_users WHERE id = '%s' LIMIT 1", $cfg->db->prefix, $this->id);
		$source = $mysqli->query($query);

		return $source->fetch_assoc();
	}

	public function existUserByName() {
		global $cfg, $mysqli;

		$query = sprintf("SELECT * FROM %s_users WHERE name = '%s' LIMIT 1", $cfg->db->prefix, $this->username);
		$source = $mysqli->query($query);

		return $source->num_rows;
	}

	public function returnOneUserByEmail() {
		global $cfg, $mysqli;

		$query = sprintf(
			"SELECT * FROM %s_users WHERE email = '%s' AND active = '%s' LIMIT 1",
			$cfg->db->prefix, $this->email, $this->active
		);
		$source = $mysqli->query($query);

		return $source->fetch_assoc();
	}

	public function existUserByEmail() {
		global $cfg, $mysqli;

		$query = sprintf("SELECT * FROM %s_users WHERE email = '%s' LIMIT 1", $cfg->db->prefix, $this->email);
		$source = $mysqli->query($query);

		return $source->num_rows;
	}

	public function returnAllUsers() {
		global $cfg, $mysqli;

		$query = sprintf("SELECT * FROM %s_users WHERE true", $cfg->db->prefix);
		$source = $mysqli->query($query);

		$toReturn = array();
		$i = 0;

		while ($data = $source->fetch_assoc()) {
			$toReturn[$i] = $data;
			$i++;
		}

		return $toReturn;
	}

	public function codeToArray($code) {
		$code = explode("[spr]", $code);

		return $code;
	}
}
