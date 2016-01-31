DROP TABLE IF EXISTS `#__battles`;
CREATE TABLE `#__battles` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL COMMENT 'Название',
  `files1` varchar(30) NOT NULL,
  `files2` varchar(30) NOT NULL,
  `files3` varchar(30) NOT NULL,
  `zagol1` varchar(100) NOT NULL,
  `zagol2` varchar(100) NOT NULL,
  `zagol3` varchar(100) NOT NULL,
  `text1` text NOT NULL,
  `text2` text NOT NULL,
  `text3` text NOT NULL,
  `timestop` datetime NOT NULL,
  `published` smallint(1) NOT NULL COMMENT 'Статус',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=1 ;