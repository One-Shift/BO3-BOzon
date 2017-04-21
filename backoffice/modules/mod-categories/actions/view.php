<?php

$cat_obj = new category();
$cat_obj->setLangId($lg);
$cat_obj->setParentId($id);
$categories = $cat_obj->returnSubCategoriesFromOneCategory();

$table_items = null;

foreach ($categories as $category) {
    $table_items .= str_replace(
        [
            "{c2r-id}",
            "{c2r-title}",
            "{c2r-category-section}",
            "{c2r-parent-nr}",
            "{c2r-published}",
            "{c2r-date-created}",
            "{c2r-date-updated-label}",
            "{c2r-date-updated}",
            "{c2r-but-view}",
            "{c2r-hide-but}",
			"{c2r-show-but}",
            "{c2r-but-edit}",
			"{c2r-but-delete}"
        ],
        [
            $category->id,
            $category->title,
            $category->category_section,
            $category->nr_sub_cats,
            $category->published,
            $category->date,
            $mdl_lang["label"]["date-updated"],
            $category->date_update,
            $mdl_lang["label"]["but-view"],
            $category->nr_sub_cats > 0 ? null : " hidden",
            $category->nr_sub_cats == 0 ? null : " hidden",
            $mdl_lang["label"]["but-edit"],
            $mdl_lang["label"]["but-delete"]
        ],
        functions::mdl_load("templates-e/view/table-row.tpl")
    );

}


$mdl = str_replace(
    [
        "{c2r-label-add-category}",
        "{c2r-name}",
        "{c2r-section}",
        "{c2r-parent-nr}",
        "{c2r-published}",
        "{c2r-date}",
        "{c2r-table-body}"
    ],
    [
        $mdl_lang["label"]["add-category"],
        $mdl_lang["label"]["name"],
        $mdl_lang["label"]["type"],
        $mdl_lang["label"]["parent-nr"],
        $mdl_lang["label"]["published"],
        $mdl_lang["label"]["date"],
        $table_items
    ],
    functions::mdl_load("templates/home.tpl")
);

include "pages/module-core.php";
