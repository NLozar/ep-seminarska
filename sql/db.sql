drop database if exists bookstore;
drop database if exists onlinestore;
create database onlinestore;
use onlinestore;
-- MySQL dump 10.13  Distrib 5.5.38, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: onlinestore
-- ------------------------------------------------------
-- Server version	5.5.38-0ubuntu0.14.04.1

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
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
  `description` text COLLATE utf8_slovenian_ci NOT NULL,
  `price` float NOT NULL,
  active BOOLEAN NOT NULL DEFAULT TRUE, 
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--
CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    streetAddress VARCHAR (30),
    numberAddress INT,
    postNumber INT,
    typeOfUser VARCHAR(20) NOT NULL,
    active BOOLEAN NOT NULL DEFAULT TRUE,
    create_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE purchaseHistory (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    author varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
    title varchar(255) COLLATE utf8_slovenian_ci NOT NULL,
    stanje varchar(255) COLLATE utf8_slovenian_ci NOT NULL DEFAULT 'neobdelano',
    buyerId INT NOT NULL
);

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES 
(1,'Janez Novak','bas kitara','Delujoča, lepo ohranjena bas kitara',200,1),
(2,'Jan Kovač','fotoaparat Canon','fotoaparat Canon, model 200d',450,1);

/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

LOCK TABLES users WRITE;
INSERT INTO users (id, username, password, streetAddress, numberAddress, postNumber, typeOfUser) VALUES 
(1, 'admin', '$2y$10$pQ16KMLowRNAb4lJL.z4DuFfXK.CwWWl9NND.Pch2MX.U6F6.B3fW', NULL, NULL, NULL, 'A'),
(2, 'seller', '$2y$10$vp5c8pMZrfBE0PJxLbei.uMQKmkBj.i/2ifesQzS91r1L8EunA8vS', NULL, NULL, NULL, 'S'),
(3, 'buyer', '$2y$10$JsASP5MPO0eDbfoSsknvSOSnndsz4FQcD3CDFAIKNyPYr78a6nyhq', 'somestreet', '5', 1000, 'B');
UNLOCK TABLES;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-12 16:45:04
