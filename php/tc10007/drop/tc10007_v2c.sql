-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2016 at 12:08 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tc10007`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `company` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `user_id`, `company`) VALUES
(1, 2, 'Client A Company'),
(2, 3, 'Client B Company');

-- --------------------------------------------------------

--
-- Table structure for table `clients_resources`
--

DROP TABLE IF EXISTS `clients_resources`;
CREATE TABLE IF NOT EXISTS `clients_resources` (
  `client_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `shares` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients_resources`
--

INSERT INTO `clients_resources` (`client_id`, `resource_id`, `shares`) VALUES
(1, 1, 100),
(1, 2, 250),
(2, 2, 300),
(2, 3, 100);

-- --------------------------------------------------------

--
-- Table structure for table `pricing`
--

DROP TABLE IF EXISTS `pricing`;
CREATE TABLE IF NOT EXISTS `pricing` (
  `id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `price` mediumint(8) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pricing`
--

INSERT INTO `pricing` (`id`, `resource_id`, `date`, `price`) VALUES
(1, 1, '2016-10-13', 10250),
(2, 1, '2016-10-12', 9875),
(3, 1, '2016-10-11', 10611),
(4, 1, '2016-10-10', 10001),
(5, 1, '2016-10-07', 9805),
(6, 2, '2016-10-13', 4555),
(7, 2, '2016-10-12', 5106),
(8, 2, '2016-10-11', 5236),
(9, 2, '2016-10-10', 5118),
(10, 2, '2016-10-07', 5387),
(11, 3, '2016-10-13', 7880),
(12, 3, '2016-10-12', 7625),
(13, 3, '2016-10-11', 8113),
(14, 3, '2016-10-10', 8105),
(15, 3, '2016-10-07', 7267);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `month` tinyint(3) unsigned NOT NULL,
  `year` year(4) NOT NULL,
  `pdf_file` text NOT NULL,
  `type` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `resource_id`, `month`, `year`, `pdf_file`, `type`) VALUES
(1, 1, 9, 2016, 'sample1.txt', 1),
(2, 2, 9, 2016, 'sample2.txt', 1),
(3, 3, 9, 2016, 'sample3.txt', 1),
(4, 1, 8, 2016, 'xxx.txt', 1),
(5, 1, 9, 2016, 'querter.txt', 2);

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

DROP TABLE IF EXISTS `resources`;
CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(10) unsigned NOT NULL,
  `name` text NOT NULL,
  `abbr` varchar(10) NOT NULL,
  `type` tinyint(4) NOT NULL COMMENT '1 = fund, 2 = download',
  `data` text
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `name`, `abbr`, `type`, `data`) VALUES
(1, 'Fund 1', 'FUND1', 1, NULL),
(2, 'Fund 2', 'FUND2', 1, NULL),
(3, 'Fund 3', 'FUND3', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `name` text NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `phone`, `email`, `status`, `last_login`, `type`) VALUES
(1, 'admin', '26d6fc358fd42cbffa43327b37db93e10eeb38d3', 'Admin User', '0000000000', 'admin@user.com', 1, '2016-10-14 19:59:36', 2),
(2, 'clienta', 'a5138bbf1131162abb144f57eb23265d78a4abcb', 'Client A', '1234567890', 'client1@mail.com', 1, '2016-10-14 21:28:42', 1),
(3, 'clientb', '26d6fc358fd42cbffa43327b37db93e10eeb38d3', 'Client B', '0000000000', 'clientb@mail.com', 1, '2016-10-14 19:59:36', 1),
(4, 'chrisl', '26d6fc358fd42cbffa43327b37db93e10eeb38d3', 'Chris Langtiw', '1234567890', 'chris@sitebabble.com', 1, '2016-10-14 21:34:57', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients_resources`
--
ALTER TABLE `clients_resources`
  ADD PRIMARY KEY (`client_id`,`resource_id`);

--
-- Indexes for table `pricing`
--
ALTER TABLE `pricing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pricing`
--
ALTER TABLE `pricing`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
