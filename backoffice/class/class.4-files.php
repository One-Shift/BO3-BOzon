<?php

/**
* c4_file Class
* Class used to deal with files information that is storaged in DB
* It's used in the BO in the files plugin and module
* Can also be used to deal with files for front-end purposes.
*
* @author 	Carlos Santos
* @version 1.1
* @since 2016-10
* @license The MIT License (MIT)
*/

class c4_file {
	protected $id; /** @var int **/
	protected $file; /** @var string **/
	protected $type; /** @var string **/
	protected $module; /** @var string **/
	protected $id_ass; /** @var int **/
	protected $description; /** @var string **/
	protected $code; /** @var string **/
	protected $sort = 0; /** @var int **/
	protected $user_id; /** @var int **/

	public function __construct() {}

	/** === SET METHODS === **/

	/** @param int **/
	public function setId ($i) {$this->id = $i;}

	/** @param string **/
	public function setFile ($f) {$this->file = $f;}

	/** @param string **/
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

	/** @param string **/
	public function setModule ($m) {$this->module = $m;}

	/** @param string **/
	public function setDescription ($d) {$this->description = $d;}

	/** @param string **/
	public function setCode ($c) {$this->code = $c;}

	/** @param int **/
	public function setIdAss ($ia) {$this->id_ass = $ia;}

	/** @param int **/
	public function setSort ($s) {$this->sort = $s;}

	/** @param int **/
	public function setUserId ($u) {$this->user_id = $u;}

	/** [Insert new file regist in DB] @return boolean */
	public function insert () {
		global $cfg, $db;

		return $db->query(sprintf(
			"INSERT INTO %s_4_files (file, type, module, id_ass, description, code, sort, user_id) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
			$cfg->db->prefix,
			$this->file,
			$this->type,
			$this->module,
			$this->id_ass,
			'',
			'',
			$this->user_id,
			$db->real_escape_string($this->sort),
		));
	}

	/** [Update file regist in DB by given ID] @return boolean */
	public function update () {
		global $cfg, $db;

		return $db->query(sprintf(
			"UPDATE %s_4_files SET file = '%s', type = '%s', module = '%s', id_ass = '%s', sort = '%s' WHERE id = '%s'",
			$cfg->db->prefix,
			$this->file,
			$this->type,
			$this->module,
			$this->id_ass,
			$db->real_escape_string($this->sort),
			$this->id
		));
	}

	/** [Update file regist in DB by given ID] @return boolean */
	public function simpleUpdate () {
		global $cfg, $db;

		return $db->query(sprintf(
			"UPDATE %s_4_files SET description = '%s', code = '%s', sort = %s WHERE id = %s",
			$cfg->db->prefix,
			$db->real_escape_string($this->description),
			$db->real_escape_string($this->code),
			$db->real_escape_string($this->sort),
			$this->id
		));
	}

	/** [Update file regist in DB by given ID] @return boolean */
	public function normalUpdate () {
		global $cfg, $db;

		return $db->query(sprintf(
			"UPDATE %s_4_files SET module = '%s', id_ass = '%s', sort = '%s' WHERE id = '%s'",
			$cfg->db->prefix,
			$this->module,
			$this->id_ass,
			$db->real_escape_string($this->sort),
			$this->id
		));
	}

	/** [Update file regist in DB by given ID] @return boolean */
	public function updateIdAss () {
		global $cfg, $db;

		return $db->query(sprintf(
			"UPDATE %s_4_files SET id_ass = %s WHERE id = %s",
			$cfg->db->prefix,
			$this->id_ass,
			$this->id
		));
	}

	/** [Delete file regist] @return boolean */
	public function delete () {
		global $cfg, $db, $authData;

		$file = new c4_file();
		$file->setId($this->id);
		$file = $file->returnOneFile();

		$trash = new trash(json_encode($file), null, $cfg->mdl->folder, $authData->id);
		if($trash->insert()) {
			unset($file);

			return $db->query(sprintf(
				"DELETE FROM %s_4_files WHERE id = '%s'",
				$cfg->db->prefix,
				$this->id
			));
		}

		return FALSE;
	}

