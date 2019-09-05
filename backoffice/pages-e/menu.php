<?php

$menu_item_tpl = bo3::loade("menu/item.tpl");

$menu_fa_icon_tpl = bo3::loade("menu/fa-icon.tpl");
$menu_img_tpl = bo3::loade("menu/img.tpl");

$menu_sub_item_tpl = bo3::loade("menu/sub-item.tpl");
$menu_item_w_sub_items_tpl = bo3::loade("menu/item-w-sub-items.tpl");

$menu = "";
$not_installed_menu = "";
$installed_modules = [];

// installed modules
$query = sprintf("SELECT * FROM %s_modules ORDER BY %s", $cfg->db->prefix, "sort ASC");

$source = $db->query($query);

while ($data = $source->fetch_object()) {
	array_push($installed_modules, $data->folder);

	$tmp_name = substr($data->folder, 4);
	$code = json_decode($data->code);

	if(isset($code->{"sidebar"}) && $code->{"sidebar"} == TRUE) {
		// SUB ITEMS
		if (isset($code->{"sub-items"}) && count((array)$code->{"sub-items"}) > 0) {
			$submenu = "";

			foreach ((array)$code->{"sub-items"} as $index => $obj) {
				$submenu .= bo3::c2r([
					"url" => $obj->url,
					"name" => $index
				], $menu_sub_item_tpl);
			}
		}

		// ICON
		if (isset($code->img) && !empty($code->img)) {
			$icon = bo3::c2r([
				'module-folder' => $data->folder,
				'img' => $code->img
			], $menu_img_tpl);
		} else {
			$icon = bo3::c2r([
				'module-folder' => $data->folder,
				'fa' => (isset($code->{"fa-icon"}) && !empty($code->{"fa-icon"})) ? $code->{"fa-icon"} : "fa-folder"
			], $menu_fa_icon_tpl);
		}

		$menu .= bo3::c2r([
			"sub-menu" => (isset($submenu)) ? $submenu : "",
			"mod" => $tmp_name,
			"name" => $data->name,
			"icon" => $icon
		], (!isset($submenu)) ? $menu_item_tpl : $menu_item_w_sub_items_tpl);

		unset($submenu);
	}
}

// show not installed modules if user has owner tag
if (c9_user::isOwner($authData)) {
	// modules not installed
	$list = glob('modules/mod-*', GLOB_ONLYDIR);

	$icon = bo3::c2r([
		'fa' => "fa-folder"
	], $menu_fa_icon_tpl);

	foreach ($list as $key => $value) {
		$path_explode = explode("/", $value);
		$folder = $path_explode[count($path_explode) - 1];
		$path_explode[count($path_explode) - 1] = explode("-", $path_explode[count($path_explode) - 1]);

		$tmp_name = substr($folder, 4);

		if (!in_array($folder, $installed_modules)) {
			$not_installed_menu .= bo3::c2r([
				"mod" => $tmp_name,
				"name" => ucwords(str_replace("-", " ", $tmp_name)),
				"icon" => $icon
			], $menu_item_tpl);
		}
	}

	// add not installed modules if aren't empty
	if (isset($not_installed_menu) && !empty($not_installed_menu)) {
		$menu .= bo3::c2r(["title" => $lang["menu"]["notInstalled"]], bo3::loade("menu/title-notinstalled.tpl"));

		$menu .= $not_installed_menu;
	}
}
