<?php

function clean($string) {
	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	$string =  str_replace('--', '-', $string);
	return preg_replace('/[^A-Za-z0-9.\-]/', '', $string); // Removes special chars.
}

function upload($post, $files = []) {
	global $auth, $authData;

	$toReturn = [
		"status" => false,
		"message" => "",
		"object" => []
	];

	$clean_file_name = clean($files["name"]);
	$clean_file_name = date("Y-m-d-H-i-s-").$clean_file_name;
	$newFilePath = "../uploads/{$clean_file_name}";

	if (move_uploaded_file($files["tmp_name"], $newFilePath)) {
		$extension = pathinfo($files['name'], PATHINFO_EXTENSION);

		$file = new file();
		$file->setFile($clean_file_name);
		$file->setType((!in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])) ? 'doc' : 'img');
		$file->setModule((isset($post["module"])) ? $post["module"] : "");
		$file->setIdAss((isset($post["id"])) ? $post["id"] : "");
		$file->setDescription("");
		$file->setSort(0);
		$file->setUserId($authData['id']);

		$file->setDate();
		$file->setDateUpdate();

		if ($file->insert()) {
			$toReturn["status"] = true;
			array_push($toReturn["object"], $file->returnObject());
		}
	}

	return json_encode($toReturn);
}

function getList ($id, $module) {
	$toReturn = [
		"status" => false,
		"message" => "",
		"object" => []
	];

	$file = new file();
	$file->setIdAss($id);
	$file->setModule($module);
	$toReturn["object"] = $file->returnFilterList ();

	if (count($toReturn["object"]) > 0) {
		$toReturn["status"] = true;
	}

	return json_encode($toReturn);
}

function update ($id, $post) {
	$toReturn = [
		"status" => false,
		"message" => "",
		"object" => []
	];

	$file = new file();
	$file->setId($id);
	$file->setDescription($post["description"]);
	$file->setCode($post["code"]);
	$file->setSort($post["sort"]);
	$file->setDateUpdate();

	$toReturn["status"] = $file->simpleUpdate();

	return json_encode($toReturn);
}

function delete ($id) {
	$toReturn = [
		"status" => false,
		"message" => "",
		"object" => []
	];

	$file = new file();
	$file->setId($id);
	$toReturn["status"] = $file->delete();

	return json_encode($toReturn);
}

switch ($_GET["r"]) {
	case 'upload':
		$tpl = upload( $_POST, isset($_FILES["file"]) ? $_FILES["file"] : []);
		break;
	case 'getList':
		$tpl = getList($id, $_GET["module"]);
		break;
	case 'update':
		$tpl = update($id, $_POST);
		break;
	case 'delete':
		$tpl = delete($id);
		break;
	default:
		$tpl = "";
		break;
}
