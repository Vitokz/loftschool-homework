-- MySQL dump 10.13  Distrib 5.7.29, for Win64 (x86_64)
--
-- Host: localhost    Database: mvcproject
-- ------------------------------------------------------
-- Server version	5.7.29-log

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
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `datetime` datetime NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'netu',
  `updated_at` mediumtext NOT NULL,
  `created_at` mediumtext NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (4,13,'про','dsaasd','2021-02-11 20:55:52','netu','2021-02-11 20:55:52','2021-02-11 20:55:52'),(5,13,'про','dsaasd','2021-02-11 20:56:05','netu','2021-02-11 20:56:05','2021-02-11 20:56:05'),(6,13,'про','nnnknlkn','2021-02-11 22:14:33','03568f858884d0596ad98e0c1545fed56a236547.jpg','2021-02-11 22:14:33','2021-02-11 22:14:33'),(7,13,'про','nnnknlkn','2021-02-11 22:14:54','be5fc3b68b752ca261e063fcaaef9500bc529be6.jpg','2021-02-11 22:14:54','2021-02-11 22:14:54'),(8,13,'про','nnnknlkn','2021-02-11 22:17:11','c328f85005bfdf68add404e2107f483940e610b9.jpg','2021-02-11 22:17:11','2021-02-11 22:17:11'),(9,13,'про','nnnknlkn','2021-02-11 22:24:19','netu','2021-02-11 22:24:19','2021-02-11 22:24:19'),(10,13,'про','gnfn','2021-02-11 22:26:06','3244de08292d75810efa93b1987adda29fa018ee.jpg','2021-02-11 22:26:06','2021-02-11 22:26:06'),(11,13,'про','gnfn','2021-02-11 22:26:56','3f9f0a7f1107a6d1ef1b88a247657f010604fdc6.jpg','2021-02-11 22:26:56','2021-02-11 22:26:56');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL DEFAULT '',
  `email` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  `date` datetime NOT NULL,
  `updated_at` mediumtext NOT NULL,
  `created_at` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (9,'проверка лофтскул','proverka.lofskul@mail.ru','123456','2021-02-11 18:27:14','2021-02-11 18:27:14','2021-02-11 18:27:14'),(11,'проверка лофтскул','proverka1.lofskul@mail.ru','123456','2021-02-11 18:29:44','2021-02-11 18:29:44','2021-02-11 18:29:44'),(12,'про','proverka2.lofskul@mail.ru','123456','2021-02-11 18:31:35','2021-02-11 18:31:35','2021-02-11 18:31:35'),(13,'про','lofskul@mail.ru','123456','2021-02-11 18:49:42','2021-02-11 18:49:42','2021-02-11 18:49:42'),(14,'123','12345@mail.ru','12345','2021-02-11 19:31:49','2021-02-11 19:31:49','2021-02-11 19:31:49'),(15,'ЕЩЕ','1234567@mail.ru','3241bc2788ab534ff0e996805e0854b4','2021-02-11 19:40:30','2021-02-11 19:40:30','2021-02-11 19:40:30'),(16,'11111','11111@admin.ru','4934949c58188ae35265f834781234a0','2021-02-13 01:36:31','2021-02-13 01:36:31','2021-02-12 23:49:29'),(17,'22222','22222@mail.ru','593b37b7bddb8a13b333acdaa0714fad','2021-02-13 01:39:35','2021-02-13 01:39:35','2021-02-13 00:00:14');
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

-- Dump completed on 2021-02-16 18:10:28
