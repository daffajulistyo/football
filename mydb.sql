-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: mydb
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `data_report`
--

DROP TABLE IF EXISTS `data_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `data_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jadwal` int(11) NOT NULL,
  `id_info_tim` int(11) NOT NULL,
  `skor_akhir` varchar(20) NOT NULL,
  `status_akhir` enum('Tim Home Menang','Tim Away Menang','Draw') NOT NULL,
  `total_win_home` int(11) NOT NULL,
  `total_win_away` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_data_report_info_tim1` (`id_info_tim`),
  KEY `fk_data_report_jadwal1` (`id_jadwal`),
  CONSTRAINT `fk_data_report_info_tim1` FOREIGN KEY (`id_info_tim`) REFERENCES `info_tim` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_data_report_jadwal1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `data_report`
--

LOCK TABLES `data_report` WRITE;
/*!40000 ALTER TABLE `data_report` DISABLE KEYS */;
INSERT INTO `data_report` VALUES (1,3,3,'5-2','Tim Home Menang',2,7,NULL),(2,3,3,'5-2','Tim Home Menang',2,7,'2022-11-21 15:50:28');
/*!40000 ALTER TABLE `data_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hasil`
--

DROP TABLE IF EXISTS `hasil`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hasil` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jadwal` int(11) NOT NULL,
  `id_info_tim` int(11) NOT NULL,
  `total_skor` int(11) NOT NULL,
  `waktu_gol` time NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_hasil_jadwal1` (`id_jadwal`),
  KEY `fk_hasil_info_tim1` (`id_info_tim`),
  CONSTRAINT `fk_hasil_info_tim1` FOREIGN KEY (`id_info_tim`) REFERENCES `info_tim` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_hasil_jadwal1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hasil`
--

LOCK TABLES `hasil` WRITE;
/*!40000 ALTER TABLE `hasil` DISABLE KEYS */;
INSERT INTO `hasil` VALUES (2,2,1,7,'12:15:07',NULL),(3,3,3,4,'10:11:12','2022-11-21 15:44:47');
/*!40000 ALTER TABLE `hasil` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `info_tim`
--

DROP TABLE IF EXISTS `info_tim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `info_tim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tim` int(11) NOT NULL,
  `nama_pemain` varchar(45) NOT NULL,
  `tinggi_badan` int(11) NOT NULL,
  `berat_badan` int(11) NOT NULL,
  `posisi_pemain` enum('penyerang','gelandang','bertahan','penjaga-gawang') NOT NULL,
  `nomor_punggung` varchar(45) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomor_punggung_UNIQUE` (`nomor_punggung`),
  KEY `fk_info_tim_tim` (`id_tim`),
  CONSTRAINT `fk_info_tim_tim` FOREIGN KEY (`id_tim`) REFERENCES `tim` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `info_tim`
--

LOCK TABLES `info_tim` WRITE;
/*!40000 ALTER TABLE `info_tim` DISABLE KEYS */;
INSERT INTO `info_tim` VALUES (1,1,'Roberto Firminho',187,68,'penyerang','9',NULL),(2,1,'Muhammad Salah',170,66,'penyerang','10',NULL),(3,2,'Harvertz',166,65,'gelandang','12',NULL),(4,2,'Kepa',190,69,'penjaga-gawang','1',NULL),(5,1,'Alisson Backer',192,68,'penjaga-gawang','79','2022-11-21 15:19:51');
/*!40000 ALTER TABLE `info_tim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jadwal`
--

DROP TABLE IF EXISTS `jadwal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_pertandingan` date NOT NULL,
  `waktu_pertandingan` time NOT NULL,
  `id_tim_home` int(11) NOT NULL,
  `id_tim_away` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_jadwal_tim1` (`id_tim_home`),
  KEY `fk_jadwal_tim2` (`id_tim_away`),
  CONSTRAINT `fk_jadwal_tim1` FOREIGN KEY (`id_tim_home`) REFERENCES `tim` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_jadwal_tim2` FOREIGN KEY (`id_tim_away`) REFERENCES `tim` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jadwal`
--

LOCK TABLES `jadwal` WRITE;
/*!40000 ALTER TABLE `jadwal` DISABLE KEYS */;
INSERT INTO `jadwal` VALUES (2,'2022-11-08','11:12:05',1,2,'2022-11-21 15:34:12'),(3,'2021-10-10','11:11:12',2,1,'2022-11-21 15:54:35');
/*!40000 ALTER TABLE `jadwal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tim`
--

DROP TABLE IF EXISTS `tim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tim` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_tim` varchar(45) NOT NULL,
  `logo_tim` varchar(200) NOT NULL,
  `tahun_berdiri` int(11) NOT NULL,
  `alamat_markas` varchar(100) NOT NULL,
  `kota_markas` varchar(45) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tim`
--

LOCK TABLES `tim` WRITE;
/*!40000 ALTER TABLE `tim` DISABLE KEYS */;
INSERT INTO `tim` VALUES (1,'Liverpool','liverpool.png',1892,'Inggris','London',NULL),(2,'Chelsea','chelse.png',1888,'Inggris','Britania',NULL);
/*!40000 ALTER TABLE `tim` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-22  5:15:35
