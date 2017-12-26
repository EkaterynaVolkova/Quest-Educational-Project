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
-- Table structure for table `Quests`
--

DROP TABLE IF EXISTS `Quests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Quests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `fullDescription` text,
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Quests`
--

LOCK TABLES `Quests` WRITE;
/*!40000 ALTER TABLE `Quests` DISABLE KEYS */;
INSERT INTO `Quests` VALUES (1,'Логический','Отвечать на вопросы','2017-12-12','12:00:00','fullDescription',0),(2,'Аркада','Бегать и выполнять задания','2017-12-31','23:59:00','full Бегать и выполнять задания',1),(3,'Детектив','Выполнять задания на дедукцию','2018-01-01','08:00:00','full Выполнять задания на дедукцию',2),(4,'Аркада2','Бегать и проходить задания','2017-12-11','06:00:00','ха-ха',0);
/*!40000 ALTER TABLE `Quests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Tasks`
--

DROP TABLE IF EXISTS `Tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idQuest` int(11) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `duration` time DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `QR` varchar(50) DEFAULT NULL,
  `dependency` varchar(20) DEFAULT NULL,
  `orderBy` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Tasks`
--

LOCK TABLES `Tasks` WRITE;
/*!40000 ALTER TABLE `Tasks` DISABLE KEYS */;
INSERT INTO `Tasks` VALUES (1,1,'Задание 2','Задание 2 для квеста 1',NULL,NULL,'iatzKTab',NULL,1),(2,1,'Задание 1','Задание 1 для квеста 1',NULL,NULL,'7EiSEsy3',NULL,2),(3,2,'Задание 2','Задание 2 для квеста 2',NULL,NULL,'AfDzyEbA',NULL,1),(4,2,'Задание 1','Задание 1 для квеста 2',NULL,NULL,'Tr2dsEh4',NULL,2);
/*!40000 ALTER TABLE `Tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Teams`
--

DROP TABLE IF EXISTS `Teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Teams`
--

LOCK TABLES `Teams` WRITE;
/*!40000 ALTER TABLE `Teams` DISABLE KEYS */;
INSERT INTO `Teams` VALUES (1,'red'),(2,'blue'),(5,'green');
/*!40000 ALTER TABLE `Teams` ENABLE KEYS */;
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
  `idUserTeamQuest` int(11) NOT NULL,
  `coordX` double DEFAULT NULL,
  `coordY` double DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `executeTasks`
--

LOCK TABLES `executeTasks` WRITE;
/*!40000 ALTER TABLE `executeTasks` DISABLE KEYS */;
INSERT INTO `executeTasks` VALUES (1,3,1,NULL,NULL,NULL,1),(2,4,1,NULL,NULL,NULL,0);
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
-- Table structure for table `userTeamQuests`
--

DROP TABLE IF EXISTS `userTeamQuests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userTeamQuests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idQuest` int(11) DEFAULT NULL,
  `idTeam` int(11) DEFAULT NULL,
  `idUser` int(11) DEFAULT NULL,
  `statusQuest` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userTeamQuests`
--

LOCK TABLES `userTeamQuests` WRITE;
/*!40000 ALTER TABLE `userTeamQuests` DISABLE KEYS */;
INSERT INTO `userTeamQuests` VALUES (1,2,5,5,0),(2,3,5,5,0);
/*!40000 ALTER TABLE `userTeamQuests` ENABLE KEYS */;
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
  `role` int(11) DEFAULT '0',
  `remember_token` varchar(100) DEFAULT NULL,
  `social_id` varchar(100) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Екатерина Волкова',NULL,NULL,'female','volkova5005@gmail.com',0,'wENvkVOAEFhg6a2LEhhELkiMFiNLQL1WvC6YbYM1UZWaI1rbMr0JP7824TT3','105259858962447148727','2017-11-16 19:59:22','2017-11-16 19:59:22','https://lh3.googleusercontent.com/-XdUIqdMkCWA/AAAAAAAAAAI/AAAAAAAAAAA/4252rscbv5M/photo.jpg',NULL),(5,'Kate','Kate',0,'f','Kate@gmail.com',1,'eYIOEX3z1lmJAexIzhi0vMm0u3branplBNW5ww6j6FeLOj02FGx49KAHUYm9',NULL,'2017-11-19 20:42:42','2017-11-19 20:42:42',NULL,'$2y$10$YZ7eeofGGJMcEoL6adveHuqQN/obsOSs3rZVYQ6mD0GyqDKKr8Boy');
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

-- Dump completed on 2017-12-26 13:57:47
