-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2015 at 10:50 PM
-- Server version: 5.6.11
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bookings`
--
CREATE DATABASE IF NOT EXISTS `bookings` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bookings`;

-- --------------------------------------------------------

--
-- Table structure for table `boats`
--

DROP TABLE IF EXISTS `boats`;
CREATE TABLE IF NOT EXISTS `boats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location_id` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `capacity` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `boatscategories`
--

DROP TABLE IF EXISTS `boatscategories`;
CREATE TABLE IF NOT EXISTS `boatscategories` (
  `boat_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `price` int(10) unsigned NOT NULL,
  PRIMARY KEY (`boat_id`,`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `boat_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `passengers` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(90) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

DROP TABLE IF EXISTS `locations`;
CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(90) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
