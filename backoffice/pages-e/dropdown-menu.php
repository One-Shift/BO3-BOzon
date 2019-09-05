<?php

$menu_item_tpl = bo3::loade("dropdown-menu/item.tpl");

$menu_fa_icon_tpl = bo3::loade("dropdown-menu/icon.tpl");
$menu_img_tpl = bo3::loade("dropdown-menu/img.tpl");

$dropdown_menu = "";
$installed_modules = [];

// installed modules
$query = sprintf("SELECT * FROM %s_modules ORDER BY %s", $cfg->db->prefix, "sort ASC");

$source = $db->query($query);

while ($data = $source->fetch_object()) {
	array_push($installed_modules, $data->folder);

	$tmp_name = substr($data->folder, 4);
	$code = json_decode($data->code);

	if(isset($code->{"dropdown"}) && $code->{"dropdown"} == TRUE) {
		// ICON
		if (isset($code->img) && !empty($code->img)) {
			$icon = bo3::c2r([
				'module-folder' => $data->folder,
				'img' => $code->img
			], $menu_img_tpl);
		} else {
			$icon = bo3::c2r([
				'module-folder' => $data->folder,
				'icon' => (isset($code->{"fa-icon"}) && !empty($code->icon)) ? $code->icon : "fa-folder"
			], $menu_fa_icon_tpl);
		}

		$dropdown_menu .= bo3::c2r([
			"mod" => $tmp_name,
			"name" => $data->name,
			"icon" => $icon
		], $menu_item_tpl);
	}
}
