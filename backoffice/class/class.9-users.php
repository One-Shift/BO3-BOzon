<?php

/**
* c9_user Class
* Class used to deal with users information that is storaged in DB
* It's used in the BO for user management
* Can also be used to deal with users information for front-end purposes.
*
* @author 	Carlos Santos
* @version 1.0
* @since 2016-10
* @license The MIT License (MIT)
*/

class c9_user {

	protected $id; /** @var int **/
	protected $username; /** @var string **/
	protected $password; /** @var string **/
	protected $email; /** @var string **/
	protected $rank; /** @var string **/
	protected $code; /** @var string **/
	protected $custom_css; /** @var string **/
	protected $status = FALSE; /** @var boolean **/
	protected $user_key; /** @var int **/
	protected $date; /** @var DateTime **/
	protected $date_update; /** @var DateTime **/

	public function __construct() {}

	/** === SET METHODS === **/

	/** @param string **/
	public function setUsername($u) {$this->username = $u;}

	/** @param string **/
	public static function getSecurePassword ($p) {return sha1(md5(sha1(md5($p))));}

	/** @param string **/
	public function setPassword($p) {$this->password = sha1(md5(sha1(md5($p))));}

	/** @param string **/
	public function setOldPassword($p) {$this->password = $p;}

	/** @param int **/
	public function setId($i) {$this->id = $i;}

	/** @param string **/
	public function setEmail($e) {$this->email = $e;}

	/** @param string **/
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

	/** @param string */
	public function setCode($c) {$this->code = $c;}

	/** @param string */
	public function setCustomCss($c) {$this->custom_css = $c;}

	/** @param boolean */
	public function setStatus($s = null) {$this->status = !is_null($s) ? $s : FALSE;}

	/** @param string */
	public function setUserKey() {$this->user_key = md5("{$this->username}+{$this->email}+{$this->date}+{$this->date_update}");}

	/** === CRUD Functions === */

	/** [Insert new user in DB] @return boolean */
	public function insert() {
		global $cfg, $db;

		return $db->query(sprintf(
			"INSERT INTO %s_9_users (`username`, `password`, `email`, `rank`, `code`, `status`, `user_key`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
			$cfg->db->prefix,
			$this->username,
			$this->password,
			$this->email,
			$this->rank,
			$this->code,
			$this->status,
			$this->user_key
		));
	}

	/** [Update information of a user by given ID] @return boolean */
	public function update() {
		global $cfg, $db;

		return $db->query(sprintf(
			"UPDATE %s_9_users SET username = '%s', password = '%s', email = '%s', rank = '%s', code = '%s', status = '%s', user_key = '%s' WHERE id = %d",
			$cfg->db->prefix,
			$this->username,
			$this->password,
			$this->email,
			$this->rank,
			$this->code,
			$this->status,
			$this->user_key,
			$this->id
		));
	}

	/** [Update custom CSS of a user by given ID] @return boolean */
	public function update_custom_css() {
		global $cfg, $db;

		return $db->query(sprintf(
			"UPDATE %s_9_users SET custom_css = '%s', date_update = '%s' WHERE id = %d",
			$cfg->db->prefix,
			$this->custom_css,
			$this->date_update,
			$this->id
		));
	}

	/** [Delete User. Owner rank required] @return boolean */
	public function delete() {
		global $cfg, $db, $authData;

		if($authData->rank == "owner") {
			$user = new c9_user();
			$user->setId($this->id);
			$user = $user->returnOneUser();

			$trash = new trash(json_encode($user), null, $cfg->mdl->folder, $authData->id);

			if($trash->insert()) {
				return $db->query(sprintf(
					"DELETE FROM %s_9_users WHERE id = %d",
					$cfg->db->prefix,
					$this->id
				));
			}

			unset($user);
		}

		return FALSE;
	}

	/** [Returns the properties of the given object] */
	public function returnObject() {return get_object_vars($this);}

