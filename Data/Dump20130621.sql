CREATE DATABASE  IF NOT EXISTS `long_cms` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `long_cms`;
-- MySQL dump 10.13  Distrib 5.5.16, for Win32 (x86)
--
-- Host: 127.0.0.1    Database: long_cms
-- ------------------------------------------------------
-- Server version	5.5.8-log

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
-- Table structure for table `long_access`
--

DROP TABLE IF EXISTS `long_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `long_access` (
  `role_id` smallint(6) unsigned NOT NULL,
  `node_id` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) NOT NULL,
  `pid` smallint(6) NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  KEY `groupId` (`role_id`),
  KEY `nodeId` (`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `long_access`
--

LOCK TABLES `long_access` WRITE;
/*!40000 ALTER TABLE `long_access` DISABLE KEYS */;
INSERT INTO `long_access` VALUES (2,1,1,0,NULL),(2,40,2,1,NULL),(2,30,2,1,NULL),(3,1,1,0,NULL),(2,69,2,1,NULL),(2,50,3,40,NULL),(3,50,3,40,NULL),(1,50,3,40,NULL),(3,7,2,1,NULL),(3,39,3,30,NULL),(2,39,3,30,NULL),(2,49,3,30,NULL),(4,1,1,0,NULL),(4,2,2,1,NULL),(4,3,2,1,NULL),(4,4,2,1,NULL),(4,5,2,1,NULL),(4,6,2,1,NULL),(4,7,2,1,NULL),(4,11,2,1,NULL),(5,25,1,0,NULL),(5,51,2,25,NULL),(1,1,1,0,NULL),(1,39,3,30,NULL),(1,69,2,1,NULL),(1,30,2,1,NULL),(1,40,2,1,NULL),(1,49,3,30,NULL),(3,69,2,1,NULL),(3,30,2,1,NULL),(3,40,2,1,NULL),(1,37,3,30,NULL),(1,36,3,30,NULL),(1,35,3,30,NULL),(1,34,3,30,NULL),(1,33,3,30,NULL),(1,32,3,30,NULL),(1,31,3,30,NULL),(2,32,3,30,NULL),(2,31,3,30,NULL),(7,1,1,0,NULL),(7,30,2,1,NULL),(7,40,2,1,NULL),(7,69,2,1,NULL),(7,50,3,40,NULL),(7,39,3,30,NULL),(7,49,3,30,NULL);
/*!40000 ALTER TABLE `long_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `long_menu`
--

DROP TABLE IF EXISTS `long_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `long_menu` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `pid` smallint(6) unsigned NOT NULL DEFAULT '0',
  `model` char(20) NOT NULL DEFAULT '',
  `action` char(20) NOT NULL DEFAULT '',
  `data` char(50) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `name` varchar(50) NOT NULL DEFAULT '',
  `remark` varchar(255) NOT NULL DEFAULT '',
  `listorder` smallint(6) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `parentid` (`pid`),
  KEY `model` (`model`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `long_menu`
--

LOCK TABLES `long_menu` WRITE;
/*!40000 ALTER TABLE `long_menu` DISABLE KEYS */;
INSERT INTO `long_menu` VALUES (1,0,'Index','index','',1,1,0,'首页','',0),(2,1,'Index','index','',1,1,0,'网站信息','',0),(3,0,'Access','index','',1,1,0,'会员管理','',0),(4,3,'Access','menu','',1,1,0,'后台目录管理','',0),(5,3,'Access','index','',1,1,0,'用户管理','',0),(6,3,'Access','role','',1,1,0,'角色管理','',0),(7,3,'Access','node','',1,1,0,'节点管理','',0);
/*!40000 ALTER TABLE `long_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `long_node`
--

DROP TABLE IF EXISTS `long_node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `long_node` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `remark` varchar(255) DEFAULT NULL,
  `sort` smallint(6) unsigned DEFAULT NULL,
  `pid` smallint(6) unsigned NOT NULL,
  `level` tinyint(1) unsigned NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `group_id` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `level` (`level`),
  KEY `pid` (`pid`),
  KEY `status` (`status`),
  KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `long_node`
--

LOCK TABLES `long_node` WRITE;
/*!40000 ALTER TABLE `long_node` DISABLE KEYS */;
INSERT INTO `long_node` VALUES (49,'read','查看',1,'',NULL,30,3,0,0),(40,'Index','默认模块',1,'',1,1,2,0,0),(39,'index','列表',1,'',NULL,30,3,0,0),(37,'resume','恢复',1,'',NULL,30,3,0,0),(36,'forbid','禁用',1,'',NULL,30,3,0,0),(35,'foreverdelete','删除',1,'',NULL,30,3,0,0),(34,'update','更新',1,'',NULL,30,3,0,0),(33,'edit','编辑',1,'',NULL,30,3,0,0),(32,'insert','写入',1,'',NULL,30,3,0,0),(31,'add','新增',1,'',NULL,30,3,0,0),(30,'Public','公共模块',1,'',2,1,2,0,0),(69,'Form','数据管理',1,'',1,1,2,0,2),(7,'User','后台用户',1,'',4,1,2,0,2),(6,'Role','角色管理',1,'',3,1,2,0,2),(2,'Node','节点管理',1,'',2,1,2,0,2),(1,'App','Rbac后台管理',1,'',NULL,0,1,0,0),(50,'main','空白首页',1,'',NULL,40,3,0,0);
/*!40000 ALTER TABLE `long_node` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `long_role`
--

DROP TABLE IF EXISTS `long_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `long_role` (
  `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pid` smallint(6) DEFAULT NULL,
  `status` tinyint(1) unsigned DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `ename` varchar(5) DEFAULT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parentId` (`pid`),
  KEY `ename` (`ename`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `long_role`
--

LOCK TABLES `long_role` WRITE;
/*!40000 ALTER TABLE `long_role` DISABLE KEYS */;
INSERT INTO `long_role` VALUES (1,'领导组',0,1,'','',1208784792,1254325558),(2,'员工组',0,1,'','',1215496283,1254325566),(7,'演示组',0,1,'',NULL,1254325787,0);
/*!40000 ALTER TABLE `long_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `long_role_user`
--

DROP TABLE IF EXISTS `long_role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `long_role_user` (
  `role_id` mediumint(9) unsigned DEFAULT NULL,
  `user_id` char(32) DEFAULT NULL,
  KEY `group_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `long_role_user`
--

LOCK TABLES `long_role_user` WRITE;
/*!40000 ALTER TABLE `long_role_user` DISABLE KEYS */;
INSERT INTO `long_role_user` VALUES (1,'1'),(7,'1'),(7,'1'),(7,'1'),(7,'1'),(7,'1'),(7,'1'),(7,'1'),(7,'1'),(7,'1'),(7,'1'),(7,'1'),(7,'1'),(7,'1'),(7,'1'),(7,'1'),(7,'1'),(7,'1'),(7,'1'),(7,'1');
/*!40000 ALTER TABLE `long_role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `long_user`
--

DROP TABLE IF EXISTS `long_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `long_user` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `account` varchar(64) NOT NULL,
  `password` char(32) NOT NULL,
  `last_login_time` int(11) unsigned DEFAULT '0',
  `last_login_ip` varchar(40) DEFAULT NULL,
  `login_count` mediumint(8) unsigned DEFAULT '0',
  `verify` varchar(32) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `remark` varchar(255) NOT NULL,
  `create_time` int(11) unsigned NOT NULL,
  `update_time` int(11) unsigned NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `account` (`account`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `long_user`
--

LOCK TABLES `long_user` WRITE;
/*!40000 ALTER TABLE `long_user` DISABLE KEYS */;
INSERT INTO `long_user` VALUES (1,'admin','f0ed75d1d7aa5be432d0919de1b761f7',1371803726,'127.0.0.1',15,NULL,'','',0,0,1),(37,'test','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','741886920@qq.com','',1371798907,0,1),(38,'test2','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','test2','test2',1371799581,0,1),(39,'test3','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','test3','test3',1371799636,0,1),(40,'test4','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','test4','test4',1371799691,0,1),(41,'test5','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','test5','test5',1371799751,0,1),(42,'test6','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','test6','test6',1371799773,0,1),(43,'test7','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','test7','test7',1371799948,0,1),(44,'test8','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','test8','test8',1371800086,0,1),(45,'test9','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','test9','test9',1371800480,0,1),(46,'test10','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','test10','test10',1371800560,0,1),(47,'test11','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','test11','test11',1371800733,0,1),(48,'test12','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','test12','test12',1371800970,0,1),(49,'test13','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','test13','test13',1371801002,0,1),(50,'test14','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','test14','test14',1371801024,0,1),(51,'test15','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','test15','test15',1371801178,0,1),(52,'test16','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','test16','test16',1371802072,0,1),(53,'test17','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','test17','test17',1371802179,0,1),(54,'test18','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','test18','test18',1371802212,0,1),(55,'test19','a31bea9d0945800009a55d9b05db8acd',0,NULL,0,'0','test19','test19',1371802254,0,1);
/*!40000 ALTER TABLE `long_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-06-21 17:20:42
