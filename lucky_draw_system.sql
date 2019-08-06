-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2019 at 04:22 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lucky_draw_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_05_164605_create_user_ticket_table', 1),
(4, '2019_08_05_164721_create_prize_type_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prize_types`
--

CREATE TABLE `prize_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `winning_number` int(11) DEFAULT NULL,
  `admin_id` smallint(6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prize_types`
--

INSERT INTO `prize_types` (`id`, `name`, `winning_number`, `admin_id`, `created_at`, `updated_at`) VALUES
(1, 'Third Pirze - 1st Winner', NULL, NULL, '2019-08-06 01:28:16', '2019-08-06 01:28:16'),
(2, 'Third Pirze - 2nd Winner', NULL, NULL, '2019-08-06 01:28:16', '2019-08-06 01:28:16'),
(3, 'Third Pirze - 3rd Winner', NULL, NULL, '2019-08-06 01:28:16', '2019-08-06 01:28:16'),
(4, 'Second Prize - 1st Winner', NULL, NULL, '2019-08-06 01:28:16', '2019-08-06 01:28:16'),
(5, 'Second Prize - 2nd Winner', NULL, NULL, '2019-08-06 01:28:16', '2019-08-06 01:28:16'),
(6, 'Second Prize - 3rd Winner', NULL, NULL, '2019-08-06 01:28:16', '2019-08-06 01:28:16'),
(7, 'First Prize ', NULL, NULL, '2019-04-18 02:18:00', '2019-04-18 02:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `type` enum('admin','user') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `type`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mr.Admin', 'admin@plus65.com', NULL, 'admin', '$2y$10$ySbsN21i/RNRvWdEQwO1FO2rp8xO/wM77UCAAvUPrLwvgJO1x0ag.', NULL, '2019-08-05 20:41:29', '2019-08-05 20:41:29'),
(2, 'John', 'john@plus65.com', NULL, 'user', '$2y$10$h.Tx.KIdWLHsG7sf6QCAfuDsGkXZGw.Q73trNrt64KYB1zOE.5.Da', NULL, '2019-08-05 20:44:07', '2019-08-05 20:44:07'),
(3, 'Carol', 'carol@plus65.com', NULL, 'user', '$2y$10$P4LOBr0NOoj0xfl7CUi.G.pKRSXCPyTdI0SvdiyouC9Duouy7LxRq', NULL, '2019-08-05 20:51:03', '2019-08-05 20:51:03'),
(4, 'Mohan', 'mohan@plus65.com', NULL, 'user', '$2y$10$v/C2yK1nyC4LEovf.29fnea8wJ6yAXhC/JT5h0XJWkvrInn5KNwA6', NULL, '2019-08-05 22:46:39', '2019-08-05 22:46:39'),
(5, 'Kenny', 'kenny@plus65.com', NULL, 'user', '$2y$10$up9nuccbC8Nn.BYGPdhHxuqhC2N/sViH1PkCHHzJcTVZ5UgubfgiS', NULL, '2019-08-06 07:46:54', '2019-08-06 07:46:54'),
(6, 'Jason', 'jason@plus65.com', NULL, 'user', '$2y$10$OwfcWox8JV8q0G1fm4sfR.s1wizv2/qvQfH6mYtz15Mo.IKM9CToW', NULL, '2019-08-06 07:47:50', '2019-08-06 07:47:50'),
(7, 'Sean', 'sean@plus65.com', NULL, 'user', '$2y$10$AU7IBz0BZRGQB3mghqkdm.ImBDWiUNRhOAjRGdKQ8bpOK7yNnbZrm', NULL, '2019-08-06 07:48:35', '2019-08-06 07:48:35'),
(8, 'Lisa', 'lisa@plus65.com', NULL, 'user', '$2y$10$L7tWAWLwxrECs1Nwef2BN.7vCE2ZwuI5M.b0THES1qlMsUEfWMuGK', NULL, '2019-08-06 07:49:38', '2019-08-06 07:49:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_tickets`
--

CREATE TABLE `user_tickets` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `number` int(11) NOT NULL,
  `user_id` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_tickets`
--

INSERT INTO `user_tickets` (`id`, `number`, `user_id`, `created_at`, `updated_at`) VALUES
(8, 5678, 5, '2019-08-06 07:47:17', '2019-08-06 07:47:17'),
(9, 3939, 5, '2019-08-06 07:47:23', '2019-08-06 07:47:23'),
(10, 9012, 6, '2019-08-06 07:47:57', '2019-08-06 07:47:57'),
(11, 3838, 6, '2019-08-06 07:48:04', '2019-08-06 07:48:04'),
(12, 4738, 6, '2019-08-06 07:48:09', '2019-08-06 07:48:09'),
(13, 0, 7, '2019-08-06 07:48:39', '2019-08-06 07:48:39'),
(14, 3748, 8, '2019-08-06 07:49:45', '2019-08-06 07:49:45'),
(15, 9393, 8, '2019-08-06 07:49:49', '2019-08-06 07:49:49'),
(16, 3782, 8, '2019-08-06 07:49:53', '2019-08-06 07:49:53'),
(17, 8301, 8, '2019-08-06 07:49:59', '2019-08-06 07:49:59'),
(18, 138, 8, '2019-08-06 07:50:04', '2019-08-06 07:50:04'),
(19, 1234, 3, '2019-08-06 07:50:59', '2019-08-06 07:50:59'),
(20, 3404, 3, '2019-08-06 07:51:04', '2019-08-06 07:51:04'),
(21, 2839, 2, '2019-08-06 07:51:23', '2019-08-06 07:51:23'),
(22, 2993, 2, '2019-08-06 07:51:27', '2019-08-06 07:51:27'),
(23, 9931, 2, '2019-08-06 07:51:31', '2019-08-06 07:51:31'),
(24, 932, 2, '2019-08-06 07:51:35', '2019-08-06 07:51:35'),
(25, 9322, 2, '2019-08-06 07:51:44', '2019-08-06 07:51:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `prize_types`
--
ALTER TABLE `prize_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_tickets`
--
ALTER TABLE `user_tickets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `prize_types`
--
ALTER TABLE `prize_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_tickets`
--
ALTER TABLE `user_tickets`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
