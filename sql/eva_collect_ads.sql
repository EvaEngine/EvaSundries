# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 192.168.11.232 (MySQL 5.5.41-0ubuntu0.14.04.1)
# Database: wscn
# Generation Time: 2015-06-05 05:24:22 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table eva_collect_ads
# ------------------------------------------------------------

DROP TABLE IF EXISTS `eva_collect_ads`;

CREATE TABLE `eva_collect_ads` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `source` enum('domob','wanpu') COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '来源',
  `udid` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `mac` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `appId` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idfa` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `openudid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `os` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `callbackurl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdAt` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='记录第三方广告平台请求，如多盟，万普等平台';



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
