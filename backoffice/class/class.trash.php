<?php

/**
* trash Class
* Class used to save deleted data from other modules
* The purpose is give tools to developers to help his customers in the future.
* Can also be used to deal with files for front-end purposes.
*
* @author 	Carlos Santos
* @version 1.1
* @since 2016-10
* @license The MIT License (MIT)
*/

class trash {
	protected $id; /** @var int **/
	protected $code; /** @var string **/
	protected $module; /** @var string **/
	protected $user; /** @var int **/

	public function __construct() {}

	/** === SET METHODS === **/

	/** @param string **/
	public function setCode($c) {
		$this->code = $c;
	}

	/** @param int **/
	public function setUser($u) {
		$this->user = $u;
	}

	/** @param string **/
	public function setModule($m) {
		$this->module = $m;
	}

	/** [Insert new file regist in DB] @return boolean */
	public function insert() {
		global $cfg, $db;

		$query = sprintf(
			"INSERT INTO %s_trash (module, code, user_id) VALUES ('%s', '%s', %d)",
			$cfg->db->prefix,
			$this->module,
			$db->real_escape_string($this->code),
			$this->user
		);

		$toReturn = $db->query($query);

		$this->id = $db->insert_id;

		return $toReturn;
	}
}
