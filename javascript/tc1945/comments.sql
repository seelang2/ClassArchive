CREATE TABLE IF NOT EXISTS `c_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `comment_timestamp` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `c_messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `c_users`
--

CREATE TABLE IF NOT EXISTS `c_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(40) NOT NULL,
  `username` varchar(15) NOT NULL,
  `last_request_ts` int(10) unsigned DEFAULT NULL,
  `vip` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`,`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `c_users`
--
