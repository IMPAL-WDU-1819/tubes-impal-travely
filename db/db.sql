-- MySQL dump 10.13  Distrib 5.7.21, for osx10.12 (x86_64)
--
-- Host: localhost    Database: travely
-- ------------------------------------------------------
-- Server version	5.7.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `akun`
--

DROP TABLE IF EXISTS `akun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `akun` (
  `id_akun` varchar(16) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `password` varchar(25) NOT NULL,
  `tanggal_lahir` varchar(10) NOT NULL,
  `nomor_telepon` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id_akun`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `akun`
--

LOCK TABLES `akun` WRITE;
/*!40000 ALTER TABLE `akun` DISABLE KEYS */;
/*!40000 ALTER TABLE `akun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domisili`
--

DROP TABLE IF EXISTS `domisili`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domisili` (
  `id_domisili` varchar(3) NOT NULL,
  `nama_domisili` varchar(30) NOT NULL,
  PRIMARY KEY (`id_domisili`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domisili`
--

LOCK TABLES `domisili` WRITE;
/*!40000 ALTER TABLE `domisili` DISABLE KEYS */;
/*!40000 ALTER TABLE `domisili` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jadwal`
--

DROP TABLE IF EXISTS `jadwal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jadwal` (
  `id_jadwal` varchar(16) NOT NULL,
  `tanggal_berangkat` varchar(10) NOT NULL,
  `tanggal_tiba` varchar(10) NOT NULL,
  `stasiun_asal` varchar(16) NOT NULL,
  `stasiun_tujuan` varchar(16) NOT NULL,
  `waktu_berangkat` varchar(5) NOT NULL,
  `waktu_sampai` varchar(5) NOT NULL,
  `kereta` varchar(16) NOT NULL,
  PRIMARY KEY (`id_jadwal`),
  KEY `stasiun_asal` (`stasiun_asal`),
  KEY `stasiun_tujuan` (`stasiun_tujuan`),
  KEY `kereta` (`kereta`),
  CONSTRAINT `jadwal_ibfk_1` FOREIGN KEY (`stasiun_asal`) REFERENCES `stasiun` (`id_stasiun`),
  CONSTRAINT `jadwal_ibfk_2` FOREIGN KEY (`stasiun_tujuan`) REFERENCES `stasiun` (`id_stasiun`),
  CONSTRAINT `jadwal_ibfk_3` FOREIGN KEY (`kereta`) REFERENCES `kereta` (`id_kereta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal`
--

LOCK TABLES `jadwal` WRITE;
/*!40000 ALTER TABLE `jadwal` DISABLE KEYS */;
/*!40000 ALTER TABLE `jadwal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kelas`
--

DROP TABLE IF EXISTS `kelas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kelas` (
  `tipe` varchar(5) NOT NULL,
  `harga` int(10) NOT NULL,
  PRIMARY KEY (`tipe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelas`
--

LOCK TABLES `kelas` WRITE;
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kereta`
--

DROP TABLE IF EXISTS `kereta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kereta` (
  `id_kereta` varchar(16) NOT NULL,
  `nama_kereta` varchar(20) NOT NULL,
  `kapasitas` int(3) NOT NULL,
  PRIMARY KEY (`id_kereta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kereta`
--

LOCK TABLES `kereta` WRITE;
/*!40000 ALTER TABLE `kereta` DISABLE KEYS */;
/*!40000 ALTER TABLE `kereta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursi`
--

DROP TABLE IF EXISTS `kursi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kursi` (
  `id_kursi` varchar(16) NOT NULL,
  `no_kursi` varchar(5) NOT NULL,
  `kereta` varchar(16) NOT NULL,
  `kelas` varchar(3) NOT NULL,
  PRIMARY KEY (`id_kursi`),
  KEY `kelas` (`kelas`),
  KEY `kereta` (`kereta`),
  CONSTRAINT `kursi_ibfk_1` FOREIGN KEY (`kelas`) REFERENCES `kelas` (`tipe`),
  CONSTRAINT `kursi_ibfk_2` FOREIGN KEY (`kereta`) REFERENCES `kereta` (`id_kereta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursi`
--

LOCK TABLES `kursi` WRITE;
/*!40000 ALTER TABLE `kursi` DISABLE KEYS */;
/*!40000 ALTER TABLE `kursi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stasiun`
--

DROP TABLE IF EXISTS `stasiun`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stasiun` (
  `id_stasiun` varchar(16) NOT NULL,
  `nama_stasiun` varchar(20) NOT NULL,
  `domisili` varchar(3) NOT NULL,
  PRIMARY KEY (`id_stasiun`),
  KEY `domisili` (`domisili`),
  CONSTRAINT `stasiun_ibfk_1` FOREIGN KEY (`domisili`) REFERENCES `domisili` (`id_domisili`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stasiun`
--

LOCK TABLES `stasiun` WRITE;
/*!40000 ALTER TABLE `stasiun` DISABLE KEYS */;
/*!40000 ALTER TABLE `stasiun` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiket`
--

DROP TABLE IF EXISTS `tiket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tiket` (
  `id_tiket` varchar(16) NOT NULL,
  `status` varchar(10) NOT NULL,
  `kursi` varchar(16) NOT NULL,
  `jadwal` varchar(16) NOT NULL,
  `transkasi` varchar(16) NOT NULL,
  `id_penumpang` varchar(16) NOT NULL,
  `nama_penumpang` varchar(100) NOT NULL,
  PRIMARY KEY (`id_tiket`),
  KEY `kursi` (`kursi`),
  KEY `jadwal` (`jadwal`),
  KEY `transkasi` (`transkasi`),
  CONSTRAINT `tiket_ibfk_1` FOREIGN KEY (`kursi`) REFERENCES `kursi` (`id_kursi`),
  CONSTRAINT `tiket_ibfk_2` FOREIGN KEY (`jadwal`) REFERENCES `jadwal` (`id_jadwal`),
  CONSTRAINT `tiket_ibfk_3` FOREIGN KEY (`transkasi`) REFERENCES `transaksi` (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiket`
--

LOCK TABLES `tiket` WRITE;
/*!40000 ALTER TABLE `tiket` DISABLE KEYS */;
/*!40000 ALTER TABLE `tiket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi` (
  `id_transaksi` varchar(16) NOT NULL,
  `tanggal_transaksi` varchar(10) NOT NULL,
  `total` varchar(15) NOT NULL,
  `akun` varchar(16) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-11-05 15:52:30
