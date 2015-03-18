<?php

include "class/PHPMailer/class.phpmailer.php";
include "class/class.functions.php";

include "config/cfg.php";
include "config/database.php";
include "config/email.php";
include "config/languages.php";
include "config/store.php";
include "config/system.php";
include "config/connect.php";

// controlador de sessão
if (isset($_COOKIE[$configuration["cookie"]]) && !empty($_COOKIE[$configuration["cookie"]])) {
	$cookie = explode(".", $_COOKIE[$configuration["cookie"]]);

	if (count($cookie) === 2) {
		$cookie[0] = intval($cookie[0]);
		$cookie[1] = $mysqli->real_escape_string($cookie[1]);

		$query[0] = sprintf("SELECT * FROM %s_users WHERE id = '%s' AND password = '%s' LIMIT %s", $configuration["mysql-prefix"], $cookie[0], $cookie[1], 1);
		$source[0] = $mysqli->query($query[0]);
		$nr[0] = $source[0]->num_rows;

		if ($nr[0] === 1) {
			$auth = true;
			$authData = $source[0]->fetch_assoc();
		} else {
			$auth = false;
		}
	}
} else {
	$auth = false;
}

// controlador de páginas
if (isset($_GET["pg"]) && !empty($_GET["pg"])) {
	$pg = $_GET["pg"];
} else {
	$pg = "home";
}

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

// controlador de ID
if (isset($_GET["i"]) && !empty($_GET["i"])) {
	$id = intval($_GET["i"]);
} else {
	$id = null;
}

// controlador de acção
if (isset($_GET["a"]) && !empty($_GET["a"])) {
	$a = $mysqli->real_escape_string($_GET["a"]);
} else {
	$a = null;
}

$head = file_get_contents("templates-e/head.html");

$language = parse_ini_file(sprintf("languages/%s.ini", $lg_s), true);

/*
 *  abaixo é iniciada a criação do template, com base nós ficheiros html
 */

include "pages/includes.php";

// print website

$template = str_replace(
	[
		"{c2r-head}",
		"{c2r-sitename}",
		"{c2r-keywords}",
		"{c2r-description}",
		"{c2r-analytics}",
		"{c2r-path}",
		"{c2r-lg}"
	],
	[
		$head,
		$cfg->system->name,
		$language["system"]["keywords"],
		$language["system"]["description"],
		$cfg->system->analytics,
		$cfg->system->path,
		$lg_s
	],
	$template
);

// testint minify system
if ($cfg->system->minify) {
    print functions::minifyPage($template);
} else {
    print $template;
}
