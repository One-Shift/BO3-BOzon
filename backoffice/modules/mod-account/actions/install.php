<?php

if (isset($_POST["submitInstall"]) && user::isOwner($authData)) {
    $db = str_replace(
        [
            "{c2r-mod-folder}",
            "{c2r-prefix}"
        ],
        [
            $cfg->mdl->folder,
            $cfg->db->prefix
        ],
        functions::mdl_load("db/install.sql")
    );

    if ($mysqli->multi_query($db) != FALSE) {
        while ($mysqli->more_results() && $mysqli->next_result()) {;} // flush multi_queries

        $mdl = str_replace(
            "{c2r-lg-message}",
            $lang["install"]["success"],
            functions::mdl_load("templates-e/install/message.tpl")
        );
    } else {
        $mdl = str_replace(
            "{c2r-lg-message}",
            $lang["install"]["failure"]." : ".$mysqli->error,
            functions::mdl_load("templates-e/install/message.tpl")
        );
    }
} else {
    $mdl = str_replace(
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
        functions::mdl_load("templates-e/install/form.tpl")
    );
}

include "pages/module-core.php";
