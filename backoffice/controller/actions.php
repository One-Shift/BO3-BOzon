<?php

// ACTION CONTROLLER
if (isset($_GET["a"]) && !empty($_GET["a"])) {
	if ($cfg->db->connect) {
		$a = $db->real_escape_string($_GET["a"]);
	} else {
		$a = $_GET["a"];
	}
} else {
	$a = null;
}
