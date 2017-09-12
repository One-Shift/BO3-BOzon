<?php

$cfg->db = new stdClass();

$cfg->db->connect = false;
$cfg->db->host = "127.0.0.1";
$cfg->db->user = "username";
$cfg->db->password = "password";
$cfg->db->database = "database_name";
$cfg->db->prefix = "prefix";

if ($cfg->db->connect) {
	$mysqli = mysqli_connect(
		$cfg->db->host,
		$cfg->db->user,
		$cfg->db->password,
		$cfg->db->database
	);

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	$mysqli->set_charset("utf8");
}
