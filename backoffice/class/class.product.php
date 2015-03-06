<?php

class product {

	protected $id;
	protected $reference;
	protected $title_1;
	protected $content_1;
	protected $title_2;
	protected $content_2;
	protected $title_3;
	protected $content_3;
	protected $title_4;
	protected $content_4;
	protected $title_5;
	protected $content_5;
	protected $title_6;
	protected $content_6;
	protected $code;
	protected $service = false;
	protected $price;
	protected $vat;
	protected $discount;
	protected $user_id;
	protected $category_id;
	protected $date;
	protected $date_update;
	protected $published = false;
	protected $onhome = false;

	public function __construct() {

	}

	public function setContent($t_1, $c_1, $t_2, $c_2, $t_3, $c_3, $t_4, $c_4, $t_5, $c_5, $t_6, $c_6, $c) {
		$this->title_1 = $t_1;
		$this->content_1 = $c_1;
		$this->title_2 = $t_2;
		$this->content_2 = $c_2;
		$this->title_3 = $t_3;
		$this->content_3 = $c_3;
		$this->title_4 = $t_4;
		$this->content_4 = $c_4;
		$this->title_5 = $t_5;
		$this->content_5 = $c_5;
		$this->title_6 = $t_6;
		$this->content_6 = $c_6;
		$this->code = $c;
	}

	public function setId($i) {
		$this->id = $i;
	}

	public function setReference($r) {
		$this->reference = $r;
	}

	public function setService($s) {
		$this->service = $s;
	}

	public function setPrice($p) {
		$this->price = $p;
	}

	public function setVAT($v) {
		$this->vat = $v;
	}

	public function setDiscount($d) {
		$this->discount = $d;
	}

	public function setUserId($u) {
		$this->user_id = $u;
	}

	public function setCategory($c) {
		$this->category_id = $c;
	}

