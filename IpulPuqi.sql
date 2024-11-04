-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 03:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectkeluhan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_id` int(30) NOT NULL,
  `Username` varchar(25) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_keluhan`
--

CREATE TABLE `kategori_keluhan` (
  `id_kategori_keluhan` int(30) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_keluhan`
--

INSERT INTO `kategori_keluhan` (`id_kategori_keluhan`, `nama_kategori`) VALUES
(1, 'Fasilitas'),
(2, 'SDM'),
(3, 'Akademik');

-- --------------------------------------------------------

--
-- Table structure for table `keluhan`
--

CREATE TABLE `keluhan` (
  `id_keluhan` int(30) NOT NULL,
  `id_mhs` int(30) DEFAULT NULL,
  `id_kategori_keluhan` int(30) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `status` enum('proses','batal','sudah') DEFAULT NULL,
  `tanggapan` varchar(100) DEFAULT NULL,
  `tgl_keluhan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keluhan`
--

INSERT INTO `keluhan` (`id_keluhan`, `id_mhs`, `id_kategori_keluhan`, `deskripsi`, `lokasi`, `status`, `tanggapan`, `tgl_keluhan`) VALUES
(1, 0, 2, 'xzcsa\r\n\r\n\r\n\r\nas\r\n', '', 'proses', '', '2024-10-10'),
(2, 5, 2, 'rosak le aseli', '', 'proses', '', '2024-10-28'),
(3, 5, 2, 'sdaosuda', '', 'proses', '', '2024-10-28'),
(4, 5, 3, 'Alumni ini', '', 'proses', '', '2000-12-31'),
(5, 5, 2, 'isinya jomok semua anjjj', '', 'proses', '', '2023-12-18'),
(6, 6, 1, '111', '999', 'proses', '', '2024-11-01'),
(7, 16, 2, 'esadkl', '', 'proses', '', '2024-11-04'),
(8, 18, 3, 'sss', '', 'proses', '', '2024-11-04');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id_mhs` int(50) NOT NULL,
  `Nim` varchar(100) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id_mhs`, `Nim`, `username`, `password`) VALUES
(16, '111', '111', '$2y$10$MwlQ4VAmulYzpqIKCev4SOKVxC6MoRPjvvJc05SSmTQTjFMYuG4mi'),
(18, '122', 'Zikri Gans', '$2y$10$X5Cgv8CGE3BuUAkPrHdsNuHS.jrBQifPGpwwRXBhCxkFaxbf5XIo.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_id`);

--
-- Indexes for table `kategori_keluhan`
--
ALTER TABLE `kategori_keluhan`
  ADD PRIMARY KEY (`id_kategori_keluhan`);

--
-- Indexes for table `keluhan`
--
ALTER TABLE `keluhan`
  ADD PRIMARY KEY (`id_keluhan`),
  ADD KEY `Nim` (`id_mhs`),
  ADD KEY `id_kategori_keluhan` (`id_kategori_keluhan`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id_mhs`),
  ADD UNIQUE KEY `unique_nim` (`Nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keluhan`
--
ALTER TABLE `keluhan`
  MODIFY `id_keluhan` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id_mhs` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
