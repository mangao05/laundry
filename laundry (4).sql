-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2019 at 04:38 AM
-- Server version: 10.2.10-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_code`, `branch_address`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '1234', 'qwe', NULL, '2019-11-12 21:54:49', '2019-11-12 21:54:49');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `contact_number`, `address1`, `address2`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Jeric Mangao', '09280637616', 'san pablo', 'san pablo', NULL, '2019-06-30 23:45:05', '2019-06-30 23:45:05');

-- --------------------------------------------------------

--
-- Table structure for table `customer_points`
--

CREATE TABLE `customer_points` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `points` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_points`
--

INSERT INTO `customer_points` (`id`, `customer_id`, `points`, `created_at`, `updated_at`) VALUES
(1, 1, 144, NULL, '2019-07-14 21:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_06_18_023609_create_services_table', 1),
(9, '2019_06_20_065251_create_transactions_table', 1),
(10, '2019_06_20_065609_create_transaction_details_table', 1),
(11, '2019_06_20_065623_create_customers_table', 1),
(12, '2019_06_21_051357_create_transaction_items_table', 1),
(13, '2019_06_26_030413_create_roles_table', 1),
(14, '2019_06_27_020118_create_branches_table', 1),
(15, '2019_07_01_072707_create_customer_points_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '123', '', '05:47:33', '2019-07-01 21:47:17', '2019-07-01 21:47:33'),
(2, 'staff', 'staff', NULL, '2019-11-12 21:56:27', '2019-11-12 21:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `minimum` int(11) DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service`, `price`, `minimum`, `type`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Clothes (wash, dry, fold)', 75, 3, 'kilo', NULL, '2019-06-30 23:43:40', '2019-06-30 23:43:40'),
(2, 'Long Sleeve', 75, NULL, 'item', NULL, '2019-06-30 23:43:56', '2019-06-30 23:43:56'),
(3, 'Barong Pina', 250, NULL, 'item', NULL, '2019-11-12 21:59:41', '2019-11-12 21:59:41'),
(4, 'Jusi', 250, NULL, 'item', NULL, '2019-11-12 21:59:54', '2019-11-12 21:59:54'),
(5, 'Pants', 150, NULL, 'item', NULL, '2019-11-12 22:00:11', '2019-11-12 22:00:11'),
(6, 'Leather Pants', 250, NULL, 'item', NULL, '2019-11-12 22:00:41', '2019-11-12 22:00:41'),
(7, 'Jackets(reg.)', 350, NULL, 'item', NULL, '2019-11-12 22:00:59', '2019-11-12 22:00:59'),
(8, 'Wash dry fold', 28, 3, 'kilo', NULL, '2019-11-12 22:01:19', '2019-11-12 22:01:19'),
(9, 'Wash Dry Press', 80, 3, 'kilo', NULL, '2019-11-12 22:01:40', '2019-11-12 22:01:40'),
(10, 'Press Only', 58, 3, 'kilo', NULL, '2019-11-12 22:01:58', '2019-11-12 22:01:58'),
(11, 'Comforters', 80, 3, 'kilo', NULL, '2019-11-12 22:02:34', '2019-11-12 22:02:34'),
(12, 'coat', 300, NULL, 'item', NULL, '2019-11-13 19:29:47', '2019-11-13 19:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `mode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pickup_date` timestamp NULL DEFAULT NULL,
  `points_used` double DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on_going',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_number`, `customer_id`, `mode`, `pickup_date`, `points_used`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '0001', 1, 'Deliver', NULL, 0, 'finish', NULL, '2019-06-30 23:45:05', '2019-07-14 21:34:08'),
(2, '0002', 1, 'Deliver', NULL, 0, 'cancel', NULL, '2019-07-14 19:38:04', '2019-10-28 16:32:11'),
(3, '3', 1, 'pickup', NULL, 0, 'ongoing', NULL, '2019-11-13 17:58:10', '2019-11-13 17:58:10'),
(4, '4', 1, 'pickup', NULL, 0, 'ongoing', NULL, '2019-11-13 17:59:12', '2019-11-13 17:59:12'),
(5, '5', 1, 'pickup', NULL, 0, 'ongoing', NULL, '2019-11-13 18:05:23', '2019-11-13 18:05:23'),
(6, '6', 1, 'pickup', NULL, 0, 'ongoing', NULL, '2019-11-13 18:06:41', '2019-11-13 18:06:41'),
(7, '7', 1, 'pickup', NULL, 0, 'ongoing', NULL, '2019-11-13 18:07:23', '2019-11-13 18:07:23'),
(8, '8', 1, 'pickup', NULL, 0, 'ongoing', NULL, '2019-11-13 18:08:29', '2019-11-13 18:08:29'),
(9, '9', 1, 'pickup', NULL, 0, 'ongoing', NULL, '2019-11-13 18:09:02', '2019-11-13 18:09:02'),
(10, '10', 1, 'pickup', NULL, 0, 'ongoing', NULL, '2019-11-13 18:11:52', '2019-11-13 18:11:52'),
(11, '11', 1, 'pickup', NULL, 0, 'ongoing', NULL, '2019-11-13 18:12:17', '2019-11-13 18:12:17'),
(12, '12', 1, 'pickup', NULL, 0, 'ongoing', NULL, '2019-11-13 18:12:43', '2019-11-13 18:12:43'),
(13, '13', 1, 'pickup', NULL, 0, 'ongoing', NULL, '2019-11-13 18:13:07', '2019-11-13 18:13:07'),
(14, '14', 1, 'pickup', NULL, 0, 'ongoing', NULL, '2019-11-13 18:14:07', '2019-11-13 18:14:07'),
(15, '15', 1, 'pickup', NULL, 0, 'ongoing', NULL, '2019-11-13 18:15:00', '2019-11-13 18:15:00'),
(16, '16', 1, 'pickup', NULL, 0, 'ongoing', NULL, '2019-11-13 19:33:52', '2019-11-13 19:33:52'),
(17, '17', 1, 'pickup', NULL, 0, 'ongoing', NULL, '2019-11-13 19:34:47', '2019-11-13 19:34:47'),
(18, '18', 1, 'pickup', NULL, 0, 'ongoing', NULL, '2019-11-13 19:36:13', '2019-11-13 19:36:13');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2019-06-30 23:45:05', '2019-06-30 23:45:05'),
(2, 2, NULL, '2019-07-01 21:58:31', '2019-07-01 21:58:31'),
(3, 3, NULL, '2019-07-02 00:45:19', '2019-07-02 00:45:19'),
(4, 4, NULL, '2019-11-13 17:59:12', '2019-11-13 17:59:12'),
(5, 5, NULL, '2019-11-13 18:05:23', '2019-11-13 18:05:23'),
(6, 6, NULL, '2019-11-13 18:06:41', '2019-11-13 18:06:41'),
(7, 7, NULL, '2019-11-13 18:07:23', '2019-11-13 18:07:23'),
(8, 8, NULL, '2019-11-13 18:08:29', '2019-11-13 18:08:29'),
(9, 9, NULL, '2019-11-13 18:09:02', '2019-11-13 18:09:02'),
(10, 10, NULL, '2019-11-13 18:11:52', '2019-11-13 18:11:52'),
(11, 11, NULL, '2019-11-13 18:12:17', '2019-11-13 18:12:17'),
(12, 12, NULL, '2019-11-13 18:12:43', '2019-11-13 18:12:43'),
(13, 13, NULL, '2019-11-13 18:13:07', '2019-11-13 18:13:07'),
(14, 14, NULL, '2019-11-13 18:14:07', '2019-11-13 18:14:07'),
(15, 15, NULL, '2019-11-13 18:15:00', '2019-11-13 18:15:00'),
(16, 16, NULL, '2019-11-13 19:33:53', '2019-11-13 19:33:53'),
(17, 17, NULL, '2019-11-13 19:34:47', '2019-11-13 19:34:47'),
(18, 18, NULL, '2019-11-13 19:36:13', '2019-11-13 19:36:13');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_details_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `item` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `transaction_details_id`, `service_id`, `item`, `qty`, `price`, `status`, `created_at`, `updated_at`) VALUES
(9, 15, 7, 'Jackets(reg.)', 2, 700, NULL, '2019-11-13 18:15:00', '2019-11-13 18:15:00'),
(10, 15, 6, 'Leather Pants', 2, 500, NULL, '2019-11-13 18:15:00', '2019-11-13 18:15:00'),
(11, 15, 5, 'Pants', 2, 300, NULL, '2019-11-13 18:15:00', '2019-11-13 18:15:00'),
(12, 16, 12, 'coat', 2, 600, NULL, '2019-11-13 19:33:53', '2019-11-13 19:33:53'),
(13, 17, 12, 'coat', 2, 600, NULL, '2019-11-13 19:34:47', '2019-11-13 19:34:47'),
(14, 18, 12, 'coat', 2, 600, NULL, '2019-11-13 19:36:13', '2019-11-13 19:36:13'),
(15, 18, 12, 'coat', 2, 600, NULL, '2019-11-13 19:36:13', '2019-11-13 19:36:13'),
(16, 18, 12, 'coat', 2, 600, NULL, '2019-11-13 19:36:13', '2019-11-13 19:36:13'),
(17, 18, 12, 'coat', 2, 600, NULL, '2019-11-13 19:36:13', '2019-11-13 19:36:13'),
(18, 18, 12, 'coat', 2, 600, NULL, '2019-11-13 19:36:13', '2019-11-13 19:36:13'),
(19, 18, 12, 'coat', 2, 600, NULL, '2019-11-13 19:36:13', '2019-11-13 19:36:13'),
(20, 18, 12, 'coat', 2, 600, NULL, '2019-11-13 19:36:13', '2019-11-13 19:36:13'),
(21, 18, 12, 'coat', 2, 600, NULL, '2019-11-13 19:36:13', '2019-11-13 19:36:13'),
(22, 18, 12, 'coat', 2, 600, NULL, '2019-11-13 19:36:13', '2019-11-13 19:36:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Administrator',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Activate',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `user_type`, `status`, `email_verified_at`, `password`, `branch`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Jeric E. Mangao', 'mangao_jeric@yahoo.com', 'Administrator', 'Activate', NULL, '$2y$10$k8s2cJwVxYnZN50GrMio.eVk15OAI1ZONbzO5paDgU82f4513qa1a', NULL, NULL, NULL, '2019-06-30 23:43:04', '2019-06-30 23:43:04'),
(2, 'Khenneth Alaiza', 'khen@khen.com', 'staff', 'Activate', NULL, '$2y$10$O.MV0xiCVikX3WXCWqZYXuLVhtd/ETu/F5iBoqlSSJ3PNzeqwmrAO', '1234', NULL, NULL, '2019-11-12 21:57:25', '2019-11-12 21:57:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_points`
--
ALTER TABLE `customer_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
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
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_points`
--
ALTER TABLE `customer_points`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
