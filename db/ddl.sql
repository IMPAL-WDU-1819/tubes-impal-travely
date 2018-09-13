-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2018 at 10:34 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `email`, `nama`, `password`, `tanggal_lahir`, `nomor_telepon`, `alamat`) VALUES
('123', 'hanafigusman@hotmail.com', 'Hanafi Abdullah Gusman', 'taiayam', '09-08-97', '08999457754', 'PGA EL FARINA'),
('124', 'refinheryanto@gmail.com', 'Refin Heryanto', 'taiayam', '09-09-98', '08999458854', 'PGA EL FARINA'),
('125', 'fajaralif92@gmail.com', 'Muchammad Fajar alif', 'taiayam', '09-10-98', '08999459954', 'kost elfarina PGA NO 44'),
('126', 'taufiqdawami@gmail.com', 'Taufiq Akmal Dawami', 'taiayam', '09-11-98', '08999333333', 'gang ummayah');

-- --------------------------------------------------------

--
-- Table structure for table `domisili`
--

CREATE TABLE `domisili` (
  `id_domisili` varchar(3) NOT NULL,
  `nama_domisili` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `domisili`
--

INSERT INTO `domisili` (`id_domisili`, `nama_domisili`) VALUES
('BDG', 'Bandung'),
('JKT', 'DKI Jakarta'),
('TGS', 'Tangerang Selatan');

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

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `tanggal_berangkat`, `tanggal_tiba`, `stasiun_asal`, `stasiun_tujuan`, `waktu_berangkat`, `waktu_sampai`, `kereta`) VALUES
('100', '18-01-2018', '18-01-2018', 'KRC', 'STB', '09.00', '13.00', 'PTS13'),
('101', '20-02-2018', '21-02-2018', 'KRC', 'PPJ', '15.00', '18.00', 'BM12');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `tipe` varchar(5) NOT NULL,
  `harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`tipe`, `harga`) VALUES
('REG', 50000),
('VIP', 100000),
('VVIP', 500000);

-- --------------------------------------------------------

--
-- Table structure for table `kereta`
--

CREATE TABLE `kereta` (
  `id_kereta` varchar(16) NOT NULL,
  `nama_kereta` varchar(20) NOT NULL,
  `kapasitas` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kereta`
--

INSERT INTO `kereta` (`id_kereta`, `nama_kereta`, `kapasitas`) VALUES
('BM12', 'BIMA', 200),
('KCN20', 'KENCANA', 100),
('KEO40', 'KREO', 250),
('PTS13', 'PATAS AC', 300);

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

--
-- Dumping data for table `kursi`
--

INSERT INTO `kursi` (`id_kursi`, `no_kursi`, `kereta`, `kelas`) VALUES
('A1', '1', 'BM12', 'VIP'),
('B1', '1', 'KCN20', 'REG'),
('C1', '1', 'KEO40', 'REG'),
('D1', '1', 'PTS13', 'VIP');

-- --------------------------------------------------------

--
-- Table structure for table `stasiun`
--

CREATE TABLE `stasiun` (
  `id_stasiun` varchar(16) NOT NULL,
  `nama_stasiun` varchar(20) NOT NULL,
  `domisili` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stasiun`
--

INSERT INTO `stasiun` (`id_stasiun`, `nama_stasiun`, `domisili`) VALUES
('GBR', 'Gambir', 'JKT'),
('KRC', 'Kiara Condong', 'BDG'),
('PPJ', 'Pondok Ranji', 'TGS'),
('STB', 'Bandung', 'BDG');

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
  ADD CONSTRAINT `tiket_ibfk_2` FOREIGN KEY (`jadwal`) REFERENCES `jadwal` (`id_jadwal`)

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
