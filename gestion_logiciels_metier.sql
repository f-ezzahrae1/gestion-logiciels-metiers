-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2025 at 07:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_logiciels_metier`
--

DELIMITER $$
--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `get_logiciel_name` (`logiciel_id` BIGINT) RETURNS VARCHAR(255) CHARSET utf8mb4 COLLATE utf8mb4_general_ci DETERMINISTIC BEGIN
    DECLARE prog_name VARCHAR(255);
    SELECT nom INTO prog_name
    FROM logiciels
    WHERE id_logiciel = logiciel_id;
    RETURN prog_name;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `get_user_fullname` (`user_id` BIGINT) RETURNS VARCHAR(255) CHARSET utf8mb4 COLLATE utf8mb4_general_ci DETERMINISTIC BEGIN
    DECLARE fullname VARCHAR(255);
    SELECT CONCAT(prenom, ' ', nom) INTO fullname
    FROM utilisateurs
    WHERE id_utilisateur = user_id;
    RETURN fullname;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-fatima@gmail.com|127.0.0.1', 'i:1;', 1756468557),
('laravel-cache-fatima@gmail.com|127.0.0.1:timer', 'i:1756468557;', 1756468557);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journalisations`
--

CREATE TABLE `journalisations` (
  `id_journalisation` bigint(20) UNSIGNED NOT NULL,
  `id_utilisateur` bigint(20) UNSIGNED NOT NULL,
  `id_logiciel` bigint(20) UNSIGNED NOT NULL,
  `id_licence` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `date_action` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `licences`
--

CREATE TABLE `licences` (
  `id_licence` bigint(20) UNSIGNED NOT NULL,
  `id_utilisateur` bigint(20) UNSIGNED DEFAULT NULL,
  `id_logiciel` bigint(20) UNSIGNED NOT NULL,
  `cle_licence` varchar(255) NOT NULL,
  `date_acquisition` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `type_licence` varchar(255) NOT NULL,
  `contrat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `licences`
--

INSERT INTO `licences` (`id_licence`, `id_utilisateur`, `id_logiciel`, `cle_licence`, `date_acquisition`, `status`, `type_licence`, `contrat`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'ABCD-1234-EFGH-5678', '2024-02-15', 'Expiré', 'Abonnement', 'ccccc', '2025-09-03 12:07:56', '2025-09-03 12:07:56');

-- --------------------------------------------------------

--
-- Table structure for table `logiciels`
--

CREATE TABLE `logiciels` (
  `id_logiciel` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `version` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `date_installation` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logiciels`
--

INSERT INTO `logiciels` (`id_logiciel`, `nom`, `version`, `description`, `date_installation`, `created_at`, `updated_at`) VALUES
(1, 'Photoshop', '2025(version 26.0)', 'Axxxxxxxxxxxxx', '2024-12-20', '2025-08-29 10:59:15', '2025-09-02 11:23:54');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_08_07_203102_create_utilisateurs_table', 1),
(2, '2025_08_07_204132_create_notifications_table', 1),
(3, '2025_08_07_205703_create_logiciels_table', 1),
(4, '2025_08_07_205902_create_licences_table', 1),
(5, '2025_08_07_210256_create_journalisations_table', 1),
(6, '2025_08_27_211116_remove_id_utilisateur_from_logiciels_table', 1),
(7, '2025_08_29_115044_create_sessions_table', 2),
(8, '2025_08_29_115310_create_cache_table', 3),
(9, '2025_09_02_123225_add_id_utilisateur_to_licences_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id_notification` bigint(20) UNSIGNED NOT NULL,
  `id_utilisateur` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(255) NOT NULL,
  `date_envoi` date NOT NULL,
  `lu` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('TkAIP0ysAKRmuHBRnv00DevdjjKVKFr4PRLjkQ1E', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN1RFZVVPeEtRclBJbUhWV1BoSlhCYVBsb001MXRtcXFwTTVpV2I3RSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9maWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1764975354);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom`, `prenom`, `email`, `mot_de_passe`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'test', 'test@gmail.com', '$2y$12$7/wloVwGXmzILOTgx.t3weG27aB5/1/NoGiEwbkCEQdil8bZLhhMe', 'admin', '2025-08-29 10:58:44', '2025-08-29 10:58:44'),
(2, 'xxxx', 'yyyy', 'xxyy@gmail.com', '$2y$12$g9YsPi/9BoWToKA74OHWuO/m26tfxgFw8sgVp1IORBt3gPNcMDEbi', 'user', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `journalisations`
--
ALTER TABLE `journalisations`
  ADD PRIMARY KEY (`id_journalisation`),
  ADD KEY `journalisations_id_utilisateur_foreign` (`id_utilisateur`),
  ADD KEY `journalisations_id_logiciel_foreign` (`id_logiciel`),
  ADD KEY `journalisations_id_licence_foreign` (`id_licence`);

--
-- Indexes for table `licences`
--
ALTER TABLE `licences`
  ADD PRIMARY KEY (`id_licence`),
  ADD KEY `licences_id_logiciel_foreign` (`id_logiciel`),
  ADD KEY `licences_id_utilisateur_foreign` (`id_utilisateur`);

--
-- Indexes for table `logiciels`
--
ALTER TABLE `logiciels`
  ADD PRIMARY KEY (`id_logiciel`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id_notification`),
  ADD KEY `notifications_id_utilisateur_foreign` (`id_utilisateur`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `utilisateurs_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `journalisations`
--
ALTER TABLE `journalisations`
  MODIFY `id_journalisation` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `licences`
--
ALTER TABLE `licences`
  MODIFY `id_licence` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logiciels`
--
ALTER TABLE `logiciels`
  MODIFY `id_logiciel` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id_notification` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `journalisations`
--
ALTER TABLE `journalisations`
  ADD CONSTRAINT `journalisations_id_licence_foreign` FOREIGN KEY (`id_licence`) REFERENCES `licences` (`id_licence`) ON DELETE CASCADE,
  ADD CONSTRAINT `journalisations_id_logiciel_foreign` FOREIGN KEY (`id_logiciel`) REFERENCES `logiciels` (`id_logiciel`) ON DELETE CASCADE,
  ADD CONSTRAINT `journalisations_id_utilisateur_foreign` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE;

--
-- Constraints for table `licences`
--
ALTER TABLE `licences`
  ADD CONSTRAINT `licences_id_logiciel_foreign` FOREIGN KEY (`id_logiciel`) REFERENCES `logiciels` (`id_logiciel`) ON DELETE CASCADE,
  ADD CONSTRAINT `licences_id_utilisateur_foreign` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_id_utilisateur_foreign` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
