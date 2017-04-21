<?php

$item_tpl = functions::mdl_load("templates-e/home/item.tpl");

$file = new file();
$files = $file->returnFiles("TRUE");

foreach ($files as $index => $file) {
	if (!isset($list)) {
		$list = "";
	}

	$list .= functions::c2r(
		[
			"id" => $file->id,
			"file" => $file->file,
			"module" => $file->module,
			"id-ass" => $file->id_ass,
			"sort" => $file->sort,
			"date-update" => $file->date_update,
		],
		$item_tpl
	);
}

$mdl = functions::c2r(
	[
		"list" => (isset($list)) ? $list : ""
	],
	functions::mdl_load("templates/home.tpl")
);

functions::importPlg ("files", []);

include "pages/module-core.php";
