-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 07 2020 г., 07:18
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `session_id` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `session_id`, `product_id`, `user_id`, `price`, `count`) VALUES
(19, 'rm2i53jlah44fnks1ecuvq8nip5glbqk', 16, 0, NULL, 2),
(20, 'rm2i53jlah44fnks1ecuvq8nip5glbqk', 17, 0, NULL, 1),
(48, 'id71s0hds5m2hu1mk9uh59ke8qbckvvv', 1, 1, 12, 1),
(49, 'id71s0hds5m2hu1mk9uh59ke8qbckvvv', 6, 1, 32, 2),
(50, '841801oc9bg5u5tc3aj7ilmuj8lp910p', 1, 0, 12, 2),
(52, 'g781g137tbpt4u030u4rifnu3pk2k3sb', 1, 1, 12, 1),
(53, 'g781g137tbpt4u030u4rifnu3pk2k3sb', 6, 1, 32, 1),
(54, 'nugu64221na8gdce5f1vvk18isdmojs0', 1, 1, 12, 11),
(55, 'nugu64221na8gdce5f1vvk18isdmojs0', 6, 1, 32, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `session_id` varchar(128) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `session_id`, `status`) VALUES
(8, '9n05n43kc9cuh70esvrtpc65qso7tfrl', 0),
(9, 'id71s0hds5m2hu1mk9uh59ke8qbckvvv', 0),
(10, '841801oc9bg5u5tc3aj7ilmuj8lp910p', 0),
(11, 'g781g137tbpt4u030u4rifnu3pk2k3sb', 0),
(12, 'nugu64221na8gdce5f1vvk18isdmojs0', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `image`) VALUES
(1, 'Спички', 'Отличные охотничьи спички', 12, 'matches.png'),
(6, 'Метла', 'Метла обыкновенная', 32, 'metla.png'),
(7, 'Ведро', 'Ведро пластиковое', 5, 'vedro-plastik.jpg'),
(23, 'Кофе', 'Крепкий', 125, 'img.png');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text NOT NULL,
  `pass` text NOT NULL,
  `hash` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `pass`, `hash`) VALUES
(1, 'admin', '$2y$10$HwxQP57O6ef9E1.xKEeJZe4I.lnjphzT5w.Ibt367CaL2.kDex1aq', '18706727495e3cdbb8894431.45195749'),
(2, 'user', '$2y$10$HwxQP57O6ef9E1.xKEeJZe4I.lnjphzT5w.Ibt367CaL2.kDex1aq', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
