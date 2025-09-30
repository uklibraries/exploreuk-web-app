/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.14-MariaDB, for debian-linux-gnu (aarch64)
--
-- Host: localhost    Database: omeka
-- ------------------------------------------------------
-- Server version	10.11.14-MariaDB-ubu2204

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `omeka_admin_images`
--

DROP TABLE IF EXISTS `omeka_admin_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_admin_images` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` mediumtext DEFAULT NULL,
  `alt` mediumtext DEFAULT NULL,
  `href` mediumtext DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_admin_images`
--

LOCK TABLES `omeka_admin_images` WRITE;
/*!40000 ALTER TABLE `omeka_admin_images` DISABLE KEYS */;
INSERT INTO `omeka_admin_images` VALUES
(2,'From the Jim Curtis photograph collection on Civil Rights in Kentucky','','/catalog/xt7gqn5z7t3j_8_1',6,1),
(3,'From the James Edwin Weddle Photographic Collection','','/catalog/xt734t6f3d29_4066_1',7,1),
(4,'From the Asa C. Chinn Downtown Lexington, Kentucky Photographic Collection','','/catalog/xt7qrf5kb01p_1_184',8,1);
/*!40000 ALTER TABLE `omeka_admin_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_collections`
--

DROP TABLE IF EXISTS `omeka_collections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_collections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `public` tinyint(4) NOT NULL,
  `featured` tinyint(4) NOT NULL,
  `added` timestamp NOT NULL DEFAULT '2000-01-01 00:00:00',
  `modified` timestamp NOT NULL DEFAULT '2000-01-01 00:00:00',
  `owner_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `public` (`public`),
  KEY `featured` (`featured`),
  KEY `owner_id` (`owner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_collections`
--

LOCK TABLES `omeka_collections` WRITE;
/*!40000 ALTER TABLE `omeka_collections` DISABLE KEYS */;
INSERT INTO `omeka_collections` VALUES
(1,1,0,'2018-07-17 13:21:57','2018-07-17 13:21:57',1),
(2,1,0,'2018-07-17 13:38:11','2018-07-17 13:38:11',1),
(3,1,0,'2018-07-17 13:38:22','2018-07-17 13:38:22',1);
/*!40000 ALTER TABLE `omeka_collections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_element_sets`
--

DROP TABLE IF EXISTS `omeka_element_sets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_element_sets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_type` varchar(50) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `record_type` (`record_type`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_element_sets`
--

LOCK TABLES `omeka_element_sets` WRITE;
/*!40000 ALTER TABLE `omeka_element_sets` DISABLE KEYS */;
INSERT INTO `omeka_element_sets` VALUES
(1,NULL,'Dublin Core','The Dublin Core metadata element set is common to all Omeka records, including items, files, and collections. For more information see, http://dublincore.org/documents/dces/.'),
(3,'Item','Item Type Metadata','The item type metadata element set, consisting of all item type elements bundled with Omeka and all item type elements created by an administrator.');
/*!40000 ALTER TABLE `omeka_element_sets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_element_texts`
--

DROP TABLE IF EXISTS `omeka_element_texts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_element_texts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(10) unsigned NOT NULL,
  `record_type` varchar(50) NOT NULL,
  `element_id` int(10) unsigned NOT NULL,
  `html` tinyint(4) NOT NULL,
  `text` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `record_type_record_id` (`record_type`,`record_id`),
  KEY `element_id` (`element_id`),
  KEY `text` (`text`(20))
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_element_texts`
--

LOCK TABLES `omeka_element_texts` WRITE;
/*!40000 ALTER TABLE `omeka_element_texts` DISABLE KEYS */;
INSERT INTO `omeka_element_texts` VALUES
(1,1,'Item',50,0,'From the Jim Curtis photograph collection on Civil Rights in Kentucky'),
(2,1,'Item',46,0,'/catalog/xt7gqn5z7t3j_8_1'),
(3,1,'Collection',50,0,'Background image rotation'),
(4,2,'Item',50,0,'From the James Edwin Weddle Photographic Collection'),
(5,2,'Item',46,0,'/catalog/xt734t6f3d29_4066_1'),
(6,3,'Item',50,0,'From the Asa C. Chinn Downtown Lexington, Kentucky Photographic Collection'),
(7,3,'Item',46,0,'/catalog/xt7qrf5kb01p_1_184'),
(8,2,'Collection',50,0,'Popular Resources'),
(9,3,'Collection',50,0,'Additional Resources'),
(10,4,'Item',50,0,'Collection Guides'),
(11,4,'Item',46,0,'/?f%5Bformat%5D%5B%5D=collections'),
(12,5,'Item',50,0,'Photos'),
(13,5,'Item',46,0,'/?f%5Bformat%5D%5B%5D=images'),
(14,6,'Item',50,0,'UK Yearbooks'),
(15,6,'Item',46,0,'/?f%5Bformat%5D%5B%5D=yearbooks'),
(16,7,'Item',50,0,'Maps'),
(17,7,'Item',46,0,'/?f%5Bformat%5D%5B%5D=maps'),
(18,8,'Item',50,0,'Books'),
(19,8,'Item',46,0,'/?f%5Bformat%5D%5B%5D=books'),
(20,9,'Item',50,0,'UK Athletic Publications'),
(21,9,'Item',46,0,'/?f%5Bformat%5D%5B%5D=athletic+publications'),
(22,10,'Item',50,0,'UK Board of Trustees Minutes'),
(23,10,'Item',46,0,'/catalog?f[source_s][]=Minutes%20of%20the%20University%20of%20Kentucky%20Board%20of%20Trustees'),
(24,11,'Item',50,0,'WPA Publications'),
(25,11,'Item',46,0,'/catalog/?q=%22Works+Progress+Administration+Publications%22'),
(26,12,'Item',50,0,'UK Course Catalogs'),
(27,12,'Item',46,0,'/?f%5Bformat%5D%5B%5D=course+catalogs'),
(28,13,'Item',50,0,'Kentucky Kernel'),
(29,13,'Item',46,0,'/catalog?f[source_s][]=The%20Kentucky%20Kernel'),
(32,15,'Item',50,0,'Louie B. Nunn Center for Oral History'),
(33,15,'Item',46,0,'https://kentuckyoralhistory.org/'),
(34,16,'Item',50,0,'Notable Kentucky African Americans Database'),
(35,16,'Item',46,0,'https://nkaa.uky.edu/nkaa/'),
(38,18,'Item',50,0,'University of Kentucky Libraries Microfilm Holdings database'),
(39,18,'Item',46,0,'https://ukmfilms.omeka.net/'),
(40,19,'Item',50,0,'Kentucky Digital Newspaper Program'),
(41,19,'Item',46,0,'https://kentuckynewspapers.org/'),
(42,20,'Item',50,0,'The Lomax Kentucky Recordings'),
(43,20,'Item',46,0,'https://lomaxky.omeka.net/'),
(48,23,'Item',50,0,'Fog in Mountain Valleys, Knott County, from the Karl Raitz Kentucky slides collection'),
(49,23,'Item',46,0,'https://exploreuk.uky.edu/catalog/xt7g4f1mkk62_331_1'),
(50,24,'Item',50,0,'Miners leaving a mine entrance in a cart with police watching, 1939, from the Harlan County Mine Strike Photographic Collection.'),
(51,24,'Item',46,0,'https://exploreuk.uky.edu/catalog/xt75tb0xq06w_1_9'),
(52,25,'Item',50,0,'J.T. Denton; dog jumping over stick, 1935, from the Lafayette Studios photographs: 1930s decade'),
(53,25,'Item',46,0,'https://exploreuk.uky.edu/catalog/xt702v2c8t1s_2858_1'),
(56,27,'Item',50,0,'Protest in downtown Lexington, 1968, from the Alexandra Soteriou photographs'),
(57,27,'Item',46,0,'https://exploreuk.uky.edu/catalog/xt7q2b8vck34_53_107'),
(58,28,'Item',50,0,'George du Maurier envelope to Ivy, 1899, from the W. Hugh Peal manuscript collection\r\n'),
(59,28,'Item',46,0,'https://exploreuk.uky.edu/catalog/xt7qjq0stw34_1083_1'),
(60,29,'Item',50,0,'Photobooth image set, undated, from the Cowherd family photographs'),
(61,29,'Item',46,0,'https://exploreuk.uky.edu/catalog/xt7nk9315j37_13_1'),
(62,30,'Item',50,0,'Horses racing past the Keeneland topiary from the James Edwin Weddle Photographic Collection '),
(63,30,'Item',46,0,'https://exploreuk.uky.edu/catalog/xt734t6f3d29_2066_1?q=Thoroughbred+Racing%3B+Race+Scenes%3B+Horses+racing+past+the+Keeneland+topiary&per_page=20'),
(66,32,'Item',50,0,'A page from Ikebana hayamanabi, 1835'),
(67,32,'Item',46,0,'https://exploreuk.uky.edu/catalog/xt7msb3wwt9f_13?q=Ikebana+hayamanabi&per_page=20#page/13/mode/1up/search/Ikebana+hayamanabi'),
(72,37,'Item',50,0,'Lexington Herald-Leader photographs'),
(73,37,'Item',46,0,'https://lhlphotoarchive.org/\r\n'),
(74,4,'Item',43,0,'01000'),
(75,5,'Item',43,0,'02000'),
(76,6,'Item',43,0,'03000'),
(77,7,'Item',43,0,'04000'),
(78,8,'Item',43,0,'05000'),
(79,9,'Item',43,0,'06000'),
(80,10,'Item',43,0,'07000'),
(81,11,'Item',43,0,'08000'),
(82,12,'Item',43,0,'09000'),
(83,13,'Item',43,0,'10000'),
(84,15,'Item',43,0,'01000'),
(85,16,'Item',43,0,'02000'),
(86,37,'Item',43,0,'03000'),
(87,18,'Item',43,0,'04000'),
(88,19,'Item',43,0,'05000'),
(89,20,'Item',43,0,'06000'),
(93,46,'Item',50,0,'The John G. Heyburn II Initiative for Excellence in the Federal Judiciary'),
(94,46,'Item',46,0,'https://heyburncollections.org/'),
(95,46,'Item',43,0,'07000'),
(96,47,'Item',50,0,'Special Collections Research Center Online Exhibits'),
(97,47,'Item',46,0,'https://ukyscrcexhibits.omeka.net/exhibits'),
(98,47,'Item',43,0,'08000'),
(99,48,'Item',50,0,'The University of Kentucky Libraries Web Archives'),
(100,48,'Item',46,0,'https://archive-it.org/organizations/915'),
(101,48,'Item',43,0,'09000'),
(102,49,'Item',50,0,'Kentucky Alumnus'),
(103,49,'Item',46,0,'/?f%5Bsource_s%5D%5B%5D=Kentucky+alumnus'),
(104,49,'Item',43,0,'11000'),
(105,50,'Item',50,0,'Lexington City Directories'),
(106,50,'Item',46,0,'/?f%5Bsource_s%5D%5B%5D=Lexington+City+Directories'),
(107,50,'Item',43,0,'12000');
/*!40000 ALTER TABLE `omeka_element_texts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_elements`
--

DROP TABLE IF EXISTS `omeka_elements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_elements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `element_set_id` int(10) unsigned NOT NULL,
  `order` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `comment` mediumtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_element_set_id` (`element_set_id`,`name`),
  UNIQUE KEY `order_element_set_id` (`element_set_id`,`order`),
  KEY `element_set_id` (`element_set_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_elements`
--

LOCK TABLES `omeka_elements` WRITE;
/*!40000 ALTER TABLE `omeka_elements` DISABLE KEYS */;
INSERT INTO `omeka_elements` VALUES
(1,3,NULL,'Text','Any textual data included in the document',NULL),
(2,3,NULL,'Interviewer','The person(s) performing the interview',NULL),
(3,3,NULL,'Interviewee','The person(s) being interviewed',NULL),
(4,3,NULL,'Location','The location of the interview',NULL),
(5,3,NULL,'Transcription','Any written text transcribed from a sound',NULL),
(6,3,NULL,'Local URL','The URL of the local directory containing all assets of the website',NULL),
(7,3,NULL,'Original Format','The type of object, such as painting, sculpture, paper, photo, and additional data',NULL),
(10,3,NULL,'Physical Dimensions','The actual physical size of the original image',NULL),
(11,3,NULL,'Duration','Length of time involved (seconds, minutes, hours, days, class periods, etc.)',NULL),
(12,3,NULL,'Compression','Type/rate of compression for moving image file (i.e. MPEG-4)',NULL),
(13,3,NULL,'Producer','Name (or names) of the person who produced the video',NULL),
(14,3,NULL,'Director','Name (or names) of the person who produced the video',NULL),
(15,3,NULL,'Bit Rate/Frequency','Rate at which bits are transferred (i.e. 96 kbit/s would be FM quality audio)',NULL),
(16,3,NULL,'Time Summary','A summary of an interview given for different time stamps throughout the interview',NULL),
(17,3,NULL,'Email Body','The main body of the email, including all replied and forwarded text and headers',NULL),
(18,3,NULL,'Subject Line','The content of the subject line of the email',NULL),
(19,3,NULL,'From','The name and email address of the person sending the email',NULL),
(20,3,NULL,'To','The name(s) and email address(es) of the person to whom the email was sent',NULL),
(21,3,NULL,'CC','The name(s) and email address(es) of the person to whom the email was carbon copied',NULL),
(22,3,NULL,'BCC','The name(s) and email address(es) of the person to whom the email was blind carbon copied',NULL),
(23,3,NULL,'Number of Attachments','The number of attachments to the email',NULL),
(24,3,NULL,'Standards','',NULL),
(25,3,NULL,'Objectives','',NULL),
(26,3,NULL,'Materials','',NULL),
(27,3,NULL,'Lesson Plan Text','',NULL),
(28,3,NULL,'URL','',NULL),
(29,3,NULL,'Event Type','',NULL),
(30,3,NULL,'Participants','Names of individuals or groups participating in the event',NULL),
(31,3,NULL,'Birth Date','',NULL),
(32,3,NULL,'Birthplace','',NULL),
(33,3,NULL,'Death Date','',NULL),
(34,3,NULL,'Occupation','',NULL),
(35,3,NULL,'Biographical Text','',NULL),
(36,3,NULL,'Bibliography','',NULL),
(37,1,8,'Contributor','An entity responsible for making contributions to the resource',NULL),
(38,1,15,'Coverage','The spatial or temporal topic of the resource, the spatial applicability of the resource, or the jurisdiction under which the resource is relevant',NULL),
(39,1,4,'Creator','An entity primarily responsible for making the resource',NULL),
(40,1,7,'Date','A point or period of time associated with an event in the lifecycle of the resource',NULL),
(41,1,3,'Description','An account of the resource',NULL),
(42,1,11,'Format','The file format, physical medium, or dimensions of the resource',NULL),
(43,1,14,'Identifier','An unambiguous reference to the resource within a given context',NULL),
(44,1,12,'Language','A language of the resource',NULL),
(45,1,6,'Publisher','An entity responsible for making the resource available',NULL),
(46,1,10,'Relation','A related resource',NULL),
(47,1,9,'Rights','Information about rights held in and over the resource',NULL),
(48,1,5,'Source','A related resource from which the described resource is derived',NULL),
(49,1,2,'Subject','The topic of the resource',NULL),
(50,1,1,'Title','A name given to the resource',NULL),
(51,1,13,'Type','The nature or genre of the resource',NULL);
/*!40000 ALTER TABLE `omeka_elements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_files`
--

DROP TABLE IF EXISTS `omeka_files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `order` int(10) unsigned DEFAULT NULL,
  `size` bigint(20) unsigned NOT NULL,
  `has_derivative_image` tinyint(1) NOT NULL,
  `authentication` char(32) DEFAULT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `type_os` varchar(255) DEFAULT NULL,
  `filename` mediumtext NOT NULL,
  `original_filename` mediumtext NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added` timestamp NOT NULL DEFAULT '2000-01-01 00:00:00',
  `stored` tinyint(1) NOT NULL DEFAULT 0,
  `metadata` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_files`
--

LOCK TABLES `omeka_files` WRITE;
/*!40000 ALTER TABLE `omeka_files` DISABLE KEYS */;
INSERT INTO `omeka_files` VALUES
(2,0,NULL,250018,1,'b73828983b522c5b2a8f22301631df33','image/jpeg','JPEG image data, JFIF standard 1.01','91a2b4125f4e92fb869e03b7bf2dd96f.jpg','2013av023_008_bg.jpg','2018-07-11 17:54:16','2018-07-11 17:54:14',1,'0'),
(3,0,NULL,6728,1,'d0bdc12d67ffa0fa9211c29b760c6c57','image/jpeg','JPEG image data, JFIF standard 1.01','3f95f40023077a163706783b34f75b43.jpg','atheme.jpg','2018-07-11 19:35:15','2018-07-11 19:35:14',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":380,\"resolution_y\":380,\"compression_ratio\":0.015530932594645},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"3f95f40023077a163706783b34f75b43.jpg\",\"FileDateTime\":1531337713,\"FileSize\":6728,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"380\\\" height=\\\"380\\\"\",\"Height\":380,\"Width\":380,\"IsColor\":1,\"ByteOrderMotorola\":0},\"IFD0\":{\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2},\"EXIF\":{\"ExifVersion\":210,\"FlashPixVersion\":100,\"ColorSpace\":65535}}}}'),
(4,0,NULL,250018,1,'b73828983b522c5b2a8f22301631df33','image/jpeg','JPEG image data, JFIF standard 1.01','3b8d320142a2ff7140884e5bd6d82e4c.jpg','2013av023_008_bg.jpg','2018-07-11 19:35:37','2018-07-11 19:35:35',1,'0'),
(5,0,NULL,6728,1,'d0bdc12d67ffa0fa9211c29b760c6c57','image/jpeg','JPEG image data, JFIF standard 1.01','14bb3f1fef88e878d1aaf43f2cb6619a.jpg','atheme.jpg','2018-07-11 19:52:25','2018-07-11 19:52:24',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":380,\"resolution_y\":380,\"compression_ratio\":0.015530932594645},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"14bb3f1fef88e878d1aaf43f2cb6619a.jpg\",\"FileDateTime\":1531338744,\"FileSize\":6728,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"380\\\" height=\\\"380\\\"\",\"Height\":380,\"Width\":380,\"IsColor\":1,\"ByteOrderMotorola\":0},\"IFD0\":{\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2},\"EXIF\":{\"ExifVersion\":210,\"FlashPixVersion\":100,\"ColorSpace\":65535}}}}'),
(6,0,NULL,250018,1,'b73828983b522c5b2a8f22301631df33','image/jpeg','JPEG image data, JFIF standard 1.01','3b480517a1344a252414634fd86fe62f.jpg','2013av023_008_bg.jpg','2018-07-11 19:53:52','2018-07-11 19:53:50',1,'0'),
(7,0,NULL,112420,1,'dc71a53438ca3d32035e7bd358377376','image/jpeg','JPEG image data, JFIF standard 1.01','f762e693cefdd679f628a50be2c514f7.jpg','cat.jpg','2018-07-16 17:58:16','2018-07-16 17:58:14',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":1200,\"resolution_y\":874,\"compression_ratio\":0.035729722857869}}'),
(8,0,NULL,132385,1,'24a228d0bdf032902db62897c6ceb543','image/jpeg','JPEG image data, JFIF standard 1.01','af07a739d32037d56e8d7ffe7ebfe3c4.jpg','96pa103_182.jpg','2018-07-16 18:05:22','2018-07-16 18:05:21',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":1200,\"resolution_y\":622,\"compression_ratio\":0.059121561271883}}'),
(9,1,NULL,250018,1,'b73828983b522c5b2a8f22301631df33','image/jpeg','JPEG image data, JFIF standard 1.01','99efff6ec95f03d1192df97f42f5eeff.jpg','2013av023_008_bg.jpg','2018-07-17 15:33:11','2018-07-17 13:20:57',1,'0'),
(10,2,1,112420,1,'dc71a53438ca3d32035e7bd358377376','image/jpeg','JPEG image data, JFIF standard 1.01','8c154f01d99755a5a15265f03d89e0ac.jpg','cat.jpg','2018-08-06 19:21:49','2018-07-17 13:23:46',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":1200,\"resolution_y\":874,\"compression_ratio\":0.035729722857869}}'),
(11,3,NULL,132385,1,'24a228d0bdf032902db62897c6ceb543','image/jpeg','JPEG image data, JFIF standard 1.01','5d50dc371a70eb1cec78fdc1c3e13893.jpg','96pa103_182.jpg','2018-07-17 14:02:59','2018-07-17 13:26:09',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":1200,\"resolution_y\":622,\"compression_ratio\":0.059121561271883}}'),
(24,2,2,12029,1,'c0948508ee6c41d47eda17c0cd68c7e0','image/png','PNG image data, 228 x 342, 8-bit/color RGBA, non-interlaced','adc814b9a99d5353a083270dbec7a5a9.png','images.png','2018-08-06 19:21:49','2018-07-17 15:32:32',1,'{\"mime_type\":\"image\\/png\",\"video\":{\"dataformat\":\"png\",\"lossless\":false,\"resolution_x\":228,\"resolution_y\":342,\"bits_per_sample\":32,\"compression_ratio\":0.038566353749872},\"comments\":{\"Comment\":[\"Created with GIMP\"]},\"comments_html\":{\"Comment\":[\"Created with GIMP\"]}}'),
(32,20,NULL,24250,1,'2f84d6869f139cc3231947701ec5f466','image/jpeg','JPEG image data, EXIF standard','76f7aba032653360c218560e2e21b8dd.JPG','lomax.JPG','2019-11-04 22:50:02','2018-07-17 19:55:15',1,'0'),
(34,15,NULL,31771,1,'2b2463b78bd8edb7b7a79c34c0f039fc','image/jpeg','JPEG image data, EXIF standard','64be58c95a884b047573bc4e94099ad3.JPG','nunn.JPG','2019-11-04 22:49:14','2018-07-18 12:27:11',1,'0'),
(45,4,NULL,26413,1,'9aa09324c52c677d62737c4951bf388d','image/jpeg','JPEG image data, EXIF standard','b06e483e0a8af6bb6abbdddf299699e8.jpg','collection_guide.jpg','2019-11-04 21:00:45','2018-08-01 16:59:57',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":228,\"resolution_y\":342,\"compression_ratio\":0.11291081016381109},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"b06e483e0a8af6bb6abbdddf299699e8.jpg\",\"FileDateTime\":1533128397,\"FileSize\":26413,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"228\\\" height=\\\"342\\\"\",\"Height\":342,\"Width\":228,\"IsColor\":1,\"ByteOrderMotorola\":1,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"Orientation\":1,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CC 2018 (Windows)\",\"DateTime\":\"2018:08:01 08:59:42\",\"Exif_IFD_Pointer\":168},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":306,\"JPEGInterchangeFormatLength\":3542},\"EXIF\":{\"ColorSpace\":65535,\"ExifImageWidth\":228,\"ExifImageLength\":342}}}}'),
(46,23,NULL,111500,1,'7416c5488a3fb7ab4ea08fdb0c2685f2','image/jpeg','JPEG image data, EXIF standard','979e13d2e66fe10086e737b284f21d1c.jpg','2014av021_1_14_331_519.jpg','2018-11-12 21:18:13','2018-08-01 17:40:36',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":1200,\"resolution_y\":791,\"compression_ratio\":0.039155780306222784},\"comments\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"],\"DateCreated\":[\"20150414\"],\"TimeCreated\":[\"125108+0000\"]}},\"comments_html\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"],\"DateCreated\":[\"20150414\"],\"TimeCreated\":[\"125108+0000\"]}},\"iptc\":{\"comments\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\\u0000\\u0000\"],\"DateCreated\":[\"20150414\"],\"TimeCreated\":[\"125108+0000\"]}},\"encoding\":\"ISO-8859-1\"},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"979e13d2e66fe10086e737b284f21d1c.jpg\",\"FileDateTime\":1533130836,\"FileSize\":111500,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"1200\\\" height=\\\"791\\\"\",\"Height\":791,\"Width\":1200,\"IsColor\":1,\"ByteOrderMotorola\":1,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"ImageWidth\":6690,\"ImageLength\":6690,\"BitsPerSample\":[8,8,8],\"PhotometricInterpretation\":2,\"Orientation\":1,\"SamplesPerPixel\":3,\"XResolution\":3180,\"YResolution\":3180,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CC 2018 (Windows)\",\"DateTime\":\"2018:08:01 09:36:22\",\"Exif_IFD_Pointer\":236},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":386,\"JPEGInterchangeFormatLength\":705},\"EXIF\":{\"ExifVersion\":221,\"ColorSpace\":65535,\"ExifImageWidth\":1200,\"ExifImageLength\":791}}}}'),
(47,10,NULL,43501,1,'d297f4e62de892baa757c878cdb07309','image/jpeg','JPEG image data, EXIF standard','31eb65724f8277ad73f1997a5dedc610.jpg','195369.jpg','2019-11-04 21:01:35','2018-08-06 18:09:23',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":228,\"resolution_y\":342,\"compression_ratio\":0.1859589275332581},\"comments\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"comments_html\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"iptc\":{\"comments\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\\u0000\\u0000\"]}},\"encoding\":\"ISO-8859-1\"},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"31eb65724f8277ad73f1997a5dedc610.jpg\",\"FileDateTime\":1533564563,\"FileSize\":43501,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"228\\\" height=\\\"342\\\"\",\"Height\":342,\"Width\":228,\"IsColor\":0,\"ByteOrderMotorola\":1,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"ImageWidth\":3047,\"ImageLength\":3592,\"BitsPerSample\":[8,8,8,8],\"PhotometricInterpretation\":1,\"Orientation\":1,\"SamplesPerPixel\":4,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CC 2018 (Windows)\",\"DateTime\":\"2018:08:06 10:08:26\",\"Exif_IFD_Pointer\":236},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":386,\"JPEGInterchangeFormatLength\":6758},\"EXIF\":{\"ExifVersion\":221,\"ColorSpace\":65535,\"ExifImageWidth\":228,\"ExifImageLength\":342}}}}'),
(51,6,NULL,42995,1,'2857b570ca122f63d6fe8691a253308d','image/jpeg','JPEG image data, EXIF standard','6abde349cd4aa9d03dcfc25af170ed69.jpg','0001 (4)small.jpg','2019-11-04 21:01:00','2018-08-06 18:38:36',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":228,\"resolution_y\":342,\"compression_ratio\":0.18379586881433604},\"comments\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"comments_html\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"iptc\":{\"comments\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\\u0000\\u0000\"]}},\"encoding\":\"ISO-8859-1\"},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"6abde349cd4aa9d03dcfc25af170ed69.jpg\",\"FileDateTime\":1533566315,\"FileSize\":42995,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"228\\\" height=\\\"342\\\"\",\"Height\":342,\"Width\":228,\"IsColor\":1,\"ByteOrderMotorola\":1,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"ImageWidth\":2692,\"ImageLength\":3774,\"BitsPerSample\":[8,8,8],\"PhotometricInterpretation\":2,\"Orientation\":1,\"SamplesPerPixel\":3,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CC 2018 (Windows)\",\"DateTime\":\"2018:08:06 10:37:57\",\"Exif_IFD_Pointer\":236},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":386,\"JPEGInterchangeFormatLength\":4763},\"EXIF\":{\"ExifVersion\":221,\"ColorSpace\":65535,\"ExifImageWidth\":228,\"ExifImageLength\":342}}}}'),
(52,7,NULL,42222,1,'ea5fb13a4355a9ef295784b34cad65c7','image/jpeg','JPEG image data, EXIF standard','95de02760d5f4f4c8853ccbb3a97dca6.jpg','fra_1890_001_small.jpg','2019-11-04 21:01:06','2018-08-06 18:47:32',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":228,\"resolution_y\":342,\"compression_ratio\":0.18049143326151637},\"comments\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"comments_html\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"iptc\":{\"comments\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\\u0000\\u0000\"]}},\"encoding\":\"ISO-8859-1\"},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"95de02760d5f4f4c8853ccbb3a97dca6.jpg\",\"FileDateTime\":1533566852,\"FileSize\":42222,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"228\\\" height=\\\"342\\\"\",\"Height\":342,\"Width\":228,\"IsColor\":1,\"ByteOrderMotorola\":1,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"ImageWidth\":6886,\"ImageLength\":8114,\"BitsPerSample\":[8,8,8],\"PhotometricInterpretation\":2,\"Orientation\":1,\"SamplesPerPixel\":3,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CC 2018 (Windows)\",\"DateTime\":\"2018:08:06 10:46:59\",\"Exif_IFD_Pointer\":236},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":386,\"JPEGInterchangeFormatLength\":5953},\"EXIF\":{\"ExifVersion\":221,\"ColorSpace\":65535,\"ExifImageWidth\":228,\"ExifImageLength\":342}}}}'),
(53,18,NULL,25227,1,'ef916415953f73ba069278a43687a169','image/jpeg','JPEG image data, EXIF standard','f3b8bc9800713719331ae0c30537a80e.JPG','microfilm.JPG','2019-11-04 22:49:31','2018-08-06 19:03:29',1,'0'),
(55,16,NULL,47588,1,'28d4c9d5d7cfbced16502a0a6096293b','image/png','PNG image data, 420 x 120, 8-bit/color RGB, non-interlaced','89077d4ac42c9dd68a454deebc80b3ab.png','NKAA_white.png','2019-11-04 22:49:20','2018-08-06 19:04:26',1,'{\"mime_type\":\"image\\/png\",\"video\":{\"dataformat\":\"png\",\"lossless\":false,\"resolution_x\":420,\"resolution_y\":120,\"bits_per_sample\":24,\"compression_ratio\":0.31473544973544976},\"comments\":{\"XML:com.adobe.xmp\":[\"<?xpacket begin=\\\"\\ufeff\\\" id=\\\"W5M0MpCehiHzreSzNTczkc9d\\\"?> <x:xmpmeta xmlns:x=\\\"adobe:ns:meta\\/\\\" x:xmptk=\\\"Adobe XMP Core 5.6-c142 79.160924, 2017\\/07\\/13-01:06:39        \\\"> <rdf:RDF xmlns:rdf=\\\"http:\\/\\/www.w3.org\\/1999\\/02\\/22-rdf-syntax-ns#\\\"> <rdf:Description rdf:about=\\\"\\\" xmlns:xmp=\\\"http:\\/\\/ns.adobe.com\\/xap\\/1.0\\/\\\" xmlns:dc=\\\"http:\\/\\/purl.org\\/dc\\/elements\\/1.1\\/\\\" xmlns:photoshop=\\\"http:\\/\\/ns.adobe.com\\/photoshop\\/1.0\\/\\\" xmlns:xmpMM=\\\"http:\\/\\/ns.adobe.com\\/xap\\/1.0\\/mm\\/\\\" xmlns:stEvt=\\\"http:\\/\\/ns.adobe.com\\/xap\\/1.0\\/sType\\/ResourceEvent#\\\" xmp:CreatorTool=\\\"Adobe Photoshop CC 2018 (Windows)\\\" xmp:CreateDate=\\\"2018-07-18T16:01:13-04:00\\\" xmp:ModifyDate=\\\"2018-07-18T16:05:22-04:00\\\" xmp:MetadataDate=\\\"2018-07-18T16:05:22-04:00\\\" dc:format=\\\"image\\/png\\\" photoshop:ColorMode=\\\"3\\\" photoshop:ICCProfile=\\\"sRGB IEC61966-2.1\\\" xmpMM:InstanceID=\\\"xmp.iid:2ee2905a-1661-224c-99ea-e8b42bd9064c\\\" xmpMM:DocumentID=\\\"xmp.did:2ee2905a-1661-224c-99ea-e8b42bd9064c\\\" xmpMM:OriginalDocumentID=\\\"xmp.did:2ee2905a-1661-224c-99ea-e8b42bd9064c\\\"> <xmpMM:History> <rdf:Seq> <rdf:li stEvt:action=\\\"created\\\" stEvt:instanceID=\\\"xmp.iid:2ee2905a-1661-224c-99ea-e8b42bd9064c\\\" stEvt:when=\\\"2018-07-18T16:01:13-04:00\\\" stEvt:softwareAgent=\\\"Adobe Photoshop CC 2018 (Windows)\\\"\\/> <\\/rdf:Seq> <\\/xmpMM:History> <\\/rdf:Description> <\\/rdf:RDF> <\\/x:xmpmeta> <?xpacket end=\\\"r\\\"?>\"]},\"comments_html\":{\"XML:com.adobe.xmp\":[\"&lt;?xpacket begin=&quot;&#65279;&quot; id=&quot;W5M0MpCehiHzreSzNTczkc9d&quot;?&gt; &lt;x:xmpmeta xmlns:x=&quot;adobe:ns:meta\\/&quot; x:xmptk=&quot;Adobe XMP Core 5.6-c142 79.160924, 2017\\/07\\/13-01:06:39        &quot;&gt; &lt;rdf:RDF xmlns:rdf=&quot;http:\\/\\/www.w3.org\\/1999\\/02\\/22-rdf-syntax-ns#&quot;&gt; &lt;rdf:Description rdf:about=&quot;&quot; xmlns:xmp=&quot;http:\\/\\/ns.adobe.com\\/xap\\/1.0\\/&quot; xmlns:dc=&quot;http:\\/\\/purl.org\\/dc\\/elements\\/1.1\\/&quot; xmlns:photoshop=&quot;http:\\/\\/ns.adobe.com\\/photoshop\\/1.0\\/&quot; xmlns:xmpMM=&quot;http:\\/\\/ns.adobe.com\\/xap\\/1.0\\/mm\\/&quot; xmlns:stEvt=&quot;http:\\/\\/ns.adobe.com\\/xap\\/1.0\\/sType\\/ResourceEvent#&quot; xmp:CreatorTool=&quot;Adobe Photoshop CC 2018 (Windows)&quot; xmp:CreateDate=&quot;2018-07-18T16:01:13-04:00&quot; xmp:ModifyDate=&quot;2018-07-18T16:05:22-04:00&quot; xmp:MetadataDate=&quot;2018-07-18T16:05:22-04:00&quot; dc:format=&quot;image\\/png&quot; photoshop:ColorMode=&quot;3&quot; photoshop:ICCProfile=&quot;sRGB IEC61966-2.1&quot; xmpMM:InstanceID=&quot;xmp.iid:2ee2905a-1661-224c-99ea-e8b42bd9064c&quot; xmpMM:DocumentID=&quot;xmp.did:2ee2905a-1661-224c-99ea-e8b42bd9064c&quot; xmpMM:OriginalDocumentID=&quot;xmp.did:2ee2905a-1661-224c-99ea-e8b42bd9064c&quot;&gt; &lt;xmpMM:History&gt; &lt;rdf:Seq&gt; &lt;rdf:li stEvt:action=&quot;created&quot; stEvt:instanceID=&quot;xmp.iid:2ee2905a-1661-224c-99ea-e8b42bd9064c&quot; stEvt:when=&quot;2018-07-18T16:01:13-04:00&quot; stEvt:softwareAgent=&quot;Adobe Photoshop CC 2018 (Windows)&quot;\\/&gt; &lt;\\/rdf:Seq&gt; &lt;\\/xmpMM:History&gt; &lt;\\/rdf:Description&gt; &lt;\\/rdf:RDF&gt; &lt;\\/x:xmpmeta&gt; &lt;?xpacket end=&quot;r&quot;?&gt;\"]}}'),
(57,24,NULL,628070,1,'761d63c7e9f3d9522abd2d2bba2f371a','image/jpeg','JPEG image data, EXIF standard','a477666598b78211930d346c08f322f4.jpg','81pa109_0009_flipped.jpg','2018-08-06 19:21:24','2018-08-06 19:17:16',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":2772,\"resolution_y\":2136,\"compression_ratio\":0.03535837688459411},\"comments\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"comments_html\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"iptc\":{\"comments\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\\u0000\\u0000\"]}},\"encoding\":\"ISO-8859-1\"},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"a477666598b78211930d346c08f322f4.jpg\",\"FileDateTime\":1533568636,\"FileSize\":628070,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"2772\\\" height=\\\"2136\\\"\",\"Height\":2136,\"Width\":2772,\"IsColor\":0,\"ByteOrderMotorola\":1,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"ImageWidth\":2772,\"ImageLength\":2136,\"BitsPerSample\":[8,8,8,8],\"PhotometricInterpretation\":1,\"Orientation\":1,\"SamplesPerPixel\":4,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CC 2018 (Windows)\",\"DateTime\":\"2018:08:06 11:17:01\",\"Exif_IFD_Pointer\":236},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":386,\"JPEGInterchangeFormatLength\":7920},\"EXIF\":{\"ExifVersion\":221,\"ColorSpace\":65535,\"ExifImageWidth\":2772,\"ExifImageLength\":2136}}}}'),
(60,12,NULL,45330,1,'2413fb7b380d04511a5c56f9db058ac0','image/jpeg','JPEG image data, EXIF standard','be9253ba7389ac67fd2b414a702d5c79.jpg','15769_small.jpg','2019-11-04 21:01:49','2018-08-06 19:28:37',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":228,\"resolution_y\":342,\"compression_ratio\":0.19377757258643685},\"comments\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"comments_html\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"iptc\":{\"comments\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\\u0000\\u0000\"]}},\"encoding\":\"ISO-8859-1\"},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"be9253ba7389ac67fd2b414a702d5c79.jpg\",\"FileDateTime\":1533569317,\"FileSize\":45330,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"228\\\" height=\\\"342\\\"\",\"Height\":342,\"Width\":228,\"IsColor\":1,\"ByteOrderMotorola\":1,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"ImageWidth\":2406,\"ImageLength\":2564,\"BitsPerSample\":[8,8,8],\"PhotometricInterpretation\":2,\"Orientation\":1,\"SamplesPerPixel\":3,\"XResolution\":300,\"YResolution\":300,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CC 2018 (Windows)\",\"DateTime\":\"2018:08:06 11:28:27\",\"Exif_IFD_Pointer\":236},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":386,\"JPEGInterchangeFormatLength\":2443},\"EXIF\":{\"ExifVersion\":221,\"ColorSpace\":65535,\"ExifImageWidth\":228,\"ExifImageLength\":342}}}}'),
(61,13,NULL,51024,1,'ac2ea7850eea75329376b08a09b00224','image/jpeg','JPEG image data, EXIF standard','88dc79428b9f620d223254867406b509.jpg','0877small.jpg','2019-11-04 21:01:55','2018-08-06 19:37:48',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":228,\"resolution_y\":342,\"compression_ratio\":0.21811839540371397},\"comments\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"comments_html\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"iptc\":{\"comments\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\\u0000\\u0000\"]}},\"encoding\":\"ISO-8859-1\"},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"88dc79428b9f620d223254867406b509.jpg\",\"FileDateTime\":1533569868,\"FileSize\":51024,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"228\\\" height=\\\"342\\\"\",\"Height\":342,\"Width\":228,\"IsColor\":0,\"ByteOrderMotorola\":1,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"ImageWidth\":4477,\"ImageLength\":6966,\"BitsPerSample\":[8,8,8,8],\"PhotometricInterpretation\":1,\"Orientation\":1,\"SamplesPerPixel\":4,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CC 2018 (Windows)\",\"DateTime\":\"2018:08:06 11:37:21\",\"Exif_IFD_Pointer\":236},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":386,\"JPEGInterchangeFormatLength\":7661},\"EXIF\":{\"ExifVersion\":221,\"ColorSpace\":65535,\"ExifImageWidth\":228,\"ExifImageLength\":342}}}}'),
(63,8,NULL,61348,1,'ad6f6d4272299625336acab00af69eb9','image/jpeg','JPEG image data, EXIF standard','47bd63bc718f3ae83f361ebdbebe3cdc.jpg','0334_small.jpg','2019-11-04 21:01:14','2018-08-06 21:47:56',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":228,\"resolution_y\":342,\"compression_ratio\":0.26225163298108822},\"comments\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"comments_html\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"iptc\":{\"comments\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\\u0000\\u0000\"]}},\"encoding\":\"ISO-8859-1\"},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"47bd63bc718f3ae83f361ebdbebe3cdc.jpg\",\"FileDateTime\":1533577676,\"FileSize\":61348,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"228\\\" height=\\\"342\\\"\",\"Height\":342,\"Width\":228,\"IsColor\":1,\"ByteOrderMotorola\":1,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"ImageWidth\":1760,\"ImageLength\":2245,\"BitsPerSample\":[8,8,8],\"PhotometricInterpretation\":2,\"Orientation\":1,\"SamplesPerPixel\":3,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CC 2018 (Windows)\",\"DateTime\":\"2018:08:06 13:47:29\",\"Exif_IFD_Pointer\":236},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":386,\"JPEGInterchangeFormatLength\":8576},\"EXIF\":{\"ExifVersion\":221,\"ColorSpace\":65535,\"ExifImageWidth\":228,\"ExifImageLength\":342}}}}'),
(65,25,NULL,312782,1,'420c8827f75e6564354e4daab655cc14','image/jpeg','JPEG image data, EXIF standard','ddae9e8b589552b9caa47f62d19860f8.jpg','96pa101_1930_1939_3005d_crop.jpg','2018-08-14 16:29:03','2018-08-06 22:02:10',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":2799,\"resolution_y\":1170,\"compression_ratio\":0.03183697067226899},\"comments\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"comments_html\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"iptc\":{\"comments\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\\u0000\\u0000\"]}},\"encoding\":\"ISO-8859-1\"},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"ddae9e8b589552b9caa47f62d19860f8.jpg\",\"FileDateTime\":1533578530,\"FileSize\":312782,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"2799\\\" height=\\\"1170\\\"\",\"Height\":1170,\"Width\":2799,\"IsColor\":1,\"ByteOrderMotorola\":1,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"ImageWidth\":6405,\"ImageLength\":4568,\"BitsPerSample\":[8,8,8],\"PhotometricInterpretation\":2,\"Orientation\":1,\"SamplesPerPixel\":3,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CC 2018 (Windows)\",\"DateTime\":\"2018:08:06 14:01:56\",\"Exif_IFD_Pointer\":236},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":386,\"JPEGInterchangeFormatLength\":3794},\"EXIF\":{\"ExifVersion\":221,\"ColorSpace\":65535,\"ExifImageWidth\":2799,\"ExifImageLength\":1170}}}}'),
(71,27,NULL,587681,1,'d33e5e4dec5e30365db80585ae5c60a4','image/jpeg','JPEG image data, EXIF standard','7c758f3c8871dcae25ec474a32ae2087.jpg','2013av029_3_40_72603.jpg','2018-08-14 16:19:11','2018-08-14 16:19:11',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":1200,\"resolution_y\":604,\"compression_ratio\":0.27027271891096394},\"comments\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"comments_html\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"iptc\":{\"comments\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\\u0000\\u0000\"]}},\"encoding\":\"ISO-8859-1\"},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"7c758f3c8871dcae25ec474a32ae2087.jpg\",\"FileDateTime\":1534249151,\"FileSize\":587681,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"1200\\\" height=\\\"604\\\"\",\"Height\":604,\"Width\":1200,\"IsColor\":1,\"ByteOrderMotorola\":1,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"ImageWidth\":5172,\"ImageLength\":4943,\"BitsPerSample\":[8,8,8],\"PhotometricInterpretation\":2,\"Orientation\":1,\"SamplesPerPixel\":3,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CC 2018 (Windows)\",\"DateTime\":\"2018:08:14 08:15:10\",\"Exif_IFD_Pointer\":236},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":386,\"JPEGInterchangeFormatLength\":6341},\"EXIF\":{\"ExifVersion\":221,\"ColorSpace\":65535,\"ExifImageWidth\":1200,\"ExifImageLength\":604}}}}'),
(72,28,NULL,542936,1,'c78fb6ca7a507fc1c06b3fbf79cf4411','image/jpeg','JPEG image data, EXIF standard','31ea7d36fa27634f1402b32e505cbb8e.jpg','tumblr_okggtdoMhU1ruqsxfo1_1280.jpg','2018-08-14 16:28:11','2018-08-14 16:28:11',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":1188,\"resolution_y\":519,\"compression_ratio\":0.29352397881620745},\"comments\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"comments_html\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"iptc\":{\"comments\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\\u0000\\u0000\"]}},\"encoding\":\"ISO-8859-1\"},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"31ea7d36fa27634f1402b32e505cbb8e.jpg\",\"FileDateTime\":1534249691,\"FileSize\":542936,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"1188\\\" height=\\\"519\\\"\",\"Height\":519,\"Width\":1188,\"IsColor\":1,\"ByteOrderMotorola\":1,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"ImageWidth\":1280,\"ImageLength\":855,\"BitsPerSample\":[8,8,8],\"PhotometricInterpretation\":2,\"Orientation\":1,\"SamplesPerPixel\":3,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CC 2018 (Windows)\",\"DateTime\":\"2018:08:14 08:27:43\",\"Exif_IFD_Pointer\":236},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":386,\"JPEGInterchangeFormatLength\":3903},\"EXIF\":{\"ExifVersion\":221,\"ColorSpace\":65535,\"ExifImageWidth\":1188,\"ExifImageLength\":519}}}}'),
(73,29,NULL,410747,1,'f4828da69c45b8d818c16c52ba11272a','image/jpeg','JPEG image data, EXIF standard','9dfadad3906801097ff863ed5ab244ae.jpg','2015av011_1_13_026.jpg','2018-08-14 16:33:07','2018-08-14 16:33:07',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":1190,\"resolution_y\":472,\"compression_ratio\":0.24376097896785834},\"comments\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"comments_html\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"iptc\":{\"comments\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\\u0000\\u0000\"]}},\"encoding\":\"ISO-8859-1\"},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"9dfadad3906801097ff863ed5ab244ae.jpg\",\"FileDateTime\":1534249987,\"FileSize\":410747,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"1190\\\" height=\\\"472\\\"\",\"Height\":472,\"Width\":1190,\"IsColor\":1,\"ByteOrderMotorola\":0,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"ImageWidth\":4841,\"ImageLength\":3225,\"BitsPerSample\":[8,8,8],\"Compression\":1,\"PhotometricInterpretation\":2,\"Orientation\":1,\"SamplesPerPixel\":3,\"XResolution\":728,\"YResolution\":728,\"PlanarConfiguration\":1,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CC 2018 (Windows)\",\"DateTime\":\"2018:08:14 08:32:49\",\"Exif_IFD_Pointer\":260},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":398,\"JPEGInterchangeFormatLength\":2297},\"EXIF\":{\"ColorSpace\":65535,\"ExifImageWidth\":1190,\"ExifImageLength\":472}}}}'),
(74,19,NULL,47659,1,'252d26a924003049046cde4f110fa32d','image/jpeg','JPEG image data, EXIF standard','8db32876d35c7f8596fd2570838b072a.jpg','kdnplogo_exploreUK5.jpg','2019-11-04 22:49:55','2018-08-17 18:35:14',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":420,\"resolution_y\":120,\"compression_ratio\":0.31520502645502646},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"8db32876d35c7f8596fd2570838b072a.jpg\",\"FileDateTime\":1534516514,\"FileSize\":47659,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"420\\\" height=\\\"120\\\"\",\"Height\":120,\"Width\":420,\"IsColor\":1,\"ByteOrderMotorola\":1,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"Orientation\":1,\"XResolution\":300,\"YResolution\":300,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CS6 (Macintosh)\",\"DateTime\":\"2018:08:17 09:43:29\",\"Exif_IFD_Pointer\":168},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":306,\"JPEGInterchangeFormatLength\":3622},\"EXIF\":{\"ColorSpace\":1,\"ExifImageWidth\":420,\"ExifImageLength\":120}}}}'),
(75,30,NULL,590234,1,'536d4fe09bad85c0dfb66883c41e6526','image/jpeg','JPEG image data, EXIF standard','8ce21fac2bf5d64ebfe8835c76ddde9b.jpg','1997av027_2066.jpg','2018-11-12 21:17:56','2018-08-22 00:21:18',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":1200,\"resolution_y\":545,\"compression_ratio\":0.30083282364933739},\"comments\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"comments_html\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"iptc\":{\"comments\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\\u0000\\u0000\"]}},\"encoding\":\"ISO-8859-1\"},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"8ce21fac2bf5d64ebfe8835c76ddde9b.jpg\",\"FileDateTime\":1534882878,\"FileSize\":590234,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"1200\\\" height=\\\"545\\\"\",\"Height\":545,\"Width\":1200,\"IsColor\":1,\"ByteOrderMotorola\":1,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"ImageWidth\":2530,\"ImageLength\":1673,\"BitsPerSample\":[8,8,8],\"PhotometricInterpretation\":2,\"Orientation\":1,\"SamplesPerPixel\":3,\"XResolution\":300,\"YResolution\":300,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CC 2018 (Windows)\",\"DateTime\":\"2018:08:21 16:19:32\",\"Exif_IFD_Pointer\":236},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":386,\"JPEGInterchangeFormatLength\":4791},\"EXIF\":{\"ExifVersion\":221,\"ColorSpace\":1,\"ExifImageWidth\":1200,\"ExifImageLength\":545}}}}'),
(77,32,NULL,717824,1,'a9a7114f6346e90ed4d3ec07e0e61267','image/jpeg','JPEG image data, EXIF standard','e6c018c9217e86654f15c95d53740bcd.jpg','29407.jpg','2018-11-12 21:17:24','2018-08-22 00:38:31',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":1200,\"resolution_y\":470,\"compression_ratio\":0.42424586288416077},\"comments\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"comments_html\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"iptc\":{\"comments\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\\u0000\\u0000\"]}},\"encoding\":\"ISO-8859-1\"},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"e6c018c9217e86654f15c95d53740bcd.jpg\",\"FileDateTime\":1534883911,\"FileSize\":717824,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"1200\\\" height=\\\"470\\\"\",\"Height\":470,\"Width\":1200,\"IsColor\":1,\"ByteOrderMotorola\":1,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"ImageWidth\":3792,\"ImageLength\":3263,\"BitsPerSample\":[8,8,8],\"PhotometricInterpretation\":2,\"Orientation\":1,\"SamplesPerPixel\":3,\"XResolution\":400,\"YResolution\":400,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CC 2018 (Windows)\",\"DateTime\":\"2018:08:21 16:36:54\",\"Exif_IFD_Pointer\":236},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":386,\"JPEGInterchangeFormatLength\":4136},\"EXIF\":{\"ExifVersion\":221,\"ColorSpace\":65535,\"ExifImageWidth\":1200,\"ExifImageLength\":470}}}}'),
(78,9,NULL,175436,1,'9480e118586b109d4adf70a5825b8933','image/jpeg','JPEG image data, EXIF standard','c1c5b558c344e5cb78b2ca784f7ca554.jpg','0001 (3).jpg','2019-11-04 21:01:23','2018-08-23 00:41:51',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":228,\"resolution_y\":342,\"compression_ratio\":0.74995725180397388},\"comments\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"comments_html\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"iptc\":{\"comments\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\\u0000\\u0000\"]}},\"encoding\":\"ISO-8859-1\"},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"c1c5b558c344e5cb78b2ca784f7ca554.jpg\",\"FileDateTime\":1534970511,\"FileSize\":175436,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"228\\\" height=\\\"342\\\"\",\"Height\":342,\"Width\":228,\"IsColor\":1,\"ByteOrderMotorola\":1,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"ImageWidth\":2831,\"ImageLength\":3543,\"BitsPerSample\":[8,8,8],\"PhotometricInterpretation\":2,\"Orientation\":1,\"SamplesPerPixel\":3,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CC 2018 (Windows)\",\"DateTime\":\"2018:08:22 16:38:28\",\"Exif_IFD_Pointer\":236},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":386,\"JPEGInterchangeFormatLength\":11294},\"EXIF\":{\"ExifVersion\":221,\"ColorSpace\":65535,\"ExifImageWidth\":228,\"ExifImageLength\":342}}}}'),
(79,5,NULL,33930,1,'3acf40ec58721bdf0ddddf36af166b5b','image/jpeg','JPEG image data, EXIF standard','e5cf2c3c784ae1f1b45bc5c1f064db48.jpg','2007AV036_13.jpg','2019-11-04 21:00:53','2018-08-23 16:38:32',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":228,\"resolution_y\":342,\"compression_ratio\":0.14504462911665128},\"comments\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"comments_html\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"iptc\":{\"comments\":{\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\\u0000\\u0000\"]}},\"encoding\":\"ISO-8859-1\"},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"e5cf2c3c784ae1f1b45bc5c1f064db48.jpg\",\"FileDateTime\":1535027912,\"FileSize\":33930,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"228\\\" height=\\\"342\\\"\",\"Height\":342,\"Width\":228,\"IsColor\":1,\"ByteOrderMotorola\":1,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"ImageWidth\":3368,\"ImageLength\":4752,\"BitsPerSample\":[8,8,8],\"PhotometricInterpretation\":2,\"Orientation\":1,\"SamplesPerPixel\":3,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CC 2018 (Windows)\",\"DateTime\":\"2018:08:07 15:23:47\",\"Exif_IFD_Pointer\":236},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":386,\"JPEGInterchangeFormatLength\":4753},\"EXIF\":{\"ExifVersion\":221,\"ColorSpace\":65535,\"ExifImageWidth\":228,\"ExifImageLength\":342}}}}'),
(80,11,NULL,105569,1,'1eb02ae6823b831ea22af2498f9bb0c1','image/jpeg','JPEG image data, EXIF standard','98fe0c3f17d4573081e8b7000e9bb080.jpg','4938.jpg','2019-11-04 21:01:42','2018-08-23 16:41:36',1,'0'),
(106,37,NULL,45808,1,'b3ce94d77969f88f4d2a7ba8d6bdccac','image/jpeg','JPEG image data, EXIF standard','0411abc5f5f49d5ccdf88ac07c8e9ee5.jpg','LHL_logo2.jpg','2019-11-04 22:49:25','2019-11-04 20:25:14',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":420,\"resolution_y\":120,\"compression_ratio\":0.30296296296296299},\"comments\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"comments_html\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\"]}},\"iptc\":{\"comments\":{\"IPTCEnvelope\":{\"CodedCharacterSet\":[\"\\u001b%G\"]},\"IPTCApplication\":{\"ApplicationRecordVersion\":[\"\\u0000\\u0000\"]}},\"encoding\":\"ISO-8859-1\"},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"0411abc5f5f49d5ccdf88ac07c8e9ee5.jpg\",\"FileDateTime\":1572881114,\"FileSize\":45808,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, THUMBNAIL, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"420\\\" height=\\\"120\\\"\",\"Height\":120,\"Width\":420,\"IsColor\":1,\"ByteOrderMotorola\":1,\"Thumbnail.FileType\":2,\"Thumbnail.MimeType\":\"image\\/jpeg\"},\"IFD0\":{\"Orientation\":1,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"Software\":\"Adobe Photoshop CC 2018 (Windows)\",\"DateTime\":\"2019:10:11 11:44:10\",\"Exif_IFD_Pointer\":168},\"THUMBNAIL\":{\"Compression\":6,\"XResolution\":72,\"YResolution\":72,\"ResolutionUnit\":2,\"JPEGInterchangeFormat\":306,\"JPEGInterchangeFormatLength\":3467},\"EXIF\":{\"ColorSpace\":65535,\"ExifImageWidth\":420,\"ExifImageLength\":120}}}}'),
(119,46,NULL,37024,1,'597e1db237deef0dabc5ade4b86cb5cf','image/png','PNG image data, 737 x 210, 8-bit/color RGBA, non-interlaced','8d5cec60d362a916df66feb938446fa2.png','heyburn-prod.png','2024-05-03 23:30:56','2024-05-03 23:29:48',1,'{\"mime_type\":\"image\\/png\",\"video\":{\"dataformat\":\"png\",\"lossless\":false,\"resolution_x\":737,\"resolution_y\":210,\"bits_per_sample\":32,\"compression_ratio\":0.059804871745170254},\"comments\":{\"Raw profile type exif\":[\"exif\\n     214\\n45786966000049492a00080000000a000001040001000000e10200000101040001000000\\nd20000000201030003000000860000001201030001000000010000001a01050001000000\\n8c0000001b0105000100000094000000280103000100000002000000310102000d000000\\n9c0000003201020014000000aa0000006987040001000000be0000000000000008000800\\n08004800000001000000480000000100000047494d5020322e31302e3336000032303234\\n3a30353a30322031323a35343a313500010001a00300010000000100000000000000\"],\"XML:com.adobe.xmp\":[\"<?xpacket begin=\\\"\\ufeff\\\" id=\\\"W5M0MpCehiHzreSzNTczkc9d\\\"?>\\n<x:xmpmeta xmlns:x=\\\"adobe:ns:meta\\/\\\" x:xmptk=\\\"XMP Core 4.4.0-Exiv2\\\">\\n <rdf:RDF xmlns:rdf=\\\"http:\\/\\/www.w3.org\\/1999\\/02\\/22-rdf-syntax-ns#\\\">\\n  <rdf:Description rdf:about=\\\"\\\"\\n    xmlns:photoshop=\\\"http:\\/\\/ns.adobe.com\\/photoshop\\/1.0\\/\\\"\\n    xmlns:xmpMM=\\\"http:\\/\\/ns.adobe.com\\/xap\\/1.0\\/mm\\/\\\"\\n    xmlns:stEvt=\\\"http:\\/\\/ns.adobe.com\\/xap\\/1.0\\/sType\\/ResourceEvent#\\\"\\n    xmlns:stRef=\\\"http:\\/\\/ns.adobe.com\\/xap\\/1.0\\/sType\\/ResourceRef#\\\"\\n    xmlns:dc=\\\"http:\\/\\/purl.org\\/dc\\/elements\\/1.1\\/\\\"\\n    xmlns:GIMP=\\\"http:\\/\\/www.gimp.org\\/xmp\\/\\\"\\n    xmlns:tiff=\\\"http:\\/\\/ns.adobe.com\\/tiff\\/1.0\\/\\\"\\n    xmlns:xmp=\\\"http:\\/\\/ns.adobe.com\\/xap\\/1.0\\/\\\"\\n   photoshop:ColorMode=\\\"3\\\"\\n   xmpMM:DocumentID=\\\"adobe:docid:photoshop:efc6d9b7-650c-4c40-9a6f-c8704716916a\\\"\\n   xmpMM:InstanceID=\\\"xmp.iid:736c7549-b896-465e-b84a-ff2b49d29923\\\"\\n   xmpMM:OriginalDocumentID=\\\"xmp.did:db089409-b79f-0940-bb55-e7d1e7ff230a\\\"\\n   dc:format=\\\"image\\/png\\\"\\n   GIMP:API=\\\"2.0\\\"\\n   GIMP:Platform=\\\"Windows\\\"\\n   GIMP:TimeStamp=\\\"1714668869441785\\\"\\n   GIMP:Version=\\\"2.10.36\\\"\\n   tiff:Orientation=\\\"1\\\"\\n   xmp:CreateDate=\\\"2018-09-21T15:46:07-04:00\\\"\\n   xmp:CreatorTool=\\\"GIMP 2.10\\\"\\n   xmp:MetadataDate=\\\"2024:05:02T12:54:15-04:00\\\"\\n   xmp:ModifyDate=\\\"2024:05:02T12:54:15-04:00\\\">\\n   <photoshop:TextLayers>\\n    <rdf:Seq>\\n     <rdf:li\\n      photoshop:LayerName=\\\"The John G. Heyburn II Initiative for Excellence in the Federal\\\"\\n      photoshop:LayerText=\\\"The John G. Heyburn II Initiative for Excellence in the Federal Judiciary\\\"\\/>\\n     <rdf:li\\n      photoshop:LayerName=\\\"Layer 1\\\"\\/>\\n    <\\/rdf:Seq>\\n   <\\/photoshop:TextLayers>\\n   <xmpMM:History>\\n    <rdf:Seq>\\n     <rdf:li\\n      stEvt:action=\\\"created\\\"\\n      stEvt:instanceID=\\\"xmp.iid:db089409-b79f-0940-bb55-e7d1e7ff230a\\\"\\n      stEvt:softwareAgent=\\\"Adobe Photoshop CC 2018 (Windows)\\\"\\n      stEvt:when=\\\"2018-09-21T15:46:07-04:00\\\"\\/>\\n     <rdf:li\\n      stEvt:action=\\\"saved\\\"\\n      stEvt:changed=\\\"\\/\\\"\\n      stEvt:instanceID=\\\"xmp.iid:3142e518-112c-3f42-9c2f-611adc4502aa\\\"\\n      stEvt:softwareAgent=\\\"Adobe Photoshop CC 2018 (Windows)\\\"\\n      stEvt:when=\\\"2018-09-21T15:50:35-04:00\\\"\\/>\\n     <rdf:li\\n      stEvt:action=\\\"saved\\\"\\n      stEvt:changed=\\\"\\/\\\"\\n      stEvt:instanceID=\\\"xmp.iid:7f34ed8f-c01a-114e-a80b-ae05f49c7105\\\"\\n      stEvt:softwareAgent=\\\"Adobe Photoshop CC 2018 (Windows)\\\"\\n      stEvt:when=\\\"2018-09-21T15:51:55-04:00\\\"\\/>\\n     <rdf:li\\n      stEvt:action=\\\"converted\\\"\\n      stEvt:parameters=\\\"from application\\/vnd.adobe.photoshop to image\\/png\\\"\\/>\\n     <rdf:li\\n      stEvt:action=\\\"derived\\\"\\n      stEvt:parameters=\\\"converted from application\\/vnd.adobe.photoshop to image\\/png\\\"\\/>\\n     <rdf:li\\n      stEvt:action=\\\"saved\\\"\\n      stEvt:changed=\\\"\\/\\\"\\n      stEvt:instanceID=\\\"xmp.iid:efc8b41f-2a4d-e443-884a-5ca12d33ac42\\\"\\n      stEvt:softwareAgent=\\\"Adobe Photoshop CC 2018 (Windows)\\\"\\n      stEvt:when=\\\"2018-09-21T15:51:55-04:00\\\"\\/>\\n     <rdf:li\\n      stEvt:action=\\\"saved\\\"\\n      stEvt:changed=\\\"\\/\\\"\\n      stEvt:instanceID=\\\"xmp.iid:49a23a7d-97b0-4913-86f6-4fa568cc7a90\\\"\\n      stEvt:softwareAgent=\\\"Gimp 2.10 (Windows)\\\"\\n      stEvt:when=\\\"2024-05-02T12:54:29\\\"\\/>\\n    <\\/rdf:Seq>\\n   <\\/xmpMM:History>\\n   <xmpMM:DerivedFrom\\n    stRef:documentID=\\\"xmp.did:db089409-b79f-0940-bb55-e7d1e7ff230a\\\"\\n    stRef:instanceID=\\\"xmp.iid:7f34ed8f-c01a-114e-a80b-ae05f49c7105\\\"\\n    stRef:originalDocumentID=\\\"xmp.did:db089409-b79f-0940-bb55-e7d1e7ff230a\\\"\\/>\\n  <\\/rdf:Description>\\n <\\/rdf:RDF>\\n<\\/x:xmpmeta>\\n                                                                                                    \\n                                                                                                    \\n                                                                                                    \\n                                                                                                    \\n                                                                                                    \\n                                                                                                    \\n                                                                                                    \\n                                                                                                    \\n                                                                                                    \\n                                                                                                    \\n                                                                                                    \\n                                                                                                    \\n                                                                                                    \\n                                                                                                    \\n                                                                                                    \\n                                                                                                    \\n                                                                                                    \\n                                                                                                    \\n                                                                                                    \\n                                                                                                    \\n                           \\n<?xpacket end=\\\"w\\\"?>\"]},\"comments_html\":{\"Raw profile type exif\":[\"exif&#10;     214&#10;45786966000049492a00080000000a000001040001000000e10200000101040001000000&#10;d20000000201030003000000860000001201030001000000010000001a01050001000000&#10;8c0000001b0105000100000094000000280103000100000002000000310102000d000000&#10;9c0000003201020014000000aa0000006987040001000000be0000000000000008000800&#10;08004800000001000000480000000100000047494d5020322e31302e3336000032303234&#10;3a30353a30322031323a35343a313500010001a00300010000000100000000000000\"],\"XML:com.adobe.xmp\":[\"&lt;?xpacket begin=&quot;&#65279;&quot; id=&quot;W5M0MpCehiHzreSzNTczkc9d&quot;?&gt;&#10;&lt;x:xmpmeta xmlns:x=&quot;adobe:ns:meta\\/&quot; x:xmptk=&quot;XMP Core 4.4.0-Exiv2&quot;&gt;&#10; &lt;rdf:RDF xmlns:rdf=&quot;http:\\/\\/www.w3.org\\/1999\\/02\\/22-rdf-syntax-ns#&quot;&gt;&#10;  &lt;rdf:Description rdf:about=&quot;&quot;&#10;    xmlns:photoshop=&quot;http:\\/\\/ns.adobe.com\\/photoshop\\/1.0\\/&quot;&#10;    xmlns:xmpMM=&quot;http:\\/\\/ns.adobe.com\\/xap\\/1.0\\/mm\\/&quot;&#10;    xmlns:stEvt=&quot;http:\\/\\/ns.adobe.com\\/xap\\/1.0\\/sType\\/ResourceEvent#&quot;&#10;    xmlns:stRef=&quot;http:\\/\\/ns.adobe.com\\/xap\\/1.0\\/sType\\/ResourceRef#&quot;&#10;    xmlns:dc=&quot;http:\\/\\/purl.org\\/dc\\/elements\\/1.1\\/&quot;&#10;    xmlns:GIMP=&quot;http:\\/\\/www.gimp.org\\/xmp\\/&quot;&#10;    xmlns:tiff=&quot;http:\\/\\/ns.adobe.com\\/tiff\\/1.0\\/&quot;&#10;    xmlns:xmp=&quot;http:\\/\\/ns.adobe.com\\/xap\\/1.0\\/&quot;&#10;   photoshop:ColorMode=&quot;3&quot;&#10;   xmpMM:DocumentID=&quot;adobe:docid:photoshop:efc6d9b7-650c-4c40-9a6f-c8704716916a&quot;&#10;   xmpMM:InstanceID=&quot;xmp.iid:736c7549-b896-465e-b84a-ff2b49d29923&quot;&#10;   xmpMM:OriginalDocumentID=&quot;xmp.did:db089409-b79f-0940-bb55-e7d1e7ff230a&quot;&#10;   dc:format=&quot;image\\/png&quot;&#10;   GIMP:API=&quot;2.0&quot;&#10;   GIMP:Platform=&quot;Windows&quot;&#10;   GIMP:TimeStamp=&quot;1714668869441785&quot;&#10;   GIMP:Version=&quot;2.10.36&quot;&#10;   tiff:Orientation=&quot;1&quot;&#10;   xmp:CreateDate=&quot;2018-09-21T15:46:07-04:00&quot;&#10;   xmp:CreatorTool=&quot;GIMP 2.10&quot;&#10;   xmp:MetadataDate=&quot;2024:05:02T12:54:15-04:00&quot;&#10;   xmp:ModifyDate=&quot;2024:05:02T12:54:15-04:00&quot;&gt;&#10;   &lt;photoshop:TextLayers&gt;&#10;    &lt;rdf:Seq&gt;&#10;     &lt;rdf:li&#10;      photoshop:LayerName=&quot;The John G. Heyburn II Initiative for Excellence in the Federal&quot;&#10;      photoshop:LayerText=&quot;The John G. Heyburn II Initiative for Excellence in the Federal Judiciary&quot;\\/&gt;&#10;     &lt;rdf:li&#10;      photoshop:LayerName=&quot;Layer 1&quot;\\/&gt;&#10;    &lt;\\/rdf:Seq&gt;&#10;   &lt;\\/photoshop:TextLayers&gt;&#10;   &lt;xmpMM:History&gt;&#10;    &lt;rdf:Seq&gt;&#10;     &lt;rdf:li&#10;      stEvt:action=&quot;created&quot;&#10;      stEvt:instanceID=&quot;xmp.iid:db089409-b79f-0940-bb55-e7d1e7ff230a&quot;&#10;      stEvt:softwareAgent=&quot;Adobe Photoshop CC 2018 (Windows)&quot;&#10;      stEvt:when=&quot;2018-09-21T15:46:07-04:00&quot;\\/&gt;&#10;     &lt;rdf:li&#10;      stEvt:action=&quot;saved&quot;&#10;      stEvt:changed=&quot;\\/&quot;&#10;      stEvt:instanceID=&quot;xmp.iid:3142e518-112c-3f42-9c2f-611adc4502aa&quot;&#10;      stEvt:softwareAgent=&quot;Adobe Photoshop CC 2018 (Windows)&quot;&#10;      stEvt:when=&quot;2018-09-21T15:50:35-04:00&quot;\\/&gt;&#10;     &lt;rdf:li&#10;      stEvt:action=&quot;saved&quot;&#10;      stEvt:changed=&quot;\\/&quot;&#10;      stEvt:instanceID=&quot;xmp.iid:7f34ed8f-c01a-114e-a80b-ae05f49c7105&quot;&#10;      stEvt:softwareAgent=&quot;Adobe Photoshop CC 2018 (Windows)&quot;&#10;      stEvt:when=&quot;2018-09-21T15:51:55-04:00&quot;\\/&gt;&#10;     &lt;rdf:li&#10;      stEvt:action=&quot;converted&quot;&#10;      stEvt:parameters=&quot;from application\\/vnd.adobe.photoshop to image\\/png&quot;\\/&gt;&#10;     &lt;rdf:li&#10;      stEvt:action=&quot;derived&quot;&#10;      stEvt:parameters=&quot;converted from application\\/vnd.adobe.photoshop to image\\/png&quot;\\/&gt;&#10;     &lt;rdf:li&#10;      stEvt:action=&quot;saved&quot;&#10;      stEvt:changed=&quot;\\/&quot;&#10;      stEvt:instanceID=&quot;xmp.iid:efc8b41f-2a4d-e443-884a-5ca12d33ac42&quot;&#10;      stEvt:softwareAgent=&quot;Adobe Photoshop CC 2018 (Windows)&quot;&#10;      stEvt:when=&quot;2018-09-21T15:51:55-04:00&quot;\\/&gt;&#10;     &lt;rdf:li&#10;      stEvt:action=&quot;saved&quot;&#10;      stEvt:changed=&quot;\\/&quot;&#10;      stEvt:instanceID=&quot;xmp.iid:49a23a7d-97b0-4913-86f6-4fa568cc7a90&quot;&#10;      stEvt:softwareAgent=&quot;Gimp 2.10 (Windows)&quot;&#10;      stEvt:when=&quot;2024-05-02T12:54:29&quot;\\/&gt;&#10;    &lt;\\/rdf:Seq&gt;&#10;   &lt;\\/xmpMM:History&gt;&#10;   &lt;xmpMM:DerivedFrom&#10;    stRef:documentID=&quot;xmp.did:db089409-b79f-0940-bb55-e7d1e7ff230a&quot;&#10;    stRef:instanceID=&quot;xmp.iid:7f34ed8f-c01a-114e-a80b-ae05f49c7105&quot;&#10;    stRef:originalDocumentID=&quot;xmp.did:db089409-b79f-0940-bb55-e7d1e7ff230a&quot;\\/&gt;&#10;  &lt;\\/rdf:Description&gt;&#10; &lt;\\/rdf:RDF&gt;&#10;&lt;\\/x:xmpmeta&gt;&#10;                                                                                                    &#10;                                                                                                    &#10;                                                                                                    &#10;                                                                                                    &#10;                                                                                                    &#10;                                                                                                    &#10;                                                                                                    &#10;                                                                                                    &#10;                                                                                                    &#10;                                                                                                    &#10;                                                                                                    &#10;                                                                                                    &#10;                                                                                                    &#10;                                                                                                    &#10;                                                                                                    &#10;                                                                                                    &#10;                                                                                                    &#10;                                                                                                    &#10;                                                                                                    &#10;                                                                                                    &#10;                           &#10;&lt;?xpacket end=&quot;w&quot;?&gt;\"]}}'),
(120,47,NULL,27872,1,'0e16f81c8ebb048d9501ff5407d00fb9','image/png','PNG image data, 700 x 200, 8-bit/color RGBA, non-interlaced','cd5e61979934b00b1bebac0e702ddcca.png','SCRC Exhibits.png','2024-05-03 23:33:28','2024-05-03 23:33:07',1,'{\"mime_type\":\"image\\/png\",\"video\":{\"dataformat\":\"png\",\"lossless\":false,\"resolution_x\":700,\"resolution_y\":200,\"bits_per_sample\":32,\"compression_ratio\":0.049771428571428571}}'),
(122,48,NULL,31270,1,'1947347fe66e7a7d02b5dea1759f1fd1','image/jpeg','JPEG image data, JFIF standard 1.01','1950104e492857116ef87edf9c8b04e9.jpg','Web Archiving Program Button (2).jpg','2024-08-28 01:18:36','2024-08-28 01:18:36',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":700,\"resolution_y\":200,\"compression_ratio\":0.07445238095238095},\"jpg\":{\"exif\":{\"FILE\":{\"FileName\":\"1950104e492857116ef87edf9c8b04e9.jpg\",\"FileDateTime\":1724793515,\"FileSize\":31270,\"FileType\":2,\"MimeType\":\"image\\/jpeg\",\"SectionsFound\":\"ANY_TAG, IFD0, EXIF\"},\"COMPUTED\":{\"html\":\"width=\\\"700\\\" height=\\\"200\\\"\",\"Height\":200,\"Width\":700,\"IsColor\":1,\"ByteOrderMotorola\":0},\"IFD0\":{\"Orientation\":1,\"XResolution\":96,\"YResolution\":96,\"ResolutionUnit\":2,\"YCbCrPositioning\":1,\"Exif_IFD_Pointer\":86},\"EXIF\":{\"ExifVersion\":231,\"ComponentsConfiguration\":\"\\u0001\\u0002\\u0003\\u0000\",\"FlashPixVersion\":100,\"ColorSpace\":65535,\"ExifImageWidth\":700,\"ExifImageLength\":200}}}}'),
(123,49,NULL,36035,1,'6c1a5c1b842568eee3b6fd89ab8bc5b3','image/jpeg','JPEG image data, JFIF standard 1.01','0be916700a133c7e98e831e0080184b1.jpg','kentucky-alumnus-image.jpg','2024-09-27 16:43:00','2024-09-20 18:53:41',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":500,\"resolution_y\":741,\"compression_ratio\":0.032420152946468737}}'),
(124,50,NULL,87443,1,'e11cf326b045eac9fd826000c3e96d6f','image/jpeg','JPEG image data, JFIF standard 1.01','a43135565c462b6a7415cb72c772e0ce.jpg','city-directories-image.jpg','2024-09-27 16:42:59','2024-09-20 18:55:55',1,'{\"mime_type\":\"image\\/jpeg\",\"video\":{\"dataformat\":\"jpg\",\"lossless\":false,\"bits_per_sample\":24,\"pixel_aspect_ratio\":1,\"resolution_x\":500,\"resolution_y\":786,\"compression_ratio\":0.074167090754877013}}');
/*!40000 ALTER TABLE `omeka_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_item_types`
--

DROP TABLE IF EXISTS `omeka_item_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_item_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_item_types`
--

LOCK TABLES `omeka_item_types` WRITE;
/*!40000 ALTER TABLE `omeka_item_types` DISABLE KEYS */;
INSERT INTO `omeka_item_types` VALUES
(1,'Text','A resource consisting primarily of words for reading. Examples include books, letters, dissertations, poems, newspapers, articles, archives of mailing lists. Note that facsimiles or images of texts are still of the genre Text.'),
(3,'Moving Image','A series of visual representations imparting an impression of motion when shown in succession. Examples include animations, movies, television programs, videos, zoetropes, or visual output from a simulation.'),
(4,'Oral History','A resource containing historical information obtained in interviews with persons having firsthand knowledge.'),
(5,'Sound','A resource primarily intended to be heard. Examples include a music playback file format, an audio compact disc, and recorded speech or sounds.'),
(6,'Still Image','A static visual representation. Examples include paintings, drawings, graphic designs, plans and maps. Recommended best practice is to assign the type Text to images of textual materials.'),
(7,'Website','A resource comprising of a web page or web pages and all related assets ( such as images, sound and video files, etc. ).'),
(8,'Event','A non-persistent, time-based occurrence. Metadata for an event provides descriptive information that is the basis for discovery of the purpose, location, duration, and responsible agents associated with an event. Examples include an exhibition, webcast, conference, workshop, open day, performance, battle, trial, wedding, tea party, conflagration.'),
(9,'Email','A resource containing textual messages and binary attachments sent electronically from one person to another or one person to many people.'),
(10,'Lesson Plan','A resource that gives a detailed description of a course of instruction.'),
(11,'Hyperlink','A link, or reference, to another resource on the Internet.'),
(12,'Person','An individual.'),
(13,'Interactive Resource','A resource requiring interaction from the user to be understood, executed, or experienced. Examples include forms on Web pages, applets, multimedia learning objects, chat services, or virtual reality environments.'),
(14,'Dataset','Data encoded in a defined structure. Examples include lists, tables, and databases. A dataset may be useful for direct machine processing.'),
(15,'Physical Object','An inanimate, three-dimensional object or substance. Note that digital representations of, or surrogates for, these objects should use Moving Image, Still Image, Text or one of the other types.'),
(16,'Service','A system that provides one or more functions. Examples include a photocopying service, a banking service, an authentication service, interlibrary loans, a Z39.50 or Web server.'),
(17,'Software','A computer program in source or compiled form. Examples include a C source file, MS-Windows .exe executable, or Perl script.');
/*!40000 ALTER TABLE `omeka_item_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_item_types_elements`
--

DROP TABLE IF EXISTS `omeka_item_types_elements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_item_types_elements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_type_id` int(10) unsigned NOT NULL,
  `element_id` int(10) unsigned NOT NULL,
  `order` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `item_type_id_element_id` (`item_type_id`,`element_id`),
  KEY `item_type_id` (`item_type_id`),
  KEY `element_id` (`element_id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_item_types_elements`
--

LOCK TABLES `omeka_item_types_elements` WRITE;
/*!40000 ALTER TABLE `omeka_item_types_elements` DISABLE KEYS */;
INSERT INTO `omeka_item_types_elements` VALUES
(1,1,7,NULL),
(2,1,1,NULL),
(3,6,7,NULL),
(6,6,10,NULL),
(7,3,7,NULL),
(8,3,11,NULL),
(9,3,12,NULL),
(10,3,13,NULL),
(11,3,14,NULL),
(12,3,5,NULL),
(13,5,7,NULL),
(14,5,11,NULL),
(15,5,15,NULL),
(16,5,5,NULL),
(17,4,7,NULL),
(18,4,11,NULL),
(19,4,15,NULL),
(20,4,5,NULL),
(21,4,2,NULL),
(22,4,3,NULL),
(23,4,4,NULL),
(24,4,16,NULL),
(25,9,17,NULL),
(26,9,18,NULL),
(27,9,20,NULL),
(28,9,19,NULL),
(29,9,21,NULL),
(30,9,22,NULL),
(31,9,23,NULL),
(32,10,24,NULL),
(33,10,25,NULL),
(34,10,26,NULL),
(35,10,11,NULL),
(36,10,27,NULL),
(37,7,6,NULL),
(38,11,28,NULL),
(39,8,29,NULL),
(40,8,30,NULL),
(41,8,11,NULL),
(42,12,31,NULL),
(43,12,32,NULL),
(44,12,33,NULL),
(45,12,34,NULL),
(46,12,35,NULL),
(47,12,36,NULL);
/*!40000 ALTER TABLE `omeka_item_types_elements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_items`
--

DROP TABLE IF EXISTS `omeka_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_type_id` int(10) unsigned DEFAULT NULL,
  `collection_id` int(10) unsigned DEFAULT NULL,
  `featured` tinyint(4) NOT NULL,
  `public` tinyint(4) NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added` timestamp NOT NULL DEFAULT '2000-01-01 00:00:00',
  `owner_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_type_id` (`item_type_id`),
  KEY `collection_id` (`collection_id`),
  KEY `public` (`public`),
  KEY `featured` (`featured`),
  KEY `owner_id` (`owner_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_items`
--

LOCK TABLES `omeka_items` WRITE;
/*!40000 ALTER TABLE `omeka_items` DISABLE KEYS */;
INSERT INTO `omeka_items` VALUES
(1,NULL,1,1,1,'2018-07-17 15:33:11','2018-07-17 13:20:22',1),
(2,NULL,1,0,1,'2018-08-06 19:21:49','2018-07-17 13:23:26',1),
(3,NULL,1,0,1,'2018-07-17 14:13:39','2018-07-17 13:26:09',1),
(4,NULL,2,0,1,'2019-11-04 21:00:45','2018-07-17 14:36:40',1),
(5,NULL,2,0,1,'2019-11-04 21:00:53','2018-07-17 14:54:02',1),
(6,NULL,2,0,1,'2019-11-04 21:01:00','2018-07-17 14:55:07',1),
(7,NULL,2,0,1,'2019-11-04 21:01:06','2018-07-17 14:56:14',1),
(8,NULL,2,0,1,'2019-11-04 21:01:14','2018-07-17 14:56:59',1),
(9,NULL,2,0,1,'2019-11-04 21:01:23','2018-07-17 14:57:39',1),
(10,NULL,2,0,1,'2019-11-04 21:01:35','2018-07-17 14:59:10',1),
(11,NULL,2,0,1,'2019-11-04 21:01:42','2018-07-17 15:01:48',1),
(12,NULL,2,0,1,'2019-11-04 21:01:49','2018-07-17 15:08:51',1),
(13,NULL,2,0,1,'2019-11-04 21:01:55','2018-07-17 15:10:55',1),
(15,NULL,3,1,1,'2019-11-04 22:49:14','2018-07-17 17:46:58',1),
(16,NULL,3,0,1,'2019-11-04 22:49:20','2018-07-17 17:47:54',1),
(18,NULL,3,0,1,'2019-11-04 22:49:31','2018-07-17 17:49:02',1),
(19,NULL,3,0,1,'2019-11-04 22:49:55','2018-07-17 17:49:30',1),
(20,NULL,3,0,1,'2019-11-04 22:50:02','2018-07-17 17:49:58',1),
(23,NULL,1,1,1,'2018-11-12 21:18:13','2018-08-01 17:40:11',2),
(24,NULL,1,1,1,'2018-08-06 19:21:24','2018-08-06 19:14:40',2),
(25,NULL,1,0,0,'2018-08-14 16:29:03','2018-08-06 19:20:05',2),
(27,NULL,1,1,1,'2018-08-14 16:19:11','2018-08-14 16:15:23',2),
(28,NULL,1,1,1,'2018-08-14 16:28:11','2018-08-14 16:28:11',2),
(29,NULL,1,1,1,'2018-08-14 16:33:07','2018-08-14 16:33:07',2),
(30,NULL,1,1,1,'2018-11-12 21:17:56','2018-08-22 00:21:18',2),
(32,NULL,1,1,1,'2018-11-12 21:17:24','2018-08-22 00:38:31',2),
(37,NULL,3,0,0,'2019-11-04 22:49:25','2019-11-04 20:18:58',1),
(46,NULL,3,0,0,'2024-05-03 23:30:56','2024-05-03 23:10:31',1),
(47,NULL,3,0,1,'2024-05-03 23:33:28','2024-05-03 23:33:07',10),
(48,NULL,3,0,1,'2024-08-28 01:18:36','2024-05-03 23:36:19',10),
(49,NULL,2,0,1,'2024-09-27 16:43:00','2024-09-20 18:53:41',10),
(50,NULL,2,0,1,'2024-09-27 16:42:59','2024-09-20 18:55:55',10);
/*!40000 ALTER TABLE `omeka_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_keys`
--

DROP TABLE IF EXISTS `omeka_keys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_keys` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `label` varchar(100) NOT NULL,
  `key` char(40) NOT NULL,
  `ip` varbinary(16) DEFAULT NULL,
  `accessed` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_keys`
--

LOCK TABLES `omeka_keys` WRITE;
/*!40000 ALTER TABLE `omeka_keys` DISABLE KEYS */;
/*!40000 ALTER TABLE `omeka_keys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_options`
--

DROP TABLE IF EXISTS `omeka_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `value` mediumtext DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=444 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_options`
--

LOCK TABLES `omeka_options` WRITE;
/*!40000 ALTER TABLE `omeka_options` DISABLE KEYS */;
INSERT INTO `omeka_options` VALUES
(7,'thumbnail_constraint','200'),
(8,'square_thumbnail_constraint','200'),
(9,'fullsize_constraint','800'),
(10,'per_page_admin','10'),
(11,'per_page_public','10'),
(12,'show_empty_elements','0'),
(14,'admin_theme','default'),
(20,'display_system_info','1'),
(26,'search_record_types','a:3:{s:4:\"Item\";s:4:\"Item\";s:4:\"File\";s:4:\"File\";s:10:\"Collection\";s:10:\"Collection\";}'),
(27,'api_enable',''),
(28,'api_per_page','50'),
(29,'show_element_set_headings','1'),
(30,'use_square_thumbnail','1'),
(34,'theme_seasons_options','a:13:{s:11:\"style_sheet\";s:6:\"winter\";s:4:\"logo\";N;s:21:\"display_featured_item\";s:1:\"1\";s:27:\"display_featured_collection\";s:1:\"1\";s:24:\"display_featured_exhibit\";s:1:\"1\";s:21:\"homepage_recent_items\";N;s:13:\"homepage_text\";N;s:11:\"footer_text\";N;s:24:\"display_footer_copyright\";s:1:\"0\";s:17:\"item_file_gallery\";s:1:\"0\";s:19:\"use_advanced_search\";s:1:\"1\";s:12:\"exhibits_nav\";s:4:\"side\";s:17:\"theme_config_csrf\";N;}'),
(36,'theme_bootstrap_options','a:9:{s:4:\"logo\";N;s:13:\"homepage_text\";N;s:11:\"footer_text\";N;s:20:\"use_google_analytics\";s:1:\"1\";s:24:\"google_analytics_account\";N;s:11:\"site_editor\";N;s:13:\"site_location\";N;s:16:\"site_institution\";N;s:17:\"theme_config_csrf\";N;}'),
(42,'theme_default_options','a:18:{s:10:\"text_color\";s:7:\"#444444\";s:16:\"background_color\";s:7:\"#FFFFFF\";s:10:\"link_color\";s:7:\"#888888\";s:12:\"button_color\";s:7:\"#000000\";s:17:\"button_text_color\";s:7:\"#FFFFFF\";s:18:\"header_title_color\";s:7:\"#000000\";s:4:\"logo\";N;s:17:\"header_background\";N;s:11:\"footer_text\";N;s:24:\"display_footer_copyright\";s:1:\"0\";s:21:\"display_featured_item\";s:1:\"1\";s:27:\"display_featured_collection\";s:1:\"1\";s:24:\"display_featured_exhibit\";s:1:\"1\";s:21:\"homepage_recent_items\";N;s:13:\"homepage_text\";N;s:17:\"item_file_gallery\";s:1:\"1\";s:19:\"use_advanced_search\";s:1:\"1\";s:17:\"theme_config_csrf\";N;}'),
(44,'theme_berlin_options','a:11:{s:4:\"logo\";N;s:12:\"header_image\";N;s:21:\"display_featured_item\";s:1:\"1\";s:27:\"display_featured_collection\";s:1:\"1\";s:24:\"display_featured_exhibit\";s:1:\"1\";s:21:\"homepage_recent_items\";N;s:13:\"homepage_text\";N;s:11:\"footer_text\";N;s:24:\"display_footer_copyright\";s:1:\"0\";s:19:\"use_advanced_search\";s:1:\"0\";s:17:\"theme_config_csrf\";N;}'),
(66,'css_editor_css','.navbar .nav {\nmargin:0\n}\n\n#metawho {\nbackground:#fafafa;\nwidth:99%\n}\n\n#metawhat {\nbackground:#fafafa;\nwidth:99%\n}\n\n#metawhere {\nbackground:#fafafa;\nwidth:99%\n}\n\n#itemfiles {\nheight:1100px\n}\n\n#metawhen {\nbackground:#fafafa;\nwidth:99%\n}\n\n.navbar-inner {\npadding-left:0;\npadding-right:0;\nborder-radius:0\n}\n\n.lead {\nfont-size:14px\n}\n\n#customheadertextspan {\nmargin-left:0;\npadding:5px\n}\n\n#primary {\nwidth:100%;\npadding:10px\n}\n\n#csearchtext {\ncolor:#fff\n}\n\n#footer {\nwidth:100%\n}\n\n.footer-distributed {\nbackground:#0033A0\n}\n\n.page-header {\npadding-bottom:0;\nmargin:0;\nborder-bottom:0\n}\n\n#site-title h1 a img {\nheight:100px\n}\n\n#headcontainer {\nwidth:100%;\nbackground:#0033A0\n}\n\n#header .span8 {\nmargin-left:80px\n}\n\n.navbar {\nmargin-bottom:0\n}\n\n#header .span4 {\nfloat:right;\nmargin-right:30px\n}\n\n.search-query {\nborder-radius:0 !important\n}\n\n.simple-search {\nheight:30px !important\n}\n\n#advlink {\nmargin-left:15px\n}\n\n#primary-nav ul li ul li {\ndisplay:none\n}\n\n#mobile-nav ul li ul {\ndisplay:none\n}'),
(69,'theme_bootstraprev_options','a:10:{s:4:\"logo\";s:36:\"a8ed343b3e78620d94b9c699fa9046ee.png\";s:15:\"homepage_search\";s:53:\"<div style=\"border:1px dotted;\">Homepage Search</div>\";s:13:\"homepage_text\";s:51:\"<div style=\"border:1px dotted;\">Homepage Text</div>\";s:13:\"homepage_news\";s:51:\"<div style=\"border:1px dotted;\">Homepage News</div>\";s:11:\"footer_text\";s:49:\"<div style=\"border:1px dotted;\">Footer Text</div>\";s:20:\"use_google_analytics\";s:1:\"0\";s:24:\"google_analytics_account\";s:0:\"\";s:11:\"site_editor\";s:0:\"\";s:13:\"site_location\";s:0:\"\";s:16:\"site_institution\";s:0:\"\";}'),
(87,'theme_omeuka_options','a:3:{s:8:\"euk_base\";s:5:\"/eukr\";s:8:\"euk_solr\";s:43:\"https://euk-demo.ukpdp.org/test/solr/select\";s:12:\"euk_typedict\";s:385:\"{\"archival material\":[\"collection\"],\"athletic publications\":[\"text\"],\"books\":[\"text\"],\"collections\":[\"collection\"],\"course catalogs\":[\"text\"],\"directories\":[\"text\"],\"images\":[\"image\"],\"journals\":[\"text\"],\"ledgers\":[\"text\"],\"maps\":[\"image\"],\"minutes\":[\"text\"],\"newspapers\":[\"text\"],\"oral histories\":[\"sound\"],\"scrapbooks\":[\"text\",\"image\"],\"theses\":[\"text\"],\"yearbooks\":[\"text\",\"image\"]}\";}'),
(125,'public_theme','omeukaprologue'),
(216,'disable_default_file_validation','0'),
(217,'file_extension_whitelist','aac,aif,aiff,asf,asx,avi,bmp,c,cc,class,css,divx,doc,docx,exe,gif,gz,gzip,h,ico,j2k,jp2,jpe,jpeg,jpg,m4a,m4v,mdb,mid,midi,mov,mp2,mp3,mp4,mpa,mpe,mpeg,mpg,mpp,odb,odc,odf,odg,odp,ods,odt,ogg,opus,pdf,png,pot,pps,ppt,pptx,qt,ra,ram,rtf,rtx,swf,tar,tif,tiff,txt,wav,wax,webm,wma,wmv,wmx,wri,xla,xls,xlsx,xlt,xlw,zip'),
(218,'file_mime_type_whitelist','application/msword,application/ogg,application/pdf,application/rtf,application/vnd.ms-access,application/vnd.ms-excel,application/vnd.ms-powerpoint,application/vnd.ms-project,application/vnd.ms-write,application/vnd.oasis.opendocument.chart,application/vnd.oasis.opendocument.database,application/vnd.oasis.opendocument.formula,application/vnd.oasis.opendocument.graphics,application/vnd.oasis.opendocument.presentation,application/vnd.oasis.opendocument.spreadsheet,application/vnd.oasis.opendocument.text,application/x-ms-wmp,application/x-ogg,application/x-gzip,application/x-msdownload,application/x-shockwave-flash,application/x-tar,application/zip,audio/aac,audio/aiff,audio/mid,audio/midi,audio/mp3,audio/mp4,audio/mpeg,audio/mpeg3,audio/ogg,audio/wav,audio/wma,audio/x-aac,audio/x-aiff,audio/x-m4a,audio/x-midi,audio/x-mp3,audio/x-mp4,audio/x-mpeg,audio/x-mpeg3,audio/x-mpegaudio,audio/x-ms-wax,audio/x-realaudio,audio/x-wav,audio/x-wma,image/bmp,image/gif,image/icon,image/jpeg,image/pjpeg,image/png,image/tiff,image/x-icon,image/x-ms-bmp,text/css,text/plain,text/richtext,text/rtf,video/asf,video/avi,video/divx,video/mp4,video/mpeg,video/msvideo,video/ogg,video/quicktime,video/webm,video/x-m4v,video/x-ms-wmv,video/x-msvideo'),
(219,'recaptcha_public_key',''),
(220,'recaptcha_private_key',''),
(221,'html_purifier_is_enabled','0'),
(222,'html_purifier_allowed_html_elements','p,br,strong,em,span,div,ul,ol,li,a,h1,h2,h3,h4,h5,h6,address,pre,table,tr,td,blockquote,thead,tfoot,tbody,th,dl,dt,dd,q,small,strike,sup,sub,b,i,big,small,tt,img'),
(223,'html_purifier_allowed_html_attributes','*.*'),
(275,'site_title','ExploreUK'),
(276,'description',''),
(277,'administrator_email','m.slone@uky.edu'),
(278,'copyright',''),
(279,'author',''),
(280,'tag_delimiter',','),
(281,'path_to_convert','/usr/bin'),
(288,'simple_vocab_files','1'),
(383,'hide_elements_settings','{\"override\":[],\"form\":{\"Dublin Core\":{\"Subject\":\"1\",\"Description\":\"1\",\"Creator\":\"1\",\"Source\":\"1\",\"Publisher\":\"1\",\"Date\":\"1\",\"Contributor\":\"1\",\"Rights\":\"1\",\"Format\":\"1\",\"Language\":\"1\",\"Type\":\"1\",\"Coverage\":\"1\"}},\"admin\":{\"Dublin Core\":{\"Subject\":\"1\",\"Description\":\"1\",\"Creator\":\"1\",\"Source\":\"1\",\"Publisher\":\"1\",\"Date\":\"1\",\"Contributor\":\"1\",\"Rights\":\"1\",\"Format\":\"1\",\"Language\":\"1\",\"Type\":\"1\",\"Coverage\":\"1\"}},\"public\":{\"Dublin Core\":{\"Subject\":\"1\",\"Description\":\"1\",\"Creator\":\"1\",\"Source\":\"1\",\"Publisher\":\"1\",\"Date\":\"1\",\"Contributor\":\"1\",\"Rights\":\"1\",\"Format\":\"1\",\"Language\":\"1\",\"Type\":\"1\",\"Coverage\":\"1\"}},\"search\":{\"Dublin Core\":{\"49\":\"1\",\"41\":\"1\",\"39\":\"1\",\"48\":\"1\",\"45\":\"1\",\"40\":\"1\",\"37\":\"1\",\"47\":\"1\",\"42\":\"1\",\"44\":\"1\",\"51\":\"1\",\"38\":\"1\"}}}'),
(423,'theme_omeukaprologue_options','a:6:{s:8:\"euk_solr\";s:37:\"https://solrindex.uky.edu/solr/select\";s:23:\"euk_findingaid_base_url\";s:44:\"https://exploreuk.uky.edu/fa/findingaid/?id=\";s:22:\"euk_dip_store_base_url\";s:30:\"https://exploreuk.uky.edu/dips\";s:12:\"euk_typedict\";s:684:\"{\"archival material\":[\"collection\"],\"athletic publications\":[\"text\"],\"books\":[\"text\"],\"bulletins\":[\"text\"],\"collections\":[\"collection\"],\"course catalogs\":[\"text\"],\"diaries\":[\"text\"],\"directories\":[\"text\"],\"guidebooks\":[\"text\",\"image\"],\"images\":[\"image\"],\"journals\":[\"text\"],\"ledgers\":[\"text\"],\"maps\":[\"text\",\"image\"],\"minutes\":[\"text\"],\"newspapers\":[\"text\"],\"oral histories\":[\"sound\"],\"posters\":[\"text\",\"image\"],\"programs (documents)\":[\"text\",\"image\"],\"scrapbooks\":[\"text\",\"image\"],\"theses\":[\"text\"],\"yearbooks\":[\"text\",\"image\"],\"theses\":[\"text\"],\"dissertations\":[\"text\"],\"drawings (visual works)\":[\"image\"],\"16mm (photographic film size)\":[\"movingimage\"],\"recipies\":[\"text\",\"image\"]}\";s:23:\"search_items_count_text\";s:354:\"Search 530,000+ digitized collections, prints, photographs, maps, manuscripts, streaming video, and more from <a href=\"https://libraries.uky.edu/locations/special-collections-research-center\" target=\"_blank\" rel=\"noopener\">UK Special Collections Research Center</a> and <a href=\"https://libraries.uky.edu/\" target=\"_blank\" rel=\"noopener\">UK Libraries</a>\";s:4:\"logo\";s:36:\"aff519a4f9ad19bad7f6751c0fb9d294.png\";}'),
(424,'omeka_version','3.1.1'),
(425,'public_navigation_main','[{\"uid\":\"\\/items\\/browse\",\"can_delete\":false,\"type\":\"Omeka_Navigation_Page_Uri\",\"label\":\"Browse Items\",\"fragment\":null,\"id\":null,\"class\":null,\"title\":null,\"target\":null,\"accesskey\":null,\"rel\":[],\"rev\":[],\"customHtmlAttribs\":[],\"order\":1,\"resource\":null,\"privilege\":null,\"active\":false,\"visible\":false,\"pages\":[],\"uri\":\"\\/items\\/browse\"},{\"uid\":\"\\/collections\\/browse\",\"can_delete\":false,\"type\":\"Omeka_Navigation_Page_Uri\",\"label\":\"Browse Collections\",\"fragment\":null,\"id\":null,\"class\":null,\"title\":null,\"target\":null,\"accesskey\":null,\"rel\":[],\"rev\":[],\"customHtmlAttribs\":[],\"order\":2,\"resource\":null,\"privilege\":null,\"active\":false,\"visible\":false,\"pages\":[],\"uri\":\"\\/collections\\/browse\"},{\"uid\":\"\\/about-exploreuk\",\"can_delete\":false,\"type\":\"Omeka_Navigation_Page_Uri\",\"label\":\"About ExploreUK\",\"fragment\":null,\"id\":null,\"class\":null,\"title\":null,\"target\":null,\"accesskey\":null,\"rel\":[],\"rev\":[],\"customHtmlAttribs\":[],\"order\":3,\"resource\":null,\"privilege\":null,\"active\":false,\"visible\":false,\"pages\":[],\"uri\":\"\\/about-exploreuk\"},{\"uid\":\"\\/about-exploreuk2\",\"can_delete\":true,\"type\":\"Omeka_Navigation_Page_Uri\",\"label\":\"About\",\"fragment\":null,\"id\":null,\"class\":null,\"title\":null,\"target\":null,\"accesskey\":null,\"rel\":[],\"rev\":[],\"customHtmlAttribs\":[],\"order\":4,\"resource\":null,\"privilege\":null,\"active\":false,\"visible\":true,\"pages\":[{\"uid\":\"\\/about\",\"can_delete\":false,\"type\":\"Omeka_Navigation_Page_Uri\",\"label\":\"About ExploreUK\",\"fragment\":null,\"id\":null,\"class\":null,\"title\":null,\"target\":null,\"accesskey\":null,\"rel\":[],\"rev\":[],\"customHtmlAttribs\":[],\"order\":5,\"resource\":null,\"privilege\":null,\"active\":false,\"visible\":true,\"pages\":[],\"uri\":\"\\/about\"},{\"uid\":\"\\/new-exploreuk\",\"can_delete\":false,\"type\":\"Omeka_Navigation_Page_Uri\",\"label\":\"About the New Site\",\"fragment\":null,\"id\":null,\"class\":null,\"title\":null,\"target\":null,\"accesskey\":null,\"rel\":[],\"rev\":[],\"customHtmlAttribs\":[],\"order\":6,\"resource\":null,\"privilege\":null,\"active\":false,\"visible\":false,\"pages\":[],\"uri\":\"\\/new-exploreuk\"}],\"uri\":\"\\/about-exploreuk2\"},{\"uid\":\"\\/\",\"can_delete\":true,\"type\":\"Omeka_Navigation_Page_Uri\",\"label\":\"How to\",\"fragment\":null,\"id\":null,\"class\":null,\"title\":null,\"target\":null,\"accesskey\":null,\"rel\":[],\"rev\":[],\"customHtmlAttribs\":[],\"order\":7,\"resource\":null,\"privilege\":null,\"active\":false,\"visible\":true,\"pages\":[{\"uid\":\"https:\\/\\/libguides.uky.edu\\/SCRCaccount\",\"can_delete\":true,\"label\":\"Activate your Researcher Account\",\"fragment\":null,\"id\":null,\"class\":null,\"title\":null,\"target\":null,\"accesskey\":null,\"rel\":[],\"rev\":[],\"customHtmlAttribs\":[],\"order\":8,\"resource\":null,\"privilege\":null,\"active\":false,\"visible\":true,\"type\":\"Omeka_Navigation_Page_Uri\",\"pages\":[],\"uri\":\"https:\\/\\/libguides.uky.edu\\/SCRCaccount\"},{\"uid\":\"https:\\/\\/libguides.uky.edu\\/SCRCaccount\\/archivesrequests\",\"can_delete\":true,\"type\":\"Omeka_Navigation_Page_Uri\",\"label\":\"Request Materials\",\"fragment\":null,\"id\":null,\"class\":null,\"title\":null,\"target\":null,\"accesskey\":null,\"rel\":[],\"rev\":[],\"customHtmlAttribs\":[],\"order\":9,\"resource\":null,\"privilege\":null,\"active\":false,\"visible\":true,\"pages\":[],\"uri\":\"https:\\/\\/libguides.uky.edu\\/SCRCaccount\\/archivesrequests\"},{\"uid\":\"https:\\/\\/libraries.uky.edu\\/locations\\/special-collections-research-center\",\"can_delete\":true,\"type\":\"Omeka_Navigation_Page_Uri\",\"label\":\"Visit SCRC\",\"fragment\":null,\"id\":null,\"class\":null,\"title\":null,\"target\":null,\"accesskey\":null,\"rel\":[],\"rev\":[],\"customHtmlAttribs\":[],\"order\":10,\"resource\":null,\"privilege\":null,\"active\":false,\"visible\":true,\"pages\":[],\"uri\":\"https:\\/\\/libraries.uky.edu\\/locations\\/special-collections-research-center\"},{\"uid\":\"\\/takedown-policy\",\"can_delete\":false,\"type\":\"Omeka_Navigation_Page_Uri\",\"label\":\"Find Copyright and Use Information\",\"fragment\":null,\"id\":null,\"class\":null,\"title\":null,\"target\":null,\"accesskey\":null,\"rel\":[],\"rev\":[],\"customHtmlAttribs\":[],\"order\":11,\"resource\":null,\"privilege\":null,\"active\":false,\"visible\":true,\"pages\":[],\"uri\":\"\\/takedown-policy\"}],\"uri\":\"\\/\"},{\"uid\":\"https:\\/\\/libraries.uky.edu\\/ContactSCRC\",\"can_delete\":true,\"type\":\"Omeka_Navigation_Page_Uri\",\"label\":\"Contact Us\",\"fragment\":null,\"id\":null,\"class\":null,\"title\":null,\"target\":null,\"accesskey\":null,\"rel\":[],\"rev\":[],\"customHtmlAttribs\":[],\"order\":12,\"resource\":null,\"privilege\":null,\"active\":false,\"visible\":true,\"pages\":[],\"uri\":\"https:\\/\\/libraries.uky.edu\\/ContactSCRC\"},{\"uid\":\"https:\\/\\/requests-libraries.uky.edu\\/\",\"can_delete\":true,\"type\":\"Omeka_Navigation_Page_Uri\",\"label\":\"Researcher Account Login\",\"fragment\":null,\"id\":null,\"class\":null,\"title\":null,\"target\":null,\"accesskey\":null,\"rel\":[],\"rev\":[],\"customHtmlAttribs\":[],\"order\":13,\"resource\":null,\"privilege\":null,\"active\":false,\"visible\":true,\"pages\":[],\"uri\":\"https:\\/\\/requests-libraries.uky.edu\\/\"},{\"uid\":\"https:\\/\\/example.com\\/copyuse\",\"can_delete\":true,\"type\":\"Omeka_Navigation_Page_Uri\",\"label\":\"xxx unused Find Copyright and Use Information\",\"fragment\":null,\"id\":null,\"class\":null,\"title\":null,\"target\":null,\"accesskey\":null,\"rel\":[],\"rev\":[],\"customHtmlAttribs\":[],\"order\":14,\"resource\":null,\"privilege\":null,\"active\":false,\"visible\":false,\"pages\":[],\"uri\":\"https:\\/\\/example.com\\/copyuse\"},{\"uid\":\"\\/xxx-list-test\",\"can_delete\":false,\"type\":\"Omeka_Navigation_Page_Uri\",\"label\":\"xxx List test\",\"fragment\":null,\"id\":null,\"class\":null,\"title\":null,\"target\":null,\"accesskey\":null,\"rel\":[],\"rev\":[],\"customHtmlAttribs\":[],\"order\":15,\"resource\":null,\"privilege\":null,\"active\":false,\"visible\":false,\"pages\":[],\"uri\":\"\\/xxx-list-test\"}]'),
(426,'homepage_uri','/'),
(443,'omeka_update','a:2:{s:14:\"latest_version\";s:6:\"3.1.2\n\";s:12:\"last_updated\";i:1757006819;}');
/*!40000 ALTER TABLE `omeka_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_plugins`
--

DROP TABLE IF EXISTS `omeka_plugins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_plugins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `version` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `active_idx` (`active`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_plugins`
--

LOCK TABLES `omeka_plugins` WRITE;
/*!40000 ALTER TABLE `omeka_plugins` DISABLE KEYS */;
INSERT INTO `omeka_plugins` VALUES
(6,'CSSEditor',0,'1.2'),
(7,'SimplePages',1,'3.2.1'),
(8,'AdminImages',0,'1.6'),
(9,'SimpleVocab',0,'2.2.3'),
(10,'HideElements',1,'1.3');
/*!40000 ALTER TABLE `omeka_plugins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_processes`
--

DROP TABLE IF EXISTS `omeka_processes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_processes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `class` varchar(255) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned DEFAULT NULL,
  `status` enum('starting','in progress','completed','paused','error','stopped') NOT NULL,
  `args` mediumtext NOT NULL,
  `started` timestamp NOT NULL DEFAULT '2000-01-01 00:00:00',
  `stopped` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `pid` (`pid`),
  KEY `started` (`started`),
  KEY `stopped` (`stopped`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_processes`
--

LOCK TABLES `omeka_processes` WRITE;
/*!40000 ALTER TABLE `omeka_processes` DISABLE KEYS */;
/*!40000 ALTER TABLE `omeka_processes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_records_tags`
--

DROP TABLE IF EXISTS `omeka_records_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_records_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_id` int(10) unsigned NOT NULL,
  `record_type` varchar(50) NOT NULL DEFAULT '',
  `tag_id` int(10) unsigned NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag` (`record_type`,`record_id`,`tag_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_records_tags`
--

LOCK TABLES `omeka_records_tags` WRITE;
/*!40000 ALTER TABLE `omeka_records_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `omeka_records_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_schema_migrations`
--

DROP TABLE IF EXISTS `omeka_schema_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_schema_migrations` (
  `version` varchar(16) NOT NULL,
  UNIQUE KEY `unique_schema_migrations` (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_schema_migrations`
--

LOCK TABLES `omeka_schema_migrations` WRITE;
/*!40000 ALTER TABLE `omeka_schema_migrations` DISABLE KEYS */;
INSERT INTO `omeka_schema_migrations` VALUES
('20100401000000'),
('20100810120000'),
('20110113000000'),
('20110124000001'),
('20110301103900'),
('20110328192100'),
('20110426181300'),
('20110601112200'),
('20110627223000'),
('20110824110000'),
('20120112100000'),
('20120220000000'),
('20120221000000'),
('20120224000000'),
('20120224000001'),
('20120402000000'),
('20120516000000'),
('20120612112000'),
('20120623095000'),
('20120710000000'),
('20120723000000'),
('20120808000000'),
('20120808000001'),
('20120813000000'),
('20120914000000'),
('20121007000000'),
('20121015000000'),
('20121015000001'),
('20121018000001'),
('20121110000000'),
('20121218000000'),
('20130422000000'),
('20130426000000'),
('20130429000000'),
('20130701000000'),
('20130809000000'),
('20140304131700'),
('20150211000000'),
('20150310141100'),
('20150814155100'),
('20151118214800'),
('20151209103299'),
('20151209103300'),
('20161209171900'),
('20170331084000'),
('20170405125800'),
('20200127165700');
/*!40000 ALTER TABLE `omeka_schema_migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_search_texts`
--

DROP TABLE IF EXISTS `omeka_search_texts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_search_texts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `record_type` varchar(30) NOT NULL,
  `record_id` int(10) unsigned NOT NULL,
  `public` tinyint(1) NOT NULL,
  `title` longtext DEFAULT NULL,
  `text` longtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `record_name` (`record_type`,`record_id`),
  FULLTEXT KEY `text` (`text`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_search_texts`
--

LOCK TABLES `omeka_search_texts` WRITE;
/*!40000 ALTER TABLE `omeka_search_texts` DISABLE KEYS */;
INSERT INTO `omeka_search_texts` VALUES
(1,'SimplePagesPage',1,1,'About','About <p><span style=\"font-weight: 400;\">ExploreUK is the gateway to many of </span><a href=\"http://libraries.uky.edu/\" target=\"_blank\" rel=\"noopener\" title=\"University of Kentucky Libraries’\"><span style=\"font-weight: 400;\">University of Kentucky Libraries’</span></a><span style=\"font-weight: 400;\"> rare and unique resources, particularly those housed in the </span><a href=\"https://libraries.uky.edu/locations/special-collections-research-center\" target=\"_blank\" rel=\"noopener\" title=\"Special Collections Research Center\"><span style=\"font-weight: 400;\">Special Collections Research Center</span></a><span style=\"font-weight: 400;\">. ExploreUK provides free and public access to digital materials for research, teaching, and curious exploration. </span></p>\r\n<p><span style=\"font-weight: 400;\">Materials include manuscript collections, rare books, photographs, organizational records, newspapers, maps, architectural drawings, government publications, University of Kentucky archives, and more. The collections document the social, cultural, economic, and political history of the Commonwealth of Kentucky, but also include materials of national and international significance.</span><span style=\"font-weight: 400;\"></span></p>\r\n<h2><b>Content Types</b></h2>\r\n<p><span style=\"font-weight: 400;\">When searching ExploreUK, you will discover the following content types:</span></p>\r\n<p><b>Collection guides</b><span style=\"font-weight: 400;\"> (also known as “finding aids”): These documents contain detailed information about a specific collection of papers or records and often include an inventory or box list. Use collection guides to determine if materials within a collection is relevant to your interests. When a collection has been digitized, the scans are embedded within the guide as well as discoverable individually through the ExploreUK search tool.</span></p>\r\n<p><b>Digitized items<span style=\"font-weight: 400;\">: The Special Collections Research Center digitizes a portion of its rare and unique collections for online access. These scans can be accessed and downloaded through ExploreUK. Some digital content is described within collection guides (see above) while others are described by basic descriptive metadata. </span><span style=\"font-weight: 400;\">Users are responsible for securing appropriate permissions</span><span style=\"font-weight: 400;\">.</span></b></p>\r\n<p><b>Born-digital items</b><span>: In some cases, materials are created as digital formats, like .pdf, .jpeg, and .wav files. These are also available through ExploreUK. Like digitized items, they may be described within a collection guide or by basic descriptive metadata.</span></p>\r\n<h2><b>Platform and Tools</b></h2>\r\n<p><span style=\"font-weight: 400;\">ExploreUK uses a combination of the following:</span></p>\r\n<ul>\r\n<li><a href=\"https://omeka.org/\" target=\"_blank\" rel=\"noopener\" title=\"Omeka Classic\"><span style=\"font-weight: 400;\">Omeka Classic</span></a><span style=\"font-weight: 400;\"> with a highly customized theme</span></li>\r\n<li><span style=\"font-weight: 400;\">Apache Solr</span></li>\r\n<li><span style=\"font-weight: 400;\"><a href=\"https://www.uky.edu/its/\" target=\"_blank\" rel=\"noopener\" title=\"University of Kentucky Information Technology Services\">University of Kentucky Information Technology Services</a> infrastructure for AIPs and DIPs storage</span></li>\r\n<li><span style=\"font-weight: 400;\">Collection guides and related information are managed by the </span><a href=\"http://archivesspace.org/\" target=\"_blank\" rel=\"noopener\" title=\"ArchivesSpace\"><span style=\"font-weight: 400;\">ArchivesSpace</span></a><span style=\"font-weight: 400;\"> information management application.</span></li>\r\n</ul>\r\n<p></p>\r\n<p>Visit the <a href=\"https://github.com/uklibraries\" target=\"_blank\" rel=\"noopener\" title=\"UK Libraries GitHub page\"><span>UK Libraries GitHub page</span></a><span> for more information.</span></p>\r\n<p></p>\r\n<h2><b>Acknowledgements </b></h2>\r\n<p><span style=\"font-weight: 400;\">A portion of the collection guides and digitized content on ExploreUK was made possible by support from t</span><span style=\"font-weight: 400;\">he </span><a href=\"https://www.clir.org/\" target=\"_blank\" rel=\"noopener\" title=\"Council on Library and Information Resources\"><span style=\"font-weight: 400;\">Council on Library and Information Resources</span></a><span style=\"font-weight: 400;\">, </span><a href=\"https://www.imls.gov/\" target=\"_blank\" rel=\"noopener\" title=\"Institute of Museum and Library Services\"><span style=\"font-weight: 400;\">Institute of Museum and Library Services</span></a><span style=\"font-weight: 400;\">, </span><a href=\"https://www.heyburninitiative.org/\" target=\"_blank\" rel=\"noopener\" title=\"The John G. Heyburn II Initiative for Excellence in the Federal Judiciary\"><span style=\"font-weight: 400;\">The John G. Heyburn II Initiative for Excellence in the Federal Judiciary</span></a><span style=\"font-weight: 400;\">, the </span><a href=\"https://www.neh.gov/\" target=\"_blank\" rel=\"noopener\" title=\"National Endowment for the Humanities\"><span style=\"font-weight: 400;\">National Endowment for the Humanities</span></a><span style=\"font-weight: 400;\">, and the </span><a href=\"https://www.archives.gov/nhprc\" target=\"_blank\" rel=\"noopener\" title=\"National Historical Publications &amp; Records Commission\"><span style=\"font-weight: 400;\">National Historical Publications &amp; Records Commission</span></a><span style=\"font-weight: 400;\">.&nbsp;</span></p> '),
(2,'SimplePagesPage',2,1,'Copyright, Use, and Take-Down Policies','Copyright, Use, and Take-Down Policies <h2>Copyright and Use</h2>\r\n<p>Disclaimer: The University of Kentucky Libraries Special Collections Research Center (SCRC) provides broad public access to collections as a contribution to education and scholarship. Most content in the digital libraries is protected by the U.S. Copyright Law (Title 17, U.S.C.). Use of the materials may also be subject to other legal rights, for example, rights of publicity, privacy rights, or other legal interests. Transmission or reproduction of materials protected by copyright beyond that allowed by fair use requires the written permission of the copyright owners. As noted, additional permissions may also be required. SCRC does not authorize any use or reproduction whatsoever for commercial purposes.</p>\r\n<p></p>\r\n<p>SCRC makes digital versions of collections accessible in the following situations: they are in the public domain; SCRC has permission to make them accessible online; materials are made accessible for education and research purposes as a legal fair use, or; there are no known restrictions on use.</p>\r\n<p></p>\r\n<p>Researchers should <a href=\"https://libraries.uky.edu/ContactSCRC\" target=\"_blank\" rel=\"noopener\" title=\"Contact SCRC\">contact SCRC</a> for additional information about rights, contacts, and permissions. Responsibility for making an independent legal assessment of an item and securing any necessary permissions ultimately rests with those persons wishing to use the item(s).</p>\r\n<h2>Take-Down Policies</h2>\r\n<p>The SCRC makes every effort to ensure that it has the appropriate rights to digitally preserve and provide access to its collections. Parties who have questions or concerns about the use of specific works may email the SCRC at scrc@uky.edu.</p>\r\n<p>With all such communications, please include:</p>\r\n<p>-- A physical or electronic signature of the copyright owner. NOTE: If an agent is providing the notification, also include a statement that the agent is authorized to act on behalf of the owner.</p>\r\n<p>-- Identification of the material that is claimed to be infringing or to be the subject of infringing activity and that is to be removed or access to which is to be disabled, and information reasonably sufficient to permit SCRC to locate the material. Providing URLs in your communication is the best way to help us locate content quickly.</p>\r\n<p>-- The reason for the request.</p>\r\n<p>All correspondence will be answered within a reasonable time by SCRC.</p> '),
(32,'Item',24,1,'Miners leaving a mine entrance in a cart with police watching, 1939, from the Harlan County Mine Strike Photographic Collection.','Miners leaving a mine entrance in a cart with police watching, 1939, from the Harlan County Mine Strike Photographic Collection. https://exploreuk.uky.edu/catalog/xt75tb0xq06w_1_9 '),
(4,'Item',1,1,'From the Jim Curtis photograph collection on Civil Rights in Kentucky','From the Jim Curtis photograph collection on Civil Rights in Kentucky /catalog/xt7gqn5z7t3j_8_1 '),
(5,'Collection',1,1,'Background image rotation','Background image rotation '),
(6,'Item',2,1,'From the James Edwin Weddle Photographic Collection','From the James Edwin Weddle Photographic Collection /catalog/xt734t6f3d29_4066_1 '),
(7,'Item',3,1,'From the Asa C. Chinn Downtown Lexington, Kentucky Photographic Collection','From the Asa C. Chinn Downtown Lexington, Kentucky Photographic Collection /catalog/xt7qrf5kb01p_1_184 '),
(8,'Collection',2,1,'Popular Resources','Popular Resources '),
(9,'Collection',3,1,'Additional Resources','Additional Resources '),
(10,'Item',4,1,'Collection Guides','Collection Guides /?f%5Bformat%5D%5B%5D=collections 01000 '),
(11,'Item',5,1,'Photos','Photos /?f%5Bformat%5D%5B%5D=images 02000 '),
(12,'Item',6,1,'UK Yearbooks','UK Yearbooks /?f%5Bformat%5D%5B%5D=yearbooks 03000 '),
(13,'Item',7,1,'Maps','Maps /?f%5Bformat%5D%5B%5D=maps 04000 '),
(14,'Item',8,1,'Books','Books /?f%5Bformat%5D%5B%5D=books 05000 '),
(15,'Item',9,1,'UK Athletic Publications','UK Athletic Publications /?f%5Bformat%5D%5B%5D=athletic+publications 06000 '),
(16,'Item',10,1,'UK Board of Trustees Minutes','UK Board of Trustees Minutes /catalog?f[source_s][]=Minutes%20of%20the%20University%20of%20Kentucky%20Board%20of%20Trustees 07000 '),
(17,'Item',11,1,'WPA Publications','WPA Publications /catalog/?q=%22Works+Progress+Administration+Publications%22 08000 '),
(18,'Item',12,1,'UK Course Catalogs','UK Course Catalogs /?f%5Bformat%5D%5B%5D=course+catalogs 09000 '),
(19,'Item',13,1,'Kentucky Kernel','Kentucky Kernel /catalog?f[source_s][]=The%20Kentucky%20Kernel 10000 '),
(21,'Item',15,1,'Louie B. Nunn Center for Oral History','Louie B. Nunn Center for Oral History https://kentuckyoralhistory.org/ 01000 '),
(22,'Item',16,1,'Notable Kentucky African Americans Database','Notable Kentucky African Americans Database https://nkaa.uky.edu/nkaa/ 02000 '),
(24,'Item',18,1,'University of Kentucky Libraries Microfilm Holdings database','University of Kentucky Libraries Microfilm Holdings database https://ukmfilms.omeka.net/ 04000 '),
(25,'Item',19,1,'Kentucky Digital Newspaper Program','Kentucky Digital Newspaper Program https://kentuckynewspapers.org/ 05000 '),
(26,'Item',20,1,'The Lomax Kentucky Recordings','The Lomax Kentucky Recordings https://lomaxky.omeka.net/ 06000 '),
(29,'SimplePagesPage',4,0,'Feedback','Feedback <p><iframe width=\"1000\" height=\"1300\" src=\"https://docs.google.com/forms/d/e/1FAIpQLScMopDorUB3mJV9gpMQB9kqcIJ4Usu2lNe5_g41tbikF1ix_w/viewform?embedded=true\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\">Loading...</iframe></p> '),
(30,'Item',23,1,'Fog in Mountain Valleys, Knott County, from the Karl Raitz Kentucky slides collection','Fog in Mountain Valleys, Knott County, from the Karl Raitz Kentucky slides collection https://exploreuk.uky.edu/catalog/xt7g4f1mkk62_331_1 '),
(33,'Item',25,0,'J.T. Denton; dog jumping over stick, 1935, from the Lafayette Studios photographs: 1930s decade','J.T. Denton; dog jumping over stick, 1935, from the Lafayette Studios photographs: 1930s decade https://exploreuk.uky.edu/catalog/xt702v2c8t1s_2858_1 '),
(35,'Item',27,1,'Protest in downtown Lexington, 1968, from the Alexandra Soteriou photographs','Protest in downtown Lexington, 1968, from the Alexandra Soteriou photographs https://exploreuk.uky.edu/catalog/xt7q2b8vck34_53_107 '),
(36,'Item',28,1,'George du Maurier envelope to Ivy, 1899, from the W. Hugh Peal manuscript collection\r\n','George du Maurier envelope to Ivy, 1899, from the W. Hugh Peal manuscript collection\r\n https://exploreuk.uky.edu/catalog/xt7qjq0stw34_1083_1 '),
(37,'Item',29,1,'Photobooth image set, undated, from the Cowherd family photographs','Photobooth image set, undated, from the Cowherd family photographs https://exploreuk.uky.edu/catalog/xt7nk9315j37_13_1 '),
(38,'Item',30,1,'Horses racing past the Keeneland topiary from the James Edwin Weddle Photographic Collection ','Horses racing past the Keeneland topiary from the James Edwin Weddle Photographic Collection  https://exploreuk.uky.edu/catalog/xt734t6f3d29_2066_1?q=Thoroughbred+Racing%3B+Race+Scenes%3B+Horses+racing+past+the+Keeneland+topiary&per_page=20 '),
(41,'SimplePagesPage',5,1,'About the New Site','About the New Site <p><span style=\"font-weight: 400;\">Welcome to the new ExploreUK! The digital library provides access to the same rare and unique research materials, just with a new design-- and more changes are coming in the near future.</span></p>\r\n<p><span style=\"font-weight: 400;\"></span></p>\r\n<h2><span style=\"font-weight: 400;\">What changed?</span></h2>\r\n<p><span style=\"font-weight: 400;\">The most obvious change is the new look! ExploreUK was redesigned to improve discovery and use of our research materials. The new site is more ADA compliant, puts important features front and center, and is mobile friendly.</span></p>\r\n<p><span style=\"font-weight: 400;\">&nbsp;</span></p>\r\n<p><span style=\"font-weight: 400;\">Other changes include</span></p>\r\n<ul>\r\n<li><span style=\"font-weight: 400;\">A “How to” section with tips for requesting and using our materials</span></li>\r\n<li>A new paged-item viewer</li>\r\n<li>A new contact form</li>\r\n<li>More prominent download buttons</li>\r\n</ul>\r\n<p><span style=\"font-weight: 400;\">&nbsp;</span></p>\r\n<p>It’s also worth noting that the site itself is on updated and more stable infrastructure. This will allow us to continue making improvements to the site and the systems that support it.</p>\r\n<h2><span style=\"font-weight: 400;\">What didn’t change? </span></h2>\r\n<p><span style=\"font-weight: 400;\">The same rare and unique research materials are available on the new ExploreUK. And more are being added! Follow us on </span><a href=\"https://www.facebook.com/ukscrc/\"><span style=\"font-weight: 400;\">Facebook</span></a><span style=\"font-weight: 400;\"> or peruse our </span><a href=\"https://ukyarchives.blogspot.com/\"><span style=\"font-weight: 400;\">blog </span></a><span style=\"font-weight: 400;\">for updates. </span></p>\r\n<p><span style=\"font-weight: 400;\">&nbsp;</span><span style=\"font-weight: 400;\">The site’s urls did not change, so your bookmarked pages will work on the new site. If you notice any broken links, </span><a href=\"http://libraries.uky.edu/ContactSCRC\"><span style=\"font-weight: 400;\">contact us</span></a><span style=\"font-weight: 400;\"> for assistance.</span></p>\r\n<p><span style=\"font-weight: 400;\">&nbsp;</span></p>\r\n<h2><span style=\"font-weight: 400;\">We’re not done yet. What’s coming?</span></h2>\r\n<p><span style=\"font-weight: 400;\">The new site design is the first step in a bigger process. There are more changes and features planned for the near future. Here are a few of the highlights:</span></p>\r\n<p><span style=\"font-weight: 400;\">&nbsp;</span><i><span style=\"font-weight: 400;\">Downloading multi-page PDFs</span></i><span style=\"font-weight: 400;\">: Have you wanted to easily download the entire copy of the WPA’s </span><a href=\"https://exploreuk.uky.edu/catalog/xt78cz32438r_1\"><span style=\"font-weight: 400;\">Directory and Description of Professional and Service Projects in Kentucky</span></a><span style=\"font-weight: 400;\"> or other books on ExploreUK? Soon you’ll be able to download multi-page PDFs of entire publications, newsletters, and other items. </span></p>\r\n<p><span style=\"font-weight: 400;\">&nbsp;</span><i><span style=\"font-weight: 400;\">Citation information</span></i><span style=\"font-weight: 400;\">: Citations can be confusing, especially for archival collections. ExploreUK will soon offer full citation information for MLA, APA, and Chicago styles.</span></p>\r\n<p><span style=\"font-weight: 400;\">&nbsp;</span><i><span style=\"font-weight: 400;\">Additional information about our collections</span></i><span style=\"font-weight: 400;\">: Have you ever wondered more about the </span><a href=\"https://exploreuk.uky.edu/catalog/xt7nvx06115m_1_34/viewer?\"><span style=\"font-weight: 400;\">WWI diary</span></a><span style=\"font-weight: 400;\"> you found? ExploreUK will display collection summaries for items that are part of archival collections.</span></p>\r\n<p><span style=\"font-weight: 400;\">&nbsp;</span><i><span style=\"font-weight: 400;\">More filter options</span></i><span style=\"font-weight: 400;\">: Sometimes you are only interested in seeing the </span><a href=\"https://exploreuk.uky.edu/catalog/xt7c599z2z24_5\"><span style=\"font-weight: 400;\">April 21, 1965 issue of the Kentucky Kernel</span></a><span style=\"font-weight: 400;\"> or materials written in </span><a href=\"https://exploreuk.uky.edu/catalog/xt7b8g8fj49d_1?\"><span style=\"font-weight: 400;\">Japanese</span></a><span style=\"font-weight: 400;\">. We’re building tools that provide more ways of refining your searches.</span></p>\r\n<h2><span style=\"font-weight: 400;\">If you are having issues:</span></h2>\r\n<p><span style=\"font-weight: 400;\">We recommend using the following browsers for searching ExploreUK.</span></p>\r\n<ul>\r\n<li><span style=\"font-weight: 400;\">Chrome</span></li>\r\n<li><span style=\"font-weight: 400;\">Microsoft Edge</span></li>\r\n<li><span style=\"font-weight: 400;\">Firefox</span></li>\r\n</ul>\r\n<p><span style=\"font-weight: 400;\"></span></p>\r\n<p><span style=\"font-weight: 400;\">Still having issues? </span><a href=\"http://libraries.uky.edu/ContactSCRC\"><span style=\"font-weight: 400;\">Contact us</span></a><span style=\"font-weight: 400;\"> and we will get back to you as soon as possible.</span></p>\r\n<p><span style=\"font-weight: 400;\">&nbsp;</span></p>\r\n<h2><span style=\"font-weight: 400;\">Explore!</span></h2>\r\n<p><span style=\"font-weight: 400;\">Check out the new site yourself and let us know what you think by filling out this </span><a href=\"https://solrindex.uky.edu/feedback\"><span style=\"font-weight: 400;\">feedback form.</span></a><span style=\"font-weight: 400;\"> Need help with your research? </span><a href=\"https://libraries.uky.edu/ContactSCRC\"><span style=\"font-weight: 400;\">Send us a question here.</span></a><span style=\"font-weight: 400;\"> Are you looking for newspaper content, oral histories, or microfilm? Check out the options under “Additional Resources” </span></p>\r\n<p></p> '),
(40,'Item',32,1,'A page from Ikebana hayamanabi, 1835','A page from Ikebana hayamanabi, 1835 https://exploreuk.uky.edu/catalog/xt7msb3wwt9f_13?q=Ikebana+hayamanabi&per_page=20#page/13/mode/1up/search/Ikebana+hayamanabi '),
(42,'SimplePagesPage',6,1,'xxx List test','xxx List test <ul>\r\n<li>this</li>\r\n<li>is</li>\r\n<li>a</li>\r\n<li>list</li>\r\n</ul> '),
(43,'SimplePagesPage',7,1,'About ExploreUK','About ExploreUK <p><span style=\"font-weight: 400;\">ExploreUK is the gateway to many of </span><a href=\"http://libraries.uky.edu/\" target=\"_blank\" rel=\"noopener\" title=\"University of Kentucky Libraries’\"><span style=\"font-weight: 400;\">University of Kentucky Libraries’</span></a><span style=\"font-weight: 400;\"> rare and unique resources, particularly those housed in the </span><a href=\"http://libraries.uky.edu/sc\" target=\"_blank\" rel=\"noopener\" title=\"Special Collections Research Center\"><span style=\"font-weight: 400;\">Special Collections Research Center</span></a><span style=\"font-weight: 400;\">. ExploreUK provides free and public access to digital materials for research, teaching, and curious exploration. </span></p>\r\n<p><span style=\"font-weight: 400;\">Materials include manuscript collections, University of Kentucky archives, rare books, photographs, organizational records, newspapers, maps, architectural drawings, government publications, and more. The collections document the social, cultural, economic, and political history of the Commonwealth of Kentucky, but also include materials of national and international significance.</span><span style=\"font-weight: 400;\"></span></p>\r\n<h2><b>Content Types</b></h2>\r\n<p><span style=\"font-weight: 400;\">When searching ExploreUK, you will discover the following content types:</span></p>\r\n<p><b>Collection guides</b><span style=\"font-weight: 400;\"> (also known as “finding aids”): These documents contain detailed information about a specific collection of papers or records and often include an inventory or box list. Use collection guides to determine if materials within a collection is relevant to your interests. When a collection has been digitized, the scans are embedded within the guide as well as discoverable individually through the ExploreUK search tool.</span></p>\r\n<p><b>Digitized items<span style=\"font-weight: 400;\">: The Special Collections Research Center digitizes a portion of its rare and unique collections for online access. These scans can be accessed and downloaded through ExploreUK. Some digital content is described within collection guides (see above) while others are described by basic descriptive metadata. </span><span style=\"font-weight: 400;\">Users are responsible for securing appropriate permissions</span><span style=\"font-weight: 400;\">.</span></b></p>\r\n<p><b>Born-digital items</b><span>: In some cases, materials are created as digital formats, like .pdf, .jpeg, and .wav files. These are also available through ExploreUK. Like digitized items, they may be described within a collection guide or by basic descriptive metadata.</span></p>\r\n<h2><b>Our Organization</b></h2>\r\n<p><span style=\"font-weight: 400;\">ExploreUK is a project of the </span><a href=\"http://libraries.uky.edu/\" target=\"_blank\" rel=\"noopener\" title=\"University of Kentucky Libraries\"><span style=\"font-weight: 400;\">University of Kentucky Libraries</span></a><span style=\"font-weight: 400;\"> and is developed and maintained by the </span><a href=\"http://libraries.uky.edu/sc\" target=\"_blank\" rel=\"noopener\" title=\"Special Collections Research Center\"><span style=\"font-weight: 400;\">UK Libraries Special Collections Research Center.</span></a>&nbsp;<span style=\"font-weight: 400;\">Visit the </span><a href=\"http://libraries.uky.edu/libpage.php?lweb_id=1129&amp;llib_id=13\" target=\"_blank\" rel=\"noopener\" title=\"Special Collections Research Center History &amp; Chronology page\"><span style=\"font-weight: 400;\">Special Collections Research Center History &amp; Chronology page</span></a><span style=\"font-weight: 400;\"> for more information. </span></p>\r\n<p></p>\r\n<h2><b>Platform and Tools</b></h2>\r\n<p><span style=\"font-weight: 400;\">ExploreUK uses a combination of the following:</span></p>\r\n<ul>\r\n<li><a href=\"https://omeka.org/\" target=\"_blank\" rel=\"noopener\" title=\"Omeka Classic\"><span style=\"font-weight: 400;\">Omeka Classic</span></a><span style=\"font-weight: 400;\"> with a highly customized theme</span></li>\r\n<li><span style=\"font-weight: 400;\">Apache Solr</span></li>\r\n<li><span style=\"font-weight: 400;\"><a href=\"https://www.uky.edu/its/\" target=\"_blank\" rel=\"noopener\" title=\"University of Kentucky Information Technology Services\">University of Kentucky Information Technology Services</a> infrastructure for AIPs and DIPs storage</span></li>\r\n<li><span style=\"font-weight: 400;\">Collection guides and related information are managed by the </span><a href=\"http://archivesspace.org/\" target=\"_blank\" rel=\"noopener\" title=\"ArchivesSpace\"><span style=\"font-weight: 400;\">ArchivesSpace</span></a><span style=\"font-weight: 400;\"> information management application.</span></li>\r\n</ul>\r\n<p></p>\r\n<p>Visit the <a href=\"https://github.com/uklibraries\" target=\"_blank\" rel=\"noopener\" title=\"UK Libraries GitHub page\"><span>UK Libraries GitHub page</span></a><span> for more information.</span></p>\r\n<p></p>\r\n<h2><b>Acknowledgements </b></h2>\r\n<p><span style=\"font-weight: 400;\">A portion of the collection guides and digitized content on ExploreUK was made possible by support from t</span><span style=\"font-weight: 400;\">he </span><a href=\"https://www.clir.org/\" target=\"_blank\" rel=\"noopener\" title=\"Council on Library and Information Resources\"><span style=\"font-weight: 400;\">Council on Library and Information Resources</span></a><span style=\"font-weight: 400;\">, </span><a href=\"https://www.imls.gov/\" target=\"_blank\" rel=\"noopener\" title=\"Institute of Museum and Library Services\"><span style=\"font-weight: 400;\">Institute of Museum and Library Services</span></a><span style=\"font-weight: 400;\">, </span><a href=\"https://libraries.uky.edu/page.php?lweb_id=1114\" target=\"_blank\" rel=\"noopener\" title=\"The John G. Heyburn II Initiative for Excellence in the Federal Judiciary\"><span style=\"font-weight: 400;\">The John G. Heyburn II Initiative for Excellence in the Federal Judiciary</span></a><span style=\"font-weight: 400;\">, the </span><a href=\"https://www.neh.gov/\" target=\"_blank\" rel=\"noopener\" title=\"National Endowment for the Humanities\"><span style=\"font-weight: 400;\">National Endowment for the Humanities</span></a><span style=\"font-weight: 400;\">, and the </span><a href=\"https://www.archives.gov/nhprc\" target=\"_blank\" rel=\"noopener\" title=\"National Historical Publications &amp; Records Commission\"><span style=\"font-weight: 400;\">National Historical Publications &amp; Records Commission</span></a><span style=\"font-weight: 400;\">. Visit the </span><a href=\"http://libraries.uky.edu/libpage.php?lweb_id=1085&amp;llib_id=13\" target=\"_blank\" rel=\"noopener\" title=\"SCRC Projects and Grants page\"><span style=\"font-weight: 400;\">SCRC Projects and Grants page</span></a><span style=\"font-weight: 400;\"> for more information on these grant-funded projects. </span></p> '),
(46,'Item',37,0,'Lexington Herald-Leader photographs','Lexington Herald-Leader photographs https://lhlphotoarchive.org/\r\n 03000 '),
(48,'Item',46,0,'The John G. Heyburn II Initiative for Excellence in the Federal Judiciary','The John G. Heyburn II Initiative for Excellence in the Federal Judiciary https://heyburncollections.org/ 07000 '),
(49,'Item',47,1,'Special Collections Research Center Online Exhibits','Special Collections Research Center Online Exhibits https://ukyscrcexhibits.omeka.net/exhibits 08000 '),
(50,'Item',48,1,'The University of Kentucky Libraries Web Archives','The University of Kentucky Libraries Web Archives https://archive-it.org/organizations/915 09000 '),
(51,'Item',49,1,'Kentucky Alumnus','Kentucky Alumnus /?f%5Bsource_s%5D%5B%5D=Kentucky+alumnus 11000 '),
(52,'Item',50,1,'Lexington City Directories','Lexington City Directories /?f%5Bsource_s%5D%5B%5D=Lexington+City+Directories 12000 ');
/*!40000 ALTER TABLE `omeka_search_texts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_sessions`
--

DROP TABLE IF EXISTS `omeka_sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_sessions` (
  `id` varchar(128) NOT NULL,
  `modified` bigint(20) DEFAULT NULL,
  `lifetime` int(11) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_sessions`
--

LOCK TABLES `omeka_sessions` WRITE;
/*!40000 ALTER TABLE `omeka_sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `omeka_sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_simple_pages_pages`
--

DROP TABLE IF EXISTS `omeka_simple_pages_pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_simple_pages_pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modified_by_user_id` int(10) unsigned NOT NULL,
  `created_by_user_id` int(10) unsigned NOT NULL,
  `is_published` tinyint(1) NOT NULL,
  `title` text NOT NULL,
  `slug` text NOT NULL,
  `text` longtext DEFAULT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `inserted` timestamp NOT NULL DEFAULT '2000-01-01 00:00:00',
  `order` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `template` text NOT NULL,
  `use_tiny_mce` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `is_published` (`is_published`),
  KEY `inserted` (`inserted`),
  KEY `updated` (`updated`),
  KEY `created_by_user_id` (`created_by_user_id`),
  KEY `modified_by_user_id` (`modified_by_user_id`),
  KEY `order` (`order`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_simple_pages_pages`
--

LOCK TABLES `omeka_simple_pages_pages` WRITE;
/*!40000 ALTER TABLE `omeka_simple_pages_pages` DISABLE KEYS */;
INSERT INTO `omeka_simple_pages_pages` VALUES
(1,2,1,1,'About','about','<p><span style=\"font-weight: 400;\">ExploreUK is the gateway to many of </span><a href=\"http://libraries.uky.edu/\" target=\"_blank\" rel=\"noopener\" title=\"University of Kentucky Libraries’\"><span style=\"font-weight: 400;\">University of Kentucky Libraries’</span></a><span style=\"font-weight: 400;\"> rare and unique resources, particularly those housed in the </span><a href=\"https://libraries.uky.edu/locations/special-collections-research-center\" target=\"_blank\" rel=\"noopener\" title=\"Special Collections Research Center\"><span style=\"font-weight: 400;\">Special Collections Research Center</span></a><span style=\"font-weight: 400;\">. ExploreUK provides free and public access to digital materials for research, teaching, and curious exploration. </span></p>\r\n<p><span style=\"font-weight: 400;\">Materials include manuscript collections, rare books, photographs, organizational records, newspapers, maps, architectural drawings, government publications, University of Kentucky archives, and more. The collections document the social, cultural, economic, and political history of the Commonwealth of Kentucky, but also include materials of national and international significance.</span><span style=\"font-weight: 400;\"></span></p>\r\n<h2><b>Content Types</b></h2>\r\n<p><span style=\"font-weight: 400;\">When searching ExploreUK, you will discover the following content types:</span></p>\r\n<p><b>Collection guides</b><span style=\"font-weight: 400;\"> (also known as “finding aids”): These documents contain detailed information about a specific collection of papers or records and often include an inventory or box list. Use collection guides to determine if materials within a collection is relevant to your interests. When a collection has been digitized, the scans are embedded within the guide as well as discoverable individually through the ExploreUK search tool.</span></p>\r\n<p><b>Digitized items<span style=\"font-weight: 400;\">: The Special Collections Research Center digitizes a portion of its rare and unique collections for online access. These scans can be accessed and downloaded through ExploreUK. Some digital content is described within collection guides (see above) while others are described by basic descriptive metadata. </span><span style=\"font-weight: 400;\">Users are responsible for securing appropriate permissions</span><span style=\"font-weight: 400;\">.</span></b></p>\r\n<p><b>Born-digital items</b><span>: In some cases, materials are created as digital formats, like .pdf, .jpeg, and .wav files. These are also available through ExploreUK. Like digitized items, they may be described within a collection guide or by basic descriptive metadata.</span></p>\r\n<h2><b>Platform and Tools</b></h2>\r\n<p><span style=\"font-weight: 400;\">ExploreUK uses a combination of the following:</span></p>\r\n<ul>\r\n<li><a href=\"https://omeka.org/\" target=\"_blank\" rel=\"noopener\" title=\"Omeka Classic\"><span style=\"font-weight: 400;\">Omeka Classic</span></a><span style=\"font-weight: 400;\"> with a highly customized theme</span></li>\r\n<li><span style=\"font-weight: 400;\">Apache Solr</span></li>\r\n<li><span style=\"font-weight: 400;\"><a href=\"https://www.uky.edu/its/\" target=\"_blank\" rel=\"noopener\" title=\"University of Kentucky Information Technology Services\">University of Kentucky Information Technology Services</a> infrastructure for AIPs and DIPs storage</span></li>\r\n<li><span style=\"font-weight: 400;\">Collection guides and related information are managed by the </span><a href=\"http://archivesspace.org/\" target=\"_blank\" rel=\"noopener\" title=\"ArchivesSpace\"><span style=\"font-weight: 400;\">ArchivesSpace</span></a><span style=\"font-weight: 400;\"> information management application.</span></li>\r\n</ul>\r\n<p></p>\r\n<p>Visit the <a href=\"https://github.com/uklibraries\" target=\"_blank\" rel=\"noopener\" title=\"UK Libraries GitHub page\"><span>UK Libraries GitHub page</span></a><span> for more information.</span></p>\r\n<p></p>\r\n<h2><b>Acknowledgements </b></h2>\r\n<p><span style=\"font-weight: 400;\">A portion of the collection guides and digitized content on ExploreUK was made possible by support from t</span><span style=\"font-weight: 400;\">he </span><a href=\"https://www.clir.org/\" target=\"_blank\" rel=\"noopener\" title=\"Council on Library and Information Resources\"><span style=\"font-weight: 400;\">Council on Library and Information Resources</span></a><span style=\"font-weight: 400;\">, </span><a href=\"https://www.imls.gov/\" target=\"_blank\" rel=\"noopener\" title=\"Institute of Museum and Library Services\"><span style=\"font-weight: 400;\">Institute of Museum and Library Services</span></a><span style=\"font-weight: 400;\">, </span><a href=\"https://www.heyburninitiative.org/\" target=\"_blank\" rel=\"noopener\" title=\"The John G. Heyburn II Initiative for Excellence in the Federal Judiciary\"><span style=\"font-weight: 400;\">The John G. Heyburn II Initiative for Excellence in the Federal Judiciary</span></a><span style=\"font-weight: 400;\">, the </span><a href=\"https://www.neh.gov/\" target=\"_blank\" rel=\"noopener\" title=\"National Endowment for the Humanities\"><span style=\"font-weight: 400;\">National Endowment for the Humanities</span></a><span style=\"font-weight: 400;\">, and the </span><a href=\"https://www.archives.gov/nhprc\" target=\"_blank\" rel=\"noopener\" title=\"National Historical Publications &amp; Records Commission\"><span style=\"font-weight: 400;\">National Historical Publications &amp; Records Commission</span></a><span style=\"font-weight: 400;\">.&nbsp;</span></p>','2025-08-13 23:30:06','2018-03-15 14:10:12',1,0,'',1),
(2,2,1,1,'Copyright, Use, and Take-Down Policies','takedown-policy','<h2>Copyright and Use</h2>\r\n<p>Disclaimer: The University of Kentucky Libraries Special Collections Research Center (SCRC) provides broad public access to collections as a contribution to education and scholarship. Most content in the digital libraries is protected by the U.S. Copyright Law (Title 17, U.S.C.). Use of the materials may also be subject to other legal rights, for example, rights of publicity, privacy rights, or other legal interests. Transmission or reproduction of materials protected by copyright beyond that allowed by fair use requires the written permission of the copyright owners. As noted, additional permissions may also be required. SCRC does not authorize any use or reproduction whatsoever for commercial purposes.</p>\r\n<p></p>\r\n<p>SCRC makes digital versions of collections accessible in the following situations: they are in the public domain; SCRC has permission to make them accessible online; materials are made accessible for education and research purposes as a legal fair use, or; there are no known restrictions on use.</p>\r\n<p></p>\r\n<p>Researchers should <a href=\"https://libraries.uky.edu/ContactSCRC\" target=\"_blank\" rel=\"noopener\" title=\"Contact SCRC\">contact SCRC</a> for additional information about rights, contacts, and permissions. Responsibility for making an independent legal assessment of an item and securing any necessary permissions ultimately rests with those persons wishing to use the item(s).</p>\r\n<h2>Take-Down Policies</h2>\r\n<p>The SCRC makes every effort to ensure that it has the appropriate rights to digitally preserve and provide access to its collections. Parties who have questions or concerns about the use of specific works may email the SCRC at scrc@uky.edu.</p>\r\n<p>With all such communications, please include:</p>\r\n<p>-- A physical or electronic signature of the copyright owner. NOTE: If an agent is providing the notification, also include a statement that the agent is authorized to act on behalf of the owner.</p>\r\n<p>-- Identification of the material that is claimed to be infringing or to be the subject of infringing activity and that is to be removed or access to which is to be disabled, and information reasonably sufficient to permit SCRC to locate the material. Providing URLs in your communication is the best way to help us locate content quickly.</p>\r\n<p>-- The reason for the request.</p>\r\n<p>All correspondence will be answered within a reasonable time by SCRC.</p>','2023-10-26 23:12:36','2018-05-04 18:30:02',0,0,'',1),
(4,1,1,0,'Feedback','feedback','<p><iframe width=\"1000\" height=\"1300\" src=\"https://docs.google.com/forms/d/e/1FAIpQLScMopDorUB3mJV9gpMQB9kqcIJ4Usu2lNe5_g41tbikF1ix_w/viewform?embedded=true\" frameborder=\"0\" marginheight=\"0\" marginwidth=\"0\">Loading...</iframe></p>','2023-07-22 20:55:00','2018-07-26 00:53:14',0,0,'',1),
(5,2,2,1,'About the New Site','new-exploreuk','<p><span style=\"font-weight: 400;\">Welcome to the new ExploreUK! The digital library provides access to the same rare and unique research materials, just with a new design-- and more changes are coming in the near future.</span></p>\r\n<p><span style=\"font-weight: 400;\"></span></p>\r\n<h2><span style=\"font-weight: 400;\">What changed?</span></h2>\r\n<p><span style=\"font-weight: 400;\">The most obvious change is the new look! ExploreUK was redesigned to improve discovery and use of our research materials. The new site is more ADA compliant, puts important features front and center, and is mobile friendly.</span></p>\r\n<p><span style=\"font-weight: 400;\">&nbsp;</span></p>\r\n<p><span style=\"font-weight: 400;\">Other changes include</span></p>\r\n<ul>\r\n<li><span style=\"font-weight: 400;\">A “How to” section with tips for requesting and using our materials</span></li>\r\n<li>A new paged-item viewer</li>\r\n<li>A new contact form</li>\r\n<li>More prominent download buttons</li>\r\n</ul>\r\n<p><span style=\"font-weight: 400;\">&nbsp;</span></p>\r\n<p>It’s also worth noting that the site itself is on updated and more stable infrastructure. This will allow us to continue making improvements to the site and the systems that support it.</p>\r\n<h2><span style=\"font-weight: 400;\">What didn’t change? </span></h2>\r\n<p><span style=\"font-weight: 400;\">The same rare and unique research materials are available on the new ExploreUK. And more are being added! Follow us on </span><a href=\"https://www.facebook.com/ukscrc/\"><span style=\"font-weight: 400;\">Facebook</span></a><span style=\"font-weight: 400;\"> or peruse our </span><a href=\"https://ukyarchives.blogspot.com/\"><span style=\"font-weight: 400;\">blog </span></a><span style=\"font-weight: 400;\">for updates. </span></p>\r\n<p><span style=\"font-weight: 400;\">&nbsp;</span><span style=\"font-weight: 400;\">The site’s urls did not change, so your bookmarked pages will work on the new site. If you notice any broken links, </span><a href=\"http://libraries.uky.edu/ContactSCRC\"><span style=\"font-weight: 400;\">contact us</span></a><span style=\"font-weight: 400;\"> for assistance.</span></p>\r\n<p><span style=\"font-weight: 400;\">&nbsp;</span></p>\r\n<h2><span style=\"font-weight: 400;\">We’re not done yet. What’s coming?</span></h2>\r\n<p><span style=\"font-weight: 400;\">The new site design is the first step in a bigger process. There are more changes and features planned for the near future. Here are a few of the highlights:</span></p>\r\n<p><span style=\"font-weight: 400;\">&nbsp;</span><i><span style=\"font-weight: 400;\">Downloading multi-page PDFs</span></i><span style=\"font-weight: 400;\">: Have you wanted to easily download the entire copy of the WPA’s </span><a href=\"https://exploreuk.uky.edu/catalog/xt78cz32438r_1\"><span style=\"font-weight: 400;\">Directory and Description of Professional and Service Projects in Kentucky</span></a><span style=\"font-weight: 400;\"> or other books on ExploreUK? Soon you’ll be able to download multi-page PDFs of entire publications, newsletters, and other items. </span></p>\r\n<p><span style=\"font-weight: 400;\">&nbsp;</span><i><span style=\"font-weight: 400;\">Citation information</span></i><span style=\"font-weight: 400;\">: Citations can be confusing, especially for archival collections. ExploreUK will soon offer full citation information for MLA, APA, and Chicago styles.</span></p>\r\n<p><span style=\"font-weight: 400;\">&nbsp;</span><i><span style=\"font-weight: 400;\">Additional information about our collections</span></i><span style=\"font-weight: 400;\">: Have you ever wondered more about the </span><a href=\"https://exploreuk.uky.edu/catalog/xt7nvx06115m_1_34/viewer?\"><span style=\"font-weight: 400;\">WWI diary</span></a><span style=\"font-weight: 400;\"> you found? ExploreUK will display collection summaries for items that are part of archival collections.</span></p>\r\n<p><span style=\"font-weight: 400;\">&nbsp;</span><i><span style=\"font-weight: 400;\">More filter options</span></i><span style=\"font-weight: 400;\">: Sometimes you are only interested in seeing the </span><a href=\"https://exploreuk.uky.edu/catalog/xt7c599z2z24_5\"><span style=\"font-weight: 400;\">April 21, 1965 issue of the Kentucky Kernel</span></a><span style=\"font-weight: 400;\"> or materials written in </span><a href=\"https://exploreuk.uky.edu/catalog/xt7b8g8fj49d_1?\"><span style=\"font-weight: 400;\">Japanese</span></a><span style=\"font-weight: 400;\">. We’re building tools that provide more ways of refining your searches.</span></p>\r\n<h2><span style=\"font-weight: 400;\">If you are having issues:</span></h2>\r\n<p><span style=\"font-weight: 400;\">We recommend using the following browsers for searching ExploreUK.</span></p>\r\n<ul>\r\n<li><span style=\"font-weight: 400;\">Chrome</span></li>\r\n<li><span style=\"font-weight: 400;\">Microsoft Edge</span></li>\r\n<li><span style=\"font-weight: 400;\">Firefox</span></li>\r\n</ul>\r\n<p><span style=\"font-weight: 400;\"></span></p>\r\n<p><span style=\"font-weight: 400;\">Still having issues? </span><a href=\"http://libraries.uky.edu/ContactSCRC\"><span style=\"font-weight: 400;\">Contact us</span></a><span style=\"font-weight: 400;\"> and we will get back to you as soon as possible.</span></p>\r\n<p><span style=\"font-weight: 400;\">&nbsp;</span></p>\r\n<h2><span style=\"font-weight: 400;\">Explore!</span></h2>\r\n<p><span style=\"font-weight: 400;\">Check out the new site yourself and let us know what you think by filling out this </span><a href=\"https://solrindex.uky.edu/feedback\"><span style=\"font-weight: 400;\">feedback form.</span></a><span style=\"font-weight: 400;\"> Need help with your research? </span><a href=\"https://libraries.uky.edu/ContactSCRC\"><span style=\"font-weight: 400;\">Send us a question here.</span></a><span style=\"font-weight: 400;\"> Are you looking for newspaper content, oral histories, or microfilm? Check out the options under “Additional Resources” </span></p>\r\n<p></p>','2018-11-08 21:25:31','2018-09-28 21:45:19',1,1,'',1),
(6,1,1,1,'xxx List test','xxx-list-test','<ul>\r\n<li>this</li>\r\n<li>is</li>\r\n<li>a</li>\r\n<li>list</li>\r\n</ul>','2018-10-25 17:22:59','2018-10-25 17:15:55',0,0,'',0),
(7,2,2,1,'About ExploreUK','about-exploreuk','<p><span style=\"font-weight: 400;\">ExploreUK is the gateway to many of </span><a href=\"http://libraries.uky.edu/\" target=\"_blank\" rel=\"noopener\" title=\"University of Kentucky Libraries’\"><span style=\"font-weight: 400;\">University of Kentucky Libraries’</span></a><span style=\"font-weight: 400;\"> rare and unique resources, particularly those housed in the </span><a href=\"http://libraries.uky.edu/sc\" target=\"_blank\" rel=\"noopener\" title=\"Special Collections Research Center\"><span style=\"font-weight: 400;\">Special Collections Research Center</span></a><span style=\"font-weight: 400;\">. ExploreUK provides free and public access to digital materials for research, teaching, and curious exploration. </span></p>\r\n<p><span style=\"font-weight: 400;\">Materials include manuscript collections, University of Kentucky archives, rare books, photographs, organizational records, newspapers, maps, architectural drawings, government publications, and more. The collections document the social, cultural, economic, and political history of the Commonwealth of Kentucky, but also include materials of national and international significance.</span><span style=\"font-weight: 400;\"></span></p>\r\n<h2><b>Content Types</b></h2>\r\n<p><span style=\"font-weight: 400;\">When searching ExploreUK, you will discover the following content types:</span></p>\r\n<p><b>Collection guides</b><span style=\"font-weight: 400;\"> (also known as “finding aids”): These documents contain detailed information about a specific collection of papers or records and often include an inventory or box list. Use collection guides to determine if materials within a collection is relevant to your interests. When a collection has been digitized, the scans are embedded within the guide as well as discoverable individually through the ExploreUK search tool.</span></p>\r\n<p><b>Digitized items<span style=\"font-weight: 400;\">: The Special Collections Research Center digitizes a portion of its rare and unique collections for online access. These scans can be accessed and downloaded through ExploreUK. Some digital content is described within collection guides (see above) while others are described by basic descriptive metadata. </span><span style=\"font-weight: 400;\">Users are responsible for securing appropriate permissions</span><span style=\"font-weight: 400;\">.</span></b></p>\r\n<p><b>Born-digital items</b><span>: In some cases, materials are created as digital formats, like .pdf, .jpeg, and .wav files. These are also available through ExploreUK. Like digitized items, they may be described within a collection guide or by basic descriptive metadata.</span></p>\r\n<h2><b>Our Organization</b></h2>\r\n<p><span style=\"font-weight: 400;\">ExploreUK is a project of the </span><a href=\"http://libraries.uky.edu/\" target=\"_blank\" rel=\"noopener\" title=\"University of Kentucky Libraries\"><span style=\"font-weight: 400;\">University of Kentucky Libraries</span></a><span style=\"font-weight: 400;\"> and is developed and maintained by the </span><a href=\"http://libraries.uky.edu/sc\" target=\"_blank\" rel=\"noopener\" title=\"Special Collections Research Center\"><span style=\"font-weight: 400;\">UK Libraries Special Collections Research Center.</span></a>&nbsp;<span style=\"font-weight: 400;\">Visit the </span><a href=\"http://libraries.uky.edu/libpage.php?lweb_id=1129&amp;llib_id=13\" target=\"_blank\" rel=\"noopener\" title=\"Special Collections Research Center History &amp; Chronology page\"><span style=\"font-weight: 400;\">Special Collections Research Center History &amp; Chronology page</span></a><span style=\"font-weight: 400;\"> for more information. </span></p>\r\n<p></p>\r\n<h2><b>Platform and Tools</b></h2>\r\n<p><span style=\"font-weight: 400;\">ExploreUK uses a combination of the following:</span></p>\r\n<ul>\r\n<li><a href=\"https://omeka.org/\" target=\"_blank\" rel=\"noopener\" title=\"Omeka Classic\"><span style=\"font-weight: 400;\">Omeka Classic</span></a><span style=\"font-weight: 400;\"> with a highly customized theme</span></li>\r\n<li><span style=\"font-weight: 400;\">Apache Solr</span></li>\r\n<li><span style=\"font-weight: 400;\"><a href=\"https://www.uky.edu/its/\" target=\"_blank\" rel=\"noopener\" title=\"University of Kentucky Information Technology Services\">University of Kentucky Information Technology Services</a> infrastructure for AIPs and DIPs storage</span></li>\r\n<li><span style=\"font-weight: 400;\">Collection guides and related information are managed by the </span><a href=\"http://archivesspace.org/\" target=\"_blank\" rel=\"noopener\" title=\"ArchivesSpace\"><span style=\"font-weight: 400;\">ArchivesSpace</span></a><span style=\"font-weight: 400;\"> information management application.</span></li>\r\n</ul>\r\n<p></p>\r\n<p>Visit the <a href=\"https://github.com/uklibraries\" target=\"_blank\" rel=\"noopener\" title=\"UK Libraries GitHub page\"><span>UK Libraries GitHub page</span></a><span> for more information.</span></p>\r\n<p></p>\r\n<h2><b>Acknowledgements </b></h2>\r\n<p><span style=\"font-weight: 400;\">A portion of the collection guides and digitized content on ExploreUK was made possible by support from t</span><span style=\"font-weight: 400;\">he </span><a href=\"https://www.clir.org/\" target=\"_blank\" rel=\"noopener\" title=\"Council on Library and Information Resources\"><span style=\"font-weight: 400;\">Council on Library and Information Resources</span></a><span style=\"font-weight: 400;\">, </span><a href=\"https://www.imls.gov/\" target=\"_blank\" rel=\"noopener\" title=\"Institute of Museum and Library Services\"><span style=\"font-weight: 400;\">Institute of Museum and Library Services</span></a><span style=\"font-weight: 400;\">, </span><a href=\"https://libraries.uky.edu/page.php?lweb_id=1114\" target=\"_blank\" rel=\"noopener\" title=\"The John G. Heyburn II Initiative for Excellence in the Federal Judiciary\"><span style=\"font-weight: 400;\">The John G. Heyburn II Initiative for Excellence in the Federal Judiciary</span></a><span style=\"font-weight: 400;\">, the </span><a href=\"https://www.neh.gov/\" target=\"_blank\" rel=\"noopener\" title=\"National Endowment for the Humanities\"><span style=\"font-weight: 400;\">National Endowment for the Humanities</span></a><span style=\"font-weight: 400;\">, and the </span><a href=\"https://www.archives.gov/nhprc\" target=\"_blank\" rel=\"noopener\" title=\"National Historical Publications &amp; Records Commission\"><span style=\"font-weight: 400;\">National Historical Publications &amp; Records Commission</span></a><span style=\"font-weight: 400;\">. Visit the </span><a href=\"http://libraries.uky.edu/libpage.php?lweb_id=1085&amp;llib_id=13\" target=\"_blank\" rel=\"noopener\" title=\"SCRC Projects and Grants page\"><span style=\"font-weight: 400;\">SCRC Projects and Grants page</span></a><span style=\"font-weight: 400;\"> for more information on these grant-funded projects. </span></p>','2018-10-31 21:33:35','2018-10-31 21:14:49',0,1,'',1);
/*!40000 ALTER TABLE `omeka_simple_pages_pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_simple_vocab_terms`
--

DROP TABLE IF EXISTS `omeka_simple_vocab_terms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_simple_vocab_terms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `element_id` int(10) unsigned NOT NULL,
  `terms` mediumtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `element_id` (`element_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_simple_vocab_terms`
--

LOCK TABLES `omeka_simple_vocab_terms` WRITE;
/*!40000 ALTER TABLE `omeka_simple_vocab_terms` DISABLE KEYS */;
INSERT INTO `omeka_simple_vocab_terms` VALUES
(1,42,'background image\npopular resource\nadditional resource');
/*!40000 ALTER TABLE `omeka_simple_vocab_terms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_tags`
--

DROP TABLE IF EXISTS `omeka_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_tags` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_tags`
--

LOCK TABLES `omeka_tags` WRITE;
/*!40000 ALTER TABLE `omeka_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `omeka_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_users`
--

DROP TABLE IF EXISTS `omeka_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `name` mediumtext NOT NULL,
  `email` mediumtext NOT NULL,
  `password` varchar(40) DEFAULT NULL,
  `salt` varchar(16) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `role` varchar(40) NOT NULL DEFAULT 'default',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `active_idx` (`active`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_users`
--

LOCK TABLES `omeka_users` WRITE;
/*!40000 ALTER TABLE `omeka_users` DISABLE KEYS */;
INSERT INTO `omeka_users` VALUES
(1,'demo','Demo User','demo@invalid.invalid','cadd000eaf5fd4ba38204d9df8aae5e5d81c8570','18c24bce1482f73c',1,'super');
/*!40000 ALTER TABLE `omeka_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `omeka_users_activations`
--

DROP TABLE IF EXISTS `omeka_users_activations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `omeka_users_activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `url` varchar(100) DEFAULT NULL,
  `added` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `omeka_users_activations`
--

LOCK TABLES `omeka_users_activations` WRITE;
/*!40000 ALTER TABLE `omeka_users_activations` DISABLE KEYS */;
INSERT INTO `omeka_users_activations` VALUES
(1,2,'efccea3fbb92828aa0da048ba08136cd6445da43','2018-07-25 19:01:04');
/*!40000 ALTER TABLE `omeka_users_activations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'omeka'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-09-25 17:52:48
