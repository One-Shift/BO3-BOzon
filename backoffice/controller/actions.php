<?php

// controlador de acção
if (isset($_GET["a"]) && !empty($_GET["a"])) {
	$a = $mysqli->real_escape_string($_GET["a"]);
} else {
	$a = null;
}
