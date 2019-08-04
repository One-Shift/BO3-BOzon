<?php

$page_tpl = bo3::mdl_load("templates/home.tpl");

if (isset($_POST["input-submit"])) {
	if (filter_var($_POST["input-email"], FILTER_VALIDATE_EMAIL)) {
		if (!empty($_POST["input-password"])) {
			$_POST["input-password"] = c9_user::getSecurePassword($_POST["input-password"]);

			$query = sprintf(
				"SELECT id, password FROM %s_9_users WHERE email = '%s' AND status = '%s' AND rank != '%s' LIMIT %s",
				$cfg->db->prefix, $db->real_escape_string($_POST["input-email"]), TRUE, "member", 1
			);

			$source = $db->query($query);

			if ($source->num_rows > 0) {
				$data = $source->fetch_object();

				if ($data->password == $_POST["input-password"]) {
					if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
						$ip = ["ip" => $_SERVER['HTTP_CLIENT_IP']];
					} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
						$ip = ["ip" => $_SERVER['HTTP_X_FORWARDED_FOR']];
					} else {
						$ip = ["ip" => $_SERVER['REMOTE_ADDR']];
					}

					$ip = json_encode($ip);

					if (
						setcookie($cfg->system->cookie, "{$data->id}.{$data->password}", time() + ($cfg->system->cookie_time * 60), (!empty($cfg->system->path)) ? $cfg->system->path : "/") &&
						$db->query(sprintf(
							"INSERT INTO %s_history (user_id, module, description, date) VALUES ('%s', '%s', '%s', '%s')",
							$cfg->db->prefix, $data->id, "sys-login", $ip, date("Y-m-d H:i:s", time())))
					) {
						header("Location: {$cfg->system->path_bo}/{$lg_s}/5-home/");
					} else {
						// ERROR MESSAGE
						$message = bo3::c2r([
							"return-message" => $mdl_lang["return"]["failure-cookie"],
							"type" => "danger"
						], bo3::mdl_load("templates-e/return-message.tpl"));
					}
				} else {
					// ERROR MESSAGE
					$message = bo3::c2r([
						"return-message" => $mdl_lang["return"]["failure-nomatch"],
						"type" => "danger"
					], bo3::mdl_load("templates-e/return-message.tpl"));
				}
			} else {
				// ERROR MESSAGE
				$message = bo3::c2r([
					"return-message" => $mdl_lang["return"]["failure-nomatch"],
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

	"lg-cookies-alert" => $mdl_lang["cookie"]["alert"],
	"lg-cookies-title" => $mdl_lang["cookie"]["title"],
	"lg-cookies-modal" => $mdl_lang["cookie"]["modal"],
	"lg-message" => $mdl_lang["message"]
], $page_tpl);
