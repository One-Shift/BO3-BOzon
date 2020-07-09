<?php


if (is_dir("./backoffice")) {
	$path_to_backoffice = "/backoffice";
} else {
	$path_to_backoffice = "";
}

$cfg = new stdClass();

include ROOT_DIR."{$path_to_backoffice}/config/database.php";
include ROOT_DIR."{$path_to_backoffice}/config/email.php";
include ROOT_DIR."{$path_to_backoffice}/config/languages.php";
include ROOT_DIR."{$path_to_backoffice}/config/system.php";
