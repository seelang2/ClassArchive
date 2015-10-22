-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2015 at 04:15 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tc8517`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(10) unsigned NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `hire_date` date NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(80) NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `last_login` datetime NOT NULL,
  `optin` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employees_groups`
--

DROP TABLE IF EXISTS `employees_groups`;
CREATE TABLE IF NOT EXISTS `employees_groups` (
  `employee_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employees_resources`
--

DROP TABLE IF EXISTS `employees_resources`;
CREATE TABLE IF NOT EXISTS `employees_resources` (
  `employee_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `permission` tinyint(3) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `event_start` datetime NOT NULL,
  `event_end` datetime NOT NULL,
  `description` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `supervisor_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups_resources`
--

DROP TABLE IF EXISTS `groups_resources`;
CREATE TABLE IF NOT EXISTS `groups_resources` (
  `group_id` int(10) unsigned NOT NULL,
  `resource_id` int(10) unsigned NOT NULL,
  `permission` tinyint(3) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  `message_date` datetime NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages_recipients`
--

DROP TABLE IF EXISTS `messages_recipients`;
CREATE TABLE IF NOT EXISTS `messages_recipients` (
  `recipient_id` int(10) unsigned NOT NULL,
  `message_id` int(10) unsigned NOT NULL,
  `read_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

DROP TABLE IF EXISTS `resources`;
CREATE TABLE IF NOT EXISTS `resources` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `type_id` tinyint(3) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `resourcetypes`
--

DROP TABLE IF EXISTS `resourcetypes`;
CREATE TABLE IF NOT EXISTS `resourcetypes` (
  `id` int(10) unsigned NOT NULL,
  `label` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(10) unsigned NOT NULL,
  `label` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `systemstate`
--

DROP TABLE IF EXISTS `systemstate`;
CREATE TABLE IF NOT EXISTS `systemstate` (
  `id` int(10) unsigned NOT NULL,
  `state` tinyint(3) unsigned NOT NULL,
  `event_id` int(10) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees_groups`
--
ALTER TABLE `employees_groups`
  ADD PRIMARY KEY (`employee_id`,`group_id`);

--
-- Indexes for table `employees_resources`
--
ALTER TABLE `employees_resources`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups_resources`
--
ALTER TABLE `groups_resources`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages_recipients`
--
ALTER TABLE `messages_recipients`
  ADD PRIMARY KEY (`recipient_id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resourcetypes`
--
ALTER TABLE `resourcetypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systemstate`
--
ALTER TABLE `systemstate`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employees_resources`
--
ALTER TABLE `employees_resources`
  MODIFY `employee_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `groups_resources`
--
ALTER TABLE `groups_resources`
  MODIFY `group_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages_recipients`
--
ALTER TABLE `messages_recipients`
  MODIFY `recipient_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `resourcetypes`
--
ALTER TABLE `resourcetypes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `systemstate`
--
ALTER TABLE `systemstate`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
