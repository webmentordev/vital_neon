-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2023 at 01:25 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vital_neon`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(255) NOT NULL,
  `jacket` varchar(255) NOT NULL,
  `font` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `backboard` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `align` varchar(255) NOT NULL,
  `adaptor` varchar(255) NOT NULL,
  `remote` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `price_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `order_id` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `checkout_id` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Bedroom', 'bedroom', '2023-04-10 17:20:57', '2023-04-10 17:20:57');

-- --------------------------------------------------------

--
-- Table structure for table `category_prices`
--

CREATE TABLE `category_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `designs`
--

CREATE TABLE `designs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `lines`
--

CREATE TABLE `lines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `lines` varchar(255) NOT NULL,
  `chars` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lines`
--

INSERT INTO `lines` (`id`, `name`, `price`, `lines`, `chars`, `created_at`, `updated_at`) VALUES
(1, '1Line 45\" Long Max 18 Char Per Line', '200.00', '1', 18, '2023-03-25 11:55:56', '2023-03-25 11:55:56'),
(2, '1Line 48\" Long Max 20 Char Per Line', '220.00', '1', 20, '2023-03-25 11:56:18', '2023-03-25 11:56:18'),
(3, '1Line 55\" Long Max 22 Char Per Line', '260.00', '1', 22, '2023-03-25 11:56:30', '2023-03-25 11:56:30'),
(4, '1Line 30\" Long Max 12 Char Per Line', '118.00', '1', 12, '2023-03-25 11:56:45', '2023-03-25 11:56:45'),
(5, '1Line 35\" Long Max 14 Char Per Line', '138.00', '1', 14, '2023-03-25 11:56:57', '2023-03-25 11:56:57'),
(6, '1Line 10\" Long Max 3 Char Per Line', '73.00', '1', 3, '2023-03-25 11:57:14', '2023-03-25 11:57:14'),
(7, '1Line 25\" Long Max 10 Char Per Line', '93.00', '1', 10, '2023-03-25 11:57:22', '2023-03-25 11:57:22'),
(8, '2Line 25\" Long Max 10 Char Per Line', '160.00', '2', 10, '2023-03-25 11:57:52', '2023-03-25 11:57:52'),
(9, '2Line 30\" Long Max 12 Char Per Line', '180.00', '2', 12, '2023-03-25 11:57:59', '2023-03-25 11:57:59'),
(10, '2Line 35\" Long Max 14 Char Per Line', '200.00', '2', 14, '2023-03-25 11:58:09', '2023-03-25 11:58:09'),
(11, '2Line 40\" Long Max 16 Char Per Line', '250.00', '2', 16, '2023-03-25 11:58:15', '2023-03-25 11:58:15'),
(12, '2Line 45\" Long Max 18 Char Per Line', '280.00', '2', 18, '2023-03-25 11:58:22', '2023-03-25 11:58:22'),
(13, '2Line 48\" Long Max 20 Char Per Line', '310.00', '2', 20, '2023-03-25 11:58:31', '2023-03-25 11:58:31'),
(14, '2Line 50\" Long Max 22 Char Per Line', '330.00', '2', 22, '2023-03-25 11:58:39', '2023-03-25 11:58:39'),
(15, '2Line 55\" Long Max 26 Char Per Line', '370.00', '2', 26, '2023-03-25 11:58:46', '2023-03-25 11:58:46'),
(16, '3Line 20\" Long Max 8 Char Per Line', '160.00', '3', 8, '2023-03-25 11:58:53', '2023-03-25 11:58:53'),
(17, '3Line 25\" Long Max 10 Char Per Line', '200.00', '3', 10, '2023-03-25 11:58:59', '2023-03-25 11:58:59'),
(18, '3Line 30\" Long Max 12 Char Per Line', '230.00', '3', 12, '2023-03-25 11:59:06', '2023-03-25 11:59:06'),
(19, '3Line 35\" Long Max 14 Char Per Line', '300.00', '3', 14, '2023-03-25 11:59:13', '2023-03-25 11:59:13'),
(20, '3Line 40\" Long Max 16 Char Per Line', '350.00', '3', 16, '2023-03-25 11:59:21', '2023-03-25 11:59:21'),
(21, '3Line 45\" Long Max 18 Char Per Line', '380.00', '3', 18, '2023-03-25 11:59:31', '2023-03-25 11:59:31'),
(22, '3Line 50\" Long Max 22 Char Per Line', '420.00', '3', 22, '2023-03-25 12:00:12', '2023-03-25 12:00:12'),
(23, '3Line 55\" Long Max 26 Char Per Line', '440.00', '3', 26, '2023-03-25 12:00:23', '2023-03-25 12:00:23'),
(24, '1Line 45\" Long Max 16 Char Per Line', '180.00', '1', 16, '2023-03-25 11:55:56', '2023-03-25 11:55:56'),
(234, '3Line 48\" Long Max 20 Char Per Line', '400.00', '3', 20, '2023-03-25 12:00:12', '2023-03-25 12:00:12');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_03_21_092420_create_sizes_table', 2),
(8, '2023_03_21_103735_create_shapes_table', 3),
(9, '2023_03_21_150031_create_remotes_table', 4),
(13, '2023_03_25_155715_create_lines_table', 6),
(14, '2023_03_20_151929_create_carts_table', 7),
(15, '2023_03_30_125250_create_designs_table', 8),
(20, '2023_04_01_220039_create_category_prices_table', 9),
(21, '2023_04_06_215219_create_supports_table', 10),
(24, '2023_04_09_220611_create_searches_table', 12),
(25, '2023_04_10_220050_create_categories_table', 13),
(28, '2023_04_16_164040_create_orders_table', 15),
(29, '2023_04_01_215213_create_products_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) NOT NULL,
  `adaptor` varchar(255) NOT NULL,
  `remote` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `price_id` varchar(255) NOT NULL,
  `checkout_id` varchar(255) NOT NULL,
  `stripe_product` varchar(255) NOT NULL,
  `checkout_url` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `shape` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stripe_id` varchar(255) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `image` text NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remotes`
--

CREATE TABLE `remotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `remotes`
--

INSERT INTO `remotes` (`id`, `type`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Line Dimmer', '10.00', '2023-03-21 15:14:04', '2023-03-21 15:14:04'),
(2, 'Dimmer with Remote Control', '20.00', '2023-03-21 15:14:12', '2023-03-21 15:14:12'),
(3, 'RGB Color Change Option', '70.00', '2023-03-21 15:14:19', '2023-03-21 15:14:19');

-- --------------------------------------------------------

--
-- Table structure for table `searches`
--

CREATE TABLE `searches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `search` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shapes`
--

CREATE TABLE `shapes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shape` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shapes`
--

INSERT INTO `shapes` (`id`, `shape`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Cut to shape', '10.00', 'The backboard will be shaped in line with the letters. Compared to the cut-to-letter backing, it provides greater support to the neon sign while also lending a stylish and modern appearance.', '2023-03-21 08:04:43', '2023-03-21 08:04:43'),
(2, 'Cut to letter', '15.00', 'The backboard will closely follow the pattern of the preferred font size and style. It provides a minimalistic appearance, making it perfect for interior decoration.', '2023-03-21 08:04:56', '2023-03-21 08:04:56'),
(3, 'Cut to rectangle', '20.00', 'The backboard will be cut rectangularly like a frame. It offers the greatest stability for LED neon signs due to its larger backing surface, making it ideal for outdoor use and sturdier framing needs.', '2023-03-21 08:05:19', '2023-03-21 08:05:19'),
(4, 'Stand', '25.00', 'Make your sign upright on the floor or desk. Lightweight and portable, you can easily place them anywhere you need them.', '2023-03-21 08:05:29', '2023-03-21 08:05:29');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) NOT NULL,
  `width` bigint(20) NOT NULL,
  `height` bigint(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `width`, `height`, `price`, `created_at`, `updated_at`) VALUES
(1, 'Small', 3, 4, '5.00', '2023-03-21 04:48:03', '2023-03-21 04:48:03'),
(2, 'Medium', 4, 5, '10.00', '2023-03-21 04:50:16', '2023-03-21 04:50:16'),
(3, 'Large', 5, 7, '20.00', '2023-03-21 04:50:34', '2023-03-21 04:50:34'),
(4, 'XL', 6, 8, '25.00', '2023-03-21 04:50:46', '2023-03-21 04:50:46'),
(5, 'XXL', 8, 11, '30.00', '2023-03-21 04:50:55', '2023-03-21 04:50:55'),
(6, 'Supersized', 11, 15, '35.00', '2023-03-21 04:52:53', '2023-03-21 04:52:53');

-- --------------------------------------------------------

--
-- Table structure for table `supports`
--

CREATE TABLE `supports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `ticket` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ahmer', 'admin@vitalneon.com', NULL, '$2y$10$CQ2sf/dIuNxsJVsj8GO8jujbaOtW4hkjZQ.QrHihNmn3616BUFqWq', 'FLCvxjgMKnrsjMW0i3FAPJ3ZZVeLUHf0qBGiHtEW0CggR8RmIERjkz3BVyHD', '2023-03-19 07:41:15', '2023-03-19 07:41:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_prices`
--
ALTER TABLE `category_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_prices_product_id_foreign` (`product_id`);

--
-- Indexes for table `designs`
--
ALTER TABLE `designs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `lines`
--
ALTER TABLE `lines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remotes`
--
ALTER TABLE `remotes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `searches`
--
ALTER TABLE `searches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shapes`
--
ALTER TABLE `shapes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category_prices`
--
ALTER TABLE `category_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `designs`
--
ALTER TABLE `designs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lines`
--
ALTER TABLE `lines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=235;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `remotes`
--
ALTER TABLE `remotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `searches`
--
ALTER TABLE `searches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shapes`
--
ALTER TABLE `shapes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supports`
--
ALTER TABLE `supports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_prices`
--
ALTER TABLE `category_prices`
  ADD CONSTRAINT `category_prices_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
