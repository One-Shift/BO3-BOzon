<?php

// controlador de páginas
if (isset($_GET["pg"]) && !empty($_GET["pg"])) {
	$pg = $_GET["pg"];
} else {
	$pg = "home";
}
