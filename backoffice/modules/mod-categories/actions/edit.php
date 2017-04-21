<?php

if (!isset($_POST["save"])) {
	if (isset($id) && !empty($id)) {

		$nav_tpl = functions::mdl_load("templates-e/edit/nav-tab-item.tpl");
		$nav_content_tpl = functions::mdl_load("templates-e/edit/tab-content-item-input.tpl");
		$option_item_tpl = functions::mdl_load("templates-e/edit/option-item.tpl");
		$tabs = null;
		$nav_content = null;

		// Return all category info
		$category_obj = new category();
		$category_obj->setId($id);
		$category_result = $category_obj->returnOneCategoryAllLanguages();

		$i = 0;
		foreach ($cfg->lg as $index => $lg) {
			if ($lg[0]) {

				$tabs .= str_replace(
					[
						"{c2r-class}",
						"{c2r-nr}",
						"{c2r-lang-name}"
					],
					[
						($i == 0 ? "active" : null),
						$index,
						$lg[2]
					],
					$nav_tpl
				);

				$nav_content .= str_replace(
					[
						"{c2r-class}",
						"{c2r-nr}",
						"{c2r-label-name}",
						"{c2r-label-description}",
						"{c2r-place-holder-name}",
						"{c2r-place-holder-text}",
						"{c2r-name-value}",
						"{c2r-description-value}"
					],
					[
						($i == 0 ? "active" : null),
						$index,
						$mdl_lang["label"]["name"],
						$mdl_lang["label"]["description"],
						"",
						"",
						$category_result[$index]->title,
						$category_result[$index]->text

					],
					$nav_content_tpl
				);
				$i++;
			}
		}

		$category = new category();
		$category->setLangId(1);
		$category = $category->returnAllCategories();

		/*------------------------------------------*/

		function recursiveWayGet($id, $i){
			global $parent_options, $option_item_tpl, $category_result;

			$a = new category();
			$a->setLangId(1);
			$a->setParentId($id);
			$a = $a->returnSubCategoriesFromOneCategory();
			$i++;
			foreach ($a as $item) {

				if($item->id != $id) {
					$parent_options .= str_replace(
						[
							"{c2r-option-id}",
							"{c2r-option}",
							"{c2r-selected}"
						],
						[
							$item->id,
							sprintf("%s> %s", str_repeat("-", $i), $item->title),
							$item->id == $category_result[1]->parent_id ? "selected" : ""
						],
						$option_item_tpl
					);
				}


				if($item->nr_sub_cats > 0 ){
					recursiveWayGet($item->id, $i);
				}
			}
		}

		$mainCategories = new category();
		$mainCategories->setLangId(1);
		$allCats = $mainCategories->returnAllMainCategories();

		$parent_options = null;
		foreach ($allCats as $item) {

			if ($item->id != $id) {
				$parent_options .= str_replace(
					[
						"{c2r-option-id}",
						"{c2r-option}",
						"{c2r-selected}"
					],
					[
						$item->id,
						$item->title,
						$item->id == $category_result[1]->parent_id ? "selected" : ""
					],
					$option_item_tpl
				);
			}
			recursiveWayGet($item->id, 0);
		}

		/*------------------------------------------*/

		$category_type_options = null;

		$category_types = new category();
		$category_types = $category_types->returnAllSections();

		foreach ($category_types as $item) {

			$category_type_options .= str_replace(
				[
					"{c2r-option-id}",
					"{c2r-option}"
				],
				[
					$item->category_section,
					""
				],
				$option_item_tpl
			);
		}

		$mdl = str_replace(
			[
				"{c2r-content}"
			],
			[
				str_replace(
					[
						"{c2r-tabs-categories-name-description}",
						"{c2r-type}",
						"{c2r-select-option-type}",
						"{c2r-category-type-options}",
						"{c2r-type-value}",
						"{c2r-parent}",
						"{c2r-select-option-parent}",
						"{c2r-select-option-parent-no}",
						"{c2r-selected}",
						"{c2r-parent-options}",
						"{c2r-date}",
						"{c2r-date-placeholder}",
						"{c2r-date-value}",
						"{c2r-code}",
						"{c2r-code-placeholder}",
						"{c2r-code-value}",
						"{c2r-sort}",
						"{c2r-sort-placeholder}",
						"{c2r-sort-value}",
						"{c2r-published}",
						"{c2r-published-checked}",
						"{c2r-but-submit}"
					],
					[
						str_replace(
							[
								"{c2r-nav-tabs-items}",
								"{c2r-tab-content-items}"
							],
							[
								$tabs,
								$nav_content

							],
							functions::mdl_load("templates-e/edit/tabs.tpl")
						),
						$mdl_lang["label"]["type"],
						$mdl_lang["form"]["option-type"],
						$category_type_options,
						$category_result[1]->category_section,
						$mdl_lang["label"]["parent"],
						$mdl_lang["form"]["option-parent"],
						$mdl_lang["form"]["option-parent-no"],
						$category_result[1]->parent_id == -1 ? "selected" : "",
						$parent_options,
						$mdl_lang["label"]["date"],
						$mdl_lang["form"]["date-placeholder"],
						$category_result[1]->date,
						$mdl_lang["label"]["code"],
						$mdl_lang["label"]["code-placeholder"],
						$category_result[1]->code,
						$mdl_lang["label"]["sort"],
						$mdl_lang["label"]["sort-placeholder"],
						$category_result[1]->sort,
						$mdl_lang["label"]["published"],
						$category_result[1]->published ? "checked" : null,
						$mdl_lang["label"]["but-submit"]

					],
					functions::mdl_load("templates-e/edit/form.tpl")
				)
			],
			functions::mdl_load("templates/add.tpl")
		);
	} else {
		// if doesn't exist an action response, system sent you to 404
		header("Location: {$cfg->system->path_bo}/0/{$lg_s}/404/");
	}
} else {

	$category = new category();

	$category->setId($id);
	$category->setContent($_POST["name"], $_POST["description"]);
	$category->setCategorySection($_POST["category-type"]);
	$category->setParentId($_POST["category-parent"]);
	$category->setCode($_POST["code"]);
	$category->setDate($_POST["date"]);
	$category->setDateUpdate();
	$category->setSort($_POST["sort"]);
	$category->setPublished(isset($_POST["published"]) ? $_POST["published"] : 0);

	$textToPrint = null;
	if ($category->update()) {
		$textToPrint = $mdl_lang["add"]["success"];
	} else {
		$textToPrint = $mdl_lang["add"]["failure"];
	}

	$mdl = str_replace(
		[
			"{c2r-content}"
		],
		[
			$textToPrint
		],
		functions::mdl_load("templates/edit.tpl")
	);
}

functions::importPlg ("files", ["id" => $id, "module" => "category"]);

include "pages/module-core.php";
