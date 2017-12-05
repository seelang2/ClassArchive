-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 06, 2007 at 09:18 AM
-- Server version: 5.0.16
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `class472`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `categories`
-- 

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `categories`
-- 

INSERT INTO `categories` (`id`, `name`) VALUES 
(1, 'Producers'),
(2, 'Renters'),
(3, 'dfggjdgjgfj');

-- --------------------------------------------------------

-- 
-- Table structure for table `companies_to_categories`
-- 

DROP TABLE IF EXISTS `companies_to_categories`;
CREATE TABLE IF NOT EXISTS `companies_to_categories` (
  `id` int(11) NOT NULL auto_increment,
  `company_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `C2C` (`company_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `companies_to_categories`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `company_info`
-- 

DROP TABLE IF EXISTS `company_info`;
CREATE TABLE IF NOT EXISTS `company_info` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `address1` varchar(50) NOT NULL,
  `address2` varchar(50) default NULL,
  `city` varchar(25) NOT NULL,
  `state` varchar(2) NOT NULL,
  `zip` varchar(5) NOT NULL,
  `url` varchar(100) default NULL,
  PRIMARY KEY  (`id`),
  KEY `state` (`state`),
  KEY `zip` (`zip`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `company_info`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phones`
-- 

DROP TABLE IF EXISTS `phones`;
CREATE TABLE IF NOT EXISTS `phones` (
  `id` int(11) NOT NULL auto_increment,
  `number` varchar(10) NOT NULL,
  `company_id` int(11) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `phones`
-- 

