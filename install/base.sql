CREATE TABLE `os_modules` (
	`id` int(11) NOT NULL,
	`name` varchar(255) NOT NULL,
	`folder` varchar(255) NOT NULL,
	`code` text NOT NULL,
	`icon` varchar(255) CHARACTER SET utf8 NOT NULL,
	`img` varchar(255) CHARACTER SET utf8 NOT NULL,
	`dropdown` tinyint(1) NOT NULL DEFAULT 0,
	`sidebar` tinyint(1) NOT NULL DEFAULT 0,
	`sort` int(11) NOT NULL DEFAULT 0,
	`date` datetime NOT NULL DEFULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE `os_modules_lang` (
	`id` int(11) NOT NULL,
	`codename` varchar(255) NOT NULL,
	`name` varchar(255) NOT NULL,
	`link_title` varchar(255) NOT NULL,
	`lang_id` int(11) NOT NULL,
	`module_id` int(11) NOT NULL,
	`module_type` enum('main','sub') DEFAULT NULL,
	`date` datetime NOT NULL DEFAULT current_timestamp(),
	`date_update` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `os_modules_submenu` (
	`id` int(11) NOT NULL,
	`name` varchar(255) NOT NULL,
	`link` varchar(255) NOT NULL,
	`module_ass` int(11) NOT NULL,
	`status` tinyint(1) NOT NULL DEFAULT 0,
	`date` datetime NOT NULL DEFAULT current_timestamp(),
	`date_update` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `os_9_users` (
	`id` int(11) NOT NULL,
	`username` varchar(250) DEFAULT NULL,
	`password` varchar(250) DEFAULT NULL,
	`rank` enum('owner','manager','member') DEFAULT 'member',
	`email` varchar(250) DEFAULT NULL,
	`code` text,
	`custom_css` text NOT NULL,
	`user_key` text,
	`status` tinyint(1) NOT NULL DEFAULT '0',
	`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`date_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE `os_9_users_fields` (
	`id` int(11) NOT NULL,
	`name` text NOT NULL,
	`value` text NOT NULL,
	`type` text NOT NULL,
	`required` tinyint(1) NOT NULL DEFAULT '0',
	`sort` int(11) NOT NULL,
	`status` tinyint(1) NOT NULL DEFAULT '0',
	`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`date_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

ALTER TABLE `os_9_users`
	ADD PRIMARY KEY (`id`),
	ADD UNIQUE KEY `username` (`username`),
	ADD UNIQUE KEY `email` (`email`);

CREATE TABLE `os_4_files` (
	`id` int(11) NOT NULL,
	`file` varchar(255) NOT NULL,
	`type` varchar(255) NOT NULL,
	`module` varchar(255) NOT NULL,
	`id_ass` int(11) NOT NULL,
	`description` varchar(255) NOT NULL,
	`code` text NOT NULL,
	`sort` int(11) NOT NULL,
	`user_id` int(11) NOT NULL,
	`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`date_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE `os_history` (
	`id` int(11) NOT NULL,
	`module` varchar(255) DEFAULT NULL,
	`user_id` int(11) DEFAULT NULL,
	`description` text,
	`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE `os_trash` (
	`id` int(11) NOT NULL,
	`module` varchar(255) NOT NULL,
	`code` text NOT NULL,
	`user_id` int(11) NOT NULL,
	`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

ALTER TABLE `os_modules`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `os_modules`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `os_9_users_fields`
 	ADD PRIMARY KEY (`id`);

ALTER TABLE `os_9_users`
 	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `os_9_users_fields`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `os_4_files`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `os_4_files`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `os_history`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `os_trash`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `os_modules`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `os_modules_lang`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `os_modules_submenu`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `os_history`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `os_trash`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `os_modules`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `os_modules_lang`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `os_modules_submenu`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `os_modules` (`id`, `name`, `folder`, `code`, `icon`,`img`, `dropdown`, `sidebar`,`sort`) VALUES
(1, 'Home', 'mod-5-home', '', 'fa-home', '', 0, 1, 0),
(2, 'Account', 'mod-6-account', '', 'fa-icon', '', 0, 1, 0),
(3, 'Users', 'mod-9-users', '', 'fa-icon', 0, 1, 0),
(4, 'Files', 'mod-4-files', '', 'fa-icon', 0, 1, 0);

INSERT INTO `os_modules_submenu` (`id`, `name`, `link`, `module_ass`, `status`) VALUES
(1, 'list-users', '', 3, 1),
(2, 'add-users', 'add', 3, 1),
(3, 'logs-users', 'logs', 3, 1)

INSERT INTO `os_modules_lang` (`id`, `codename`, `name`, `link_title`, `lang_id`, `module_id`, `module_type`) VALUES
(1, 'home', 'Ínicio', 'Dashboard Inicial', 1, 1, 'main'),
(2, 'home', 'Home', 'Home Dashboard', 2, 1, 'main'),
(3, 'account', 'Conta de utilizador', 'Ver perfil', 1, 2, 'main'),
(4, 'account', 'My Account', 'See my profile', 2, 2, 'main'),
(5, 'users', 'Utilizadores', 'Ver utilizadores', 1, 3, 'main'),
(6, 'users', 'Users', 'See system users', 2, 3, 'main'),
(7, 'list-users', 'Lista', 'Ver lista de utilizadores', 1, 3, 'sub'),
(8, 'list-users', 'List', 'See list', 2, 3, 'sub'),
(9, 'add-users', 'Adicionar', 'Adicionar Utilizador', 1, 3),
(10, 'add-users', 'Add', 'Add new user', 2, 3, 'sub'),
(11, 'logs-users', 'Logs', 'Logs de sistema', 1, 3, 'sub'),
(12, 'logs-users', 'Logs', 'See system logs', 2, 3, 'sub'),
(13, 'files', 'Ficheiros', 'Ver ficheiros', 1, 4, 'main'),
(14, 'files', 'Files', 'See files', 2, 4, 'main');

COMMIT;
