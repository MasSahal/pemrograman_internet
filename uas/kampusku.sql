-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 09, 2022 at 02:18 AM
-- Server version: 5.7.33
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kampusku`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$Y6Yt/WYA.i8Hr8oPYUpqnuHzZ30NrfSg7NFrQ.wrt4XevaEbeAg5q'),
(2, 'Sahlan', '$2y$10$EezO/Hu5eiLcvWCiRjycR.HkuaJz.yNt2RfL/f1yGelxtX7qYdWXG'),
(3, 'Arif', '$2y$10$qfGmHNP.IaciipO6pUI3zeIRTW4KlscPOcUbHd.oOPihttqhfdHEi'),
(5, 'admin42', '$2y$10$PQg/OtZ5XjP1wopo7ZIfrexU08p9bCwYobP8LCFF2RxJiQL9dHdxK');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nip` int(8) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `telepon` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nip`, `nama`, `telepon`, `email`, `alamat`) VALUES
(20210132, 'Sudadi Pranata M.Si', '0863442342', 'sudadi@ucic.com', 'Cirebon'),
(22223454, 'Dosen Algoritma', '083653522', 'dosena@mail.com', 'Cirebon'),
(33446677, 'Fulanah', '077434343', 'dosenaaa@gmail.com', 'Klayan');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` char(8) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `fakultas` varchar(50) DEFAULT NULL,
  `jurusan` varchar(50) DEFAULT NULL,
  `ipk` decimal(3,2) DEFAULT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `tempat_lahir`, `tanggal_lahir`, `fakultas`, `jurusan`, `ipk`, `foto`) VALUES
('13012010', 'Guha At tamimi', 'Jakarta', '2022-02-10', 'Ekonomi', 'Sastra Indonesia 2', '2.10', 'images.jpg'),
('20210122', 'Anisya', 'Cirebon', '2022-02-01', 'FMIPA', 'Sistem Informasi', '3.50', 'resep-ayam-fillet-saus-tiram.jpeg'),
('21223344', 'Sahal', 'Yogyakarta', '2002-01-26', 'Teknik', 'Teknik Informatika', '3.90', 'Pas Foto 3x4 - 3x zoom.png'),
('21313198', 'Mas Sahal', 'Cirebon', '2022-02-09', 'Teknik', 'TKJ', '4.00', 'shutterstock_1156375873-1.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
