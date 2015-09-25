<?php

//$page_tpl = file_get_contents(sprintf("modules/%s/templates/home.html", $cfg->mod->folder));
$page_tpl = file_get_contents("templates/home.html");

/* last thing */
$tpl = str_replace(
	[
		"{c2r-header}",
		"{c2r-footer}"
	],
	[
		$header,
		$footer
	],
	$page_tpl
);
