<?php

// version: 2

// languages verifier
$lg = null;
$lg_s = null;

if (isset($_GET["lg"]) && $_GET["lg"] != null) {
	foreach ($cfg->lg as $index=>$item) {
		if ($_GET["lg"] == $item[1]) {
			$lg = $index;
			$lg_s = $item[1];
		}
	}
}

if ($lg == null || $lg_s == null) {
	// default language
	$lg = 1;
	$lg_s = $cfg->lg[1][1];
}

// languages loader
if (is_dir("languages/{$lg_s}")) {
	foreach (glob("languages/{$lg_s}/*.ini") as $filename) {
		$lang[basename($filename, ".ini")] = parse_ini_file($filename, true);
	}
} else {
	foreach (glob("languages/en/*.ini") as $filename) {
		$lang[basename($filename, ".ini")] = parse_ini_file($filename, true);
	}
}
