<?php

include "pages-e/header.php";
include "pages-e/footer.php";
include "pages-e/menu.php";

if (user::isOwner($authData) && empty($a) && count($cfg->mdl->dbTables) > 0) {
	$uninstall = bo3::c2r([
		"lg-title" => $lang["uninstall"]["modal-title"],
		"lg-question" => $lang["uninstall"]["modal-question"],
		"lg-uninstall" => $lang["uninstall"]["modal-button"],
		"lg-close" => $lang["uninstall"]["modal-close"]
	], bo3::loade("module-core/uninstall.tpl"));
} else {
	$uninstall = "";
}

/* last thing */
$tpl = bo3::c2r([
	"header" => $header,
	"footer" => $footer,

	"bo3-version" => $cfg->system->version,
	"bo3-sub-version" => $cfg->system->sub_version,
	"menu" => (isset($menu)) ? $menu : "",
	"avatar" => md5($authData["email"]),
	"background" => file_get_contents("https://api.nexus-pt.eu/bo3-image-server/"),

	"breadcrump" => (isset($breadcrump)) ? $breadcrump : "",
	"module-name" => $cfg->mdl->name,
	"module" => (isset($mdl)) ? $mdl : ".::MDL::.::TPL::.::ERROR::.",

	"uninstall" => $uninstall,

	"module-folder" => str_replace("mod-" , "", $cfg->mdl->folder),
	"module-path" => $cfg->mdl->path,
	"username" => $authData["username"],
	"email" => $authData["email"]
], bo3::load("home.tpl"));
