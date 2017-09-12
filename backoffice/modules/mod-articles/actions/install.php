<?php

if (isset($_POST["submitInstall"]) && user::isOwner($authData)) {
    $db = bo3::c2r(
		[
			"mod-name" => $cfg->mdl->name,
			"mod-folder" => $cfg->mdl->folder,
			"prefix" => $cfg->db->prefix,
		],
		bo3::mdl_load("db/install.sql")
	);

	if ($mysqli->multi_query($db) != FALSE) {
		while ($mysqli->more_results() && $mysqli->next_result()) {;} // flush multi_queries

		$mdl = bo3::c2r(
			[
				"lg-message" => $lang["install"]["success"]
			],
			bo3::mdl_load("templates-e/install/message.tpl")
		);
	} else {
		$mdl = bo3::c2r(
			[
				"lg-message" => $lang["install"]["failure"]." : ".$mysqli->error
			],
			bo3::mdl_load("templates-e/install/message.tpl")
		);
	}
} else {
	$mdl = bo3::c2r(
		[
			"lg-install" => $lang["install"]["question"],
			"lg-yes" => $lang["common"]["a-yes"],
			"lg-no" => $lang["common"]["a-no"]
		],
		bo3::mdl_load("templates-e/install/form.tpl")
	);
}

include "pages/module-core.php";
