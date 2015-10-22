-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Sep 28, 2007 at 10:47 AM
-- Server version: 5.0.16
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `php319`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `issues`
-- 

DROP TABLE IF EXISTS `issues`;
CREATE TABLE `issues` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(150) NOT NULL,
  `date` date NOT NULL,
  `pub_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `pub_id` (`pub_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `issues`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `publications`
-- 

DROP TABLE IF EXISTS `publications`;
CREATE TABLE `publications` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(75) NOT NULL,
  `description` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `create_date` date NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `author_id` (`author_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `publications`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `pubs_2_subs`
-- 

DROP TABLE IF EXISTS `pubs_2_subs`;
CREATE TABLE `pubs_2_subs` (
  `id` int(11) NOT NULL auto_increment,
  `pub_id` int(11) NOT NULL,
  `sub_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `pub_id` (`pub_id`,`sub_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `pubs_2_subs`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `subscribers`
-- 

DROP TABLE IF EXISTS `subscribers`;
CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL auto_increment,
  `email` varchar(60) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `create_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `subscribers`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `email` varchar(60) NOT NULL,
  `login` varchar(12) NOT NULL,
  `password` varchar(32) NOT NULL,
  `create_date` date default NULL,
  `last_login_date` datetime default NULL,
  `status` tinyint(4) default NULL,
  `permission` tinyint(4) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- 
-- Dumping data for table `users`
-- 

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `login`, `password`, `create_date`, `last_login_date`, `status`, `permission`) VALUES 
(1, 'Chris', 'Langtiw', 'seelang2@gmail.com', 'chrisl', 'obvious', '2007-09-28', NULL, 1, 9),
(6, 'Test', 'User1', 'testuser@email.com', 'test12', 'password', '2007-09-28', NULL, 1, 1),
(5, 'Jane', 'Doesnt', 'jane@doesnt.com', 'janedoe', 'none', '2007-09-27', NULL, 1, 1),
(7, 'Test2', 'User2', 'testuser2@email.com', 'testing2', 'password', '2007-09-28', NULL, 1, 1);
