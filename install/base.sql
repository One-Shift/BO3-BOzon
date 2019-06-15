CREATE TABLE `os_modules` (
	`id` int(11) NOT NULL,
	`name` varchar(255) NOT NULL,
	`folder` varchar(255) NOT NULL,
	`code` text NOT NULL,
	`sort` int(11) NOT NULL DEFAULT '0',
	`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

CREATE TABLE `os_9_users` (
	`id` int(11) NOT NULL,
	`username` varchar(255) DEFAULT NULL,
	`password` varchar(255) DEFAULT NULL,
	`rank` enum('owner','manager','member') DEFAULT 'member',
	`email` varchar(255) DEFAULT NULL,
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
	ADD UNIQUE KEY `name` (`username`),
	ADD UNIQUE KEY `email` (`email`),
	ADD KEY `fk_prefix_users_prefix_products1` (`id`),
	ADD KEY `fk_prefix_users_prefix_articles1` (`id`);

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
	ADD PRIMARY KEY (`id`),
	ADD UNIQUE KEY `folder` (`folder`);

ALTER TABLE `os_modules`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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

ALTER TABLE `os_history`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `os_trash`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


INSERT INTO `os_modules` (`name`, `folder`, `code`, `sort`) VALUES
('Home', 'mod-5-home', '{\r\n	\"fa-icon\": \"fa-home\",\r\n	\"img\": \"\",\r\n	\"sub-items\": {},\r\n\"sidebar\": true,\r\n\"dropdown\": false\r\n}', 0),
('Account', 'mod-6-account', '{\r\n	\"fa-icon\": \"fa-user-cog\",\r\n	\"img\": \"\",\r\n	\"sub-items\": {},\r\n\"sidebar\": false,\r\n\"dropdown\": true\r\n}', 1),
('Users', 'mod-9-users', '{\"fa-icon\":\"fa-users\",\"img\":\"\",\"sub-items\":{\"List\":{\"url\":\"\"},\"Add user\":{\"url\":\"add\"},\"Logs\":{\"url\":\"logs\"}},\"sidebar\":true,\"dropdown\":false}', 2),
('Files', 'mod-4-files', '{\r\n	\"fa-icon\": \"fa-file\",\r\n	\"img\": \"\",\r\n	\"sub-items\": {},\r\n\"sidebar\": true,\r\n\"dropdown\": false\r\n}', 3);

COMMIT;
