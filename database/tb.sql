-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2019 at 03:31 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cells`
--

CREATE TABLE `cells` (
  `id` int(11) UNSIGNED NOT NULL,
  `height` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `east` double(8,2) NOT NULL,
  `west` double(8,2) NOT NULL,
  `south` double(8,2) NOT NULL,
  `north` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cells`
--

INSERT INTO `cells` (`id`, `height`, `width`, `east`, `west`, `south`, `north`) VALUES
(1, 24, 54, 105.92, 105.46, 20.95, 21.16);

-- --------------------------------------------------------

--
-- Table structure for table `cells_detail`
--

CREATE TABLE `cells_detail` (
  `id` int(11) UNSIGNED NOT NULL,
  `height` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `id_cell` int(11) UNSIGNED NOT NULL,
  `avg_speed` float(3,2) NOT NULL,
  `marker_count` int(11) UNSIGNED NOT NULL,
  `indicator` float(6,3) UNSIGNED NOT NULL,
  `color` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cells_detail`
--

INSERT INTO `cells_detail` (`id`, `height`, `width`, `start_time`, `end_time`, `id_cell`, `avg_speed`, `marker_count`, `indicator`, `color`, `created_at`, `updated_at`) VALUES
(1, 10, 10, '2019-04-08 16:00:00', '2019-04-08 16:00:00', 1, 0.00, 0, 0.000, '#FF0000', NULL, '2019-04-08 07:40:13'),
(2, 11, 10, '2019-04-08 16:00:00', '2019-04-08 16:00:00', 1, 0.00, 0, 0.000, '#0000FF', NULL, '2019-04-08 07:40:13');

-- --------------------------------------------------------

--
-- Table structure for table `future`
--

CREATE TABLE `future` (
  `id` int(11) UNSIGNED NOT NULL,
  `height` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `destination_time` timestamp NULL DEFAULT NULL,
  `id_cell` int(11) UNSIGNED NOT NULL,
  `avg_speed` float(3,2) NOT NULL,
  `color` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `markers`
--

CREATE TABLE `markers` (
  `id` int(11) UNSIGNED NOT NULL,
  `lat` double(8,2) NOT NULL,
  `lng` double(8,2) NOT NULL,
  `speed` float(3,2) NOT NULL,
  `vehicle` int(2) UNSIGNED NOT NULL,
  `direct` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `record_user` int(11) UNSIGNED NOT NULL,
  `record_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2lPILfVw6jnKKjzuVKSL8265M4cB0w0m98G6LIF0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:66.0) Gecko/20100101 Firefox/66.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNXdzMWIwdHB2TmhObU1ra1k4eXVKV3oycmhOU3NLbWJFRmw3UnlDSyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jb2xvci8yMDE5LTA0LTA4JTIwMjM6MDAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1554773232),
('7sGxfeN43L5kg3AB6COq9AVQdsATBj7RktcJVWoO', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:66.0) Gecko/20100101 Firefox/66.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSVltbHZHRkFHSFR1MjExYmNmOWdsWkpnQUlQdE9Nb3dhTWJiU3lubSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jb2xvciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1554734414);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(1) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$IH6QE0vSXE/HIjiJJMEFieqMIdBMDOF7eX7.tKcBx0muLpTthbFEK', 'lDoMltoNl35cGPU5gEdqflk6ZocAA3Ru0UgMRiBBFFW6hVu6JUHrq9MVe195', 1, '2017-10-01 10:00:00', '2017-10-02 10:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cells`
--
ALTER TABLE `cells`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cells_detail`
--
ALTER TABLE `cells_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cells_detail_id_cell_foreign` (`id_cell`);

--
-- Indexes for table `future`
--
ALTER TABLE `future`
  ADD PRIMARY KEY (`id`),
  ADD KEY `future_id_cell_foreign` (`id_cell`);

--
-- Indexes for table `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `markers_record_user_foreign` (`record_user`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cells`
--
ALTER TABLE `cells`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cells_detail`
--
ALTER TABLE `cells_detail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `markers`
--
ALTER TABLE `markers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cells_detail`
--
ALTER TABLE `cells_detail`
  ADD CONSTRAINT `cells_detail_id_cell_foreign` FOREIGN KEY (`id_cell`) REFERENCES `cells` (`id`);

--
-- Constraints for table `future`
--
ALTER TABLE `future`
  ADD CONSTRAINT `future_id_cell_foreign` FOREIGN KEY (`id_cell`) REFERENCES `cells` (`id`);

--
-- Constraints for table `markers`
--
ALTER TABLE `markers`
  ADD CONSTRAINT `markers_record_user_foreign` FOREIGN KEY (`record_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
