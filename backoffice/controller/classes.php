<?php

if (is_dir("./backoffice") != FALSE) {
	$classes_folder = "./backoffice";
} else {
	$classes_folder = ".";
}

foreach (glob("{$classes_folder}/class/*.php") as $filename) {
	include $filename;
}
