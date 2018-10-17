<?php

if ($cfg->db->connect) {
	if (isset($_COOKIE[$cfg->system->cookie]) && !empty($_COOKIE[$cfg->system->cookie])) {
		$cookie = explode(".", $_COOKIE[$cfg->system->cookie]);
		if (count($cookie) === 2) {
			$cookie[0] = intval($cookie[0]);
			$cookie[1] = $db->real_escape_string($cookie[1]);

			$query = sprintf(
				"SELECT * FROM %s_9_users WHERE id = '%s' AND password = '%s' LIMIT %s",
				$cfg->db->prefix, $cookie[0], $cookie[1], 1
			);
			$source = $db->query($query);

			if ($source->num_rows == 1) {
				$auth = true;
				$authData = $source->fetch_assoc();
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
