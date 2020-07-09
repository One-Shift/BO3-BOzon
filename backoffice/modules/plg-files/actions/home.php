<?php

$plugin = bo3::c2r([
	"id" => (isset($args["id"])) ? $args["id"]: "",
	"module" => (isset($args["module"])) ? $args["module"]: "",
	"uploaded-item-tpl" => bo3::plg_load("templates-e/uploaded-item.tpl"),
	"message-tpl" => bo3::plg_load("templates-e/message.tpl"),
	"permissions-display" => is_writable("./../uploads") ? "d-none" : "d-block",

	"lg-permissions" => $plg_lang["permissions"],
	"lg-files-upload" => $plg_lang["files-upload"],
	"lg-drop" => $plg_lang["drop"],
	"lg-files-submit" => $plg_lang["files-submit"],
	"lg-uploaded-files" => $plg_lang["uploaded-files"],

	"lg-description" => $plg_lang["description"],
	"lg-code" => $plg_lang["code"],
	"lg-save" => $plg_lang["save"]
], bo3::plg_load("templates-e/home.tpl"));

$mdl = bo3::c2r([
	$cfg->plg->folder => $plugin
], $mdl);
