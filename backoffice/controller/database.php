<?php

if ($cfg->db->connect) {
	$options = [
		PDO::ATTR_EMULATE_PREPARES   => false,
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
	];

	try {
		$db = new PDO("mysql:host={$cfg->db->host};dbname={$cfg->db->database};charset=utf8mb4", $cfg->db->user, $cfg->db->password, $options);
	} catch (Exception $e) {
		error_log($e->getMessage(), 0);
		exit("Connect failed: ".$e->getMessage());
		exit();
	}

	unset($options);
}
