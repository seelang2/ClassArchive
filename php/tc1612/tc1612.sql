-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2009 at 03:18 PM
-- Server version: 5.1.30
-- PHP Version: 5.2.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tc1612`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `create_date`) VALUES
(1, 'Beverages', '2009-04-28 16:08:34'),
(2, 'Electronics', '2009-04-28 16:08:34'),
(3, 'Household Furniture', '2009-04-28 16:08:34'),
(4, 'Automobiles', '2009-04-28 16:08:34'),
(5, 'Food', '2009-04-28 16:08:34'),
(6, 'Doodads', '2009-04-28 16:50:20');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`) VALUES
(1, 'Heineken', 'imfo@heineken.com'),
(2, 'Reebok', 'some email');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(10) unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `client_id`, `name`) VALUES
(1, 1, 'Bottles'),
(2, 2, 'Shoes'),
(3, 2, 'Jackets'),
(4, 2, 'Gloves'),
(5, 1, 'Coasters');

-- --------------------------------------------------------

--
-- Table structure for table `products2categories`
--

DROP TABLE IF EXISTS `products2categories`;
CREATE TABLE IF NOT EXISTS `products2categories` (
  `product_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`product_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products2categories`
--


-- --------------------------------------------------------

--
-- Table structure for table `scenes`
--

DROP TABLE IF EXISTS `scenes`;
CREATE TABLE IF NOT EXISTS `scenes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `script_id` int(10) unsigned NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `scenes`
--

INSERT INTO `scenes` (`id`, `script_id`, `name`, `description`) VALUES
(1, 1, 'Scene1', 'description'),
(2, 1, 'Scene2', 'description'),
(3, 2, 'Scene1', 'description'),
(4, 2, 'Scene2', 'description'),
(5, 3, 'Scene1', 'description'),
(6, 3, 'Scene2', 'description'),
(7, 4, 'Scene1', 'description'),
(8, 4, 'Scene2', 'description'),
(9, 5, 'Scene1', 'description'),
(10, 5, 'Scene2', 'description');

-- --------------------------------------------------------

--
-- Table structure for table `scenes2categories`
--

DROP TABLE IF EXISTS `scenes2categories`;
CREATE TABLE IF NOT EXISTS `scenes2categories` (
  `scene_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`scene_id`,`category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scenes2categories`
--

INSERT INTO `scenes2categories` (`scene_id`, `category_id`) VALUES
(1, 1),
(1, 5),
(2, 2),
(3, 3),
(3, 4),
(4, 1),
(4, 2),
(4, 6),
(5, 4),
(5, 5),
(6, 3),
(7, 3),
(8, 2),
(9, 1),
(10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `scripts`
--

DROP TABLE IF EXISTS `scripts`;
CREATE TABLE IF NOT EXISTS `scripts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `scripts`
--

INSERT INTO `scripts` (`id`, `name`) VALUES
(1, 'Princess Bride'),
(2, 'Clockwork Orange'),
(3, 'My Cousin Vinny'),
(4, 'Aliens'),
(5, 'Matrix');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  `login` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users`
--


-- --------------------------------------------------------

--
-- Table structure for table `users2clients`
--

DROP TABLE IF EXISTS `users2clients`;
CREATE TABLE IF NOT EXISTS `users2clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `client_id` int(10) unsigned NOT NULL,
  `role` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users2clients`
--

