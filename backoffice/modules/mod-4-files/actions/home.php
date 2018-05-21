<?php

$item_tpl = bo3::mdl_load("templates-e/home/item.tpl");

$file = new file();
$files = $file->returnFiles("TRUE");

if(!empty($files)) {
	if(count($files) > 1) {
		foreach ($files as $index => $file) {
			if (!isset($list)) {
				$list = "";
			}

			$list .= bo3::c2r([
				"id" => $file->id,
				"file" => $file->file,
				"module" => $file->module,
				"id-ass" => $file->id_ass,
				"sort" => $file->sort,
				"date-update" => $file->date_update,
			], $item_tpl);
		}
	} else {
		$list = bo3::c2r([
			"id" => $files->id,
			"file" => $files->file,
			"module" => $files->module,
			"id-ass" => $files->id_ass,
			"sort" => $files->sort,
			"date-update" => $files->date_update,
		], $item_tpl);
	}
}

$mdl = bo3::c2r([
	"list" => (isset($list)) ? $list : ""
], bo3::mdl_load("templates/home.tpl"));

bo3::importPlg ("files", []);

include "pages/module-core.php";
