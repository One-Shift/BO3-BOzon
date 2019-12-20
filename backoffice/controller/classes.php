<?php

/**
* Class init
* Includes all classes from the class folder
*
* @author 	Carlos Santos
* @version 0.2
* @since 2016-10
*/

if (is_dir("./backoffice")) {
	$path_to_backoffice = "/backoffice";
} else {
	$path_to_backoffice = "";
}

if (is_dir(ROOT_DIR."{$path_to_backoffice}/vendor/")) {
	require ROOT_DIR."{$path_to_backoffice}/vendor/autoload.php";
}

foreach (glob(ROOT_DIR."{$path_to_backoffice}/class/*.php") as $filename) {
	include $filename;
}
