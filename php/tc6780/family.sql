-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2014 at 11:26 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tc6780`
--

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

DROP TABLE IF EXISTS `family`;
CREATE TABLE IF NOT EXISTS `family` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `phone` varchar(80) NOT NULL,
  `paternal_id` int(10) unsigned NOT NULL,
  `maternal_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`id`, `name`, `phone`, `paternal_id`, `maternal_id`) VALUES
(1, 'Pete', '312.123.4567', 0, 0),
(2, 'John', '312.123.4567', 0, 0),
(3, 'Mary', '312.123.4567', 1, 0),
(4, 'Nico', '312.123.4567', 2, 3),
(5, 'Sue', '312.123.4567', 2, 3),
(6, 'Gina', '312.123.4567', 2, 3),
(7, 'Alex', '312.123.4567', 0, 5),
(8, 'George', '312.123.4567', 0, 5),
(9, 'Paul', '312.123.4567', 7, 0),
(10, 'Maria', '312.123.4567', 0, 0),
(11, 'Bethany', '312.123.4567', 9, 10),
(12, 'Robert', '219.436.2843', 0, 0),
(13, 'Robert', '219.436.2843', 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
