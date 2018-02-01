INSERT INTO `{c2r-prefix}_modules` (`name`, `folder`, `code`, `sort`) VALUES ("{c2r-mod-name}", "{c2r-mod-folder}", '{\r\n  \"fa-icon\": \"fa-file\",\r\n  \"img\": \"\",\r\n  \"sub-items\": {}\r\n}', 0);

CREATE TABLE IF NOT EXISTS `{c2r-prefix}_4_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) NOT NULL,
  `module` varchar(255) NOT NULL,
  `id_ass` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `code` text NOT NULL,
  `sort` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `date_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
