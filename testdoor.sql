-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Мар 06 2023 г., 19:18
-- Версия сервера: 5.7.24
-- Версия PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `testdoor`
--

-- --------------------------------------------------------

--
-- Структура таблицы `color-door`
--

CREATE TABLE `color-door` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `namecss` text NOT NULL,
  `namehtml` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `color-door`
--

INSERT INTO `color-door` (`id`, `name`, `namecss`, `namehtml`) VALUES
(1, 'Красный', 'clred', '<option value=\"1\">Красный</option>'),
(2, 'Зеленый', 'clgreen', '<option value=\"2\">Зеленый</option>'),
(3, 'Синий', 'clblue', '<option value=\"3\">Синий</option>'),
(4, 'Белый', 'clwhite', '<option value=\"4\">Белый</option>'),
(5, 'Безжевый', 'clwheat', '<option value=\"5\">Безжевый</option>');

-- --------------------------------------------------------

--
-- Структура таблицы `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `coldoor` varchar(255) NOT NULL,
  `coldoorp` varchar(255) NOT NULL,
  `colknob` varchar(255) NOT NULL,
  `width` int(20) NOT NULL,
  `heig` int(20) NOT NULL,
  `opent` varchar(255) NOT NULL,
  `acsas` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `config`
--

INSERT INTO `config` (`id`, `coldoor`, `coldoorp`, `colknob`, `width`, `heig`, `opent`, `acsas`) VALUES
(1, '4', '', '1', 1, 1, '2', '2'),
(2, '2', '', '3', 1, 1, '2', '2'),
(3, 'Зеленый', '', '3', 1, 1, '2', '2'),
(4, 'Зеленый', '', '3', 1, 1, '2', '2'),
(5, 'Краснный', '', '2', 1, 1, '1', '1'),
(6, 'Краснный', 'None', 'Зеленый', 1, 1, '1', '1'),
(7, 'Краснный', 'None', 'Зеленый', 1, 1, '2', '2'),
(8, 'Краснный', 'None', 'Безжевый', 2, 2, '1', '1'),
(9, 'Зеленый', 'Белый', 'Безжевый', 1, 1, '', ''),
(10, 'Краснный', 'Белый', 'Белый', 1, 1, '', ''),
(11, 'Краснный', 'Зеленый', 'Белый', 70, 188, 'Правое', 'Правое'),
(12, 'Синий', 'Белый', 'Безжевый', 70, 188, 'Правое', 'Правое'),
(13, 'Синий', 'Краснный', 'Зеленый', 65, 188, 'Левое', 'Левое'),
(14, 'Синий', 'Краснный', 'Зеленый', 65, 188, 'Левое', 'Левое'),
(15, 'Краснный', 'Краснный', 'Краснный', 70, 188, 'Правое', 'Правое'),
(16, 'Краснный', 'Краснный', 'Краснный', 70, 188, 'Правое', 'a1'),
(17, 'Белый', 'Безжевый', 'Синий', 80, 200, 'Левое', 'a2');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `color-door`
--
ALTER TABLE `color-door`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `color-door`
--
ALTER TABLE `color-door`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
