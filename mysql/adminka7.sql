-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 24 2021 г., 15:15
-- Версия сервера: 8.0.25-0ubuntu0.20.04.1
-- Версия PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `adminka2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `phone` char(10) NOT NULL,
  `pswd` char(32) NOT NULL DEFAULT '00000000000000000000000000000000',
  `role` enum('superadmin','moderator','anonim') NOT NULL DEFAULT 'anonim'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `phone`, `pswd`, `role`) VALUES
(1, '9184403717', 'a8c9aa4d0f342044a63fa137b09e84a1', 'superadmin');

-- --------------------------------------------------------

--
-- Структура таблицы `cash`
--

CREATE TABLE `cash` (
  `id` int NOT NULL,
  `cash_in` decimal(7,2) DEFAULT '0.00',
  `cash_out` decimal(7,2) DEFAULT '0.00',
  `cash_type` enum('НАЛ','БЕЗНАЛ') DEFAULT 'НАЛ',
  `time` char(10) NOT NULL DEFAULT '0000000000',
  `description` varchar(255) DEFAULT 'НЕ ОПРЕДЕЛЕНО',
  `order_id` int NOT NULL,
  `trash` enum('АКТИВЕН','УДАЛЁН') NOT NULL DEFAULT 'АКТИВЕН'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `cash`
--



-- --------------------------------------------------------

--
-- Структура таблицы `group_user`
--

CREATE TABLE `group_user` (
  `group_id` int NOT NULL,
  `user_id` int NOT NULL,
  `trash` enum('АКТИВЕН','УДАЛЁН') NOT NULL DEFAULT 'АКТИВЕН'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `group_user`
--



-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `plus` decimal(7,2) DEFAULT '0.00',
  `sale` decimal(7,2) DEFAULT '0.00',
  `time_in` char(10) NOT NULL DEFAULT '0000000000',
  `time_out` char(10) DEFAULT '0000000000',
  `description` varchar(255) DEFAULT '',
  `state` enum('ОТКРЫТ','ЗАКРЫТ') NOT NULL DEFAULT 'ОТКРЫТ',
  `user_id` int NOT NULL,
  `trash` enum('АКТИВЕН','УДАЛЁН') NOT NULL DEFAULT 'АКТИВЕН'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `orders`
--



-- --------------------------------------------------------

--
-- Структура таблицы `points`
--

CREATE TABLE `points` (
  `id` int NOT NULL,
  `description` varchar(255) DEFAULT 'НЕ ОПРЕДЕЛЕНО',
  `po_price` decimal(7,2) NOT NULL DEFAULT '0.00',
  `readiness` enum('НЕ ГОТОВО','ГОТОВО') NOT NULL DEFAULT 'НЕ ГОТОВО',
  `serv_id` int NOT NULL,
  `prod_id` int NOT NULL,
  `order_id` int NOT NULL,
  `trash` enum('АКТИВЕН','УДАЛЁН') NOT NULL DEFAULT 'АКТИВЕН'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `points`
--



-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `product` varchar(45) NOT NULL DEFAULT 'НЕ ОПРЕДЕЛЕНО',
  `sex` varchar(45) DEFAULT 'НЕ ОПРЕДЕЛЕНО',
  `material` varchar(45) DEFAULT 'НЕ ОПРЕДЕЛЕНО',
  `color` varchar(45) DEFAULT 'НЕ ОПРЕДЕЛЕНО',
  `description` varchar(255) DEFAULT 'НЕ ОПРЕДЕЛЕНО',
  `readiness` enum('НЕ ГОТОВО','ГОТОВО') NOT NULL DEFAULT 'НЕ ГОТОВО',
  `availability` enum('ПРИНЯТО','ВЫДАНО') NOT NULL DEFAULT 'ПРИНЯТО',
  `order_id` int NOT NULL,
  `trash` enum('АКТИВЕН','УДАЛЁН') NOT NULL DEFAULT 'АКТИВЕН'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `products`
--


-- --------------------------------------------------------

--
-- Структура таблицы `samples`
--

CREATE TABLE `samples` (
  `id` int NOT NULL,
  `sample_max_name` varchar(255) NOT NULL,
  `sample_max_type` varchar(50) DEFAULT NULL,
  `sample_max_size` int DEFAULT NULL,
  `sample_max_width` int DEFAULT NULL,
  `sample_max_height` int DEFAULT NULL,
  `sample_max_data` mediumblob,
  `order_id` int NOT NULL,
  `trash` enum('АКТИВЕН','УДАЛЁН') NOT NULL DEFAULT 'АКТИВЕН'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` int NOT NULL,
  `service` varchar(45) NOT NULL,
  `measurement` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'НЕ ОПРЕДЕЛЕНО',
  `material` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'НЕ ОПРЕДЕЛЕНО',
  `min_price` decimal(7,2) DEFAULT '0.00',
  `description` varchar(255) DEFAULT 'НЕ ОПРЕДЕЛЕНО',
  `trash` enum('АКТИВЕН','УДАЛЁН') DEFAULT 'АКТИВЕН'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `services`
--



-- --------------------------------------------------------

--
-- Структура таблицы `useres`
--

CREATE TABLE `useres` (
  `id` int NOT NULL,
  `phone` char(11) NOT NULL,
  `pswd` char(32) DEFAULT '00000000000000000000000000000000',
  `surname` varchar(255) DEFAULT 'НЕ ОПРЕДЕЛЕНО',
  `firstname` varchar(255) DEFAULT 'НЕ ОПРЕДЕЛЕНО',
  `middle_name` varchar(255) DEFAULT 'НЕ ОПРЕДЕЛЕНО',
  `time_reg` char(10) NOT NULL DEFAULT '0000000000',
  `operator` varchar(45) DEFAULT 'НЕ ОПРЕДЕЛЕНО',
  `region` varchar(255) DEFAULT 'НЕ ОПРЕДЕЛЕНО',
  `status` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'НЕ ОПРЕДЕЛЕНО',
  `trash` enum('АКТИВЕН','УДАЛЁН') NOT NULL DEFAULT 'АКТИВЕН'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `useres`
--



--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `adm_phone_UNIQUE` (`phone`);

--
-- Индексы таблицы `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cash_orders1_idx` (`order_id`);

--
-- Индексы таблицы `group_user`
--
ALTER TABLE `group_user`
  ADD PRIMARY KEY (`group_id`,`user_id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_useres1_idx` (`user_id`);

--
-- Индексы таблицы `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_points_products1_idx` (`prod_id`),
  ADD KEY `fk_points_1_idx` (`serv_id`),
  ADD KEY `fk_points_2_idx` (`order_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `useres`
--
ALTER TABLE `useres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `cash`
--
ALTER TABLE `cash`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=342;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=362;

--
-- AUTO_INCREMENT для таблицы `points`
--
ALTER TABLE `points`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=421;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=396;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `useres`
--
ALTER TABLE `useres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=343;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
