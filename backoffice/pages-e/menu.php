<?php

$menu_item_tpl = functions::loade("menu/item.tpl");

$menu = "";
$not_installed_menu = "";
$installed_modules = [];

// installed modules
$query = sprintf(
	"SELECT * FROM %s_modules ORDER BY %s",
	$cfg->db->prefix,
	"sort ASC"
);

$source = $mysqli->query($query);

while ($data = $source->fetch_object()) {
	array_push($installed_modules, $data->folder);

	$tmp_name = explode("-", $data->folder);

	$menu .= functions::c2r(
		[
			"mod" => $tmp_name[count($tmp_name) - 1],
			"name" => $data->name
		],
		$menu_item_tpl
	);
}

// show not installed modules if user has owner tag
if (user::isOwner($authData)) {
	// modules not installed
	$list = glob('modules/mod-*', GLOB_ONLYDIR);

	foreach ($list as $key => $value) {
		$tmp = explode("/", $value);
		$folder = $tmp[count($tmp) - 1];
		$tmp_name = explode("-", $folder);

		if (!in_array($folder, $installed_modules)) {
			$not_installed_menu .= functions::c2r(
				[
					"mod" => $tmp_name[count($tmp_name) - 1],
					"name" => $tmp_name[count($tmp_name) - 1]
				],
				$menu_item_tpl
			);
		}
	}

	// add not installed modules if aren't empty
	if (isset($not_installed_menu) && !empty($not_installed_menu)) {
		$menu .= functions::c2r(["title" => $lang["menu"]["notInstalled"]], functions::loade("menu/title-notinstalled.tpl"));
		
		$menu .= $not_installed_menu;
	}
}
