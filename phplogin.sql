-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 20 2023 г., 01:43
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `phplogin`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Дамп данных таблицы `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`, `email`) VALUES
(4, 'WOKEEER', '$2y$10$y0ClfclDKiBehGr.QmG0VOfPsTVXTJAWQ.5Sn4gMKzSHF01/Y42wy', 'kudbodia@gmail.com'),
(5, 'test', '$2y$10$rIBBSNQMGlFPsGz7g3/rkeAy8etJuyznVUFs7KelPu3FPqK5ZDmzW', 'test@test.com'),
(6, 'test2', '$2y$10$dserj0JcuAWtcwsN6R0HZ.j1so8EeXo5YkpP4GQDY2NQjRncjQEtC', 'test@test.com'),
(7, 'test3', '$2y$10$f4dQFruc62T.HhI.LJg0BO62kO.orcZV21XxoPcryOXFAfIHRxzLu', 'test@test.com'),
(8, 'test4', '$2y$10$lkLWiVWdXXq.8BjUk7fSSe3rcIQ2Z4zP6hL3SrtTtllQPxn08QZIy', 'test@test.te'),
(9, 'test5', '$2y$10$dmCx/3oAhKqpfLwLDWemCuE32r5kDH4FBxbpqUUcYGAc/onMba4bO', 'test@test.ru'),
(10, 'WOKERR', '$2y$10$8YWKgxezUl3/hZv8D/e3Q.yLM0pb7.F6qHw93NpzKI22Zoks7tVhO', 'test@test.tu');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
