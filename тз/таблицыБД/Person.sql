-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 06 2018 г., 15:08
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
-- Структура таблицы `Person`
--

CREATE TABLE `Person` (
  `id` int(11) NOT NULL,
  `FIO` varchar(255) NOT NULL,
  `Staff` int(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Stage` int(10) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `Person`
--

INSERT INTO `Person` (`id`, `FIO`, `Staff`, `Phone`, `Stage`, `Image`, `created_at`, `updated_at`) VALUES
(5, 'Калугин', 3, '555555', 6, 'ava5.jpg', NULL, NULL),
(6, 'Веселина', 3, '666665', 8, 'ava6.jpg', NULL, NULL),
(7, 'Мистер Х', 2, '00-00-00', 3, 'ava1.jpg', '2017-12-05 17:40:47', '2017-12-05 17:40:47'),
(8, 'Мистер Х', 2, '00-00-00', 3, 'ava1.jpg', '2017-12-05 17:41:02', '2017-12-05 17:41:02'),
(10, 'Алейников', 1, '00-00-00', 3, 'ava4.jpg', '2017-12-10 16:20:15', '2017-12-10 16:20:15');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `Person`
--
ALTER TABLE `Person`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Staff` (`Staff`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `Person`
--
ALTER TABLE `Person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `Person`
--
ALTER TABLE `Person`
  ADD CONSTRAINT `person_ibfk_1` FOREIGN KEY (`Staff`) REFERENCES `Staff` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
