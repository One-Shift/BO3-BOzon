<?php

/**
 * c7_article Class
 * Class used to deal with articles information that is storaged in DB
 * It's used in the BO for articles management
 * Can also be used to deal with articles information for front-end purposes.
 *
 * @author 	Carlos Santos
 * @version 1.0
 * @since 2016-10
 * @license The MIT License (MIT)
 */

class c7_article
{
	protected $id;
	/** @var int **/
	protected $category_id;
	/** @var int **/
	protected $title = [];
	/** @var array **/
	protected $description = [];
	/** @var array **/
	protected $code;
	/** @var string **/
	protected $user_id;
	/** @var int **/
	protected $date;
	/** @var DateTime **/
	protected $date_update;
	/** @var DateTime **/
	protected $status = false;
	/** @var boolean **/

	public function __construct()
	{
	}

	/** === SET METHODS === **/

	/** @param int **/
	public function setId($i)
	{
		$this->id = $i;
	}

	/** @param int **/
	public function setLangId($li)
	{
		$this->lang_id = $li;
	}

	/** @param array **/
	public function setCategories($cats)
	{
		$this->categories = $cats;
	}

	/** @param int **/
	public function setCategoryId($ci)
	{
		$this->category_id = $ci;
	}

	/** @param string **/
	public function setContent($t, $txt, $d, $k)
	{
		$this->title = $t;
		$this->text = $txt;
		$this->description = $d;
		$this->keywords = $k;
	}

	/** @param string **/
	public function setCode($c)
	{
		$this->code = $c;
	}

	/** @param int **/
	public function setUserId($u)
	{
		$this->user_id = $u;
	}

