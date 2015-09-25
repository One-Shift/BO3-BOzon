<?php

include "class/PHPMailer/class.phpmailer.php";
include "class/class.functions.php";

include "config/cfg.php";
include "config/database.php";
include "config/email.php";
include "config/languages.php";
include "config/store.php";
include "config/system.php";
include "config/connect.php";

include "controller/languages.php";
include "controller/sessions.php";
include "controller/pages.php";
include "controller/actions.php";
include "controller/id.php";

$head = file_get_contents("templates-e/head.html");

// abaixo é iniciada a criação do template, com base nós ficheiros html

switch ($pg) {
	case "login":
		include sprintf("modules/sys-%s/sys-%s.php", "login","login");
		break;
	case "logout":
		include sprintf("modules/sys-%s/sys-%s.php", "logout","logout");
		break;
	default:
		$mod_path = sprintf("modules/mod-%s/", $pg);

		if (!file_exists($mod_path)) {
			include sprintf("modules/sys-%s/sys-%s.php", "404","404");
			exit;
		} else {
			// mod load
			include sprintf("%smod-%s.php", $mod_path,$pg);
		}
}


// print website
$tpl = str_replace(
	[
		"{c2r-head}",
		"{c2r-sitename}",
		"{c2r-keywords}",
		"{c2r-description}",
		"{c2r-path}",
		"{c2r-lg}"
	],
	[
		$head,
		$cfg->system->name,
		$language["system"]["keywords"],
		$language["system"]["description"],
		$cfg->system->path_bo,
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
