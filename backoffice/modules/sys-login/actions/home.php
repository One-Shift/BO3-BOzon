<?php

$page_tpl = file_get_contents(sprintf("modules/%s/templates/home.html", $cfg->mod->folder));

$form = str_replace(
	[],
	[],
	file_get_contents(sprintf("modules/%s/templates-e/form.html", $cfg->mod->folder))
);

if (isset($_POST["submit"])) {
	$form = str_replace(
		[
			"{c2r-return-message}"
		],
		[
			str_replace(
				[
					"{c2r-message}"
				],
				[
					"Message HERE"
				],
				file_get_contents(sprintf("modules/%s/templates-e/return-message.html", $cfg->mod->folder))
			)
		],
		$form
	);
} else {
	$form = str_replace("{c2r-return-message}", null, $form);
}

/* last thing */
$tpl = str_replace(
	[
		"{c2r-form}"
	],
	[
		$form
	],
	$page_tpl
);
