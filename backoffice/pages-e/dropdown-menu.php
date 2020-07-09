<?php

$menu_item_tpl = bo3::loade("dropdown-menu/item.tpl");

$menu_fa_icon_tpl = bo3::loade("dropdown-menu/icon.tpl");
$menu_img_tpl = bo3::loade("dropdown-menu/img.tpl");

$dropdown_menu = "";
$installed_modules = [];

$source = $db->query(sprintf(
	"SELECT m.id, m.folder, m.code, m.img, m.icon, m.sidebar, ml.name, ml.link_title FROM %s_modules m 
	INNER JOIN %s_modules_lang ml ON m.id = ml.module_id WHERE ml.lang_id = %d AND m.dropdown = %d AND ml.module_type = '%s' ORDER BY %s",
	$cfg->db->prefix,
	$cfg->db->prefix,
	$lg,
	1,
	"main",
	"sort ASC"
));

if($source->num_rows > 0) {
	while($module = $source->fetch_object()) {
		$tmp_name = substr($module->folder, 4);

		// ICON
		if (isset($module->img) && !empty($module->img)) {
			$icon = bo3::c2r([
				'module-folder' => $module->folder,
				'img' => $module->img
			], $menu_img_tpl);
		} else {
			$icon = bo3::c2r([
				'module-folder' => $module->folder,
				'icon' => (isset($module->icon) && !empty($module->icon)) ? $module->icon : "fa-folder"
			], $menu_fa_icon_tpl);
		}

		$dropdown_menu .= bo3::c2r([
			"mod" => $tmp_name,
			"name" => $module->name,
			"icon" => $icon
		], $menu_item_tpl);
	}
}
