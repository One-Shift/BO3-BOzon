<?php

$module = str_replace(
    [
        "{c2r-version}",
        "{c2r-sub-version}"
    ],
    [
        $cfg->system->version,
        $cfg->system->sub_version
    ],
    functions::mod_load("templates-e/home.html")
);

include "pages/module-core.php";