	/** [Return one user by given ID] @return boolean OR @return object */
	public function returnOneUser() {
		global $cfg, $db;

		$source = $db->query(sprintf(
			"SELECT * FROM %s_9_users WHERE id = '%s' LIMIT 1", $cfg->db->prefix, $this->id
		));

		if($source->num_rows > 0) {
			return $source->fetch_object();
		}

		return FALSE;
	}

	/** [Return one user by given Email] @return boolean OR @return object */
	public function returnOneUserByEmail() {
		global $cfg, $db;

		$source = $db->query(sprintf(
			"SELECT * FROM %s_9_users WHERE email = '%s' AND status = %s LIMIT 1",
			$cfg->db->prefix,
			$this->email,
			$this->status
		));

		if($source->num_rows > 0) {
			return $source->fetch_object();
		}

		return FALSE;
	}

	/** [Check if there is any user with the same given name] @return boolean OR @return object */
	public static function existUserByName($username = null) {
		global $cfg, $db;

		if(!is_null($username)) {
			$source = $db->query(sprintf("SELECT * FROM %s_9_users WHERE username = '%s' LIMIT 1", $cfg->db->prefix, $username));

			if($source->num_rows > 0) {
				return $source->fetch_object();
			}
		}

		return FALSE;
	}

	/** [Check if there is any user with the same given email] @return boolean OR @return object */
	public static function existUserByEmail($email = null) {
		global $cfg, $db;

		if(!is_null($email)) {
			$source = $db->query(sprintf("SELECT * FROM %s_9_users WHERE email = '%s' LIMIT 1", $cfg->db->prefix, $email));

			if($source->num_rows > 0) {
				return $source->fetch_object();
			}
		}

		return FALSE;
	}

	/** [Return all users information from DB. Useful for lists in the BO] @return array */
	public function returnAllUsers() {
		global $cfg, $db;

		$toReturn = [];

		$source = $db->query(sprintf("SELECT * FROM %s_9_users WHERE TRUE", $cfg->db->prefix));

		if($source->num_rows > 0) {
			while ($data = $source->fetch_object()) {
				array_push($toReturn, $data);
			}
		}

		return $toReturn;
	}

	/** [Return the number of Users in the DB] @return int */
	public static function returnNumOfUsers () {
		global $cfg, $db;

		$source = $db->query(sprintf("SELECT * FROM %s_9_users WHERE TRUE", $cfg->db->prefix));

		return $source->num_rows;
	}

	/** [Quick check if user is Owner in the system.] @return boolean */
	public static function isOwner ($authData) {return $authData->rank == "owner";}


	/** === LOGS SECTIONS === **/
	//Used to track users access to the CMS/Platform

	/** [Return the logs from the login module] @return array */
	public function returnLogs () {
		global $cfg, $db;

		$toReturn = [];

		$source = $db->query(sprintf("SELECT * FROM %s_history WHERE module = '%s'", $cfg->db->prefix, "sys-login"));

		if($source->num_rows > 0) {
			while ($data = $source->fetch_object()) {
				array_push($toReturn, $data);
			}
		}

		return $toReturn;
	}

	/** [Return Logs from a user by given ID] @return array */
	public function returnLogsByUser () {
		global $cfg, $db;

		$toReturn = [];

		$source = $db->query(sprintf("SELECT * FROM %s_history WHERE user_id = %d AND module = '%s' ORDER BY %s", $cfg->db->prefix, $this->id, "sys-login", "date DESC"));

		if($source->num_rows > 0) {
			while ($data = $source->fetch_object()) {
				array_push($toReturn, $data);
			}
		}

		return $toReturn;
	}

	/** [Return the last log from a user by given ID] @return boolean OR @return object */
	public function returnUserLastLog () {
		global $cfg, $db;

		$source = $db->query(sprintf("SELECT * FROM %s_history WHERE user_id = %d AND module = '%s' ORDER BY %s LIMIT %s", $cfg->db->prefix, $this->id, "sys-login", "date DESC", 1));

		if($source->num_rows > 0) {
			return $source->fetch_object();
		}

		return FALSE;
	}

