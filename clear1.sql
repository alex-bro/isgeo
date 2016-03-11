-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.5.45 - MySQL Community Server (GPL)
-- ОС Сервера:                   Win32
-- HeidiSQL Версия:              9.3.0.4999
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Дамп структуры для таблица isgeo.area
CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `koatu` varchar(255) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица isgeo.domain
CREATE TABLE IF NOT EXISTS `domain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `koatu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица isgeo.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) DEFAULT '1',
  `type` tinyint(1) DEFAULT '1',
  `path` varchar(255) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_files_files` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица isgeo.kadnum
CREATE TABLE IF NOT EXISTS `kadnum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) DEFAULT '1',
  `kad0` varchar(10) DEFAULT NULL,
  `kad1` varchar(2) DEFAULT NULL,
  `kad2` varchar(3) DEFAULT NULL,
  `kad3` varchar(4) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `fio` varchar(255) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица isgeo.log
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` tinyint(4) DEFAULT NULL,
  `user_id` smallint(6) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_log_loglist` (`action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица isgeo.loglist
CREATE TABLE IF NOT EXISTS `loglist` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица isgeo.options
CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица isgeo.post
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `title` varchar(255) DEFAULT NULL,
  `fio` varchar(255) DEFAULT NULL,
  `date` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` text,
  `square` float DEFAULT NULL,
  `files_id` int(11) DEFAULT NULL,
  `domain_id` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_post_files` (`files_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица isgeo.region
CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `koatu` varchar(255) NOT NULL,
  `domain_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица isgeo.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `realname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `realname` (`realname`),
  KEY `FK_user_user_role` (`user_role_id`),
  CONSTRAINT `FK_user_user_role` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для таблица isgeo.user_role
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Экспортируемые данные не выделены.


-- Дамп структуры для триггер isgeo.files_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `files_before_insert` BEFORE INSERT ON `files` FOR EACH ROW SET new.date = UNIX_TIMESTAMP(NOW())//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Дамп структуры для триггер isgeo.files_before_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `files_before_update` BEFORE UPDATE ON `files` FOR EACH ROW SET new.date = UNIX_TIMESTAMP(NOW())//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Дамп структуры для триггер isgeo.kadnum_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `kadnum_before_insert` BEFORE INSERT ON `kadnum` FOR EACH ROW SET new.date = UNIX_TIMESTAMP(NOW())//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Дамп структуры для триггер isgeo.kadnum_before_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `kadnum_before_update` BEFORE UPDATE ON `kadnum` FOR EACH ROW SET new.date = UNIX_TIMESTAMP(NOW())//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Дамп структуры для триггер isgeo.log_timestamp_ins
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `log_timestamp_ins` BEFORE INSERT ON `log` FOR EACH ROW SET new.date = UNIX_TIMESTAMP(NOW())//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Дамп структуры для триггер isgeo.log_timestamp_up
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `log_timestamp_up` BEFORE UPDATE ON `log` FOR EACH ROW SET new.date = UNIX_TIMESTAMP(NOW())//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Дамп структуры для триггер isgeo.post_timestamp_ins
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `post_timestamp_ins` BEFORE INSERT ON `post` FOR EACH ROW SET new.date = UNIX_TIMESTAMP(NOW())//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Дамп структуры для триггер isgeo.post_timestamp_up
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='';
DELIMITER //
CREATE TRIGGER `post_timestamp_up` BEFORE UPDATE ON `post` FOR EACH ROW SET new.date = UNIX_TIMESTAMP(NOW())//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
