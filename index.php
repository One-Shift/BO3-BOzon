<?php

include "backoffice/class/PHPMailer/class.phpmailer.php";
include "backoffice/class/class.functions.php";

include "backoffice/config/cfg.php";
include "backoffice/config/database.php";
include "backoffice/config/email.php";
include "backoffice/config/languages.php";
include "backoffice/config/store.php";
include "backoffice/config/system.php";
include "backoffice/config/connect.php";

include "backoffice/controller/languages.php";
include "backoffice/controller/sessions.php";
include "backoffice/controller/pages.php";
include "backoffice/controller/actions.php";
include "backoffice/controller/id.php";

$head = file_get_contents("templates-e/head.html");

// abaixo é iniciada a criação do template, com base nós ficheiros html
// include "pages/includes.php";

$pg_file = sprintf("pages/%s.php", $pg);
if (file_exists($pg_file)) {
	include $pg_file;
} else {
	include "pages/home.php";
}

// print website
$tpl = str_replace(
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
		$cfg->system->name,
		$language["system"]["keywords"],
		$language["system"]["description"],
		$cfg->system->analytics,
		$cfg->system->path,
		$lg_s
	],
	$tpl
);

// minify system
if ($cfg->system->minify) {
	print functions::minifyPage($tpl);
} else {
	print $tpl;
}
