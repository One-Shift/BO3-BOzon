<?php
$item_tpl = bo3::mdl_load("templates-e/home/item.tpl");
/*----------------------------------------------------- FETCHING USER DATA FROM DATABASE - BEGINS -----------------------------------------------------*/

$user = new user();

$user_list=$user->returnAllUsers();
if (count($user_list) != 0) {
	foreach ($user_list as $user) {
		if (!isset($list)) {
			$list = "";
		}

		$list .= bo3::c2r(
			[
				"user-id" => $user->id,
				"md5-mail" => md5($user->email),
				"username" => $user->username,
				"email" => $user->email,
				"rank" => $user->rank,
				"status" => $user->status,
				"date" => $user->date
			],
			$item_tpl
		);
	}
}

/*----------------------------------------------------- FETCHING USER DATA FROM DATABASE - ENDS	 -----------------------------------------------------*/

$mdl = bo3::c2r(
	[
		"lg-add-btn" => $mdl_lang["list"]["add-btn"],
		"lg-gravatar-title" => $mdl_lang["list"]["gravatar-title"],
		"lg-username-title" => $mdl_lang["list"]["username-title"],
		"lg-email-title" => $mdl_lang["list"]["email-title"],
		"lg-rank-title" => $mdl_lang["list"]["rank-title"],
		"lg-status-title" => $mdl_lang["list"]["status-title"],
		"lg-date-title" => $mdl_lang["list"]["date-title"],
		"lg-action-title" => $mdl_lang["list"]["action-title"],
		"home-list" => (isset($list)) ? $list : "",
		"lg-edit" => $mdl_lang["list"]["edit"]
	],
	bo3::mdl_load("templates/home.tpl")
);

include "pages/module-core.php";
