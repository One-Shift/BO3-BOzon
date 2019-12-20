<?php

/**
* Language Controller
*
* @author 	Carlos Santos
* @version 0.4
* @since 2016-10
*/

// languages verifier
$lg = null; /** @var int */
$lg_s = null; /** @var string */

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
	// DEFAULT LANGUAGE
	$lg = 1;
	$lg_s = $cfg->lg[1][1];
}

// LANGUAGE LOADER
if (is_dir("languages/{$lg_s}")) {
	foreach (glob("languages/{$lg_s}/*.ini") as $filename) {
		$lang[basename($filename, ".ini")] = parse_ini_file($filename, true);
	}
} else {
	foreach (glob("languages/en/*.ini") as $filename) {
		$lang[basename($filename, ".ini")] = parse_ini_file($filename, true);
	}
}
