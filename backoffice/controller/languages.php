<?php

// version: 4

// languages verifier
$lg = null;
$lg_s = null;

// VERIFY GET DATA
if (isset($_GET["lg"]) && $_GET["lg"] != null) {
	// ITERATE FOR EVERY LANGUAGE ENTRY
	foreach ($cfg->lg as $index => $item) {
		// FOUND IT?
		if ($_GET["lg"] == $item[1]) {
			if ($item[0]) {
				$lg = $index;
				$lg_s = $item[1];
			} else {
				if (!empty($cfg->system->path)) {
					header("Location: {$cfg->system->path}/{$cfg->lg[1][1]}/");
				} else {
					header("Location: /{$cfg->lg[1][1]}/");
				}
				die();
			}
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
