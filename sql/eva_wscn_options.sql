-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015-03-02 18:10:40
-- 服务器版本: 5.5.41-0ubuntu0.14.04.1
-- PHP 版本: 5.5.9-1ubuntu4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `wscn`
--

-- --------------------------------------------------------

--
-- 表的结构 `eva_wscn_options`
--

CREATE TABLE IF NOT EXISTS `eva_wscn_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `optionName` varchar(255) NOT NULL COMMENT '配置名称',
  `optionValue` varchar(255) NOT NULL COMMENT '配置值',
  `optionComment` varchar(255) NOT NULL COMMENT '配置注释',
  `createdAt` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='配置属性' AUTO_INCREMENT=11 ;

--
-- 转存表中的数据 `eva_wscn_options`
--

INSERT INTO `eva_wscn_options` (`id`, `optionName`, `optionValue`, `optionComment`, `createdAt`) VALUES
(1, 'zhongshanCloseStartAt', '1425260693', '中山维护开始时间', 1425190210),
(2, 'zhongshanCloseFinishAt', '1425292853', '中山维护结束时间', 1425190210),
(3, 'zhongshanCloseCopywriting', '中山证券维护中..', '中山维护文案', 1425190210);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
