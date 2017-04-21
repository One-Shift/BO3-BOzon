<?php
$plugin = functions::c2r(
	[
		"id" => (isset($args["id"])) ? $args["id"]: "",
		"module" => (isset($args["module"])) ? $args["module"]: "",
		"uploaded-item-tpl" => functions::plg_load("templates-e/uploaded-item.tpl")
	],
	functions::plg_load("templates-e/home.tpl")
);

$mdl = functions::c2r(
	[
		$cfg->plg->folder => $plugin
	],
	$mdl
);
