-- MySQL dump 10.13  Distrib 5.7.16, for Win64 (x86_64)
--
-- Host: localhost    Database: quest
-- ------------------------------------------------------
-- Server version	5.7.16

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
-- Table structure for table `TQs`
--

DROP TABLE IF EXISTS `TQs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TQs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTeams` int(11) NOT NULL,
  `idQuest` int(11) NOT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TQs`
--

LOCK TABLES `TQs` WRITE;
/*!40000 ALTER TABLE `TQs` DISABLE KEYS */;
/*!40000 ALTER TABLE `TQs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UTs`
--

DROP TABLE IF EXISTS `UTs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UTs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idUsers` int(11) NOT NULL,
  `idTeams` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UTs`
--

LOCK TABLES `UTs` WRITE;
/*!40000 ALTER TABLE `UTs` DISABLE KEYS */;
/*!40000 ALTER TABLE `UTs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `executeTasks`
--

DROP TABLE IF EXISTS `executeTasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `executeTasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTasks` int(11) NOT NULL,
  `idTQ` int(11) NOT NULL,
  `coordX` double DEFAULT NULL,
  `coordY` double DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `executeTasks`
--

LOCK TABLES `executeTasks` WRITE;
/*!40000 ALTER TABLE `executeTasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `executeTasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proofs`
--

DROP TABLE IF EXISTS `proofs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proofs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idExecuteTasks` int(11) NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proofs`
--

LOCK TABLES `proofs` WRITE;
/*!40000 ALTER TABLE `proofs` DISABLE KEYS */;
/*!40000 ALTER TABLE `proofs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quests`
--

DROP TABLE IF EXISTS `quests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quests`
--

LOCK TABLES `quests` WRITE;
/*!40000 ALTER TABLE `quests` DISABLE KEYS */;
INSERT INTO `quests` VALUES (1,'Викторина','Один или несколько вопросов, разгадав которые, участники получают подсказку.','2017-12-03','12:00:00'),(2,'Детективная история','В вашем офисе произошло чудовищное ограбление...','2017-11-22','10:00:00'),(3,'Викторина','Один или несколько вопросов, разгадав которые, участники получают подсказку.','2017-12-03','12:00:00'),(4,'Детективная история','В вашем офисе произошло чудовищное ограбление...','2017-11-22','10:00:00'),(5,'Викторина','Один или несколько вопросов, разгадав которые, участники получают подсказку.','2017-12-03','12:00:00'),(6,'Детективная история','В вашем офисе произошло чудовищное ограбление...','2017-11-22','10:00:00');
/*!40000 ALTER TABLE `quests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social_providers`
--

DROP TABLE IF EXISTS `social_providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social_providers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `provider_id` int(11) NOT NULL,
  `provider` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social_providers`
--

LOCK TABLES `social_providers` WRITE;
/*!40000 ALTER TABLE `social_providers` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idQuest` int(11) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `QR` int(11) NOT NULL,
  `dependency` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `nickname` varchar(60) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) DEFAULT NULL,
  `social_id` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Екатерина Волкова',NULL,NULL,'female','volkova5005@gmail.com',1,'YYUqJgDg5ljaCdmITBxaEDIJEJXO3l4E5lAVDKZPjERNJ24HT1HkagN5CLLR','105259858962447148727','2017-11-16 19:59:22','2017-11-16 19:59:22','https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg');
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

-- Dump completed on 2017-11-19 23:51:44
