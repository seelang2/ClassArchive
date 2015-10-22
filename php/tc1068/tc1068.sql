-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Sep 19, 2008 at 03:50 PM
-- Server version: 5.0.16
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `tc1068`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `addresses`
-- 

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(125) NOT NULL,
  `address1` varchar(60) NOT NULL,
  `address2` varchar(60) default NULL,
  `city` varchar(15) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` char(5) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `addresses`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `departments`
-- 

DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(75) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `departments`
-- 

INSERT INTO `departments` (`id`, `name`) VALUES 
(1, 'Information Technology'),
(2, 'Radiology');

-- --------------------------------------------------------

-- 
-- Table structure for table `personnel`
-- 

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE `personnel` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `dept_id` int(10) unsigned NOT NULL default '0',
  `login` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `permission` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `personnel`
-- 

INSERT INTO `personnel` (`id`, `firstname`, `lastname`, `dept_id`, `login`, `password`, `permission`) VALUES 
(1, 'Administrator', 'User', 1, 'admin', 'password', 255),
(2, 'John', 'Doe', 2, 'jdoe', 'password', 0);

-- --------------------------------------------------------

-- 
-- Table structure for table `personnel_to_addresses`
-- 

DROP TABLE IF EXISTS `personnel_to_addresses`;
CREATE TABLE `personnel_to_addresses` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `personnel_id` int(10) unsigned NOT NULL,
  `address_id` int(10) unsigned NOT NULL,
  `extension` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `personnel_to_addresses`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `phones`
-- 

DROP TABLE IF EXISTS `phones`;
CREATE TABLE `phones` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `entity_id` int(10) unsigned NOT NULL,
  `number` varchar(12) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `phones`
-- 

