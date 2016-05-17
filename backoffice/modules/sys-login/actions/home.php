<?php

$page_tpl = file_get_contents(sprintf("modules/%s/templates/home.html", $cfg->mod->folder));

$form = str_replace(
	[],
	[],
	file_get_contents(sprintf("modules/%s/templates-e/form.html", $cfg->mod->folder))
);
if (isset($_POST["submit"])) { var_dump($_POST);
	if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
		if (!empty($_POST["password"])) {
			print 1;

			$_POST["password"] = user::getSecurePassword($_POST["password"]);

			$query = sprintf(
				"SELECT id, password FROM %s_users WHERE email = '%s' AND password = '%s' AND status = '%s' AND rank != '%s' LIMIT %s",
				$cfg->db->prefix, $_POST["email"], $_POST["password"], TRUE, "member", 1
			);

			$source = $mysqli->query($query);

			if ($source->num_rows > 0) {
				$data = $source->fetch_assoc();

				if (setcookie($cfg->system->cookie, ($data["id"].".".$data["password"]), time() + ($cfg->system->cookie_time * 60), "/", $_SERVER['REQUEST_URI'])) {
					//header("Location: ".$cfg->system->path_bo."/0/$lg_s/example/");

					// SUCCESS MESSAGE
					$form = str_replace(
						[
							"{c2r-return-message}"
						],
						[
							str_replace(
							[
								"{c2r-message}"
							],
							[
								"COOL!"
							],
							file_get_contents(sprintf("modules/%s/templates-e/return-message.html", $cfg->mod->folder))
							)
						],
						$form
					);
				} else {
					// ERROR MESSAGE
					$form = str_replace(
						[
							"{c2r-return-message}"
						],
						[
							str_replace(
							[
								"{c2r-message}"
							],
							[
								"Message HERE"
							],
							file_get_contents(sprintf("modules/%s/templates-e/return-message.html", $cfg->mod->folder))
							)
						],
						$form
					);
				}
			}
		} else {
			// ERROR MESSAGE
			$form = str_replace(
				[
					"{c2r-return-message}"
				],
				[
					str_replace(
					[
						"{c2r-message}"
					],
					[
						"Message HERE"
					],
					file_get_contents(sprintf("modules/%s/templates-e/return-message.html", $cfg->mod->folder))
					)
				],
				$form
			);
		}
	} else {
		// ERROR MESSAGE
		$form = str_replace(
			[
				"{c2r-return-message}"
			],
			[
				str_replace(
				[
					"{c2r-message}"
				],
				[
					"Message HERE"
				],
				file_get_contents(sprintf("modules/%s/templates-e/return-message.html", $cfg->mod->folder))
				)
			],
			$form
		);
	}
} else {
	$form = str_replace("{c2r-return-message}", null, $form);
}

/* last thing */
$tpl = str_replace(
	[
		"{c2r-mod-path}",
		"{c2r-form}",
		"{c2r-background}"
	],
	[
		$cfg->mod->path,
		$form,
		file_get_contents("http://api.nexus-pt.eu/bo2-image-server/")
	],
	$page_tpl
);
