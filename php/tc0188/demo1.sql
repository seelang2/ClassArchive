# HeidiSQL Dump 
#
# --------------------------------------------------------
# Host:                 localhost
# Database:             demo1
# Server version:       5.0.16
# Server OS:            Win32
# Target-Compatibility: MySQL 4.0
# Extended INSERTs:     Y
# max_allowed_packet:   1048576
# HeidiSQL version:     3.0 Revision: 572
# --------------------------------------------------------

/*!40100 SET CHARACTER SET latin1*/;


#
# Database structure for database 'demo1'
#

DROP DATABASE IF EXISTS `demo1`;
CREATE DATABASE `demo1` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `demo1`;


#
# Table structure for table 'followups'
#

CREATE TABLE `followups` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned default NULL,
  `ticket_id` int(10) unsigned default NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  `followup_entry` mediumtext,
  KEY `id` (`id`,`user_id`,`ticket_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



#
# Dumping data for table 'followups'
#

/*!40000 ALTER TABLE `followups` DISABLE KEYS*/;
LOCK TABLES `followups` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `followups` ENABLE KEYS*/;


#
# Table structure for table 'support_types'
#

CREATE TABLE `support_types` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



#
# Dumping data for table 'support_types'
#

/*!40000 ALTER TABLE `support_types` DISABLE KEYS*/;
LOCK TABLES `support_types` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `support_types` ENABLE KEYS*/;


#
# Table structure for table 'tickets'
#

CREATE TABLE `tickets` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `owner_id` int(10) unsigned default NULL,
  `support_type_id` int(10) unsigned default NULL,
  `status` tinyint(3) unsigned default NULL,
  `subject` mediumtext,
  PRIMARY KEY  (`id`),
  KEY `owner_id` (`owner_id`,`support_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



#
# Dumping data for table 'tickets'
#

/*!40000 ALTER TABLE `tickets` DISABLE KEYS*/;
LOCK TABLES `tickets` WRITE;
UNLOCK TABLES;
/*!40000 ALTER TABLE `tickets` ENABLE KEYS*/;


#
# Table structure for table 'users'
#

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(20) default NULL,
  `email` varchar(60) default NULL,
  `password` varchar(10) default NULL,
  `permissions` tinyint(3) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;



#
# Dumping data for table 'users'
#

/*!40000 ALTER TABLE `users` DISABLE KEYS*/;
LOCK TABLES `users` WRITE;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `permissions`) VALUES ('1','Admin','admin@mydomain.com','password',10);
UNLOCK TABLES;
/*!40000 ALTER TABLE `users` ENABLE KEYS*/;
