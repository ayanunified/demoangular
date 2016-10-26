-- MySQL dump 10.13  Distrib 5.5.50, for debian-linux-gnu (i686)
--
-- Host: psnv1.cu24xwoiwoat.us-east-1.rds.amazonaws.com    Database: deployment
-- ------------------------------------------------------
-- Server version	5.6.27-log

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
-- Current Database: `deployment`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `deployment` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `deployment`;

--
-- Table structure for table `aboutus`
--

DROP TABLE IF EXISTS `aboutus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aboutus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `about_content` text COLLATE utf8_unicode_ci NOT NULL,
  `trust_content` text COLLATE utf8_unicode_ci,
  `respect_content` text COLLATE utf8_unicode_ci,
  `passion_content` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aboutus`
--

LOCK TABLES `aboutus` WRITE;
/*!40000 ALTER TABLE `aboutus` DISABLE KEYS */;
INSERT INTO `aboutus` VALUES (1,'<p style=\"text-align:center\">When patients don&rsquo;t pay their medical bills, or have been caught trying to solicit drugs, they typically switch to a different practice that doesn&rsquo;t know their history, and the cycle begins again. If medical clinics were able to share information about non-compliant patients, they would be able to avoid the problem in the first-place rather than trying to solve it after the fact with little chance of success.</p>\r\n\r\n<p style=\"text-align:center\">We founded PSN based on the idea that doctors deserve to protect themselves too, the same way that patients have the right to review and select doctors based on their online reputation.</p>\r\n\r\n<div class=\"nice-meet\" style=\"box-sizing: border-box; outline: none !important; margin: 0px auto 100px; color: rgb(138, 138, 140); font-family: Lato, sans-serif; font-size: 16px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 22px; orphans: auto; text-align: center; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(243, 244, 248);\">\r\n<h3 style=\"color:rgb(74, 74, 74); font-style:normal\">Nice to meet you</h3>\r\n\r\n<p>After managing and owning a dental clinic for several years, we&rsquo;ve seen the kind of damage that a few patients can cause to the practice&rsquo;s finances and morale. We know how frustrating it is to have your employees spending their valuable time wrestling with patients who fail to pay for services they have already received. We also know that this problem is widespread across the industry. Patients repeat the same damaging behavior at new unsuspecting clinics that have no way to know that the patient has been repeatedly causing problems.</p>\r\n\r\n<p>Information is power, and therefore we knew a shared network like PSN for medical providers to report and research undesirable patients would be the best way to combat the problem, to save you time and money.</p>\r\n</div>\r\n','You can trust that PSN will keep your personal information secure and private.','We respect HIPPA standards and seek to maintain the privacy of your patients’ medical history, while ensuring you have the ability to protect your practice at the same time.','At PSN, we believe our mission to improve the communication between medical practitioners will help you to save money while also providing the best care possible.','2016-07-08 03:48:51','2016-08-01 04:55:10',NULL);
/*!40000 ALTER TABLE `aboutus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accesstokens`
--

DROP TABLE IF EXISTS `accesstokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accesstokens` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `access_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `generate_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `customers_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=661 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accesstokens`
--

LOCK TABLES `accesstokens` WRITE;
/*!40000 ALTER TABLE `accesstokens` DISABLE KEYS */;
INSERT INTO `accesstokens` VALUES (1,'60481467977986','2016-07-08 06:09:46',6,NULL,'2016-07-08 06:09:46',NULL),(2,'26651467979207','2016-07-08 06:30:07',7,NULL,NULL,NULL),(3,'18471467989566','2016-07-08 09:22:46',8,NULL,NULL,NULL),(4,'34571467990489','2016-07-08 09:38:09',9,NULL,NULL,NULL),(5,'14071468212015','2016-07-10 23:10:15',6,NULL,NULL,NULL),(6,'90281468216309','2016-07-11 00:21:49',6,NULL,NULL,NULL),(7,'81591468245835','2016-07-11 08:33:55',6,NULL,'2016-07-11 08:33:55',NULL),(8,'67771468299271','2016-07-11 23:24:31',6,NULL,NULL,NULL),(9,'16551468314025','2016-07-12 03:30:25',6,NULL,'2016-07-12 03:30:25',NULL),(10,'14111468330463','2016-07-12 08:04:23',6,NULL,NULL,NULL),(11,'46961468331452','2016-07-12 14:10:34',6,NULL,'2016-07-12 08:40:34','2016-07-12 08:40:34'),(15,'37331468400130','2016-07-13 03:25:30',6,NULL,NULL,NULL),(16,'35391468410724','2016-07-13 06:22:04',6,NULL,'2016-07-13 06:22:04',NULL),(17,'18741468415301','2016-07-13 07:38:21',6,NULL,NULL,NULL),(18,'58961468416205','2016-07-13 07:53:25',13,NULL,NULL,NULL),(19,'17071468589337','2016-07-15 07:58:57',13,NULL,'2016-07-15 07:58:57',NULL),(20,'40681468561099','2016-07-15 00:08:19',6,NULL,'2016-07-15 00:08:19',NULL),(21,'59801469178721','2016-07-22 03:42:01',6,NULL,'2016-07-22 03:42:01',NULL),(22,'50301468922859','2016-07-19 04:37:39',42,NULL,NULL,NULL),(23,'90971468923275','2016-07-19 04:44:35',42,NULL,NULL,NULL),(24,'52831468924968','2016-07-19 05:12:48',42,NULL,NULL,NULL),(25,'65941468925730','2016-07-19 05:25:30',42,NULL,NULL,NULL),(26,'45751468926739','2016-07-19 05:42:19',42,NULL,NULL,NULL),(27,'99951468927202','2016-07-19 05:50:02',42,NULL,NULL,NULL),(28,'41661468927364','2016-07-19 05:52:44',42,NULL,NULL,NULL),(29,'31481468927401','2016-07-19 05:53:21',42,NULL,NULL,NULL),(30,'62981468927758','2016-07-19 05:59:18',42,NULL,NULL,NULL),(31,'11231468927984','2016-07-19 06:03:04',42,NULL,NULL,NULL),(32,'53251468928201','2016-07-19 06:06:41',42,NULL,NULL,NULL),(33,'80061468929024','2016-07-19 06:20:24',42,NULL,NULL,NULL),(34,'38741468929108','2016-07-19 06:21:48',42,NULL,NULL,NULL),(35,'32721468930535','2016-07-19 06:45:35',42,NULL,NULL,NULL),(36,'34921468931136','2016-07-19 06:55:36',42,NULL,NULL,NULL),(37,'70441468931162','2016-07-19 06:56:02',42,NULL,NULL,NULL),(38,'47041468931251','2016-07-19 06:57:31',42,NULL,NULL,NULL),(39,'59631468931509','2016-07-19 07:01:49',42,NULL,NULL,NULL),(40,'69851468931688','2016-07-19 07:04:48',42,NULL,NULL,NULL),(41,'61141468932115','2016-07-19 07:11:55',42,NULL,NULL,NULL),(42,'38411468932202','2016-07-19 07:13:22',42,NULL,NULL,NULL),(43,'55531468932650','2016-07-19 07:20:50',42,NULL,NULL,NULL),(44,'45841468992326','2016-07-19 23:55:26',42,NULL,NULL,NULL),(45,'22721468992455','2016-07-19 23:57:35',42,NULL,NULL,NULL),(46,'32351468998384','2016-07-20 01:36:24',42,NULL,NULL,NULL),(47,'86501469000962','2016-07-20 02:19:22',42,NULL,NULL,NULL),(48,'51681469001134','2016-07-20 02:22:14',42,NULL,NULL,NULL),(49,'97511469004018','2016-07-20 03:10:18',42,NULL,NULL,NULL),(50,'39901469004032','2016-07-20 03:10:32',42,NULL,NULL,NULL),(51,'76471469004137','2016-07-20 03:12:17',42,NULL,NULL,NULL),(52,'71331469004202','2016-07-20 03:13:22',42,NULL,NULL,NULL),(53,'65341469005312','2016-07-20 03:31:52',42,NULL,NULL,NULL),(54,'48631469005417','2016-07-20 03:33:37',42,NULL,NULL,NULL),(55,'28031469005619','2016-07-20 03:36:59',42,NULL,NULL,NULL),(56,'39131469005874','2016-07-20 03:41:14',42,NULL,NULL,NULL),(57,'46021469006144','2016-07-20 03:45:44',42,NULL,NULL,NULL),(58,'19611469168922','2016-07-22 00:58:42',42,NULL,NULL,NULL),(59,'82651469169110','2016-07-22 01:01:50',42,NULL,NULL,NULL),(60,'51871469169123','2016-07-22 01:02:03',42,NULL,NULL,NULL),(61,'22621469169304','2016-07-22 01:05:04',42,NULL,NULL,NULL),(62,'54711469169736','2016-07-22 01:12:16',42,NULL,NULL,NULL),(63,'51221469169756','2016-07-22 01:12:36',42,NULL,NULL,NULL),(64,'40441469170025','2016-07-22 01:17:05',42,NULL,NULL,NULL),(65,'32001469170270','2016-07-22 01:21:10',42,NULL,NULL,NULL),(66,'13231469170439','2016-07-22 01:23:59',42,NULL,NULL,NULL),(67,'86551469170462','2016-07-22 01:24:22',42,NULL,NULL,NULL),(68,'62881469170532','2016-07-22 01:25:32',42,NULL,NULL,NULL),(69,'73411469170700','2016-07-22 01:28:20',42,NULL,NULL,NULL),(70,'68071469170735','2016-07-22 01:28:55',42,NULL,NULL,NULL),(71,'21201469170742','2016-07-22 01:29:02',42,NULL,NULL,NULL),(72,'41731469170831','2016-07-22 01:30:31',42,NULL,NULL,NULL),(73,'19611469170868','2016-07-22 01:31:08',42,NULL,NULL,NULL),(74,'44251469172776','2016-07-22 02:02:56',42,NULL,NULL,NULL),(75,'62691469172796','2016-07-22 02:03:16',42,NULL,NULL,NULL),(76,'49221469173264','2016-07-22 02:11:04',42,NULL,NULL,NULL),(77,'38681469173286','2016-07-22 02:11:26',42,NULL,NULL,NULL),(78,'27831469176761','2016-07-22 03:09:21',42,NULL,'2016-07-22 03:09:21',NULL),(79,'62011469174870','2016-07-22 02:37:50',42,NULL,NULL,NULL),(80,'76791469177881','2016-07-22 03:28:01',42,NULL,NULL,NULL),(81,'73291469178036','2016-07-22 03:30:36',42,NULL,NULL,NULL),(82,'75311469178074','2016-07-22 03:31:14',42,NULL,NULL,NULL),(83,'86021469178182','2016-07-22 03:33:02',42,NULL,NULL,NULL),(84,'85371469178260','2016-07-22 03:34:20',42,NULL,NULL,NULL),(85,'25351469178278','2016-07-22 03:34:38',42,NULL,NULL,NULL),(86,'43961469178341','2016-07-22 03:35:41',42,NULL,NULL,NULL),(87,'26511469178381','2016-07-22 03:36:21',42,NULL,NULL,NULL),(88,'22311469178589','2016-07-22 03:39:49',42,NULL,NULL,NULL),(89,'76531469178614','2016-07-22 03:40:14',42,NULL,NULL,NULL),(90,'86711469183097','2016-07-22 04:54:57',42,NULL,'2016-07-22 04:54:57',NULL),(91,'30151469181603','2016-07-22 04:30:03',42,NULL,NULL,NULL),(92,'80961469181964','2016-07-22 04:36:04',42,NULL,NULL,NULL),(93,'10571469182580','2016-07-22 04:46:20',43,NULL,NULL,NULL),(94,'70731469187115','2016-07-22 06:01:55',42,NULL,'2016-07-22 06:01:55',NULL),(95,'54711469184337','2016-07-22 05:15:37',43,NULL,NULL,NULL),(96,'58141469184378','2016-07-22 05:16:18',43,NULL,NULL,NULL),(97,'20621469184388','2016-07-22 05:16:28',42,NULL,NULL,NULL),(98,'62781469184531','2016-07-22 05:18:51',42,NULL,NULL,NULL),(99,'30991469184604','2016-07-22 05:20:04',42,NULL,NULL,NULL),(100,'90401469184658','2016-07-22 05:20:58',42,NULL,NULL,NULL),(101,'20191469185016','2016-07-22 05:26:56',42,NULL,NULL,NULL),(102,'33801469188794','2016-07-22 06:29:54',42,NULL,'2016-07-22 06:29:54',NULL),(103,'45341469190804','2016-07-22 07:03:24',42,NULL,'2016-07-22 07:03:24',NULL),(104,'73801469188851','2016-07-22 06:30:51',42,NULL,NULL,NULL),(105,'62691469189090','2016-07-22 06:34:50',42,NULL,NULL,NULL),(106,'26611469189198','2016-07-22 06:36:38',42,NULL,NULL,NULL),(107,'34721469189293','2016-07-22 06:38:13',42,NULL,NULL,NULL),(108,'41561469193851','2016-07-22 07:54:11',42,NULL,'2016-07-22 07:54:11',NULL),(109,'28451469190796','2016-07-22 07:03:16',42,NULL,NULL,NULL),(110,'13451469194925','2016-07-22 08:12:05',42,NULL,'2016-07-22 08:12:05',NULL),(111,'14441469191353','2016-07-22 07:12:33',42,NULL,NULL,NULL),(112,'69311469196920','2016-07-22 08:45:20',42,NULL,'2016-07-22 08:45:20',NULL),(113,'42491469195489','2016-07-22 08:21:29',42,NULL,NULL,NULL),(114,'34101469195593','2016-07-22 08:23:13',42,NULL,NULL,NULL),(115,'52471469200094','2016-07-22 09:38:14',42,NULL,'2016-07-22 09:38:14',NULL),(116,'74271469200136','2016-07-22 09:38:56',42,NULL,NULL,NULL),(117,'70461469200933','2016-07-22 09:52:13',42,NULL,NULL,NULL),(118,'29151469243410','2016-07-22 21:40:10',43,NULL,NULL,NULL),(119,'89031469243618','2016-07-22 21:43:38',43,NULL,NULL,NULL),(120,'17141469288820','2016-07-23 10:17:00',43,NULL,NULL,NULL),(121,'89161469427221','2016-07-25 00:43:41',42,NULL,NULL,NULL),(122,'13901469433360','2016-07-25 02:26:00',1,NULL,NULL,NULL),(123,'60131469437857','2016-07-25 03:40:57',1,NULL,NULL,NULL),(124,'26401469439481','2016-07-25 04:08:01',1,NULL,NULL,NULL),(125,'65511469443230','2016-07-25 05:10:30',1,NULL,'2016-07-25 05:10:30',NULL),(135,'60271469449206','2016-07-25 06:50:06',1,NULL,'2016-07-25 06:50:06',NULL),(137,'26281469449167','2016-07-25 06:49:27',4,NULL,NULL,NULL),(138,'48401469449443','2016-07-25 06:54:03',1,NULL,'2016-07-25 06:54:03',NULL),(139,'50931469449544','2016-07-25 06:55:44',4,NULL,'2016-07-25 06:55:44',NULL),(140,'89131469449599','2016-07-25 06:56:39',1,NULL,'2016-07-25 06:56:39',NULL),(141,'14641469449771','2016-07-25 06:59:31',1,NULL,NULL,NULL),(142,'34951469450108','2016-07-25 07:05:08',1,NULL,NULL,NULL),(143,'99571469450367','2016-07-25 07:09:27',1,NULL,NULL,NULL),(147,'99151469450689','2016-07-25 07:14:49',1,NULL,NULL,NULL),(148,'19291469451153','2016-07-25 07:22:33',1,NULL,NULL,NULL),(149,'18571469452687','2016-07-25 07:48:07',1,NULL,NULL,NULL),(150,'21481469452801','2016-07-25 07:50:01',1,NULL,NULL,NULL),(151,'62741469453355','2016-07-25 07:59:15',1,NULL,NULL,NULL),(152,'21641469453509','2016-07-25 08:01:49',1,NULL,NULL,NULL),(153,'34651469453741','2016-07-25 08:05:41',1,NULL,NULL,NULL),(154,'22261469453834','2016-07-25 08:07:14',1,NULL,NULL,NULL),(155,'17381469453921','2016-07-25 08:08:41',1,NULL,NULL,NULL),(156,'98601469454006','2016-07-25 08:10:06',1,NULL,NULL,NULL),(160,'53121469455281','2016-07-25 08:31:21',6,NULL,NULL,NULL),(164,'28331469459775','2016-07-25 09:46:15',7,NULL,'2016-07-25 09:46:15',NULL),(165,'83451469459806','2016-07-25 09:46:46',1,NULL,'2016-07-25 09:46:46',NULL),(167,'86841469459979','2016-07-25 09:49:39',1,NULL,'2016-07-25 09:49:39',NULL),(170,'62441469460219','2016-07-25 09:53:39',1,NULL,'2016-07-25 09:53:39',NULL),(172,'63431469460441','2016-07-25 09:57:21',9,NULL,'2016-07-25 09:57:21',NULL),(175,'64791469460458','2016-07-25 09:57:38',1,NULL,'2016-07-25 09:57:38',NULL),(177,'97461469462183','2016-07-25 10:26:23',1,NULL,'2016-07-25 10:26:23',NULL),(178,'56871469462530','2016-07-25 10:32:10',1,NULL,'2016-07-25 10:32:10',NULL),(179,'24931469462824','2016-07-25 10:37:04',10,NULL,NULL,NULL),(180,'26151469462858','2016-07-25 10:37:38',10,NULL,NULL,NULL),(181,'85731469463205','2016-07-25 10:43:25',10,NULL,NULL,NULL),(182,'12321469463789','2016-07-25 10:53:09',12,NULL,NULL,NULL),(183,'19991469464189','2016-07-25 10:59:49',12,NULL,NULL,NULL),(184,'41161469464860','2016-07-25 11:11:00',12,NULL,NULL,NULL),(185,'76181469468979','2016-07-25 12:19:39',11,NULL,NULL,NULL),(186,'61521469508503','2016-07-25 23:18:23',10,NULL,NULL,NULL),(197,'90681469536853','2016-07-26 07:10:53',11,NULL,NULL,NULL),(203,'60881469601122','2016-07-27 01:02:02',14,NULL,NULL,NULL),(204,'50411469618334','2016-07-27 05:48:54',14,NULL,NULL,NULL),(205,'42371469618466','2016-07-27 05:51:06',14,NULL,NULL,NULL),(210,'61471469628966','2016-07-27 08:46:06',14,NULL,NULL,NULL),(211,'52411469631052','2016-07-27 09:20:52',14,NULL,NULL,NULL),(217,'73221469710693','2016-07-28 07:28:13',14,NULL,NULL,NULL),(218,'36141469713853','2016-07-28 08:20:53',14,NULL,NULL,NULL),(219,'26661469766523','2016-07-28 22:58:43',14,NULL,NULL,NULL),(222,'68951469775123','2016-07-29 01:22:03',14,NULL,NULL,NULL),(227,'87421469787928','2016-07-29 04:55:28',14,NULL,NULL,NULL),(230,'58351469791670','2016-07-29 05:57:50',19,NULL,NULL,NULL),(232,'79411469792588','2016-07-29 06:13:08',19,NULL,NULL,NULL),(233,'64501469793398','2016-07-29 06:26:38',19,NULL,NULL,NULL),(234,'84361469793515','2016-07-29 06:28:35',19,NULL,NULL,NULL),(235,'33771469793559','2016-07-29 06:29:19',19,NULL,NULL,NULL),(236,'11441469793618','2016-07-29 06:30:18',19,NULL,NULL,NULL),(239,'66321469795798','2016-07-29 07:06:38',19,NULL,NULL,NULL),(253,'64201470056911','2016-08-01 07:38:31',19,NULL,NULL,NULL),(259,'53541470082167','2016-08-01 14:39:27',2,NULL,NULL,NULL),(261,'44251470115780','2016-08-01 23:59:40',1,NULL,NULL,NULL),(266,'86111470133976','2016-08-02 05:02:56',1,NULL,NULL,NULL),(267,'78491470134302','2016-08-02 05:08:22',1,NULL,NULL,NULL),(268,'26711470137829','2016-08-02 06:07:09',1,NULL,NULL,NULL),(269,'16751470140804','2016-08-02 06:56:44',2,NULL,NULL,NULL),(271,'45091470141355','2016-08-02 07:05:55',1,NULL,NULL,NULL),(274,'48791470143434','2016-08-02 07:40:34',3,NULL,NULL,NULL),(287,'66921470172222','2016-08-02 15:40:22',3,NULL,NULL,NULL),(288,'10971470172222','2016-08-02 15:40:22',3,NULL,NULL,NULL),(290,'39761470172244','2016-08-02 15:40:44',3,NULL,NULL,NULL),(292,'13541470181076','2016-08-02 18:07:56',7,NULL,NULL,NULL),(293,'92761470198783','2016-08-02 23:03:03',1,NULL,NULL,NULL),(294,'19131470200357','2016-08-02 23:29:17',1,NULL,NULL,NULL),(298,'28501470215851','2016-08-03 03:47:31',1,NULL,NULL,NULL),(300,'10081470221446','2016-08-03 05:20:46',1,NULL,NULL,NULL),(304,'55241470225389','2016-08-03 06:26:29',20,NULL,NULL,NULL),(312,'40251470233280','2016-08-03 08:38:00',1,NULL,NULL,NULL),(320,'40981470289586','2016-08-04 00:16:26',1,NULL,NULL,NULL),(334,'38011470320895','2016-08-04 08:58:15',20,NULL,NULL,NULL),(336,'64481470320985','2016-08-04 08:59:45',20,NULL,NULL,NULL),(338,'47191470374070','2016-08-04 23:44:30',37,NULL,NULL,NULL),(341,'38951470381496','2016-08-05 01:48:16',37,NULL,NULL,NULL),(345,'93731470402068','2016-08-05 07:31:08',37,NULL,NULL,NULL),(346,'36771470403321','2016-08-05 07:52:01',33,NULL,NULL,NULL),(347,'83301470405725','2016-08-05 08:32:05',1,NULL,NULL,NULL),(349,'40101470642056','2016-08-08 02:10:56',54,NULL,NULL,NULL),(350,'47691470646431','2016-08-08 03:23:51',54,NULL,NULL,NULL),(351,'63161470646448','2016-08-08 03:24:08',54,NULL,NULL,NULL),(354,'47631470650177','2016-08-08 04:26:17',54,NULL,NULL,NULL),(355,'68921470650861','2016-08-08 04:37:41',54,NULL,NULL,NULL),(356,'24151470664339','2016-08-08 08:22:19',54,NULL,NULL,NULL),(357,'86871470667074','2016-08-08 09:07:54',54,NULL,NULL,NULL),(358,'71271470718353','2016-08-08 23:22:33',54,NULL,NULL,NULL),(360,'52591470729481','2016-08-09 02:28:01',54,NULL,NULL,NULL),(361,'51701470733436','2016-08-09 03:33:56',54,NULL,NULL,NULL),(362,'60831470735317','2016-08-09 04:05:17',54,NULL,NULL,NULL),(363,'36711470736535','2016-08-09 04:25:35',54,NULL,NULL,NULL),(366,'28671470737596','2016-08-09 04:43:16',54,NULL,NULL,NULL),(368,'85581470738204','2016-08-09 04:53:24',54,NULL,NULL,NULL),(369,'16101470738910','2016-08-09 05:05:10',54,NULL,NULL,NULL),(376,'85061470746556','2016-08-09 07:12:36',54,NULL,NULL,NULL),(377,'56051470746879','2016-08-09 07:17:59',54,NULL,NULL,NULL),(381,'78001470752172','2016-08-09 08:46:12',54,NULL,NULL,NULL),(383,'10261470753680','2016-08-09 09:11:20',54,NULL,NULL,NULL),(402,'79701470815296','2016-08-10 02:18:16',54,NULL,NULL,NULL),(404,'96831470820908','2016-08-10 03:51:48',66,NULL,NULL,NULL),(411,'20801470823208','2016-08-10 04:30:08',66,NULL,NULL,NULL),(423,'88071470832004','2016-08-10 06:56:44',65,NULL,NULL,NULL),(447,'83751470839394','2016-08-10 08:59:54',65,NULL,NULL,NULL),(449,'46821470840929','2016-08-10 09:25:29',67,NULL,NULL,NULL),(513,'60551470906762','2016-08-11 03:42:42',72,NULL,NULL,NULL),(528,'21631470912093','2016-08-11 05:11:33',65,NULL,NULL,NULL),(529,'82381470912128','2016-08-11 05:12:08',72,NULL,NULL,NULL),(532,'29241470914338','2016-08-11 05:48:58',65,NULL,NULL,NULL),(537,'92061470915952','2016-08-11 06:15:52',65,NULL,NULL,NULL),(540,'77871470916910','2016-08-11 06:31:50',77,NULL,NULL,NULL),(541,'59321470917302','2016-08-11 06:38:22',67,NULL,NULL,NULL),(545,'64051470919198','2016-08-11 07:09:58',67,NULL,NULL,NULL),(552,'66531470922458','2016-08-11 08:04:18',79,NULL,NULL,NULL),(554,'80471470923398','2016-08-11 08:19:58',67,NULL,NULL,NULL),(559,'29221470924755','2016-08-11 08:42:35',77,NULL,NULL,NULL),(568,'97421470978241','2016-08-11 23:34:01',67,NULL,NULL,NULL),(578,'12141470984389','2016-08-12 01:16:29',77,NULL,NULL,NULL),(579,'85961470984541','2016-08-12 01:19:01',72,NULL,NULL,NULL),(583,'97101470986507','2016-08-12 01:51:47',77,NULL,NULL,NULL),(587,'26271470988811','2016-08-12 02:30:11',86,NULL,NULL,NULL),(588,'21451470992632','2016-08-12 03:33:52',65,NULL,NULL,NULL),(589,'67751470992826','2016-08-12 03:37:06',86,NULL,NULL,NULL),(590,'14811470992829','2016-08-12 03:37:09',89,NULL,NULL,NULL),(591,'62371470992997','2016-08-12 03:39:57',67,NULL,NULL,NULL),(592,'13911470993110','2016-08-12 03:41:50',86,NULL,NULL,NULL),(598,'16811470995743','2016-08-12 04:25:43',92,NULL,NULL,NULL),(599,'91901470999321','2016-08-12 05:25:21',3,NULL,NULL,NULL),(600,'38571470999322','2016-08-12 05:25:22',3,NULL,NULL,NULL),(602,'72381470999323','2016-08-12 05:25:23',3,NULL,NULL,NULL),(606,'83961471001873','2016-08-12 06:07:53',4,NULL,NULL,NULL),(607,'29391471002848','2016-08-12 06:24:08',4,NULL,NULL,NULL),(611,'62441471007299','2016-08-12 07:38:19',4,NULL,NULL,NULL),(619,'21761471011494','2016-08-12 08:48:14',6,NULL,NULL,NULL),(620,'25331471011630','2016-08-12 08:50:30',4,NULL,NULL,NULL),(625,'12851471012553','2016-08-12 09:05:53',4,NULL,NULL,NULL),(631,'83271471014692','2016-08-12 09:41:32',3,NULL,NULL,NULL),(636,'87491471018519','2016-08-12 10:45:19',13,NULL,NULL,NULL),(639,'58311471428801','2016-08-17 10:13:21',14,NULL,NULL,NULL),(640,'99241471428802','2016-08-17 10:13:22',14,NULL,NULL,NULL),(652,'90471471439703','2016-08-17 13:15:03',14,NULL,NULL,NULL),(653,'62161471526932','2016-08-18 13:28:52',4,NULL,NULL,NULL),(655,'42311471529615','2016-08-18 14:13:35',4,NULL,NULL,NULL),(656,'58521471531341','2016-08-18 14:42:21',4,NULL,NULL,NULL),(657,'87441471531466','2016-08-18 14:44:26',4,NULL,NULL,NULL),(658,'94751471531636','2016-08-18 14:47:16',4,NULL,NULL,NULL),(659,'20671471532079','2016-08-18 14:54:39',4,NULL,NULL,NULL);
/*!40000 ALTER TABLE `accesstokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `behaviorlists`
--

DROP TABLE IF EXISTS `behaviorlists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `behaviorlists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `behaviorlists`
--

LOCK TABLES `behaviorlists` WRITE;
/*!40000 ALTER TABLE `behaviorlists` DISABLE KEYS */;
INSERT INTO `behaviorlists` VALUES (1,'Bad','2016-06-29 05:02:18','2016-08-05 04:18:46',NULL),(2,'Smell','2016-06-29 05:02:28','2016-06-29 05:02:28',NULL),(3,'No Show','2016-08-02 07:36:00','2016-08-02 07:36:00',NULL),(5,'AA','2016-08-12 04:22:28','2016-08-12 04:22:28',NULL),(6,'BB','2016-08-12 04:22:33','2016-08-12 04:22:33',NULL),(7,'CC','2016-08-12 04:22:38','2016-08-12 04:22:38',NULL),(8,'DD','2016-08-12 04:22:42','2016-08-12 04:22:42',NULL),(9,'New Test Behavior','2016-08-12 04:22:48','2016-08-12 09:44:31',NULL),(10,'FF','2016-08-12 04:22:56','2016-08-12 04:22:56',NULL),(11,'GG','2016-08-12 04:23:00','2016-08-12 04:23:00',NULL),(12,'HH','2016-08-12 04:23:04','2016-08-12 04:23:04',NULL),(13,'II','2016-08-12 04:23:19','2016-08-12 04:23:19',NULL);
/*!40000 ALTER TABLE `behaviorlists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `businesses`
--

DROP TABLE IF EXISTS `businesses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `businesses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `businesses`
--

LOCK TABLES `businesses` WRITE;
/*!40000 ALTER TABLE `businesses` DISABLE KEYS */;
INSERT INTO `businesses` VALUES (1,'Dental','','2016-06-28 07:48:20','2016-06-28 07:48:20',NULL),(2,'Medical','','2016-06-30 03:57:08','2016-08-01 19:28:24',NULL);
/*!40000 ALTER TABLE `businesses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contactuspage`
--

DROP TABLE IF EXISTS `contactuspage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contactuspage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contactuspage`
--

LOCK TABLES `contactuspage` WRITE;
/*!40000 ALTER TABLE `contactuspage` DISABLE KEYS */;
INSERT INTO `contactuspage` VALUES (3,'Search Patient','<p>Find outstanding issues at other clinics.</p>\r\n','2016-08-01 03:14:36','2016-08-01 04:17:09',NULL),(4,'Report Patient','<p>List a problematic patient with PSN.List a problematic patient with PSN.List a problematic patient with PSN.List a problematic patient with&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n','2016-08-01 03:15:32','2016-08-12 06:11:18',NULL);
/*!40000 ALTER TABLE `contactuspage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `creditcards`
--

DROP TABLE IF EXISTS `creditcards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `creditcards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `card_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expire_month` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expire_year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `security_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creditcardtypes_id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `creditcards`
--

LOCK TABLES `creditcards` WRITE;
/*!40000 ALTER TABLE `creditcards` DISABLE KEYS */;
INSERT INTO `creditcards` VALUES (1,'5105105105105100','06','2023','',NULL,0,4,'2016-08-12 06:26:08','2016-08-12 09:45:49',NULL),(2,'4111111111111111','10','2028','',NULL,0,2,'2016-08-12 06:38:48','2016-08-12 08:55:28',NULL),(3,'4142141242142142141','07','2020','',NULL,0,4,'2016-08-12 07:41:28','2016-08-12 07:41:28',NULL),(4,'4111111111111111','11','2027','',NULL,0,3,'2016-08-12 08:58:58','2016-08-12 08:58:58',NULL),(5,'4111111111111111','11','2029','',NULL,0,7,'2016-08-12 09:05:25','2016-08-12 09:05:25',NULL),(6,'4111111111111111','01','2027','',NULL,0,11,'2016-08-12 10:18:03','2016-08-12 10:18:03',NULL),(7,'5424000000000015','05','2021','',NULL,0,14,'2016-08-17 12:17:13','2016-08-17 12:17:13',NULL);
/*!40000 ALTER TABLE `creditcards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `creditcardtypes`
--

DROP TABLE IF EXISTS `creditcardtypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `creditcardtypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `creditcardtypes`
--

LOCK TABLES `creditcardtypes` WRITE;
/*!40000 ALTER TABLE `creditcardtypes` DISABLE KEYS */;
INSERT INTO `creditcardtypes` VALUES (1,'Rupe','2016-06-29 01:18:18','2016-06-29 01:18:18',NULL);
/*!40000 ALTER TABLE `creditcardtypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `legalName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `businessName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `businesses_id` int(11) NOT NULL,
  `tax_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `suite` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `office_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emailValidateToken` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `noOfDoc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cell_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive','Block') COLLATE utf8_unicode_ci NOT NULL,
  `expiry_date` date NOT NULL,
  `memberships_id` int(11) NOT NULL,
  `sales_person_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refer_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `refer_chanel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'dhiraj pal','demo',11,'','111/A Grafa main Road  Kolkata-700075','001','kolkata','Alaska','','700075','','dhiraj.unified@gmail.com','721470997489','www.google.com','2','dhiraj','pal','','dhiraj','$2y$10$3oLfMkG23IIhdUr/Xkehg.M57ydU3tGyTsFqdEHFssbTj./ANJcyS','Active','2017-08-15',1,'WB001',NULL,'',NULL,'2016-08-12 04:57:08','2016-08-12 04:57:08'),(2,'dhiraj pal','Medicine Shop',1,'','111/A Grafa main Road  Kolkata-700075','001','Kolkata','New York','','10002','(983) 622 - 2834','dhiraj.unified@gmail.com','831470997724','www.uipl.com','2','dhiraj','pal','','dhiraj','$2y$10$ki8pIjsJuhuGQ9oGOJ3/HehAVTZfXJvHs5lcqJn0SsH6dXwPbRmdm','Active','2017-08-15',3,'PSN001','','LinkedIn',NULL,'2016-08-12 10:33:56','2016-08-12 10:33:56'),(3,'bidisha ghosh','bidisha',2,'','berhampore','WB002','berhampore','West bengal','','700075','9732636567','bidisha.unified@gmail.com',NULL,'www.google.com','5','bidisha','ghosh','','bidisha','$2y$10$CMoMTQZg4ysPDkqsl3CwWeVBdcTHG6kxdwqNv4nigVK7FuVWq6J6e','Active','2017-08-15',5,'','','','2016-08-12 05:05:22','2016-08-12 08:58:58',NULL),(4,'Dipanjan Bhattacharya','My business',1,'','sdgsdgg','884','gjjhjg','District of Columbia','','5343535','(829) 695 - 3443','dipanjan@unifiedinfotech.net','301471001037',NULL,'2','Dipanjan','Bhattacharya','','Dipanjan','$2y$10$FhOzspubAw9HhBKPZBudCeTCaCWaUZ0Z4KjabdkJJEvIshMktfdR2','Inactive','2016-06-15',4,'abc123',NULL,'Website',NULL,'2016-08-12 09:45:49',NULL),(5,'one two','One Dental',1,'','1011 Main St','','Raleigh','North Carolina','','28888','','xyfeng506@yahoo.com','271471004982',NULL,'1','one','two','','onetwo','$2y$10$.eQSUkJRL5eAwDW.9gw2GeIJx.8hwlEbMuY9/Ktp5btezCOqGwwFu','Active','2017-08-15',1,NULL,NULL,NULL,NULL,'2016-08-12 07:00:39',NULL),(6,'Amlan Patra','New Clinic',1,'','kolkata','897','Kolkata','California','','700091','(789) 456 - 1301','testunified011@gmail.com','621471009929','www.google.com','5','Amlan','Patra','','AmlanP','$2y$10$7Gc0DE5o7o7AjxJBcnqQfOJcwTQY2BiChR7nfMRQTgXBxKz5zTHRG','Active','2017-08-15',1,'454ABC',NULL,'LinkedIn',NULL,'2016-08-12 08:23:11',NULL),(7,'kakan pal','demo',1,'','111/A Grafa main Road  Kolkata-700075','0001','kolkata','Arizona','','700075','(973) 263 - 6567','kakan@gmail.com','431471012459','ww.e.com','10','kakan','pal','','kakan','$2y$10$NaOyb8qhkZCauVfHU7TtKeuEcZCn.BrLA.0rHk3.k9MMjHC7RJZMK','Active','2017-08-15',5,'0009','','Website',NULL,'2016-08-12 09:05:26',NULL),(8,'Ayan Sil','adert',2,'','5H, Baishnabghata Road','56','Kolkata','Hawaii','','700047','9434007942','ayansil.com@gmail.com','161471013994','http://www.google.com','8','Ayan','Sil','','ayansil','$2y$10$LteOE/t9LtKu4OZXlArQ6uaZ3YLx5K2GncUBgKOfxl7H7ZM5R1zmW','Active','2017-08-15',1,'adasdasd',NULL,'LinkedIn',NULL,'2016-08-12 09:35:59',NULL),(9,'mobile pal','gr',1,'','kolk','000','kolkata','Louisiana','','700075','(973) 244 - 6677','mobile@gmail.com','831471014274','weer.com','1','mobile','pal','','mobile','$2y$10$Inn65caDpyHUubTNzV62SOzFsvT2YqCszUwvI5PK8lfK8mu6rDndu','Active','2017-08-15',1,'000',NULL,'Google',NULL,NULL,NULL),(10,'computer pal','demo',1,'','111/A Grafa main Road  Kolkata-700075','002','kolkata','Arkansas','','700075','(973) 263 - 657','computer@gmail.com','101471016685','www.google.com','9','computer','pal','','computer','$2y$10$tDCPuRgwAbtxmzfPE0nRzuBmXBKDBgazF/V/Mz3tTEooutwiCaNIe','Active','2017-08-15',1,'WB001',NULL,'Website',NULL,'2016-08-12 10:15:31','2016-08-12 10:15:31'),(11,'santu pal','fdsf',2,'','fdsf','32434','jgyhj','Arkansas','','700075','9836222834','santu@gmail.com','611471016816','www.k.com','3','santu','pal','','santu','$2y$10$Ck.qAVvICuBmGAQ1UIBrmupnnJEHNJui9nTZ/Hzmf59XCcKvXAMaG','Active','2017-08-15',5,'4324324','','LinkedIn',NULL,'2016-08-12 10:18:03',NULL),(12,'dhiraj pal','demo',1,'','e','111','kol','Alabama','','32333','(432) 432 - 4','dhiraj.unified@gmail.com','151471017959','www.googl.com','3','dhiraj','pal','','dhiraj','$2y$10$K1gIHjb3rKSATu.Lxc5IC.vdP9ryodw1MqwnMRZCMiaxhK0N5CZ0O','Active','2017-08-15',1,'3323',NULL,'Website',NULL,'2016-08-12 10:38:09','2016-08-12 10:38:09'),(13,'dhiraj pal','test',1,'','111/A Grafa main Road  Kolkata-700075','0001','kolkata','Alabama','','700075','(973) 263 - 6567','dhiraj.unified@gmail.com','451471018440','www.google.com','9','dhiraj','pal','','dhiraj','$2y$10$AKXI963nX27qlt2LSWXacOPM/naO.4ZX7GeGuBumIPExVkQyNILJy','Active','2017-08-15',1,'12',NULL,'Website',NULL,'2016-08-12 10:44:59',NULL),(14,'Bhattacharya','My business',1,'','fhfdhfdh','14354','fghfdh','Georgia','','2464360','(347) 645 - 77547','avishek.m@unifiedinfotech.net','301471428713','','6','Dipanjan','Bhattacharya','','Merv','$2y$10$CKsH0n4nfERG5EGqzAcDjeOJsuGHSYYfhfq4XRDtlX0GRVqQD6SO2','Active','2017-08-15',3,'',NULL,'LinkedIn',NULL,'2016-08-17 12:17:13',NULL);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dashboardimages`
--

DROP TABLE IF EXISTS `dashboardimages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dashboardimages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dashboardimages`
--

LOCK TABLES `dashboardimages` WRITE;
/*!40000 ALTER TABLE `dashboardimages` DISABLE KEYS */;
INSERT INTO `dashboardimages` VALUES (1,'Dashboard Top Banner','1470999358-980x120_1.jpg','2016-08-01 05:22:19','2016-08-12 05:25:58',NULL),(2,'Dashboard Left Banner 1','1471017730-38f24446ba681af34080dd6b6b99d00d.jpg','2016-08-01 05:22:50','2016-08-12 10:32:10',NULL),(3,'Dashboard Left Banner 2','1470999496-38f24446ba681af34080dd6b6b99d00d.jpg','2016-08-01 05:23:13','2016-08-12 05:28:16',NULL);
/*!40000 ALTER TABLE `dashboardimages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emailverificationtokens`
--

DROP TABLE IF EXISTS `emailverificationtokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emailverificationtokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emailverificationtokens`
--

LOCK TABLES `emailverificationtokens` WRITE;
/*!40000 ALTER TABLE `emailverificationtokens` DISABLE KEYS */;
INSERT INTO `emailverificationtokens` VALUES (1,'161471013994',1,'2016-08-12 09:38:11'),(2,'831471014274',0,'0000-00-00 00:00:00'),(3,'101471016685',0,'2016-08-12 15:44:45'),(4,'611471016816',0,'2016-08-12 15:46:56'),(5,'151471017959',1,'2016-08-12 10:36:45'),(6,'451471018440',1,'2016-08-12 10:44:59'),(7,'301471428713',1,'2016-08-17 10:12:38');
/*!40000 ALTER TABLE `emailverificationtokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faqmanagement`
--

DROP TABLE IF EXISTS `faqmanagement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faqmanagement` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `question` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faqmanagement`
--

LOCK TABLES `faqmanagement` WRITE;
/*!40000 ALTER TABLE `faqmanagement` DISABLE KEYS */;
INSERT INTO `faqmanagement` VALUES (1,'What is PSN?','<p>PSN is an online database that provides patient reviews, indicating those who don&rsquo;t pay their bills, skip appointments, or attempt to solicit drugs. Doctors can search the database to research whether a new client is a good fit in their practice. Medical providers who have experienced these issues can also report their non-compliant patients to ensure they don&rsquo;t cause problems at other clinics.</p>\r\n','2016-08-01 01:30:03','2016-08-01 23:09:38',NULL),(2,'How does it work?','<p>Medical providers purchase a membership to access the PSN database, which enables them to search the patient review list at any time, as often as they want. They can also choose to contribute to the network by reporting problematic patients, indicating how much debt is owed, what date the service was provided, the issue of complaint (i.e., non-paying, drug-seeker, etc.), and the current status of whether or not the issue has been resolved. Other PSN members can use this information to decide whether to extend their services to the patient in question.</p>\r\n','2016-08-01 23:12:14','2016-08-01 23:12:14',NULL),(3,'How does the signup process work?','<p>Signing up is easy with our simple online membership application<!-- Hyperlink to the signup -->. All you need is an email address and a credit card.</p>\r\n','2016-08-01 23:12:51','2016-08-01 23:12:51',NULL),(4,'How much does PSN cost?','<p>Users can begin with a 3-month free trial <a href=\"http://unifiedinfotech.co.in/webroot/team1/PSN_beta/app/\">membership</a> <!-- Hyperlink to the signup page. -->to test out PSN for themselves. Packages begin at $199/month, $2000/year, and $8000 for a lifetime membership.</p>\r\n','2016-08-01 23:14:16','2016-08-01 23:18:27',NULL),(5,'What about the patient’s privacy?','<p>PSN is a HIPPA compliant website. The medical records of the patient cannot be shared on the database. The only information that is listed is a failure to pay bills, how much is owned, the date of the service, other undesirable behaviors (i.e., drug-seeking), and the current status of the individual with the clinic.</p>\r\n','2016-08-01 23:14:42','2016-08-01 23:14:42',NULL);
/*!40000 ALTER TABLE `faqmanagement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `loginlogs`
--

DROP TABLE IF EXISTS `loginlogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `loginlogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime NOT NULL,
  `patients_ids` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `patients_search_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `loginlogs`
--

LOCK TABLES `loginlogs` WRITE;
/*!40000 ALTER TABLE `loginlogs` DISABLE KEYS */;
INSERT INTO `loginlogs` VALUES (1,3,'2016-08-12 10:55:21','0000-00-00 00:00:00',NULL,NULL,'2016-08-12 05:25:21','2016-08-12 05:25:21',NULL),(2,3,'2016-08-12 10:55:22','0000-00-00 00:00:00',NULL,NULL,'2016-08-12 05:25:22','2016-08-12 05:25:22',NULL),(3,3,'2016-08-12 10:55:23','2016-08-12 10:58:57',NULL,NULL,'2016-08-12 05:25:23','2016-08-12 05:28:57',NULL),(4,3,'2016-08-12 10:55:23','0000-00-00 00:00:00',NULL,NULL,'2016-08-12 05:25:23','2016-08-12 05:25:23',NULL),(5,2,'2016-08-12 11:01:01','2016-08-12 11:02:09',NULL,NULL,'2016-08-12 05:31:01','2016-08-12 05:32:09',NULL),(6,2,'2016-08-12 11:06:48','2016-08-12 11:58:13','2',NULL,'2016-08-12 05:36:48','2016-08-12 06:28:13',NULL),(7,4,'2016-08-12 11:34:37','0000-00-00 00:00:00','1',NULL,'2016-08-12 06:04:37','2016-08-12 06:05:17',NULL),(8,4,'2016-08-12 11:37:54','0000-00-00 00:00:00',NULL,'1111','2016-08-12 06:07:54','2016-08-12 06:15:02',NULL),(9,4,'2016-08-12 11:54:08','2016-08-12 12:01:52',NULL,'1','2016-08-12 06:24:08','2016-08-12 06:33:10',NULL),(10,2,'2016-08-12 12:04:37','2016-08-12 13:37:54',NULL,'222','2016-08-12 06:34:37','2016-08-12 08:07:54',NULL),(11,5,'2016-08-12 12:50:55','2016-08-12 13:31:22',NULL,NULL,'2016-08-12 07:20:55','2016-08-12 08:01:22',NULL),(12,4,'2016-08-12 12:59:47','0000-00-00 00:00:00',NULL,NULL,'2016-08-12 07:29:47','2016-08-12 07:29:47',NULL),(13,4,'2016-08-12 13:08:19','0000-00-00 00:00:00',NULL,'1','2016-08-12 07:38:19','2016-08-12 07:40:32',NULL),(14,4,'2016-08-12 13:38:27','2016-08-12 14:20:06',NULL,'1','2016-08-12 08:08:27','2016-08-12 08:50:06',NULL),(15,2,'2016-08-12 13:40:24','2016-08-12 14:27:33',NULL,'2','2016-08-12 08:10:24','2016-08-12 08:57:33',NULL),(16,6,'2016-08-12 13:53:57','0000-00-00 00:00:00',NULL,NULL,'2016-08-12 08:23:57','2016-08-12 08:23:57',NULL),(17,6,'2016-08-12 13:54:15','0000-00-00 00:00:00',NULL,NULL,'2016-08-12 08:24:15','2016-08-12 08:24:15',NULL),(18,6,'2016-08-12 13:55:15','2016-08-12 14:01:52',NULL,NULL,'2016-08-12 08:25:15','2016-08-12 08:31:52',NULL),(19,6,'2016-08-12 14:02:22','2016-08-12 14:02:30','3',NULL,'2016-08-12 08:32:22','2016-08-12 08:43:51',NULL),(20,6,'2016-08-12 14:14:24','0000-00-00 00:00:00',NULL,NULL,'2016-08-12 08:44:24','2016-08-12 08:44:24',NULL),(21,6,'2016-08-12 14:18:14','2016-08-12 14:28:58',NULL,NULL,'2016-08-12 08:48:14','2016-08-12 08:58:58',NULL),(22,4,'2016-08-12 14:20:30','0000-00-00 00:00:00',NULL,NULL,'2016-08-12 08:50:30','2016-08-12 08:50:30',NULL),(23,4,'2016-08-12 14:20:59','0000-00-00 00:00:00',NULL,NULL,'2016-08-12 08:50:59','2016-08-12 08:50:59',NULL),(24,4,'2016-08-12 14:23:01','2016-08-12 14:31:29',NULL,NULL,'2016-08-12 08:53:01','2016-08-12 09:01:29',NULL),(25,3,'2016-08-12 14:28:01','2016-08-12 14:33:09',NULL,NULL,'2016-08-12 08:58:01','2016-08-12 09:03:09',NULL),(26,7,'2016-08-12 14:34:54','2016-08-12 14:41:36',NULL,NULL,'2016-08-12 09:04:54','2016-08-12 09:11:36',NULL),(27,4,'2016-08-12 14:35:53','0000-00-00 00:00:00',NULL,NULL,'2016-08-12 09:05:53','2016-08-12 09:05:53',NULL),(28,4,'2016-08-12 14:42:43','2016-08-12 15:07:58',NULL,NULL,'2016-08-12 09:12:43','2016-08-12 09:37:58',NULL),(29,2,'2016-08-12 14:49:09','2016-08-12 15:05:56',NULL,NULL,'2016-08-12 09:19:09','2016-08-12 09:35:56',NULL),(30,2,'2016-08-12 15:06:36','0000-00-00 00:00:00',NULL,NULL,'2016-08-12 09:36:36','2016-08-12 09:36:36',NULL),(31,2,'2016-08-12 15:06:53','2016-08-12 15:42:23',NULL,NULL,'2016-08-12 09:36:53','2016-08-12 10:12:23',NULL),(32,4,'2016-08-12 15:08:46','2016-08-12 15:32:58',NULL,'3,4','2016-08-12 09:38:46','2016-08-12 10:02:58',NULL),(33,3,'2016-08-12 15:11:32','0000-00-00 00:00:00','4','3,4','2016-08-12 09:41:32','2016-08-12 09:48:43',NULL),(34,4,'2016-08-12 15:33:14','2016-08-12 15:33:21',NULL,NULL,'2016-08-12 10:03:14','2016-08-12 10:03:21',NULL),(35,4,'2016-08-12 15:33:34','2016-08-12 15:35:57',NULL,NULL,'2016-08-12 10:03:34','2016-08-12 10:05:57',NULL),(36,4,'2016-08-12 15:36:06','2016-08-12 15:36:43',NULL,NULL,'2016-08-12 10:06:06','2016-08-12 10:06:43',NULL),(37,11,'2016-08-12 15:47:38','2016-08-12 16:04:02',NULL,NULL,'2016-08-12 10:17:38','2016-08-12 10:34:02',NULL),(38,13,'2016-08-12 16:15:19','0000-00-00 00:00:00',NULL,NULL,'2016-08-12 10:45:19','2016-08-12 10:45:19',NULL),(39,4,'2016-08-16 04:28:56','2016-08-16 04:29:55',NULL,NULL,'2016-08-15 22:58:56','2016-08-15 22:59:55',NULL),(40,4,'2016-08-16 13:12:19','2016-08-16 13:16:32',NULL,NULL,'2016-08-16 07:42:19','2016-08-16 07:46:32',NULL),(41,14,'2016-08-17 10:13:21','0000-00-00 00:00:00',NULL,NULL,'2016-08-17 10:13:21','2016-08-17 10:13:21',NULL),(42,14,'2016-08-17 10:13:22','0000-00-00 00:00:00',NULL,NULL,'2016-08-17 10:13:22','2016-08-17 10:13:22',NULL),(43,14,'2016-08-17 10:23:19','2016-08-17 11:39:50','5,6','1115555,65,6','2016-08-17 10:23:19','2016-08-17 11:39:50',NULL),(44,14,'2016-08-17 12:07:00','0000-00-00 00:00:00',NULL,NULL,'2016-08-17 12:07:00','2016-08-17 12:07:00',NULL),(45,14,'2016-08-17 12:13:28','0000-00-00 00:00:00',NULL,NULL,'2016-08-17 12:13:28','2016-08-17 12:13:28',NULL),(46,14,'2016-08-17 12:15:45','2016-08-17 12:41:03',NULL,NULL,'2016-08-17 12:15:45','2016-08-17 12:41:03',NULL),(47,14,'2016-08-17 12:41:42','2016-08-17 12:43:17',NULL,NULL,'2016-08-17 12:41:42','2016-08-17 12:43:17',NULL),(48,14,'2016-08-17 12:43:47','2016-08-17 12:53:10',NULL,NULL,'2016-08-17 12:43:47','2016-08-17 12:53:10',NULL),(49,14,'2016-08-17 12:53:35','2016-08-17 12:54:05',NULL,NULL,'2016-08-17 12:53:35','2016-08-17 12:54:05',NULL),(50,14,'2016-08-17 13:05:43','2016-08-17 13:06:22',NULL,NULL,'2016-08-17 13:05:43','2016-08-17 13:06:22',NULL),(51,14,'2016-08-17 13:12:42','0000-00-00 00:00:00',NULL,NULL,'2016-08-17 13:12:42','2016-08-17 13:12:42',NULL),(52,14,'2016-08-17 13:12:54','2016-08-17 13:14:18',NULL,NULL,'2016-08-17 13:12:54','2016-08-17 13:14:18',NULL),(53,14,'2016-08-17 13:14:38','0000-00-00 00:00:00',NULL,NULL,'2016-08-17 13:14:38','2016-08-17 13:14:38',NULL),(54,14,'2016-08-17 13:15:03','2016-08-17 13:16:59','7','1,71,7','2016-08-17 13:15:03','2016-08-17 13:19:27',NULL),(55,4,'2016-08-18 13:28:52','0000-00-00 00:00:00',NULL,'1,71,7','2016-08-18 13:28:52','2016-08-18 13:36:51',NULL),(56,4,'2016-08-18 13:53:55','2016-08-18 14:13:11',NULL,'1,7','2016-08-18 13:53:55','2016-08-18 14:13:11',NULL),(57,4,'2016-08-18 14:13:35','0000-00-00 00:00:00',NULL,NULL,'2016-08-18 14:13:35','2016-08-18 14:13:35',NULL),(58,4,'2016-08-18 14:42:21','0000-00-00 00:00:00',NULL,NULL,'2016-08-18 14:42:21','2016-08-18 14:42:21',NULL),(59,4,'2016-08-18 14:44:26','0000-00-00 00:00:00',NULL,NULL,'2016-08-18 14:44:26','2016-08-18 14:44:26',NULL),(60,4,'2016-08-18 14:47:16','0000-00-00 00:00:00',NULL,NULL,'2016-08-18 14:47:16','2016-08-18 14:47:16',NULL),(61,4,'2016-08-18 14:54:39','0000-00-00 00:00:00',NULL,NULL,'2016-08-18 14:54:39','2016-08-18 14:54:39',NULL),(62,4,'2016-08-18 15:07:25','2016-08-18 15:07:53',NULL,NULL,'2016-08-18 15:07:25','2016-08-18 15:07:53',NULL);
/*!40000 ALTER TABLE `loginlogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `memberships`
--

DROP TABLE IF EXISTS `memberships`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `memberships` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `subheading` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `memberships`
--

LOCK TABLES `memberships` WRITE;
/*!40000 ALTER TABLE `memberships` DISABLE KEYS */;
INSERT INTO `memberships` VALUES (1,'Free','3',0.00,'2016-06-28 19:00:48','2016-08-11 23:27:28',NULL,'3 Months (FREE)','<ul>\r\n                                            <li>Report Patient</li>\r\n                                            <li>View Patient</li>\r\n                                            <li>Search Patient</li>\r\n                                            <li>Account Setting</li>\r\n                                        </ul>'),(3,'3 Month','3',100.00,'2016-08-09 17:36:21','2016-08-11 23:28:16',NULL,'3 Months (PAID)','<ul>\r\n	<li>Report Patient</li>\r\n	<li>View Patient</li>\r\n	<li>Search Patient</li>\r\n	<li>Account Setting</li>\r\n</ul>\r\n'),(4,'6 months','6',400.00,'2016-08-09 19:06:10','2016-08-11 23:28:23',NULL,'6 Months (PAID)','<ul>\r\n	<li>Report Patient</li>\r\n	<li>View Patient</li>\r\n	<li>Search Patient</li>\r\n	<li>Account Setting</li>\r\n</ul>\r\n'),(5,'Yearly','12',1000.00,'2016-08-09 19:06:30','2016-08-12 06:34:50',NULL,'12 Months (PAID)','<ul>\r\n	<li>Report Patientss</li>\r\n	<li>View Patient</li>\r\n	<li>Search Patient</li>\r\n	<li>Account Setting</li>\r\n</ul>\r\n');
/*!40000 ALTER TABLE `memberships` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_role`
--

DROP TABLE IF EXISTS `menu_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_role` (
  `menu_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  UNIQUE KEY `menu_role_menu_id_role_id_unique` (`menu_id`,`role_id`),
  KEY `menu_role_menu_id_index` (`menu_id`),
  KEY `menu_role_role_id_index` (`role_id`),
  CONSTRAINT `menu_role_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `menu_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_role`
--

LOCK TABLES `menu_role` WRITE;
/*!40000 ALTER TABLE `menu_role` DISABLE KEYS */;
INSERT INTO `menu_role` VALUES (1,3),(3,1),(3,3),(4,1),(4,3),(5,1),(5,3),(6,1),(7,1),(8,1),(9,1),(10,1),(10,3),(11,1),(23,1),(23,3),(24,1),(24,3),(25,1),(25,3),(26,1),(26,3),(27,1),(27,3),(28,1),(28,3),(29,1),(29,3),(30,1),(30,3),(31,1),(31,3),(32,1),(32,3),(33,1),(33,3),(34,1),(34,3),(35,1),(35,3),(36,1),(36,3),(37,1),(37,3),(38,1),(38,3),(39,1),(39,3);
/*!40000 ALTER TABLE `menu_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position` int(11) DEFAULT NULL,
  `menu_type` int(11) NOT NULL DEFAULT '1',
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,NULL,0,NULL,'User','User',NULL,NULL,NULL),(2,NULL,0,NULL,'Role','Role',NULL,NULL,NULL),(3,0,1,'fa-database','Businesses','Businesses',NULL,'2016-06-28 07:47:46','2016-06-30 03:50:01'),(4,0,1,'fa-database','Customers','Customers',NULL,'2016-06-28 08:16:28','2016-06-28 08:16:28'),(5,0,1,'fa-database','Memberships','Memberships',NULL,'2016-06-29 00:30:20','2016-06-29 00:30:20'),(6,0,1,'fa-database','PaymentTypes','Payment Types',NULL,'2016-06-29 01:14:37','2016-06-29 01:14:37'),(7,0,1,'fa-database','CreditCardTypes','Credit Card Types',NULL,'2016-06-29 01:17:41','2016-06-29 01:17:41'),(8,0,1,'fa-database','CreditCards','Credit Cards',NULL,'2016-06-29 01:24:17','2016-06-29 01:24:17'),(9,0,1,'fa-database','BankBrafts','Bank Drafts',NULL,'2016-06-29 01:35:44','2016-06-29 01:35:44'),(10,0,1,'fa-database','BehaviorLists','Behavior Lists',NULL,'2016-06-29 01:41:34','2016-06-29 01:41:34'),(11,0,1,'fa-database','Patients','Patients',NULL,'2016-06-29 02:03:56','2016-06-29 02:03:56'),(23,0,1,'fa-database','PatientReports','Patient Reported',NULL,'2016-06-29 04:46:32','2016-06-29 04:46:32'),(24,0,1,'fa-database','PatientsLooks','Patients Looked',NULL,'2016-06-29 05:01:55','2016-06-29 05:01:55'),(25,0,1,'fa-database','LoginLogs','Login Logs',NULL,'2016-06-29 05:19:22','2016-06-29 05:19:22'),(26,0,2,'fa-pagelines','CmsPages','Cms Pages',NULL,'2016-06-29 05:21:47','2016-06-29 05:21:47'),(27,0,1,'fa-database','Contactuspage','Service',26,'2016-06-29 05:24:44','2016-07-08 03:55:55'),(28,0,1,'fa-key','ChangePassword','Change Password',NULL,NULL,NULL),(29,0,1,'fa-envelope','ChangeEmail','Change Email',NULL,NULL,NULL),(30,0,1,'fa-database','SliderImages','Slider Images',NULL,'2016-07-04 06:10:34','2016-07-04 06:10:34'),(31,0,1,'fa-database','FaqManagement','Faq',26,'2016-07-04 06:50:48','2016-07-04 06:50:48'),(32,0,1,'fa-database','SiteSettings','Site Settings',NULL,'2016-07-05 03:41:21','2016-07-05 03:41:21'),(33,0,1,'fa-database','AboutUs','About Us',26,'2016-07-08 03:48:26','2016-07-08 03:48:26'),(34,0,1,'fa-database','Stories','Story ',26,'2016-07-08 03:52:56','2016-07-08 03:53:16'),(35,0,1,'fa-database','PaymentReport','Payments',NULL,'2016-07-13 05:06:24','2016-07-13 05:06:24'),(36,0,1,'fa-database','Testimonials','Testimonial',26,'2016-08-01 03:53:12','2016-08-01 03:53:12'),(37,0,2,'fa-database','Advertisement','Advertisement',NULL,'2016-08-01 05:08:22','2016-08-01 05:08:22'),(38,0,1,'fa-database','Dashboardimages','Dashboard',37,'2016-08-01 05:11:45','2016-08-01 05:11:45'),(39,0,1,'fa-database','Packageimages','Package',37,'2016-08-01 05:32:10','2016-08-01 05:32:10');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1),('2015_10_10_000000_create_menus_table',1),('2015_10_10_000000_create_roles_table',1),('2015_10_10_000000_update_users_table',1),('2015_12_11_000000_create_users_logs_table',1),('2016_03_14_000000_update_menus_table',1),('2016_05_24_110535_create_pages_table',2),('2016_05_24_111854_create_pages_table',3),('2016_05_25_123033_create_home_table',4),('2016_05_25_124333_create_homepage_table',5),('2016_05_25_125724_create_homepage_table',6),('2016_05_27_102612_create_transactionfee_table',7),('2016_05_27_104310_create_testimonials_table',8),('2016_05_27_132848_create_templates_table',9),('2016_05_30_052017_create_contributionamounts_table',10),('2016_05_30_091340_create_parties_table',11),('2016_05_30_130922_create_dashboard_table',12),('2016_06_02_132723_create_test_table',13),('2016_06_06_095939_create_privacy_table',14),('2016_06_06_105114_create_how_its_works_table',15),('2016_06_06_110057_create_how_its_works_table',16),('2016_06_06_110953_create_how_its_works_table',17),('2016_06_06_112538_create_faqs_table',18),('2016_06_06_130133_create_legal_disclaimer_table',19),('2016_06_07_054403_create_about_us_table',20),('2016_06_07_055040_create_about_us_owner_table',21),('2016_06_10_054804_create_contibutes_table',22),('2016_06_13_085444_create_reminders_table',23),('2016_06_15_075309_create_set_party_table',24),('2016_06_15_085853_create_contribution_page_table',25),('2016_06_15_105131_create_dashboard_party_table',26),('2016_06_15_114816_create_withdraw_table',27),('2016_06_17_085930_create_contact_form_db_table',28),('2016_06_17_121735_create_contact_us_table',29),('2016_06_28_075031_create_doctors_table',30),('2016_06_28_125850_create_customers_table',31),('2016_06_28_130356_create_doctors_table',32),('2016_06_28_131418_create_businesses_table',33),('2016_06_28_131746_create_businesses_table',34),('2016_06_28_134628_create_customers_table',35),('2016_06_29_053829_create_membershps_table',36),('2016_06_29_060020_create_memberships_table',37),('2016_06_29_064437_create_payment_types_table',38),('2016_06_29_064741_create_creditcardtypes_table',39),('2016_06_29_065417_create_credit_cards_table',40),('2016_06_29_070544_create_bank_brafts_table',41),('2016_06_29_071134_create_behavior_lists__table',42),('2016_06_29_073356_create_patients_table',43),('2016_06_29_101632_create_patient_reports_table',44),('2016_06_29_103155_create_patients_looks_table',45),('2016_06_29_104922_create_login_logs_table',46),('2016_06_29_105444_create_contactuspage_table',47),('2016_07_04_114034_create_slider_images_table',48),('2016_07_04_122048_create_faq_management_table',49),('2016_07_05_091121_create_site_settings_table',50),('2016_07_08_091826_create_aboutus_table',51),('2016_07_08_092257_create_stories_table',52),('2016_07_13_103624_create_paymentreport_table',53),('2016_08_01_092312_create_testimonials_table',54),('2016_08_01_104145_create_dashboardimages_table',55),('2016_08_01_110210_create_packageimages_table',56),('2016_08_01_114609_create_reportpatients_table',57);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `packageimages`
--

DROP TABLE IF EXISTS `packageimages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `packageimages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `packageimages`
--

LOCK TABLES `packageimages` WRITE;
/*!40000 ALTER TABLE `packageimages` DISABLE KEYS */;
INSERT INTO `packageimages` VALUES (1,'Footer Banner','1470999254-980x120_1.jpg','2016-08-01 05:33:16','2016-08-12 05:24:14',NULL);
/*!40000 ALTER TABLE `packageimages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('jit.109028@gmail.com','48c415ad99dba8886351cdb301f43aa5f1df8db89c4e933ab4c03c1741937d14','2016-06-30 00:27:40'),('admin123@gmail.com','a8fcd5419138dff1bf0dd1d62c5709d0564cbf7a31f5b41ce2aca8f54ab66d24','2016-08-04 02:20:50'),('jit@unifiedinfotech.net','66eb534f4b52e6d965c12f04fe0d51be1df6c6236fd2f49bfb397701097cc368','2016-08-05 00:27:48');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patientreports`
--

DROP TABLE IF EXISTS `patientreports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patientreports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patients_id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `report_reason` enum('Balance','Behavior','Both') COLLATE utf8_unicode_ci NOT NULL,
  `balance_amount` decimal(15,2) NOT NULL,
  `service_date` date NOT NULL,
  `behaviorlists_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci,
  `report_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patientreports`
--

LOCK TABLES `patientreports` WRITE;
/*!40000 ALTER TABLE `patientreports` DISABLE KEYS */;
INSERT INTO `patientreports` VALUES (1,3,4,'Balance',0.00,'2016-07-04','','note given','2016-08-12','2016-08-12 06:05:17','2016-08-12 08:36:25',NULL),(2,2,2,'Balance',500.00,'2016-08-10','','demo ankan','2016-08-12','2016-08-12 06:17:25',NULL,NULL),(3,4,6,'Balance',0.00,'2016-08-11','','Report Reason\nTotal Unpaid Balance of Patient\nPatient\'s Unacceptable Behaviors\n\nReport Reason\nTotal Unpaid Balance of Patient\nPatient\'s Unacceptable Behaviors\n\nReport Reason\nTotal Unpaid Balance of','2016-08-12','2016-08-12 08:43:50',NULL,NULL),(4,5,3,'Balance',100.00,'2016-08-12','','Demo','2016-08-12','2016-08-12 09:42:46',NULL,NULL),(5,9,14,'Balance',120.00,'2016-08-15','','heavy bapar','2016-08-17','2016-08-17 11:08:30','2016-08-17 13:15:19',NULL),(6,8,14,'Balance',120.00,'2016-08-01','','aadsadsad adas d','2016-08-17','2016-08-17 11:14:29',NULL,NULL),(7,10,14,'Balance',0.00,'2016-07-01','','','2016-08-17','2016-08-17 13:17:01','2016-08-17 13:18:41',NULL);
/*!40000 ALTER TABLE `patientreports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date NOT NULL,
  `gender` enum('MALE','FEMALE') COLLATE utf8_unicode_ci NOT NULL,
  `ssn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `home_phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customers_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (1,'Mervin','','Dillon',NULL,'2016-08-01','MALE','888888888','','','','','','',4,'2016-08-12 06:05:17',NULL,NULL),(2,'ankan','','pal',NULL,'2016-08-02','MALE','111122222','','','','','','',2,'2016-08-12 06:17:25',NULL,NULL),(3,'Mervin','','Dillonf',NULL,'2016-08-01','MALE','888888888','','','','','','',4,'2016-08-12 06:34:11',NULL,NULL),(4,'asnbd','','sdasadsa',NULL,'2016-08-10','MALE','111111111','','','','','','',6,'2016-08-12 08:43:50',NULL,NULL),(5,'demo','','pal',NULL,'2016-08-12','MALE','111111111','','','','','','',3,'2016-08-12 09:42:46',NULL,NULL),(6,'biswambhar','','panl',NULL,'1991-03-01','MALE','999999999','','','','','','',14,'2016-08-17 11:08:30',NULL,NULL),(7,'biswambhar','','pan',NULL,'1991-03-01','MALE','999999999','','','','','','',14,'2016-08-17 11:08:51',NULL,NULL),(8,'def','','panl',NULL,'1991-04-03','MALE','999999999','','','','','','',14,'2016-08-17 11:14:29',NULL,NULL),(9,'biswambhar','','panii',NULL,'1991-03-01','MALE','999999999','','','','','','',14,'2016-08-17 13:15:19',NULL,NULL),(10,'suchandan','','Mallik',NULL,'2016-08-01','MALE','888888888','','','','','','',14,'2016-08-17 13:17:01',NULL,NULL);
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patientslooks`
--

DROP TABLE IF EXISTS `patientslooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patientslooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `ssn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customers_id` int(11) DEFAULT NULL,
  `found_match` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `patient_ids` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patientslooks`
--

LOCK TABLES `patientslooks` WRITE;
/*!40000 ALTER TABLE `patientslooks` DISABLE KEYS */;
INSERT INTO `patientslooks` VALUES (1,'',NULL,'','0000-00-00','888888888','',4,'0,1',NULL,'2016-08-12 06:08:12','2016-08-12 06:08:12',NULL),(2,'',NULL,'','0000-00-00','888888888','',4,'0,1',NULL,'2016-08-12 06:09:07','2016-08-12 06:09:07',NULL),(3,'',NULL,'','0000-00-00','888888888','',4,'0,1',NULL,'2016-08-12 06:13:54','2016-08-12 06:13:54',NULL),(4,'',NULL,'','0000-00-00','888888888','',4,'0,1',NULL,'2016-08-12 06:15:02','2016-08-12 06:15:02',NULL),(5,'',NULL,'','0000-00-00','888888888','',4,'0,1',NULL,'2016-08-12 06:33:10','2016-08-12 06:33:10',NULL),(6,'ankan',NULL,'','2016-08-02','','MALE',2,'0,2',NULL,'2016-08-12 07:30:19','2016-08-12 07:30:19',NULL),(7,'',NULL,'','0000-00-00','888888888','',4,'0,1',NULL,'2016-08-12 07:40:32','2016-08-12 07:40:32',NULL),(8,'ankan',NULL,'','2016-08-02','','FEMALE',2,'0',NULL,'2016-08-12 07:43:13','2016-08-12 07:43:13',NULL),(9,'ankan',NULL,'','2016-08-02','','FEMALE',2,'0',NULL,'2016-08-12 07:43:15','2016-08-12 07:43:15',NULL),(10,'ankan',NULL,'','2016-08-02','','FEMALE',2,'0',NULL,'2016-08-12 07:43:15','2016-08-12 07:43:15',NULL),(11,'ankan',NULL,'fdsfdsfdsf','2016-08-02','','MALE',2,'0',NULL,'2016-08-12 07:43:20','2016-08-12 07:43:20',NULL),(12,'ankan',NULL,'','2016-08-02','','MALE',2,'0,2',NULL,'2016-08-12 07:43:25','2016-08-12 07:43:25',NULL),(13,'ankan',NULL,'gdfgdfggdfg','2016-08-02','','FEMALE',2,'0',NULL,'2016-08-12 07:45:16','2016-08-12 07:45:16',NULL),(14,'ankan',NULL,'gdfgdfggdfg','2016-08-02','','FEMALE',2,'0',NULL,'2016-08-12 07:45:16','2016-08-12 07:45:16',NULL),(15,'ankan',NULL,'','2016-08-02','','FEMALE',2,'0',NULL,'2016-08-12 07:45:23','2016-08-12 07:45:23',NULL),(16,'ankan',NULL,'','2016-08-02','','FEMALE',2,'0',NULL,'2016-08-12 07:45:27','2016-08-12 07:45:27',NULL),(17,'ankan',NULL,'fdsgfdsgdfg','2016-08-02','','MALE',2,'0',NULL,'2016-08-12 07:46:36','2016-08-12 07:46:36',NULL),(18,'ankan',NULL,'','2016-08-02','','MALE',2,'0,2',NULL,'2016-08-12 07:46:43','2016-08-12 07:46:43',NULL),(19,'',NULL,'','0000-00-00','888888888','',4,'0,1',NULL,'2016-08-12 08:10:27','2016-08-12 08:10:27',NULL),(20,'',NULL,'','0000-00-00','111122222','',2,'0,2',NULL,'2016-08-12 08:12:19','2016-08-12 08:12:19',NULL),(21,'',NULL,'','0000-00-00','111111111','',4,'0,3,4',NULL,'2016-08-12 09:45:44','2016-08-12 09:45:44',NULL),(22,'',NULL,'','0000-00-00','111111111','',3,'0,3,4',NULL,'2016-08-12 09:48:43','2016-08-12 09:48:43',NULL),(23,'',NULL,'','0000-00-00','888888888','',14,'0,1',NULL,'2016-08-17 10:31:43','2016-08-17 10:31:43',NULL),(24,'',NULL,'','0000-00-00','888888888','',14,'0,1',NULL,'2016-08-17 10:42:23','2016-08-17 10:42:23',NULL),(25,'',NULL,'','0000-00-00','888888888','',14,'0,1',NULL,'2016-08-17 11:07:19','2016-08-17 11:07:19',NULL),(26,'',NULL,'','0000-00-00','999999999','',14,'0,5',NULL,'2016-08-17 11:09:04','2016-08-17 11:09:04',NULL),(27,'',NULL,'pan','1991-03-01','','MALE',14,'0,5',NULL,'2016-08-17 11:12:23','2016-08-17 11:12:23',NULL),(28,'',NULL,'','0000-00-00','999999999','',14,'0,5',NULL,'2016-08-17 11:12:58','2016-08-17 11:12:58',NULL),(29,'',NULL,'','0000-00-00','999999999','',14,'0,5,6',NULL,'2016-08-17 11:14:44','2016-08-17 11:14:44',NULL),(30,'',NULL,'','0000-00-00','999999999','',14,'0,5,6',NULL,'2016-08-17 11:39:44','2016-08-17 11:39:44',NULL),(31,'',NULL,'','0000-00-00','888888888','',14,'0,1,7',NULL,'2016-08-17 13:18:02','2016-08-17 13:18:02',NULL),(32,'',NULL,'','0000-00-00','888888888','',14,'0,1,7',NULL,'2016-08-17 13:19:27','2016-08-17 13:19:27',NULL),(33,'',NULL,'','0000-00-00','888888888','',4,'0,1,7',NULL,'2016-08-18 13:34:18','2016-08-18 13:34:18',NULL),(34,'',NULL,'','0000-00-00','888888888','',4,'0,1,7',NULL,'2016-08-18 13:36:51','2016-08-18 13:36:51',NULL),(35,'',NULL,'','0000-00-00','888888888','',4,'0,1,7',NULL,'2016-08-18 13:54:05','2016-08-18 13:54:05',NULL);
/*!40000 ALTER TABLE `patientslooks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paymentreport`
--

DROP TABLE IF EXISTS `paymentreport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paymentreport` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount_paid` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `pack_taken` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `valid_till` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paymentreport`
--

LOCK TABLES `paymentreport` WRITE;
/*!40000 ALTER TABLE `paymentreport` DISABLE KEYS */;
INSERT INTO `paymentreport` VALUES (1,2,'123',25.00,'2016-08-12 05:42:19','2016-08-12 06:02:10','2016-08-12 06:02:10','1',NULL),(2,4,'60006512244',100.00,'2016-08-12 06:26:08','2016-08-12 06:26:08',NULL,'3','2017-02-10'),(3,4,'60006512310',100.00,'2016-08-12 06:26:41','2016-08-12 06:26:41',NULL,'3','2017-05-10'),(4,2,'60006512755',1000.00,'2016-08-12 06:38:48','2016-08-12 06:47:19','2016-08-12 06:47:19','5','2017-11-10'),(5,2,'60006512793',1000.00,'2016-08-12 06:40:48','2016-08-12 06:47:35','2016-08-12 06:47:35','5','2018-11-10'),(6,2,'60006512828',1000.00,'2016-08-12 06:42:31','2016-08-12 06:48:07','2016-08-12 06:48:07','5','2019-11-10'),(7,4,'60006515459',100.00,'2016-08-12 08:05:59','2016-08-12 08:05:59',NULL,'3','2017-08-10'),(8,2,'60006516485',100.00,'2016-08-12 08:52:33','2016-08-12 08:57:19','2016-08-12 08:57:19','3','2019-09-19'),(9,2,'60006516554',100.00,'2016-08-12 08:55:28','2016-08-12 08:57:19','2016-08-12 08:57:19','3','2019-12-19'),(10,3,'60006516614',1000.00,'2016-08-12 08:58:58','2016-08-12 08:58:58',NULL,'5','2017-08-31'),(11,7,'60006516849',1000.00,'2016-08-12 09:05:26','2016-08-12 09:05:26',NULL,'5','2017-11-10'),(12,4,'60006518471',400.00,'2016-08-12 09:45:49','2016-08-12 09:45:49',NULL,'4','2018-02-10'),(13,11,'60006519537',1000.00,'2016-08-12 10:18:03','2016-08-12 10:18:03',NULL,'5','2017-11-10'),(14,14,'60006727028',100.00,'2016-08-17 12:17:13','2016-08-17 12:17:13',NULL,'3','2017-02-15');
/*!40000 ALTER TABLE `paymentreport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paymenttypes`
--

DROP TABLE IF EXISTS `paymenttypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `paymenttypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paymenttypes`
--

LOCK TABLES `paymenttypes` WRITE;
/*!40000 ALTER TABLE `paymenttypes` DISABLE KEYS */;
/*!40000 ALTER TABLE `paymenttypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reportbehaviour`
--

DROP TABLE IF EXISTS `reportbehaviour`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reportbehaviour` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `report_id` bigint(20) NOT NULL,
  `behaviorlists_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=318 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reportbehaviour`
--

LOCK TABLES `reportbehaviour` WRITE;
/*!40000 ALTER TABLE `reportbehaviour` DISABLE KEYS */;
INSERT INTO `reportbehaviour` VALUES (8,12,2),(18,13,1),(19,13,2),(20,14,1),(21,14,2),(22,15,0),(23,19,2),(24,20,2),(25,21,2),(26,22,1),(27,23,1),(29,25,1),(30,26,1),(31,27,1),(32,28,1),(33,29,1),(34,30,1),(35,31,2),(36,32,1),(37,42,1),(38,42,2),(39,43,1),(40,43,2),(41,44,1),(43,46,1),(44,47,1),(47,45,1),(48,45,2),(49,52,1),(52,53,1),(53,53,2),(63,54,1),(64,54,2),(65,55,1),(66,55,2),(67,56,1),(68,57,1),(69,57,2),(70,58,1),(71,59,1),(72,59,2),(73,60,1),(74,60,2),(75,62,1),(76,62,2),(81,64,1),(82,64,2),(100,65,2),(101,66,1),(102,66,2),(103,24,2),(104,67,1),(105,67,2),(112,68,1),(113,68,2),(114,68,3),(115,69,1),(116,69,2),(117,69,3),(118,70,1),(119,70,2),(120,70,3),(121,71,1),(127,73,1),(128,73,2),(129,73,3),(130,74,1),(131,74,2),(132,74,3),(136,76,1),(137,76,2),(138,76,3),(139,77,1),(140,77,2),(141,77,3),(145,78,1),(146,78,2),(147,78,3),(156,80,2),(157,80,3),(162,75,2),(163,75,3),(164,82,2),(165,83,1),(166,83,3),(168,81,2),(169,81,1),(190,84,1),(191,84,2),(192,84,3),(207,93,1),(208,93,2),(209,94,2),(214,96,1),(224,95,2),(225,95,3),(226,91,1),(227,91,2),(228,92,1),(229,92,2),(239,98,1),(264,101,2),(265,102,2),(266,102,3),(267,103,1),(268,104,1),(270,105,1),(271,106,1),(272,106,2),(273,100,1),(274,100,3),(276,108,1),(277,108,2),(278,108,3),(281,99,1),(282,99,2),(283,109,2),(284,109,1),(289,2,1),(290,2,2),(291,2,3),(294,3,6),(295,3,5),(296,3,9),(298,4,1),(299,4,2),(300,4,3),(301,4,5),(307,6,1),(308,6,2),(309,6,3),(310,6,5),(311,5,1),(312,5,1),(313,5,2),(316,7,2),(317,7,1);
/*!40000 ALTER TABLE `reportbehaviour` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reportpatients`
--

DROP TABLE IF EXISTS `reportpatients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reportpatients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reportpatients`
--

LOCK TABLES `reportpatients` WRITE;
/*!40000 ALTER TABLE `reportpatients` DISABLE KEYS */;
INSERT INTO `reportpatients` VALUES (1,'Report Page Top Banner','1470052013-hand1.png','2016-08-01 06:16:53','2016-08-01 06:19:32',NULL),(2,'Report Page Left Bar 1','1470052062-hand1.png','2016-08-01 06:17:42','2016-08-01 06:17:42',NULL),(3,'Report Page Left Bar 2','1470052132-hand1.png','2016-08-01 06:18:52','2016-08-01 06:18:52',NULL);
/*!40000 ALTER TABLE `reportpatients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reset_request`
--

DROP TABLE IF EXISTS `reset_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reset_request` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reset_request`
--

LOCK TABLES `reset_request` WRITE;
/*!40000 ALTER TABLE `reset_request` DISABLE KEYS */;
INSERT INTO `reset_request` VALUES (1,'Rick@gmail.com','991469778351','2016-07-29 02:15:51','2016-07-29 02:15:51'),(18,'lio@gmail.com','451470235058','2016-08-03 09:07:38','2016-08-03 09:07:38'),(23,'jit.unified@gmail.com','491470398785','2016-08-05 06:36:25','2016-08-05 06:36:25'),(33,'avishek.mallick1987@gmail.com','831470986386','2016-08-12 01:49:46','2016-08-12 01:49:46'),(38,'dipanjan@unifiedinfotech.net','361471010520','2016-08-12 08:32:00','2016-08-12 08:32:00'),(40,'dhiraj.unified@gmail.com','391471014296','2016-08-12 09:34:56','2016-08-12 09:34:56'),(41,'ayansil.com@gmail.com','471471016108','2016-08-12 10:05:08','2016-08-12 10:05:08');
/*!40000 ALTER TABLE `reset_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'Administrator','2016-05-16 08:02:12','2016-05-16 08:02:12'),(2,'User','2016-05-16 08:02:13','2016-05-16 08:02:13'),(3,'Site Admin','2016-06-30 03:49:45','2016-06-30 03:49:45');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sitesettings`
--

DROP TABLE IF EXISTS `sitesettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sitesettings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `admin_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_address` text COLLATE utf8_unicode_ci NOT NULL,
  `contact_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `search_null_msg` text COLLATE utf8_unicode_ci,
  `membership_pdf_link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `footer_disclaimer` text COLLATE utf8_unicode_ci,
  `email_subscribe` text COLLATE utf8_unicode_ci,
  `faq_header` text COLLATE utf8_unicode_ci,
  `service_header` text COLLATE utf8_unicode_ci,
  `get_in_touch` text COLLATE utf8_unicode_ci,
  `testimonial_header` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sitesettings`
--

LOCK TABLES `sitesettings` WRITE;
/*!40000 ALTER TABLE `sitesettings` DISABLE KEYS */;
INSERT INTO `sitesettings` VALUES (1,'1467711280-3.jpeg','info@patientscreennetwork.com','admin@psn.com','Chapel Hill, NC 27516','(919) 933-4567','This patient has not reported to this system, it indicates this patient is a good patient.','1470183903-Agreement Sample.pdf','Patient Screen Network LLC..','You are welcome to subscribe latest news about our services and products.','Printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy \r\ntext ever since the 1500s, when an been the industry\'s standard dummy text ever since the 1500s, when an','Printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy \r\ntext ever since the 1500s, when an been the industry\'s standard dummy text ever since the 1500s, when an','We\'re here to answer your questions and provide support in any way we can. We want to help you achieve economic success and financial security through our services. You can reach us in any of the following ways:','What 100% real people say About Us','2016-07-05 03:43:49','2016-08-12 03:21:13',NULL);
/*!40000 ALTER TABLE `sitesettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sliderimages`
--

DROP TABLE IF EXISTS `sliderimages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sliderimages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `img_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `img_desc` text COLLATE utf8_unicode_ci,
  `img_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sliderimages`
--

LOCK TABLES `sliderimages` WRITE;
/*!40000 ALTER TABLE `sliderimages` DISABLE KEYS */;
INSERT INTO `sliderimages` VALUES (1,'Slider 1',NULL,'1467633141-2.jpeg','2016-07-04 06:21:14','2016-07-22 00:55:22','2016-07-22 00:55:22'),(2,'slider23','Testing','1469192592-imgpsh_fullsize.jpg','2016-07-22 00:57:47','2016-07-28 04:28:48','2016-07-28 04:28:48'),(3,'yui','Testing','1469192608-imgpsh_fullsize (1).jpg','2016-07-22 00:58:06','2016-07-28 04:28:44','2016-07-28 04:28:44'),(4,'Hi','testinger','1469173880-logo.png','2016-07-22 02:00:10','2016-07-22 02:21:28','2016-07-22 02:21:28'),(5,'Finding trustworthy patients is hard – PSN is here to help.','The Patient Screen Network (PSN) is a resource for medical practices of all kinds.','1469701439-banner-01.jpg','2016-07-28 04:39:45','2016-07-28 04:54:14','2016-07-28 04:54:14'),(6,'PSN can save you thousands of dollars.','Avoid drug-seekers, unpaid bills, lost man-hours, and unsatisfactory attempts to recover fees with expensive collection agencies.','1469700979-banner-03.jpg','2016-07-28 04:46:19','2016-07-28 04:47:24','2016-07-28 04:47:24'),(7,'PSN can save you thousands of dollars.','Avoid drug-seekers, unpaid bills, lost man-hours, and unsatisfactory attempts to recover fees with expensive collection agencies.','1469700995-banner-03.jpg','2016-07-28 04:46:35','2016-07-28 04:47:30','2016-07-28 04:47:30'),(8,'PSN can save you thousands of dollars.','Avoid drug-seekers, unpaid bills, lost man-hours, and unsatisfactory attempts to recover fees with expensive collection agencies.','1469701014-banner-03.jpg','2016-07-28 04:46:54','2016-07-28 04:54:21','2016-07-28 04:54:21'),(9,'PSN can save you thousands of dollars.','Avoid drug-seekers, unpaid bills, lost man-hours, and unsatisfactory attempts to recover fees with expensive collection agencies.','1469701031-banner-03.jpg','2016-07-28 04:47:11','2016-07-28 04:48:48','2016-07-28 04:48:48'),(10,'banner2','sss','1469701252-banner-02.jpg','2016-07-28 04:50:53','2016-07-28 04:54:21','2016-07-28 04:54:21'),(11,'banner1','sss','1469701268-banner-01.jpg','2016-07-28 04:51:08','2016-07-28 04:54:21','2016-07-28 04:54:21'),(12,'Finding trustworthy patients is hard – PSN is here to help.','The Patient Screen Network (PSN) is a resource for medical practices of all kinds.','1470825931-1469192608-imgpsh_fullsize (1).jpg','2016-07-28 04:54:45','2016-08-10 05:15:31',NULL),(13,'Protect your practice with real-time searches of your patients’ reputation before you provide service.','Get the knowledge you need now.','1469701518-banner-02.jpg','2016-07-28 04:55:18','2016-07-28 04:55:18',NULL),(14,'PSN can save you thousands of dollars.','Avoid drug-seekers, unpaid bills, lost man-hours, and unsatisfactory attempts to recover fees with expensive collection agencies.','1469701574-banner-03.jpg','2016-07-28 04:56:14','2016-07-28 04:56:14',NULL),(15,'Help other practices avoid similar problems by reporting your own non-compliant patients on the network.','','1471006499-banner-04.jpg','2016-07-28 04:56:43','2016-08-12 07:24:59',NULL);
/*!40000 ALTER TABLE `sliderimages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stories`
--

DROP TABLE IF EXISTS `stories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `story_content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stories`
--

LOCK TABLES `stories` WRITE;
/*!40000 ALTER TABLE `stories` DISABLE KEYS */;
INSERT INTO `stories` VALUES (1,'<p><strong>Medical practices of all kinds are held to the strictest standards, and failing to meet those standards can result in serious consequences. </strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>But what about the standards for patients? </strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Doctors know from experience that while the vast majority of their clients are exemplary, paying their bills on time, showing up to appointments, and otherwise displaying perfect behavior, some patients do not live up to these standards and lose the practice money from uncollected medical bills and wasted man-hours. In some cases, patients can even be a liability as they may be combative or drug-seeking. </strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Arguing with such patients after the fact rarely works due to the threat of negative online reviews that could undeservedly damage a doctor&rsquo;s reputation and business. Debt collection services are expensive and ineffective, leaving doctors with little recourse, until now.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>PSN is the better alternative by giving medical practitioners the ability to research patients before they become a problem that costs the practice money. </strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>Using a simple online database, you can search the names of potential patients and learn whether they have caused problems at previous clinics. A prior report with PSN will alert you to this fact and allow you to make an informed decision about working with the patient, such as by requiring full-payment up-front, or in extreme cases, by choosing not to include them among your clientele.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>In addition, if you experience problems with a patient, you can report the exact nature of those issues with PSN. This information will be used by other practices in your area to ensure they do not receive the same negative treatment by that patient.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>It&rsquo;s your practice and you have the right to know your clients<!-- On the demo site, the “Story” page includes a timeline. I wasn’t sure what you wanted to show on this timeline. We can discuss the details during our meeting on Monday. -->. Get started with a free 3-month PSN membership<!-- Hyperlink to the membership page. --> to see for yourself how more patient information can save you big money.</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n','2016-07-08 03:53:30','2016-08-12 01:06:45',NULL);
/*!40000 ALTER TABLE `stories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testimonials`
--

DROP TABLE IF EXISTS `testimonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testimonials` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testimonials`
--

LOCK TABLES `testimonials` WRITE;
/*!40000 ALTER TABLE `testimonials` DISABLE KEYS */;
INSERT INTO `testimonials` VALUES (1,'1470993857-memot1024.jpg','Thomson, USA','I was talking to a woman that said she left her dentist two years ago. I asked why and she said she had $1,500 worth of work that was done and it turns out insurance didn\'t cover it...\r\nso she left and found a new dentist.','2016-08-01 04:22:46','2016-08-12 03:59:29','2016-08-12 03:59:29'),(2,'1470045209-hand1.png','Thomson, USA','PSN is designed to ensure this never happens again. A patient can be reported for failure to pay their medical bills, and this information can be found in the database by other practices.','2016-08-01 04:23:29','2016-08-01 04:23:29',NULL),(3,'1470825540-hand.png','fgfd','gdfg','2016-08-10 05:09:00','2016-08-10 05:09:00',NULL),(4,'1470981955-407.jpg','gdf','gdgfg','2016-08-12 00:35:55','2016-08-12 00:36:00','2016-08-12 00:36:00'),(5,'1470994028-2fd64ba5b2ee3f98a89667a048498a67-2.gif','fdsf','fdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsf\r\n\r\nfdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsffdsf','2016-08-12 03:57:08','2016-08-12 03:59:26','2016-08-12 03:59:26'),(6,'1470994951-dhiraj.png','Dhiraj','Testing  lifecycle','2016-08-12 04:12:32','2016-08-12 04:12:58',NULL),(7,'1470995002-2fd64ba5b2ee3f98a89667a048498a67.jpg','fdsf','fd','2016-08-12 04:13:22','2016-08-12 04:13:45','2016-08-12 04:13:45');
/*!40000 ALTER TABLE `testimonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0=>inactive 1=>active',
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `forgot_password_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,'Admin','','','admin@gmail.com','$2y$10$ecJvaKfRSqE7j2F7FkiiKO82UdnGvUaS3Bu2PE91DROBgqLo/oyBq','9ujqBhyRZ9ZbZvAcgMs3iLvjRZ9I2olCP0NaonsmMaVME9OPN0e5k2cgeZgC',1,'','',NULL,'2016-08-05 05:00:08'),(2,2,'Jit Dhar','Jit','Dhar','jit@unifiedinfotech.net','$2y$10$38D34fab0qQsRNUOzdtGx.TMU9o8A8N8LzxEA54NE58Kaxh.ckBKC','0V5MUOrKzaKG5aOdtpqAfZzpwkMUa1Xp9Y99PiN03ALiXzjaU138Js6v5HAq',1,'','','2016-06-28 03:58:39','2016-06-30 03:55:31'),(3,3,'Admin','','','admin123@gmail.com','$2y$10$sy11v/Ci61P4BKBEZsrw8udj8xNxYBrMf6fKPMiEkypJ7t9x1YnYi','TbFxCf8N7CqUwfydxLEfgz5H7WwuD8RfKDux9Nw1wDwmG4EoDauvboRCNu84',1,'','',NULL,'2016-08-17 10:28:47'),(4,2,'Saikat Dhar','Saikat','Dhar','testmeweb@gmail.com','$2y$10$o4W7BEiBDN0aZnPt7PfO2.PLUqZmYrhLsazW0jgLkxGCQFC0TNn0K',NULL,1,'','','2016-06-30 04:12:48','2016-06-30 04:12:48'),(5,2,'Jit Dhar','Jit','Dhar','jit@gmail.com','$2y$10$.cjMKDsIBka3nmA5YpgszeBB1P8pR0DepaK5r055Nlc2lQ43RbmD.',NULL,1,'','','2016-07-04 07:40:53','2016-07-04 07:40:53'),(6,2,'Jit Dhar','Jit','Dhar','jit.109028@gmail.com','$2y$10$vGoDNH3kRgB5EiGR/bfj0OApU9dZfKGafoejzBzeEHCwCeoWG4kzG','YjtARht2CHCUoQgEB7Hze4pBPOto4MFRbtdhzroq8lYA8FMLCh26m8OOThtc',1,'','','2016-07-05 00:13:12','2016-07-05 00:38:11'),(7,2,'jit dhar','jit','dhar','jit123@gmail.com','$2y$10$AKD3vPspY4BBZQNh2SaaGu39RrdGbnJzSUhiTWNCsHEBR/jaTj1LS',NULL,1,'','','2016-07-06 23:16:40','2016-07-06 23:16:40');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_logs`
--

DROP TABLE IF EXISTS `users_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action_model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_logs`
--

LOCK TABLES `users_logs` WRITE;
/*!40000 ALTER TABLE `users_logs` DISABLE KEYS */;
INSERT INTO `users_logs` VALUES (1,3,'deleted','customers',1,'2016-08-12 04:57:08','2016-08-12 04:57:08'),(2,3,'updated','customers',2,'2016-08-12 05:00:43','2016-08-12 05:00:43'),(3,3,'updated','businesses',5,'2016-08-12 05:01:22','2016-08-12 05:01:22'),(4,3,'deleted','businesses',5,'2016-08-12 05:01:29','2016-08-12 05:01:29'),(5,3,'updated','customers',2,'2016-08-12 05:02:02','2016-08-12 05:02:02'),(6,3,'created','customers',3,'2016-08-12 05:05:22','2016-08-12 05:05:22'),(7,3,'updated','packageimages',1,'2016-08-12 05:24:14','2016-08-12 05:24:14'),(8,3,'updated','dashboardimages',2,'2016-08-12 05:25:39','2016-08-12 05:25:39'),(9,3,'updated','dashboardimages',2,'2016-08-12 05:25:51','2016-08-12 05:25:51'),(10,3,'updated','dashboardimages',1,'2016-08-12 05:25:58','2016-08-12 05:25:58'),(11,3,'updated','dashboardimages',2,'2016-08-12 05:28:10','2016-08-12 05:28:10'),(12,3,'updated','dashboardimages',3,'2016-08-12 05:28:16','2016-08-12 05:28:16'),(13,3,'deleted','businesses',6,'2016-08-12 05:29:21','2016-08-12 05:29:21'),(14,3,'deleted','businesses',7,'2016-08-12 05:29:21','2016-08-12 05:29:21'),(15,3,'deleted','businesses',8,'2016-08-12 05:29:21','2016-08-12 05:29:21'),(16,3,'deleted','businesses',9,'2016-08-12 05:29:21','2016-08-12 05:29:21'),(17,3,'deleted','businesses',10,'2016-08-12 05:29:22','2016-08-12 05:29:22'),(18,3,'deleted','businesses',11,'2016-08-12 05:29:22','2016-08-12 05:29:22'),(19,3,'deleted','businesses',3,'2016-08-12 05:29:26','2016-08-12 05:29:26'),(20,3,'updated','memberships',3,'2016-08-12 05:40:13','2016-08-12 05:40:13'),(21,3,'updated','memberships',3,'2016-08-12 05:40:20','2016-08-12 05:40:20'),(22,3,'created','memberships',6,'2016-08-12 05:40:32','2016-08-12 05:40:32'),(23,3,'deleted','memberships',6,'2016-08-12 05:41:17','2016-08-12 05:41:17'),(24,3,'created','paymentreport',1,'2016-08-12 05:42:19','2016-08-12 05:42:19'),(25,3,'deleted','paymentreport',1,'2016-08-12 06:02:10','2016-08-12 06:02:10'),(26,3,'updated','contactuspage',4,'2016-08-12 06:10:47','2016-08-12 06:10:47'),(27,3,'updated','contactuspage',4,'2016-08-12 06:11:18','2016-08-12 06:11:18'),(28,3,'updated','memberships',5,'2016-08-12 06:28:59','2016-08-12 06:28:59'),(29,3,'updated','memberships',5,'2016-08-12 06:29:29','2016-08-12 06:29:29'),(30,3,'updated','memberships',5,'2016-08-12 06:30:25','2016-08-12 06:30:25'),(31,3,'updated','memberships',5,'2016-08-12 06:30:48','2016-08-12 06:30:48'),(32,3,'updated','memberships',5,'2016-08-12 06:30:56','2016-08-12 06:30:56'),(33,3,'updated','memberships',5,'2016-08-12 06:31:08','2016-08-12 06:31:08'),(34,3,'updated','memberships',5,'2016-08-12 06:31:18','2016-08-12 06:31:18'),(35,3,'updated','memberships',5,'2016-08-12 06:31:28','2016-08-12 06:31:28'),(36,3,'updated','memberships',5,'2016-08-12 06:31:42','2016-08-12 06:31:42'),(37,3,'updated','memberships',5,'2016-08-12 06:33:13','2016-08-12 06:33:13'),(38,3,'updated','memberships',5,'2016-08-12 06:33:22','2016-08-12 06:33:22'),(39,3,'updated','memberships',5,'2016-08-12 06:34:50','2016-08-12 06:34:50'),(40,3,'deleted','paymentreport',4,'2016-08-12 06:47:19','2016-08-12 06:47:19'),(41,3,'deleted','paymentreport',5,'2016-08-12 06:47:34','2016-08-12 06:47:34'),(42,3,'deleted','paymentreport',6,'2016-08-12 06:48:07','2016-08-12 06:48:07'),(43,3,'updated','sliderimages',15,'2016-08-12 07:24:59','2016-08-12 07:24:59'),(44,3,'updated','behaviorlists',9,'2016-08-12 07:40:18','2016-08-12 07:40:18'),(45,3,'deleted','paymentreport',8,'2016-08-12 08:57:19','2016-08-12 08:57:19'),(46,3,'deleted','paymentreport',9,'2016-08-12 08:57:19','2016-08-12 08:57:19'),(47,3,'updated','customers',7,'2016-08-12 09:04:43','2016-08-12 09:04:43'),(48,3,'updated','dashboardimages',2,'2016-08-12 09:14:52','2016-08-12 09:14:52'),(49,3,'updated','dashboardimages',2,'2016-08-12 09:14:59','2016-08-12 09:14:59'),(50,3,'updated','behaviorlists',9,'2016-08-12 09:44:31','2016-08-12 09:44:31'),(51,3,'deleted','customers',10,'2016-08-12 10:15:31','2016-08-12 10:15:31'),(52,3,'updated','customers',11,'2016-08-12 10:17:34','2016-08-12 10:17:34'),(53,3,'updated','dashboardimages',2,'2016-08-12 10:31:14','2016-08-12 10:31:14'),(54,3,'updated','dashboardimages',2,'2016-08-12 10:32:10','2016-08-12 10:32:10'),(55,3,'deleted','customers',2,'2016-08-12 10:33:56','2016-08-12 10:33:56'),(56,3,'deleted','customers',12,'2016-08-12 10:38:09','2016-08-12 10:38:09'),(57,3,'updated','users',3,'2016-08-17 10:28:47','2016-08-17 10:28:47');
/*!40000 ALTER TABLE `users_logs` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-19 13:12:50
