<?php

$cat_obj = new category();
$cat_obj->setLangId($lg);
$categories = $cat_obj->returnAllMainCategories();

$table_items = '';

foreach ($categories as $category) {
	$table_items .= bo3::c2r(
		[
			'id' => $category->id,
			'title' => $category->title,
			'category-section' => $category->category_section,
			'parent-nr' => $category->nr_sub_cats,
			'published' => $category->published,
			'date-created' => $category->date,
			'date-updated-label' => $mdl_lang["label"]["date-updated"],
			'date-updated' => $category->date_update,
			'but-view' => $mdl_lang["label"]["but-view"],
			'hide-but' => $category->nr_sub_cats > 0 ? null : " hidden",
			'show-but' => $category->nr_sub_cats == 0 ? null : " hidden",
			'but-edit' => $mdl_lang["label"]["but-edit"],
			'but-delete' => $mdl_lang["label"]["but-delete"]
		],
		bo3::mdl_load("templates-e/home/table-row.tpl")
	);
}

$mdl = bo3::c2r(
	[
		'label-add-category' => $mdl_lang["label"]["add-category"],
		'name' => $mdl_lang["label"]["name"],
		'section' => $mdl_lang["label"]["type"],
		'parent-nr' => $mdl_lang["label"]["parent-nr"],
		'published' => $mdl_lang["label"]["published"],
		'date' => $mdl_lang["label"]["date"],
		'table-body' => $table_items
	],
	bo3::mdl_load("templates/home.tpl")
);

include "pages/module-core.php";
