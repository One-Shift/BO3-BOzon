<?php

include "class/PHPMailer/class.phpmailer.php";
include "class/class.user.php";
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

if ($auth) {
	switch ($pg) {
		case "logout":
			include sprintf("modules/sys-%s/sys-%s.php", "logout","logout");
			break;
		case "login":
			include sprintf("modules/sys-%s/sys-%s.php", "login","login");
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
			break;
	}
} else {
	include sprintf("modules/sys-%s/sys-%s.php", "login","login");
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
		str_replace(
			[
				"{c2r-og-title}",
				"{c2r-og-url}",
				"{c2r-og-image}",
				"{c2r-og-description}",
				"{c2r-lib-jquery}",
				"{c2r-lib-bootstrap}",
				"{c2r-lib-fontawesome}"
			],
			[
<<<<<<< HEAD
				(isset($og["title"])) ? $og["title"] : $cfg->system->sitename,
				(isset($og["url"])) ? $og["url"] : "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"],
				(isset($og["image"])) ? $og["image"] : "http://".$_SERVER["HTTP_HOST"].$cfg->system->path."/site-assets/default-share-image.jpg",
				(isset($og["description"])) ? $og["description"] : $lang["system"]["description"],
=======
				(isset($og["title"])) ? $og["title"] : $configuration["site-name"],
				(isset($og["url"])) ? $og["url"] : "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"],
				(isset($og["image"])) ? $og["image"] : "http://".$_SERVER["HTTP_HOST"].$configuration["path"]."/site-assets/default-share-image.jpg",
				(isset($og["description"])) ? $og["description"] : $language["system"]["description"],
>>>>>>> origin/master
				file_get_contents("http://nexus-pt.github.io/BO2/jquery.html"),
				file_get_contents("http://nexus-pt.github.io/BO2/bootstrap.html"),
				file_get_contents("http://nexus-pt.github.io/BO2/fontawesome.html")
			],
			$head
		),
<<<<<<< HEAD
		$cfg->system->sitename,
		$lang["system"]["keywords"],
		$lang["system"]["description"],
=======
		$cfg->system->name,
		$language["system"]["keywords"],
		$language["system"]["description"],
>>>>>>> origin/master
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
