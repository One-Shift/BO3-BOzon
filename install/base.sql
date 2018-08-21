CREATE TABLE `os_articles` (
	`id` int(11) NOT NULL,
	`code` text NOT NULL,
	`category_id` int(11) NOT NULL,
	`user_id` int(11) NOT NULL,
	`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`date_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `os_articles_lang` (
	`id` int(11) NOT NULL,
	`article_id` int(11) NOT NULL,
	`lang_id` int(11) NOT NULL,
	`title` varchar(255) NOT NULL,
	`text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `os_categories` (
	`id` int(11) NOT NULL,
	`parent_id` int(11) NOT NULL,
	`category_section` varchar(255) NOT NULL,
	`code` text NOT NULL,
	`sort` int(11) NOT NULL,
	`user_id` int(11) NOT NULL,
	`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`date_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `os_categories_lang` (
	`id` int(11) NOT NULL,
	`category_id` int(11) NOT NULL,
	`lang_id` int(11) NOT NULL,
	`title` varchar(255) NOT NULL,
	`text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `os_files` (
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `os_history` (
	`id` int(11) NOT NULL,
	`module` varchar(255) DEFAULT NULL,
	`user_id` int(11) DEFAULT NULL,
	`description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `os_modules` (
	`id` int(11) NOT NULL,
	`name` varchar(255) NOT NULL,
	`folder` varchar(255) NOT NULL,
	`code` text NOT NULL,
	`sort` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `os_trash` (
	`id` int(11) NOT NULL,
	`module` varchar(255) NOT NULL,
	`code` text NOT NULL,
	`user_id` int(11) NOT NULL,
	`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `os_log` (
	`id` int(11) NOT NULL,
	`user_id` int(11) NOT NULL,
	`ip` text CHARACTER SET utf8 NOT NULL,
	`code` text CHARACTER SET utf8 NOT NULL,
	`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `os_users` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `os_users_fields` (
	`id` int(11) NOT NULL,
	`name` text CHARACTER SET utf8 NOT NULL,
	`value` text CHARACTER SET utf8 NOT NULL,
	`type` text CHARACTER SET utf8 NOT NULL,
	`required` tinyint(1) NOT NULL DEFAULT '0',
	`sort` int(11) NOT NULL,
	`status` tinyint(1) NOT NULL DEFAULT '0',
	`date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`date_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `os_articles`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `os_articles_lang`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `os_categories`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `os_categories_lang`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `os_files`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `os_history`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `os_modules`
	ADD PRIMARY KEY (`id`),
	ADD UNIQUE KEY `folder` (`folder`);

ALTER TABLE `os_trash`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `os_log`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `os_users`
	ADD PRIMARY KEY (`id`),
	ADD UNIQUE KEY `name` (`username`),
	ADD UNIQUE KEY `email` (`email`),
	ADD KEY `fk_prefix_users_prefix_products1` (`id`),
	ADD KEY `fk_prefix_users_prefix_articles1` (`id`);

ALTER TABLE `os_users_fields`
	ADD PRIMARY KEY (`id`);

ALTER TABLE `os_articles`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `os_articles_lang`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `os_categories`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `os_categories_lang`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `os_files`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `os_history`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `os_modules`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `os_trash`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `os_users`
	MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

INSERT INTO `os_modules` (`id`, `name`, `folder`, `code`, `sort`) VALUES
(1, 'Home', 'mod-5-home', '{\r\n	\"fa-icon\": \"fa-home\",\r\n	\"img\": \"\",\r\n	\"sub-items\": {},\r\n\"sidebar\": true,\r\n\"dropdown\": false\r\n}', 0),
(2, 'Account', 'mod-6-account', '{\r\n	\"fa-icon\": \"fa-user-cog\",\r\n	\"img\": \"\",\r\n	\"sub-items\": {},\r\n\"sidebar\": false,\r\n\"dropdown\": true\r\n}', 1),
(3, 'Users', 'mod-9-users', '{\r\n	\"fa-icon\": \"fa-users\",\r\n	\"img\": \"\",\r\n	\"sub-items\": {\r\n		\"List\": {\r\n			\"url\": \"\"\r\n		},\r\n		\"Add user\": {\r\n			\"url\": \"add\"\r\n		},\r\n\"Logs\": {\r\n			\"url\": \"logs\"\r\n		}\r\n	},\r\n\"sidebar\": true,\r\n\"dropdown\": false\r\n}', 2),
(4, 'Categories', 'mod-8-categories', '{\r\n	\"fa-icon\": \"fa-list\",\r\n	\"img\": \"\",\r\n	\"sub-items\": {\r\n		\"List\": {\r\n			\"url\": \"\"\r\n		},\r\n		\"Add category\": {\r\n			\"url\": \"add\"\r\n		}\r\n	},\r\n\"sidebar\": true,\r\n\"dropdown\": false\r\n}', 3),
(5, 'Articles', 'mod-7-articles', '{\r\n	\"fa-icon\": \"fa-newspaper\",\r\n	\"img\": \"\",\r\n	\"sub-items\": {\r\n		\"List\": {\r\n			\"url\": \"\"\r\n		},\r\n		\"Add Article\": {\r\n			\"url\": \"add\"\r\n		}\r\n	},\r\n\"sidebar\": true,\r\n\"dropdown\": false\r\n}', 4),
(6, 'Files', 'mod-4-files', '{\r\n	\"fa-icon\": \"fa-file\",\r\n	\"img\": \"\",\r\n	\"sub-items\": {},\r\n\"sidebar\": true,\r\n\"dropdown\": false\r\n}', 5);
