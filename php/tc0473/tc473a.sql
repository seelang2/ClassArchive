-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Jan 10, 2008 at 03:09 PM
-- Server version: 5.0.16
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `tc473`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `addresses`
-- 

DROP TABLE IF EXISTS `addresses`;
CREATE TABLE `addresses` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `building_name` varchar(20) default NULL,
  `address1` varchar(50) default NULL,
  `address2` varchar(50) default NULL,
  `city` varchar(20) default NULL,
  `state` varchar(2) default NULL,
  `zip` varchar(5) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `addresses`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `addresses_to_contacts`
-- 

DROP TABLE IF EXISTS `addresses_to_contacts`;
CREATE TABLE `addresses_to_contacts` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `contact_id` int(10) unsigned NOT NULL,
  `address_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `entries` (`contact_id`,`address_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `addresses_to_contacts`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `assignments`
-- 

DROP TABLE IF EXISTS `assignments`;
CREATE TABLE `assignments` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `contact_id` int(10) unsigned NOT NULL,
  `subject_id` int(10) unsigned NOT NULL,
  `date_assigned` date default NULL,
  `due_date` date default NULL,
  `assignment` text,
  PRIMARY KEY  (`id`),
  KEY `contact_id` (`contact_id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `assignments`
-- 

INSERT INTO `assignments` (`id`, `contact_id`, `subject_id`, `date_assigned`, `due_date`, `assignment`) VALUES 
(1, 1, 1, '2008-01-10', '2008-01-11', 'Complete web application.');

-- --------------------------------------------------------

-- 
-- Table structure for table `contacts`
-- 

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `firstname` varchar(30) default NULL,
  `lastname` varchar(30) default NULL,
  `phone` varchar(13) default NULL,
  `email` varchar(50) default NULL,
  `room` varchar(10) default NULL,
  `login` varchar(15) NOT NULL,
  `password` varchar(32) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- 
-- Dumping data for table `contacts`
-- 

INSERT INTO `contacts` (`id`, `firstname`, `lastname`, `phone`, `email`, `room`, `login`, `password`) VALUES 
(1, 'John', 'Doe', '(773)588-2300', 'johndoe@email.com', '404', 'jdoe', 'password'),
(2, 'Jane', 'Doesnt', '1234567890', 'notjane@email.com', '100', 'jdoesnt', 'password');

-- --------------------------------------------------------

-- 
-- Table structure for table `roompages`
-- 

DROP TABLE IF EXISTS `roompages`;
CREATE TABLE `roompages` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `contact_id` int(10) unsigned NOT NULL,
  `content` text,
  PRIMARY KEY  (`id`),
  KEY `contact_id` (`contact_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- 
-- Dumping data for table `roompages`
-- 

INSERT INTO `roompages` (`id`, `contact_id`, `content`) VALUES 
(1, 1, 'This space for rent.');

-- --------------------------------------------------------

-- 
-- Table structure for table `subjects`
-- 

DROP TABLE IF EXISTS `subjects`;
CREATE TABLE `subjects` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL,
  `description` varchar(150) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- 
-- Dumping data for table `subjects`
-- 

INSERT INTO `subjects` (`id`, `name`, `description`) VALUES 
(1, 'Language Arts', 'The new PC name for English'),
(3, 'History', 'History of the World (Part 1)'),
(4, 'Algebra', 'Nah, I really did like this subject.'),
(5, 'Earth Science', 'I hated this class. Or maybe just the teacher.');
