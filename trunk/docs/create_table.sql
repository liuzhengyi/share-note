DROP TABLE IF EXISTS `user_basic`;
CREATE TABLE `user_basic` (
  `user_id` smallint(5) unsigned NOT NULL auto_increment,
  `user_email` varchar(50) NOT NULL,
  `user_name` varchar(15) NOT NULL,
  `user_pass` char(40) NOT NULL,
  `reg_time` datetime NOT NULL,
  `school` varchar(30) NOT NULL,
  `major` varchar(30) NOT NULL,
  `entrance_year` year(4) NOT NULL,
  PRIMARY KEY  (`user_id`),
  UNIQUE KEY `user_email` (`user_email`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `user_var`;
CREATE TABLE `user_var` (
  `user_id` smallint(5) unsigned NOT NULL ,
  `login_ip` int(10) unsigned ,
  `up_amount` tinyint(3) unsigned NOT NULL default 0,
  `down_amount` smallint(5) unsigned NOT NULL default 0,
  `authority_score` int(11) NOT NULL default 0,
  `contribution_score` int(11) NOT NULL default 0,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `resource_basic`;
CREATE TABLE `resource_basic` (
  `res_id` int(5) unsigned NOT NULL auto_increment,
  `res_name` varchar(50) NOT NULL,
  `upl_time` datetime NOT NULL,
  `upl_user_id` int(5) unsigned NOT NULL,
  `res_size` int(11) NOT NULL,
  `res_course` varchar(30) NOT NULL,
  -- `type` varchar(30) NOT NULL,
  `type` enum('xxbj','jskj','fxtg','mnsj','wnzt') NOT NULL, 
  /* 学习笔记','教师课件','复习提纲','模拟试卷','往年真题' */
  `source` enum('nett', 'self', 'othe') NOT NULL,
  /*	网络，原创，其他	*/
  `url` varchar(100) ,
  `intro` varchar(300) NOT NULL,
  PRIMARY KEY  (`res_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `resource_var`;
CREATE TABLE `resource_var` (
  `res_id` int(5) unsigned NOT NULL auto_increment,
  `dow_times` smallint(5) unsigned NOT NULL,
  `path` varchar(256) NOT NULL,
  `level` enum('精品','普通') NOT NULL,
  `is_check` bool NOT NULL default FALSE,
  PRIMARY KEY  (`res_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `review`;
CREATE TABLE `review` (
  `rev_id` int unsigned NOT NULL auto_increment,
  `user_id` smallint(5) unsigned NOT NULL,
  `res_id` int unsigned NOT NULL,
  `rev_content` varchar(300) NOT NULL,
  `pro_amount` smallint unsigned NOT NULL,
  `con_amount` smallint unsigned NOT NULL,
  `pub_time` datetime NOT NULL,
  PRIMARY KEY  (`rev_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `download`;
CREATE TABLE `download` (
  `dow_id` bigint unsigned NOT NULL auto_increment,
  `dow_time` datetime NOT NULL,
  `user_id` smallint unsigned NOT NULL,
  `res_id` int unsigned NOT NULL,
  PRIMARY KEY  (`dow_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `vote`;
CREATE TABLE `vote` (
  `vote_id` bigint unsigned NOT NULL auto_increment,
  `user_id` smallint unsigned NOT NULL,
  `rev_id` int unsigned NOT NULL,
  `vote_value` enum('p', 'c') NOT NULL,
  PRIMARY KEY  (`vote_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