	/** @param DateTime **/
	public function setDate($d = null)
	{
		$this->date = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	/** @param DateTime **/
	public function setDateUpdate($d = null)
	{
		$this->date_update = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	/** @param boolean **/
	public function setStatus($s)
	{
		$this->status = $s;
	}

	/** [Insert new article in DB] @return boolean */
	public function insert()
	{
		global $cfg, $db, $authData;

		if (
			$db->query(sprintf(
				"INSERT INTO %s_7_articles (code, user_id, date, date_update, published) VALUES ('%s', '%s', '%s', '%s', '%s')",
				$cfg->db->prefix,
				$this->code,
				$authData->id,
				$this->date,
				$this->date_update,
				$this->published
			))
		) {
			$this->id = $db->insert_id;

			foreach ($this->title as $i => $item) {
				if (
					$db->query(sprintf(
						"INSERT INTO %s_7_articles_lang (article_id, lang_id, title, text, `meta-keywords`, `meta-description`) VALUES (%s, %s, '%s', '%s', '%s', '%s')",
						$cfg->db->prefix,
						$this->id,
						$i + 1,
						$db->real_escape_string($this->title[$i]),
						$db->real_escape_string($this->text[$i]),
						$db->real_escape_string($this->description[$i]),
						$db->real_escape_string($this->keywords[$i])
					))
				) {
					continue;
				} else {
					break;
					return FALSE;
				}
			}

			if (is_array($this->categories)) {
				foreach ($this->categories as $c => $cat) {
					$db->query(sprintf(
						"INSERT INTO %s_8_categories_rel (category_id, object_id, module, date, date_update) VALUES ('%s', %s, '%s', '%s', '%s')",
						$cfg->db->prefix,
						$cat,
						$this->id,
						"article",
						$this->date
					));
				}
			}

			return TRUE;
		}

		return FALSE;
	}

	/** [Update information of an article by given ID] @return boolean */
	public function update()
	{
		global $cfg, $db, $authData;

		if ($db->query(sprintf(
			"UPDATE %s_7_articles SET code = '%s', date = '%s', date_update = '%s', published = '%s', user_id = '%s' WHERE id = '%s'",
			$cfg->db->prefix,
			$this->code,
			$this->date,
			$this->date_update,
			$this->status,
			$authData->id,
			$this->id
		))) {
			foreach ($cfg->lg as $index => $lg) {
				if ($lg[0]) {
					$article_lang_check = $db->query(sprintf(
						"SELECT id FROM %s_7_articles_lang WHERE article_id = %s AND lang_id = %s",
						$cfg->db->prefix,
						$this->id,
						$index
					));

					if ($article_lang_check->num_rows > 0) {
						$db->query(sprintf(
							"UPDATE %s_7_articles_lang SET title = '%s', text = '%s', `meta-keywords` = '%s', `meta-description` = '%s' WHERE article_id = '%s' AND lang_id = '%s'",
							$cfg->db->prefix,
							$db->real_escape_string($this->title[$index - 1]),
							$db->real_escape_string($this->description[$index - 1]),
							$db->real_escape_string($this->description[$index - 1]),
							$db->real_escape_string($this->keywords[$index - 1]),
							$this->id,
							$index
						));
					} else {
						$db->query(sprintf(
							"INSERT INTO %s_7_articles_lang (article_id, lang_id, title, text) VALUES (%s, %s, '%s', '%s')",
							$cfg->db->prefix,
							$this->id,
							$index,
							$db->real_escape_string($this->title[$index - 1]),
							$db->real_escape_string($this->description[$index - 1]),
							$db->real_escape_string($this->description[$index - 1]),
							$db->real_escape_string($this->keywords[$index - 1])
						));
					}
				}
			}

			if (is_array($this->categories)) {
				$current_cats = c8_category::getRelCategories($this->id, "article");
				$diff_del = array_diff($current_cats, $this->categories);
				$diff_insert = array_diff($this->categories, $current_cats);

				if (!empty($diff_insert)) {
					foreach ($diff_insert as $d => $di) {
						$db->query(sprintf(
							"INSERT INTO %s_8_categories_rel (category_id, object_id, module, date, date_update) VALUES ('%s', '%s', '%s', '%s', '%s')",
							$cfg->db->prefix,
							$di,
							$this->id,
							"article",
							$this->date,
							$this->date_update
						));
					}
				}

				if (!empty($diff_del)) {
					foreach ($diff_del as $d => $dd) {
						$db->query(sprintf(
							"DELETE FROM %s_8_categories_rel WHERE category_id = %s AND object_id = %s AND module = '%s'",
							$cfg->db->prefix,
							$dd,
							$this->id,
							"article"
						));
					}
				}
			}

			return TRUE;
		}

		return FALSE;
	}

	/** [Delete article by given ID] @return boolean */
	public function delete()
	{
		global $cfg, $db, $authData;

		$request = new c7_article();
		$request->setId($this->id);
		$obj = $request->returnOneArticleAllLanguages();

		$trash = new trash(json_encode($obj), null, $cfg->mdl->folder, $authData->id);

		if ($trash->insert()) {
			if (
				$db->query(sprintf(
					"DELETE c, cl
					FROM %s_7_articles c
						JOIN %s_7_articles_lang cl on cl.article_id = c.id
					WHERE c.id = %s",
					$cfg->db->prefix,
					$cfg->db->prefix,
					$this->id
				))
			) {
				$current_cats = c8_category::getRelCategories($this->id, "article");
				if (count($current_cats) > 0 && is_array($current_cats)) {
					if (
						$db->query(sprintf(
							"DELETE FROM %s_8_categories_rel WHERE object_id = %s AND module = '%s'",
							$cfg->db->prefix,
							$this->id,
							"article"
						))
					) {
						return TRUE;
					}
				}

				return TRUE;
			}
		}

		return FALSE;
	}

	/** [Returns the properties of the given object] */
	public function returnObject()
	{
		return get_object_vars($this);
	}

	/** [Return all articles information from DB. Useful for lists in the BO] @return array */
	public function returnAllArticles()
	{
		global $cfg, $db;

		$toReturn = [];

		$source = $db->query(sprintf(
			"SELECT bc.*, bcl.title, bc.id
				FROM %s_7_articles bc
					INNER JOIN %s_7_articles_lang bcl on bcl.article_id = bc.id
				WHERE bcl.lang_id = '%s'
				ORDER BY bc.date ASC, bcl.title ASC",
			$cfg->db->prefix,
			$cfg->db->prefix,
			$this->lang_id
		));

		if ($source->num_rows > 0) {
			while ($data = $source->fetch_object()) {
				$data->categories_rel = c8_category::getRelCategories($data->id, "article");
				array_push($toReturn, $data);
			}
		}

		return $toReturn;
	}

	/** [Static function to get articles based on options. This is the ultimate article function. Noice!] @return array */
	public static function getArticles($cats = [], $search = null, $where = null, $user = null, $order = null, $limit = null, $offset = null)
	{
		global $cfg, $db, $lg;

		$toReturn = [];
		$cat_query = "";

		if (count($cats) > 0) {
			foreach ($cats as $c => $cat) {
				$cat_query .= ($c == 0) ? "rcl.category_id = {$cat['id']} " : "OR rcl.category_id = {$cat['id']} ";
			}
		}

		$source = $db->query(sprintf(
			"SELECT DISTINCT bc.id, bc.code, bc.date, bc.date_update, bc.user_id, bcl.title, bcl.text, bcl.`meta-description`, bcl.`meta-keywords`, bcl.lang_id
				FROM %s_7_articles bc
					INNER JOIN %s_7_articles_lang bcl ON bcl.article_id = bc.id
					INNER JOIN %s_8_categories_rel rcl on rcl.object_id = bc.id
				WHERE (%s) %s AND rcl.module = '%s' %s AND bcl.lang_id = %d %s %s %s %s",
			$cfg->db->prefix,
			$cfg->db->prefix,
			$cfg->db->prefix,
			!is_null($where) && is_string($where) && !empty($where) ? $db->real_escape_string($where) : "TRUE",
			!is_null($search) && is_string($search) && !empty($search) ? "AND (bc.code LIKE '%{$db->real_escape_string($search)}%' OR bcl.title LIKE '%{$db->real_escape_string($search)}%' OR bcl.text LIKE '%{$db->real_escape_string($search)}%')" : "",
			"article",
			!empty($cat_query) ? "AND ({$db->real_escape_string($cat_query)})" : "",
			$lg,
			!is_null($user) && is_int($user) && $user != 0 ? "AND user_id = {$user}" : "",
			!is_null($order) ? "ORDER BY {$db->real_escape_string($order)}" : null,
			!is_null($limit) && is_int($limit) ? (!is_null($offset) && is_int($offset) ? ($limit * $offset) : $limit) : "",
			(!is_null($limit) && is_int($limit)) && (!is_null($offset) && is_int($offset)) ? ($limit * $offset) + $offset : ""
		));

		if ($source->num_rows > 0) {
			while ($data = $source->fetch_object()) {
				$data->categories_rel = c8_category::getRelCategories($data->id, "article");
				array_push($toReturn, $data);
			}
		}

		return $toReturn;
	}

	/** [Return one article by given ID] @return boolean OR @return object */
	public function returnOneArticle()
	{
		global $cfg, $db;

		$source = $db->query(sprintf(
			"SELECT bc.*, bcl.title, bcl.text, bcl.`meta-keywords`, bcl.`meta-description`
			FROM %s_7_articles bc
				INNER JOIN %s_7_articles_lang bcl on bcl.article_id = bc.id
			WHERE bc.id = %s and bcl.lang_id = %s",
			$cfg->db->prefix,
			$cfg->db->prefix,
			$this->id,
			$this->lang_id
		));

		if ($source->num_rows > 0) {
			return $source->fetch_object();
		}

		return FALSE;
	}

	/** [Return one article's languages content by given ID] @return boolean OR @return array */
	public function returnOneArticleAllLanguages()
	{
		global $cfg, $db;

		$toReturn = [];

		$source = $db->query(sprintf(
			"SELECT bc.*, bcl.title, bcl.text, bcl.`meta-keywords`, bcl.`meta-description`, bcl.lang_id
			FROM %s_7_articles bc
				INNER JOIN %s_7_articles_lang bcl on bcl.article_id = bc.id
			WHERE bc.id = %s",
			$cfg->db->prefix,
			$cfg->db->prefix,
			$this->id
		));

		if ($source->num_rows > 0) {
			while ($data = $source->fetch_object()) {
				$rel_array = [];

				$source_rel = $db->query(sprintf(
					"SELECT * FROM %s_8_categories_rel WHERE object_id = %s",
					$cfg->db->prefix,
					$this->id
				));

				if ($source_rel->num_rows > 0) {
					while ($data_rel = $source_rel->fetch_object()) {
						array_push($rel_array, $data_rel->category_id);
					}

					$data->categories_rel = $rel_array;

					$toReturn[$data->lang_id] = $data;
				}
			}
		}
		return $toReturn;
	}

	/** [Return articles by category ID] @return boolean OR @return object */
	public function returnArticlesByCategory($where = null, $order = null, $limit = null)
	{
		global $cfg, $db, $lg;

		$source = $db->query(sprintf(
			"SELECT bc.*, bcl.title, bcl.text, bcl.`meta-keywords`, bcl.`meta-description`, bcl.lang_id
				FROM %s_7_articles bc
					INNER JOIN %s_7_articles_lang bcl on bcl.article_id = bc.id
					INNER JOIN %s_8_categories_rel rcl on rcl.object_id = bc.id
				WHERE (%s) AND rcl.module = '%s' AND bcl.lang_id = %s AND rcl.category_id = %s
				%s %s",
			$cfg->db->prefix,
			$cfg->db->prefix,
			$cfg->db->prefix,
			(!empty($where)) ? $where : "true",
			"article",
			$lg,
			$this->category_id,
			($order !== null) ? "ORDER BY {$order}" : null,
			($limit !== null) ? "LIMIT {$limit}" : null
		));

		if ($source->num_rows > 0) {
			$toReturn = [];

			while ($data = $source->fetch_object()) {
				$data->categories_rel = c8_category::getRelCategories($data->id, "article");
				array_push($toReturn, $data);
			}
			return $toReturn;
		}

		return FALSE;
	}
}
