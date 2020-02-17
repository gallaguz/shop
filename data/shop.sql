-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Фев 17 2020 г., 21:30
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
-- Структура таблицы `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `session_id` text NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `carts`
--

INSERT INTO `carts` (`id`, `session_id`, `product_id`, `user_id`, `price`, `count`) VALUES
(19, 'rm2i53jlah44fnks1ecuvq8nip5glbqk', 16, 0, NULL, 2),
(20, 'rm2i53jlah44fnks1ecuvq8nip5glbqk', 17, 0, NULL, 1),
(48, 'id71s0hds5m2hu1mk9uh59ke8qbckvvv', 1, 1, 12, 1),
(49, 'id71s0hds5m2hu1mk9uh59ke8qbckvvv', 6, 1, 32, 2),
(50, '841801oc9bg5u5tc3aj7ilmuj8lp910p', 1, 0, 12, 2),
(52, 'g781g137tbpt4u030u4rifnu3pk2k3sb', 1, 1, 12, 1),
(53, 'g781g137tbpt4u030u4rifnu3pk2k3sb', 6, 1, 32, 1),
(59, 'mudveq1j6d9g9m0k79suddlvtbemve8b', 6, 0, 32, 3),
(60, 'mudveq1j6d9g9m0k79suddlvtbemve8b', 7, 0, 5, 1),
(61, 'mudveq1j6d9g9m0k79suddlvtbemve8b', 23, 0, 125, 1),
(64, '2c9dkppt55ikmmgb7n0p1eft20s3570i', 1, 1, 12, 1),
(65, 'au09ah2gfon45o8rjerj20r8bm7h6kce', 1, 1, 12, 1),
(66, 'au09ah2gfon45o8rjerj20r8bm7h6kce', 6, 1, 32, 3),
(67, '3u6flhkbq2999t38f2mbg2apurt5deij', 1, 1, 12, 1),
(68, 'fvomq7h5m8cf2r334sun2ee8otak3s6k', 1, 1, 12, 1),
(69, 'fvomq7h5m8cf2r334sun2ee8otak3s6k', 6, 1, 32, 1),
(70, 'u4b9n7b8burgr0qa7bvjmi4v1lnk7u6g', 1, 1, 12, 1),
(71, 'u4b9n7b8burgr0qa7bvjmi4v1lnk7u6g', 6, 1, 32, 1),
(72, 'p256so9r1mqitp8hu3oc46b3f9muelba', 1, 0, 12, 1),
(73, '0hegjrfhijr06il5r84u05p9vffl6c19', 1, 0, 12, 2),
(74, '20bm8v4qrjpe9uj4pfec2o9so5fdffg4', 1, 1, 12, 1),
(75, '20bm8v4qrjpe9uj4pfec2o9so5fdffg4', 6, 1, 32, 1),
(76, 'ib3cuei4r4h33eiba13cl9v2mlpectd5', 1, 0, 12, 1),
(77, 'ib3cuei4r4h33eiba13cl9v2mlpectd5', 6, 0, 32, 1),
(79, 'pi54s5cngggh55mj59kso8hi9g4l2775', 1, 1, 12, 3),
(80, 'h45dr7gfpqfjp7hu1hmre62i82fd90lb', 1, 0, 12, 5),
(81, 'h45dr7gfpqfjp7hu1hmre62i82fd90lb', 6, 0, 32, 5),
(82, 'h45dr7gfpqfjp7hu1hmre62i82fd90lb', 7, 0, 5, 4),
(83, '03odc6c7s754n8r1r7j5gi4v52jfrt3o', 1, 0, 12, 1),
(84, 'f0t0qiu8bn5p8jlp4m281itetrf526md', 1, 1, 12, 2),
(90, 'fpnfhspi32n9d8596793kvbmtb4cl4ni', 1, 1, 12, 8),
(91, 'fpnfhspi32n9d8596793kvbmtb4cl4ni', 6, 1, 32, 2),
(92, 'ervbru4le4m7a8a7l6beantj6sumgfqm', 1, 1, 12, 3),
(93, 'ekgjngapsr6pkttu2fr8d5o9ko2iohnr', 1, 1, 12, 3),
(94, 'v80nfj27ncsdqtjig4numfb81s6d25lk', 1, 1, 12, 2),
(95, 'lr8hr98ublf3ot4elvpss3suucc07nfd', 1, 1, 12, 2),
(96, 'p9edif5mdaa1j9dug840inn5lcu0tgot', 6, 1, 32, 2),
(97, 'msqd0ccat12f16jp0b61cauqnfkkoart', 1, 1, 12, 1),
(98, 'da2ma74qftg749ufgtbvk137amp8vr6r', 1, 1, 12, 4),
(99, 'da2ma74qftg749ufgtbvk137amp8vr6r', 6, 1, 32, 2),
(100, '9caq10dfhg32qrc4qbibt3eqc1cgp8qt', 1, 1, 12, 2),
(101, '9caq10dfhg32qrc4qbibt3eqc1cgp8qt', 6, 1, 32, 3),
(102, 'uf6434vdhojphm3jhfv1cd3no23v5aje', 1, 1, 12, 1),
(103, 'msr08t8is870th7rv8vpnlcrfqidi5ud', 1, 1, 12, 1),
(104, 'caeiem8ffi6c3v0srsq7lkqulc86425e', 1, 2, 12, 1),
(105, 'dfn55mapjfvmjppvtp72d7e5gbpcjo2n', 1, 2, 12, 7),
(106, '0limk44gvtbift7ehq71osksijn96cig', 1, 2, 12, 1),
(107, 'd3g727mdrt87n270jsfncnj9rnmiii58', 6, 2, 32, 2),
(108, 'mon30v85gnm6nea5uc4c14jobok2d323', 23, 0, 125, 1),
(109, 'mon30v85gnm6nea5uc4c14jobok2d323', 7, 0, 5, 1),
(112, '4u86rgjm207bd6kfuule5ckg29v38gnc', 1, 0, 12, 4),
(113, '4u86rgjm207bd6kfuule5ckg29v38gnc', 6, 0, 32, 4),
(114, '4u86rgjm207bd6kfuule5ckg29v38gnc', 7, 0, 5, 1),
(115, 'mtka552o859lcngjlvmhag7qf44pt82s', 1, 1, 12, 1),
(116, 'mtka552o859lcngjlvmhag7qf44pt82s', 6, 1, 32, 1),
(117, 'tsgjqbhs20gsd3au0cgudrdhnjcj4tfr', 1, 1, 12, 1),
(118, 'tsgjqbhs20gsd3au0cgudrdhnjcj4tfr', 6, 1, 32, 1),
(155, 'a31rs21985u8ir9hvana6jijrqprum6s', 1, 1, 12, 2),
(157, 'ia4f8ger7ouq9a9dji2vdf35fd8aug1t', 1, 1, 12, 1),
(158, 'ia4f8ger7ouq9a9dji2vdf35fd8aug1t', 6, 1, 32, 1),
(159, 'ia4f8ger7ouq9a9dji2vdf35fd8aug1t', 7, 1, 150, 1),
(160, 'ia4f8ger7ouq9a9dji2vdf35fd8aug1t', 23, 1, 125, 1),
(163, 'jtf28ov3n1o2jd8nddsdcmhces5f4sn4', 6, 1, 32, 2),
(165, 'heit2b1n277ptt2d25f42hd7hlgbjjs8', 6, 0, 32, 2),
(166, 'heit2b1n277ptt2d25f42hd7hlgbjjs8', 7, 0, 150, 4),
(167, 'b7mkkn56rlmbe20142h4ulu9672mugti', 1, 1, 12, 13),
(168, 'b7mkkn56rlmbe20142h4ulu9672mugti', 6, 1, 32, 2),
(169, 'b7mkkn56rlmbe20142h4ulu9672mugti', 23, 1, 125, 1),
(170, 'b7mkkn56rlmbe20142h4ulu9672mugti', 7, 1, 150, 1),
(171, 'vjokiiuhu20a508b13pkmvulddsfts9u', 1, 1, 12, 2),
(172, 'i2q4ks9tc3mgd87uuf5qdnt9cduevc13', 1, 0, 12, 1),
(173, 'a2dei69p5li24j7ks3uj29chhhih1o3i', 1, 0, 12, 4),
(174, 'a2dei69p5li24j7ks3uj29chhhih1o3i', 6, 0, 32, 4),
(175, 'a2dei69p5li24j7ks3uj29chhhih1o3i', 23, 0, 125, 7),
(176, '2io81o7flje6o6n76i4jprek6j52mjok', 1, 0, 12, 10),
(177, '2io81o7flje6o6n76i4jprek6j52mjok', 6, 0, 32, 3),
(178, '2io81o7flje6o6n76i4jprek6j52mjok', 23, 1, 125, 6),
(179, 'd9sbh7sm4hv65tteo185511u8o57rci3', 1, 0, 12, 13),
(191, 'qtt4mf07k6nm13tha4nut46b566khkf9', 1, 1, 12, 1),
(192, 'o07jdmfe1ecota3l3c5jfies5su9o3rn', 1, 0, 12, 1),
(193, 'o07jdmfe1ecota3l3c5jfies5su9o3rn', 6, 0, 32, 1),
(194, 'q6jua5pi21bk0nq1rldtc8jems038nio', 1, 0, 12, 3),
(195, 'm45lva7hmdb8ovm0u601kk5f2mu4tbsc', 1, 1, 12, 1),
(196, 'ajvojngch9ak3mqffmbc5n5td5vja1qd', 1, 1, 12, 1),
(197, '81j24pcjfesdhbjem464ecoiu3344msc', 1, 1, 12, 6),
(198, '81j24pcjfesdhbjem464ecoiu3344msc', 6, 1, 32, 3),
(199, 'nsel2b7u68in8cd0rehov7j7jdcs3q5u', 1, 1, 12, 5),
(216, 'kcp9vgs75cgv86nucfdcodre0rssv85s', 1, 1, 12, 2),
(220, 't6oldvravb1d5tg8g8lr78kte7i6ofvc', 1, 1, 12, 1),
(221, '5pq93cmmqjce6ae2trqak4q3u6eod640', 1, 1, 12, 1),
(222, 'ihqo99jodiadtv5hf0rcc3booiuramra', 1, 1, 12, 1),
(223, 'n1ohk2thkvo3ds5eh8ipes0t5ojalgi9', 1, 1, 12, 1),
(224, 'hc5enp5if351r6pp5988nhb0e3v71mb1', 1, 1, 12, 1),
(225, '409qqcktpa4b8l859s5hohg948gos4v7', 1, 1, 12, 1),
(226, 'oci2hu5hnjas31hku11l2irup5orcfuh', 1, 1, 12, 1),
(227, 'ar9kqe7cgn23fc61u695lujo4avl3thh', 1, 1, 12, 1),
(228, 'ar9kqe7cgn23fc61u695lujo4avl3thh', 6, 1, 32, 1),
(229, 'ar9kqe7cgn23fc61u695lujo4avl3thh', 7, 1, 150, 1),
(230, 'ar9kqe7cgn23fc61u695lujo4avl3thh', 23, 1, 125, 1),
(231, '7r29pagmlfcp6v0khkm2lrdb3u1fj126', 1, 0, 12, 1),
(232, '7r29pagmlfcp6v0khkm2lrdb3u1fj126', 6, 0, 32, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `phone` varchar(64) DEFAULT NULL,
  `session_id` varchar(128) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(128) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `name`, `phone`, `session_id`, `user_id`, `status`) VALUES
(8, NULL, '61', '9n05n43kc9cuh70esvrtpc65qso7tfrl', 0, 'Оплачен'),
(9, NULL, NULL, 'id71s0hds5m2hu1mk9uh59ke8qbckvvv', 1, 'Доставлен'),
(10, NULL, NULL, '841801oc9bg5u5tc3aj7ilmuj8lp910p', 1, 'Новый'),
(11, NULL, NULL, 'g781g137tbpt4u030u4rifnu3pk2k3sb', 1, 'Новый'),
(12, NULL, NULL, 'nugu64221na8gdce5f1vvk18isdmojs0', 0, 'Доставлен'),
(13, 'Gallaguz2', '461230841', '2c9dkppt55ikmmgb7n0p1eft20s3570i', 0, 'Отменён'),
(14, 'CSS', '461230', 'au09ah2gfon45o8rjerj20r8bm7h6kce', 0, 'Оплачен'),
(15, NULL, NULL, '3u6flhkbq2999t38f2mbg2apurt5deij', 0, 'Оплачен'),
(16, NULL, NULL, 'fvomq7h5m8cf2r334sun2ee8otak3s6k', 0, 'Оплачен'),
(17, NULL, NULL, 'u4b9n7b8burgr0qa7bvjmi4v1lnk7u6g', 0, 'Оплачен'),
(18, NULL, NULL, 'p256so9r1mqitp8hu3oc46b3f9muelba', 0, '1'),
(19, 'Php', '461230', '0hegjrfhijr06il5r84u05p9vffl6c19', 0, '1'),
(20, 'Gallaguz Andrey', '123', '20bm8v4qrjpe9uj4pfec2o9so5fdffg4', 0, '1'),
(21, 'Gallaguz Andrey', '123', 'ib3cuei4r4h33eiba13cl9v2mlpectd5', 0, '1'),
(22, 'Gallaguz', '', 'pi54s5cngggh55mj59kso8hi9g4l2775', 0, '1'),
(23, 'Gallaguz2', '461230', 'h45dr7gfpqfjp7hu1hmre62i82fd90lb', 0, '1'),
(24, '', '', '03odc6c7s754n8r1r7j5gi4v52jfrt3o', 0, '1'),
(25, '', '', 'lr8hr98ublf3ot4elvpss3suucc07nfd', 1, '1'),
(26, '', '', 'p9edif5mdaa1j9dug840inn5lcu0tgot', 1, '1'),
(27, '', '', 'da2ma74qftg749ufgtbvk137amp8vr6r', 1, '1'),
(28, NULL, NULL, '9caq10dfhg32qrc4qbibt3eqc1cgp8qt', 1, '1'),
(29, NULL, NULL, 'uf6434vdhojphm3jhfv1cd3no23v5aje', 1, '1'),
(30, '', '', 'msr08t8is870th7rv8vpnlcrfqidi5ud', 1, '1'),
(31, NULL, NULL, 'caeiem8ffi6c3v0srsq7lkqulc86425e', 2, '1'),
(32, '', '', 'dfn55mapjfvmjppvtp72d7e5gbpcjo2n', 2, '1'),
(33, '', '', '0limk44gvtbift7ehq71osksijn96cig', 2, '1'),
(34, NULL, NULL, 'd3g727mdrt87n270jsfncnj9rnmiii58', 2, '1'),
(35, '', '', 'ajvojngch9ak3mqffmbc5n5td5vja1qd', 0, '1'),
(36, '', '', 'ajvojngch9ak3mqffmbc5n5td5vja1qd', 1, '1'),
(37, '', '', 'oci2hu5hnjas31hku11l2irup5orcfuh', 1, 'new'),
(38, '', '', 'ar9kqe7cgn23fc61u695lujo4avl3thh', 1, 'new'),
(39, '', '', '7r29pagmlfcp6v0khkm2lrdb3u1fj126', 0, 'new');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `img` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `img`) VALUES
(1, 'Спички', 'Отличные охотничьи спички', 12, 'matches.png'),
(6, 'Метла', 'Метла обыкновенная', 32, 'metla.png'),
(7, 'Ведро', 'Ведро пластиковое', 150, 'vedro-plastik.jpg'),
(23, 'Кофе', 'Крепкий', 125, 'coffe.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `sessionId` varchar(128) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pass` text NOT NULL,
  `hash` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `pass`, `hash`) VALUES
(1, 'admin', '$2y$10$HwxQP57O6ef9E1.xKEeJZe4I.lnjphzT5w.Ibt367CaL2.kDex1aq', '5248785975e4ad845e71199.96391278'),
(2, 'user', '$2y$10$HwxQP57O6ef9E1.xKEeJZe4I.lnjphzT5w.Ibt367CaL2.kDex1aq', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `carts`
--
ALTER TABLE `carts`
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
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
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
-- AUTO_INCREMENT для таблицы `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=233;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
