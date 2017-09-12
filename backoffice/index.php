<?php
ini_set('display_errors', 1);
include "controller/classes.php";
include "config/cfg.php";
include "config/database.php";
include "config/email.php";
include "config/languages.php";
include "config/store.php";
include "config/system.php";

include "controller/languages.php";
include "controller/sessions-bo.php";
include "controller/pages.php";
include "controller/actions.php";
include "controller/id.php";

include "../pages-e/_global_.php";

$head = file_get_contents("templates-e/head.tpl");

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
				header("Location: {$cfg->system->path_bo}/{$lg_s}/404/");
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
$tpl = bo3::c2r(
	[
		"head" => $head,

		"og-title" => (isset($og["title"])) ? $og["title"] : $cfg->system->sitename,
		"og-url" => (isset($og["url"])) ? $og["url"] : "{$cfg->system->protocol}://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
		"og-image" => (isset($og["image"])) ? $og["image"] : "{$cfg->system->protocol}://{$_SERVER['HTTP_HOST']}{$cfg->system->path}/site-assets/default-share-image.jpg",
		"og-description" => (isset($og["description"])) ? $og["description"] : $lang["system"]["description"],

		"lib-jquery" => file_get_contents("http://nexus-pt.github.io/BO3/jquery.html"),
		"lib-bootstrap" => file_get_contents("http://nexus-pt.github.io/BO3/bootstrap.html"),
		"lib-fontawesome" => file_get_contents("http://nexus-pt.github.io/BO3/fontawesome.html"),

		"sitename" => $cfg->system->sitename,
		"keywords" => $lang["system"]["keywords"],
		"description" => $lang["system"]["description"],
		"path" => $cfg->system->path,
		"path-bo" => $cfg->system->path_bo,
		"lg" => $lg_s,
		"cookie" => $cfg->system->cookie
	],
	(isset($tpl)) ? $tpl : ".::TPL::.::ERROR::."
);

// minify system
if ($cfg->system->minify) {
	print bo3::minifyPage($tpl);
} else {
	print $tpl;
}
