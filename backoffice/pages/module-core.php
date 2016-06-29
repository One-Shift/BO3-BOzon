<?php

$page_tpl = file_get_contents("templates/home.html");

include "pages-e/header.php";
include "pages-e/footer.php";
include "pages-e/menu.php";

if (user::isOwner($authData) && empty($a) && count($cfg->mod->dbTables) > 0 && $cfg->mod->install == TRUE) {
	$uninstall = str_replace(
		[
			"{c2r-lg-title}",
			"{c2r-lg-question}",
			"{c2r-lg-uninstall}",
			"{c2r-lg-close}",
		],
		[
			$lang["uninstall"]["modal-title"],
			$lang["uninstall"]["modal-question"],
			$lang["uninstall"]["modal-button"],
			$lang["uninstall"]["modal-close"],
		],
		file_get_contents("templates-e/module-core/uninstall.html")
	);
} else {
	$uninstall = null;
}

/* last thing */
$tpl = str_replace(
	[
		"{c2r-header}",
		"{c2r-footer}",

        "{c2r-menu}",
        "{c2r-avatar}",
        "{c2r-background}",

        "{c2r-breadcrump}",
        "{c2r-module-name}",
        "{c2r-module}",

		"{c2r-uninstall}",

		"{c2r-path-module}"
	],
	[
		$header,
		$footer,

        (isset($menu)) ? $menu : null,
        md5($authData["email"]),
        file_get_contents("http://api.nexus-pt.eu/bo2-image-server/"),

        (isset($breadcrump)) ? $breadcrump : null,
		$cfg->mod->name,
        (isset($module)) ? $module : null,

		$uninstall,

		str_replace("mod-" , null, $cfg->mod->folder)
	],
	$page_tpl
);
