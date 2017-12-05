-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Mar 27, 2008 at 12:48 PM
-- Server version: 5.0.16
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Database: `tc708`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `comments`
-- 

CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `sender_id` int(10) unsigned NOT NULL,
  `recipient_id` int(10) unsigned NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `type` tinyint(3) unsigned NOT NULL,
  `commenttext` tinytext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `comments`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `friends`
-- 

CREATE TABLE `friends` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `my_profile_id` int(10) unsigned NOT NULL,
  `friend_id` int(10) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `friends`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `profiledata`
-- 

CREATE TABLE `profiledata` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `profile_id` int(10) unsigned NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `entry` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `profiledata`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `profiles`
-- 

CREATE TABLE `profiles` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `fullname` varchar(35) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(32) NOT NULL,
  `dob` date default NULL,
  `location` varchar(50) default NULL,
  `yahooid` varchar(15) default NULL,
  `msnid` varchar(15) default NULL,
  `relationshipstatus_id` int(10) unsigned default NULL,
  `lastlogin` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `profiles`
-- 


-- --------------------------------------------------------

-- 
-- Table structure for table `relationships`
-- 

CREATE TABLE `relationships` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `statusname` varchar(25) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- 
-- Dumping data for table `relationships`
-- 

