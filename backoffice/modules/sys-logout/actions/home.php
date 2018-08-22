<?php

$page_tpl = bo3::mdl_load("templates/home.tpl");

if(isset($_COOKIE["{$cfg->system->cookie}"])) {
	unset($_COOKIE["{$cfg->system->cookie}"]);
	setcookie("{$cfg->system->cookie}", '', time() - 3600, "{$cfg->system->path}");
	setcookie("{$cfg->system->cookie}", '', time() - 3600, "{$cfg->system->path_bo}");
	$message = $mdl_lang["messages"]["success"];
} else {
	$message = $mdl_lang["messages"]["failure"];
}

header("Refresh:5; url={$cfg->system->path_bo}");

/* last thing */
$tpl = bo3::c2r([
	"mod-path" => $cfg->mdl->path,
	"message" => $message
], $page_tpl);
