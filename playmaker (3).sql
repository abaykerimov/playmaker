-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 22 2017 г., 18:56
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `playmaker`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Archive_A`
--

CREATE TABLE IF NOT EXISTS `Archive_A` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL,
  `hour` int(11) NOT NULL,
  `minute` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `finish_time` datetime NOT NULL,
  `datetime` datetime NOT NULL,
  `club_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Дамп данных таблицы `Archive_A`
--

INSERT INTO `Archive_A` (`id`, `table_id`, `hour`, `minute`, `price`, `date`, `time`, `finish_time`, `datetime`, `club_id`) VALUES
(13, 9, 2, 0, 800, '2017-05-20', '23:00:06', '2017-05-21 01:00:06', '2017-05-20 23:00:06', 1),
(24, 4, 10, 0, 1700, '2017-05-21', '22:28:00', '2017-05-22 04:10:00', '2017-05-21 22:28:00', 1),
(25, 7, 2, 60, 1200, '2017-05-22', '02:17:33', '2017-05-22 02:51:41', '2017-05-22 02:17:33', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Archive_B`
--

CREATE TABLE IF NOT EXISTS `Archive_B` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL,
  `hour` int(11) NOT NULL,
  `minute` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `finish_time` datetime NOT NULL,
  `datetime` datetime NOT NULL,
  `club_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Дамп данных таблицы `Archive_B`
--

INSERT INTO `Archive_B` (`id`, `table_id`, `hour`, `minute`, `price`, `date`, `time`, `finish_time`, `datetime`, `club_id`) VALUES
(1, 1, 1, 0, 1, '2017-05-18', '00:00:00', '2017-05-21 02:00:00', '2017-05-18 00:00:00', 1),
(4, 7, 1, 0, 500, '2017-05-19', '03:03:12', '2017-05-21 00:00:00', '2017-05-19 03:03:12', 1),
(5, 10, 2, 0, 800, '2017-05-20', '13:28:47', '2017-05-21 00:00:00', '2017-05-20 13:28:47', 1),
(6, 6, 2, 0, 900, '2017-05-20', '13:32:52', '2017-05-21 00:00:00', '2017-05-20 13:32:52', 1),
(7, 4, 1, 0, 400, '2017-05-20', '13:38:43', '2017-05-21 00:00:00', '2017-05-20 13:38:43', 1),
(11, 0, 2, 0, 800, '2017-05-20', '14:19:05', '2017-05-21 00:00:00', '2017-05-20 14:19:05', 1),
(12, 0, 2, 0, 800, '2017-05-20', '22:58:08', '2017-05-21 00:00:00', '2017-05-20 22:58:08', 1),
(13, 9, 2, 0, 800, '2017-05-20', '23:00:06', '2017-05-21 01:00:06', '2017-05-20 23:00:06', 1),
(14, 2, 2, 0, 900, '2017-05-21', '12:47:26', '2017-05-21 14:47:26', '2017-05-21 12:47:26', 1),
(15, 0, 1, 0, 900, '2017-05-21', '13:53:12', '2017-05-21 14:53:12', '2017-05-21 13:53:12', 1),
(16, 0, 2, 0, 900, '2017-05-21', '13:55:32', '2017-05-21 15:55:32', '2017-05-21 13:55:32', 1),
(17, 8, 2, 0, 900, '2017-05-21', '14:33:04', '2017-05-21 16:33:04', '2017-05-21 14:33:04', 1),
(18, 0, 3, 0, 900, '2017-05-21', '14:37:10', '2017-05-21 17:37:10', '2017-05-21 14:37:10', 1),
(19, 1, 1, 0, 400, '2017-05-21', '18:19:42', '2017-05-21 19:19:42', '2017-05-21 18:19:42', 1),
(20, 2, 1, 30, 600, '2017-05-21', '18:21:56', '2017-05-21 19:21:56', '2017-05-21 18:21:56', 1),
(21, 0, 1, 30, 600, '2017-05-21', '18:33:40', '2017-05-21 19:33:40', '2017-05-21 18:33:40', 1),
(22, 0, 1, 30, 600, '2017-05-21', '18:35:02', '2017-05-21 19:35:02', '2017-05-21 18:35:02', 1),
(23, 3, 1, 30, 600, '2017-05-21', '18:39:27', '2017-05-21 20:09:27', '2017-05-21 18:39:27', 1),
(24, 4, 10, 0, 1700, '2017-05-21', '22:28:00', '2017-05-22 04:10:00', '2017-05-21 22:28:00', 1),
(25, 7, 2, 60, 1200, '2017-05-22', '02:17:33', '2017-05-22 02:51:41', '2017-05-22 02:17:33', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Board`
--

CREATE TABLE IF NOT EXISTS `Board` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL,
  `hour` int(11) NOT NULL,
  `minute` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `finish_time` datetime NOT NULL,
  `datetime` datetime NOT NULL,
  `club_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Дамп данных таблицы `Board`
--

INSERT INTO `Board` (`id`, `table_id`, `hour`, `minute`, `price`, `date`, `time`, `finish_time`, `datetime`, `club_id`) VALUES
(2, 2, 2, 0, 2, '2017-05-20', '00:00:00', '2017-05-21 01:00:00', '2017-05-20 00:00:00', 2),
(3, 3, 3, 0, 3, '2017-05-20', '00:00:00', '2017-05-21 03:00:00', '2017-05-20 00:00:00', 3),
(26, 1, 2, 0, 800, '2017-05-22', '17:40:28', '2017-05-22 19:40:28', '2017-05-22 17:40:28', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `Clubs`
--

CREATE TABLE IF NOT EXISTS `Clubs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `Clubs`
--

INSERT INTO `Clubs` (`id`, `name`) VALUES
(1, 'PS4'),
(2, 'PS4-2'),
(3, 'PS4-3'),
(4, 'PS4-4');

-- --------------------------------------------------------

--
-- Структура таблицы `Tables`
--

CREATE TABLE IF NOT EXISTS `Tables` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `Tables`
--

INSERT INTO `Tables` (`id`, `name`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5'),
(6, '6'),
(7, '7'),
(8, '8'),
(9, '9'),
(10, '10'),
(11, 'VIP');

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id`, `username`, `fullname`, `email`, `phone`, `password`, `created`, `status`, `club_id`) VALUES
(1, '', 'ABAY KERIMOV', 'abay-001@mail.ru', '+7 (777) 777-77-77', '6bca9a79ea538ba1f38ad6448f26720f', '0000-00-00 00:00:00', 1, 0),
(2, '', 'ABAY KERIMOV', 'abaykerimov@gmail.com', '+7 (222) 222-22-22', 'e1b66480755bf9528ef2917a64500bec', '2017-05-18 17:12:57', 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `User_Statuses`
--

CREATE TABLE IF NOT EXISTS `User_Statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `User_Statuses`
--

INSERT INTO `User_Statuses` (`id`, `name`) VALUES
(1, 'Админ'),
(2, 'Оператор'),
(3, 'Пользователь');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
