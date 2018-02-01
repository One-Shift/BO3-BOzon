<?php

class user {
	protected $id;
	protected $username;
	protected $password;
	protected $email;
	protected $rank;
	protected $code;
	protected $custom_css;
	protected $status = false;
	protected $user_key;
	protected $date;
	protected $date_update;

	public function __construct() {}

	public function setUsername($u) {
		$this->username = $u;
	}

	public static function getSecurePassword ($p) {
		return sha1(md5(sha1(md5($p))));
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
			case "owner":
				$this->rank = "owner";
				break;
			case "manager":
				$this->rank = "manager";
				break;
			case "member":
				$this->rank = "member";
				break;
			default: $this->rank = "member";
		}
	}

	public function setCode($c) {
		$this->code = $c;
	}

	public function setCustomCss($c) {
		$this->custom_css = $c;
	}

	public function setStatus($s) {
		if ($s) {
			$this->status = TRUE;
		} else {
			$this->status = FALSE;
		}
	}

	public function setUserKey() {
		$this->user_key = md5("{$this->username}+{$this->email}+{$this->date}+{$this->date_update}");
	}

	public function setDate($d = null) {
		$this->date = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function setDateUpdate($d = null) {
		$this->date_update = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function insert() {
		global $cfg, $db;

		$query = sprintf(
			"INSERT INTO %s_users (username, password, email, rank, code, status, user_key, date, date_update) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
			$cfg->db->prefix,
			$this->username,
			$this->password,
			$this->email,
			$this->rank,
			$this->code,
			$this->status,
			$this->user_key,
			$this->date,
			$this->date_update
		);

		$toReturn = $db->query($query);

		$this->id = $db->insert_id;

		return $toReturn;
	}

	public function update() {
		global $cfg, $db;

		$query = sprintf(
			"UPDATE %s_users SET username = '%s', password = '%s', email = '%s', rank = '%s', code = '%s', status = '%s', user_key = '%s', date = '%s', date_update = '%s' WHERE id = '%s'",
			$cfg->db->prefix,
			$this->username,
			$this->password,
			$this->email,
			$this->rank,
			$this->code,
			$this->status,
			$this->user_key,
			$this->date,
			$this->date_update,
			$this->id
		);

		return $db->query($query);
	}

	public function update_custom_css() {
		global $cfg, $db;

		$query = sprintf(
			"UPDATE %s_users SET custom_css = '%s', date_update = '%s' WHERE id = '%s'",
			$cfg->db->prefix,
			$this->custom_css,
			$this->date_update,
			$this->id
		);

		return $db->query($query);
	}

	public function delete() {
		global $cfg, $db, $authData;

		$user = new user();
		$user->setId($this->id);
		$user = $user->returnOneUser();

		$trash = new trash();
		$trash->setCode(json_encode($user));
		$trash->setDate();
		$trash->setModule($cfg->mdl->folder);
		$trash->setUser($authData["id"]);
		$trash->insert();

		unset($user);

		$query = sprintf(
			"DELETE FROM %s_users WHERE id = '%s'",
			$cfg->db->prefix,
			$this->id
		);

		return $db->query($query);
	}

	public function returnObject() {
		return get_object_vars($this);
	}

	public function returnOneUser() {
		global $cfg, $db;

		$query = sprintf("SELECT * FROM %s_users WHERE id = '%s' LIMIT 1", $cfg->db->prefix, $this->id);
		$source = $db->query($query);

		return $source->fetch_object();
	}

	public function existUserByName() {
		global $cfg, $db;

		$query = sprintf("SELECT * FROM %s_users WHERE username = '%s' LIMIT 1", $cfg->db->prefix, $this->username);
		$source = $db->query($query);

		return $source->num_rows;
	}

	public function returnOneUserByEmail() {
		global $cfg, $db;

		$query = sprintf(
			"SELECT * FROM %s_users WHERE email = '%s' AND status = '%s' LIMIT 1",
			$cfg->db->prefix,
			$this->email,
			$this->status
		);
		$source = $db->query($query);

		return $source->fetch_object();
	}

	public function existUserByEmail() {
		global $cfg, $db;

		$query = sprintf("SELECT * FROM %s_users WHERE email = '%s' LIMIT 1", $cfg->db->prefix, $this->email);
		$source = $db->query($query);

		return $source->num_rows;
	}

	public function returnAllUsers() {
		global $cfg, $db;

		$query = sprintf("SELECT * FROM %s_users WHERE true", $cfg->db->prefix);
		$source = $db->query($query);

		$toReturn = [];
		$i = 0;

		while ($data = $source->fetch_object()) {
			$toReturn[$i] = $data;
			$i++;
		}

		return $toReturn;
	}

	public static function isOwner ($authData) {
		return $authData["rank"] == "owner";
	}
}
