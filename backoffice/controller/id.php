<?php

/**
* ID Controller
*
* @author 	Carlos Santos
* @version 0.1
* @since 2016-10
*/

if (isset($_GET["i"])) {
	$id = intval($_GET["i"]);
} else if (isset(getopt(null, ["i::"])["i"])) {
	$id = intval(getopt(null, ["i::"])["i"]);
} else {
	$id = null;
}
