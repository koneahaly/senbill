-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: elec
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.18.04.1

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` decimal(5,2) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'yugesh','admin@admin.com','$2y$10$1MUxJhT103wTgHt11PKpN.bXf1HXGau7.tY.oOROycGIN8AnpgkEm',6.00,'sQVPd4LUThQ3KXlPDmhWErQFzKBYXxs6lJXgZfW5K34XY0yI7OkatQ361fWm',NULL,NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bills`
--

DROP TABLE IF EXISTS `bills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customerId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `month` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initial` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `units` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_method` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT 'CB',
  PRIMARY KEY (`id`),
  UNIQUE KEY `bills_customerid_month_year_unique` (`customerId`,`month`,`year`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bills`
--

LOCK TABLES `bills` WRITE;
/*!40000 ALTER TABLE `bills` DISABLE KEYS */;
INSERT INTO `bills` VALUES (1,'1000000001','January','2019',10,100,90,288,'paid','2019-06-03 13:28:48','2019-06-03 13:28:48','CB'),(2,'1000000001','February','2019',100,200,100,320,'paid','2019-06-03 13:31:58','2019-06-03 13:31:58','CB'),(3,'0943215674','November','2019',500,700,200,1200,'paid','2019-10-25 11:54:14','2019-10-25 11:54:14','CB'),(4,'0943215674','December','2019',1200,5000,3800,22800,'paid','2019-11-26 18:18:07','2019-11-26 18:18:07','OrangeMoney');
/*!40000 ALTER TABLE `bills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2017_11_02_153834_create_admins_table',1),(4,'2017_11_03_101212_add_id_adddr_field_to_users_table',1),(5,'2017_11_04_115812_create_bills_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('admin@admin.com','$2y$10$ejlXkN3ZLuh6w0HTORy.G.Jmq8jTwdc70zuRLGuqDLneT9fUlip4O','2019-10-22 18:54:41');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customerId` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'YUGESH KUMAR VERMA','admin@admin.com','$2y$10$NTwm0CSZ/K2163vC0bjlB.pRJ/TfeKkmQKlfMeWTXiVR.YJ3AZGyq','QA70PxZhgnorBzn2qVfC28V2HqubAIxCeNxXboLIeFrOhuTOqgkpOszCbYFN','2019-06-03 13:25:56','2019-06-03 13:25:56','1000000001','LIG 236, HOUSING BOARD UMDA BHILAI 3',NULL,NULL),(2,'aly','aly.kone@services.com','$2y$10$1MUxJhT103wTgHt11PKpN.bXf1HXGau7.tY.oOROycGIN8AnpgkEm','PLYjPy5A01jDYAtocAG1LgAK7BJrufxLo9sRLxcWr16y79Dmklccfs5D3llF','2019-10-24 15:40:56','2019-10-24 15:40:56','0943215674','4 Avenue du général leclerc',NULL,'0625325445'),(3,'yacine','yacinenana@gmail.com','adminadmin','zHVgL4HQq21PKMUunJCukAhahJDYLwFThU1EPz05EjmcnCle1LsnJkOMme9l','2019-10-24 17:22:28','2019-10-24 17:22:28','8765432190','4 Avenue du général leclerc',NULL,NULL),(4,'bintou','bintou@gmail.com','$2y$10$DWROugjlH78Mc6tj35.dzOi8vVqSH52YVkeAVQatDwxYl0B5zmf3O','EncA9OUYZjiMu5lkkTQdnK6gXXn0IlIbPyFcbeXzcnTSPI5jo8m8Qu1SxJAf','2019-10-26 06:25:47','2019-10-26 06:25:47','4578796754637576865','4 Avenue du général leclerc',NULL,NULL),(5,'malick','malick@gmail.com','$2y$10$jQHoKfg4kD52HTC4lJEdWuqB5W.SXQ8s4Kl./HUlJBOwli1JPLs0G','I41hefXxhkqZh4sb8r5bvB7VrbGkTM9pi02hHGoeVfuBVmK1EiXFbZT7CgTp','2019-10-26 06:31:04','2019-10-26 06:31:04','34657658787698970978','4 Avenue du général leclerc','2','0659594346'),(6,'ndiaye','nana@gmail.com','$2y$10$23Esm.Yt3IX94TwkxX3dFODbr4aJoC4HSyrRUzJdQllNagPwP6ZeS','N5wOkkjipwt5H9NJBmelsgWtIJ92YJn17SdxPZDSiwQLyONS1zBmiu4jWMfg','2019-12-09 13:47:45','2019-12-09 13:47:45','3571592584','4 Avenue du général leclerc','2','0660113717');
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

-- Dump completed on 2020-04-17 12:22:26
