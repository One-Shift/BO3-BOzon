<?php

/**
 * @var stdClass $cfg
 * @var mysqli $db
 * @var stdClass $authData
 * @var array $lang
 * @var array $mdl_lang
 * @var string $lg_s
 * @var int $lg
 * @var string $pg
 * @var int $id
 * @var string $a
 */

$menu_item_tpl = bo3::loade("menu/item.tpl");

$menu_fa_icon_tpl = bo3::loade("menu/fa-icon.tpl");
$menu_img_tpl = bo3::loade("menu/img.tpl");

$menu_sub_item_tpl = bo3::loade("menu/sub-item.tpl");
$menu_item_w_sub_items_tpl = bo3::loade("menu/item-w-sub-items.tpl");

$menu = "";
$not_installed_menu = "";
$installed_modules = [];

# installed modules
$query = sprintf(
	"SELECT m.id, m.folder, m.code, m.img, m.icon, m.sidebar, ml.name, ml.link_title FROM %s_modules m 
	INNER JOIN %s_modules_lang ml ON m.id = ml.module_id 
	WHERE ml.lang_id = %d AND ml.module_type = '%s' ORDER BY %s",
	$cfg->db->prefix,
	$cfg->db->prefix,
	$lg,
	"main",
	"sort ASC"
);

$source = $db->query($query);

if ($source->num_rows > 0) {
	while($module = $source->fetch_object()) {
		array_push($installed_modules, $module->folder);

		if($module->sidebar) {
			$tmp_name = substr($module->folder, 4);

			# Sub-items
			$query = sprintf(
				"SELECT mm.id, mm.link, ml.name, ml.link_title FROM %s_modules_submenu mm
				INNER JOIN %s_modules_lang ml ON mm.name = ml.codename 
				WHERE  ml.module_type = '%s' AND ml.module_id = %d AND ml.lang_id = '%s'",
				$cfg->db->prefix,
				$cfg->db->prefix,
				'sub',
				$module->id,
				$lg
			);

			$source_sub = $db->query($query);

			if($source_sub->num_rows > 0) {
				$submenu = "";
	
				while($submenu_item = $source_sub->fetch_object()) {
	
					$submenu .= bo3::c2r([
						"url" => $submenu_item->link,
						"name" => $submenu_item->name,
						"title" => $submenu_item->link_title,
						"mod-name" => $module->folder
					], $menu_sub_item_tpl);
	
				}
			}
		
			# ICON
			if (isset($module->img) && !empty($module->img)) {
				$icon = bo3::c2r([
					'module-folder' => $module->folder,
					'img' => $module->img
				], $menu_img_tpl);
			} else {
				$icon = bo3::c2r([
					'module-folder' => $module->folder,
					'fa' => (isset($module->icon) && !empty($module->icon)) ? $module->icon : "fa-folder"
				], $menu_fa_icon_tpl);
			}
		
			$menu .= bo3::c2r([
				"sub-menu" => (isset($submenu)) ? $submenu : "",
				"mod" => $tmp_name,
				"name" => $module->name,
				"title" => $module->link_title,
				"icon" => $icon
			], (!isset($submenu)) ? $menu_item_tpl : $menu_item_w_sub_items_tpl);
		
			unset($submenu);
		}
	}
}

# show not installed modules if user has owner tag
if (c9_user::isOwner($authData)) {
	# modules not installed
	$list = glob('modules/mod-*', GLOB_ONLYDIR);

	$icon = bo3::c2r(['fa' => "fa-folder"], $menu_fa_icon_tpl);

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
