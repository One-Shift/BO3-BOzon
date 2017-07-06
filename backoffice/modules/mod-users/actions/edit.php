<?php
$form_tpl = functions::mdl_load("templates-e/edit/form.tpl");
$message_tpl = functions::mdl_load("templates-e/message.tpl");
$user = new user();

/*FILLS USER INFO ON THE LEFT SIDE MENU - BEGINS*/
$user->setId($id);

$userData = $user->returnOneUser();

if ($userData->rank == "owner") {
	$rank = "Owner";
	$ownerSelected = "selected";
} else if ($userData->rank == "manager") {
	$rank = "Manager";
	$managerSelected = "selected";
} else {
	$rank = "Member";
	$memberSelected = "selected";
}

/*FILLS USER INFO ON THE LEFT SIDE MENU - ENDS*/

/*USER CHANGES - BEGINS*/

if (isset($_POST["save"]))/*Verifies if "save" button was clicked*/ {
	if ($_POST["inputName"] != null || $_POST["inputEmail"] != null || $_POST["inputNewpass"] != null || $_POST["inputCode"] != null) {
		if (!isset($_POST["inputStatus"]) || empty($_POST["inputStatus"])) {
			$_POST["inputStatus"] = "0";
		}

		$user->setUsername($_POST["inputName"]);
		$user->setEmail($_POST["inputEmail"]);
		$user->setRank(strtolower($_POST['inputRank']));
		$user->setCode($_POST["inputCode"]);
		$user->setStatus($_POST["inputStatus"]);
		$user->setUserKey($userData->user_key);
		$user->setDate($userData->date);
		$user->setDateUpdate();
		$user->setOldPassword($userData->password);

		if ($user->update()) {
			$userData = $user->returnOneUser();

			$returnMessage = functions::c2r(
				[
					"message-type" => "success",
					"lg-message" => $mdl_lang["edit"]["success"]
				],
				$message_tpl
			);
		} else {
			$returnMessage = functions::c2r(
				[
					"message-type" => "danger",
					"lg-message" => $mdl_lang["edit"]["fail"]
				],
				$message_tpl
			);
		}
	}

/*PASSWORD*/

	if (isset($_POST["inputNewpass"]) && !empty($_POST["inputNewpass"])) {
		if (isset($_POST["inputConfirm"]) && !empty($_POST["inputConfirm"]) && $_POST["inputConfirm"] == $_POST["inputNewpass"]) {
			$user->setPassword($_POST["inputNewpass"]);
		} else {
			$returnMessage = functions::c2r(
				[
					"message-type" => "danger",
					"lg-message" => $mdl_lang["edit"]["no-match"]
				],
				$message_tpl
			);
		}
	}
}/*Verifies if "save" button was clicked - end*/

/*USER CHANGES - ENDS*/
$form = functions::c2r(
	[
		"lg-name" => $mdl_lang["edit"]["name"],
		"lg-email" => $mdl_lang["edit"]["email"],
		"lg-newpass" => $mdl_lang["edit"]["new_pass"],
		"lg-confirm" => $mdl_lang["edit"]["confirm"],
		"lg-rank" => $mdl_lang["edit"]["rank"],
		"lg-owner" => $mdl_lang["edit"]["owner"],
		"lg-manager" => $mdl_lang["edit"]["manager"],
		"lg-member" => $mdl_lang["edit"]["member"],
		"lg-code" => $mdl_lang["edit"]["code"],
		"lg-status" => $mdl_lang["edit"]["status"],
		"btn-save" => $mdl_lang["edit"]["save"],

		"owner-selected" => (isset($ownerSelected)) ? $ownerSelected : "",
		"manager-selected" => (isset($managerSelected)) ? $managerSelected : "",
		"member-selected" => (isset($memberSelected)) ? $memberSelected : "",

		"username" => $userData->username,
		"email" => $userData->email,
		"code" => $userData->code,
		"status-checked" => ($userData->status) ? "checked" : ""
	],
	$form_tpl
);

$mdl = functions::c2r(
	[
		"return-message" => (isset($returnMessage)) ? $returnMessage : "",
		"user-id" => $id,
		"lg-sure" => $mdl_lang["edit"]["sure"],
		"lg-remove" => $mdl_lang["edit"]["remove"],
		"edituser-form" => $form,
		"lg-check-remove" => $mdl_lang["edit"]["sure"],
		"md5-mail" => md5($userData->email),
		"username" => $userData->username,
		"email" => $userData->email,
		"rank" => $userData->rank,
		"code" => $userData->code
	],
	functions::mdl_load("templates/edit.tpl")
);

include "pages/module-core.php";
