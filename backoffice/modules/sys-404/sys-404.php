<?php

$cfg->mod = new stdClass();
$cfg->mod->name = "404 Page Not Found";
$cfg->mod->folder = "sys-404";
$cfg->mod->version = "0.0.1";
$cfg->mod->developer = "developer name here";
$cfg->mod->contact = "developer@email.here";

/* action controller */
if ($a == null) {
	// if action doesn't exist, system sent you to module homepage
	include "modules/%s/actions/home.php";
} else {
	$pg_file = sprintf("modules/%s/actions/%s.php", $cfg->mod->folder, $a);
	if (file_exists($pg_file)) {
		// if exist an action response
		include $pg_file;
	} else {
		// if doesn't exist an action response, system sent you to 404
		header(
			sprintf(
				"Location: %s/0/%s/404/",
				$cfg->system->path_bo, $lg_s
			)
		);
	}
}
