<?php

$cfg->db = new stdClass();

$cfg->db->connect = true;
$cfg->db->host = "localhost";
$cfg->db->user = "user";
$cfg->db->password = "user";
$cfg->db->database = "nsfw";
$cfg->db->prefix = "os";

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
