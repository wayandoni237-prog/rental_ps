-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 07, 2026 at 05:28 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental_ps`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `ruangan_id` bigint UNSIGNED NOT NULL,
  `tanggal_booking` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `durasi_jam` int NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `status` enum('pending','dikonfirmasi','dibatalkan','selesai') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `catatan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `ruangan_id`, `tanggal_booking`, `jam_mulai`, `jam_selesai`, `durasi_jam`, `total_harga`, `status`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-03-14', '01:34:00', '02:34:00', 1, 115.00, 'pending', 'sfdfdsd', '2026-03-12 08:34:42', '2026-03-12 08:34:42'),
(2, 3, 2, '2026-03-14', '08:00:00', '09:00:00', 1, 120.00, 'selesai', NULL, '2026-03-12 20:44:43', '2026-03-30 20:18:10'),
(3, 4, 3, '2026-03-23', '16:02:00', '17:02:00', 1, 200.00, 'dibatalkan', 'tidak ada', '2026-03-23 00:02:58', '2026-03-23 00:13:07'),
(4, 4, 4, '2026-03-26', '19:53:00', '20:53:00', 1, 100.00, 'selesai', NULL, '2026-03-23 00:50:25', '2026-03-23 01:02:56'),
(6, 2, 3, '2026-04-09', '16:45:00', '17:45:00', 1, 600.00, 'selesai', 'tgrg', '2026-03-30 19:40:26', '2026-03-30 19:43:00'),
(7, 8, 6, '2026-03-31', '04:20:00', '06:20:00', 2, 800.00, 'selesai', 'Hhh', '2026-03-30 20:03:57', '2026-03-30 20:05:08'),
(8, 2, 2, '2026-04-02', '15:40:00', '18:40:00', 3, 360.00, 'dibatalkan', 'tambahan celana', '2026-03-30 20:40:08', '2026-03-31 16:26:23'),
(9, 2, 2, '2026-04-16', '11:30:00', '12:30:00', 1, 120000.00, 'pending', 'tidak perlu', '2026-03-31 16:27:08', '2026-03-31 16:27:08'),
(10, 10, 3, '2026-04-02', '13:20:00', '15:20:00', 2, 1200000.00, 'dibatalkan', 'tamhan es tes', '2026-03-31 20:20:05', '2026-03-31 20:20:38'),
(11, 10, 3, '2026-04-10', '12:20:00', '13:20:00', 1, 600000.00, 'dikonfirmasi', 'yaa', '2026-03-31 20:21:02', '2026-03-31 20:22:34');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_03_12_052702_create_ruangan_table', 1),
(5, '2026_03_12_052715_create_bookings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_ruangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `harga_normal` decimal(10,2) NOT NULL,
  `harga_diskon` decimal(10,2) DEFAULT NULL,
  `persen_diskon` int DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('tersedia','dipesan','tidak_tersedia') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tersedia',
  `kapasitas` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id`, `nama_ruangan`, `deskripsi`, `harga_normal`, `harga_diskon`, `persen_diskon`, `foto`, `status`, `kapasitas`, `created_at`, `updated_at`) VALUES
(1, 'A15', 'Nyaman dan kualitas  Bagus 100%', 120000.00, 115000.00, 10, 'ruangan/gDqcPaiHwpSEmJCa851fT0dntVL7kZvy560xU6rQ.jpg', 'dipesan', 2, NULL, '2026-04-06 03:00:39'),
(2, 'A01', 'Bersih,Nyaman,Kualitas Bagus 100%', 300000.00, 120000.00, 23, 'ruangan/A9QvLMCShevHEyW6gdK7W1EjApJBglEAPWqkphkq.jpg', 'dipesan', 2, '2026-03-12 09:22:33', '2026-03-31 16:27:08'),
(3, 'A80', 'Ruangan nyaman bagus dan  kualitas lengkap', 800000.00, 600000.00, 25, 'ruangan/QIq2IG6zfHI3OZMrPGDzObc8Bv2GNlkWIobjmnV0.jpg', 'dipesan', 4, '2026-03-12 17:34:01', '2026-03-31 20:21:02'),
(4, 'A81', 'Monitor besar dan satu orang satu bisa bebas mau main game apa aja', 400000.00, 100000.00, 50, 'ruangan/bY6tsC7hFCDdlvPaPhuSBn9JM0b8vBzdxi90Xese.jpg', 'tersedia', 4, '2026-03-12 20:38:10', '2026-03-31 16:22:15'),
(6, 'B02', 'Fasilitas lengkap dan kualitas terbaik', 500000.00, 400000.00, 20, 'ruangan/lKs3f0rFBYz8IwPXyFBEDGPJoZEgoxY8kxLE1hb2.jpg', 'tersedia', 4, '2026-03-23 20:40:48', '2026-03-31 16:19:39'),
(7, 'B03', 'Nyaman Mabara berama teman kualitas lengkap', 800000.00, 600000.00, 25, 'ruangan/o6H6zEYvNqpEWcVwlcgXoOVswZ3QkLAVuogUvycj.jpg', 'tersedia', 3, '2026-03-23 21:03:41', '2026-03-31 16:20:31'),
(8, 'C20', 'Ruangan luas nyaman dan bersih kualitas Bagus 100%', 1000000.00, 800000.00, 20, 'ruangan/Yq0z6cEVTQxLWnqSSzBdhDOeXQNA2fVhVdMOCOTo.jpg', 'tersedia', 3, '2026-03-23 21:06:47', '2026-03-31 16:20:03'),
(9, 'C25', 'Ruangan nyaman bagus dan  kualitas lengkap', 1500000.00, 1200000.00, 20, 'ruangan/CBcEkYo7L5XBZSbqQsDlJjo6RNCmKASpOxPq663I.jpg', 'tidak_tersedia', 4, '2026-03-23 21:10:30', '2026-03-31 20:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','tamu') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'tamu',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'kusuma putra', 'doni9', 'doni@gmail.com', '$2y$12$xXBy5DCIZ2bwpSh1fS5h4OQrU2RmbbcWUFXb.n5KzV7mY/wrWN9Ga', 'admin', NULL, '2026-03-12 08:29:12', '2026-03-12 08:38:58'),
(2, 'dionputra', 'dion', 'dion@gmail.com', '$2y$12$ktbJTdWgEo9Xc00ClODF/uA1gGV/VdwbXC7PIh/YHEWPduvuJdjlO', 'tamu', NULL, '2026-03-12 09:16:53', '2026-03-12 09:16:53'),
(3, 'made wisama', 'wisma', 'wisma@gmail.com', '$2y$12$LpoBwryE56FlzRai51wRNupMaEk0Gk3rZ15V6y4chZFPvK57EP5am', 'admin', NULL, '2026-03-12 20:41:03', '2026-03-23 00:34:03'),
(4, 'Doni', 'Doni', 'doni4@gmail.com', '$2y$12$4T/2UIJy5UC/0QW2zKum3uRmagmrRCkgne4UQeYr3SswxGkPEcRme', 'tamu', NULL, '2026-03-12 21:30:39', '2026-03-12 21:30:39'),
(5, 'dekusut', 'de', 'deglot@3.com', '$2y$12$jMYnvTvYl55S4ApuYq4TwehzPtFIOOZPMXmtZ.fDo/N4HmqaLB5da', 'tamu', NULL, '2026-03-23 00:52:57', '2026-03-23 00:52:57'),
(8, 'Wayan', 'Kusuma', 'kus@11.com', '$2y$12$ZV9rnomNIxCdZ7NDOcyhEO/2paSZZsGetPOU04AM9rqxHZoUkJquW', 'tamu', NULL, '2026-03-30 20:02:45', '2026-03-30 20:02:45'),
(10, 'wayan doni', 'doni11', 'doni11@gmail.com', '$2y$12$8GZUIJ5DkuomwvbqPyMbfOHYij6NhevAxwHyQEiO00jwUAKahBiyi', 'tamu', NULL, '2026-03-31 20:16:57', '2026-03-31 20:27:19'),
(11, 'jjj', 'jjj', 'jjj@11.com', '$2y$12$6gYHxKI4AMawAvcz58/r3.u4dbPAuLcrfWbQlA/AuXmdyYRbXJLjq', 'tamu', NULL, '2026-04-06 02:58:40', '2026-04-06 02:58:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_ruangan_id_foreign` (`ruangan_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_at_available_at_index` (`queue`,`reserved_at`,`available_at`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ruangan_id_foreign` FOREIGN KEY (`ruangan_id`) REFERENCES `ruangan` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
