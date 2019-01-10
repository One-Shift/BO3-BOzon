<?php

$page_tpl = bo3::mdl_load("templates/register.tpl");

if (isset($_POST["register-input-submit"])) {
	if (filter_var($_POST["input-email"], FILTER_VALIDATE_EMAIL)) {
		if (!empty($_POST["input-password"]) && !empty($_POST["input-repeat-password"]) && ($_POST["input-password"] === $_POST["input-repeat-password"])) {
			if (!empty($_POST["input-name"])) {
				$user = new c9_user();
				$user->setUsername($_POST["input-name"]);
				$user->setEmail($_POST["input-email"]);


				if (!(bool)$user->existUserByEmail()) {
					$user->setPassword($_POST["input-password"]);
					$user->setRank("manager");
					$user->setCode("");
					$user->setStatus(FALSE);
					$user->setUserKey();

					if ($user->insert()) {
						// ERROR MESSAGE
						$message = bo3::c2r([
							"return-message" => $mdl_lang["return"]["success-register"],
							"type" => "success"
						], bo3::mdl_load("templates-e/return-message.tpl"));

						$_POST = [];

					} else {
						// ERROR MESSAGE
						$message = bo3::c2r([
							"return-message" => $mdl_lang["return"]["failure-register"],
							"type" => "danger"
						], bo3::mdl_load("templates-e/return-message.tpl"));
					}
				} else {
					// ERROR MESSAGE
					$message = bo3::c2r([
						"return-message" => $mdl_lang["return"]["failure-emailalreadyexist"],
						"type" => "danger"
					], bo3::mdl_load("templates-e/return-message.tpl"));
				}
			} else {
				// ERROR MESSAGE
				$message = bo3::c2r([
					"return-message" => $mdl_lang["return"]["failure-nousername"],
					"type" => "danger"
				], bo3::mdl_load("templates-e/return-message.tpl"));
			}
		} else {
			// ERROR MESSAGE
			$message = bo3::c2r([
				"return-message" => $mdl_lang["return"]["failure-nopassword"],
				"type" => "danger"
			], bo3::mdl_load("templates-e/return-message.tpl"));
		}
	} else {
		// ERROR MESSAGE
		$message = bo3::c2r([
			"return-message" => $mdl_lang["return"]["failure-email"],
			"type" => "danger"
		], bo3::mdl_load("templates-e/return-message.tpl"));
	}
}

/* last thing */
$tpl = bo3::c2r([
	"mod-path" => $cfg->mdl->path,
	"message" => isset($message) ? $message : bo3::mdl_load("templates-e/spacer-60.tpl"),

	"name" => isset($_POST["input-name"]) ? $_POST["input-name"] : "",
	"email" => isset($_POST["input-email"]) ? $_POST["input-email"] : "",

	"lg-cookies-alert" => $mdl_lang["cookie"]["alert"],
	"lg-cookies-title" => $mdl_lang["cookie"]["title"],
	"lg-cookies-modal" => $mdl_lang["cookie"]["modal"],
	"lg-message" => $mdl_lang["message"]
], $page_tpl);
