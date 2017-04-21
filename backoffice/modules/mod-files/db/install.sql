INSERT INTO `{c2r-prefix}_modules` (`folder`, `sort`) VALUES ("{c2r-mod-folder}", 0);

CREATE TABLE IF NOT EXISTS `{c2r-prefix}_files` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
