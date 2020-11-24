-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1:3306
-- 產生時間： 2020-11-25 01:44:30
-- 伺服器版本: 5.7.19
-- PHP 版本： 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `diary`
--

DELIMITER $$
--
-- Procedure
--
DROP PROCEDURE IF EXISTS `mydiary`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `mydiary` (IN `did` INT(64))  NO SQL
BEGIN
	SELECT title, content, date, pic1, pic2, pic3, pic4, pic5, pic6, pic7, pic8 
    FROM mydiary,pictures
    WHERE pictures.did = mydiary.did
    AND mydiary.did = did;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- 資料表結構 `mydiary`
--

DROP TABLE IF EXISTS `mydiary`;
CREATE TABLE IF NOT EXISTS `mydiary` (
  `did` int(64) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci,
  `content` text COLLATE utf8_unicode_ci,
  `date` date NOT NULL,
  `id` int(64) NOT NULL,
  PRIMARY KEY (`did`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `mydiary`
--

INSERT INTO `mydiary` (`did`, `title`, `content`, `date`, `id`) VALUES
(5, '韓國行PART1', '去韓國就是不停的吃吃吃！', '2020-11-25', 1),
(7, '台南行', '去台南玩~~~', '2020-11-25', 2),
(9, '貓咪~', '好可愛的貓咪。', '2020-11-25', 3),
(10, '貓咪', '幾乎都是在睡覺的照片', '2020-11-25', 1),
(12, '韓國行PART2', '繼續吃吃吃，韓國的粥真的好吃。', '2020-11-25', 1),
(13, '好天氣的一天', '今天天氣好好，最喜歡涼爽的天氣，天空也很漂亮，可惜沒有拍到照片。', '2020-11-25', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE IF NOT EXISTS `pictures` (
  `pid` int(64) NOT NULL AUTO_INCREMENT,
  `pic1` text COLLATE utf8_unicode_ci,
  `pic2` text CHARACTER SET utf32 COLLATE utf32_unicode_ci,
  `pic3` text COLLATE utf8_unicode_ci,
  `pic4` text COLLATE utf8_unicode_ci,
  `pic5` text COLLATE utf8_unicode_ci,
  `pic6` text COLLATE utf8_unicode_ci,
  `pic7` text COLLATE utf8_unicode_ci,
  `pic8` text COLLATE utf8_unicode_ci,
  `did` int(64) NOT NULL,
  PRIMARY KEY (`pid`),
  KEY `did` (`did`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `pictures`
--

INSERT INTO `pictures` (`pid`, `pic1`, `pic2`, `pic3`, `pic4`, `pic5`, `pic6`, `pic7`, `pic8`, `did`) VALUES
(5, 'https://i.imgur.com/rYfokp0.jpg', 'https://i.imgur.com/EkeOaIy.jpg', 'https://i.imgur.com/EqGAtsd.jpg', 'https://i.imgur.com/qmG93tZ.jpg', '', '', '', '', 5),
(7, 'https://i.imgur.com/gJprgM1.jpg', 'https://i.imgur.com/dJf4AcI.jpg', 'https://i.imgur.com/8gO94kf.jpg', '', '', '', '', '', 7),
(9, 'https://i.imgur.com/FAABnMA.jpg', 'https://i.imgur.com/1PGplN6.jpg', 'https://i.imgur.com/IFaGU3K.jpg', 'https://i.imgur.com/wzQW2uz.jpg', 'https://i.imgur.com/BhGI3FB.jpg', 'https://i.imgur.com/MI1sbtL.jpg', '', '', 9),
(10, 'https://i.imgur.com/vz2xg95.jpg', 'https://i.imgur.com/zA0cRFH.jpg', 'https://i.imgur.com/qNI7WeY.jpg', 'https://i.imgur.com/EWd8yri.jpg', 'https://i.imgur.com/gPFWMv6.jpg', 'https://i.imgur.com/ECJhtHf.jpg', '', '', 10),
(12, 'https://i.imgur.com/t6dvApj.jpg', 'https://i.imgur.com/7ACCG1k.jpg', 'https://i.imgur.com/bewZ2hJ.jpg', 'https://i.imgur.com/mbJ16D7.jpg', '', '', '', '', 12),
(13, '', '', '', '', '', '', '', '', 13);

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`) VALUES
(1, '蕭文琳', 'httplove116', 'love1163315'),
(2, '陳惠安', 'qoo12345', 'apple12345'),
(3, '李阿華', 'abcd', '12345678');

--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `mydiary`
--
ALTER TABLE `mydiary`
  ADD CONSTRAINT `mydiary_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 資料表的 Constraints `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `pictures_ibfk_1` FOREIGN KEY (`did`) REFERENCES `mydiary` (`did`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
