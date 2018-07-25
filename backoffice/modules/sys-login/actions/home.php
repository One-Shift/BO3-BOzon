<?php

$page_tpl = bo3::mdl_load("templates/home.tpl");

$form = bo3::c2r([
	"lg-email" => $mdl_lang["labels"]["email"],
	"lg-password" => $mdl_lang["labels"]["password"]
], bo3::mdl_load("templates-e/form.tpl"));

if (isset($_POST["submit"])) {
	if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
		if (!empty($_POST["password"])) {

			$_POST["password"] = user::getSecurePassword($_POST["password"]);

			$query = sprintf(
				"SELECT id, password FROM %s_users WHERE email = '%s' AND password = '%s' AND status = '%s' AND rank != '%s' LIMIT %s",
				$cfg->db->prefix, $db->real_escape_string($_POST["email"]), $db->real_escape_string($_POST["password"]), TRUE, "member", 1
			);

			$source = $db->query($query);

			if ($source->num_rows > 0) {
				$data = $source->fetch_object();

				if (setcookie($cfg->system->cookie, "{$data->id}.{$data->password}", time() + ($cfg->system->cookie_time * 60), (!empty($cfg->system->path)) ? $cfg->system->path : "/")) {
					header("Location: {$cfg->system->path_bo}/{$lg_s}/5-home/");
				} else {
					// ERROR MESSAGE
					$form = bo3::c2r([
						"return-message" => bo3::mdl_load("templates-e/return-message.tpl"),
						"message" => $mdl_lang["return"]["failure-cookie"]
					], $form);
				}
			} else {
				// ERROR MESSAGE
				$form = bo3::c2r([
					"return-message" => bo3::mdl_load("templates-e/return-message.tpl"),
					"message" => $mdl_lang["return"]["failure-nomatch"]
				], $form);
			}
		} else {
			// ERROR MESSAGE
			$form = bo3::c2r([
				"return-message" => bo3::mdl_load("templates-e/return-message.tpl"),
				"message" => $mdl_lang["return"]["failure-nopassword"]
			], $form);
		}
	} else {
		// ERROR MESSAGE
		$form = bo3::c2r([
			"return-message" => bo3::mdl_load("templates-e/return-message.tpl"),
			"message" => $mdl_lang["return"]["failure-email"]
		], $form);
	}
}

$form = bo3::c2r(["return-message" => ""], $form);

/* last thing */
$tpl = bo3::c2r([
	"mod-path" => $cfg->mdl->path,
	"form" => $form,

	"lg-cookies-alert" => $mdl_lang["cookie"]["alert"],
	"lg-cookies-title" => $mdl_lang["cookie"]["title"],
	"lg-cookies-modal" => $mdl_lang["cookie"]["modal"],
	"lg-message" => $mdl_lang["message"]
], $page_tpl);
