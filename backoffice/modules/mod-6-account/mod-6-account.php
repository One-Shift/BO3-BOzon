<?php

$cfg->mdl = new stdClass();
$cfg->mdl->name = "Account";
$cfg->mdl->folder = "mod-6-account";
$cfg->mdl->path = "{$cfg->system->path_bo}/modules/{$cfg->mdl->folder}/";
$cfg->mdl->version = "0.0.2";
$cfg->mdl->developer = "Rafael Duarte";
$cfg->mdl->contact = "rafaeljfduarte@gmail.com";
$cfg->mdl->dbTables = ["users","trash"];

// load language for module
if (file_exists("modules/{$cfg->mdl->folder}/languages/{$lg_s}.ini")) {
	$mdl_lang = parse_ini_file("modules/{$cfg->mdl->folder}/languages/{$lg_s}.ini", true);
} else {
	if (file_exists("modules/{$cfg->mdl->folder}/languages/en.ini")) {
		$mdl_lang = parse_ini_file("modules/{$cfg->mdl->folder}/languages/en.ini", true);
	}
}

// check if this module is installed
if (bo3::dbTableExists($cfg->mdl->dbTables) == FALSE || bo3::mdlInstalled($cfg->mdl->folder) == FALSE) {
	$a = "install";
}

/* action controller */
if ($a == null && $a != "install") {
	// if action doesn't exist, system sent you to module homepage
	include "modules/{$cfg->mdl->folder}/actions/home.php";
} else {
	$pg_file = "modules/{$cfg->mdl->folder}/actions/{$a}.php";
	if (file_exists($pg_file)) {
		// if exist an action response
		include $pg_file;
	} else {
		// if doesn't exist an action response, system sent you to 404
		header("Location: {$cfg->system->path_bo}/0/{$lg_s}/404/");
	}
}
