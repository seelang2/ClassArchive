-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2018 at 11:19 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tc12312`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `userid` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clients_funds`
--

DROP TABLE IF EXISTS `clients_funds`;
CREATE TABLE `clients_funds` (
  `client_id` int(10) UNSIGNED NOT NULL,
  `fund_id` int(10) UNSIGNED NOT NULL,
  `fee` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `funds`
--

DROP TABLE IF EXISTS `funds`;
CREATE TABLE `funds` (
  `id` int(10) UNSIGNED NOT NULL,
  `fundid` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `fee` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `funds`
--

INSERT INTO `funds` (`id`, `fundid`, `name`, `fee`) VALUES
(1, 'TESTFUND', 'Test Fund', '12.34'),
(2, 'TESTFUND2', 'Test Fund 2', '199.99'),
(3, 'TESTFUND3', 'Test Fund 3', '19.99'),
(4, 'EWFI', 'EWFI', '10.00'),
(5, 'EWFR', 'EWFR', '10.00'),
(6, 'EWFRB', 'EWFRB', '10.00'),
(7, 'GBL', 'GBL', '10.00'),
(8, 'INV', 'INV', '10.00'),
(9, 'FREE', 'FREE', '10.00'),
(10, 'CHINA', 'CHINA', '10.00'),
(11, 'FRONT', 'FRONT', '10.00'),
(12, 'PHOENIX', 'PHOENIX', '10.00'),
(13, 'CG', 'CG', '10.00'),
(14, 'CI', 'CI', '10.00'),
(15, 'CF', 'CF', '10.00'),
(16, 'EUREKA', 'EUREKA', '10.00'),
(17, 'GPLUSA', 'GPLUSA', '10.00'),
(18, 'GPLUSB', 'GPLUSB', '10.00'),
(19, 'CARDINALA', 'CARDINALA', '10.00'),
(20, 'UNIQUE', 'UNIQUE', '10.00'),
(21, 'APOLLO', 'APOLLO', '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `pricing`
--

DROP TABLE IF EXISTS `pricing`;
CREATE TABLE `pricing` (
  `id` int(10) UNSIGNED NOT NULL,
  `fund_id` int(10) UNSIGNED NOT NULL,
  `update_date` date NOT NULL,
  `price_usd` decimal(6,2) NOT NULL,
  `price_usd_change` decimal(5,2) NOT NULL,
  `price_gbp` decimal(6,2) DEFAULT NULL,
  `price_gbp_change` decimal(5,2) DEFAULT NULL,
  `price_euro` decimal(6,2) DEFAULT NULL,
  `price_euro_change` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pricing`
--

INSERT INTO `pricing` (`id`, `fund_id`, `update_date`, `price_usd`, `price_usd_change`, `price_gbp`, `price_gbp_change`, `price_euro`, `price_euro_change`) VALUES
(1, 1, '2018-09-11', '11.00', '1.00', NULL, NULL, NULL, NULL),
(2, 1, '2018-09-10', '10.05', '1.25', NULL, NULL, NULL, NULL),
(3, 4, '2018-09-10', '62.52', '-0.77', '81.40', '-0.57', '70.15', '-0.61'),
(4, 5, '2018-09-10', '57.30', '-0.71', '74.60', '-0.53', '64.29', '-0.57'),
(5, 6, '2018-09-10', '52.66', '-0.66', '68.57', '-0.49', '59.09', '-0.53'),
(6, 7, '2018-09-10', '63.19', '-0.45', NULL, NULL, NULL, NULL),
(7, 8, '2018-09-10', '63.74', '-0.46', NULL, NULL, NULL, NULL),
(8, 9, '2018-09-10', '37.82', '-0.23', NULL, NULL, NULL, NULL),
(9, 10, '2018-09-10', '124.14', '-1.84', NULL, NULL, NULL, NULL),
(10, 11, '2018-09-10', '19.50', '-0.02', NULL, NULL, NULL, NULL),
(11, 12, '2018-09-10', '20.53', '0.09', NULL, NULL, NULL, NULL),
(12, 13, '2018-09-10', '64.04', '-0.45', NULL, NULL, NULL, NULL),
(13, 14, '2018-09-10', '65.31', '-0.49', NULL, NULL, NULL, NULL),
(14, 15, '2018-09-10', '38.05', '-0.26', NULL, NULL, NULL, NULL),
(15, 16, '2018-09-10', '11.73', '-0.07', NULL, NULL, NULL, NULL),
(16, 17, '2018-09-10', '15.89', '0.04', NULL, NULL, NULL, NULL),
(17, 18, '2018-09-10', '15.92', '0.04', NULL, NULL, NULL, NULL),
(18, 19, '2018-09-10', '10.47', '0.05', NULL, NULL, NULL, NULL),
(19, 20, '2018-09-10', '8.25', '-0.06', NULL, NULL, NULL, NULL),
(20, 21, '2018-09-10', '10.56', '0.04', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(128) NOT NULL,
  `employeeid` varchar(10) NOT NULL,
  `permissions` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `username`, `password`, `employeeid`, `permissions`) VALUES
(1, 'testuser1', 'password', '0000000000', 2),
(2, 'testuser2', 'password', '000000', 1),
(3, 'admin', 'password', '00000000', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients_funds`
--
ALTER TABLE `clients_funds`
  ADD PRIMARY KEY (`client_id`,`fund_id`);

--
-- Indexes for table `funds`
--
ALTER TABLE `funds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fundid` (`fundid`);

--
-- Indexes for table `pricing`
--
ALTER TABLE `pricing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `funds`
--
ALTER TABLE `funds`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pricing`
--
ALTER TABLE `pricing`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
