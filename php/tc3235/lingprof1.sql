-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 08, 2010 at 03:35 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lingprof`
--

-- --------------------------------------------------------

--
-- Table structure for table `definitions`
--

CREATE TABLE IF NOT EXISTS `definitions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word_id` int(10) unsigned NOT NULL,
  `definition` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `definitions`
--


-- --------------------------------------------------------

--
-- Table structure for table `endings`
--

CREATE TABLE IF NOT EXISTS `endings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(10) unsigned NOT NULL,
  `ending` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `endings`
--


-- --------------------------------------------------------

--
-- Table structure for table `examples`
--

CREATE TABLE IF NOT EXISTS `examples` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word_id` int(10) unsigned NOT NULL,
  `example` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `examples`
--


-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `description`) VALUES
(1, '1st Person Singular'),
(2, '1st Person Plural'),
(3, '2nd Person Singular'),
(4, '2nd Person Plural'),
(5, '3rd Person Singular'),
(6, '3rd Person Plural');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`) VALUES
(1, 'English'),
(2, 'Portuguese');

-- --------------------------------------------------------

--
-- Table structure for table `participles`
--

CREATE TABLE IF NOT EXISTS `participles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `participles`
--

INSERT INTO `participles` (`id`, `description`) VALUES
(1, 'Past Participle'),
(2, 'Present Participle');

-- --------------------------------------------------------

--
-- Table structure for table `regularity`
--

CREATE TABLE IF NOT EXISTS `regularity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `regular` tinyint(3) unsigned NOT NULL,
  `ending_id` int(10) unsigned NOT NULL,
  `word_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `regularity`
--


-- --------------------------------------------------------

--
-- Table structure for table `tenses`
--

CREATE TABLE IF NOT EXISTS `tenses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tenses`
--

INSERT INTO `tenses` (`id`, `description`) VALUES
(1, 'Personal Infinitive'),
(2, 'Present Indicative'),
(3, 'Imperfect Indicative'),
(4, 'Preterit Indicative'),
(5, 'Pluperfect Indicative'),
(6, 'Future Indicative'),
(7, 'Pres Perf Indicative'),
(8, 'Past Perf Indicative'),
(9, 'Fut Perf Indicative'),
(10, 'Present Subjunctive'),
(11, 'Imperfect Subjunctive'),
(12, 'Future Subjunctive'),
(13, 'Pres Perf Subjunctive'),
(14, 'Past Perf Subjunctive'),
(15, 'Fut Perf Subjunctive'),
(16, 'Conditional'),
(17, 'Conditional Perfect'),
(18, 'Imperative');

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE IF NOT EXISTS `translations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `src_content_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `translations`
--


-- --------------------------------------------------------

--
-- Table structure for table `w2f`
--

CREATE TABLE IF NOT EXISTS `w2f` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word_id` int(10) unsigned NOT NULL,
  `form_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `w2f`
--


-- --------------------------------------------------------

--
-- Table structure for table `w2t`
--

CREATE TABLE IF NOT EXISTS `w2t` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word_id` int(10) unsigned NOT NULL,
  `tense_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQUE` (`word_id`,`tense_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `w2t`
--


-- --------------------------------------------------------

--
-- Table structure for table `words`
--

CREATE TABLE IF NOT EXISTS `words` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(255) NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `language_id` int(10) unsigned NOT NULL,
  `participle_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `words`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
