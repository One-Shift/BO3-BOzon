<?php

/**
* Page Controller
*
* @author 	Carlos Santos
* @version 0.1
* @since 2016-10
*/

if (isset($_GET["pg"]) && !empty($_GET["pg"])) {
	$pg = strtolower($_GET["pg"]);
} else if (isset(getopt(null, ["pg::"])["pg"])) {
	$pg = strtolower(getopt(null, ["pg::"])["pg"]);
} else {
	$pg = "home";
}
