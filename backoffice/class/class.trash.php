<?php

class trash {
	protected $id;
	protected $code;
	protected $date;
	protected $module;
	protected $user;

	public function __construct() {}

	public function setCode($c) {
		$this->code = $c;
	}

	public function setUser($u) {
		$this->user = $u;
	}

	public function setModule($m) {
		$this->module = $m;
	}

	public function setDate($d = null) {
		$this->date = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function insert() {
		global $cfg, $db;

		$query = sprintf(
			"INSERT INTO %s_trash (module, code, user_id, date) VALUES ('%s', '%s', '%s', '%s')",
			$cfg->db->prefix,
			$this->module,
			$this->code,
			$this->user,
			$this->date
		);

		$toReturn = $db->query($query);

		$this->id = $db->insert_id;

		return $toReturn;
	}
}
