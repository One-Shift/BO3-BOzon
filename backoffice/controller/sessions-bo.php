<?php

/**
* BO Session Controller
*
* @author 	Carlos Santos
* @version 0.2
* @since 2016-10
*/

if ($cfg->db->connect) {
	if (isset($_COOKIE[$cfg->system->cookie]) && !empty($_COOKIE[$cfg->system->cookie])) {
		$cookie = explode(".", $_COOKIE[$cfg->system->cookie]);
		if (count($cookie) === 2) {
			$cookie[0] = intval($cookie[0]);
			$cookie[1] = $db->real_escape_string($cookie[1]);

			$source = $db->query(sprintf(
				"SELECT * FROM %s_9_users WHERE id = %d AND password = '%s' AND (rank = 'owner' OR rank = 'manager') AND status = %d LIMIT %d",
				$cfg->db->prefix, $cookie[0], $cookie[1], 1, 1
			));

			if($source->num_rows > 0) {
				$auth = TRUE;
				$authData = $source->fetch_object();
			} else {
				$auth = FALSE;

				// Destroy the cookie
				setcookie( $cfg->system->cookie, "", 0, (!empty($cfg->system->path)) ? $cfg->system->path : "/");
			}
		}
	} else {
		$auth = false;
	}
} else {
	$auth = false;
}
