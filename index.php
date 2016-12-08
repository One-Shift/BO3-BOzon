<?php

include "backoffice/config/cfg.php";
include "backoffice/config/database.php";
include "backoffice/config/email.php";
include "backoffice/config/languages.php";
include "backoffice/config/store.php";
include "backoffice/config/system.php";
include "backoffice/config/connect.php";

include "backoffice/controller/classes.php";
include "backoffice/controller/languages.php";
include "backoffice/controller/sessions.php";
include "backoffice/controller/pages.php";
include "backoffice/controller/actions.php";
include "backoffice/controller/id.php";

$head = functions::loade("head.tpl");

// page controller
$pg_file = sprintf("pages/%s.php", $pg);
if ($pg == null) {
	include "pages/home.php";
} else if ($pg == "404") {
	include "pages/404.php";
} else if (file_exists($pg_file)) {
	include $pg_file;
} else {
	include "pages/404.php";
}

// print website
$tpl = str_replace(
	[
		"{c2r-head}",
		"{c2r-sitename}",
		"{c2r-keywords}",
		"{c2r-description}",
		"{c2r-analytics}",
		"{c2r-path}",
		"{c2r-lg}"
	],
	[
		str_replace(
			[
				"{c2r-og-title}",
				"{c2r-og-url}",
				"{c2r-og-image}",
				"{c2r-og-description}",
				"{c2r-lib-jquery}",
				"{c2r-lib-bootstrap}",
				"{c2r-lib-fontawesome}"
			],
			[
				(isset($og["title"])) ? $og["title"] : $cfg->system->sitename,
				(isset($og["url"])) ? $og["url"] : "http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"],
				(isset($og["image"])) ? $og["image"] : "http://".$_SERVER["HTTP_HOST"].$cfg->system->path."/site-assets/default-share-image.jpg",
				(isset($og["description"])) ? $og["description"] : $lang["system"]["description"],
				file_get_contents("http://nexus-pt.github.io/BO3/jquery.html"),
				file_get_contents("http://nexus-pt.github.io/BO3/bootstrap.html"),
				file_get_contents("http://nexus-pt.github.io/BO3/fontawesome.html")
			],
			$head
		),
		$cfg->system->sitename,
		$lang["system"]["keywords"],
		$lang["system"]["description"],
		$cfg->system->analytics,
		$cfg->system->path,
		$lg_s
	],
	$tpl
);

// minify system
if ($cfg->system->minify) {
	print functions::minifyPage($tpl);
} else {
	print $tpl;
}
