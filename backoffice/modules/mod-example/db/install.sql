INSERT INTO `{c2r-prefix}_modules` (`folder`, `sort`) VALUES ("{c2r-mod-folder}", 0);

CREATE TABLE IF NOT EXISTS `{c2r-prefix}_example` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_1` varchar(255) NOT NULL,
  `f_2` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
