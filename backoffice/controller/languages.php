<?php

// controlador de língua
if (isset($_GET["lg"]) && !empty($_GET["lg"])) {
	switch ($_GET["lg"]) {
		case "pt":
			$lg = 1;
			$lg_s = "pt";
			break;
		default:
			$lg = 1;
			$lg_s = "pt";
	}
} else {
	$lg = 1;
	$lg_s = "pt";
}

$lg_file = sprintf("languages/%s.ini", $lg_s) {
if (file_exists($pg_file)) {
	$lang = parse_ini_file($lg_file, true);
} else {
	$lang = parse_ini_file("languages/en.ini", true);
}
