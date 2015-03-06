<?php

class article {

	protected $id;
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
	protected $user_id = 0;
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

	public function setUserId($w) {
		$this->user_id = $w;
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
		global $configuration;
		global $mysqli;

		$query = sprintf("INSERT INTO %s_articles (title_1, content_1, title_2, content_2, title_3, content_3, title_4, content_4, title_5, content_5, title_6, content_6, code, user_id, category_id, date, published, onhome) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')",
		$configuration['mysql-prefix'],
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
		$mysqli->real_escape_string($this->code),
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
		global $configuration;
		global $mysqli;

		$query = sprintf("UPDATE %s_articles SET title_1 = '%s', content_1 = '%s', title_2 = '%s', content_2 = '%s', title_3 = '%s', content_3 = '%s', title_4 = '%s', content_4 = '%s', title_5 = '%s', content_5 = '%s', title_6 = '%s', content_6 = '%s', code = '%s', category_id = '%s', date_update = '%s', published = '%s', onhome = '%s' WHERE id = '%s'",
		$configuration['mysql-prefix'],
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
		$mysqli->real_escape_string($this->code),
		$this->category_id,
		$this->date_update,
		$this->published,
		$this->onhome,
		$this->id);

		return $mysqli->query($query);
	}

	public function delete() {
		global $configuration;
		global $mysqli;

		$query = sprintf("DELETE FROM %s_articles WHERE id = '%s'", $configuration['mysql-prefix'], $this->id);

		return $mysqli->query($query);
	}

	public function returnObject() {
		return array(
			'title_1' => $this->title_1,
			'content_1' => $this->content_1,
			'title_2' => $this->title_2,
			'content_2' => $this->content_2,
			'title_3' => $this->title_3,
			'content_3' => $this->content_3,
			'title_4' => $this->title_4,
			'content_4' => $this->content_4,
			'title_5' => $this->title_5,
			'content_5' => $this->content_5,
			'title_6' => $this->title_6,
			'content_6' => $this->content_6,
			'user_id' => $this->user_id,
			'category_id' => $this->category_id,
			'date' => $this->date,
			'published' => $this->published,
			'onHome' => $this->onHome,
			'code' => $this->code
		);
	}

	public function returnOneArticle() {
		global $configuration;
		global $mysqli;

		$query = sprintf("SELECT * FROM %s_articles WHERE id = '%s' LIMIT 1", $configuration['mysql-prefix'], $this->id);
		$source = $mysqli->query($query);

		return $source->fetch_assoc();
	}

	public function returnAllArticles() {
		global $configuration;
		global $mysqli;

		$query = sprintf("SELECT * FROM %s_articles WHERE true ORDER BY id ASC", $configuration['mysql-prefix']);
		$source = $mysqli->query($query);

		$toReturn = array();
		$i = 0;

		while ($data = $source->fetch_assoc()) {
			$toReturn[$i] = $data;
			$i++;
		}

		return $toReturn;
	}

	public function returnImages($order) {
		global $configuration;
		global $mysqli;

		$query = sprintf("SELECT * FROM %s_images WHERE module = '%s' AND id_ass = '%s' ORDER BY %s %s", $configuration["mysql-prefix"], "article", $this->id, "id", $order);
		$source = $mysqli->query($query);

		$toReturn = array();
		$i = 0;

		while ($data = $source->fetch_assoc()) {
			$toReturn[$i] = $data;
			$i++;
		}

		return $toReturn;
	}

	public function returnDocs($order) {
		global $configuration;
		global $mysqli;

		$query = sprintf("SELECT * FROM %s_documents WHERE module = '%s' AND id_ass = '%s' ORDER BY %s %s", $configuration["mysql-prefix"], "article", $this->id, "id", $order);
		$source = $mysqli->query($query);

		$toReturn = array();
		$i = 0;

		while ($data = $source->fetch_assoc()) {
			$toReturn[$i] = $data;
			$i++;
		}

		return $toReturn;
	}

	public function increasePriority() {
		global $configuration;
		global $mysqli;

		$query = sprintf("UPDATE %s_articles SET priority += 1 WHERE id = '%s'", $configuration['mysql-prefix'], $this->id);

		return $mysqli->query($query);
	}

	public function decreasePriority() {
		global $configuration;
		global $mysqli;

		$query = sprintf("UPDATE %s_articles SET priority -= 1 WHERE id = '%s'", $configuration['mysql-prefix'], $this->id);

		return $mysqli->query($query);
	}

}
