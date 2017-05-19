-- MySQL dump 10.16  Distrib 10.1.19-MariaDB, for osx10.6 (i386)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.1.19-MariaDB

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
-- Table structure for table `student`
--
CREATE DATABASE IF NOT EXISTS proj3;
USE proj3;
DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `umid` int(8) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `project_title` varchar(100) DEFAULT NULL,
  `email_address` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `time_slot_id` int(8) DEFAULT NULL,
  PRIMARY KEY (`umid`),
  KEY `time_slot_id` (`time_slot_id`),
  CONSTRAINT `student_ibfk_1` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slot` (`time_slot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES (12341232,'sdaf','dfs','sdf','jk@fml.com','123-123-1234',2),(12345678,'Justin','Hoyt','cis 435','justinhoyt24@gmail.com','734-624-4986',6),(51244153,'Kendrick','Lamar','TPABF','klamar@gmail.com','123-432-5342',1),(93823407,'test','TEST','TEST','TEST@TEST.COM','999-999-9999',2),(93823452,'test','TEST','TEST','TEST@TEST.COM','999-999-9999',2),(98255555,'test','TEST','TEST3','TEST@TEST.COM','999-999-9999',5),(99999999,'brandon','wendl','poker','bwendl@gmail.com','312-421-5432',2);
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `time_slot`
--

DROP TABLE IF EXISTS `time_slot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `time_slot` (
  `time_slot_id` int(8) NOT NULL AUTO_INCREMENT,
  `start_time` datetime DEFAULT NULL,
  PRIMARY KEY (`time_slot_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `time_slot`
--

LOCK TABLES `time_slot` WRITE;
/*!40000 ALTER TABLE `time_slot` DISABLE KEYS */;
INSERT INTO `time_slot` VALUES (1,'2016-11-28 12:00:00'),(2,'2016-11-28 13:00:00'),(3,'2016-11-28 14:00:00'),(4,'2016-11-28 15:00:00'),(5,'2016-11-28 16:00:00'),(6,'2016-11-28 17:00:00');
/*!40000 ALTER TABLE `time_slot` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-30 20:53:28
