<?php

$file = new file();
$file->setId($id);

if (!isset($_POST["submit"])) {
	$select_option = bo3::mdl_load("templates-e/edit/select-option.tpl");

	$modules = file::returnModules();
	$file = $file->returnOneFile();

	foreach ($modules as $i => $module) {
		if (!isset($modules_list)) {
			$modules_list = "";
		}

		$modules_list .= bo3::c2r([
			"value" => $module,
			"selected" => ($file->module == $module) ? "SELECTED" : ""
		], $select_option);
	}

	$mdl = bo3::c2r([
		"id" => $file->id,
		"file" => $file->file,
		"type" => $file->type,
		"module" => $file->module,
		"id-ass" => $file->id_ass,
		"description" => $file->description,
		"code" => $file->code,
		"sort" => $file->sort,
		"date" => $file->date,
		"modules-list" => (isset($modules_list)) ? $modules_list : ""
	], bo3::mdl_load("templates-e/edit/form.tpl"));
} else {
	$file->setDescription($_POST["inputDescription"]);
	$file->setCode($_POST["inputCode"]);
	$file->setModule($_POST["inputModule"]);
	$file->setIdAss((int)$_POST["inputIdAss"]);
	$file->setSort((int)$_POST["inputSort"]);
	$file->setDescription($_POST["inputDescription"]);

	$file->setDate($_POST["inputDate"]);
	$file->setDateUpdate();

	if ($file->normalUpdate() && $file->simpleUpdate()) {
		$mdl = $mdl_lang["edit-success"];
	} else {
		$mdl = $mdl_lang["edit-failure"];
	}
}

include "pages/module-core.php";
