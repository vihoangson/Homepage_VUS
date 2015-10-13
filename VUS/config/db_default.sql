-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 13, 2015 at 03:49 PM
-- Server version: 5.5.45
-- PHP Version: 5.5.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vus.vn`
--

-- --------------------------------------------------------

--
-- Table structure for table `baiviet`
--

CREATE TABLE IF NOT EXISTS `baiviet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `align_title` text CHARACTER SET latin1 NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `readmore` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) NOT NULL,
  `type_content` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_create` int(11) NOT NULL,
  `local_img` text COLLATE utf8_unicode_ci,
  `view` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2312 ;

-- --------------------------------------------------------

--
-- Table structure for table `baiviet_comment`
--

CREATE TABLE IF NOT EXISTS `baiviet_comment` (
  `cm_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id` int(11) NOT NULL,
  `timec` int(11) NOT NULL,
  PRIMARY KEY (`cm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `baiviet_nhom`
--

CREATE TABLE IF NOT EXISTS `baiviet_nhom` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `align_title` text NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Table structure for table `baiviet_nhommau`
--

CREATE TABLE IF NOT EXISTS `baiviet_nhommau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `typeblood` varchar(200) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Table structure for table `baiviet_tam`
--

CREATE TABLE IF NOT EXISTS `baiviet_tam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `align_title` text CHARACTER SET latin1 NOT NULL,
  `image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `readmore` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `cid` int(11) NOT NULL,
  `type_content` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_create` int(11) NOT NULL,
  `local_img` text COLLATE utf8_unicode_ci,
  `view` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2719 ;

-- --------------------------------------------------------

--
-- Table structure for table `kkat`
--

CREATE TABLE IF NOT EXISTS `kkat` (
  `id` tinyint(200) NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  `image_thumb` text NOT NULL,
  `name1` text,
  `SDASD` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `video_id` int(11) NOT NULL AUTO_INCREMENT,
  `video_title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `video_youtube` varchar(50) NOT NULL,
  `video_views` varchar(50) NOT NULL,
  PRIMARY KEY (`video_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3803 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
