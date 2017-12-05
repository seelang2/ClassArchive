-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jun 25, 2008 at 03:39 PM
-- Server version: 5.0.16
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `tc854`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `inventory`
-- 

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `type` tinyint(3) unsigned NOT NULL,
  `btu` mediumint(8) unsigned NOT NULL,
  `afue` tinyint(4) NOT NULL,
  `model_number` varchar(20) NOT NULL,
  `manufacturer_id` int(10) unsigned NOT NULL,
  `cost` float(8,2) NOT NULL default '0.00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- 
-- Dumping data for table `inventory`
-- 

INSERT INTO `inventory` (`id`, `type`, `btu`, `afue`, `model_number`, `manufacturer_id`, `cost`) VALUES 
(1, 1, 125000, 80, 'WT100001', 2, 100.00),
(2, 3, 10000, 80, 'CR-1234', 1, 99.00),
(3, 1, 11, 12, '1xx', 2, 111.00),
(4, 2, 11111, 44, '2xx', 2, 12345.00),
(5, 4, 55533, 77, '3xx', 2, 4325.00);

-- --------------------------------------------------------

-- 
-- Table structure for table `manufacturers`
-- 

DROP TABLE IF EXISTS `manufacturers`;
CREATE TABLE `manufacturers` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `manufacturers`
-- 

INSERT INTO `manufacturers` (`id`, `name`) VALUES 
(1, 'Carrier'),
(2, 'Wellington'),
(4, 'Welles'),
(7, 'not blank');

-- --------------------------------------------------------

-- 
-- Table structure for table `purchases`
-- 

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE `purchases` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `purchases`
-- 

INSERT INTO `purchases` (`id`, `user_id`, `item_id`) VALUES 
(1, 1, 1),
(2, 1, 3);

-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `email` varchar(80) NOT NULL,
  `password` varchar(40) NOT NULL,
  `login` varchar(15) NOT NULL,
  `date_created` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `login`, `date_created`) VALUES 
(1, 'John', 'Does', 'jdoe@email.com', 'password', 'jdoes', '2008-06-24 14:52:54'),
(2, 'Jane', 'Doesnt', 'janed@mail.com', 'obvious', 'janed', '2008-06-24 14:53:39');
