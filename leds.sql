-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 03 月 04 日 12:21
-- 服务器版本: 5.6.12-log
-- PHP 版本: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `mysql`
--

-- --------------------------------------------------------

--
-- 表的结构 `leds`
--

CREATE TABLE IF NOT EXISTS `leds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `leds`
--

INSERT INTO `leds` (`id`, `description`, `status`) VALUES
(1, 'RPi.PCF8574.IO0', 'off'),
(2, 'RPi.PCF8574.IO1', 'on'),
(3, 'RPi.PCF8574.IO2', 'off'),
(4, 'RPi.PCF8574.IO3', 'off'),
(5, 'RPi.PCF8574.IO4', 'on'),
(6, 'RPi.PCF8574.IO5', 'on'),
(7, 'RPi.PCF8574.IO6', 'off'),
(8, 'RPi.PCF8574.IO7', 'off'),
(9, 'RPi.IO0', 'on'),
(10, 'RPi.IO1', 'off'),
(11, 'RPi.IO2', 'on'),
(12, 'RPi.IO3', 'off'),
(13, 'TEST IO.0', 'off'),
(14, 'TEST IO.1', 'off'),
(15, 'TEST IO.2', 'on'),
(16, 'TEST IO.3', 'on'),
(17, 'TEST IO.x', 'off'),
(18, 'TEST IO.y', 'off'),
(19, 'TEST IO.z', 'off'),
(20, 'TEST IO.a', 'off'),
(21, '1233', 'on');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
