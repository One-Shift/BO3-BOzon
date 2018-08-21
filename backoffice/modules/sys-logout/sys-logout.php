<?php

$cfg->mdl = new stdClass();
$cfg->mdl->name = "Logout";
$cfg->mdl->folder = "sys-logout";
$cfg->mdl->path = "{$cfg->system->path_bo}/modules/{$cfg->mdl->folder}/";
$cfg->mdl->version = "0.0.1";
$cfg->mdl->developer = "Rafael Duarte";
$cfg->mdl->contact = "rafaeljfduarte@gmail.com";

// load language for module
if (file_exists("modules/{$cfg->mdl->folder}/languages/{$lg_s}.ini")) {
	$mdl_lang = parse_ini_file("modules/{$cfg->mdl->folder}/languages/{$lg_s}.ini", true);
} else {
	if (file_exists("modules/{$cfg->mdl->folder}/languages/en.ini")) {
		$mdl_lang = parse_ini_file("modules/{$cfg->mdl->folder}/languages/en.ini", true);
	}
}

/* action controller */
if ($a == null) {
	// if action doesn't exist, system sent you to module homepage
	include sprintf("modules/%s/actions/home.php", $cfg->mdl->folder);
} else {
	$pg_file = sprintf("modules/%s/actions/%s.php", $cfg->mdl->folder, $a);
	if (file_exists($pg_file)) {
		// if exist an action response
		include $pg_file;
	} else {
		// if doesn't exist an action response, system sent you to 404
		header("Location: {$cfg->system->path_bo}/{$lg_s}/404/");
	}
}
