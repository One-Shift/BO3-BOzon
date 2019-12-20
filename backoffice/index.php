<?php

define('ROOT_DIR', dirname(__FILE__));

include ROOT_DIR."/controller/classes.php";
include ROOT_DIR."/config/cfg.php";
include ROOT_DIR."/config/database.php";
include ROOT_DIR."/config/email.php";
include ROOT_DIR."/config/languages.php";
include ROOT_DIR."/config/system.php";

include ROOT_DIR."/controller/database.php";
include ROOT_DIR."/controller/https.php";
include ROOT_DIR."/controller/languages.php";
include ROOT_DIR."/controller/sessions-bo.php";
include ROOT_DIR."/controller/pages.php";
include ROOT_DIR."/controller/actions.php";
include ROOT_DIR."/controller/id.php";

$head = file_get_contents(ROOT_DIR."/templates-e/head.tpl");

if ($auth) {
	switch ($pg) {
		case "logout":
			include sprintf(ROOT_DIR."/modules/sys-%s/sys-%s.php", "logout", "logout");
			break;
		case "404":
			include sprintf(ROOT_DIR."/modules/sys-%s/sys-%s.php", "404", "404");
			break;
		default:
			if ($pg == "home") { $pg = "5-home"; }

			$mdl_path = sprintf(ROOT_DIR."/modules/mod-%s", $pg);

			if (!is_dir($mdl_path)) {
				// if doesn't exist an action response, system sent you to 404
				header("Location: {$cfg->system->path_bo}/{$lg_s}/404/");
			} else {
				// mod load
				include "{$mdl_path}/mod-init.php";
			}
			break;
	}
} else { include sprintf(ROOT_DIR."/modules/sys-%s/sys-%s.php", "login","login"); }

// Preparing tpl to be send as response of the request
$tpl = bo3::c2r([
	"head" => $head,

	"og-title" => (isset($og["title"])) ? $og["title"] : $cfg->system->sitename,
	"og-url" => (isset($og["url"])) ? $og["url"] : "{$cfg->system->protocol}://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
	"og-image" => (isset($og["image"])) ? $og["image"] : "{$cfg->system->protocol}://{$_SERVER['HTTP_HOST']}{$cfg->system->path}/site-assets/default-share-image.jpg",
	"og-description" => (isset($og["description"])) ? $og["description"] : $lang["system"]["description"],

	"sitename" => $cfg->system->sitename,
	"keywords" => $lang["system"]["keywords"],
	"description" => $lang["system"]["description"],

	"path" => $cfg->system->path,
	"bo-path" => $cfg->system->path_bo,
	"css" => "{$cfg->system->path_bo}/site-assets/css",
	"js" => "{$cfg->system->path_bo}/site-assets/js",
	"images" => "{$cfg->system->path_bo}/site-assets/images",
	"libs" => "{$cfg->system->path_bo}/site-assets/libs",
	"uploads" => "{$cfg->system->path}/uploads",

	"lg" => $lg_s,
	"cookie" => $cfg->system->cookie,

	"ads-active" => ($cfg->system->pub) ? "d-block" : "d-none"
], isset($tpl) ? $tpl : ".::TPL::.::ERROR::.");

// minify system
if ($cfg->system->minify) {
	echo bo3::minifyPage($tpl);
} else {
	echo $tpl;
}
