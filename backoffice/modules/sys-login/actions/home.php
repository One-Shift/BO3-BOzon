<?php

$page_tpl = file_get_contents(sprintf("modules/%s/templates/home.tpl", $cfg->mdl->folder));

$form = str_replace(
	[
		"1"
	],
	[
		"2"
	],
	file_get_contents(sprintf("modules/%s/templates-e/form.tpl", $cfg->mdl->folder))
);

if (isset($_POST["submit"])) {
	if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
		if (!empty($_POST["password"])) {

			$_POST["password"] = user::getSecurePassword($_POST["password"]);

			$query = sprintf(
				"SELECT id, password FROM %s_users WHERE email = '%s' AND password = '%s' AND status = '%s' AND rank != '%s' LIMIT %s",
				$cfg->db->prefix, $_POST["email"], $_POST["password"], TRUE, "member", 1
			);

			$source = $mysqli->query($query);

			if ($source->num_rows > 0) {
				$data = $source->fetch_assoc();
print  $_SERVER["HTTP_HOST"];
				if (
					setcookie(
						$cfg->system->cookie,
						($data["id"].".".$data["password"]),
						time() + ($cfg->system->cookie_time * 60),
						(!empty($cfg->system->path)) ? $cfg->system->path : "/"
					)
				) {
					header("Location: ".$cfg->system->path_bo."/0/$lg_s/home/");
				} else {
					// ERROR MESSAGE
					$form = str_replace(
						"{c2r-return-message}",
						str_replace(
							"{c2r-message}",
							"Message HERE",
							file_get_contents(sprintf("modules/%s/templates-e/return-message.tpl", $cfg->mdl->folder))
						),
						$form
					);
				}
			} else {
				// ERROR MESSAGE
				$form = str_replace(
					"{c2r-return-message}",
					str_replace(
						"{c2r-message}",
						"Message HERE",
						file_get_contents(sprintf("modules/%s/templates-e/return-message.tpl", $cfg->mdl->folder))
					),
					$form
				);
			}
		} else {
			// ERROR MESSAGE
			$form = str_replace(
				"{c2r-return-message}",
				str_replace(
					"{c2r-message}",
					"Message HERE",
					file_get_contents(sprintf("modules/%s/templates-e/return-message.tpl", $cfg->mdl->folder))
				),
				$form
			);
		}
	} else {
		// ERROR MESSAGE
		$form = str_replace(
			"{c2r-return-message}",
			str_replace(
				"{c2r-message}",
				"Message HERE",
				file_get_contents(sprintf("modules/%s/templates-e/return-message.tpl", $cfg->mdl->folder))
			),
			$form
		);
	}
}
$form = str_replace("{c2r-return-message}", null, $form);

/* last thing */
$tpl = str_replace(
	[
		"{c2r-mod-path}",
		"{c2r-form}",
		"{c2r-background}",

		"{c2r-lg-cookies-alert}",
		"{c2r-lg-cookies-title}",
		"{c2r-lg-cookies-modal}",

		"{c2r-lg-message}",
	],
	[
		$cfg->mdl->path,
		$form,
		file_get_contents("http://api.nexus-pt.eu/bo2-image-server/"),

		$mdl_lang["cookie"]["alert"],
		$mdl_lang["cookie"]["title"],
		$mdl_lang["cookie"]["modal"],

		$mdl_lang["message"],
	],
	$page_tpl
);