	/** [Return one file by given ID] @return object */
	public function returnOneFile () {
		global $cfg, $db;

		$source = $db->query(sprintf(
			"SELECT * FROM %s_4_files WHERE id = '%s'",
			$cfg->db->prefix,
			$this->id
		));

		if ($source->num_rows > 0) {
			return $source->fetch_object();
		}

		return FALSE;
	}

	/** [Return files by given args] @return array or @return boolean */
	public function returnFiles ($args = "") {
		global $cfg, $db;


		if (empty($args)) {
			if (is_array($this->code)) {
				foreach ($this->code as $key => $value) {
					if (!isset($code)) {
						$code = "";
					}
					$code .= "code LIKE '%{$value}%' AND ";
				}
			} elseif (is_string($code) && $code != "") {
				$code = "code LIKE '%{$code}%'";
			}

			$source = $db->query(sprintf(
				"SELECT * FROM %s_4_files WHERE %s",
				$cfg->db->prefix,
				((!empty($this->id_ass)) ? "id_ass = {$this->id_ass}" : null) .
				((!empty($this->id_ass)) ? " AND " : null) .
				((!empty($this->module)) ? "module = '{$this->module}'" : null) .
				((!empty($this->module)) ? " AND " : null) .
				((!empty($this->type)) ? "type = '{$this->type}'" : null) .
				((!empty($this->type)) ? " AND " : null) .
				((isset($code)) ? substr($code, 0, -4) : null)
			));
		} else {
			$source = $db->query(sprintf(
				"SELECT * FROM %s_4_files WHERE %s",
				$cfg->db->prefix,
				$args
			));
		}

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

	/** [Return files by Module] @return array or @return boolean */
	public function returnFilesByModule () {
		global $cfg, $db;

		if(isset($this->module) && !empty($this->module)) {
			$source = $db->query(sprintf(
				"SELECT  * FROM %s_4_files WHERE module = '%s'",
				$cfg->db->prefix, $this->module
			));

			if($source->num_rows > 0) {
				while ($data = $source->fetch_object()) {
					if(!isset($toReturn)) {
						$toReturn = [];
					}

					array_push($toReturn, $data);
				}
			}
		}

		return FALSE;
	}

	/** [Return files filtered by module and id_ass] @return array or @return boolean */
	public function returnFilterList () {
		global $cfg, $db;

		if (!is_null($this->id_ass) && ($this->id_ass != 0)) {
			$source = $db->query(sprintf(
				"SELECT * FROM %s_4_files WHERE id_ass = %s AND module = '%s' ORDER BY sort ASC",
				$cfg->db->prefix,
				$this->id_ass,
				$this->module
			));
		} else {
			$source = $db->query(sprintf(
				"SELECT * FROM %s_4_files WHERE id_ass != 0 ORDER BY sort ASC",
				$cfg->db->prefix,
				$this->module
			));
		}

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

	/** [Returns the properties of the given object] */
	public function returnObject() {
		return json_encode(get_object_vars($this));
	}


	public function fallback($id, $l) {
		$l = explode(",", $l);

		$file = new c4_file();

		foreach ($l as $i => $item) {
			if (!empty($item)) {
				$file->setId($item);
				$file->setIdAss((int)$id);
				$file->updateIdAss();
			}
		}
	}

	/** [Return the diferent modules that the files are associated to] @return array or @return boolean */
	public static function returnModules () {
		global $cfg, $db;

		$source = $db->query(sprintf(
			"SELECT module FROM %s_4_files WHERE true GROUP BY module ORDER BY module ASC",
			$cfg->db->prefix
		));

		$query = sprintf(
			"SELECT module FROM %s_4_files WHERE true GROUP BY module ORDER BY module ASC",
			$cfg->db->prefix
		);

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
