-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июл 05 2020 г., 22:58
-- Версия сервера: 10.1.19-MariaDB
-- Версия PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `social`
--

-- --------------------------------------------------------

--
-- Структура таблицы `friends`
--

CREATE TABLE `friends` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `friend_id` int(11) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `friends`
--

INSERT INTO `friends` (`id`, `user_id`, `friend_id`, `accepted`, `created_at`, `updated_at`) VALUES
(2, 1, 3, 1, NULL, NULL),
(8, 1, 4, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `likeable`
--

CREATE TABLE `likeable` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `likeable_id` int(11) NOT NULL,
  `likeable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `likeable`
--

INSERT INTO `likeable` (`id`, `user_id`, `likeable_id`, `likeable_type`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 'App\\Models\\Status', '2020-07-05 15:58:06', '2020-07-05 15:58:06'),
(2, 1, 10, 'App\\Models\\Status', '2020-07-05 15:58:09', '2020-07-05 15:58:09');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2020_06_04_163139_create_users_table', 1),
(6, '2020_06_07_115833_create_friends_table', 1),
(8, '2020_06_21_112748_create_statuses_table', 2),
(9, '2020_07_05_181512_create_likeable_table', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`id`, `user_id`, `parent_id`, `body`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Привет !', '2020-06-21 09:15:52', '2020-06-21 09:15:52'),
(2, 1, NULL, '4454635654646645', '2020-07-02 14:46:14', '2020-07-02 14:46:14'),
(3, 1, NULL, '3544464', '2020-07-02 14:46:22', '2020-07-02 14:46:22'),
(4, 1, NULL, 'Супер пупер запись номер 4', '2020-07-05 10:45:02', '2020-07-05 10:45:02'),
(5, 1, 4, 'комент 4', '2020-07-05 10:51:47', '2020-07-05 10:51:47'),
(6, 1, 4, 'И ещё супер комент!', '2020-07-05 11:03:29', '2020-07-05 11:03:29'),
(7, 4, NULL, 'И вот Индюк Иваныч впервые слово молвит !', '2020-07-05 15:09:32', '2020-07-05 15:09:32'),
(8, 1, 7, 'Индюк, дружище , просто жжжошь!', '2020-07-05 15:10:01', '2020-07-05 15:10:01'),
(9, 4, 4, 'Подгончик от Индюка!', '2020-07-05 15:46:33', '2020-07-05 15:46:33'),
(10, 4, 7, 'Спасибо , дорогой !', '2020-07-05 15:50:41', '2020-07-05 15:50:41');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `first_name`, `last_name`, `location`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'test@aa.cc', 'test', '$2y$10$87WBZQvHk7kmUD9dJv5tcuNlfwk38gCR8XntANlSFrO3lhKe5ZYn2', 'Иван', 'Иванов', 'СуперБобруйск', 'H5yV53jweVRtzbTOYNXaT014LITO2CuynePYlx9Wc3Xv5xCWEm7tWphctHx5', '2020-06-04 14:24:08', '2020-06-06 16:05:52'),
(2, 'test@test.ru', 'admin', '$2y$10$0QSiwgVMfeiuaLq6tKznhe9RIkIyVrQUr5UUf6sDUxI/nVDvIMt42', 'Юзер', 'Юзер', NULL, NULL, '2020-06-05 07:22:41', '2020-06-05 07:22:41'),
(3, 'a@a.cc', 'admin_2', '$2y$10$nlAvjQ7IDBJnGpIDFijKx.eUGRL.KZhI6hygc.rZioGWUnD4Jrnpm', 'Юзер', 'Хз', NULL, NULL, '2020-06-05 07:23:15', '2020-06-05 07:23:15'),
(4, 'test@test2.ru', 'CoolUser', '$2y$10$cOP5T.mFb7MyFwJo.rhQ4.qQvfp9cUExW30S253IOlYkKlBQa1VKi', 'Индюк', 'Иваныч', 'Суп', NULL, '2020-06-18 04:22:09', '2020-06-18 08:13:43');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `likeable`
--
ALTER TABLE `likeable`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
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
-- AUTO_INCREMENT для таблицы `friends`
--
ALTER TABLE `friends`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `likeable`
--
ALTER TABLE `likeable`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
