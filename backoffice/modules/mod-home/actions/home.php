<?php

$mdl = bo3::c2r(
	[
		'version' => $cfg->system->version,
		'sub-version' => $cfg->system->sub_version
	],
	bo3::mdl_load("templates/home.tpl")
);

include "pages/module-core.php";
