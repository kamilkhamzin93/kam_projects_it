-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 22 2020 г., 21:58
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `it_projects_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `age` date NOT NULL,
  `picture` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `login` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `habits` text NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `age`, `picture`, `email`, `login`, `password`, `habits`, `time`) VALUES
(24, 'Камиль', 'Хамзин', '2020-03-12', 'SmVsbHlmaXNoLmpwZw==', 'kamil.xamzin.93@mail.ru', 'dev56', 'MjQwODE5OTM=', 'Money. Business. PHP.', '2020-03-19 18:37:39'),
(25, 'Камиль', 'Хамзин', '1970-01-01', 'Chrysanthemum.jpg', 'Ravil_ham@mail.ru', 'dev52', 'MjQwODE5OTM=', '', '2020-03-19 20:20:50'),
(27, 'Камиль', 'Хамзин', '2000-07-13', 'SmVsbHlmaXNoLmpwZw==', 'shkolagribanovo@mail.ru', 'shkolagribanovo', 'TzFhZWdkR0RVeg==', '', '2020-03-21 15:42:20');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
