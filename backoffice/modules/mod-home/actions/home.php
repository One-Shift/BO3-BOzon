<?php

$mdl = functions::c2r(
	[
		'version' => $cfg->system->version,
		'sub-version' => $cfg->system->sub_version
	],
	functions::mdl_load("templates/home.tpl")
);

include "pages/module-core.php";
