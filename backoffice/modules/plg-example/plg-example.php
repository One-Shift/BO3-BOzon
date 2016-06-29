<?php

$cfg->plg = new stdClass();
$cfg->plg->name = "Example";
$cfg->plg->folder = "plg-example";
$cfg->plg->path = "{$cfg->system->path_bo}/modules/{$cfg->mod->folder}/";
$cfg->plg->version = "0.0.1";
$cfg->plg->developer = "Carlos Santos";
$cfg->plg->contact = "carlos@nexus.pt";
$cfg->plg->install = TRUE;
$cfg->plg->dbTables = [];

// $args = [] are available for plugins

if (functions::dbTableExists($cfg->plg->dbTables) == TRUE) {
    include sprintf("modules/%s/actions/home.php", $cfg->plg->folder);
} else {
    $module = str_replace(
        "{c2r-".$cfg->plg->folder."}",
        $lang["plugin"]["isNotInstalled"],
        $module
    );
}
