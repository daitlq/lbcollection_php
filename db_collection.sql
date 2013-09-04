DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL,
  `description` blob,
  `picture` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
INSERT INTO `book` VALUES (1,'Tu thu','2009','Triet hoc.','example.jpg');
INSERT INTO `book` VALUES (2,'Ngu Kinh','2006','Triet hoc - Nho giao.','example.jpg');
INSERT INTO `book` VALUES (3,'Dao Duc Kinh','2009','Triet hoc - Nho giao.','example.jpg');
INSERT INTO `book` VALUES (4,'Ngu Kinh','2006','Triet hoc - Nho giao.','example.jpg');
INSERT INTO `book` VALUES (5,'Ngu Kinh','2006','Triet hoc - Nho giao.','example.jpg');
INSERT INTO `book` VALUES (6,'Ngu Kinh','2006','Triet hoc - Nho giao.','example.jpg');
UNLOCK TABLES;
-- Dump completed
