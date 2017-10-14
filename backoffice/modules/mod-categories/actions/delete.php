<?php

	if(isset($id) && !empty($id)) {

		// Return all category info
		$category_obj = new category();
		$category_obj->setId($id);
		$category_result = $category_obj->returnNrChildsCategory();
		$textToPrint = null;
		
		if (isset($_POST["submit"])) {
			if($category_result->nr_sub_cats == 0) {
				if($category_obj->delete()) {
					$textToPrint = $mdl_lang["delete"]["success"];
				} else {
					$textToPrint =  $mdl_lang["delete"]["failure"];
				}
			} else {
				$textToPrint = $mdl_lang["delete"]["failure-2"];
			}
		} else {
			$category_obj->setLangId($lg);
			$category_info = $category_obj->returnOneCategory();

			$textToPrint = bo3::c2r(
				[
					"id" => $id,

					"phrase" => $mdl_lang["delete"]["phrase"],
					"title" => $category_info->title,

					"del" => $mdl_lang["delete"]["button-del"],
					"cancel" => $mdl_lang["delete"]["button-cancel"]
				],
				bo3::mdl_load("templates-e/del/form.tpl")
			);
		}

		$mdl = bo3::c2r(["content" => $textToPrint], bo3::mdl_load("templates/del.tpl"));

	} else {
		// if doesn't exist an action response, system sent you to 404
		header("Location: {$cfg->system->path_bo}/0/{$lg_s}/404/");
	}

include "pages/module-core.php";
