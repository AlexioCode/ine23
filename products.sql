-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 21, 2023 at 06:11 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ine23`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(512) DEFAULT NULL,
  `imgUrl` varchar(512) NOT NULL,
  `price` double(10,2) NOT NULL,
  `discountPercent` double(5,2) DEFAULT NULL,
  `discountStart_at` datetime DEFAULT NULL,
  `discountEnd_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `company_id`, `name`, `description`, `imgUrl`, `price`, `discountPercent`, `discountStart_at`, `discountEnd_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Lucario (NXD)', 'Carta de la colección Próximos destinos', 'img/lucario.jpg', 2.19, 10.00, '2023-10-26 15:56:00', '2023-12-31 15:56:00', '2023-11-21 09:00:54', '2023-11-21 09:00:54'),
(2, 2, 'Shiftry (NXD)', 'Carta de la colección Próximos destinos', 'img/shiftry.jpg', 0.50, 1.00, '2023-10-26 15:56:00', '2023-12-31 15:56:00', '2023-11-21 09:35:41', '2023-11-21 09:35:41'),
(3, 3, 'Amoonguss (NXD)', 'Carta de la colección Próximos destinos', 'img/amoonguss.jpg', 0.38, 2.00, '2023-10-26 15:56:00', '2023-12-31 15:56:00', '2023-11-21 10:35:41', '2023-11-21 10:35:41'),
(4, 1, 'Pinsir (NXD)', 'Carta de la colección Próximos destinos', 'img/pinsir.jpg', 0.75, 0.00, NULL, NULL, '2023-11-03 12:35:41', '2023-11-03 12:35:41'),
(5, 2, 'Weavile (NXD)', 'Carta de la colección Próximos destinos', 'img/weavile.jpg', 1.20, 0.00, NULL, NULL, '2023-11-03 12:36:41', '2023-11-03 12:36:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_name_unique` (`name`),
  ADD UNIQUE KEY `products_imgurl_unique` (`imgUrl`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
