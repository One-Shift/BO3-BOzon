<?php

/**
* HTTPS redirect
* If https is defined as the main system protocol, forces the page to load it
*
* @author 	Carlos Santos
* @version 0.1
* @since 2016-10
*/

if ($cfg->system->protocol == "https") {
	if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
		$redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: ' . $redirect);
		exit();
	}
}
