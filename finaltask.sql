-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 16 2020 г., 11:57
-- Версия сервера: 10.4.11-MariaDB
-- Версия PHP: 7.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `finaltask`
--


--
-- Структура таблицы `pictures`
--
DROP TABLE `pictures`;

CREATE TABLE `pictures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `smallpict` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bigpict` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descript` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count_view` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pictures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;



DROP TABLE `picture_tag`;
CREATE TABLE `picture_tag` (
  `id` bigint(20) NOT NULL ,
  `picture_id` bigint(20) NOT NULL,
  `tag_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `picture_tag`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `picture_tag`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;



DROP TABLE `tags`;
CREATE TABLE `tags` (
  `id` bigint(20) NOT NULL ,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `tags`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;




DROP TABLE `users`
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

