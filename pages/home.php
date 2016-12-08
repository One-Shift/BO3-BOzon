<?php

$page_tpl = functions::load("home.tpl");

include "pages-e/header.php";
include "pages-e/footer.php";

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
