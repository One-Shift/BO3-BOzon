<?php

class article {
	protected $id;
	protected $lang_id;
	protected $category_id;
	protected $title = [];
	protected $description = [];
	protected $code;
	protected $user_id;
	protected $date;
	protected $date_update;
	protected $published = false;

	public function __construct() {}

	public function setId($i) {
		$this->id = $i;
	}

	public function setLangId($li) {
		$this->lang_id = $li;
	}

	public function setCategoryId($ci) {
		$this->category_id = $ci;
	}

	public function setContent($t, $d) {
		$this->title = $t;
		$this->description = $d;
	}

	public function setCode($c) {
		$this->code = $c;
	}

	public function setUserId($u) {
		$this->user_id = $u;
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

	public function insert() {}

	public function update() {}

	public function delete() {}

	// Returns one categorie in one language need category id and lang id. $this->id, $this->lang_id
	public function returnOneArticle() {
		global $cfg, $mysqli;

		$query = sprintf("SELECT bc.*, bcl.title, bcl.text
			FROM %s_articles bc
				INNER JOIN %s_articles_lang bcl on bcl.article_id = bc.id
			WHERE bc.id = %s and bcl.lang_id = %s",
			$cfg->db->prefix, $cfg->db->prefix, $this->id, $this->lang_id
		);

		$source = $mysqli->query($query);

		$toReturn = $source->fetch_object();

		return $toReturn;

	}

	public function returnArticlesByCategory($order = null, $limit = null) {
		global $cfg, $mysqli;

		$query = sprintf(
			"SELECT bc.*, bcl.title, bcl.text, bcl.lang_id
				FROM %s_articles bc
					INNER JOIN %s_articles_lang bcl on bcl.article_id = bc.id
				WHERE bc.category_id = %s
				%s %s",
			$cfg->db->prefix,
			$cfg->db->prefix,
			$this->category_id,
			($order !== null) ? "ORDER BY {$order}" : null,
			($limit !== null) ? "LIMIT {$limit}" : null
		);


		$source = $mysqli->query($query);

		if ($source->num_rows > 0) {
			$toReturn = [];

			while ($data = $source->fetch_object()) {
				array_push($toReturn, $data);
			}

			return $toReturn;
		}

		return false;
	}

	// Returns one categories in all languages need category id. $this->id
	public function returnOneArticleAllLanguages() {
		global $cfg, $mysqli;

		$query = sprintf("SELECT bc.*, bcl.title, bcl.text, bcl.lang_id
			FROM %s_articles bc
				INNER JOIN %s_articles_lang bcl on bcl.category_id = bc.id
			WHERE bc.id = %s
			LIMIT %s",
			$cfg->db->prefix, $cfg->db->prefix, $this->id, '1'
		);

		$source = $mysqli->query($query);

		$toReturn = [];

		while ($data = $source->fetch_object()) {
			// Push to index lang_id, the result of that row
			$toReturn[$data->lang_id] = $data;
		}

		return $toReturn;

	}
}
