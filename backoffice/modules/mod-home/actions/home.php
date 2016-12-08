<?php

$mdl = str_replace(
	[
		"{c2r-version}",
		"{c2r-sub-version}"
	],
	[
		$cfg->system->version,
		$cfg->system->sub_version
	],
	functions::mdl_load("templates/home.tpl")
);

include "pages/module-core.php";
