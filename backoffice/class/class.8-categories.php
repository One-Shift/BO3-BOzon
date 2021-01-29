<?php

/**
 * c8_category Class
 * Class used to deal with categories information that is storaged in DB
 * It's used in the BO for categories management
 * Can also be used to deal with categories information for front-end purposes.
 *
 * @author 	Carlos Santos
 * @version 1.0
 * @since 2016-10
 * @license The MIT License (MIT)
 */

class c8_category
{
	protected $id;
	/** @var int **/
	protected $parent_id;
	/** @var int **/
	protected $lang_id;
	/** @var int **/
	protected $title_arr = [];
	/** @var array **/
	protected $description_arr = [];
	/** @var array **/
	protected $category_section;
	/** @var string **/
	protected $date;
	/** @var DateTime **/
	protected $date_update;
	/** @var DateTime **/
	protected $user_id;
	/** @var int **/
	protected $code;
	/** @var string **/
	protected $sort;
	/** @var int **/
	protected $published = false;
	/** @var boolean **/

	public function __construct()
	{
	}

	/** @param int **/
	public function setId($i)
	{
		$this->id = $i;
	}

	/** @param int **/
	public function setParentId($pi)
	{
		$this->parent_id = $pi;
	}

	/** @param string **/
	public function setLangId($li)
	{
		$this->lang_id = $li;
	}

