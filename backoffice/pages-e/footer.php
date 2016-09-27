<?php

$page_e_tpl = file_get_contents("templates-e/footer.tpl");

/* last thing */
$footer = str_replace(
	[
		""
	],
	[
		""
	],
	$page_e_tpl
);
