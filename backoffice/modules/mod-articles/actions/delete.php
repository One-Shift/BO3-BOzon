<?php

	if (isset($id) && !empty($id)) {
		// Return all category info
		$article = new article();
		$article->setId($id);
		$toReturn = "";

		if (isset($_POST["submit"])) {
			if ($article->delete()) {
				$toReturn = $mdl_lang["delete"]["success"];
			} else {
				$toReturn =  $mdl_lang["delete"]["failure"];
			}
		} else {
			$article->setLangId($lg);
			$article = $article->returnOneArticle();

			$toReturn = bo3::c2r(
				[
					"id" => $id,

					"phrase" => $mdl_lang["delete"]["phrase"],
					"title" => $article->title,

					"del" => $mdl_lang["delete"]["button-del"],
					"cancel" => $mdl_lang["delete"]["button-cancel"]
				],
				bo3::mdl_load("templates-e/delete/form.tpl")
			);
		}

		$mdl = bo3::c2r(["content" => $toReturn], bo3::mdl_load("templates/del.tpl"));
	} else {
		// if doesn't exist an action response, system sent you to 404
		header("Location: {$cfg->system->path_bo}/0/{$lg_s}/404/");
	}

include "pages/module-core.php";
