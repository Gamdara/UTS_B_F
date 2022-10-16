-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2022 at 06:19 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubes_pw_f`
--

-- --------------------------------------------------------

--
-- Table structure for table `bukus`
--

CREATE TABLE `bukus` (
  `id` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL,
  `id_penulis` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sinopsis` text NOT NULL,
  `cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bukus`
--

INSERT INTO `bukus` (`id`, `id_genre`, `id_penulis`, `judul`, `jumlah`, `sinopsis`, `cover`) VALUES
(4, 11, 1, 'qjf', 30, 'wde', '634a665cad00c.png');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`id`, `genre`) VALUES
(1, 'FIksi'),
(11, 'Thriller'),
(12, 'Drama');

-- --------------------------------------------------------

--
-- Table structure for table `peminjamans`
--

CREATE TABLE `peminjamans` (
  `id` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjamans`
--

INSERT INTO `peminjamans` (`id`, `id_buku`, `id_user`, `tanggal_pinjam`, `tanggal_kembali`, `status`) VALUES
(4, 4, 5, '2022-10-16', '2022-10-23', 0),
(5, 4, 5, '2022-10-16', '2022-10-23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `penulis`
--

CREATE TABLE `penulis` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `asal` varchar(255) NOT NULL,
  `tl` date NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penulis`
--

INSERT INTO `penulis` (`id`, `nama`, `asal`, `tl`, `foto`) VALUES
(1, 'qwe', 'qwe', '2022-10-06', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `foto`, `role`) VALUES
(1, 'nama', 'email.com', 'd6e1c05c8a81c2ae74c7aedea5ec92c1', '', 'admin'),
(3, 'qwe', 'qw', '006d2143154327a64d86a264aea225f3', '633d256599e93.png', 'user'),
(4, 'qwe', 'qwe', '$2y$10$am6vfvu3kdn4iuMpB7JW/.fhGUL0ivaVylxA4HcZ9y4dKId0owCku', 'Screenshot 2021-10-20 143558.png', 'user'),
(5, 'gde rama vedanta yudhistira', 'asd', '$2y$10$BQCfumrOYa1ttT2o2b4eZ.UDm5mqpzSxj7DaRCcnineBvML0NvV4W', 'Screenshot 2021-10-20 143558.png', 'user'),
(6, 'admin', 'admin', '$2y$10$ty8JzNnvd8d4kGu5Ct/h8uWQQEeGHMJ19ITzeMmw.XTz2EeNZ9NBq', 'Screenshot 2021-10-20 143558.png', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukus`
--
ALTER TABLE `bukus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_buku_genre` (`id_genre`),
  ADD KEY `fk_buku_penulis` (`id_penulis`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_peminjaman` (`id_user`),
  ADD KEY `fk_buku_peinjaman` (`id_buku`);

--
-- Indexes for table `penulis`
--
ALTER TABLE `penulis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bukus`
--
ALTER TABLE `bukus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bukus`
--
ALTER TABLE `bukus`
  ADD CONSTRAINT `fk_buku_genre` FOREIGN KEY (`id_genre`) REFERENCES `genres` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_buku_penulis` FOREIGN KEY (`id_penulis`) REFERENCES `penulis` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD CONSTRAINT `fk_buku_peinjaman` FOREIGN KEY (`id_buku`) REFERENCES `bukus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_peminjaman` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
