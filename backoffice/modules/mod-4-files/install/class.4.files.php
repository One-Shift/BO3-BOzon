<?php

class file {
	protected $id;
	protected $file;
	protected $type;
	protected $module;
	protected $id_ass;
	protected $description;
	protected $code;
	protected $sort = 0;
	protected $user_id;
	protected $date;
	protected $date_update;

	public function __construct() {}

	public function setId ($i) {
		$this->id = $i;
	}

	public function setFile ($f) {
		$this->file = $f;
	}

	public function setType ($t) {
		switch ($t) {
			case 'img':
				$this->type = "img";
				break;
			case 'doc':
				$this->type = "doc";
				break;
			default:
				$this->type = "img";
				break;
		}
	}

	public function setModule ($m) {
		$this->module = $m;
	}

	public function setDescription ($d) {
		$this->description = $d;
	}

	public function setCode ($c) {
		$this->code = $c;
	}

	public function setIdAss ($ia) {
		$this->id_ass = $ia;
	}

	public function setSort ($s) {
		$this->sort = $s;
	}

	public function setUserId ($u) {
		$this->user_id = $u;
	}

	public function setDate($d = null) {
		$this->date = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function setDateUpdate($d = null) {
		$this->date_update = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function insert () {
		global $cfg, $db;

		$query = sprintf(
			"INSERT INTO %s_files (file, type, module, id_ass, description, code, sort, user_id, date, date_update) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
			$cfg->db->prefix,
			$this->file,
			$this->type,
			$this->module,
			$this->id_ass,
			'',
			'',
			$this->user_id,
			$db->real_escape_string($this->sort),
			$this->date,
			$this->date_update
		);

		$toReturn = $db->query($query);

		$this->id = $db->insert_id;

		return $toReturn;
	}

	public function update () {
		global $cfg, $db;

		$query = sprintf(
			"UPDATE %s_files SET file = '%s', type = '%s', module = '%s', id_ass = '%s', sort = '%s', date = '%s', date_update = '%s' WHERE id = '%s'",
			$cfg->db->prefix,
			$this->file,
			$this->type,
			$this->module,
			$this->id_ass,
			$db->real_escape_string($this->sort),
			$this->date,
			$this->date_update,
			$this->id
		);

		return $db->query($query);
	}

	public function simpleUpdate () {
		global $cfg, $db;

		$query = sprintf(
			"UPDATE %s_files SET description = '%s', code = '%s', sort = %s, date_update = '%s' WHERE id = %s",
			$cfg->db->prefix,
			$db->real_escape_string($this->description),
			$db->real_escape_string($this->code),
			$db->real_escape_string($this->sort),
			$this->date_update,
			$this->id
		);

		return $db->query($query);
	}

	public function normalUpdate () {
		global $cfg, $db;

		$query = sprintf(
			"UPDATE %s_files SET module = '%s', id_ass = '%s', sort = '%s', date = '%s', date_update = '%s' WHERE id = '%s'",
			$cfg->db->prefix,
			$this->module,
			$this->id_ass,
			$db->real_escape_string($this->sort),
			$this->date,
			$this->date_update,
			$this->id
		);

		return $db->query($query);
	}

	public function updateIdAss () {
		global $cfg, $db;

		$query = sprintf(
			"UPDATE %s_files SET id_ass = %s, date_update = '%s' WHERE id = %s",
			$cfg->db->prefix,
			$this->id_ass,
			$this->date_update,
			$this->id
		);

		return $db->query($query);
	}

	public function delete () {
		global $cfg, $db, $authData;

		$file = new file();
		$file->setId($this->id);
		$file = $file->returnOneFile();

		$trash = new trash();
		$trash->setCode(json_encode($file));
		$trash->setDate();
		$trash->setModule($cfg->mdl->folder);
		$trash->setUser($authData["id"]);
		$trash->insert();

		unset($user);

		$query = sprintf(
			"DELETE FROM %s_files WHERE id = '%s'",
			$cfg->db->prefix,
			$this->id
		);

		return $db->query($query);
	}

	public function returnOneFile () {
		global $cfg, $db;

		$query = sprintf(
			"SELECT * FROM %s_files WHERE id = '%s'",
			$cfg->db->prefix,
			$this->id
		);

		$source = $db->query($query);

		if ($source->num_rows > 0) {
			return $source->fetch_object();
		}

		return FALSE;
	}

	public function returnFiles ($args = "") {
		global $cfg, $db;

		if (empty($args)) {
			$query = sprintf(
				"SELECT * FROM %s_files WHERE %s",
				$cfg->db->prefix,
				((!empty($this->id_ass)) ? "id_ass = {$this->id_ass}" : null) .
				((!empty($this->id_ass)) ? " AND " : null) .
				((!empty($this->module)) ? "module = '{$this->module}'" : null) .
				((!empty($this->module)) ? " AND " : null) .
				((!empty($this->type)) ? "type = '{$this->type}'" : null)
			);

			if (is_array($this->code)) {
				foreach ($this->code as $key => $value) {
					if (!isset($code)) {
						$code = "";
					}
					$code .= "code LIKE '%{$value}%' AND ";
				}
			}

			if (isset($code)) {
				if (!empty($this->id_ass) || !empty($this->module)) {
					$query .= " AND ";
				}
				$query .= substr($code, 0, -4);
			}
		} else {
			$query = sprintf(
				"SELECT * FROM %s_files WHERE %s",
				$cfg->db->prefix,
				$args
			);
		}

		$source = $db->query($query);

		if ($source->num_rows > 0) {
			if ($source->num_rows > 1) {
				while ($data = $source->fetch_object()) {
					if (!isset($toReturn)) {
						$toReturn = [];
					}

					array_push($toReturn, $data);
				}

				return $toReturn;
			} else {
				return $source->fetch_object();
			}
		}

		return FALSE;
	}

	public function returnFilesByModule () {}

	public function returnFilterList () {
		global $cfg, $db;

		if (!is_null($this->id_ass)) {
			$query = sprintf(
				"SELECT * FROM %s_files WHERE id_ass = %s AND module = '%s' ORDER BY sort ASC",
				$cfg->db->prefix,
				$this->id_ass,
				$this->module
			);
		} else {
			$query = sprintf(
				"SELECT * FROM %s_files WHERE id_ass != 0 AND module = '%s' ORDER BY sort ASC",
				$cfg->db->prefix,
				$this->module
			);
		}

		$source = $db->query($query);

		if ($source->num_rows > 0) {
			while ($data = $source->fetch_object()) {
				if (!isset($toReturn)) {
					$toReturn = [];
				}

				array_push($toReturn, $data);
			}

			return $toReturn;
		}

		return FALSE;
	}

	public function returnObject() {
		return json_encode(get_object_vars($this));
	}

	public function fallback($id, $l) {
		$l = explode(",", $l);

		$file = new file();
		$file->setDateUpdate();

		foreach ($l as $i => $item) {
			if (!empty($item)) {
				$file->setId($item);
				$file->setIdAss((int)$id);
				$file->updateIdAss();
			}
		}
	}

	public static function returnModules () {
		global $cfg, $db;

		$query = sprintf(
			"SELECT module FROM %s_files WHERE true GROUP BY module ORDER BY module ASC",
			$cfg->db->prefix
		);

		$source = $db->query($query);

		if ($source->num_rows > 0) {
			while ($data = $source->fetch_object()) {
				if (!isset($toReturn)) {
					$toReturn = [];
				}
				if (!empty($data->module)) {
					array_push($toReturn, $data->module);
				}
			}

			return $toReturn;
		}

		return FALSE;
	}
}
