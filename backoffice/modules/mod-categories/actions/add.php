<?php

if (!isset($_POST["save"])) {

	$nav_tpl = functions::mdl_load("templates-e/add/nav-tab-item.tpl");
	$nav_content_tpl = functions::mdl_load("templates-e/add/tab-content-item-input.tpl");
	$option_item_tpl = functions::mdl_load("templates-e/add/option-item.tpl");
	$tabs = null;
	$nav_content = null;

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
					"{c2r-place-holder-text}"
				],
				[
					($i == 0 ? "active" : null),
					$index,
					$mdl_lang["label"]["name"],
					$mdl_lang["label"]["description"],
					"",
					""
				],
				$nav_content_tpl
			);
			$i++;
		}
	}

	/*------------------------------------------*/

	function recursiveWayGet($id, $i = 0, &$data = []) {
		$a = new category();
		$a->setLangId(1);
		$a->setParentId($id);
		$a = $a->returnSubCategoriesFromOneCategory();

		foreach ($a as $item) {
			$tmp = [];
			$tmp["id"] = $item->id;
			$tmp["title"] = $item->title;
			$tmp["level"] = $i;

			$data[] = $tmp;

			if($item->nr_sub_cats > 0 ){
				recursiveWayGet($item->id, $i+1, $data);
			}
		}
	}

	recursiveWayGet(-1, 0, $data);

	if(!empty($data)) {
		foreach ($data as $item) {
			if (!isset($parent_options)) {
				$parent_options = "";
			}

			$parent_options .= str_replace(
				[
					"{c2r-option-id}",
					"{c2r-option}"
				],
				[
					$item["id"],
					sprintf("%s> %s", str_repeat("-", $item["level"]), $item["title"])
				],
				$option_item_tpl
			);
		}
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
					"{c2r-parent}",
					"{c2r-select-option-parent}",
					"{c2r-select-option-parent-no}",
					"{c2r-parent-options}",
					"{c2r-date}",
					"{c2r-date-placeholder}",
					"{c2r-date-value}",
					"{c2r-code}",
					"{c2r-code-placeholder}",
					"{c2r-sort}",
					"{c2r-sort-placeholder}",
					"{c2r-published}",
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
						functions::mdl_load("templates-e/add/tabs.tpl")
					),
					$mdl_lang["label"]["type"],
					$mdl_lang["form"]["option-type"],
					$category_type_options,
					$mdl_lang["label"]["parent"],
					$mdl_lang["form"]["option-parent"],
					$mdl_lang["form"]["option-parent-no"],
					(isset($parent_options)) ? $parent_options : "",
					$mdl_lang["label"]["date"],
					$mdl_lang["form"]["date-placeholder"],
					date("Y-m-d H:i:s"),
					$mdl_lang["label"]["code"],
					$mdl_lang["label"]["code-placeholder"],
					$mdl_lang["label"]["sort"],
					$mdl_lang["label"]["sort-placeholder"],
					$mdl_lang["label"]["published"],
					$mdl_lang["label"]["but-submit"]
				],
				functions::mdl_load("templates-e/add/form.tpl")
			)
		],
		functions::mdl_load("templates/add.tpl")
	);

} else {
	$category = new category();

	$category->setContent($_POST["name"], $_POST["description"]);
	$category->setCategorySection($_POST["category-type"]);
	$category->setParentId($_POST["category-parent"]);
	$category->setCode($_POST["code"]);
	$category->setDate($_POST["date"]);
	$category->setDateUpdate();
	$category->setSort($_POST["sort"]);
	$category->setPublished(isset($_POST["published"]) ? $_POST["published"] : 0);
	$category->setUserId($authData["id"]);

	$textToPrint = "";

	if ($category->insert()) {
		$textToPrint = $mdl_lang["add"]["success"];

		$obj = $category->returnObject();

		$file = new file();
		$file->fallback($obj->id, $_POST["files-fallback"]);
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
		functions::mdl_load("templates/add.tpl")
	);

}

functions::importPlg ("files", ["module" => "category"]);

include "pages/module-core.php";