	/** @param string **/
	public function setContent($t, $c, $mk, $md)
	{
		$this->title_arr = $t;
		$this->content_arr = $c;
		$this->meta_keywords = $mk;
		$this->meta_description = $md;
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

	/** @param string **/
	public function setCategorySection($s)
	{
		$this->category_section = $s;
	}

	/** @param boolean **/
	public function setPublished($p)
	{
		$this->published = $p;
	}

	/** @param int **/
	public function setSort($s)
	{
		$this->sort = $s;
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

	/** [Insert new category in DB] @return boolean */
	public function insert()
	{
		global $cfg, $db, $authData;

		if ($db->query(sprintf(
			"INSERT INTO %s_8_categories (parent_id, category_section, code, sort, user_id, date, date_update, published) VALUES (%d, '%s', '%s', %d, %d, '%s', '%s', %d)",
			$cfg->db->prefix,
			$this->parent_id,
			$this->category_section,
			$this->code,
			$this->sort,
			$authData->id,
			$this->date,
			$this->date_update,
			$this->published
		))) {
			$this->id = $db->insert_id;

			foreach ($this->title_arr as $i => $item) {
				if ($db->query(sprintf(
					"INSERT INTO %s_8_categories_lang (category_id, lang_id, title, text, `meta-keywords`, `meta-description`) VALUES (%d, '%s', '%s', '%s', '%s', '%s')",
					$cfg->db->prefix,
					$this->id,
					$cfg->lg[$i + 1][1],
					$db->real_escape_string($this->title_arr[$i]),
					$db->real_escape_string($this->content_arr[$i]),
					$db->real_escape_string($this->meta_keywords[$i]),
					$db->real_escape_string($this->meta_description[$i])
				))) {
					if ($i == count($this->title_arr) - 1) {
						return TRUE;
					} else {
						continue;
					}
				} else {
					return FALSE;
					break;
				}
			}
		}

		return FALSE;
	}

	/** [Update information of a category by given ID] @return boolean */
	public function update()
	{
		global $cfg, $db, $authData;

		if ($db->query(sprintf(
			"UPDATE %s_8_categories SET parent_id = %d, category_section = '%s', code = '%s', sort = %d, date = '%s', date_update = '%s', user_id = %d, published = %d WHERE id = %d",
			$cfg->db->prefix,
			$this->parent_id,
			$this->category_section,
			$this->code,
			$this->sort,
			$this->date,
			$this->date_update,
			$authData->id,
			$this->published,
			$this->id
		))) {
			foreach ($cfg->lg as $index => $lg) {
				if ($lg[0]) {
					if ($db->query(sprintf(
						"UPDATE %s_8_categories_lang SET title = '%s', text = '%s', `meta-keywords` = '%s', `meta-description` = '%s' WHERE category_id = '%s' AND lang_id = '%s'",
						$cfg->db->prefix,
						$db->real_escape_string($this->title_arr[$index - 1]),
						$db->real_escape_string($this->content_arr[$index - 1]),
						$db->real_escape_string($this->meta_keywords[$index - 1]),
						$db->real_escape_string($this->meta_description[$index - 1]),
						$this->id,
						$index
					))) {
						continue;
					} else {
						return FALSE;
						break;
					}
				}
			}

			return TRUE;
		}

		return FALSE;
	}

	/** [Delete category by given ID] @return boolean */
	public function delete()
	{
		global $cfg, $db, $authData;

		$category = new c8_category();
		$category->setId($this->id);
		$category_obj = $category->returnOneCategoryAllLanguages();

		$category_rel = $category->returnCategoryRel();

		if (is_array($category_rel) && count($category_rel) > 0) {
			foreach ($category_obj as $o => $obj) {
				$obj->category_rel = $category_rel;
			}
		}

		$trash = new trash(json_encode($category_obj), null, $cfg->mdl->folder, $authData->id);

		if ($trash->insert()) {
			if ($db->query(sprintf(
				"DELETE c, cl
				FROM %s_8_categories c
					INNER JOIN %s_8_categories_lang cl on cl.category_id = c.id
				WHERE c.id = %s",
				$cfg->db->prefix,
				$cfg->db->prefix,
				$this->id
			))) {
				if (count($category_rel) > 0 && is_array($category_rel)) {
					if ($db->query(sprintf(
						"DELETE FROM %s_8_categories_rel WHERE category_id = %s",
						$cfg->db->prefix,
						$this->id
					))) {
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

	/** [Return one category by given ID] @return boolean OR @return object */
	public function returnOneCategory()
	{
		global $cfg, $db;

		$source = $db->query(sprintf(
			"SELECT bc.*, bcl.title, bcl.text, bcl.`meta-keywords`, bcl.`meta-description`
				FROM %s_8_categories bc
					INNER JOIN %s_8_categories_lang AS bcl on bcl.category_id = bc.id
				WHERE bc.id = %s and bcl.lang_id = '%s'",
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

	/** [Return one category languages content by given ID] @return array */
	public function returnOneCategoryAllLanguages()
	{
		global $cfg, $db;

		$toReturn = [];

		$source = $db->query(sprintf(
			"SELECT bc.*, bcl.title, bcl.text, bcl.`meta-keywords`, bcl.`meta-description`, bcl.lang_id
				FROM %s_8_categories bc
					INNER JOIN %s_8_categories_lang AS bcl on bcl.category_id = bc.id
				WHERE bc.id = %s",
			$cfg->db->prefix,
			$cfg->db->prefix,
			$this->id
		));

		if ($source->num_rows > 0) {
			while ($data = $source->fetch_object()) {
				// Push to index lang_id, the result of that row
				$toReturn[$data->lang_id] = $data;
			}
		}

		return $toReturn;
	}

	/** [Return one the number of child categories by parent_id given of the main category] @return object */
	public function returnNrChildsCategory()
	{
		global $cfg, $db;

		$source = $db->query(sprintf(
			"SELECT COUNT(id) as 'nr_sub_cats' FROM %s_8_categories WHERE parent_id = '%s'",
			$cfg->db->prefix,
			$this->id
		));

		return $source->fetch_object();
	}


	/** [Return all categories where parent_id = -1] @return array */
	public function returnAllMainCategories()
	{
		global $cfg, $db;

		$toReturn = [];

		$source = $db->query(sprintf(
			"SELECT bc.*, bcl.title, bcl.text, bcl.`meta-keywords`, bcl.`meta-description`, (SELECT COUNT(id) FROM %s_8_categories WHERE parent_id = bc.id) AS 'nr_sub_cats'
				FROM %s_8_categories bc
					INNER JOIN %s_8_categories_lang AS bcl on bcl.category_id = bc.id
				WHERE bc.parent_id = -1 AND bcl.lang_id = '%s'
				ORDER BY bc.sort ASC, bc.category_section ASC, bcl.title ASC",
			$cfg->db->prefix,
			$cfg->db->prefix,
			$cfg->db->prefix,
			$this->lang_id
		));

		if ($source->num_rows > 0) {
			while ($data = $source->fetch_object()) {
				array_push($toReturn, $data);
			}
		}

		return $toReturn;
	}

	/** [Return all child categories by given parent_id] @return array */
	public function returnChildCategories()
	{
		global $cfg, $db;

		$toReturn = [];

		$source = $db->query(sprintf(
			"SELECT bc.*, bcl.title, bcl.text, bcl.`meta-keywords`, bcl.`meta-description`, (SELECT COUNT(id) FROM %s_8_categories WHERE parent_id = bc.id) AS 'nr_sub_cats'
				FROM %s_8_categories bc
					INNER JOIN %s_8_categories_lang AS bcl on bcl.category_id = bc.id
				WHERE bc.parent_id = %s AND bcl.lang_id = '%s'
				ORDER BY bc.sort ASC, bc.category_section ASC, bcl.title ASC",
			$cfg->db->prefix,
			$cfg->db->prefix,
			$cfg->db->prefix,
			$this->parent_id,
			$this->lang_id
		));

		if ($source->num_rows > 0) {
			while ($data = $source->fetch_object()) {
				array_push($toReturn, $data);
			}
		}

		return $toReturn;
	}

	/** [Return all categories by given lang_id] @return array */
	public function returnAllCategories()
	{
		global $cfg, $db;

		$toReturn = [];

		$source = $db->query(sprintf(
			"SELECT bcl.title, bc.id
				FROM %s_8_categories bc
					INNER JOIN %s_8_categories_lang AS bcl on bcl.category_id = bc.id
				WHERE bcl.lang_id = '%s'
				ORDER BY bc.sort ASC, bc.category_section ASC, bcl.title ASC",
			$cfg->db->prefix,
			$cfg->db->prefix,
			$this->lang_id
		));

		if ($source->num_rows > 0) {
			while ($data = $source->fetch_object()) {
				array_push($toReturn, $data);
			}
		}

		return $toReturn;
	}

	/** [Check if there is a relation and how many] @return int or @return boolean */
	public static function checkRel($id = null)
	{
		global $cfg, $db;

		if (!is_null($id) && $id != 0) {

			$source = $db->query(sprintf(
				"SELECT * FROM %s_8_categories_rel WHERE category_id = '%s'",
				$cfg->db->prefix,
				$id
			));

			return $source->num_rows;
		}

		return FALSE;
	}

	/** [Return all relations to a category by given category_id] @return array */
	public function returnCategoryRel()
	{
		global $cfg, $db;

		$toReturn = [];

		$source = $db->query(sprintf(
			"SELECT * FROM %s_8_categories_rel WHERE category_id = %s",
			$cfg->db->prefix,
			$this->id
		));

		if ($source->num_rows > 0) {
			while ($data = $source->fetch_object()) {
				array_push($toReturn, $data);
			}
		}

		return $toReturn;
	}

	/** [Return all sections] @return array */
	public function returnAllSections()
	{
		global $cfg, $db;

		$toReturn = [];

		$source = $db->query(sprintf(
			"SELECT distinct category_section
				FROM %s_8_categories
				ORDER BY category_section ASC",
			$cfg->db->prefix
		));

		if ($source->num_rows > 0) {
			while ($data = $source->fetch_object()) {
				array_push($toReturn, $data);
			}
		}

		return $toReturn;
	}

	/** [Return all related categories by given object_id and defining OR not, what module is being used] @return array */
	public static function getRelCategories($object_id = null, $module = null)
	{
		global $cfg, $db;

		$toReturn = [];

		if (!is_null($object_id)) {
			$source = $db->query(sprintf(
				"SELECT * FROM %s_8_categories_rel WHERE object_id = %d %s",
				$cfg->db->prefix,
				$object_id,
				!is_null($module) ? "AND module = '{$module}'" : ""
			));

			if ($source->num_rows > 0) {
				while ($data = $source->fetch_object()) {
					array_push($toReturn, $data->id);
				}
			}
		}

		return $toReturn;
	}
}
