<?php

if (is_dir("./backoffice") != FALSE) {
	$classes_folder = "./backoffice";
} else {
	$classes_folder = ".";
}

if (file_exists("{$classes_folder}/class/PHPMailer/class.phpmailer.php")) {
	include "{$classes_folder}/class/PHPMailer/class.phpmailer.php";
}
