-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2016 at 01:49 AM
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
(1, 5, 1),
(1, 6, 1),
(1, 7, 1),
(1, 8, 1),
(1, 9, 1),
(1, 10, 1),
(1, 11, 1),
(1, 12, 1),
(1, 13, 1),
(1, 14, 1),
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
  `price_usd` decimal(7,2) unsigned NOT NULL,
  `price_gbp` decimal(7,2) DEFAULT NULL,
  `price_eur` decimal(7,2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pricing`
--

INSERT INTO `pricing` (`id`, `resource_id`, `date`, `price_usd`, `price_gbp`, `price_eur`) VALUES
(1, 1, '2016-10-13', '10250.00', NULL, NULL),
(2, 1, '2016-10-12', '9875.00', NULL, NULL),
(3, 1, '2016-10-11', '10611.00', NULL, NULL),
(4, 1, '2016-10-10', '10001.00', NULL, NULL),
(5, 1, '2016-10-07', '9805.00', NULL, NULL),
(6, 2, '2016-10-13', '4555.00', NULL, NULL),
(7, 2, '2016-10-12', '5106.00', NULL, NULL),
(8, 2, '2016-10-11', '5236.00', NULL, NULL),
(9, 2, '2016-10-10', '5118.00', NULL, NULL),
(10, 2, '2016-10-07', '5387.00', NULL, NULL),
(11, 3, '2016-10-13', '7880.00', NULL, NULL),
(12, 3, '2016-10-12', '7625.00', NULL, NULL),
(13, 3, '2016-10-11', '8113.00', NULL, NULL),
(14, 3, '2016-10-10', '8105.00', NULL, NULL),
(15, 3, '2016-10-07', '7267.00', NULL, NULL),
(17, 5, '2016-10-12', '54.97', NULL, NULL),
(18, 6, '2016-10-12', '55.70', NULL, NULL),
(19, 7, '2016-10-12', '38.43', NULL, NULL),
(20, 8, '2016-10-12', '70.31', NULL, NULL),
(21, 9, '2016-10-12', '98.79', NULL, NULL),
(22, 10, '2016-10-12', '58.49', NULL, NULL),
(23, 11, '2016-10-12', '71.29', '58.49', '64.73'),
(24, 12, '2016-10-12', '65.96', '54.12', '59.90'),
(25, 13, '2016-10-12', '61.51', '50.47', '55.85'),
(26, 14, '2016-10-12', '13.32', NULL, NULL),
(27, 15, '2016-10-12', '18.76', NULL, NULL),
(28, 16, '2016-10-12', '21.26', NULL, NULL),
(29, 17, '2016-10-12', '11.77', NULL, NULL),
(30, 18, '2016-10-12', '11.11', NULL, NULL),
(31, 19, '2016-10-12', '14.80', NULL, NULL),
(32, 20, '2016-10-12', '14.10', NULL, NULL),
(33, 21, '2016-10-12', '11.89', NULL, NULL),
(34, 22, '2016-10-12', '13.80', NULL, NULL),
(35, 23, '2016-10-12', '55.35', NULL, NULL),
(36, 24, '2016-10-12', '55.35', NULL, NULL),
(37, 25, '2016-10-12', '56.57', NULL, NULL),
(38, 26, '2016-10-12', '12.03', NULL, NULL),
(39, 27, '2016-10-12', '10.46', NULL, NULL),
(40, 28, '2016-10-12', '11.13', NULL, NULL),
(41, 29, '2016-10-12', '32.82', NULL, NULL),
(42, 30, '2016-10-12', '33.10', NULL, NULL),
(43, 31, '2016-10-12', '10.20', NULL, NULL),
(44, 32, '2016-10-12', '11.00', NULL, NULL),
(45, 33, '2016-10-12', '11.03', NULL, NULL),
(46, 34, '2016-10-12', '11.33', NULL, NULL),
(47, 35, '2016-10-12', '23.31', NULL, NULL),
(48, 36, '2016-10-12', '17.94', NULL, NULL),
(49, 37, '2016-10-12', '23.44', NULL, NULL),
(50, 38, '2016-10-12', '10.11', NULL, NULL),
(51, 39, '2016-10-12', '12.89', NULL, NULL),
(52, 40, '2016-10-12', '14.99', NULL, NULL),
(53, 41, '2016-10-12', '14.58', NULL, NULL),
(54, 42, '2016-10-12', '15.19', NULL, NULL),
(55, 43, '2016-10-12', '16.14', NULL, NULL),
(56, 44, '2016-10-12', '16.14', '13.24', '14.65'),
(57, 45, '2016-10-12', '0.00', NULL, NULL),
(58, 46, '2016-10-12', '13.24', NULL, NULL),
(59, 47, '2016-10-12', '0.00', NULL, NULL),
(60, 48, '2016-10-12', '10.93', NULL, NULL),
(61, 49, '2016-10-12', '10.14', NULL, NULL),
(62, 50, '2016-10-12', '0.00', NULL, NULL),
(63, 51, '2016-10-12', '9.94', NULL, NULL),
(64, 52, '2016-10-12', '11.18', NULL, NULL),
(65, 53, '2016-10-12', '11.72', NULL, NULL),
(66, 54, '2016-10-12', '11.65', NULL, NULL),
(67, 55, '2016-10-12', '11.90', NULL, NULL),
(68, 56, '2016-10-12', '11.50', NULL, NULL),
(69, 57, '2016-10-12', '0.00', NULL, NULL),
(70, 58, '2016-10-12', '130.60', NULL, NULL),
(71, 59, '2016-10-12', '121.17', NULL, NULL),
(72, 60, '2016-10-12', '10.24', NULL, NULL),
(73, 61, '2016-10-12', '94.99', NULL, NULL),
(74, 62, '2016-10-12', '136.12', NULL, NULL),
(75, 63, '2016-10-12', '15.26', NULL, NULL),
(76, 64, '2016-10-12', '0.00', NULL, NULL),
(77, 65, '2016-10-12', '0.00', NULL, NULL),
(78, 66, '2016-10-12', '16.74', NULL, NULL),
(79, 67, '2016-10-12', '10.48', NULL, NULL),
(80, 68, '2016-10-12', '10.30', NULL, NULL),
(81, 5, '2016-10-13', '54.97', NULL, NULL),
(82, 6, '2016-10-13', '55.70', NULL, NULL),
(83, 7, '2016-10-13', '38.43', NULL, NULL),
(84, 8, '2016-10-13', '70.31', NULL, NULL),
(85, 9, '2016-10-13', '98.79', NULL, NULL),
(86, 10, '2016-10-13', '58.49', NULL, NULL),
(87, 11, '2016-10-13', '71.29', '58.49', '64.73'),
(88, 12, '2016-10-13', '65.96', '54.12', '59.90'),
(89, 13, '2016-10-13', '61.51', '50.47', '55.85'),
(90, 14, '2016-10-13', '13.32', NULL, NULL),
(91, 15, '2016-10-13', '18.76', NULL, NULL),
(92, 16, '2016-10-13', '21.26', NULL, NULL),
(93, 17, '2016-10-13', '11.77', NULL, NULL),
(94, 18, '2016-10-13', '11.11', NULL, NULL),
(95, 19, '2016-10-13', '14.80', NULL, NULL),
(96, 20, '2016-10-13', '14.10', NULL, NULL),
(97, 21, '2016-10-13', '11.89', NULL, NULL),
(98, 22, '2016-10-13', '13.80', NULL, NULL),
(99, 23, '2016-10-13', '55.35', NULL, NULL),
(100, 24, '2016-10-13', '55.35', NULL, NULL),
(101, 25, '2016-10-13', '56.57', NULL, NULL),
(102, 26, '2016-10-13', '12.03', NULL, NULL),
(103, 27, '2016-10-13', '10.46', NULL, NULL),
(104, 28, '2016-10-13', '11.13', NULL, NULL),
(105, 29, '2016-10-13', '32.82', NULL, NULL),
(106, 30, '2016-10-13', '33.10', NULL, NULL),
(107, 31, '2016-10-13', '10.20', NULL, NULL),
(108, 32, '2016-10-13', '11.00', NULL, NULL),
(109, 33, '2016-10-13', '11.03', NULL, NULL),
(110, 34, '2016-10-13', '11.33', NULL, NULL),
(111, 35, '2016-10-13', '23.31', NULL, NULL),
(112, 36, '2016-10-13', '17.94', NULL, NULL),
(113, 37, '2016-10-13', '23.44', NULL, NULL),
(114, 38, '2016-10-13', '10.11', NULL, NULL),
(115, 39, '2016-10-13', '12.89', NULL, NULL),
(116, 40, '2016-10-13', '14.99', NULL, NULL),
(117, 41, '2016-10-13', '14.58', NULL, NULL),
(118, 42, '2016-10-13', '15.19', NULL, NULL),
(119, 43, '2016-10-13', '16.14', NULL, NULL),
(120, 44, '2016-10-13', '16.14', '13.24', '14.65'),
(121, 45, '2016-10-13', '0.00', NULL, NULL),
(122, 46, '2016-10-13', '13.24', NULL, NULL),
(123, 47, '2016-10-13', '0.00', NULL, NULL),
(124, 48, '2016-10-13', '10.93', NULL, NULL),
(125, 49, '2016-10-13', '10.14', NULL, NULL),
(126, 50, '2016-10-13', '0.00', NULL, NULL),
(127, 51, '2016-10-13', '9.94', NULL, NULL),
(128, 52, '2016-10-13', '11.18', NULL, NULL),
(129, 53, '2016-10-13', '11.72', NULL, NULL),
(130, 54, '2016-10-13', '11.65', NULL, NULL),
(131, 55, '2016-10-13', '11.90', NULL, NULL),
(132, 56, '2016-10-13', '11.50', NULL, NULL),
(133, 57, '2016-10-13', '0.00', NULL, NULL),
(134, 58, '2016-10-13', '130.60', NULL, NULL),
(135, 59, '2016-10-13', '121.17', NULL, NULL),
(136, 60, '2016-10-13', '10.24', NULL, NULL),
(137, 61, '2016-10-13', '94.99', NULL, NULL),
(138, 62, '2016-10-13', '136.12', NULL, NULL),
(139, 63, '2016-10-13', '15.26', NULL, NULL),
(140, 64, '2016-10-13', '0.00', NULL, NULL),
(141, 65, '2016-10-13', '0.00', NULL, NULL),
(142, 66, '2016-10-13', '16.74', NULL, NULL),
(143, 67, '2016-10-13', '10.48', NULL, NULL),
(144, 68, '2016-10-13', '10.30', NULL, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `name`, `abbr`, `type`, `data`) VALUES
(1, 'Fund 1', 'FUND1', 1, NULL),
(2, 'Fund 2', 'FUND2', 1, NULL),
(3, 'Fund 3', 'FUND3', 1, NULL),
(4, '0', '0', 0, NULL),
(5, 'GBL', 'GBL', 0, NULL),
(6, 'CG', 'CG', 0, NULL),
(7, 'BARN', 'BARN', 0, NULL),
(8, 'EWF *', 'EWF *', 0, NULL),
(9, 'EWF IS', 'EWF IS', 0, NULL),
(10, 'EWF IG', 'EWF IG', 0, NULL),
(11, 'EWF I', 'EWF I', 0, NULL),
(12, 'EWF R', 'EWF R', 0, NULL),
(13, 'EWF RB', 'EWF RB', 0, NULL),
(14, 'SALT', 'SALT', 0, NULL),
(15, 'GRAND', 'GRAND', 0, NULL),
(16, 'COAL', 'COAL', 0, NULL),
(17, 'BEEHIVE', 'BEEHIVE', 0, NULL),
(18, 'CHALK', 'CHALK', 0, NULL),
(19, 'CASCADE', 'CASCADE', 0, NULL),
(20, 'CASCADE2', 'CASCADE2', 0, NULL),
(21, 'CASCADE3', 'CASCADE3', 0, NULL),
(22, 'BMI', 'BMI', 0, NULL),
(23, 'INV', 'INV', 0, NULL),
(24, 'INVSIDE', 'INVSIDE', 0, NULL),
(25, 'CI', 'CI', 0, NULL),
(26, 'DOC', 'DOC', 0, NULL),
(27, 'DOC2', 'DOC2', 0, NULL),
(28, 'TREAT', 'TREAT', 0, NULL),
(29, 'FREE', 'FREE', 0, NULL),
(30, 'CF', 'CF', 0, NULL),
(31, 'IN', 'IN', 0, NULL),
(32, 'OUT', 'OUT', 0, NULL),
(33, 'CHIP', 'CHIP', 0, NULL),
(34, 'STEEL', 'STEEL', 0, NULL),
(35, 'PLUS', 'PLUS', 0, NULL),
(36, 'ZIP', 'ZIP', 0, NULL),
(37, 'FOCUS', 'FOCUS', 0, NULL),
(38, 'EUREKA', 'EUREKA', 0, NULL),
(39, 'HCSPEC', 'HCSPEC', 0, NULL),
(40, 'TDX', 'TDX', 0, NULL),
(41, 'SEA', 'SEA', 0, NULL),
(42, 'PHOENIX', 'PHOENIX', 0, NULL),
(43, 'WUGEF *', 'WUGEF *', 0, NULL),
(44, 'WUGEF', 'WUGEF', 0, NULL),
(45, 'GARF', 'GARF', 0, NULL),
(46, 'GPLUS', 'GPLUS', 0, NULL),
(47, 'OHARE', 'OHARE', 0, NULL),
(48, 'JANUS', 'JANUS', 0, NULL),
(49, 'DELTA', 'DELTA', 0, NULL),
(50, 'CURVE', 'CURVE', 0, NULL),
(51, 'CURVE2', 'CURVE2', 0, NULL),
(52, 'MIDWAY', 'MIDWAY', 0, NULL),
(53, 'OYSTER', 'OYSTER', 0, NULL),
(54, 'ALAMO', 'ALAMO', 0, NULL),
(55, 'SLATE', 'SLATE', 0, NULL),
(56, 'OLYMPUS', 'OLYMPUS', 0, NULL),
(57, 'NAT', 'NAT', 0, NULL),
(58, 'CHINA', 'CHINA', 0, NULL),
(59, 'CSIDE', 'CSIDE', 0, NULL),
(60, 'LIQUID', 'LIQUID', 0, NULL),
(61, 'LIQUID2', 'LIQUID2', 0, NULL),
(62, 'SPADE', 'SPADE', 0, NULL),
(63, 'CHQ', 'CHQ', 0, NULL),
(64, 'CVG', 'CVG', 0, NULL),
(65, 'ASIA', 'ASIA', 0, NULL),
(66, 'FRONT', 'FRONT', 0, NULL),
(67, 'BAY', 'BAY', 0, NULL),
(68, 'EAST', 'EAST', 0, NULL),
(69, '', '', 0, NULL);

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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=145;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
