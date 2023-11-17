-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 06 2018 г., 15:09
-- Версия сервера: 5.6.37
-- Версия PHP: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Vacancy`
--

CREATE TABLE `Vacancy` (
  `id` int(11) NOT NULL,
  `Firm` int(11) NOT NULL,
  `Staff` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `Vacancy`
--

INSERT INTO `Vacancy` (`id`, `Firm`, `Staff`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 3, 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Vacancy`
--
ALTER TABLE `Vacancy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Firm` (`Firm`),
  ADD KEY `Staff` (`Staff`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Vacancy`
--
ALTER TABLE `Vacancy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Vacancy`
--
ALTER TABLE `Vacancy`
  ADD CONSTRAINT `vacancy_ibfk_1` FOREIGN KEY (`Firm`) REFERENCES `Firm` (`id`),
  ADD CONSTRAINT `vacancy_ibfk_2` FOREIGN KEY (`Staff`) REFERENCES `Staff` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
