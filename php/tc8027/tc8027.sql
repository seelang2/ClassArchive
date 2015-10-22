-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2014 at 06:13 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tc8027`
--
CREATE DATABASE IF NOT EXISTS `tc8027` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `tc8027`;

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

DROP TABLE IF EXISTS `alumni`;
CREATE TABLE IF NOT EXISTS `alumni` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(80) NOT NULL,
  `lastname` varchar(80) NOT NULL,
  `school_id` int(10) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `homephone` varchar(12) NOT NULL,
  `workphone` varchar(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

DROP TABLE IF EXISTS `donations`;
CREATE TABLE IF NOT EXISTS `donations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alumni_id` int(10) unsigned NOT NULL,
  `fundraiser_id` int(10) unsigned NOT NULL,
  `donationdate` date NOT NULL,
  `amount` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `fundraisers`
--

DROP TABLE IF EXISTS `fundraisers`;
CREATE TABLE IF NOT EXISTS `fundraisers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `school_id` int(10) unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `goal` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

DROP TABLE IF EXISTS `schools`;
CREATE TABLE IF NOT EXISTS `schools` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
