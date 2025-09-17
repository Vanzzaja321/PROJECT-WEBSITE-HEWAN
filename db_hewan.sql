-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2025 at 05:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hewan`
--

-- --------------------------------------------------------

--
-- Table structure for table `hewan`
--

CREATE TABLE `hewan` (
  `id_hewan` int(11) NOT NULL,
  `nama_hewan` varchar(25) NOT NULL,
  `jenis_hewan` varchar(25) NOT NULL,
  `asal` text NOT NULL,
  `jumlah` int(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hewan`
--

INSERT INTO `hewan` (`id_hewan`, `nama_hewan`, `jenis_hewan`, `asal`, `jumlah`) VALUES
(2, 'Harimau Sumatera', 'Mamalia Karnivora', 'Sumatra, Indonesia', 36),
(3, 'Komodo', 'Reptil (Kadal Raksasa)', 'Pulau Komodo, Rinca, Flores – Indonesia', 75),
(4, 'Orangutan Kalimantan', 'Mamalia Primata', 'Hutan Kalimantan', 57),
(45, 'Burung Cenderawasih', 'Aves (Burung) langka', 'Sumatra, Indonesia', 44),
(55, 'Badak Jawa', 'Mamalia Primata', 'Ujung Kulon, Banten – Indonesia', 58);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` enum('admin','operator','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin123', 'admin'),
(2, 'operator', 'operator123', 'operator'),
(3, 'user', 'user123', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hewan`
--
ALTER TABLE `hewan`
  ADD PRIMARY KEY (`id_hewan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hewan`
--
ALTER TABLE `hewan`
  MODIFY `id_hewan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
