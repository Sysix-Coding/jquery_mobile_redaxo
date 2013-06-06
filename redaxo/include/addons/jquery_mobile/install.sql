CREATE TABLE IF NOT EXISTS `%TABLE_PREFIX%888_jquery_mobile` (
  `id` int(11) NOT NULL auto_increment,
  `navigation` varchar(10) NOT NULL,
  `jquery-core` int(1) NOT NULL,
  `jquery-mobile` int(1) NOT NULL,
  `default-thema` varchar(1) NOT NULL,
  `navi-scroll` int(1) NOT NULL,
  `navi-thema` varchar(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

INSERT INTO `%TABLE_PREFIX%888_jquery_mobile` (`id`, `navigation`, `jquery-core`, `jquery-mobile`) VALUES (1,'',0,0);

CREATE TABLE IF NOT EXISTS `%TABLE_PREFIX%888_jquery_mobile_navi` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `icon` varchar(10) NOT NULL,
  `link` varchar(10) NOT NULL,
  `status` int(1) NOT NULL,
  `prio` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;