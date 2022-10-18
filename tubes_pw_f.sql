-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2022 at 01:20 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.4

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
(8, 19, 5, 'Harry Poter', 145, 'Diselamatkan dari bibi & paman yang terlalu mengabaikannya, seorang bocah dengan garis takdir besar membuktikan kemampuannya saat ia mulai memasuki Sekolah Sihir Hogwarts.', '634e88ea1d750.jpg'),
(9, 21, 6, 'Kancil', 67, 'Kancil yang cerdik', '634e896383be8.jpg'),
(10, 12, 7, 'Cantik Itu Luka', 90, 'mengisahkan tentang seorang perempuan keturunan Belanda bernama Dewi Ayu yang memiliki paras sangat cantik. Namun, kecantikannya tersebut bukannya membawa sesuatu yang menguntungkan, melainkan malah membawa malapetaka dan kutukan bagi dirinya, beserta keturunannya.', '634e89b625dbd.jpg'),
(11, 20, 8, 'Cerita-cerita Bahagia Hampir Seluruhnya', 150, 'cerita dari para karakter yang sedang berjuang untuk menjadi dirinya sendiri, namun terhalang oleh dunia heteronormatif yang ada di tengah masyarakat, yang akhirnya membuat mereka harus menerima segala konsekuensi tidak mengenakkan dari lingkungan sekitarnya.', '634e8a02a3438.jpg'),
(12, 1, 9, ' The Star and I ', 16, 'eorang aktris bernama Olivia Mitchell. Ia bekerja di sebuah teater yang berada di New York. Selain itu, ia ingin sekali mengetahui keberadaan orang tua kandungnya di New York. Namun, mencari seseorang di besarnya kota megapolitan ini tentunya tak mudah.', '634e8a47298d3.jpg'),
(13, 12, 10, 'Layangan Putus', 6, 'menceritakan tentang kehidupan rumah tangga dari pasangan suami istri bernama Aris dan Kinan yang tiba-tiba diterpa oleh masalah orang ketiga, disaat rumah tangga mereka sebelumnya sangat harmonis.', '634e8a79b0fcc.jpg');

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
(12, 'Drama'),
(19, 'Action'),
(20, 'Romantis'),
(21, 'Dongeng');

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
(5, 'J.K.Rowling', 'Inggris', '1965-07-31', '634e8b091e81c.jpg'),
(6, 'Rahimidin Zahari', 'Indonesia', '1968-03-28', '634e870fe27e7.jpg'),
(7, 'Eka Kurniawan', 'Indonesia', '2020-01-23', '634e8ab0b2343.jpg'),
(8, 'Norman Erikson Pasaribu', 'Jakarta', '2016-11-21', '634e8b45b2b63.jpg'),
(9, 'Ilana Tan', 'New York', '1998-10-08', '634e8ae26186d.jpg'),
(10, 'Mommy ASF', 'London', '1997-05-15', '634e8b2a6d39a.jpg');

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
(6, 'admin', 'admin', '$2y$10$ty8JzNnvd8d4kGu5Ct/h8uWQQEeGHMJ19ITzeMmw.XTz2EeNZ9NBq', 'Screenshot 2021-10-20 143558.png', 'admin'),
(8, 'NEYDELINE DORMA', 'dneydeline@gmail.com', '$2y$10$sr0OwH5jjTifNQOfaV..POppeisbFIYL00zKVTNuTp9qGTbMzDBSi', 'tiket.jpg', 'user');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `peminjamans`
--
ALTER TABLE `peminjamans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penulis`
--
ALTER TABLE `penulis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
