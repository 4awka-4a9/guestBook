-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Окт 27 2025 г., 16:46
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
-- База данных: `guestbook`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `comment`, `created_at`) VALUES
(1, 11, '111', '2025-10-22 17:21:45'),
(2, 11, '111', '2025-10-22 17:22:58'),
(3, 11, '111', '2025-10-22 17:24:11'),
(4, 11, '2318561325', '2025-10-22 17:24:21'),
(5, 22, '00000\r\n12312', '2025-10-22 17:27:12'),
(6, 23, 'ya roman', '2025-10-22 17:44:29');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(80) NOT NULL,
  `last_name` varchar(80) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `created_at`) VALUES
(11, '4awka-4a9', 'yanneverovsky@gmail.com', '9595e27fed6289c1dad92189dbe2a0c6e129091d', 'Yan', 'Neviarouski', '2025-10-22 15:49:31'),
(12, '4awka-4a9', 'yanneverovsky@gmail.com', '9595e27fed6289c1dad92189dbe2a0c6e129091d', 'Yan', 'Neviarouski', '2025-10-22 15:55:48'),
(13, '4awka-4a9', 'yanneverovsky@gmail.com', '9595e27fed6289c1dad92189dbe2a0c6e129091d', 'Yan', 'Neviarouski', '2025-10-22 17:01:00'),
(14, '4awka-4a9', 'yanneverovsky@gmail.com', '9595e27fed6289c1dad92189dbe2a0c6e129091d', 'Yan', 'Neviarouski', '2025-10-22 17:02:14'),
(15, '4awka-4a9', 'yanneverovsky@gmail.com', '9595e27fed6289c1dad92189dbe2a0c6e129091d', 'Yan', 'Neviarouski', '2025-10-22 17:03:16'),
(16, 'yan', 'yanneverovsky@gmail.com', '9595e27fed6289c1dad92189dbe2a0c6e129091d', 'yan', 'neviarouski', '2025-10-22 17:04:55'),
(17, 'yan', 'yanneverovsky@gmail.com', '9595e27fed6289c1dad92189dbe2a0c6e129091d', 'yan', 'neviarouski', '2025-10-22 17:06:15'),
(18, 'yan', 'yanneverovsky@gmail.com', '9595e27fed6289c1dad92189dbe2a0c6e129091d', 'yan', 'Неверовский', '2025-10-22 17:08:37'),
(19, 'yan', 'yanneverovsky@gmail.com', '9595e27fed6289c1dad92189dbe2a0c6e129091d', 'Ян', 'Неверовский', '2025-10-22 17:09:33'),
(20, 'yan', 'yanneverovsky@gmail.com', '9595e27fed6289c1dad92189dbe2a0c6e129091d', 'Ян', 'Неверовский', '2025-10-22 17:11:17'),
(21, 'yan', 'yanneverovsky@gmail.com', '9595e27fed6289c1dad92189dbe2a0c6e129091d', 'Ян', 'Неверовский', '2025-10-22 17:16:10'),
(22, '12341234', '11111@gmail.com', 'f9c49c9d43293faeeb20b71c0d47f057554b27bd', '1123123', '376576376', '2025-10-22 17:25:50'),
(23, 'roman', 'roman@gmail.com', '43c8f63d85f34b793ab074701f482c9ffeec8c5f', 'roman', 'neverovsky', '2025-10-22 17:43:56');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
