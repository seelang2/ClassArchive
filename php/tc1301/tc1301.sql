-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jan 16, 2009 at 04:33 PM
-- Server version: 5.0.16
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `tc1301`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `addresses`
-- 

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `contact_id` int(10) unsigned NOT NULL,
  `address1` varchar(60) NOT NULL,
  `address2` varchar(60) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` char(2) NOT NULL,
  `zip` char(6) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL default '3',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `addresses`
-- 

INSERT INTO `addresses` (`id`, `contact_id`, `address1`, `address2`, `city`, `state`, `zip`, `type`) VALUES 
(1, 1, 'dfgsdfg', 'sdfgdsfg', 'sdfgsdfg', 'ST', '00000', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `c2c`
-- 

DROP TABLE IF EXISTS `c2c`;
CREATE TABLE `c2c` (
  `contact_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`contact_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `c2c`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `categories`
-- 

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `categories`
-- 

INSERT INTO `categories` (`id`, `name`) VALUES 
(1, 'Preferred'),
(2, 'Standard');

-- --------------------------------------------------------

-- 
-- Table structure for table `contacts`
-- 

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `homephone` varchar(20) default NULL,
  `workphone` varchar(20) default NULL,
  `dept_id` int(10) unsigned NOT NULL,
  `email` varchar(100) default NULL,
  `type` tinyint(3) unsigned NOT NULL default '2',
  `login` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `permission` tinyint(4) NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `contacts`
-- 

INSERT INTO `contacts` (`id`, `firstname`, `lastname`, `homephone`, `workphone`, `dept_id`, `email`, `type`, `login`, `password`, `permission`) VALUES 
(1, 'John', 'Doe', '789-654-3210', '123-456-7890', 2, 'johndoe@email.com', 2, '', '', 1),
(2, 'Jane', 'Smith', '000-000-0000', '000-000-0000', 3, 'jane@smith.com', 2, '', '', 1),
(3, 'Alex', 'Trebec', '123-456-7843', '231-433-6631', 4, 'atb@nbc.com', 1, 'atrebec', 'password', 1),
(4, 'Donald', 'Trump', '630-555-1234', '773-555-9756', 3, 'djtrump@trump.com', 1, 'thedonald', 'password', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `departments`
-- 

DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `departments`
-- 

INSERT INTO `departments` (`id`, `name`) VALUES 
(1, 'Accounting'),
(2, 'Information Technology'),
(3, 'Sales'),
(4, 'Marketing');

-- --------------------------------------------------------

-- 
-- Table structure for table `inventory`
-- 

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `item_name` varchar(50) NOT NULL,
  `price` decimal(8,2) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `inventory`
-- 

INSERT INTO `inventory` (`id`, `item_name`, `price`) VALUES 
(1, 'Widgets', 25.00),
(2, 'Gadgets', 60.00),
(3, 'Thingamajig', 125.00);

-- --------------------------------------------------------

-- 
-- Table structure for table `orders`
-- 

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `contact_id` int(10) unsigned NOT NULL,
  `order_date` datetime NOT NULL,
  `status` tinyint(3) unsigned NOT NULL default '1',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `orders`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `order_items`
-- 

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `order_id` int(10) unsigned NOT NULL,
  `inventory_id` int(10) unsigned NOT NULL,
  `qty` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`order_id`,`inventory_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Dumping data for table `order_items`
-- 

