-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 12 Bulan Mei 2023 pada 14.47
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resto`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Admin One', 'admin@gmail.com', '$2y$10$8LLic36SQR33gzTvIpoONOlVyh/MPIC5m5yinYOMYA.hqnPhWxYOC', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_05_05_072224_create_products_table', 1),
(6, '2023_05_05_072710_create_res_tables_table', 1),
(7, '2023_05_05_072958_create_reservations_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_category` varchar(255) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `product_code`, `product_name`, `product_price`, `product_description`, `product_category`, `product_image`, `created_at`, `updated_at`) VALUES
(1, 'NK', 'Paket Nasi Kebuli', 150000, 'Nasi kebuli yang di masak oleh Chef Sri Desti', 'Lunch', 'kebuli.jpg', '2023-05-05 07:45:13', '2023-05-05 07:45:13'),
(2, 'NKJ', 'Paket Nasi Kebuli Jumbo', 200000, 'Nasi kebuli yang di masak oleh Chef Gordon', 'Lunch', 'kebuli.jpg', '2023-05-05 07:45:13', '2023-05-07 14:28:08'),
(3, 'IT', 'Indomie + Teh Botol', 20000, 'Indomie dengan Teh Botol Ashiap', 'Lunch', 'indomie.jpg', NULL, '2023-05-11 04:35:40'),
(4, 'NG', 'Nasi Goreng', 20000, 'Fried Rice with best', 'Lunch', 'gambar.Nasi Goreng.20230511.jpg', NULL, '2023-05-11 06:59:04'),
(5, 'CP', 'Capucino', 25000, 'Capucino', 'Dinner', 'gambar.20230511.jpeg', '2023-05-11 07:01:15', '2023-05-11 07:01:15'),
(6, 'KI', 'Kacang IJo', 12000, 'Kacang IJo', 'Breakfast', 'gambar.20230511.jpg', '2023-05-11 07:08:15', '2023-05-11 07:08:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservations`
--

CREATE TABLE `reservations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `res_id` varchar(255) NOT NULL,
  `res_name_user` varchar(255) NOT NULL,
  `res_phone_user` varchar(255) NOT NULL,
  `res_email_user` varchar(255) NOT NULL,
  `res_total_visitor` int(2) NOT NULL,
  `res_table_name` varchar(255) NOT NULL,
  `res_table_price` varchar(255) NOT NULL,
  `res_table_category` varchar(255) NOT NULL,
  `res_product_name` varchar(255) NOT NULL,
  `res_product_price` int(255) NOT NULL,
  `res_product_category` varchar(255) NOT NULL,
  `res_method_payment` varchar(255) NOT NULL,
  `res_name_payment` varchar(255) NOT NULL,
  `res_code_payment` varchar(255) NOT NULL,
  `res_total` int(12) NOT NULL,
  `res_status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `reservations`
--

INSERT INTO `reservations` (`id`, `res_id`, `res_name_user`, `res_phone_user`, `res_email_user`, `res_total_visitor`, `res_table_name`, `res_table_price`, `res_table_category`, `res_product_name`, `res_product_price`, `res_product_category`, `res_method_payment`, `res_name_payment`, `res_code_payment`, `res_total`, `res_status`, `created_at`, `updated_at`) VALUES
(3, 'RS0505230705001A1NK020517', 'Mac Allister', '085773732580', 'allister@gmail.com', 5, 'A1', '50000', 'Reguler', 'Paket Nasi Kebuli', 150000, 'Lunch', 'bank_transfer', 'bca', '17291512877', 800000, 'Finish', '2023-05-05 12:37:00', '2023-05-05 14:41:54'),
(4, 'RS0605230205001A2NK070524', 'Mac Allister', '085773732580', 'allister@gmail.com', 5, 'A2', '50000', 'Reguler', 'Paket Nasi Kebuli', 150000, 'Lunch', 'bank_transfer', 'bca', '17291331940', 800000, 'Finish', '2023-05-06 07:32:00', '2023-05-06 07:34:35'),
(5, 'RS2005230305001A4NKJ080514', 'Mac Allister', '085773732580', 'allister@gmail.com', 2, 'A4', '50000', 'Reguler', 'Paket Nasi Kebuli Jumbo', 200000, 'Lunch', 'bank_transfer', 'bca', '17291542335', 450000, 'Finish', '2023-05-20 08:09:00', '2023-05-06 08:15:39'),
(7, 'RS1305230305001A3NKJ080550', 'Mac Allister', '088210271293', 'allister@gmail.com', 2, 'A3', '50000', 'Reguler', 'Paket Nasi Kebuli Jumbo', 200000, 'Lunch', 'bank_transfer', 'bca', '17291316108', 450000, 'Finish', '2023-05-13 08:16:00', '2023-05-06 08:23:19'),
(8, 'RS1305230405001B1NK090558', 'Mac Allister', '088210271293', 'allister@gmail.com', 4, 'B1', '0', 'Reguler', 'Paket Nasi Kebuli', 150000, 'Lunch', 'bank_transfer', 'bca', '22333329625', 600000, 'Finish', '2023-05-13 09:31:00', '2023-05-06 09:34:13'),
(9, 'RS2005230905004A2NKJ020524', 'Sultan Fernandez', '085883233308', 'fernandez@gmail.com', 5, 'A2', '0', 'Reguler', 'Paket Nasi Kebuli Jumbo', 200000, 'Lunch', 'bank_transfer', 'bca', '22333115881', 1000000, 'Paid', '2023-05-20 14:01:00', '2023-05-07 14:02:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `res_tables`
--

CREATE TABLE `res_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `table_price` varchar(255) NOT NULL,
  `table_status` varchar(255) NOT NULL,
  `table_category` varchar(255) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `res_tables`
--

INSERT INTO `res_tables` (`id`, `table_name`, `table_price`, `table_status`, `table_category`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'A1', '0', 'Already', 'Reguler', NULL, '2023-05-05 09:40:24', '2023-05-05 14:41:54'),
(2, 'A2', '0', 'Reserved', 'Reguler', '4', '2023-05-05 10:50:35', '2023-05-07 14:02:03'),
(3, 'A3', '0', 'Already', 'Reguler', NULL, '2023-05-05 10:53:15', '2023-05-06 08:23:19'),
(4, 'A4', '0', 'Already', 'Reguler', NULL, '2023-05-05 10:53:15', '2023-05-06 08:15:39'),
(5, 'B1', '0', 'Already', 'Reguler', NULL, '2023-05-05 10:53:15', '2023-05-06 09:34:13'),
(6, 'B2', '0', 'Already', 'Reguler', NULL, '2023-05-05 10:53:15', '2023-05-05 10:53:15'),
(7, 'B3\r\n', '0', 'Already', 'Reguler', NULL, '2023-05-05 10:53:15', '2023-05-05 10:53:15'),
(8, 'B4\r\n', '0', 'Already', 'Reguler', NULL, '2023-05-05 10:53:15', '2023-05-05 10:53:15'),
(9, 'C1', '0', 'Already', 'Reguler', NULL, '2023-05-05 10:53:15', '2023-05-05 10:53:15'),
(10, 'C2', '0', 'Already', 'Reguler', NULL, '2023-05-05 10:53:15', '2023-05-05 10:53:15'),
(11, 'C3\r\n', '0', 'Already', 'Reguler', NULL, '2023-05-05 10:53:15', '2023-05-05 10:53:15'),
(12, 'C4\r\n', '0', 'Already', 'Reguler', NULL, '2023-05-05 10:53:15', '2023-05-05 10:53:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Mac Allister', 'allister@gmail.com', '088210271293', 'Sentul', '$2y$10$K6JtPUxBLohEwI.2TOtR7ujPst9voooZIpqrdru.pnNqQpZ3dUvSu', '2023-05-05 07:43:25', '2023-05-05 07:43:25'),
(2, 'Ameng', 'ameng@gmail.com', '088210271293', 'Sentul', '$2y$10$K6JtPUxBLohEwI.2TOtR7ujPst9voooZIpqrdru.pnNqQpZ3dUvSu', '2023-05-05 07:43:25', '2023-05-05 07:43:25'),
(4, 'Sultan Fernandez', 'fernandez@gmail.com', '085883233308', 'Turin', '$2y$10$Qgkbi.2M246LxFvDNIS6Bub1d8tRXpNHvJ87lf1crsoxzS.Y6KZue', '2023-05-07 14:00:20', '2023-05-07 14:00:20');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `res_tables`
--
ALTER TABLE `res_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `res_tables`
--
ALTER TABLE `res_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
