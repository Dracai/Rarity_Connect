CREATE DATABASE  IF NOT EXISTS `rarityconnectdb` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `rarityconnectdb`;
-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: rarityconnectdb
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.17-MariaDB

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
-- Table structure for table `administrator`
--

DROP TABLE IF EXISTS `administrator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrator` (
  `idAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `passwordHash` varchar(60) NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`idAdmin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrator`
--

LOCK TABLES `administrator` WRITE;
/*!40000 ALTER TABLE `administrator` DISABLE KEYS */;
INSERT INTO `administrator` VALUES (1,'Jakub','Pawluczuk','jakub.pawluczuk@gmail.com','$2y$10$EjU7uYoP3nQRw5K8PcFl1..5ZUT7E7GddfcMIp3ih4BB5Y4MFvMlS','2021-04-26 20:57:55');
/*!40000 ALTER TABLE `administrator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `banned_users`
--

DROP TABLE IF EXISTS `banned_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banned_users` (
  `bannedID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`bannedID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banned_users`
--

LOCK TABLES `banned_users` WRITE;
/*!40000 ALTER TABLE `banned_users` DISABLE KEYS */;
INSERT INTO `banned_users` VALUES (1,'danny.roslyn@gmail.com');
/*!40000 ALTER TABLE `banned_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moderator`
--

DROP TABLE IF EXISTS `moderator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moderator` (
  `idMod` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `passwordHash` varchar(60) NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`idMod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moderator`
--

LOCK TABLES `moderator` WRITE;
/*!40000 ALTER TABLE `moderator` DISABLE KEYS */;
/*!40000 ALTER TABLE `moderator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `postID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) DEFAULT NULL,
  `modID` int(11) DEFAULT NULL,
  `adminID` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `publishedAT` datetime DEFAULT current_timestamp(),
  `authorName` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`postID`),
  KEY `fk_authorID_idUser_idx` (`userID`),
  KEY `fk_postMod_idx` (`modID`),
  KEY `fk_postAdmin_idx` (`adminID`),
  CONSTRAINT `fk_postAdmin` FOREIGN KEY (`adminID`) REFERENCES `administrator` (`idAdmin`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_postMod` FOREIGN KEY (`modID`) REFERENCES `moderator` (`idMod`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_postUser` FOREIGN KEY (`userID`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,NULL,NULL,1,'Welcome to Rarity Connect !!','This is the first post on this brand new forum !','2021-04-26 21:12:07','Jakub Pawluczuk'),(2,6,NULL,NULL,'Anyone know any hiking places ?','I have been looking for hiking place to go and to quiet down at the weekend. Anyone know of any places ?','2021-04-26 21:16:34','Martha Cambell'),(3,1,NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','2021-04-26 21:21:47','John Smith'),(4,NULL,NULL,1,'What is some things people want to see done to the forum ?','Please give us ideas for stuff to implement onto the forum !!','2021-04-26 21:24:41','Jakub Pawluczuk'),(6,9,NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.','2021-04-26 21:28:02','Jeremiaz Aleksander'),(7,1,NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat','2021-04-26 21:28:26','John Smith'),(8,1,NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat','2021-04-26 21:28:50','John Smith'),(9,1,NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat','2021-04-26 21:29:01','John Smith'),(10,1,NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat','2021-04-26 21:29:16','John Smith'),(12,1,NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat','2021-04-26 21:29:37','John Smith'),(14,10,NULL,NULL,'Gyms near East clare','Anyone know of any good gyms that have opened in East clare? ','2021-04-26 21:31:59','Jim Halpert'),(15,10,NULL,NULL,'COME TO MY BAKERY','NEWLY OPENED BAKERY, LOW PRICES','2021-04-26 21:33:01','Jim Halpert'),(16,5,NULL,NULL,'Looking for people to talk to !','I have found this amazing communtiy of people and was wondering if there is people who would like to talk or go out for coffee !!','2021-04-26 21:34:59','Arnie Delbert'),(17,1,NULL,NULL,'Hey amazing Community !!','I am very glad to be part of this community :D','2021-04-26 21:38:14','John Smith');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postcomment`
--

DROP TABLE IF EXISTS `postcomment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postcomment` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `postID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `modID` int(11) DEFAULT NULL,
  `adminID` int(11) DEFAULT NULL,
  `publishedAT` datetime DEFAULT current_timestamp(),
  `content` text DEFAULT NULL,
  `authorName` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`commentID`),
  KEY `fk_authorID_idUser_idx` (`userID`),
  KEY `fk_postID_postID_idx` (`postID`),
  KEY `fk_commentAdminID_idx` (`adminID`),
  KEY `fk_commentModID_idx` (`modID`),
  CONSTRAINT `fk_commentAdminID` FOREIGN KEY (`adminID`) REFERENCES `administrator` (`idAdmin`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_commentModID` FOREIGN KEY (`modID`) REFERENCES `moderator` (`idMod`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_commentPostID` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_commentUserID` FOREIGN KEY (`userID`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postcomment`
--

LOCK TABLES `postcomment` WRITE;
/*!40000 ALTER TABLE `postcomment` DISABLE KEYS */;
INSERT INTO `postcomment` VALUES (1,1,6,NULL,NULL,'2021-04-26 21:13:47','This is a great website :)','Martha Cambell'),(2,2,1,NULL,NULL,'2021-04-26 21:20:18','This is a nice place in East Clare to check out !','John Smith'),(3,1,1,NULL,NULL,'2021-04-26 21:20:49','You have a great community here, love to see it all grow :D','John Smith'),(4,3,2,NULL,NULL,'2021-04-26 21:22:11','This is just a spam post !!!','Alex Hill'),(5,4,2,NULL,NULL,'2021-04-26 21:25:11','How about a live chat?','Alex Hill'),(7,15,5,NULL,NULL,'2021-04-26 21:33:35','This is against the rules of the forum, REPORTED !!!','Arnie Delbert'),(8,1,2,NULL,NULL,'2021-04-26 21:43:08','I was here for the start !!!!','Alex Hill'),(10,1,NULL,NULL,1,'2021-04-26 22:04:42','This is my comment','Jakub Pawluczuk'),(11,17,2,NULL,NULL,'2021-04-26 22:10:35','This is my comment','Alex Hill');
/*!40000 ALTER TABLE `postcomment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reportedposts`
--

DROP TABLE IF EXISTS `reportedposts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reportedposts` (
  `reportedID` int(11) NOT NULL AUTO_INCREMENT,
  `postID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `modID` int(11) DEFAULT NULL,
  `adminID` int(11) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `published_at` datetime DEFAULT NULL,
  `authorName` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`reportedID`),
  KEY `fk_postID_postID_idx` (`postID`),
  CONSTRAINT `fk_postID_postID` FOREIGN KEY (`postID`) REFERENCES `post` (`postID`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reportedposts`
--

LOCK TABLES `reportedposts` WRITE;
/*!40000 ALTER TABLE `reportedposts` DISABLE KEYS */;
INSERT INTO `reportedposts` VALUES (2,12,1,NULL,NULL,'Lorem ipsum dolor sit amet, consectetur adipiscing elit','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat',NULL,'John Smith');
/*!40000 ALTER TABLE `reportedposts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `passwordHash` varchar(60) NOT NULL,
  `updated_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'John','Smith','john.smith@gmail.com','$2y$10$70kq/SrAylMEBkDoW1uZ5OS.Ze/g3KmKtx7ynWwjYcP04oz9P8dFi','2021-04-26 20:58:34'),(2,'Alex','Hill','alex.hill@gmail.com','$2y$10$I.tDkQ8jgZIH24KVDf3xf.3jNOhky8zqfL9QP122nbbwBLw2oD7rG','2021-04-26 20:59:03'),(3,'Mary','Poppins','mary.poppins@gmail.com','$2y$10$njHYLK/eXLSYMmsQ2uOd.elyaODEvRfLeQf/Gc3TW8QXBxF1fllvO','2021-04-26 21:01:07'),(5,'Arnie','Delbert','arnie.delbert@gmail.com','$2y$10$Q48qYfYqy1KhvC7JsnxOMOchqRgZIwVKr93BE04pZuEzvs24AaB76','2021-04-26 21:02:36'),(6,'Martha','Cambell','martha.cambell@gmail.com','$2y$10$TlKDCBOwHY2OzdRnR7y4eOQRxcZHrPswOBhvRX.TpWk7LnJgyA7vG','2021-04-26 21:03:05'),(8,'Elizabeth','Smith','elizabeth.smith@gmail.com','$2y$10$PPP4Ey/I7RcKkO37a60CcusGkEXa6S8VIzhFVAq5Xqjjbh0Br0McG','2021-04-26 21:04:41'),(9,'Jeremiaz','Aleksander','jeremiaz.aleksander@gmail.com','$2y$10$FyxWt.4JX/ZdvSykUaiv2O/hjvdXjLPil7jmZ9Q34ozRQlgtiYboq','2021-04-26 21:05:36'),(10,'Jim','Halpert','jim.halpert@gmail.com','$2y$10$ceJ3LmceumvGW3gdYUHhueT43DJnYHIMcdc4bFuueUPvtqXr/4eBq','2021-04-26 21:06:19'),(11,'Arthas','Menethil','arthas.menethil@gmail.com','$2y$10$51Eu3pU0F2HFVavlFkZod.FZefOwj2tVOSer/tzEOp284OxOZtUOK','2021-04-26 21:07:43'),(12,'Sirius','Black','sirius.black@gmail.com','$2y$10$NRssWNQ.WMDgk3NphuJkAelLcG66IdyLY6cl2TPNZvcPNb1OblxXW','2021-04-26 21:10:00'),(13,'Kuba','Bober','kuba.bober@gmail.com','$2y$10$SQqMoahL2Hh0E3wAwkAonuaUeGszYk9wi59MmsHbwvusJq6XpnqQ.','2021-04-26 22:21:35');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'rarityconnectdb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-26 22:30:32
