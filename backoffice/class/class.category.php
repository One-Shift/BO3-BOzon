<?php

class category {
	protected $id;
	protected $parent_id;
	protected $lang_id;
	protected $title_arr = [];
	protected $description_arr = [];
	protected $category_section;
	protected $date;
	protected $date_update;
	protected $user_id;
	protected $code;
	protected $sort;
	protected $published = false;

	public function __construct() {}

	public function setId($i) {
		$this->id = $i;
	}

	public function setParentId($pi) {
		$this->parent_id = $pi;
	}

	public function setLangId($li) {
		$this->lang_id = $li;
	}

	public function setContent($t, $d) {
		$this->title_arr = $t;
		$this->description_arr = $d;
	}

	public function setCode($c) {
		$this->code = $c;
	}

	public function setUserId($u) {
		$this->user_id = $u;
	}

	public function setCategorySection($s) {
		$this->category_section = $s;
	}

	public function setPublished($p) {
		$this->published = $p;
	}

	public function setSort($s) {
		$this->sort = $s;
	}

	public function setDate($d = null) {
		$this->date = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function setDateUpdate($d = null) {
		$this->date_update = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function insert() {
		global $cfg, $db;

		$query[0] = sprintf("INSERT INTO %s_categories (parent_id, category_section, code, sort, user_id, date, date_update, published) VALUES (%s, '%s', '%s', %s, %s, '%s', '%s', %s)",
			$cfg->db->prefix,
			$this->parent_id,
			$this->category_section,
			$this->code,
			$this->sort,
			$this->user_id,
			$this->date,
			$this->date_update,
			$this->published
		);

		if ($db->query($query[0])){

			$this->id = $db->insert_id;

			foreach ($this->title_arr as $i => $item) {
				$query[1] = sprintf("INSERT INTO %s_categories_lang (category_id, lang_id, title, text) VALUES (%s, %s, '%s', '%s')",
					$cfg->db->prefix,
					$this->id,
					$i+1,
					$this->title_arr[$i],
					$this->description_arr[$i]
				);

				$db->query($query[1]);
			}

			return true;
		} else {
			return false;
		}
	}

	public function update() {
		global $cfg, $db;
		$toReturn = false;

		$query[0] = sprintf("UPDATE %s_categories SET parent_id = '%s', category_section = '%s', code = '%s', sort = '%s', date = '%s', date_update = '%s', published = '%s' WHERE id = '%s'",
			$cfg->db->prefix,
			$this->parent_id,
			$this->category_section,
			$this->code,
			$this->sort,
			$this->date,
			$this->date_update,
			$this->published,
			$this->id
		);

		if ($db->query($query[0])){

			$toReturn = true;

			foreach ($cfg->lg as $index=>$lg) {
				if($lg[0]){
					$query[$index] = sprintf("UPDATE %s_categories_lang SET title = '%s', text = '%s' WHERE category_id = '%s' AND lang_id = '%s'",
						$cfg->db->prefix,
						$this->title_arr[$index-1],
						$this->description_arr[$index-1],
						$this->id,
						$index
					);

					if ($db->query($query[$index]) && $toReturn) {
						$toReturn = true;
					} else {
						$toReturn = false;
					}
				}
			}
		} else {
			$toReturn = false;
		}
		return $toReturn;
	}

	public function delete() {
		global $cfg, $db;

		$query = sprintf("DELETE c, cl
			FROM %s_categories c
				JOIN %s_categories_lang cl on cl.category_id = c.id
			WHERE c.id = %s",
				$cfg->db->prefix,
				$cfg->db->prefix,
				$this->id
		);

		return $db->query($query);
	}

	public function returnObject() {
		return get_object_vars($this);
	}

	// Returns one categorie in one language need category id and lang id. $this->id, $this->lang_id
	public function returnOneCategory() {
		global $cfg, $db;

		$query = sprintf("SELECT bc.*, bcl.title, bcl.text
			FROM %s_categories bc
				INNER JOIN %s_categories_lang AS bcl on bcl.category_id = bc.id
			WHERE bc.id = %s and bcl.lang_id = %s",
			$cfg->db->prefix, $cfg->db->prefix, $this->id, $this->lang_id
		);

		$source = $db->query($query);

		$toReturn = $source->fetch_object();

		return $toReturn;
	}

	// Returns one categories in all languages need category id. $this->id
	public function returnOneCategoryAllLanguages() {
		global $cfg, $db;

		$query = sprintf("SELECT bc.*, bcl.title, bcl.text, bcl.lang_id
			FROM %s_categories bc
				INNER JOIN %s_categories_lang AS bcl on bcl.category_id = bc.id
			WHERE bc.id = %s",
			$cfg->db->prefix, $cfg->db->prefix, $this->id
		);

		$source = $db->query($query);

		$toReturn = [];

		while ($data = $source->fetch_object()) {
			// Push to index lang_id, the result of that row
			$toReturn[$data->lang_id] = $data;
		}

		return $toReturn;
	}

	//Returns nr of childs of a category
	public function returnNrChildsCategory(){
		global $cfg, $db;

		$query = sprintf("SELECT COUNT(id) as 'nr_sub_cats'
			FROM %s_categories
			WHERE parent_id = '%s'",
			$cfg->db->prefix,
			$this->id
		);

		$source = $db->query($query);

		$nr = $source->num_rows;

		if($nr == 1) {
			return $source->fetch_object();
		} else {
			return false;
		}
	}


	// Returns AllMainCatgories need lang id. $this->lang_id
	public function returnAllMainCategories() {
		global $cfg, $db;

		$query = sprintf("SELECT bc.*, bcl.title, bcl.text, (SELECT COUNT(id) FROM %s_categories WHERE parent_id = bc.id) AS 'nr_sub_cats'
			FROM %s_categories bc
				INNER JOIN %s_categories_lang AS bcl on bcl.category_id = bc.id
			WHERE bc.parent_id = -1 AND bcl.lang_id = %s
			ORDER BY bc.category_section ASC, bcl.title ASC",
			$cfg->db->prefix, $cfg->db->prefix, $cfg->db->prefix, $this->lang_id
		);

		$source = $db->query($query);

		$toReturn = [];
		$i = 0;

		while ($data = $source->fetch_object()) {
			$toReturn[$i] = $data;
			$i++;
		}
		return $toReturn;
	}

	//Returns sub categories need category id and lang id. $this->parent_id, $this->lang_id
	public function returnChildCategories() {
		global $cfg, $db;

		$query = sprintf("SELECT bc.*, bcl.title, bcl.text, (SELECT COUNT(id) FROM %s_categories WHERE parent_id = bc.id) AS 'nr_sub_cats'
			FROM %s_categories bc
				INNER JOIN %s_categories_lang AS bcl on bcl.category_id = bc.id
			WHERE bc.parent_id = %s AND bcl.lang_id = %s
			ORDER BY bc.category_section ASC, bcl.title ASC",
			$cfg->db->prefix, $cfg->db->prefix, $cfg->db->prefix, $this->parent_id, $this->lang_id
		);

		$source = $db->query($query);

		$toReturn = [];
		$i = 0;

		while ($data = $source->fetch_object()) {
			$toReturn[$i] = $data;
			$i++;
		}
		return $toReturn;
	}

	// Returns AllMainCatgories need lang id. $this->lang_id
	public function returnAllCategories() {
		global $cfg, $db;

		$query = sprintf("SELECT bcl.title, bc.id
			FROM %s_categories bc
				INNER JOIN %s_categories_lang AS bcl on bcl.category_id = bc.id
			WHERE bcl.lang_id = %s
			ORDER BY bc.category_section ASC, bcl.title ASC",
			$cfg->db->prefix, $cfg->db->prefix, $this->lang_id
		);

		$source = $db->query($query);

		$toReturn = [];
		$i = 0;

		while ($data = $source->fetch_object()) {
			$toReturn[$i] = $data;
			$i++;
		}
		return $toReturn;
	}

	// Return AllSections
	public function returnAllSections() {
		global $cfg, $db;

		$query = sprintf("SELECT distinct category_section
			FROM %s_categories
			ORDER BY category_section ASC",
			$cfg->db->prefix
		);

		$source = $db->query($query);

		$toReturn = [];
		$i = 0;

		while ($data = $source->fetch_object()) {
			$toReturn[$i] = $data;
			$i++;
		}
		return $toReturn;
	}

}
