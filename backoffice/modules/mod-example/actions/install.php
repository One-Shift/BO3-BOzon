<?php

if (isset($_POST["submitInstall"]) && user::isOwner($authData)) {
    $db = str_replace(
        "{c2r-prefix}",
        $cfg->db->prefix,
        file_get_contents(sprintf("modules/%s/db/install.sql", $cfg->mod->folder))
    );

    if ($mysqli->query($db)) {
        $module = str_replace(
            [
                "{c2r-lg-message}"
            ],
            [
                $lang["install"]["success"]
            ],
            file_get_contents(sprintf("modules/%s/templates-e/install/message.html", $cfg->mod->folder))
        );
    } else {
        $module = str_replace(
            [
                "{c2r-lg-message}"
            ],
            [
                $lang["install"]["failure"]
            ],
            file_get_contents(sprintf("modules/%s/templates-e/install/message.html", $cfg->mod->folder))
        );
    }
} else {
    $module = str_replace(
        [
            "{c2r-lg-install}",
            "{c2r-lg-yes}",
            "{c2r-lg-no}"
        ],
        [
            $lang["install"]["question"],
            $lang["common"]["a-yes"],
            $lang["common"]["a-no"]
        ],
        file_get_contents(sprintf("modules/%s/templates-e/install/form.html", $cfg->mod->folder))
    );
}

include "pages/module-core.php";
