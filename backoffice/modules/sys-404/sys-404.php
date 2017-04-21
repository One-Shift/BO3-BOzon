<?php

$cfg->mdl = new stdClass();
$cfg->mdl->name = "404 Page Not Found";
$cfg->mdl->folder = "sys-404";
$cfg->mdl->path = "{$cfg->system->path_bo}/modules/{$cfg->mdl->folder}/";
$cfg->mdl->version = "0.0.1";
$cfg->mdl->developer = "developer name here";
$cfg->mdl->contact = "developer@email.here";
$cfg->mdl->install = FALSE;
$cfg->mdl->dbTables = [];

include "modules/{$cfg->mdl->folder}/actions/home.php";
