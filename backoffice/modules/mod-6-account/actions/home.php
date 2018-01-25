<?php

$message_tpl = bo3::mdl_load("templates-e/message.tpl");

if (isset($_POST["submit"])) {

	$returnMessage = null;

	$user = new user();
	$user->setId($authData["id"]);

	// Email Confirmation
	if (isset($_POST["email"]) && !empty($_POST["email"])) {
		if ($_POST["email"] == $_POST["checkemail"]) {
			$user->setEmail($_POST["email"]);
			$email_success = true;
		} else {
			$returnMessage .= bo3::c2r([
				"lg-message" => $mdl_lang["email"]["check_failure"]
			], $message_tpl);
		}
	} else {
		$user->setEmail($authData["email"]);
		$email_success = true;
	}

	// Password Confirmation
	if (!empty($_POST["oldPassword"])) {
		if(user::getSecurePassword($_POST["oldPassword"]) == $authData["password"]) {
			if(!empty($_POST["newPassword"])) {
				if($_POST["newPassword"] == $_POST["checkPassword"]){
					$user->setPassword($_POST["newPassword"]);
					$pw_success = true;
				}else {
					$returnMessage = bo3::c2r([
						"message-type" => "danger",
						"lg-message" => $mdl_lang["password"]["check_pw_failure"]
					], $message_tpl);
				}
			} else {
				$returnMessage = bo3::c2r([
					"message-type" => "danger",
					"lg-message" => $mdl_lang["password"]["empty"]
				], $message_tpl);
			}
		} else {
			$returnMessage = bo3::c2r([
				"message-type" => "danger",
				"lg-message" => $mdl_lang["password"]["old_pw_failure"]
			], $message_tpl);
		}
	} else {
		$user->setOldPassword($authData["password"]);
		$pw_success = true;
	}

	if (isset($pw_success) && isset($email_success)) {
		$user->setUsername($authData["username"]);
		$user->setRank($authData["rank"]);
		$user->setCode($authData["code"]);
		$user->setStatus($authData["status"]);
		$user->setUserKey();
		$user->setDate($authData["date"]);
		$user->setDateUpdate();

		if ($user->update()) {
			$returnMessage = bo3::c2r([
				"message-type" => "sucess",
				"lg-message" => $mdl_lang["account"]["success"]
			], $message_tpl);

			$userData = $user->returnOneUser();

			$value = "{$authData["id"]}.{$userData->password}";

			setcookie (
				$cfg->system->cookie,
				$value,
				time() + (3600 * $cfg->system->cookie_time),
				(!empty($cfg->system->path_bo)) ? $cfg->system->path_bo : "/"
			);
		} else {
			$returnMessage = bo3::c2r([
				"message-type" => "danger",
				"lg-message" => sprintf($mdl_lang["account"]["failure"], $cfg->email->support)
			], $message_tpl);
		}
		//$user->insert()
	}
}

$mdl = bo3::c2r([
	"return-message" => (isset($returnMessage) && !empty($returnMessage)) ? $returnMessage : null,
	"lg-username" => $mdl_lang["account"]["username"],
	"username" => $authData["username"],
	"lg-email" => $mdl_lang["account"]["email"],
	"email" => $authData["email"],
	"lg-rank" => $mdl_lang["account"]["rank"],
	"rank" => $authData["rank"],
	"lg-date" => $mdl_lang["account"]["date"],
	"date" => $authData["date"],
	"lg-password" => $mdl_lang["account"]["password"],
	"lg-email-change" => $mdl_lang["account"]["email_change"],
	"lg-save" => $lang["common"]["save"],
	"lg-cancel" => $lang["common"]["cancel"],
	"md5-email" => md5($authData["email"])
], bo3::mdl_load("templates/home.tpl"));

include "pages/module-core.php";
