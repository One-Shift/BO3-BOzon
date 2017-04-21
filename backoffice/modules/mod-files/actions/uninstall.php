<?php

if (isset($_POST["submitUninstall"]) && user::isOwner($authData)) {
	$db = functions::c2r(
		[
			"mod-folder" => $cfg->mdl->folder,
			"prefix" => $cfg->db->prefix
		],
		functions::mdl_load("db/uninstall.sql")
	);

	if ($mysqli->multi_query($db) != FALSE) {
		while ($mysqli->more_results() && $mysqli->next_result()) {;} // flush multi_queries

		$mdl = functions::c2r(
			[
				"lg-message" => $lang["uninstall"]["success"]
			],
			functions::mdl_load("templates-e/uninstall/message.tpl")
		);
	} else {
		$mdl = functions::c2r(
			[
				"lg-message" => $lang["uninstall"]["failure"]." : ".$mysqli->error
			],
			functions::mdl_load("templates-e/uninstall/message.tpl")
		);
	}
} else {
	$mdl = functions::c2r(
		[
			"lg-message" => $lang["uninstall"]["failure"]
		],
		functions::mdl_load("templates-e/uninstall/message.tpl")
	);
}

include "pages/module-core.php";
