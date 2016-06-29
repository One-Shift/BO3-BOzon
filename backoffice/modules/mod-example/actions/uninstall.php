<?php

if (isset($_POST["submitUninstall"]) && user::isOwner($authData)) {
    $db = str_replace(
        "{c2r-prefix}",
        $cfg->db->prefix,
        file_get_contents(sprintf("modules/%s/db/uninstall.sql", $cfg->mod->folder))
    );

    if ($mysqli->query($db)) {
        $module = str_replace(
            [
                "{c2r-lg-message}"
            ],
            [
                $lang["uninstall"]["success"]
            ],
            file_get_contents(sprintf("modules/%s/templates-e/uninstall/message.html", $cfg->mod->folder))
        );
    } else {
        $module = str_replace(
            [
                "{c2r-lg-message}"
            ],
            [
                $lang["uninstall"]["failure"]
            ],
            file_get_contents(sprintf("modules/%s/templates-e/uninstall/message.html", $cfg->mod->folder))
        );
    }
} else {
    $module = str_replace(
        [
            "{c2r-lg-message}"
        ],
        [
            $lang["uninstall"]["failure"]
        ],
        file_get_contents(sprintf("modules/%s/templates-e/uninstall/message.html", $cfg->mod->folder))
    );
}

include "pages/module-core.php";
