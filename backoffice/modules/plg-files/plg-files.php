<?php

include "controller/languages.php";

$cfg->plg = new stdClass();
$cfg->plg->name = "Files";
$cfg->plg->folder = "plg-files";
$cfg->plg->path = "{$cfg->system->path_bo}/modules/{$cfg->plg->folder}/";
$cfg->plg->version = "0.0.1";
$cfg->plg->developer = "Carlos Santos";
$cfg->plg->contact = "carlos@one-shift.com";
$cfg->plg->install = TRUE;
$cfg->plg->dbTables = [];

// $args = [] are available for plugins

// load language for module
if (file_exists("modules/{$cfg->plg->folder}/languages/{$lg_s}.ini")) {
	$plg_lang = parse_ini_file("modules/{$cfg->plg->folder}/languages/{$lg_s}.ini", true);
} else {
	if (file_exists("modules/{$cfg->plg->folder}/languages/en.ini")) {
		$plg_lang = parse_ini_file("modules/{$cfg->plg->folder}/languages/en.ini", true);
	}
}

if (bo3::dbTableExists($cfg->plg->dbTables) == TRUE) {
	include sprintf("modules/%s/actions/home.php", $cfg->plg->folder);
} else {
	$mdl = bo3::c2r([
		$cfg->plg->folder => $lang["plugin"]["isNotInstalled"]
	], $mdl);
}
