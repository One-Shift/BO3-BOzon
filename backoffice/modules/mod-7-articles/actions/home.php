<?php

$line_tpl = bo3::mdl_load("templates-e/home/table-row.tpl");
$option_item_tpl = bo3::mdl_load("templates-e/home/option-item.tpl");

$articles = new article();
$articles->setLangId($lg);

if(isset($_POST["filterCategory"]) && !empty($_POST["categoryId"]) && $_POST["categoryId"] != "-1") {
	$articles->setCategoryId($_POST["categoryId"]);
	$articles = $articles->returnArticlesByCategory("bcl.lang_id = {$lg}", "bc.date ASC, bcl.title ASC", null);
} else {
	$articles = $articles->returnAllArticles();
}


$category = new category();
$category->setLangId($lg);

foreach ($articles as $article) {
	if (!isset($table_items)) {
		$table_items = "";
	}

	$category->setId($article->category_id);
	$this_category = $category->returnOneCategory();

	$table_items .= bo3::c2r([
		"id" => $article->id,
		"title" => strip_tags($article->title),
		"category" => ($this_category != FALSE) ? $this_category->title : "--",
		"published" => ($article->published) ? "fa-toggle-on" : "fa-toggle-off",
		"date-created" => date('Y-m-d', strtotime($article->date)),
		"date-updated-label" => $mdl_lang["label"]["date-updated"],
		"date-updated" => $article->date_update,
		"but-view" => $mdl_lang["label"]["but-view"],
		"but-edit" => $mdl_lang["label"]["but-edit"],
		"but-delete" => $mdl_lang["label"]["but-delete"],
	], $line_tpl);
}

/*------------------------------------------*/
function recursiveWayGet($id, $i = 0, &$data = []) {
	global $lg;
	$a = new category();
	$a->setLangId($lg);
	$a->setParentId($id);
	$a = $a->returnChildCategories();

	foreach ($a as $item) {
		$tmp = [];
		$tmp["id"] = $item->id;
		$tmp["title"] = $item->title;
		$tmp["level"] = $i;

		$data[] = $tmp;

		if ($item->nr_sub_cats > 0 ){
			recursiveWayGet($item->id, $i+1, $data);
		}
	}
}

recursiveWayGet(-1, 0, $data);

if(!empty($data)) {
	foreach ($data as $item) {
		if (!isset($categories_list)) {
			$categories_list = "";
		}

		$categories_list .= bo3::c2r([
			"option-id" => $item["id"],
			"option" => sprintf("%s> %s", str_repeat("-", $item["level"]), $item["title"]),
			"selected" => isset($_POST["categoryId"]) && $_POST["categoryId"] == $item["id"] ? "selected" : ""
		], $option_item_tpl);
	}
}
/*------------------------------------------*/

$mdl = bo3::c2r([
	"label-add-category" => $mdl_lang["label"]["add-category"],
	"category-filter-select" => $mdl_lang["label"]["category-filter-select"],
	"filter-options" => $categories_list,
	"name" => $mdl_lang["label"]["name"],
	"category" => $mdl_lang["label"]["category"],
	"section" => $mdl_lang["label"]["type"],
	"parent-nr" => $mdl_lang["label"]["parent-nr"],
	"published" => $mdl_lang["label"]["published"],
	"date" => $mdl_lang["label"]["date"],
	"table-body" => (isset($table_items)) ? $table_items : "",
], bo3::mdl_load("templates/home.tpl"));

include "pages/module-core.php";
