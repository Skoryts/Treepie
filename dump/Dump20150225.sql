CREATE DATABASE  IF NOT EXISTS `treepie` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `treepie`;
-- MySQL dump 10.13  Distrib 5.5.41, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: treepie
-- ------------------------------------------------------
-- Server version	5.5.41-0ubuntu0.14.04.1

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
-- Table structure for table `t_article`
--

DROP TABLE IF EXISTS `t_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `categoryId` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `body` longtext,
  `published` char(1) DEFAULT '0' COMMENT '1 - Published, 0 - Not Published',
  `draft` char(1) DEFAULT '1' COMMENT '1 - Draft, 0 - Not Draft',
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_article`
--

LOCK TABLES `t_article` WRITE;
/*!40000 ALTER TABLE `t_article` DISABLE KEYS */;
INSERT INTO `t_article` VALUES (1,1,1,'level 1','level1','test','1','0','2015-02-23 21:22:20','2015-02-23 21:34:44'),(2,1,2,'level 2','level2','test','1','0','2015-02-23 21:22:45','2015-02-23 21:34:40'),(3,1,3,'level 3','level3','test','1','0','2015-02-23 21:23:20','2015-02-23 21:34:35'),(4,1,4,'level 4','level4','test','1','0','2015-02-23 21:23:36','2015-02-24 22:58:22'),(5,1,1,'test','testaa','test','0','0','2015-02-24 22:20:34','2015-02-24 23:00:13');
/*!40000 ALTER TABLE `t_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_auth_assignment`
--

DROP TABLE IF EXISTS `t_auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `t_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `t_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_auth_assignment`
--

LOCK TABLES `t_auth_assignment` WRITE;
/*!40000 ALTER TABLE `t_auth_assignment` DISABLE KEYS */;
INSERT INTO `t_auth_assignment` VALUES ('admin','1',1424641523);
/*!40000 ALTER TABLE `t_auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_auth_item`
--

DROP TABLE IF EXISTS `t_auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `t_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `t_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_auth_item`
--

LOCK TABLES `t_auth_item` WRITE;
/*!40000 ALTER TABLE `t_auth_item` DISABLE KEYS */;
INSERT INTO `t_auth_item` VALUES ('admin',1,NULL,NULL,NULL,1424641523,1424641523),('createArticle',2,NULL,NULL,NULL,1424641522,1424641522),('deleteArticle',2,NULL,NULL,NULL,1424641523,1424641523),('deleteOwnArticle',2,NULL,'isOwner',NULL,1424641523,1424641523),('guest',1,NULL,NULL,NULL,1424641523,1424641523),('updateArticle',2,NULL,NULL,NULL,1424641523,1424641523),('updateOwnArticle',2,NULL,'isOwner',NULL,1424641523,1424641523),('user',1,NULL,NULL,NULL,1424641523,1424641523),('viewArticle',2,NULL,NULL,NULL,1424641522,1424641522);
/*!40000 ALTER TABLE `t_auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_auth_item_child`
--

DROP TABLE IF EXISTS `t_auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `t_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `t_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `t_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_auth_item_child`
--

LOCK TABLES `t_auth_item_child` WRITE;
/*!40000 ALTER TABLE `t_auth_item_child` DISABLE KEYS */;
INSERT INTO `t_auth_item_child` VALUES ('admin','deleteArticle'),('user','guest'),('admin','updateArticle'),('admin','user'),('guest','viewArticle');
/*!40000 ALTER TABLE `t_auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_auth_rule`
--

DROP TABLE IF EXISTS `t_auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_auth_rule`
--

LOCK TABLES `t_auth_rule` WRITE;
/*!40000 ALTER TABLE `t_auth_rule` DISABLE KEYS */;
INSERT INTO `t_auth_rule` VALUES ('isOwner','O:18:\"app\\rbac\\OwnerRule\":3:{s:4:\"name\";s:7:\"isOwner\";s:9:\"createdAt\";i:1424641522;s:9:\"updatedAt\";i:1424641522;}',1424641522,1424641522);
/*!40000 ALTER TABLE `t_auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_category`
--

DROP TABLE IF EXISTS `t_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `parentCategoryId` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_category`
--

LOCK TABLES `t_category` WRITE;
/*!40000 ALTER TABLE `t_category` DISABLE KEYS */;
INSERT INTO `t_category` VALUES (1,1,NULL,'Level 1','level1','2015-02-23 21:11:30','2015-02-23 21:11:30'),(2,1,1,'Level 2','level2','2015-02-23 21:11:43','2015-02-23 21:14:17'),(3,1,2,'Level 3','level3','2015-02-23 21:11:55','2015-02-23 21:14:28'),(4,1,3,'Level 4','level4','2015-02-23 21:14:45','2015-02-23 21:14:45');
/*!40000 ALTER TABLE `t_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_comment`
--

DROP TABLE IF EXISTS `t_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `parentCommentId` int(11) DEFAULT NULL,
  `typeId` int(11) DEFAULT NULL,
  `relationTypeId` int(11) DEFAULT NULL,
  `body` text,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_comment`
--

LOCK TABLES `t_comment` WRITE;
/*!40000 ALTER TABLE `t_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_file`
--

DROP TABLE IF EXISTS `t_file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `relationTypeId` int(11) DEFAULT NULL,
  `relationId` int(11) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `name` char(32) DEFAULT NULL,
  `originalName` varchar(255) DEFAULT NULL,
  `extension` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_file`
--

LOCK TABLES `t_file` WRITE;
/*!40000 ALTER TABLE `t_file` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_like`
--

DROP TABLE IF EXISTS `t_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `relationTypeId` int(11) DEFAULT NULL,
  `relationId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_like`
--

LOCK TABLES `t_like` WRITE;
/*!40000 ALTER TABLE `t_like` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_like_number`
--

DROP TABLE IF EXISTS `t_like_number`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_like_number` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `relationTypeId` int(11) DEFAULT NULL,
  `relationId` int(11) DEFAULT NULL,
  `number` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_like_number`
--

LOCK TABLES `t_like_number` WRITE;
/*!40000 ALTER TABLE `t_like_number` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_like_number` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_migration`
--

DROP TABLE IF EXISTS `t_migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_migration`
--

LOCK TABLES `t_migration` WRITE;
/*!40000 ALTER TABLE `t_migration` DISABLE KEYS */;
INSERT INTO `t_migration` VALUES ('m000000_000000_base',1424639784),('m140506_102106_rbac_init',1424639815);
/*!40000 ALTER TABLE `t_migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_profile`
--

DROP TABLE IF EXISTS `t_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_profile` (
  `userId` int(11) NOT NULL,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_profile`
--

LOCK TABLES `t_profile` WRITE;
/*!40000 ALTER TABLE `t_profile` DISABLE KEYS */;
INSERT INTO `t_profile` VALUES (1,NULL,NULL,'2015-02-19 19:04:12','2015-02-19 19:04:12');
/*!40000 ALTER TABLE `t_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_relation_type`
--

DROP TABLE IF EXISTS `t_relation_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_relation_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_relation_type`
--

LOCK TABLES `t_relation_type` WRITE;
/*!40000 ALTER TABLE `t_relation_type` DISABLE KEYS */;
INSERT INTO `t_relation_type` VALUES (1,'app\\models\\Article');
/*!40000 ALTER TABLE `t_relation_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_tag`
--

DROP TABLE IF EXISTS `t_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) DEFAULT NULL,
  `typeId` int(11) DEFAULT NULL,
  `relationTypeId` int(11) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_tag`
--

LOCK TABLES `t_tag` WRITE;
/*!40000 ALTER TABLE `t_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `t_user`
--

DROP TABLE IF EXISTS `t_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `t_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `passwordHash` varchar(60) DEFAULT NULL,
  `authKey` varchar(32) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT NULL,
  `updatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `t_user`
--

LOCK TABLES `t_user` WRITE;
/*!40000 ALTER TABLE `t_user` DISABLE KEYS */;
INSERT INTO `t_user` VALUES (1,'admin@admin.admin','admin','$2y$13$jXUdSTaUoKpQMWL9xVza4u7lT4TqUgwf1qr6.7uYRHozT9juRmGfC','70THFHCdcb-e-8pyzkMDklM-oC9nq5J_','2015-02-19 19:04:12','2015-02-19 19:04:12');
/*!40000 ALTER TABLE `t_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-02-25  1:44:03
