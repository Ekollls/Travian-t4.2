-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 21, 2011 at 02:49 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%a2b`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%a2b` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `ckey` varchar(255) NOT NULL,
  `time_check` int(255) unsigned NOT NULL DEFAULT '0',
  `to_vid` int(255) unsigned NOT NULL,
  `u1` int(11) unsigned NOT NULL,
  `u2` int(11) unsigned NOT NULL,
  `u3` int(11) unsigned NOT NULL,
  `u4` int(11) unsigned NOT NULL,
  `u5` int(11) unsigned NOT NULL,
  `u6` int(11) unsigned NOT NULL,
  `u7` int(11) unsigned NOT NULL,
  `u8` int(11) unsigned NOT NULL,
  `u9` int(11) unsigned NOT NULL,
  `u10` int(11) unsigned NOT NULL,
  `u11` int(11) unsigned NOT NULL,
  `type` smallint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Dumping data for table `%PREFIX%a2b`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%links`
--

CREATE TABLE `%PREFIX%links` (
  `id` INT( 25 ) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userid` INT( 25 ) NOT NULL ,
  `name` VARCHAR( 50 ) NOT NULL ,
  `url` VARCHAR( 150 ) NOT NULL ,
  `pos` INT( 10 ) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = MYISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Dumping data for table `%PREFIX%links`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%abdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%abdata` (
  `vref` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `a1` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a2` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a3` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a4` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a5` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a6` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a7` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a8` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a9` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `a10` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b1` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b2` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b3` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b4` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b5` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b6` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b7` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b8` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b9` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `b10` tinyint(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`vref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%abdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%activate`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%activate` (
  `id` int(255) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` text NOT NULL,
  `tribe` tinyint(1) unsigned NOT NULL,
  `access` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `act` varchar(10) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `location` text NOT NULL,
  `act2` varchar(10) NOT NULL,
  `ancestor` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%activate`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%active`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%active` (
  `username` varchar(45) NOT NULL,
  `timestamp` int(11) unsigned NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%PREFIX%active`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%admin_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%admin_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` text NOT NULL,
  `log` text NOT NULL,
  `time` int(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Dumping data for table `%PREFIX%admin_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%farmlist`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%farmlist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wref` int(10) unsigned NOT NULL,
  `owner` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%farmlist`
--

-- --------------------------------------------------------

--
-- Table structure for table `%prefix%raidlist`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%raidlist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lid` int(10) NOT NULL,
  `towref` int(10) unsigned NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `distance` varchar(5) NOT NULL DEFAULT '0',
  `t1` int(11) unsigned NOT NULL,
  `t2` int(11) unsigned NOT NULL,
  `t3` int(11) unsigned NOT NULL,
  `t4` int(11) unsigned NOT NULL,
  `t5` int(11) unsigned NOT NULL,
  `t6` int(11) unsigned NOT NULL,
  `t7` int(11) unsigned NOT NULL,
  `t8` int(11) unsigned NOT NULL,
  `t9` int(11) unsigned NOT NULL,
  `t10` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%raidlist`
--


-- --------------------------------------------------------


--
-- Table structure for table `%PREFIX%allimedal`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%allimedal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `allyid` int(11) NOT NULL,
  `categorie` int(11) NOT NULL,
  `plaats` int(11) NOT NULL,
  `week` int(11) NOT NULL,
  `points` bigint(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------


--
-- Table structure for table `%PREFIX%artefacts`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%artefacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(10) unsigned NOT NULL,
  `owner` int(10) unsigned NOT NULL,
  `type` int(3) unsigned NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `conquered` int(10) unsigned NOT NULL,
  `lastupdate` int(10) unsigned NOT NULL,
  `status` int(10) unsigned NOT NULL,
  `name` varchar(85) NOT NULL,
  `desc` text NOT NULL,
  `effecttype` int(10) NOT NULL,
  `effect` double NOT NULL,
  `aoe` int(10) NOT NULL,
  `img` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Table structure for table `s1_artefacts`
--
-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%alidata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%alidata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `tag` varchar(8) NOT NULL,
  `leader` int(10) unsigned NOT NULL,
  `coor` int(10) unsigned NOT NULL,
  `advisor` int(10) unsigned NOT NULL,
  `recruiter` int(10) unsigned NOT NULL,
  `notice` text NOT NULL,
  `desc` text NOT NULL,
  `max` tinyint(2) unsigned NOT NULL,
  `ap` bigint(255) unsigned NOT NULL DEFAULT '0',
  `dp` bigint(255) unsigned NOT NULL DEFAULT '0',
  `Rc` bigint(255) NOT NULL DEFAULT '0',
  `RR` bigint(255)  NOT NULL DEFAULT '0',
  `Aap` bigint(255) unsigned NOT NULL DEFAULT '0',
  `Adp` bigint(255) unsigned NOT NULL DEFAULT '0',
  `clp` bigint(255) NOT NULL DEFAULT '0',
  `oldrank` bigint(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%alidata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%ali_invite`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%ali_invite` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `alliance` int(10) unsigned NOT NULL,
  `sender` int(10) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `accept` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%ali_invite`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%ali_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%ali_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aid` int(10) NOT NULL,
  `comment` text NOT NULL,
  `date` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%ali_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%ali_permission`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%ali_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `alliance` int(10) unsigned NOT NULL,
  `rank` varchar(20) NOT NULL,
  `opt1` int(1) unsigned NOT NULL DEFAULT '0',
  `opt2` int(1) unsigned NOT NULL DEFAULT '0',
  `opt3` int(1) unsigned NOT NULL DEFAULT '0',
  `opt4` int(1) unsigned NOT NULL DEFAULT '0',
  `opt5` int(1) unsigned NOT NULL DEFAULT '0',
  `opt6` int(1) unsigned NOT NULL DEFAULT '0',
  `opt7` int(1) unsigned NOT NULL DEFAULT '0',
  `opt8` int(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%ali_permission`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%attacks`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%attacks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `t1` int(11) unsigned NOT NULL,
  `t2` int(11) unsigned NOT NULL,
  `t3` int(11) unsigned NOT NULL,
  `t4` int(11) unsigned NOT NULL,
  `t5` int(11) unsigned NOT NULL,
  `t6` int(11) unsigned NOT NULL,
  `t7` int(11) unsigned NOT NULL,
  `t8` int(11) unsigned NOT NULL,
  `t9` int(11) unsigned NOT NULL,
  `t10` int(11) unsigned NOT NULL,
  `t11` int(11) unsigned NOT NULL,
  `attack_type` tinyint(1) NOT NULL,
  `ctar1` int(11) unsigned NOT NULL, 
  `ctar2` int(11) unsigned NOT NULL,
  `spy` int(11) unsigned NOT NULL, 
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%attacks`
--

-- --------------------------------------------------------

--
-- Table structure for table `%prefix%auction`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%auction` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `itemid` int(10) unsigned NOT NULL,
  `owner` int(10) unsigned NOT NULL,
  `btype` int(10) unsigned NOT NULL,
  `type` int(10) unsigned NOT NULL,
  `num` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `bids` int(10) NOT NULL,
  `silver` int(10) NOT NULL,
  `maxsilver` int(10) NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `finish` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Dumping data for table `%prefix%auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%banlist`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%banlist` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `reason` varchar(30) NOT NULL,
  `time` int(10) NOT NULL,
  `end` varchar(10) NOT NULL,
  `admin` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%banlist`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%bdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%bdata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wid` int(10) unsigned NOT NULL,
  `field` tinyint(2) unsigned NOT NULL,
  `type` tinyint(2) unsigned NOT NULL,
  `loopcon` tinyint(1) unsigned NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `master` tinyint(1) unsigned NOT NULL,
  `level` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%bdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%build_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%build_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wid` int(10) unsigned NOT NULL,
  `log` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%build_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%chat`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%chat` (
  `id` int(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `alli` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `msg` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `%prefix%deleting`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%deleting` (
  `uid` int(10) unsigned NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%deleting`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%demolition`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%demolition` (
  `vref` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `buildnumber` int(10) unsigned NOT NULL DEFAULT '0',
  `lvl` int(10) unsigned NOT NULL DEFAULT '0',
  `timetofinish` int(11) NOT NULL,
  PRIMARY KEY (`vref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%demolition`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%destroy_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%destroy_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wid` int(10) unsigned NOT NULL,
  `log` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%destroy_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%diplomacy`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%diplomacy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alli1` int(10) unsigned NOT NULL,
  `alli2` int(10) unsigned NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `accepted` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
--
-- Dumping data for table `%prefix%diplomacy`
--


-- --------------------------------------------------------


--
-- Table structure for table `%prefix%adventure`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%adventure` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `wref` int(10) NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `dif` tinyint(1) NOT NULL,
  `time` int(11) unsigned NOT NULL,
  `end` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
--
-- Dumping data for table `%prefix%adventure`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%enforcement`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%enforcement` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hero` int(11) unsigned NOT NULL DEFAULT '0',
  `u1` int(11) unsigned NOT NULL DEFAULT '0',
  `u2` int(11) unsigned NOT NULL DEFAULT '0',
  `u3` int(11) unsigned NOT NULL DEFAULT '0',
  `u4` int(11) unsigned NOT NULL DEFAULT '0',
  `u5` int(11) unsigned NOT NULL DEFAULT '0',
  `u6` int(11) unsigned NOT NULL DEFAULT '0',
  `u7` int(11) unsigned NOT NULL DEFAULT '0',
  `u8` int(11) unsigned NOT NULL DEFAULT '0',
  `u9` int(11) unsigned NOT NULL DEFAULT '0',
  `u10` int(11) unsigned NOT NULL DEFAULT '0',
  `u11` int(11) unsigned NOT NULL DEFAULT '0',
  `u12` int(11) unsigned NOT NULL DEFAULT '0',
  `u13` int(11) unsigned NOT NULL DEFAULT '0',
  `u14` int(11) unsigned NOT NULL DEFAULT '0',
  `u15` int(11) unsigned NOT NULL DEFAULT '0',
  `u16` int(11) unsigned NOT NULL DEFAULT '0',
  `u17` int(11) unsigned NOT NULL DEFAULT '0',
  `u18` int(11) unsigned NOT NULL DEFAULT '0',
  `u19` int(11) unsigned NOT NULL DEFAULT '0',
  `u20` int(11) unsigned NOT NULL DEFAULT '0',
  `u21` int(11) unsigned NOT NULL DEFAULT '0',
  `u22` int(11) unsigned NOT NULL DEFAULT '0',
  `u23` int(11) unsigned NOT NULL DEFAULT '0',
  `u24` int(11) unsigned NOT NULL DEFAULT '0',
  `u25` int(11) unsigned NOT NULL DEFAULT '0',
  `u26` int(11) unsigned NOT NULL DEFAULT '0',
  `u27` int(11) unsigned NOT NULL DEFAULT '0',
  `u28` int(11) unsigned NOT NULL DEFAULT '0',
  `u29` int(11) unsigned NOT NULL DEFAULT '0',
  `u30` int(11) unsigned NOT NULL DEFAULT '0',
  `u31` int(11) unsigned NOT NULL DEFAULT '0',
  `u32` int(11) unsigned NOT NULL DEFAULT '0',
  `u33` int(11) unsigned NOT NULL DEFAULT '0',
  `u34` int(11) unsigned NOT NULL DEFAULT '0',
  `u35` int(11) unsigned NOT NULL DEFAULT '0',
  `u36` int(11) unsigned NOT NULL DEFAULT '0',
  `u37` int(11) unsigned NOT NULL DEFAULT '0',
  `u38` int(11) unsigned NOT NULL DEFAULT '0',
  `u39` int(11) unsigned NOT NULL DEFAULT '0',
  `u40` int(11) unsigned NOT NULL DEFAULT '0',
  `u41` int(11) unsigned NOT NULL DEFAULT '0',
  `u42` int(11) unsigned NOT NULL DEFAULT '0',
  `u43` int(11) unsigned NOT NULL DEFAULT '0',
  `u44` int(11) unsigned NOT NULL DEFAULT '0',
  `u45` int(11) unsigned NOT NULL DEFAULT '0',
  `u46` int(11) unsigned NOT NULL DEFAULT '0',
  `u47` int(11) unsigned NOT NULL DEFAULT '0',
  `u48` int(11) unsigned NOT NULL DEFAULT '0',
  `u49` int(11) unsigned NOT NULL DEFAULT '0',
  `u50` int(11) unsigned NOT NULL DEFAULT '0',
  `from` int(10) unsigned NOT NULL DEFAULT '0',
  `vref` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%enforcement`
--

-- --------------------------------------------------------

--
-- Table structure for table `%prefix%trapped`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%trapped` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hero` int(11) unsigned NOT NULL DEFAULT '0',
  `u1` int(11) unsigned NOT NULL DEFAULT '0',
  `u2` int(11) unsigned NOT NULL DEFAULT '0',
  `u3` int(11) unsigned NOT NULL DEFAULT '0',
  `u4` int(11) unsigned NOT NULL DEFAULT '0',
  `u5` int(11) unsigned NOT NULL DEFAULT '0',
  `u6` int(11) unsigned NOT NULL DEFAULT '0',
  `u7` int(11) unsigned NOT NULL DEFAULT '0',
  `u8` int(11) unsigned NOT NULL DEFAULT '0',
  `u9` int(11) unsigned NOT NULL DEFAULT '0',
  `u10` int(11) unsigned NOT NULL DEFAULT '0',
  `u11` int(11) unsigned NOT NULL DEFAULT '0',
  `u12` int(11) unsigned NOT NULL DEFAULT '0',
  `u13` int(11) unsigned NOT NULL DEFAULT '0',
  `u14` int(11) unsigned NOT NULL DEFAULT '0',
  `u15` int(11) unsigned NOT NULL DEFAULT '0',
  `u16` int(11) unsigned NOT NULL DEFAULT '0',
  `u17` int(11) unsigned NOT NULL DEFAULT '0',
  `u18` int(11) unsigned NOT NULL DEFAULT '0',
  `u19` int(11) unsigned NOT NULL DEFAULT '0',
  `u20` int(11) unsigned NOT NULL DEFAULT '0',
  `u21` int(11) unsigned NOT NULL DEFAULT '0',
  `u22` int(11) unsigned NOT NULL DEFAULT '0',
  `u23` int(11) unsigned NOT NULL DEFAULT '0',
  `u24` int(11) unsigned NOT NULL DEFAULT '0',
  `u25` int(11) unsigned NOT NULL DEFAULT '0',
  `u26` int(11) unsigned NOT NULL DEFAULT '0',
  `u27` int(11) unsigned NOT NULL DEFAULT '0',
  `u28` int(11) unsigned NOT NULL DEFAULT '0',
  `u29` int(11) unsigned NOT NULL DEFAULT '0',
  `u30` int(11) unsigned NOT NULL DEFAULT '0',
  `u31` int(11) unsigned NOT NULL DEFAULT '0',
  `u32` int(11) unsigned NOT NULL DEFAULT '0',
  `u33` int(11) unsigned NOT NULL DEFAULT '0',
  `u34` int(11) unsigned NOT NULL DEFAULT '0',
  `u35` int(11) unsigned NOT NULL DEFAULT '0',
  `u36` int(11) unsigned NOT NULL DEFAULT '0',
  `u37` int(11) unsigned NOT NULL DEFAULT '0',
  `u38` int(11) unsigned NOT NULL DEFAULT '0',
  `u39` int(11) unsigned NOT NULL DEFAULT '0',
  `u40` int(11) unsigned NOT NULL DEFAULT '0',
  `u41` int(11) unsigned NOT NULL DEFAULT '0',
  `u42` int(11) unsigned NOT NULL DEFAULT '0',
  `u43` int(11) unsigned NOT NULL DEFAULT '0',
  `u44` int(11) unsigned NOT NULL DEFAULT '0',
  `u45` int(11) unsigned NOT NULL DEFAULT '0',
  `u46` int(11) unsigned NOT NULL DEFAULT '0',
  `u47` int(11) unsigned NOT NULL DEFAULT '0',
  `u48` int(11) unsigned NOT NULL DEFAULT '0',
  `u49` int(11) unsigned NOT NULL DEFAULT '0',
  `u50` int(11) unsigned NOT NULL DEFAULT '0',
  `from` int(10) unsigned NOT NULL DEFAULT '0',
  `vref` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%trapped`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%fdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%fdata` (
  `vref` int(10) unsigned NOT NULL,
  `f1` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f1t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f2` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f2t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f3` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f3t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f4` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f4t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f5` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f5t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f6` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f6t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f7` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f7t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f8` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f8t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f9` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f9t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f10` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f10t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f11` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f11t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f12` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f12t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f13` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f13t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f14` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f14t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f15` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f15t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f16` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f16t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f17` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f17t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f18` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f18t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f19` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f19t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f20` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f20t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f21` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f21t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f22` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f22t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f23` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f23t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f24` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f24t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f25` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f25t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f26` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f26t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f27` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f27t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f28` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f28t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f29` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f29t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f30` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f30t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f31` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f31t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f32` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f32t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f33` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f33t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f34` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f34t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f35` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f35t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f36` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f36t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f37` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f37t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f38` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f38t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f39` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f39t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f40` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f40t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f99` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `f99t` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `wwname` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`vref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `%prefix%fdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%forum_cat`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%forum_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` varchar(255) NOT NULL,
  `alliance` varchar(255) NOT NULL,
  `forum_name` varchar(255) NOT NULL,
  `forum_des` text NOT NULL,
  `forum_area` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%forum_cat`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%forum_edit`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%forum_edit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alliance` varchar(255) NOT NULL,
  `result` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%forum_edit`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%forum_post`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%forum_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post` longtext NOT NULL,
  `topic` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%forum_post`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%forum_topic`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%forum_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `post` longtext NOT NULL,
  `date` varchar(255) NOT NULL,
  `post_date` varchar(255) NOT NULL,
  `cat` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `alliance` varchar(255) NOT NULL,
  `ends` varchar(255) NOT NULL,
  `close` varchar(255) NOT NULL,
  `stick` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%forum_topic`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%gold_fin_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%gold_fin_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wid` int(10) unsigned NOT NULL,
  `log` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%gold_fin_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%hero`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%hero` (
  `heroid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) unsigned NOT NULL,
  `wref` int(11) unsigned NOT NULL,
  `level` int(11) unsigned NOT NULL,
  `adv` int(11) unsigned NOT NULL,
  `sucsadv` int(11) unsigned NOT NULL,
  `speed` int(11) unsigned NOT NULL,
  `itemspeed` int(2) unsigned NOT NULL,
  `points` int(11) unsigned NOT NULL,
  `experience` int(11) NOT NULL,
  `dead` tinyint(1) NOT NULL,
  `health` float(4,1) unsigned NOT NULL,
  `power` int(10) unsigned NOT NULL,
  `fsperpoint` int(10) unsigned NOT NULL,
  `itemfs` int(10) unsigned NOT NULL,
  `offBonus` int(11) unsigned NOT NULL,
  `defBonus` int(11) unsigned NOT NULL,
  `product` int(11) unsigned NOT NULL,
  `r0` tinyint(1) unsigned NOT NULL,
  `r1` tinyint(1) unsigned NOT NULL,
  `r2` tinyint(1) unsigned NOT NULL,
  `r3` tinyint(1) unsigned NOT NULL,
  `r4` tinyint(1) unsigned NOT NULL,
  `rc` tinyint(1) unsigned NOT NULL,
  `autoregen` tinyint(3) NOT NULL,
  `itemautoregen` tinyint(3) NOT NULL,
  `extraexpgain` tinyint(3) NOT NULL,
  `itemextraexpgain` tinyint(3) NOT NULL,
  `cpproduction` tinyint(3) NOT NULL,
  `itemcpproduction` tinyint(3) NOT NULL,
  `infantrytrain` tinyint(3) NOT NULL,
  `iteminfantrytrain` tinyint(3) NOT NULL,
  `cavalrytrain` tinyint(3) NOT NULL,
  `itemcavalrytrain` tinyint(3) NOT NULL,
  `rob` tinyint(3) NOT NULL,
  `itemrob` tinyint(3) NOT NULL,
  `extraresist` tinyint(3) NOT NULL,
  `itemextraresist` tinyint(3) NOT NULL,
  `vsnatars` tinyint(3) NOT NULL,
  `itemvsnatars` tinyint(3) NOT NULL,
  `accountmspeed` tinyint(3) NOT NULL,
  `itemaccountmspeed` tinyint(3) NOT NULL,
  `allymspeed` tinyint(3) NOT NULL,
  `itemallymspeed` tinyint(3) NOT NULL,
  `longwaymspeed` tinyint(3) NOT NULL,
  `itemlongwaymspeed` tinyint(3) NOT NULL,
  `returnmspeed` tinyint(3) NOT NULL,
  `itemreturnmspeed` tinyint(3) NOT NULL,
  `lastupdate` int(11) unsigned NOT NULL,
  `lastadv` int(11) unsigned NOT NULL DEFAULT '0',
  `hash` varchar(45) NOT NULL,
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`heroid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Dumping data for table `%PREFIX%hero`
--
-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%heroface`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%heroface` (
  `uid` int(10) unsigned NOT NULL,
  `gender` smallint(2) NOT NULL,
  `beard` smallint(2) NOT NULL,
  `ear` smallint(2) NOT NULL,
  `eye` smallint(2) NOT NULL,
  `eyebrow` smallint(2) NOT NULL,
  `face` smallint(2) NOT NULL,
  `hair` smallint(2) NOT NULL,
  `mouth` smallint(2) NOT NULL,
  `nose` smallint(2) NOT NULL,
  `color` smallint(2) NOT NULL,
  `foot` int(11) unsigned NOT NULL,
  `helmet` int(11) unsigned NOT NULL,
  `body` int(11) unsigned NOT NULL,
  `shoes` int(11) unsigned NOT NULL,
  `horse` int(11) unsigned NOT NULL,
  `leftHand` int(11) NOT NULL,
  `rightHand` int(11) NOT NULL,
  `bag` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `hash` varchar(50) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%PREFIX%heroface`
--

INSERT INTO `%PREFIX%heroface` (`uid`, `beard`, `ear`, `eye`, `eyebrow`, `face`, `hair`, `mouth`, `nose`, `color`, `foot`, `helmet`, `horse`, `leftHand`, `rightHand`, `bag`, `num`) VALUES
(4, 1, 2, 3, 2, 4, 3, 1, 0, 2, 0, 0, 0, 0, 0, 0, 0),
(1, 1, 2, 3, 2, 4, 3, 1, 0, 2, 0, 0, 0, 0, 0, 0, 0),
(2, 1, 2, 3, 2, 4, 3, 1, 0, 2, 0, 0, 0, 0, 0, 0, 0);


-- --------------------------------------------------------
--
-- Table structure for table `%PREFIX%heroitems`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%heroitems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `btype` int(10) unsigned NOT NULL,
  `type` int(10) unsigned NOT NULL,
  `num` int(10) NOT NULL,
  `proc` int(10) unsigned NOT NULL,

  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%heroitems`
--

-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%illegal_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%illegal_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `log` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%illegal_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%login_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%login_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%login_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%market`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%market` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(11) unsigned NOT NULL,
  `gtype` tinyint(1) unsigned NOT NULL,
  `gamt` int(11) unsigned NOT NULL,
  `wtype` tinyint(1) unsigned NOT NULL,
  `wamt` int(11) unsigned NOT NULL,
  `accept` tinyint(1) unsigned NOT NULL,
  `maxtime` int(11) unsigned NOT NULL,
  `alliance` int(11) unsigned NOT NULL,
  `merchant` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%market`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%market_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%market_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wid` int(10) unsigned NOT NULL,
  `log` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%market_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%mdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%mdata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `target` int(10) unsigned NOT NULL,
  `owner` int(10) unsigned NOT NULL,
  `topic` varchar(45) NOT NULL,
  `message` text NOT NULL,
  `viewed` tinyint(1) unsigned NOT NULL,
  `archived` tinyint(1) unsigned NOT NULL,
  `send` tinyint(1) unsigned NOT NULL,
  `time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%mdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%medal`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%medal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL,
  `categorie` int(10) unsigned NOT NULL,
  `plaats` int(10) unsigned NOT NULL,
  `week` int(10) unsigned NOT NULL,
  `points` varchar(15) NOT NULL,
  `img` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%medal`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%movement`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%movement` (
  `moveid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sort_type` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `from` int(11) unsigned NOT NULL DEFAULT '0',
  `to` int(11) unsigned NOT NULL DEFAULT '0',
  `ref` int(11) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `starttime` int(11) unsigned NOT NULL DEFAULT '0',
  `endtime` int(11) unsigned NOT NULL DEFAULT '0',
  `proc` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`moveid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%movement`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%ndata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%ndata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `toWref` int(10) unsigned NOT NULL,
  `ally` int(10) unsigned NOT NULL,
  `topic` text NOT NULL,
  `ntype` tinyint(1) unsigned NOT NULL,
  `data` text NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `viewed` tinyint(1) unsigned NOT NULL,
  `archive` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%ndata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%newproc`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%newproc` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `npw` varchar(45) NOT NULL,
  `nemail` varchar(45) NOT NULL,
  `act` varchar(10) NOT NULL,
  `time` int(11) unsigned NOT NULL,
  `proc` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%newproc`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%odata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%odata` (
  `wref` int(10) unsigned NOT NULL,
  `type` tinyint(2) unsigned NOT NULL,
  `conqured` int(10) unsigned NOT NULL,
  `wood` float(12,2) NOT NULL,
  `iron` float(12,2) NOT NULL,
  `clay` float(12,2) NOT NULL,
  `woodp` float(12,2) NOT NULL,
  `ironp` float(12,2) NOT NULL,
  `clayp` float(12,2) NOT NULL,
  `maxstore` int(10) unsigned NOT NULL,
  `crop` float(12,2) NOT NULL,
  `cropp` float(12,2) NOT NULL,
  `maxcrop` int(10) unsigned NOT NULL,
  `lasttrain` int(10) unsigned NOT NULL,
  `lastfarmed` int(10) unsigned NOT NULL,
  `lastupdated` int(10) unsigned NOT NULL,
  `loyalty` int(10) NOT NULL DEFAULT '100',
  `owner` int(10) unsigned NOT NULL DEFAULT '2',
  `name` varchar(32) NOT NULL DEFAULT 'Unoccupied Oasis',
  PRIMARY KEY (`wref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%odata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%online`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%online` (
  `name` varchar(32) NOT NULL,
  `time` varchar(32) NOT NULL,
  `sitter` int(1) unsigned NOT NULL,
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%online`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%research`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%research` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(10) unsigned NOT NULL,
  `tech` varchar(3) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%research`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%send`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%send` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wood` int(11) unsigned NOT NULL,
  `clay` int(11) unsigned NOT NULL,
  `iron` int(11) unsigned NOT NULL,
  `crop` int(11) unsigned NOT NULL,
  `merchant` tinyint(2) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%send`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%tdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%tdata` (
  `vref` int(10) unsigned NOT NULL,
  `t2` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t3` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t4` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t5` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t6` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t7` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t8` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t9` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t12` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t13` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t14` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t15` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t16` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t17` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t18` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t19` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t22` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t23` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t24` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t25` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t26` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t27` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t28` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t29` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t32` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t33` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t34` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t35` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t36` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t37` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t38` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t39` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t42` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t43` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t44` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t45` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t46` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t47` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t48` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `t49` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`vref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%tdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%tech_log`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%tech_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wid` int(10) unsigned NOT NULL,
  `log` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%tech_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%training`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%training` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `vref` int(10) unsigned NOT NULL,
  `unit` tinyint(2) unsigned NOT NULL,
  `amt` int(10) unsigned NOT NULL,
  `pop` int(10) unsigned NOT NULL,
  `timestamp` int(10) unsigned NOT NULL,
  `eachtime` int(10) unsigned NOT NULL,
  `commence` int(10) unsigned NOT NULL,
  `endat` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%training`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%units`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%units` (
  `vref` int(10) unsigned NOT NULL,
  `hero` int(11) unsigned NOT NULL DEFAULT '0',
  `u1` int(11) unsigned NOT NULL DEFAULT '0',
  `u2` int(11) unsigned NOT NULL DEFAULT '0',
  `u3` int(11) unsigned NOT NULL DEFAULT '0',
  `u4` int(11) unsigned NOT NULL DEFAULT '0',
  `u5` int(11) unsigned NOT NULL DEFAULT '0',
  `u6` int(11) unsigned NOT NULL DEFAULT '0',
  `u7` int(11) unsigned NOT NULL DEFAULT '0',
  `u8` int(11) unsigned NOT NULL DEFAULT '0',
  `u9` int(11) unsigned NOT NULL DEFAULT '0',
  `u10` int(11) unsigned NOT NULL DEFAULT '0',
  `u11` int(11) unsigned NOT NULL DEFAULT '0',
  `u12` int(11) unsigned NOT NULL DEFAULT '0',
  `u13` int(11) unsigned NOT NULL DEFAULT '0',
  `u14` int(11) unsigned NOT NULL DEFAULT '0',
  `u15` int(11) unsigned NOT NULL DEFAULT '0',
  `u16` int(11) unsigned NOT NULL DEFAULT '0',
  `u17` int(11) unsigned NOT NULL DEFAULT '0',
  `u18` int(11) unsigned NOT NULL DEFAULT '0',
  `u19` int(11) unsigned NOT NULL DEFAULT '0',
  `u20` int(11) unsigned NOT NULL DEFAULT '0',
  `u21` int(11) unsigned NOT NULL DEFAULT '0',
  `u22` int(11) unsigned NOT NULL DEFAULT '0',
  `u23` int(11) unsigned NOT NULL DEFAULT '0',
  `u24` int(11) unsigned NOT NULL DEFAULT '0',
  `u25` int(11) unsigned NOT NULL DEFAULT '0',
  `u26` int(11) unsigned NOT NULL DEFAULT '0',
  `u27` int(11) unsigned NOT NULL DEFAULT '0',
  `u28` int(11) unsigned NOT NULL DEFAULT '0',
  `u29` int(11) unsigned NOT NULL DEFAULT '0',
  `u30` int(11) unsigned NOT NULL DEFAULT '0',
  `u31` int(11) unsigned NOT NULL DEFAULT '0',
  `u32` int(11) unsigned NOT NULL DEFAULT '0',
  `u33` int(11) unsigned NOT NULL DEFAULT '0',
  `u34` int(11) unsigned NOT NULL DEFAULT '0',
  `u35` int(11) unsigned NOT NULL DEFAULT '0',
  `u36` int(11) unsigned NOT NULL DEFAULT '0',
  `u37` int(11) unsigned NOT NULL DEFAULT '0',
  `u38` int(11) unsigned NOT NULL DEFAULT '0',
  `u39` int(11) unsigned NOT NULL DEFAULT '0',
  `u40` int(11) unsigned NOT NULL DEFAULT '0',
  `u41` int(11) unsigned NOT NULL DEFAULT '0',
  `u42` int(11) unsigned NOT NULL DEFAULT '0',
  `u43` int(11) unsigned NOT NULL DEFAULT '0',
  `u44` int(11) unsigned NOT NULL DEFAULT '0',
  `u45` int(11) unsigned NOT NULL DEFAULT '0',
  `u46` int(11) unsigned NOT NULL DEFAULT '0',
  `u47` int(11) unsigned NOT NULL DEFAULT '0',
  `u48` int(11) unsigned NOT NULL DEFAULT '0',
  `u49` int(11) unsigned NOT NULL DEFAULT '0',
  `u50` int(11) unsigned NOT NULL DEFAULT '0',
  `u199` int(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`vref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%units`
--


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%users`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` text NOT NULL,
  `tribe` tinyint(1) unsigned NOT NULL,
  `access` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `gold` int(11) NOT NULL DEFAULT '0',
  `ip` text NOT NULL,
  `boughtgold` int(11) NOT NULL DEFAULT '0',
  `boughtmanabe` int(11) NOT NULL DEFAULT '0',
  `boughtmanabe2` int(11) NOT NULL DEFAULT '0',
  `boughthelp` int(10) NOT NULL DEFAULT '0',
  `settedup` text NOT NULL,
  `giftgold` int(11) NOT NULL DEFAULT '0',
  `transferedgold` int(11) NOT NULL DEFAULT '0',
  `seggold` int(11) NOT NULL DEFAULT '0',
  `usedgold` int(11) NOT NULL DEFAULT '0',
  `silver` int(11) NOT NULL DEFAULT '0',
  `giftsilver` int(11) NOT NULL DEFAULT '0',
  `gessilver` int(11) NOT NULL DEFAULT '0',
  `sisilver` int(11) NOT NULL DEFAULT '0',
  `bisilver` int(11) NOT NULL DEFAULT '0',
  `gender` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `birthday` date NOT NULL DEFAULT '0000-00-00',
  `location` text NOT NULL DEFAULT '',
  `desc1` text NOT NULL,
  `desc2` text NOT NULL,
  `plus` int(10) unsigned NOT NULL DEFAULT '0',
  `goldclub` int(10) unsigned NOT NULL DEFAULT '0',
  `escape` int(1) unsigned NOT NULL DEFAULT '0',
  `b1` int(10) unsigned NOT NULL DEFAULT '0',
  `b2` int(10) unsigned NOT NULL DEFAULT '0',
  `b3` int(10) unsigned NOT NULL DEFAULT '0',
  `b4` int(10) unsigned NOT NULL DEFAULT '0',
  `sit1` int(10) unsigned NOT NULL DEFAULT '0',
  `sit2` int(10) unsigned NOT NULL DEFAULT '0',
  `alliance` int(10) unsigned NOT NULL DEFAULT '0',
  `sessid` varchar(600) NOT NULL,
  `act` varchar(10) NOT NULL,
  `timestamp` int(10) unsigned NOT NULL DEFAULT '0',
  `ap` int(10) unsigned NOT NULL DEFAULT '0',
  `apall` int(10) unsigned NOT NULL DEFAULT '0',
  `dp` int(10) unsigned NOT NULL DEFAULT '0',
  `dpall` int(10) unsigned NOT NULL DEFAULT '0',
  `protect` int(10) unsigned NOT NULL,
  `quest` int(2) NOT NULL,
  `fquest` int(2) NOT NULL,
  `gpack` varchar(255) NOT NULL DEFAULT 'gpack/travian_default/',
  `cp` int(10) unsigned NOT NULL DEFAULT '1',
  `lastupdate` int(11) unsigned NOT NULL,
  `RR` int(255) NOT NULL DEFAULT '0',
  `Rc` int(255) NOT NULL DEFAULT '0',
  `ok` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `clp` bigint(255) NOT NULL DEFAULT '0',
  `oldrank` bigint(255) unsigned NOT NULL DEFAULT '0',
  `activateat` int(11) unsigned NOT NULL,
  `lang` varchar(5) NOT NULL DEFAULT 'en',
  `ancestor` varchar(45) NOT NULL,
  `ancestorgold` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `%prefix%users`
--

INSERT INTO `%PREFIX%users` (`id`, `username`, `password`, `email`, `tribe`, `access`, `gold`, `gender`, `birthday`, `location`, `desc1`, `desc2`, `plus`, `b1`, `b2`, `b3`, `b4`, `sit1`, `sit2`, `alliance`, `sessid`, `act`, `timestamp`, `ap`, `apall`, `dp`, `dpall`, `protect`, `quest`, `fquest`, `gpack`, `cp`, `lastupdate`, `RR`, `Rc`, `ok`) VALUES
(4, 'Multihunter', '', 'multihunter@ttwar.ir', 0, 9, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 25, 35, 'gpack/travian_default/', 1, 0, 0, 0, 0),
(1, 'Support', '', 'support@ttwar.ir', 1, 8, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 25, 35, 'gpack/travian_default/', 1, 0, 0, 0, 0),
(3, 'Nature', '', 'support@ttwar.ir', 4, 8, 0, 0, '0000-00-00', '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 0, 0, 0, 0, 25, 35, 'gpack/travian_default/', 1, 0, 0, 0, 0);


-- --------------------------------------------------------

--
-- Table structure for table `%PREFIX%invite`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%emailinvite` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `invemail` varchar(45) NOT NULL,
  `time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%PREFIX%invite`
--
-- --------------------------------------------------------

--
-- Table structure for table `%prefix%vdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%vdata` (
  `wref` int(10) unsigned NOT NULL,
  `owner` int(10) unsigned NOT NULL,
  `name` varchar(45) NOT NULL,
  `capital` tinyint(1) unsigned NOT NULL,
  `pop` int(10) unsigned NOT NULL,
  `cp` int(10) unsigned NOT NULL,
  `celebration` int(10) NOT NULL DEFAULT '0',
  `type` int(10) NOT NULL DEFAULT '0',
  `wood` float(12,2) NOT NULL,
  `clay` float(12,2) NOT NULL,
  `iron` float(12,2) NOT NULL,
  `woodp` float(12,2) NOT NULL,
  `clayp` float(12,2) NOT NULL,
  `ironp` float(12,2) NOT NULL,
  `maxstore` int(10) unsigned NOT NULL,
  `maxstoref` int(10) unsigned NOT NULL,
  `prodf` int(10) unsigned NOT NULL,
  `crop` float(12,2) NOT NULL,
  `cropp` float(12,2) NOT NULL,
  `maxcrop` int(10) unsigned NOT NULL,
  `upkeep` float(10) unsigned NOT NULL,
  `lastupdate` int(11) unsigned NOT NULL,
  `loyalty` int(3) NOT NULL DEFAULT '100',
  `exp1` int(10) NOT NULL,
  `exp2` int(10) NOT NULL,
  `exp3` int(10) NOT NULL,
  `created` int(11) NOT NULL,
  `natar` tinyint(1) unsigned NOT NULL,
  `starv` int(10) unsigned NOT NULL,
  `expandedfrom` int(10) unsigned NOT NULL,
  PRIMARY KEY (`wref`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `%prefix%vdata`
--


-- --------------------------------------------------------

--
-- Table structure for table `%prefix%wdata`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%wdata` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fieldtype` tinyint(2) unsigned NOT NULL,
  `oasistype` tinyint(2) unsigned NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `occupied` tinyint(1) NOT NULL,
  `image` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `%prefix%wdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `%prefix%natarsprogress`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%natarsprogress` (
  `lastexpandat` int(11) NOT NULL,
  `lastpopupedvillage` int(11) NOT NULL,
  `lastpopupat` int(11) NOT NULL,
  `artefactreleased` tinyint(1) NOT NULL,
  `artefactreleasedat` int(11) NOT NULL,
  `wwbpreleased` tinyint(1) NOT NULL,
  `wwbpreleasedat` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `%PREFIX%natarsprogress` (`lastexpandat`, `lastpopupedvillage`, `lastpopupat`, `artefactreleased`, `artefactreleasedat`, `wwbpreleased`, `wwbpreleasedat`) VALUES
(0, 0, 0, 0, 0, 0, 0);


--
-- Table structure for table `%prefix%bill`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%bill` (
  `invoicenumber` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `invoiceamountusd` double NOT NULL,
  `invoiceamount` double NOT NULL,
  `invoicedate` int(11) NOT NULL,
  `transactionreferenceid` bigint(15) NOT NULL,
  `goldcount` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `buyer_name` varchar(255) NOT NULL,
  `buyer_tel` varchar(255) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `approved` tinyint(1) NOT NULL default '0',
  `approvedate` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `payedby` varchar(255) NOT NULL,
  PRIMARY KEY  (`invoicenumber`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

--
-- Dumping data for table `%prefix%bill`
--
-- --------------------------------------------------------

--
-- Table structure for table `%prefix%autoprogress`
--

CREATE TABLE IF NOT EXISTS `%PREFIX%autoprogress` (
  `medals` int(11) NOT NULL,
  `clearAndDeleting` int(11) NOT NULL,
  `loyaltyRegeneration` int(11) NOT NULL,
  `updateHero` int(11) NOT NULL,
  `celebrationComplete` int(11) NOT NULL,
  `culturePoints` int(11) NOT NULL,
  `researchComplete` int(11) NOT NULL,
  `starvation` int(11) NOT NULL,
  `buildComplete` int(11) NOT NULL,
  `auctionComplete` int(11) NOT NULL,
  `marketComplete` int(11) NOT NULL,
  `trainingComplete` int(11) NOT NULL,
  `sendreinfunitsComplete` int(11) NOT NULL,
  `returnunitsComplete` int(11) NOT NULL,
  `sendSettlersComplete` int(11) NOT NULL,
  `sendAdventuresComplete` int(11) NOT NULL,
  `demolitionComplete` int(11) NOT NULL,
  `sendunitsComplete` int(11) NOT NULL,
  `natarJobs` int(11) NOT NULL,
  `zeroPopedVillages` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `%PREFIX%autoprogress` (`medals`, `clearAndDeleting`, `loyaltyRegeneration`, `updateHero`, `celebrationComplete`, `culturePoints`, `researchComplete`, `starvation`, `buildComplete`, `auctionComplete`, `marketComplete`, `trainingComplete`, `sendreinfunitsComplete`, `returnunitsComplete`, `sendSettlersComplete`, `sendAdventuresComplete`, `demolitionComplete`, `sendunitsComplete`, `natarJobs`, `zeroPopedVillages`) VALUES
(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
