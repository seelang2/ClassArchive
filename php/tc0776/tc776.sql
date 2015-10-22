-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: May 13, 2008 at 12:28 PM
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
  `answer` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `answers`
-- 


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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `households`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `q2r`
-- 

DROP TABLE IF EXISTS `q2r`;
CREATE TABLE `q2r` (
  `question_id` mediumint(8) unsigned NOT NULL,
  `response_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY  (`question_id`,`response_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `q2r`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `questions`
-- 

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `survey_id` mediumint(8) unsigned NOT NULL,
  `questiontext` varchar(255) NOT NULL,
  `sortorder` decimal(2,2) NOT NULL,
  `parent_id` mediumint(8) unsigned NOT NULL default '0',
  `type` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `sortorder` (`sortorder`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `questions`
-- 


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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `responselist`
-- 


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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `surveys`
-- 

