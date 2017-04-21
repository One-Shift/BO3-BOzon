<?php

$page_tpl = functions::load("home.tpl");

include "pages-e/header.php";
include "pages-e/footer.php";

/* last thing */
$template = functions::c2r(
	[
		"header" => $header,
		"footer" => $footer
	],
	$page_tpl
);
