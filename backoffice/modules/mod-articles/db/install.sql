INSERT INTO `{c2r-prefix}_modules` (`name`, `folder`, `sort`) VALUES ('{c2r-mod-name}', '{c2r-mod-folder}', 0);

CREATE TABLE `{c2r-prefix}_articles` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`code` text NOT NULL,
	`category_id` int(11) NOT NULL,
	`user_id` int(11) NOT NULL,
	`date` datetime NOT NULL,
	`date_update` datetime NOT NULL,
	`published` tinyint(1) NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `{c2r-prefix}_articles_lang` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`article_id` int(11) NOT NULL,
	`lang_id` int(11) NOT NULL,
	`title` varchar(255) NOT NULL,
	`text` text NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
