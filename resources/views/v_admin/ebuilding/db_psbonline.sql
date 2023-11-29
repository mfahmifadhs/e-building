-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2021 at 02:27 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_psbonline`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_08_04_054317_siswa_migrations', 2);

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
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `nama_siswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usia` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `asal_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_handphone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_orang_tua` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_ktp_siswa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_pendaftaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `user_id`, `nama_siswa`, `usia`, `jenis_kelamin`, `asal_sekolah`, `no_handphone`, `alamat`, `nama_orang_tua`, `pekerjaan`, `foto_ktp_siswa`, `status_pendaftaran`, `created_at`, `updated_at`) VALUES
(15, 2, 'Fahmi', '20', 'laki-laki', 'SMK Depok', '085772652563', 'Depok', 'Syaidah Rohayati', 'Ibu Rumah Tangga', '1628061165.jpg', 'Diterima', '2021-08-04 00:12:45', '2021-08-04 02:47:28'),
(17, 8, 'Brilianesa', '20', 'laki-laki', 'SMK Depok', '085772652563', 'Jakarta', 'Syaidah Rohayati', 'Ibu Rumah Tangga', '1628076217.jpg', 'Diproses', '2021-08-04 04:23:37', '2021-08-04 04:23:37'),
(18, 13, 'Ristan', '20', 'laki-laki', 'Aceh', '085772652563', 'Aceh', 'Nunung', 'Ibu Rumah Tangga', '1628076350.jpg', 'Diproses', '2021-08-04 04:25:50', '2021-08-04 04:25:50'),
(19, 14, 'Laudry Melano', '20', 'laki-laki', 'SMK Depok', '085772652563', 'Depok', 'Mardiono', 'Tentara', '1628076430.jpg', 'Diproses', '2021-08-04 04:27:10', '2021-08-04 04:27:10'),
(20, 15, 'Reisa Siva', '20', 'perempuan', 'SMA 5 Jakarta', '085772652563', 'Condet', 'Dicky', 'Direktur IT', '1628076501.jpg', 'Diproses', '2021-08-04 04:28:21', '2021-08-04 04:28:21'),
(21, 16, 'Rafli Adit', '20', 'laki-laki', 'Depok', '085772652563', 'Depok', 'Nunung', 'Karyawan', '1628078400.jpg', 'Diterima', '2021-08-04 05:00:00', '2021-08-04 05:00:48');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(2, 'Muhammad Fahmi Fadhlurrohman', 'mfahmifadh@gmail.com', NULL, '$2y$10$wZ.ymhBsFVz1ZzazD4Wuz.l73fDUoEAs4YYi2Dte72CJx0t1q/EuC', NULL, 'user', '2021-08-03 23:48:25', '2021-08-04 03:30:48'),
(3, 'Admin', 'admin@gmail.com', NULL, '$2y$10$d4EFKN64RzeHB/HImOPId.BWZo0g.JSJd9V/Yp9.d/BVlIv9b..Gi', NULL, 'admin', '2021-08-04 01:03:44', '2021-08-04 01:03:44'),
(8, 'Mas Brilianesa', 'bril@gmail.com', NULL, '$2y$10$yUVnaXLr1Agx7wiLiVyJG.gjtAqnJripEZaMYCi5/Y665IhZgzC1W', NULL, 'user', '2021-08-04 01:51:09', '2021-08-04 04:44:40'),
(13, 'Ristan Alfatha A', 'ristan@gmail.com', NULL, '$2y$10$5x7cCTLW9kF9k68ljS7NJeK3n51zPQ5iS3booqlTnUf3x2Gf3Kbha', NULL, 'user', '2021-08-04 04:22:15', '2021-08-04 04:22:15'),
(14, 'Laudry Melano', 'laudry@gmail.com', NULL, '$2y$10$u.pyu3b55suxrHv6L5vBOOMj06Ia/flnVNJDMS.uQFk8MZljDt572', NULL, 'user', '2021-08-04 04:22:45', '2021-08-04 04:22:45'),
(15, 'Reisa Siva', 'reisa@gmail.com', NULL, '$2y$10$khX8smiIQih3pxTeYfV7JueEiwLSAFEoYSyxw.J0VnJyHEkr6Z3cW', NULL, 'user', '2021-08-04 04:22:53', '2021-08-04 04:22:53'),
(16, 'Rafli', 'rafli@gmail.com', NULL, '$2y$10$D8.Kmml9ee/EFvzChfjLceYiu2XaEJ0QIynsO0AO3Sxg4unB9I7w2', NULL, 'user', '2021-08-04 04:59:16', '2021-08-04 04:59:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
