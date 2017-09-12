<?php
$user = new user();

if (isset($_POST["inputRemove"])) {
	$user->setId($id);
	if ($user->delete()) {
		$remove_message = $mdl_lang["remove"]["message-success"];
		header( "refresh:3;url={$cfg->system->path_bo}/0/{$lg_s}/users/" );
	} else {
		$remove_message = $mdl_lang["remove"]["message-insuccess"];
	}

	$mdl = bo3::c2r(["removed-message" => $remove_message], bo3::mdl_load("templates/remove.tpl"));
}

include "pages/module-core.php";
