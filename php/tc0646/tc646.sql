-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Feb 15, 2008 at 04:02 PM
-- Server version: 5.0.16
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `tc646`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `actions`
-- 

DROP TABLE IF EXISTS `actions`;
CREATE TABLE `actions` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `action_date` date NOT NULL,
  `time_taken` float NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `request_id` int(10) unsigned NOT NULL,
  `personnel_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `actions`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `action_types`
-- 

DROP TABLE IF EXISTS `action_types`;
CREATE TABLE `action_types` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `action_desc` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `action_types`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `departments`
-- 

DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` int(11) NOT NULL auto_increment,
  `dept_name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `departments`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `p2d`
-- 

DROP TABLE IF EXISTS `p2d`;
CREATE TABLE `p2d` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `personnel_id` int(10) unsigned NOT NULL,
  `dept_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `p2d` (`personnel_id`,`dept_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `p2d`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `parts`
-- 

DROP TABLE IF EXISTS `parts`;
CREATE TABLE `parts` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `part_name` varchar(50) NOT NULL,
  `part_num` varchar(15) default NULL,
  `make` varchar(15) default NULL,
  `model` varchar(15) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `parts`
-- 

INSERT INTO `parts` (`id`, `part_name`, `part_num`, `make`, `model`) VALUES 
(1, 'Test Part', 'XX-0000', 'Pontiac', 'Widget01'),
(2, 'Foo', '000', 'Baaa', 'Bazcghfgh');

-- --------------------------------------------------------

-- 
-- Table structure for table `personnel`
-- 

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE `personnel` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) default NULL,
  `login` varchar(20) default NULL,
  `password` varchar(32) default NULL,
  `email` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `personnel`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `requests`
-- 

DROP TABLE IF EXISTS `requests`;
CREATE TABLE `requests` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `part_id` int(10) unsigned NOT NULL,
  `date_opened` date NOT NULL,
  `date_closed` date NOT NULL,
  `request` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `requests`
-- 

