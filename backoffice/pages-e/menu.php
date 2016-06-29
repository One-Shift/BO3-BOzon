<?php

$menu_item_tpl = file_get_contents("templates-e/menu/item.html");

$menu = null;

$list = glob('./modules/mod-*', GLOB_ONLYDIR);

foreach ($list as $key => $value) {
    $tmp = explode("/", $value);

    $tmp_name = explode("-", $tmp[count($tmp) - 1]);

    $menu .= str_replace(
        [
            "{c2r-mod}",
            "{c2r-name}"
        ],
        $tmp_name[count($tmp_name) - 1],
        $menu_item_tpl
    );
}
