-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 14, 2024 at 03:53 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forwardmagazine`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product_id`, `quantity`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 24, 1, 28, '2024-01-14 13:23:57', '2024-01-14 13:23:57'),
(2, 20, 1, 28, '2024-01-14 13:23:57', '2024-01-14 13:23:57'),
(3, 24, 1, 28, '2024-01-14 13:35:05', '2024-01-14 13:35:05'),
(4, 21, 1, 28, '2024-01-14 13:35:05', '2024-01-14 13:35:05'),
(5, 24, 1, 28, '2024-01-14 13:36:54', '2024-01-14 13:36:54'),
(6, 17, 1, 28, '2024-01-14 13:36:54', '2024-01-14 13:36:54'),
(7, 13, 1, 28, '2024-01-14 13:36:54', '2024-01-14 13:36:54'),
(8, 17, 1, 1, '2024-01-14 14:17:40', '2024-01-14 14:17:40'),
(9, 23, 1, 1, '2024-01-14 14:17:40', '2024-01-14 14:17:40');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `description`, `created_by`, `created_at`, `updated_at`, `quantity`) VALUES
(12, 'Gigabyte GeForce RTX 4060 Eagle OC', 'Układ:GeForce RTX 4060\nPamięć:8 GB\nRodzaj pamięci:GDDR6\nZłącza:HDMI 2.1 - 2 szt., DisplayPort 1.4 - 2 szt. ', 1, '2024-01-14 11:13:21', '2024-01-14 11:13:21', 14),
(13, 'MSI GeForce RTX 4060 Ti Ventus 3X OC', 'Układ:GeForce RTX 4060 Ti\r\nPamięć:16 GB\r\nRodzaj pamięci:GDDR6\r\nZłącza:HDMI 2.1a - 1 szt., DisplayPort 1.4a - 3 szt.', 1, '2024-01-14 11:14:07', '2024-01-14 11:14:07', 43),
(14, 'Gigabyte GeForce RTX 3060 GAMING OC LHR', 'Układ:GeForce RTX 3060\r\nPamięć:12 GB\r\nRodzaj pamięci:GDDR6\r\nZłącza:HDMI - 2 szt., DisplayPort - 2 szt.', 1, '2024-01-14 11:14:22', '2024-01-14 11:14:22', 12),
(15, 'Gigabyte GeForce RTX 4070 WINDFORCE OC', 'Układ:GeForce RTX 4070\r\nPamięć:12 GB\r\nRodzaj pamięci:GDDR6X\r\nZłącza:HDMI 2.1a - 1 szt., DisplayPort 1.4a - 3 szt.', 1, '2024-01-14 11:14:34', '2024-01-14 11:14:34', 7),
(16, 'Gigabyte Radeon RX 7800 XT Gaming OC', 'Układ:Radeon™ RX 7800 XT\r\nPamięć:16 GB\r\nRodzaj pamięci:GDDR6\r\nZłącza:HDMI 2.1 - 2 szt., DisplayPort 2.1 - 2 szt.', 1, '2024-01-14 11:15:07', '2024-01-14 11:15:07', 6),
(17, 'Gigabyte Radeon RX 6600 EAGLE', 'Układ:Radeon™ RX 6600\r\nPamięć:8 GB\r\nRodzaj pamięci:GDDR6\r\nZłącza:HDMI 2.1 - 2 szt., DisplayPort 1.4 - 2 szt.', 1, '2024-01-14 11:15:17', '2024-01-14 11:15:17', 23),
(18, 'KFA2 GeForce RTX 4070 1-Click OC 3X', 'Układ:GeForce RTX 4070\r\nPamięć:12 GB\r\nRodzaj pamięci:GDDR6X\r\nZłącza:HDMI 2.1a - 1 szt., DisplayPort 1.4a - 3 szt.', 1, '2024-01-14 11:15:32', '2024-01-14 11:15:32', 16),
(19, 'MSI GeForce RTX 4060 Gaming X', 'Układ:GeForce RTX 4060\r\nPamięć:8 GB\r\nRodzaj pamięci:GDDR6\r\nZłącza:HDMI 2.1a - 1 szt., DisplayPort 1.4a - 3 szt.', 1, '2024-01-14 11:15:58', '2024-01-14 11:15:58', 14),
(20, 'ASRock Radeon RX 6600 Challenger D', 'Układ:Radeon™ RX 6600\r\nPamięć:8 GB\r\nRodzaj pamięci:GDDR6\r\nZłącza:HDMI 2.1 - 1 szt., DisplayPort 1.4 - 3 szt.', 2, '2024-01-14 12:20:31', '2024-01-14 12:20:31', 5),
(21, 'AMD Radeon RX 6950 XT', 'Układ:Radeon™ RX 6950 XT\r\nPamięć:16 GB\r\nRodzaj pamięci:GDDR6\r\nZłącza:HDMI 2.1 - 1 szt., DisplayPort 1.4 - 2 szt., USB Typu-C', 2, '2024-01-14 12:20:44', '2024-01-14 12:20:44', 12),
(22, 'AMD Ryzen 7 5700X', 'Gniazdo procesora:Socket AM4\r\nTaktowanie:3.4 GHz\r\nLiczba rdzeni:8 rdzeni\r\nCache:36 MB', 28, '2024-01-14 12:35:23', '2024-01-14 12:35:23', 9),
(23, 'AMD Ryzen 5 5600', 'Gniazdo procesora:Socket AM4\r\nTaktowanie:3.5 GHz\r\nLiczba rdzeni:6 rdzeni\r\nCache:35 MB', 28, '2024-01-14 12:35:42', '2024-01-14 12:35:42', 5),
(24, 'AMD Ryzen 7 5800X', 'Gniazdo procesora:Socket AM4\r\nTaktowanie:3.8 GHz\r\nLiczba rdzeni:8 rdzeni\r\nCache:36 MB', 28, '2024-01-14 12:35:52', '2024-01-14 12:35:52', 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `email` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `email`, `created_at`, `updated_at`) VALUES
(1, 'Szymon', 'Mil', '$2y$10$s54fU5wiqC0GNFItqJXXT.nctX9Q532wGOB674vVoAaOwmFqgeEGG', 'szymon@gmail.com', '2023-11-01 09:16:51', '2024-01-10 12:16:51'),
(2, 'Kacper', 'Jasiuczenia', '$2y$10$9M7HEazuwmIVVWz6ngxw9.GW02S6zMDp1VrTKV6ES.kyyFzH/asu.', 'jasiu@gmail.com', '2024-01-10 12:19:53', '2024-01-10 12:19:53'),
(3, 'Robert', 'Kubica', '$2y$10$gOzHdGCKTFOe0Pd4MfJQ1uzUZWyJvlC0jaDXUaERxnYCvsPSeeF/S', 'robert@gmail.com', '2024-01-10 12:35:21', '2024-01-10 12:35:21'),
(4, 'Mateusz', 'Koper', '$2y$10$coQRszsqc/7rxNWenaZIyeo.Do9KYUGZRTJXkw/KmM1dgPL9ehWQy', 'koper@gmail.com', '2024-01-10 12:41:33', '2024-01-10 12:41:33'),
(5, 'Adam', 'Malysz', '$2y$10$Pa5sgZTgu/iN0aAkwZPZt.QiNoxVeW2WHotOMidMXaIfshVXnWd4K', 'adam@gmail.com', '2024-01-10 12:44:18', '2024-01-10 12:44:18'),
(6, 'Andrzej', 'Duda', '$2y$10$EdU5SlBXaDGOjN.fW5GKgeeqq2w0pvkcQFfuZG0rpqvWAybNfjKZ2', 'dudus@gmail.com', '2024-01-10 12:45:09', '2024-01-10 12:45:09'),
(7, 'Sebastian', 'Kłos', '$2y$10$BNw9dMc6bbZunpHXU/7rG.D3fEPVLSr0pNzlypef62MTvfJGqUbXC', 'seba@gmail.com', '2024-01-11 11:55:49', '2024-01-11 11:55:49'),
(8, 'Maciek', 'Korek', '$2y$10$OiZprmypkPvq/wzOzCyv8.WiFZWFwwIF9hVJeKWyZ2n/9PryV4h8y', 'korek@gmail.com', '2024-01-11 11:59:33', '2024-01-11 11:59:33'),
(9, 'Czarek', 'Pazura', '$2y$10$0pnd0Iz7p7bNIrC2HVSTWuvTG/y/TmJ5t6Q/.rgAUljHaA6qtoE6S', 'pazura@gmail.com', '2024-01-11 12:04:19', '2024-01-11 12:04:19'),
(16, 'Tadeusz', 'Butek', '$2y$10$3dJ0sXct/wV7dsVmcl1IROPhw4ToPpfqvh/FwaTRB4UysY9DMF0hy', 'tadek@gmail.com', '2024-01-11 12:42:11', '2024-01-11 12:42:11'),
(22, 'Bartek', 'Boczek', '$2y$10$jdqoMY/W3NZCH0CmpmApUOZdewNZROwBT.mvToT4aZsvWJgcTJQ4O', 'boczunio@gmail.com', '2024-01-13 16:27:24', '2024-01-13 16:27:24'),
(28, 'Mateusz', 'Mlotek', '$2y$10$HSG0T6fr2O5odZW6TkV0d.G2f4vQsfAu14n2oJoYPMsJdVWTOfRUm', 'mlotek@gmail.com', '2024-01-14 12:34:37', '2024-01-14 12:34:37');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user` (`created_by`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
