<?php

include "controller/classes.php";

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

$head = file_get_contents("templates-e/head.tpl");

// abaixo é iniciada a criação do template, com base nós ficheiros html

if ($auth) {
	switch ($pg) {
		case "logout":
			include sprintf("modules/sys-%s/sys-%s.php", "logout", "logout");
			break;
		case "404":
			include sprintf("modules/sys-%s/sys-%s.php", "404", "404");
			break;
		default:
			$mdl_path = sprintf("modules/mod-%s/", $pg);

			if (!file_exists($mdl_path)) {
				// if doesn't exist an action response, system sent you to 404
				header("Location: {$cfg->system->path_bo}/0/{$lg_s}/404/");
			} else {
				// mod load
				include sprintf("%smod-%s.php", $mdl_path, $pg);
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
		"{c2r-path-bo}",
		"{c2r-lg}",
		"{c2r-cookie}"
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
				(isset($og["title"])) ? $og["title"] : $cfg->system->sitename,
				(isset($og["url"])) ? $og["url"] : "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"],
				(isset($og["image"])) ? $og["image"] : "http://".$_SERVER["HTTP_HOST"].$cfg->system->path."/site-assets/default-share-image.jpg",
				(isset($og["description"])) ? $og["description"] : $lang["system"]["description"],
				file_get_contents("http://nexus-pt.github.io/BO2/jquery.html"),
				file_get_contents("http://nexus-pt.github.io/BO2/bootstrap.html"),
				file_get_contents("http://nexus-pt.github.io/BO2/fontawesome.html")
			],
			$head
		),
		$cfg->system->sitename,
		$lang["system"]["keywords"],
		$lang["system"]["description"],
		$cfg->system->path,
		$cfg->system->path_bo,
		$lg_s,
		$cfg->system->cookie
	],
	$tpl
);

// minify system
if ($cfg->system->minify) {
	print functions::minifyPage($tpl);
} else {
	print $tpl;
}
