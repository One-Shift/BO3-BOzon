<?php

$page_tpl = file_get_contents("templates/home.tpl");

include "pages-e/header.php";
include "pages-e/footer.php";

/* last thing */
$template = str_replace(
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
