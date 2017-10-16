<?php
include "backoffice/config/cfg.php";
include "backoffice/config/database.php";
include "backoffice/config/email.php";
include "backoffice/config/languages.php";
include "backoffice/config/store.php";
include "backoffice/config/system.php";

include "backoffice/controller/database.php";
include "backoffice/controller/https.php";
include "backoffice/controller/classes.php";
include "backoffice/controller/languages.php";
include "backoffice/controller/sessions.php";
include "backoffice/controller/pages.php";
include "backoffice/controller/actions.php";
include "backoffice/controller/id.php";

include "pages-e/_global_.php";

$head = bo3::loade("head.tpl");

// page controller
$pg_file = sprintf("pages/%s.php", $pg);
if ($pg == null) {
	include "pages/home.php";
} else if ($pg == "404") {
	include "pages/404.php";
} else if (file_exists($pg_file)) {
	include $pg_file;
} else {
	include "pages/404.php";
}

// print website
$tpl = bo3::c2r(
	[
		"head" => $head,

		"og-title" => (isset($og["title"])) ? $og["title"] : $cfg->system->sitename,
		"og-url" => (isset($og["url"])) ? $og["url"] : "{$cfg->system->protocol}://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
		"og-image" => (isset($og["image"])) ? $og["image"] : "{$cfg->system->protocol}://{$_SERVER['HTTP_HOST']}{$cfg->system->path}/site-assets/default-share-image.jpg",
		"og-description" => (isset($og["description"])) ? $og["description"] : $lang["system"]["description"],

		"lib-jquery" => file_get_contents("https://nexus-pt.github.io/BO3/jquery.html"),
		"lib-bootstrap" => file_get_contents("https://nexus-pt.github.io/BO3/bootstrap.html"),
		"lib-fontawesome" => file_get_contents("https://nexus-pt.github.io/BO3/fontawesome.html"),

		"sitename" => $cfg->system->sitename,
		"keywords" => $lang["system"]["keywords"],
		"description" => $lang["system"]["description"],
		"analytics" => $cfg->system->analytics,
		"path" => $cfg->system->path,
		"lg" => $lg_s
	],
	(isset($tpl)) ? $tpl : ".::TPL::.::ERROR::."
);

// minify system
if ($cfg->system->minify) {
	print bo3::minifyPage($tpl);
} else {
	print $tpl;
}
