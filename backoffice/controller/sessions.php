<?php

// controlador de sessão
if ($cfg->db->connect) {
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
} else {
	$auth = false;
}
