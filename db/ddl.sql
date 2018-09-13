-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2018 at 01:27 AM
-- Server version: 5.7.21
-- PHP Version: 7.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travely`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(25) NOT NULL,
  `tanggal_lahir` varchar(10) NOT NULL,
  `nomor_telepon` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `domisili`
--

CREATE TABLE `domisili` (
  `id_domisili` varchar(3) NOT NULL,
  `nama_domisili` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` varchar(16) NOT NULL,
  `tanggal_berangkat` varchar(10) NOT NULL,
  `tanggal_tiba` varchar(10) NOT NULL,
  `stasiun_asal` varchar(16) NOT NULL,
  `stasiun_tujuan` varchar(16) NOT NULL,
  `waktu_berangkat` varchar(5) NOT NULL,
  `waktu_sampai` varchar(5) NOT NULL,
  `kereta` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `tipe` varchar(5) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kereta`
--

CREATE TABLE `kereta` (
  `id_kereta` varchar(16) NOT NULL,
  `nama_kereta` varchar(20) NOT NULL,
  `kapasitas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kursi`
--

CREATE TABLE `kursi` (
  `id_kursi` varchar(16) NOT NULL,
  `no_kursi` varchar(5) NOT NULL,
  `kereta` varchar(16) NOT NULL,
  `kelas` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stasiun`
--

CREATE TABLE `stasiun` (
  `id_stasiun` varchar(16) NOT NULL,
  `nama_stasiun` varchar(20) NOT NULL,
  `domisili` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tiket`
--

CREATE TABLE `tiket` (
  `id_tiket` varchar(16) NOT NULL,
  `status` varchar(10) NOT NULL,
  `kursi` varchar(16) NOT NULL,
  `jadwal` varchar(16) NOT NULL,
  `transkasi` varchar(16) NOT NULL,
  `id_penumpang` varchar(16) NOT NULL,
  `nama_penumpang` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(16) NOT NULL,
  `tanggal_transaksi` varchar(10) NOT NULL,
  `total` varchar(15) NOT NULL,
  `akun` varchar(16) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `domisili`
--
ALTER TABLE `domisili`
  ADD PRIMARY KEY (`id_domisili`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `stasiun_asal` (`stasiun_asal`),
  ADD KEY `stasiun_tujuan` (`stasiun_tujuan`),
  ADD KEY `kereta` (`kereta`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`tipe`);

--
-- Indexes for table `kereta`
--
ALTER TABLE `kereta`
  ADD PRIMARY KEY (`id_kereta`);

--
-- Indexes for table `kursi`
--
ALTER TABLE `kursi`
  ADD PRIMARY KEY (`id_kursi`),
  ADD KEY `kelas` (`kelas`),
  ADD KEY `kereta` (`kereta`);

--
-- Indexes for table `stasiun`
--
ALTER TABLE `stasiun`
  ADD PRIMARY KEY (`id_stasiun`),
  ADD KEY `domisili` (`domisili`);

--
-- Indexes for table `tiket`
--
ALTER TABLE `tiket`
  ADD PRIMARY KEY (`id_tiket`),
  ADD KEY `kursi` (`kursi`),
  ADD KEY `jadwal` (`jadwal`),
  ADD KEY `transkasi` (`transkasi`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`stasiun_asal`) REFERENCES `stasiun` (`id_stasiun`),
  ADD CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`stasiun_tujuan`) REFERENCES `stasiun` (`id_stasiun`),
  ADD CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`kereta`) REFERENCES `kereta` (`id_kereta`);

--
-- Constraints for table `kursi`
--
ALTER TABLE `kursi`
  ADD CONSTRAINT `kursi_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`tipe`),
  ADD CONSTRAINT `kursi_ibfk_2` FOREIGN KEY (`kereta`) REFERENCES `kereta` (`id_kereta`);

--
-- Constraints for table `stasiun`
--
ALTER TABLE `stasiun`
  ADD CONSTRAINT `stasiun_ibfk_1` FOREIGN KEY (`domisili`) REFERENCES `domisili` (`id_domisili`);

--
-- Constraints for table `tiket`
--
ALTER TABLE `tiket`
  ADD CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`kursi`) REFERENCES `kursi` (`id_kursi`),
  ADD CONSTRAINT `tiket_ibfk_2` FOREIGN KEY (`jadwal`) REFERENCES `jadwal` (`id_jadwal`),
  ADD CONSTRAINT `tiket_ibfk_3` FOREIGN KEY (`transkasi`) REFERENCES `transaksi` (`id_transaksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
