<?php
$plugin = bo3::c2r([
	"id" => (isset($args["id"])) ? $args["id"]: "",
	"module" => (isset($args["module"])) ? $args["module"]: "",
	"uploaded-item-tpl" => bo3::plg_load("templates-e/uploaded-item.tpl")
], bo3::plg_load("templates-e/home.tpl"));

$mdl = bo3::c2r([
	$cfg->plg->folder => $plugin
], $mdl);
