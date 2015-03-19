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

$language = parse_ini_file(sprintf("languages/%s.ini", $lg_s), true);
