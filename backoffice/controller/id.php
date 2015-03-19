<?php

// controlador de ID
if (isset($_GET["i"]) && !empty($_GET["i"])) {
	$id = intval($_GET["i"]);
} else {
	$id = null;
}
