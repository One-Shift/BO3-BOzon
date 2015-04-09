<?php

include "class/PHPMailer/class.phpmailer.php";
include "class/class.functions.php";

include "backoffice/config/cfg.php";
include "backoffice/config/database.php";
include "backoffice/config/email.php";
include "backoffice/config/languages.php";
include "backoffice/config/store.php";
include "backoffice/config/system.php";
include "backoffice/config/connect.php";

include "backoffice/controller/languages.php"
include "backoffice/controller/sessions.php"
include "backoffice/controller/pages.php"
include "backoffice/controller/actions.php"
include "backoffice/controller/id.php"

$head = file_get_contents("templates-e/head.html");

// abaixo é iniciada a criação do template, com base nós ficheiros html
include "pages/includes.php";

// print website
$template = str_replace(
	[
		"{c2r-head}",
		"{c2r-sitename}",
		"{c2r-keywords}",
		"{c2r-description}",
		"{c2r-analytics}",
		"{c2r-path}",
		"{c2r-lg}"
	],
	[
		$head,
		$configuration["site-name"],
		$language["system"]["keywords"],
		$language["system"]["description"],
		$configuration["analytics"],
		$configuration["path"],
		$lg_s
	],
	$template
);

// testint minify system
if ($cfg->system->minify) {
	print minifyPage($template);
} else {
	print $template;
}
