-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 20, 2007 at 02:40 PM
-- Server version: 5.0.16
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `class467`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `contacts`
-- 

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL auto_increment,
  `firstname` varchar(30) default NULL,
  `lastname` varchar(40) default NULL,
  `addr1` varchar(75) default NULL,
  `addr2` varchar(75) default NULL,
  `city` varchar(30) default NULL,
  `st` varchar(2) default NULL,
  `zip` varchar(12) default NULL,
  `phone1` varchar(15) default NULL,
  `phone2` varchar(15) default NULL,
  `email` varchar(75) default NULL,
  `url` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `contacts`
-- 

INSERT INTO `contacts` (`id`, `firstname`, `lastname`, `addr1`, `addr2`, `city`, `st`, `zip`, `phone1`, `phone2`, `email`, `url`) VALUES 
(1, 'John', 'Doe', '123 Anywhere', 'Flr 1', 'Nowhere', 'CA', '92010', '(123)456-7890', NULL, 'johndoe@email.com', NULL),
(2, 'Jane', 'Doe', '123 Anywhere', 'Flr 2', 'Nowhere', 'CA', '92010', '(321)546-9028', NULL, 'janedoe@email.com', NULL);
