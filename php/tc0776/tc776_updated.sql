-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: May 14, 2008 at 06:24 PM
-- Server version: 5.0.16
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `tc776`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `answers`
-- 

DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `question_id` mediumint(8) unsigned NOT NULL,
  `customer_id` mediumint(8) unsigned NOT NULL,
  `response_id` mediumint(8) unsigned NOT NULL default '0',
  `textanswer` varchar(255) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

-- 
-- Dumping data for table `answers`
-- 

INSERT INTO `answers` (`id`, `question_id`, `customer_id`, `response_id`, `textanswer`) VALUES 
(9, 3, 1, 7, ''),
(8, 2, 1, 3, ''),
(7, 1, 1, 1, '');

-- --------------------------------------------------------

-- 
-- Table structure for table `customers`
-- 

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `household_id` mediumint(8) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `home_phone` varchar(12) NOT NULL,
  `work_phone` varchar(12) NOT NULL,
  `gender` char(1) NOT NULL,
  `birth_year` year(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `customers`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `households`
-- 

DROP TABLE IF EXISTS `households`;
CREATE TABLE `households` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `acct_num` varchar(12) NOT NULL,
  `address` varchar(60) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(5) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `acct_num` (`acct_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `households`
-- 

INSERT INTO `households` (`id`, `acct_num`, `address`, `city`, `state`, `zip`) VALUES 
(1, '123456789012', '123 Anywhere Street', 'Chicago', 'IL', '60610'),
(2, '312457680946', '3131 Nowhere Drive', 'Anytown', 'MA', '00001'),
(3, '44444444', '444 oh Four New Place', 'Sometown', 'RI', '10000');

-- --------------------------------------------------------

-- 
-- Table structure for table `q2r`
-- 

DROP TABLE IF EXISTS `q2r`;
CREATE TABLE `q2r` (
  `question_id` mediumint(8) unsigned NOT NULL,
  `response_id` mediumint(8) unsigned NOT NULL,
  `sortorder` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`question_id`,`response_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `q2r`
-- 

INSERT INTO `q2r` (`question_id`, `response_id`, `sortorder`) VALUES 
(1, 1, 1),
(1, 2, 2),
(2, 3, 1),
(2, 4, 2),
(3, 7, 1),
(3, 6, 2),
(3, 5, 3);

-- --------------------------------------------------------

-- 
-- Table structure for table `questions`
-- 

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `survey_id` mediumint(8) unsigned NOT NULL,
  `questiontext` varchar(255) NOT NULL,
  `sortorder` smallint(5) unsigned NOT NULL,
  `parent_id` mediumint(8) unsigned NOT NULL default '0',
  `type` tinyint(3) unsigned NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `sortorder` (`sortorder`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `questions`
-- 

INSERT INTO `questions` (`id`, `survey_id`, `questiontext`, `sortorder`, `parent_id`, `type`) VALUES 
(1, 1, 'Is the sky blue?', 1, 0, 1),
(2, 1, 'Do you breathe air?', 2, 0, 1),
(3, 1, 'I enjoyed this class very much.', 3, 0, 1),
(4, 1, 'Any feedback you''d like to give?', 4, 0, 2);

-- --------------------------------------------------------

-- 
-- Table structure for table `responselist`
-- 

DROP TABLE IF EXISTS `responselist`;
CREATE TABLE `responselist` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `responsetext` varchar(100) NOT NULL,
  `responsevalue` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `responselist`
-- 

INSERT INTO `responselist` (`id`, `responsetext`, `responsevalue`) VALUES 
(1, 'True', 1),
(2, 'False', 0),
(3, 'Yes', 1),
(4, 'No', 0),
(5, 'Disagree', 1),
(6, 'Neutral', 2),
(7, 'Agree', 3);

-- --------------------------------------------------------

-- 
-- Table structure for table `surveys`
-- 

DROP TABLE IF EXISTS `surveys`;
CREATE TABLE `surveys` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `name` varchar(120) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `surveys`
-- 

INSERT INTO `surveys` (`id`, `name`, `description`) VALUES 
(1, 'Sample Survey 1', 'This is a test. This is only a test. Nothing to see here. Move along. these are not the droids you''re looking for...');
