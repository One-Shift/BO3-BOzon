DELETE FROM `{c2r-prefix}_modules` WHERE `folder` = '{c2r-mod-folder}';

DROP TABLE IF EXISTS `{c2r-prefix}_articles`;
DROP TABLE IF EXISTS `{c2r-prefix}_articles_lang`;
