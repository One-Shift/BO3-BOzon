<?php

if (isset($_POST["submitInstall"]) && user::isOwner($authData)) {
    $db = functions::c2r(
		[
			"mod-name" => $cfg->mdl->name,
			"mod-folder" => $cfg->mdl->folder,
			"prefix" => $cfg->db->prefix,
		],
		functions::mdl_load("db/install.sql")
	);

	if ($mysqli->multi_query($db) != FALSE) {
		while ($mysqli->more_results() && $mysqli->next_result()) {;} // flush multi_queries

		$mdl = functions::c2r(
			[
				"lg-message" => $lang["install"]["success"]
			],
			functions::mdl_load("templates-e/install/message.tpl")
		);
	} else {
		$mdl = functions::c2r(
			[
				"lg-message" => $lang["install"]["failure"]." : ".$mysqli->error
			],
			functions::mdl_load("templates-e/install/message.tpl")
		);
	}
} else {
	$mdl = functions::c2r(
		[
			"lg-install" => $lang["install"]["question"],
			"lg-yes" => $lang["common"]["a-yes"],
			"lg-no" => $lang["common"]["a-no"]
		],
		functions::mdl_load("templates-e/install/form.tpl")
	);
}

include "pages/module-core.php";
