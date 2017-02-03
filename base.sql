-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Час створення: Лют 03 2017 р., 11:24
-- Версія сервера: 5.6.35
-- Версія PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `testtask`
--
CREATE DATABASE IF NOT EXISTS `testtask` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `testtask`;

-- --------------------------------------------------------

--
-- Структура таблиці `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `abbreviation` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп даних таблиці `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `abbreviation`) VALUES
(1, 'United States Dollar', 'USD'),
(2, 'Euro', 'EUR'),
(3, 'Great Britain Pound', 'GBP');

-- --------------------------------------------------------

--
-- Структура таблиці `exchange_rates`
--

CREATE TABLE IF NOT EXISTS `exchange_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `base_currency_id` int(11) NOT NULL,
  `quoted_currency_id` int(11) NOT NULL,
  `rate` float NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `date` (`date`,`base_currency_id`,`quoted_currency_id`),
  KEY `base_currency_id` (`base_currency_id`),
  KEY `exchange_rates_ibfk_2` (`quoted_currency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп даних таблиці `exchange_rates`
--

INSERT INTO `exchange_rates` (`id`, `date`, `base_currency_id`, `quoted_currency_id`, `rate`) VALUES
(1, '2017-02-03', 1, 2, 0.92524),
(2, '2017-02-03', 1, 3, 0.79634),
(3, '2017-02-03', 2, 1, 1.0808),
(4, '2017-02-03', 2, 3, 0.86068),
(5, '2017-02-03', 3, 1, 1.2558),
(6, '2017-02-03', 3, 2, 1.1619),
(7, '2017-02-02', 1, 2, 0.92524),
(8, '2017-02-02', 1, 3, 0.79634),
(9, '2017-02-02', 2, 1, 1.0808),
(10, '2017-02-02', 2, 3, 0.86068),
(11, '2017-02-02', 3, 1, 1.2558),
(12, '2017-02-02', 3, 2, 1.1619),
(13, '2017-02-01', 1, 2, 0.92678),
(14, '2017-02-01', 1, 3, 0.79164),
(15, '2017-02-01', 2, 1, 1.079),
(16, '2017-02-01', 2, 3, 0.85418),
(17, '2017-02-01', 3, 1, 1.2632),
(18, '2017-02-01', 3, 2, 1.1707),
(19, '2017-01-31', 1, 2, 0.9298),
(20, '2017-01-31', 1, 3, 0.8006),
(21, '2017-01-31', 2, 1, 1.0755),
(22, '2017-01-31', 2, 3, 0.86105),
(23, '2017-01-31', 3, 1, 1.2491),
(24, '2017-01-31', 3, 2, 1.1614),
(25, '2017-01-30', 1, 2, 0.94073),
(26, '2017-01-30', 1, 3, 0.79901),
(27, '2017-01-30', 2, 1, 1.063),
(28, '2017-01-30', 2, 3, 0.84935),
(29, '2017-01-30', 3, 1, 1.2515),
(30, '2017-01-30', 3, 2, 1.1774),
(31, '2017-01-29', 1, 2, 0.93624),
(32, '2017-01-29', 1, 3, 0.7974),
(33, '2017-01-29', 2, 1, 1.0681),
(34, '2017-01-29', 2, 3, 0.8517),
(35, '2017-01-29', 3, 1, 1.2541),
(36, '2017-01-29', 3, 2, 1.1741),
(37, '2017-01-28', 1, 2, 0.93624),
(38, '2017-01-28', 1, 3, 0.7974),
(39, '2017-01-28', 2, 1, 1.0681),
(40, '2017-01-28', 2, 3, 0.8517),
(41, '2017-01-28', 3, 1, 1.2541),
(42, '2017-01-28', 3, 2, 1.1741),
(43, '2017-01-27', 1, 2, 0.93624),
(44, '2017-01-27', 1, 3, 0.7974),
(45, '2017-01-27', 2, 1, 1.0681),
(46, '2017-01-27', 2, 3, 0.8517),
(47, '2017-01-27', 3, 1, 1.2541),
(48, '2017-01-27', 3, 2, 1.1741),
(49, '2017-01-26', 1, 2, 0.93458),
(50, '2017-01-26', 1, 3, 0.79573),
(51, '2017-01-26', 2, 1, 1.07),
(52, '2017-01-26', 2, 3, 0.85143),
(53, '2017-01-26', 3, 1, 1.2567),
(54, '2017-01-26', 3, 2, 1.1745),
(55, '2017-01-25', 1, 2, 0.93084),
(56, '2017-01-25', 1, 3, 0.79422),
(57, '2017-01-25', 2, 1, 1.0743),
(58, '2017-01-25', 2, 3, 0.85323),
(59, '2017-01-25', 3, 1, 1.2591),
(60, '2017-01-25', 3, 2, 1.172);

--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `exchange_rates`
--
ALTER TABLE `exchange_rates`
  ADD CONSTRAINT `exchange_rates_ibfk_1` FOREIGN KEY (`base_currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exchange_rates_ibfk_2` FOREIGN KEY (`quoted_currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
