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

-- Дамп структуры для таблица isgeo.action
CREATE TABLE IF NOT EXISTS `action` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isgeo.action: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `action` DISABLE KEYS */;
/*!40000 ALTER TABLE `action` ENABLE KEYS */;


-- Дамп структуры для таблица isgeo.archive
CREATE TABLE IF NOT EXISTS `archive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `title` varchar(255) DEFAULT NULL,
  `fio` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` text,
  `square` float DEFAULT NULL,
  `domain_id` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_post_domain` (`domain_id`),
  KEY `FK_post_region` (`region_id`),
  KEY `FK_post_area` (`area_id`),
  CONSTRAINT `FK_post_area` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`),
  CONSTRAINT `FK_post_domain` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`),
  CONSTRAINT `FK_post_region` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isgeo.archive: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `archive` DISABLE KEYS */;
/*!40000 ALTER TABLE `archive` ENABLE KEYS */;


-- Дамп структуры для таблица isgeo.area
CREATE TABLE IF NOT EXISTS `area` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `koatu` varchar(255) DEFAULT NULL,
  `region_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_area_region1_idx` (`region_id`),
  CONSTRAINT `fk_area_region1` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isgeo.area: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `area` DISABLE KEYS */;
/*!40000 ALTER TABLE `area` ENABLE KEYS */;


-- Дамп структуры для таблица isgeo.domain
CREATE TABLE IF NOT EXISTS `domain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `koatu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isgeo.domain: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `domain` DISABLE KEYS */;
/*!40000 ALTER TABLE `domain` ENABLE KEYS */;


-- Дамп структуры для таблица isgeo.files
CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) DEFAULT '1',
  `type` tinyint(1) DEFAULT '1',
  `path` varchar(255) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_files_files` (`post_id`),
  CONSTRAINT `FK_files_post` FOREIGN KEY (`post_id`) REFERENCES `archive` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isgeo.files: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
/*!40000 ALTER TABLE `files` ENABLE KEYS */;


-- Дамп структуры для таблица isgeo.kadnum
CREATE TABLE IF NOT EXISTS `kadnum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) DEFAULT '1',
  `kad0` varchar(10) DEFAULT NULL,
  `kad1` varchar(2) DEFAULT NULL,
  `kad2` varchar(3) DEFAULT NULL,
  `kad3` varchar(4) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `fio` varchar(255) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_kadnum_post` (`post_id`),
  CONSTRAINT `FK_kadnum_post` FOREIGN KEY (`post_id`) REFERENCES `archive` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isgeo.kadnum: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `kadnum` DISABLE KEYS */;
/*!40000 ALTER TABLE `kadnum` ENABLE KEYS */;


-- Дамп структуры для таблица isgeo.log
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) DEFAULT NULL,
  `action_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `table_id` int(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_log_user` (`user_id`),
  KEY `FK_log_loglist` (`action_id`),
  KEY `fk_log_table1_idx` (`table_id`),
  CONSTRAINT `FK_log_loglist` FOREIGN KEY (`action_id`) REFERENCES `action` (`id`),
  CONSTRAINT `FK_log_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_log_table1` FOREIGN KEY (`table_id`) REFERENCES `table` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isgeo.log: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;


-- Дамп структуры для таблица isgeo.options
CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isgeo.options: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
/*!40000 ALTER TABLE `options` ENABLE KEYS */;


-- Дамп структуры для таблица isgeo.region
CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `koatu` varchar(255) NOT NULL,
  `domain_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_region_domain1_idx` (`domain_id`),
  CONSTRAINT `fk_region_domain1` FOREIGN KEY (`domain_id`) REFERENCES `domain` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isgeo.region: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
/*!40000 ALTER TABLE `region` ENABLE KEYS */;


-- Дамп структуры для таблица isgeo.table
CREATE TABLE IF NOT EXISTS `table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isgeo.table: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `table` DISABLE KEYS */;
/*!40000 ALTER TABLE `table` ENABLE KEYS */;


-- Дамп структуры для таблица isgeo.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
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

-- Дамп данных таблицы isgeo.user: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;


-- Дамп структуры для таблица isgeo.user_role
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы isgeo.user_role: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;


-- Дамп структуры для триггер isgeo.log_timestamp_ins
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `log_timestamp_ins` BEFORE INSERT ON `log` FOR EACH ROW SET new.date = UNIX_TIMESTAMP(NOW())//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;


-- Дамп структуры для триггер isgeo.log_timestamp_up
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='STRICT_TRANS_TABLES,STRICT_ALL_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ALLOW_INVALID_DATES,ERROR_FOR_DIVISION_BY_ZERO,TRADITIONAL,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `log_timestamp_up` BEFORE UPDATE ON `log` FOR EACH ROW SET new.date = UNIX_TIMESTAMP(NOW())//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
