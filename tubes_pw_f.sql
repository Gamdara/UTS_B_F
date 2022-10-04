-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2022 at 07:04 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

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
  `judul` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `sinopsis` text NOT NULL,
  `cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bukus`
--

INSERT INTO `bukus` (`id`, `judul`, `jumlah`, `sinopsis`, `cover`) VALUES
(1, 'PHP Dasar', 5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sem leo, faucibus ac libero ut, cursus iaculis purus. Nulla mollis a mauris ac maximus. Ut blandit, tellus et fermentum aliquet, massa felis hendrerit orci, id tempor est lectus id lacus. In nec convallis lectus. Quisque urna sem, pharetra nec nunc sed, interdum feugiat leo. Mauris non nisl fermentum, aliquet tortor sit amet, lacinia sem. Quisque pulvinar euismod nibh non tristique. Vestibulum vel quam vel turpis dictum rhoncus. Donec quam eros, tempus quis gravida vel, molestie id tellus. In nec sagittis sem, in ullamcorper dolor. Nulla a mollis mi. Sed arcu ante, aliquet in dictum eget, commodo ullamcorper elit. Quisque molestie iaculis enim, quis efficitur odio fermentum sodales. Nullam ultrices lacinia lacus, at blandit sapien lobortis sed.\n\nMorbi eu leo sit amet orci rutrum fermentum quis ut sem. Nulla varius, elit nec semper ornare, risus purus rutrum ante, eget pretium erat sapien at lorem. Aenean felis nisi, ullamcorper nec porttitor eget, malesuada euismod urna. Aliquam non luctus dolor. Donec tincidunt nunc auctor hendrerit posuere. Donec ullamcorper arcu sit amet lectus vestibulum, id molestie magna auctor. Suspendisse ornare metus vitae leo rutrum malesuada. Integer mattis lectus ac sem tincidunt volutpat. Nulla facilisi.', 'jsdasar'),
(2, 'javascript dasar', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam et pulvinar velit, ac ullamcorper est. Nullam dictum ultrices porta. Maecenas at odio quis urna varius luctus. Proin augue sapien, semper et condimentum eu, elementum vitae nunc. Pellentesque non nisi quis magna tincidunt semper vel sit amet tellus. Aenean placerat lacus a dolor scelerisque, non pulvinar risus vehicula. Aliquam erat volutpat. Praesent id aliquet ex. Morbi convallis eu metus in mollis. Aliquam nec nulla leo. Duis elementum porttitor lorem eu scelerisque. Phasellus nec tincidunt dui.\r\n\r\nMaecenas hendrerit consectetur fermentum. Aliquam pharetra ipsum quis nisi ultricies, hendrerit elementum est gravida. Suspendisse potenti. Fusce ligula lorem, efficitur at erat et, euismod commodo sapien. Cras rutrum suscipit est eu convallis. Phasellus id vehicula purus. Donec convallis metus a augue tincidunt vestibulum. Nam pulvinar eget nunc et pharetra.\r\n\r\nSed gravida molestie dui, ac feugiat eros congue ut. Quisque aliquam erat leo, at bibendum orci auctor non. Nullam maximus lobortis commodo. Maecenas sodales at tortor eget viverra. Curabitur molestie neque id odio pharetra, eget ultricies dolor suscipit. Nulla ex orci, finibus sit amet placerat ut, commodo ac mauris. Pellentesque mollis accumsan varius. Nullam suscipit imperdiet erat, nec auctor velit consectetur sed. Proin ut nunc pretium, accumsan.', 'phpdasar');

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `genre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(3, 2, 1, '2022-09-28', '2022-10-01', 1),
(4, 1, 1, '2022-10-01', '2022-10-07', 0);

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
(1, 'dadang', 'dadang@gmail.com', '123', 'dadang.jpg', ''),
(2, 'dadang', 'dadang@gmail.com', '123', 'dadang.jpg\r\n', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bukus`
--
ALTER TABLE `bukus`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjamans`
--
ALTER TABLE `peminjamans`
  ADD CONSTRAINT `fk_buku_peinjaman` FOREIGN KEY (`id_buku`) REFERENCES `bukus` (`id`),
  ADD CONSTRAINT `fk_user_peminjaman` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

ALTER TABLE `bukus`
  ADD CONSTRAINT `fk_buku_genre` FOREIGN KEY (`id_genre`) REFERENCES `genres` (`id`);
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