	/** [Return a single log by given ID] @return boolean OR @return object */
	public function returnLog () {
		global $cfg, $db;

		$source = $db->query(sprintf("SELECT * FROM %s_history WHERE id = %d LIMIT 1", $cfg->db->prefix, $this->id));

		if($source->num_rows > 0) {
			return $source->fetch_object();
		}

		return FALSE;
	}


	/* === USER FIELDS === */
	//Static functions go by the alias "get"

	/** [Insert a new field in the DB] @return boolean */
	public static function insertField ($name, $value, $placeholder, $type, $sort, $required, $status) {
		global $cfg, $db;

		return $db->query(sprintf(
			"INSERT INTO %s_9_users_fields (`name`, `value`, `placeholder`, `type`, `sort`,`required`, `status`, `date`, `date_update`) VALUES ('%s', '%s', '%s', '%s','%s', '%s', '%s', '%s', '%s')",
				$cfg->db->prefix,
				$db->real_escape_string($name),
				$db->real_escape_string($value),
				$db->real_escape_string($placeholder),
				$db->real_escape_string($type),
				$db->real_escape_string($sort),
				$required,
				$status,
				date('Y-m-d H:i:s', time()),
				date('Y-m-d H:i:s', time())
		));
	}

	/** [Update a field by the given ID] @return boolean */
	public static function updateField ($name, $value, $placeholder, $sort, $required, $status, $id) {
		global $cfg, $db;

		return $db->query(sprintf(
			"UPDATE %s_9_users_fields SET name = '%s', value = '%s', placeholder = '%s', sort = '%s', required = '%s', status = '%s', date_update = '%s' WHERE id = %d",
			$cfg->db->prefix,
			$db->real_escape_string($name),
			$db->real_escape_string($value),
			$db->real_escape_string($placeholder),
			$db->real_escape_string($sort),
			$db->real_escape_string($required),
			$db->real_escape_string($status),
			date('Y-m-d H:i:s', time()),
			$id
		));
	}

	/** [Delete a Field] @return boolean */
	public static function deleteField($id) {
		global $cfg, $db, $authData;

		$request = new c9_user();
		$field = $request->returnOneField($id);

		$trash = new trash(json_encode($gp), null, $cfg->mdl->folder, $authData->id);

		if($trash->insert()) {
			return $db->query(sprintf("DELETE FROM %s_9_users_fields WHERE id = %d", $cfg->db->prefix, $id));
		}

		unset($field);

		return FALSE;
	}

	/** [Get All fields. Independent from status] @return array */
	public static function getAllFields() {
		global $cfg, $db;

		$toReturn = [];

		$source = $db->query(sprintf("SELECT * FROM %s_9_users_fields WHERE TRUE", $cfg->db->prefix));

		if($source->num_rows > 0) {
			while ($data = $source->fetch_object()) {
				array_push($toReturn, $data);
			}
		}

		return $toReturn;
	}

	/** [Get available Fields] @return array */
	public static function getFields() {
		global $cfg, $db;

		$toReturn = [];

		$source = $db->query(sprintf("SELECT * FROM %s_9_users_fields WHERE status = %s", $cfg->db->prefix, 1));

		if($source->num_rows > 0) {
			while ($data = $source->fetch_object()) {
				array_push($toReturn, $data);
			}
		}

		return $toReturn;
	}

	/** [Get one field by given ID] @return boolean OR @return object */
	public static function getOneField($id = null) {
		global $cfg, $db;

		if(!is_null($id) && $id != 0) {
			$source = $db->query(sprintf("SELECT * FROM %s_9_users_fields WHERE id = %s LIMIT 1", $cfg->db->prefix, $id, 1));

			if($source->num_rows > 0) {
				return $source->fetch_object();
			}
		}

		return FALSE;
	}
}
