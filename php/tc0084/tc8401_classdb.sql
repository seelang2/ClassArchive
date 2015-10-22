-- phpMyAdmin SQL Dump
-- version 2.9.0.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Mar 12, 2007 at 03:33 PM
-- Server version: 4.1.21
-- PHP Version: 4.4.2
-- 
-- Database: `tc8401_classdb`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `c_to_s`
-- 

DROP TABLE IF EXISTS `c_to_s`;
CREATE TABLE `c_to_s` (
  `id` int(11) NOT NULL default '0',
  `c_id` int(11) NOT NULL default '0',
  `s_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `c_id` (`c_id`,`s_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `c_to_s`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `contact`
-- 

DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `address` varchar(60) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `contact`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phones`
-- 

DROP TABLE IF EXISTS `phones`;
CREATE TABLE `phones` (
  `id` int(11) NOT NULL default '0',
  `c_id` int(11) NOT NULL default '0',
  `phone` varchar(13) NOT NULL default '',
  `type` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `c_id` (`c_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `phones`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `s_to_subs`
-- 

DROP TABLE IF EXISTS `s_to_subs`;
CREATE TABLE `s_to_subs` (
  `id` int(11) NOT NULL default '0',
  `parent_id` int(11) NOT NULL default '0',
  `child_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `parent_id` (`parent_id`,`child_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `s_to_subs`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `subs`
-- 

DROP TABLE IF EXISTS `subs`;
CREATE TABLE `subs` (
  `id` int(11) NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `subs`
-- 

