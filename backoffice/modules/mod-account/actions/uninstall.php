<?php

if (isset($_POST["submitUninstall"]) && user::isOwner($authData)) {
    $db = str_replace(
        [
            "{c2r-mod-folder}",
            "{c2r-prefix}"
        ],
        [
            $cfg->mdl->folder,
            $cfg->db->prefix
        ],
        functions::mdl_load("db/uninstall.sql")
    );

    if ($mysqli->multi_query($db) != FALSE) {
        while ($mysqli->more_results() && $mysqli->next_result()) {;} // flush multi_queries

        $mdl = str_replace(
            "{c2r-lg-message}",
            $lang["uninstall"]["success"],
            functions::mdl_load("templates-e/uninstall/message.tpl")
        );
    } else {
        $mdl = str_replace(
            "{c2r-lg-message}",
            $lang["uninstall"]["failure"]." : ".$mysqli->error,
            functions::mdl_load("templates-e/uninstall/message.tpl")
        );
    }
} else {
    $mdl = str_replace(
        "{c2r-lg-message}",
        $lang["uninstall"]["failure"],
        functions::mdl_load("templates-e/uninstall/message.htpl")
    );
}

include "pages/module-core.php";
