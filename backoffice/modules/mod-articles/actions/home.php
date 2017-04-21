<?php

$line_tpl = functions::mdl_load("templates-e/home/table-row.tpl");

$articles = new article();
$articles->setLangId($lg);
$articles = $articles->returnAllArticles();

$category = new category();
$category->setLangId($lg);

foreach ($articles as $article) {
	if (!isset($table_items)) {
		$table_items = "";
	}

	$category->setId($article->category_id);
	$this_category = $category->returnOneCategory();

	$table_items .= functions::c2r(
		[
			"id" => $article->id,
			"title" => $article->title,
			"category" => ($this_category != FALSE) ? $this_category->title : "--",
			"published" => ($article->published) ? "fa-toggle-on" : "fa-toggle-off",
			"date-created" => $article->date,
			"date-updated-label" => $mdl_lang["label"]["date-updated"],
			"date-updated" => $article->date_update,
			"but-view" => $mdl_lang["label"]["but-view"],
			"but-edit" => $mdl_lang["label"]["but-edit"],
			"but-delete" => $mdl_lang["label"]["but-delete"],
		],
		$line_tpl
	);
}

$mdl = functions::c2r(
	[
		"label-add-category" => $mdl_lang["label"]["add-category"],
		"name" => $mdl_lang["label"]["name"],
		"category" => $mdl_lang["label"]["category"],
		"section" => $mdl_lang["label"]["type"],
		"parent-nr" => $mdl_lang["label"]["parent-nr"],
		"published" => $mdl_lang["label"]["published"],
		"date" => $mdl_lang["label"]["date"],
		"table-body" => (isset($table_items)) ? $table_items : "",
	],
	functions::mdl_load("templates/home.tpl")
);

include "pages/module-core.php";