	public function setDate($d = null) {
		$this->date = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function setDateUpdate($d = null) {
		$this->date_update = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function setPublished($p) {
		$this->published = $p;
	}

	public function setonHome($h) {
		$this->onhome = $h;
	}

	public function insert() {
		global $configuration, $mysqli;

		$query = sprintf(
				"INSERT INTO %s_products (reference, title_1, content_1, title_2, content_2, title_3, content_3, title_4, content_4, title_5, content_5, title_6, content_6, code, service, price, vat, discount, user_id, category_id, date, date_update, published, onhome) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",
				$configuration["mysql-prefix"],
				$mysqli->real_escape_string($this->reference),
				$mysqli->real_escape_string($this->title_1),
				$mysqli->real_escape_string($this->content_1),
				$mysqli->real_escape_string($this->title_2),
				$mysqli->real_escape_string($this->content_2),
				$mysqli->real_escape_string($this->title_3),
				$mysqli->real_escape_string($this->content_3),
				$mysqli->real_escape_string($this->title_4),
				$mysqli->real_escape_string($this->content_4),
				$mysqli->real_escape_string($this->title_5),
				$mysqli->real_escape_string($this->content_5),
				$mysqli->real_escape_string($this->title_6),
				$mysqli->real_escape_string($this->content_6),
				$this->code,
				$this->service,
				$mysqli->real_escape_string($this->price),
				$mysqli->real_escape_string($this->vat),
				$mysqli->real_escape_string($this->discount),
				$this->user_id,
				$this->category_id,
				$this->date,
				$this->date_update,
				$this->published,
				$this->onhome
				);

		$toReturn = $mysqli->query($query);

		$this->id = $mysqli->insert_id;

		return $toReturn;
	}

	public function update() {
		global $configuration, $mysqli;

		$query = sprintf("UPDATE %s_products SET reference = '%s', title_1 = '%s', content_1 = '%s', title_2 = '%s', content_2 = '%s',  title_3 = '%s', content_3 = '%s', title_4 = '%s', content_4 = '%s', title_5 = '%s', content_5 = '%s', title_6 = '%s', content_6 = '%s', code = '%s', service = '%s', price = '%s', vat = '%s', discount = '%s', category_id = '%s', date_update = '%s', published = '%s', onhome = '%s' WHERE id = '%s'",
				$configuration['mysql-prefix'],
				$mysqli->real_escape_string($this->reference),
				$mysqli->real_escape_string($this->title_1),
				$mysqli->real_escape_string($this->content_1),
				$mysqli->real_escape_string($this->title_2),
				$mysqli->real_escape_string($this->content_2),
				$mysqli->real_escape_string($this->title_3),
				$mysqli->real_escape_string($this->content_3),
				$mysqli->real_escape_string($this->title_4),
				$mysqli->real_escape_string($this->content_4),
				$mysqli->real_escape_string($this->title_5),
				$mysqli->real_escape_string($this->content_5),
				$mysqli->real_escape_string($this->title_6),
				$mysqli->real_escape_string($this->content_6),
				$this->code, $this->service,
				$mysqli->real_escape_string($this->price),
				$mysqli->real_escape_string($this->vat),
				$mysqli->real_escape_string($this->discount),
				$this->category_id,
				$this->date_update,
				$this->published,
				$this->onhome,
				$this->id
				);

		return $mysqli->query($query);
	}

	public function delete() {
		global $configuration, $mysqli;

		$query = sprintf("DELETE FROM %s_products WHERE id = '%s'", $configuration['mysql-prefix'], $this->id);

		return $mysqli->query($query);
	}

	public function returnObject() {
		return array(
			"reference" => $this->reference,
			"title_1" => $this->title_1,
			"content_1" => $this->content_1,
			"title_2" => $this->title_2,
			"content_2" => $this->content_2,
			"title_3" => $this->title_3,
			"content_3" => $this->content_3,
			"title_4" => $this->title_4,
			"content_4" => $this->content_4,
			"title_5" => $this->title_5,
			"content_5" => $this->content_5,
			"title_6" => $this->title_6,
			"content_6" => $this->content_6,
			"code" => $this->code,
			"user_id" => $this->user_id,
			"category" => $this->category_id,
			"date" => $this->date,
			"published" => $this->published,
			"onHome" => $this->onHome
		);
	}

	public function returnOneProduct() {
		global $configuration, $mysqli;

		$query = sprintf("SELECT * FROM %s_products WHERE id = '%s' LIMIT 1", $configuration['mysql-prefix'], $this->id);
		$source = $mysqli->query($query);

		return $source->fetch_array(MYSQLI_ASSOC);
	}

	public function returnAllProducts() {
		global $configuration, $mysqli;

		$query = sprintf("SELECT * FROM %s_products WHERE true ORDER BY id DESC", $configuration['mysql-prefix']);
		$source = $mysqli->query($query);

		$toReturn = array();
		$i = 0;

		while ($data = $source->fetch_array(MYSQLI_ASSOC)) {
			$toReturn[$i] = $data;
			$i++;
		}

		return $toReturn;
	}

	public function returnProducts($part_of_query) {
		global $configuration, $mysqli;

		$query = sprintf("SELECT * FROM %s_products %s", $configuration['mysql-prefix'], $part_of_query);
		$source = $mysqli->query($query);

		$toReturn = array();
		$i = 0;

		while ($data = $source->fetch_array(MYSQLI_ASSOC)) {
			$toReturn[$i] = $data;
			$i++;
		}

		return $toReturn;
	}

	public function increasePriority() {
		global $configuration, $mysqli;

		$query = sprintf("UPDATE %s_products SET priority += 1 WHERE id = '%s'", $configuration['mysql-prefix'], $this->id);

		return $mysqli->query($query);
	}

	public function decreasePriority() {
		global $configuration, $mysqli;

		$query = sprintf("UPDATE %s_products SET priority -= 1 WHERE id = '%s'", $configuration['mysql-prefix'], $this->id);

		return $mysqli->query($query);
	}

}
