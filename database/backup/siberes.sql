-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: localhost    Database: siberes
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_setorans`
--

DROP TABLE IF EXISTS `detail_setorans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_setorans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `setoran_id` bigint unsigned NOT NULL,
  `jenis_sampah_id` bigint unsigned DEFAULT NULL,
  `nama_jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat` decimal(8,2) NOT NULL,
  `harga` int unsigned NOT NULL,
  `subtotal` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `detail_setorans_setoran_id_foreign` (`setoran_id`),
  KEY `detail_setorans_jenis_sampah_id_foreign` (`jenis_sampah_id`),
  CONSTRAINT `detail_setorans_jenis_sampah_id_foreign` FOREIGN KEY (`jenis_sampah_id`) REFERENCES `jenis_sampahs` (`id`) ON DELETE SET NULL,
  CONSTRAINT `detail_setorans_setoran_id_foreign` FOREIGN KEY (`setoran_id`) REFERENCES `setorans` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_setorans`
--

LOCK TABLES `detail_setorans` WRITE;
/*!40000 ALTER TABLE `detail_setorans` DISABLE KEYS */;
INSERT INTO `detail_setorans` VALUES (1,1,NULL,'Plastik PET (botol)',3.50,3500,12250,'2026-11-12 12:57:06','2026-11-12 12:57:06'),(2,2,NULL,'Keras & Kardus',11.50,1800,20700,'2026-11-12 12:57:18','2026-11-12 12:57:18'),(3,3,NULL,'Logam & Besi',6.00,3000,18000,'2026-11-19 20:00:48','2026-11-19 20:00:48'),(4,4,NULL,'Plastik PET (botol)',9.00,3500,31500,'2026-11-19 20:01:02','2026-11-19 20:01:02');
/*!40000 ALTER TABLE `detail_setorans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jenis_sampahs`
--

DROP TABLE IF EXISTS `jenis_sampahs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jenis_sampahs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `harga` bigint unsigned NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `jenis_sampahs_nama_unique` (`nama`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jenis_sampahs`
--

LOCK TABLES `jenis_sampahs` WRITE;
/*!40000 ALTER TABLE `jenis_sampahs` DISABLE KEYS */;
INSERT INTO `jenis_sampahs` VALUES (12,'Karton (tersusun rapi dan diikat)','Kertas',2000,'Kertas berpori sudah tersusun rapi dan diikat','2026-11-19 20:22:08','2026-11-19 20:22:08'),(13,'Karton (tidak tersusun rapi)','Kertas',1900,'Kertas berpori tidak tersusun rapi','2026-11-19 20:22:08','2026-11-19 20:22:08'),(14,'Dupleks','Kertas',400,'Licin tidak berpori, sampul, sarang telur','2026-11-19 20:22:08','2026-11-19 20:22:08'),(15,'Buku','Kertas',600,'Buku bekas, kertas ubi, HVS warna, kertas bon. Kertas hancur','2026-11-19 20:22:08','2026-11-19 20:22:08'),(16,'HVS','Kertas',1800,'HVS warna putih dengan tinta hitam, double folio','2026-11-19 20:22:08','2026-11-19 20:22:08'),(17,'Koran Bagus','Kertas',5000,'Semua jenis koran yang masih bagus','2026-11-19 20:22:08','2026-11-19 20:22:08'),(18,'Seng','Logam',2000,'Semua jenis seng, kawat springbed','2026-11-19 20:22:08','2026-11-19 20:22:08'),(19,'Kabin','Logam',3000,'Campuran aluminium dan besi, contoh: kipas angin, rice cooker, radio, dandang, baja ringan, payung, kuali','2026-11-19 20:22:08','2026-11-19 20:22:08'),(20,'Kaleng','Logam',2000,'Kaleng yang tidak bisa diremukkan','2026-11-19 20:22:08','2026-11-19 20:22:08'),(21,'Besi Sam-Sam','Logam',2500,'Termasuk kawat kalender','2026-11-19 20:22:08','2026-11-19 20:22:08'),(22,'Besi Batang','Logam',3500,'Termasuk besi sepeda, troli bayi','2026-11-19 20:22:08','2026-11-19 20:22:08'),(23,'Besi Padu','Logam',4000,'Besi padat, kipas angin','2026-11-19 20:22:08','2026-11-19 20:22:08'),(24,'Aluminium ACC','Logam Mulia',25000,'Bisa diremukkan dan tidak berkarat','2026-11-19 20:22:08','2026-11-19 20:52:57'),(25,'Aluminium Panci','Logam Mulia',28000,'Termasuk panci dalam rice cooker','2026-11-19 20:22:08','2026-11-19 20:22:08'),(26,'Aluminium Mesin (bersih)','Logam Mulia',16000,'Aluminium mesin dalam keadaan bersih','2026-11-19 20:22:08','2026-11-19 20:22:08'),(27,'Aluminium Mesin (kotor)','Logam Mulia',5000,'Aluminium mesin dalam keadaan kotor','2026-11-19 20:22:08','2026-11-19 20:22:08'),(28,'Aluminium Priuk','Logam Mulia',15000,NULL,'2026-11-19 20:22:08','2026-11-19 20:22:08'),(29,'Kuningan','Logam Mulia',90000,NULL,'2026-11-19 20:22:08','2026-11-19 20:22:08'),(30,'Babet','Logam Mulia',10000,'Contoh: tungku kompor gas, dinamo','2026-11-19 20:22:08','2026-11-19 20:22:08'),(31,'Tembaga','Logam Mulia',180000,NULL,'2026-11-19 20:22:08','2026-11-19 20:22:08'),(32,'Timah','Logam Mulia',17000,NULL,'2026-11-19 20:22:08','2026-11-19 20:22:08'),(33,'Kaca Bening Pecah','Kaca',150,NULL,'2026-11-19 20:22:08','2026-11-19 20:22:08'),(34,'Kaca Botol Pecah','Kaca',150,NULL,'2026-11-19 20:22:08','2026-11-19 20:22:08'),(35,'Kaca Pecah Campur','Kaca',150,NULL,'2026-11-19 20:22:08','2026-11-19 20:22:08'),(36,'Kaca Datar Bening','Kaca',150,'Contoh: kaca meja, kaca nako','2026-11-19 20:22:08','2026-11-19 20:22:08'),(37,'Kaca Datar Hitam','Kaca',150,NULL,'2026-11-19 20:22:08','2026-11-19 20:22:08'),(38,'PP Cup Bening (Cup Super)','Plastik',6500,'Tanpa penutup dan label','2026-11-19 20:22:08','2026-11-19 20:22:08'),(39,'PP Cup Bening (Cup Kotor)','Plastik',3000,'Masih ada tutup dan label','2026-11-19 20:22:08','2026-11-19 20:22:08'),(40,'PP Cup Gelas Mambo','Plastik',2000,'Cup tanpa tutup, bersablon','2026-11-19 20:22:08','2026-11-19 20:22:08'),(41,'PP Cup Warna','Plastik',2000,'Montea, Ale-ale, dan sejenisnya','2026-11-19 20:22:08','2026-11-19 20:22:08'),(42,'PET Bening Biru Bersih (Mix)','Plastik',5000,'Campuran botol bening dan biru yang sudah bersih','2026-11-19 20:22:08','2026-11-19 20:22:08'),(43,'PET Warna','Plastik',800,'Mizone, Sprite, dan sejenisnya','2026-11-19 20:22:08','2026-11-19 20:22:08'),(44,'PET Kotor','Plastik',1500,'Masih bertutup dan berlabel','2026-11-19 20:22:08','2026-11-19 20:22:08'),(45,'PET Bening Biru Bersih Campur Warna','Plastik',2000,'Botol bening, biru, dan warna, semuanya sudah bersih','2026-11-19 20:22:08','2026-11-19 20:22:08'),(46,'PET Putih','Plastik',800,'Botol minuman susu putih','2026-11-19 20:22:08','2026-11-19 20:22:08'),(47,'PET Cong','Plastik',1000,'PET bening + BM + kecap/saus + PET berlabel','2026-11-19 20:22:08','2026-11-19 20:22:08'),(48,'PET Campur-campur','Plastik',500,'Campuran botol, cup, sachet, asoi, ember botol, ember warna','2026-11-19 20:22:08','2026-11-19 20:22:08'),(49,'PET Non Botol (Empek Botol)','Plastik',500,'Botol kecap, saus, yakult, dan sejenisnya','2026-11-19 20:22:08','2026-11-19 20:22:08'),(50,'HDPE Ember Warna','Plastik',2000,'Termasuk tutup botol','2026-11-19 20:22:08','2026-11-19 20:22:08'),(51,'HDPE Ember Hitam','Plastik',1000,'Termasuk cong, dispenser, ember merah marun','2026-11-19 20:22:08','2026-11-19 20:22:08'),(52,'HDPE Ember Botol','Plastik',3000,'Botol, tutup Aqua, botol oli, botol bedak, tube, dan sejenisnya','2026-11-19 20:22:08','2026-11-19 20:22:08'),(53,'HDPE Ember Bening','Plastik',3700,'Contoh: box makanan bening','2026-11-19 20:22:08','2026-11-19 20:22:08'),(54,'HDPE Daunan (Plastik HD/putih)','Plastik',3500,'Plastik gula yang tidak bening/keruh','2026-11-19 20:22:08','2026-11-19 20:22:08'),(55,'LDPE Daunan (Asoi Bersih)','Plastik',1000,'Kantong tipis semua warna, bersih, kering, dikoyak','2026-11-19 20:22:08','2026-11-19 20:22:08'),(56,'PP Bentukan (Pipet)','Plastik',2000,'Meja plastik, kursi plastik, pipet, piring plastik','2026-11-19 20:22:08','2026-11-19 20:22:08'),(57,'PP Tutup Galon','Plastik',6000,'Tutup galon air mineral/air isi ulang','2026-11-19 20:22:08','2026-11-19 20:22:08'),(58,'PP Kresek Bersih','Plastik',1000,'Bungkus baju, bersuara kresek saat diremas, bening, bersih, bubble hitam','2026-11-19 20:22:08','2026-11-19 20:22:08'),(59,'PP Kresek Kotor','Plastik',500,'Kotor, bertanah, berdebu, dan tidak dikoyak','2026-11-19 20:22:08','2026-11-19 20:22:08'),(60,'PP Tenun Karung Utuh','Plastik',1000,'Karung plastik utuh ukuran 5, 10, 30, 50 kg, dan seterusnya','2026-11-19 20:22:08','2026-11-19 20:22:08'),(61,'PP Tenun Karung Koyak','Plastik',500,'Potongan karung, karung koyak dan kotor bertanah','2026-11-19 20:22:08','2026-11-19 20:22:08'),(62,'PE Bening Bersih (Sam-sam)','Plastik',3500,'Bening, bersih, dicuci, kering, dikoyak, bubble putih, plastik bening','2026-11-19 20:22:08','2026-11-19 20:22:08'),(63,'PE Bening Kotor','Plastik',2000,'Kotor dan tidak dikoyak','2026-11-19 20:22:08','2026-11-19 20:22:08'),(64,'PE Warna/Sablon Bersih','Plastik',1000,'Trash bag, polibag dicuci, dikoyak dan kering, plastik bening bercap','2026-11-19 20:22:08','2026-11-19 20:22:08'),(65,'PE Warna/Sablon Kotor','Plastik',500,'Trash bag, polibag kotor, plastik bihun','2026-11-19 20:22:08','2026-11-19 20:22:08'),(66,'CD Komputer','Plastik',4000,NULL,'2026-11-19 20:22:08','2026-11-19 20:22:08'),(67,'SAN Galon Le Mineral/Cleo','Plastik',3000,NULL,'2026-11-19 20:22:08','2026-11-19 20:22:08'),(68,'PVC','Plastik',500,'Pipa PVC, paralon','2026-11-19 20:22:08','2026-11-19 20:22:08'),(69,'Empek Kerasan (Empek Cong)','Plastik',400,'Toples kue bening, rak dalaman kulkas, helm, tabung blender, bersuara nyaring. Koper termasuk empek','2026-11-19 20:22:08','2026-11-19 20:22:08'),(70,'Plastik Cong (Jenis Lain)','Plastik',500,'Plastik campur','2026-11-19 20:22:08','2026-11-19 20:22:08');
/*!40000 ALTER TABLE `jenis_sampahs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_11_11_020331_add_role_status_to_users_table',2),(5,'2026_11_11_020338_create_nasabahs_table',2),(6,'2026_11_11_024338_create_jenis_sampahs_table',3),(7,'2026_11_11_030804_create_setorans_table',4),(8,'2026_11_11_030822_create_detail_setorans_table',4),(9,'2026_11_12_034008_create_penjemputans_table',5),(10,'2026_11_12_192656_bersihkan_jenis_sampah_dobel',6),(11,'2026_11_13_030000_add_wajib_ganti_password_to_users_table',7),(12,'2026_11_20_000100_add_kategori_keterangan_to_jenis_sampahs_table',8),(13,'2026_11_20_000200_create_pengaturans_table',9);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nasabah`
--

DROP TABLE IF EXISTS `nasabah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `nasabah` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nasabah_kode_unique` (`kode`),
  KEY `nasabah_user_id_foreign` (`user_id`),
  CONSTRAINT `nasabah_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nasabah`
--

LOCK TABLES `nasabah` WRITE;
/*!40000 ALTER TABLE `nasabah` DISABLE KEYS */;
INSERT INTO `nasabah` VALUES (1,2,'NSB-001','jalan bunga melati','12345678','2026-11-11 21:26:53','2026-11-11 21:32:05'),(2,3,'NSB-002','Jalan Pasar 1 Gg.Mekar Mulyo','085183056329','2026-11-19 18:46:30','2026-11-19 18:50:43');
/*!40000 ALTER TABLE `nasabah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengaturans`
--

DROP TABLE IF EXISTS `pengaturans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengaturans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `kunci` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nilai` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pengaturans_kunci_unique` (`kunci`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengaturans`
--

LOCK TABLES `pengaturans` WRITE;
/*!40000 ALTER TABLE `pengaturans` DISABLE KEYS */;
/*!40000 ALTER TABLE `pengaturans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penjemputans`
--

DROP TABLE IF EXISTS `penjemputans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `penjemputans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nasabah_id` bigint unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `jenis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `penjemputans_nasabah_id_foreign` (`nasabah_id`),
  CONSTRAINT `penjemputans_nasabah_id_foreign` FOREIGN KEY (`nasabah_id`) REFERENCES `nasabah` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penjemputans`
--

LOCK TABLES `penjemputans` WRITE;
/*!40000 ALTER TABLE `penjemputans` DISABLE KEYS */;
INSERT INTO `penjemputans` VALUES (1,1,'2026-11-22','Botol kaca, Kaleng aluminium, Keras & Kardus, Plastik PET (botol)',NULL,'selesai','2026-11-12 12:55:29','2026-11-12 12:56:17'),(2,2,'2026-11-22','Botol kaca, Kaleng aluminium, Keras & Kardus, Logam & Besi, Plastik PET (botol)',NULL,'selesai','2026-11-19 18:49:57','2026-11-19 18:55:41');
/*!40000 ALTER TABLE `penjemputans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('6epDef4jLU9J6jUfSAFCqsyaZQ7YeUwnFDTi9voZ',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.147.0 Chrome/150.0.7871.250 Electron/43.8.9 Safari/537.36','eyJfdG9rZW4iOiIyS0p1MVpOeUJmUEUySVRQbU0ybE53RjY0VGRHRW9ZWWljWFBnWEtHIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=',1795147135),('HIejPGBV60L6U2Z8ALQg8cmxmM5eR7GkC0tJrvFK',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/157.0.0.0 Safari/537.36 Edg/157.0.0.0','eyJfdG9rZW4iOiJHcmxJVnZyVjF1UnJIMWs5NVdJQ2dmTVBHakdQdGlIVFRqUjE1dm1CIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvMTI3LjAuMC4xOjgwMDAiLCJyb3V0ZSI6ImhvbWUifX0=',1795147154);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setorans`
--

DROP TABLE IF EXISTS `setorans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `setorans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nasabah_id` bigint unsigned NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `setorans_nasabah_id_foreign` (`nasabah_id`),
  CONSTRAINT `setorans_nasabah_id_foreign` FOREIGN KEY (`nasabah_id`) REFERENCES `nasabah` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setorans`
--

LOCK TABLES `setorans` WRITE;
/*!40000 ALTER TABLE `setorans` DISABLE KEYS */;
INSERT INTO `setorans` VALUES (1,1,'2026-11-12','2026-11-12 12:57:06','2026-11-12 12:57:06'),(2,1,'2026-11-12','2026-11-12 12:57:18','2026-11-12 12:57:18'),(3,2,'2026-11-22','2026-11-19 20:00:48','2026-11-19 20:00:48'),(4,2,'2026-11-22','2026-11-19 20:01:02','2026-11-19 20:01:02');
/*!40000 ALTER TABLE `setorans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nasabah',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'menunggu',
  `wajib_ganti_password` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin Pengelola','admin@siberes.test',NULL,'$2y$12$wA3UjLJV67gfVJd8HHUCwenehWJd.mgcPFfGK7GdK3otaREmCGrOK',NULL,'2026-11-10 19:15:51','2026-11-10 19:15:51','admin','aktif',0),(2,'wawa','wawa@test.com',NULL,'$2y$12$EpHdHoShC5zs39ClNjbma.f9N7u/VoVjv/g8RdP2hCYhNJpURyIqm',NULL,'2026-11-11 21:26:53','2026-11-12 12:54:47','nasabah','aktif',0),(3,'Rara Triya Amanda','raratriyaamandaa@gmail.com',NULL,'$2y$12$3mZ1TmLGSG.I23Rvy99sGu7hzWiI6WibfbkeXNamVhrZ4peJZZkT2',NULL,'2026-11-19 18:46:30','2026-11-19 18:50:43','nasabah','aktif',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-20 11:01:17
