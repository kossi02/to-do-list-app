-- Adminer 4.8.1 MySQL 8.0.36-0ubuntu0.22.04.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE DATABASE `Task` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `Task`;

DROP TABLE IF EXISTS `list`;
CREATE TABLE `list` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `note` varchar(500) NOT NULL,
  `priority` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

INSERT INTO `list` (`id`, `title`, `note`, `priority`, `date`, `time`) VALUES
(17,	'clean the house',	'deep clean the kitchen',	'Low',	'2024-05-02',	'20:00:00'),
(19,	'PHP project',	'record and edit the video',	'High',	'2024-05-02',	'10:00:00'),
(20,	'Go for a walk (45 min)',	'take the Trash while leaving the apartment',	'Medium',	'2024-05-02',	'12:00:00');

-- 2024-05-02 18:30:42
