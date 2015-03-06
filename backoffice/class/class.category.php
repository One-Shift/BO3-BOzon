<?php

class category {

	protected $id;
	protected $name_1;
	protected $description_1;
	protected $name_2;
	protected $description_2;
	protected $name_3;
	protected $description_3;
	protected $name_4;
	protected $description_4;
	protected $name_5;
	protected $description_5;
	protected $name_6;
	protected $description_6;
	protected $category_type;
	protected $date;
	protected $date_update;
	protected $user_id;
	protected $code;
	protected $published = false;

	public function __construct() {

	}

	public function setId($i) {
		$this->id = $i;
	}

	public function setContent($n_1, $d_1, $n_2, $d_2, $n_3, $d_3, $n_4, $d_4, $n_5, $d_5, $n_6, $d_6, $c) {
		$this->name_1 = $n_1;
		$this->description_1 = $d_1;
		$this->name_2 = $n_2;
		$this->description_2 = $d_2;
		$this->name_3 = $n_3;
		$this->description_3 = $d_3;
		$this->name_4 = $n_4;
		$this->description_4 = $d_4;
		$this->name_5 = $n_5;
		$this->description_5 = $d_5;
		$this->name_6 = $n_6;
		$this->description_6 = $d_6;
		$this->code = $c;
	}

	public function setUserId($u) {
		$this->user_id = $u;
	}

	public function setCategoryType($s) {
		$this->category_type = $s;
	}

	public function setPublished($p) {
		$this->published = $p;
	}

	public function setDate($d = null) {
		$this->date = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function setDateUpdate($d = null) {
		$this->date_update = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function insert() {
		global $configuration, $mysqli;

		$query = sprintf("INSERT INTO %s_categories (name_1, description_1, name_2, description_2, name_3, description_3, name_4, description_4, name_5, description_5, name_6, description_6, code, category_type, date, date_update, user_id, published) VALUES ('%s', '%s', '%s', '%s', '%s', '%s','%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $configuration['mysql-prefix'], $mysqli->real_escape_string($this->name_1), $mysqli->real_escape_string($this->description_1), $mysqli->real_escape_string($this->name_2), $mysqli->real_escape_string($this->description_2), $mysqli->real_escape_string($this->name_3), $mysqli->real_escape_string($this->description_3), $mysqli->real_escape_string($this->name_4), $mysqli->real_escape_string($this->description_4), $mysqli->real_escape_string($this->name_5), $mysqli->real_escape_string($this->description_5), $mysqli->real_escape_string($this->name_6), $mysqli->real_escape_string($this->description_6), $mysqli->real_escape_string($this->code), $this->category_type, $this->date, $this->date_update, $this->user_id, $this->published);

		$toReturn = $mysqli->query($query);

		$this->id = $mysqli->insert_id;

		return $toReturn;
	}

	public function update() {
		global $configuration, $mysqli;

		$query = sprintf("UPDATE %s_categories SET name_1 = '%s', description_1 = '%s', name_2 = '%s', description_2 = '%s', name_3 = '%s', description_3 = '%s', name_4 = '%s', description_4 = '%s', name_5 = '%s', description_5 = '%s', name_6 = '%s', description_6 = '%s', category_type = '%s', date = '%s', date_update = '%s', user_id = '%s', code = '%s', published = '%s' WHERE id = '%s'", $configuration['mysql-prefix'], $mysqli->real_escape_string($this->name_1), $mysqli->real_escape_string($this->description_1), $mysqli->real_escape_string($this->name_2), $mysqli->real_escape_string($this->description_2), $mysqli->real_escape_string($this->name_3), $mysqli->real_escape_string($this->description_3), $mysqli->real_escape_string($this->name_4), $mysqli->real_escape_string($this->description_4), $mysqli->real_escape_string($this->name_5), $mysqli->real_escape_string($this->description_5), $mysqli->real_escape_string($this->name_6), $mysqli->real_escape_string($this->description_6), $mysqli->real_escape_string($this->category_type), $this->date, $this->date_update, $mysqli->real_escape_string($this->user_id), $mysqli->real_escape_string($this->code), $this->published, $this->id);

		return $mysqli->query($query);
	}

	public function delete() {
		global $configuration, $mysqli;

		$query = sprintf("DELETE FROM %s_categories WHERE id = '%s'", $configuration['mysql-prefix'], $this->id);

		return $mysqli->query($query);
	}

	public function returnOneCategory() {
		global $configuration, $mysqli;

		$query = sprintf("SELECT * FROM %s_categories WHERE id = '%s' LIMIT 1", $configuration['mysql-prefix'], $this->id);
		$source = $mysqli->query($query);

		return $source->fetch_array(MYSQLI_ASSOC);
	}

	public function returnAllCategories() {
		global $configuration, $mysqli;

		$query = sprintf("SELECT * FROM %s_categories WHERE true ORDER BY %s ASC", $configuration['mysql-prefix'], "category_type");
		$source = $mysqli->query($query);

		$toReturn = array();
		$i = 0;

		while ($data = $source->fetch_array(MYSQLI_ASSOC)) {
			$toReturn[$i] = $data;
			$i++;
		}
		return $toReturn;
	}

	public function returnCategories($part_of_category) {
		global $configuration, $mysqli;

		$query = sprintf("SELECT * FROM %s_categories %s", $configuration['mysql-prefix'], $part_of_category);
		$source = $mysqli->query($query);

		$toReturn = array();
		$i = 0;

		while ($data = $source->fetch_array(MYSQLI_ASSOC)) {
			$toReturn[$i] = $data;
			$i++;
		}

		return $toReturn;
	}

}
