-- MySQL dump 10.13  Distrib 5.7.38, for Linux (x86_64)
--
-- Host: localhost    Database: LMS_PHP
-- ------------------------------------------------------
-- Server version	5.7.38-0ubuntu0.18.04.1

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
-- Table structure for table `admin_registration`
--

DROP TABLE IF EXISTS `admin_registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_registration` (
  `name` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_registration`
--

LOCK TABLES `admin_registration` WRITE;
/*!40000 ALTER TABLE `admin_registration` DISABLE KEYS */;
INSERT INTO `admin_registration` VALUES ('','a1e1abf8578ed5b14b74579b0306d5fd874d13812ff88726fd01490924e8649f','3877412326'),('hgrugh','a132991cc514f3f0870e7643ee20052e6dc632135407c10166c5230e5d52bbbf','3928181347'),('riya','752af21454bb24005f876bbbf5aa262360142316e5015f4b13b37ac9d1e3dbb4','5733980497');
/*!40000 ALTER TABLE `admin_registration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `isbn` varchar(255) DEFAULT NULL,
  `book_name` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `qty` tinyint(4) DEFAULT NULL,
  `qty_left` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES ('1657531965000','hh','hh',3,0),('1657547311000','gg','gg',2,1),('1657640561000','vv','v',3,2),('1657705639000','yy','y',5,5),('1657738611000',NULL,NULL,2,2),('1657738638000',NULL,NULL,3,3),('1657739180000','frfrfrfr','pp',3,3),('1657887966000','ytt','tt',2,2),('1658121714000','sim','d',8,10);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books_user`
--

DROP TABLE IF EXISTS `books_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books_user` (
  `isbn` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books_user`
--

LOCK TABLES `books_user` WRITE;
/*!40000 ALTER TABLE `books_user` DISABLE KEYS */;
INSERT INTO `books_user` VALUES ('1657531965000','yuyu');
/*!40000 ALTER TABLE `books_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client_admin`
--

DROP TABLE IF EXISTS `client_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client_admin` (
  `name` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client_admin`
--

LOCK TABLES `client_admin` WRITE;
/*!40000 ALTER TABLE `client_admin` DISABLE KEYS */;
INSERT INTO `client_admin` VALUES ('alpha','4d5f9858b0bc1a1210246c725edfd2df19368d114dff6c5c3ad9a4e4d68b2c4c','1929532953','user'),('gamma','4d5f9858b0bc1a1210246c725edfd2df19368d114dff6c5c3ad9a4e4d68b2c4c','1929532953','admin'),('beta','091cf4f3adefb8bfcd6d442897f7cc66f45c4161ffa6e4e0459de9abaeb5c9e3','3009825152','admin'),('delta','2dee97caab1748e3ce0228cd2e6424e8898a97b2c28821d04a677627ef5cc9a6','9720171776','user'),('pi','ad5a24be9b18883a2fca065783bdb42dce31831412e9ae478a5a2d6146238aa1','8111007420','user'),('lambda','f543228f17a2ac32499d7be46b89c36deeb79d4fd137959e9395617b8da328e9','6678262564','user'),('theta','d87013b4a8aaa98f959884bcd55e53718e833abd3c223777d937dada40bf1db8','5691236382','user'),('mu','cff4943a60932d861dc808427004c3e6cc35da8b02d4a7eeae5eef0f049f51ef','8206327911','user'),('bb','a22bbe227efe2100b41f5870df3f5b7b9f35000b0b6c06fec2e1cf802db9d64c','4225016475','user'),('xyz','d090ef612268a633f32021635bf0f2b35252bf8c5fd48f9ecf5d516f4040b77e','7358869015','admin'),('blah','8663cc2a246f66ffe8dff8eb3b8edae20e75a046bc2bbb2d3e0e21dd9d5ddf82','3573194791','user'),('ss','cd35181be85ef8180acde13a35ad0d4e3c78840652cbe070d42e64949c8c6a9c','5342530474','user'),('dd','d9457d5abdeedb9b08732f185362c546c22ea9acb2c94c2962e88b9d04816cf5','3618018723','admin'),('tt','01d0a5f7c258200374b0e970f97bdfc4a832fb4c4dc9486371454a974a1dba03','6680971753','admin'),('qq','284af7b7ed5452f90f69284f87a41bfe42c37005de9b6cdbf40ce3245de77b77','1702499570','user'),('ma','97950f963f4d7fc2cb73dc8ac122c2aca3c82f26e7106120fdad58b0bb144e22','7182697505','user'),('my','f374c70cd527fed28473572edc4c530f9b58aa14f6dd2275890e60b5c3331760','7222571786','user'),('jj','d108f913e420e4b4fc6c093d67e21ea56d6213c2e3c81b923e993df121231c95','1364550772','admin'),('mnmn','83400f176fcd0c89b217858c5a91801f8a78e4575eb860b215a317db991bba1c','8627212145','admin'),('huh','72fc14c2ad490675da8180f07e5ee9f259789b05086e433229dab2ae2c2d7f77','7766971674','user'),('yuyu','fcad7961dd8a71d008bd83cb898f7ca029120376bc8467fa0552fb502e6b4ed3','1731509697','user'),('tyty','63f2512452dc6927edee16145099282630be924570bbdb43a07c8e23c7856455','5622530448','user'),('ghutgh','ed0518cb1fbf2e7c552ac53f107c6399108f4b8a5a7d74473b1212b4e730f313','8049521192','user'),('eeyfh','6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b','0','user'),('uefhefiueh','6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b','0','user'),('frufhruhreiufh','6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b','0','user'),('HTGUHTR','6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b','0','user'),('ffrrrtggggtgtgtgtr','6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b','0','user'),('rffrrtgg','6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b','0','user'),('hbhytgvygv','6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b','0','user'),('koko','6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b','0','user'),('tthytt','4fd02307c22d105245142d16ae243be8b9cae51d9589b340b34fae6397846e8d','5562292798','user'),('YEGEYGBFE','6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b','0','user'),('gntujtrgi','f1165b19ccfadd115234a5ae673821a7b6898caf2fc0c48d6b8f5f90dc4ba595','3668704734','user'),('oo','745048661f4e3e76a64af61e5429f8f6f1749c87704a1c87f42ac10514d0d681','2566951192','admin'),('gggg','8523df7c18e8e2f367915c68403bff82e38be87b19129f01ec97af3027bf9064','4450986305','user'),('rugjtuijgj','027c8f8d6d092de98281a5e91067327721e051a4eff8fdc0a318ee610c65092a','8335978583','user'),('hunn','d1e72950e70493bbb6fde89c93a4255103fe75c5bd7e5d12c0cc9b69cbbed42d','1396098582','user'),('yuyuyuyu','9ce3ad7b0d4777795c59fecb510e74296fad7274fa3848be310f36240e24c5e2','7125691441','user');
/*!40000 ALTER TABLE `client_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fees`
--

DROP TABLE IF EXISTS `fees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fees` (
  `isbn` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `in_time` int(255) DEFAULT NULL,
  `out_time` int(255) DEFAULT NULL,
  `fees` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fees`
--

LOCK TABLES `fees` WRITE;
/*!40000 ALTER TABLE `fees` DISABLE KEYS */;
INSERT INTO `fees` VALUES ('1657481166000','alpha',1657481165,NULL,NULL),('1657515125000','pi',1657481165,NULL,NULL),('1657515125000','blah',1657540354,NULL,NULL),('165748116600','ss',1657547337,1657554499,0),('1657531965000','ss',1657552080,1657553080,0),('1657531965000','ss',1657552682,NULL,NULL),('165748116600','ss',1657553170,1657554499,0),('1657531965000','my',1657631754,1657631890,0),('1657547311000','ss',1657660179,1657888881,19181),('1657531965000','yuyu',1657705678,NULL,NULL);
/*!40000 ALTER TABLE `fees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requests` (
  `isbn` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` VALUES ('',NULL),('',NULL),('',NULL),('',NULL),('','alpha'),('','alpha'),('','alpha'),('','alpha'),('','alpha'),('1657640561000','pi');
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `total_amt`
--

DROP TABLE IF EXISTS `total_amt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `total_amt` (
  `name` varchar(255) DEFAULT NULL,
  `fees` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `total_amt`
--

LOCK TABLES `total_amt` WRITE;
/*!40000 ALTER TABLE `total_amt` DISABLE KEYS */;
INSERT INTO `total_amt` VALUES ('blah',NULL),('ss',19181),('pi',1),('qq',NULL),('ma',0),('my',0),('huh',0),('yuyu',0),('tyty',0),('ghutgh',0),('eeyfh',0),('uefhefiueh',0),('frufhruhreiufh',0),('HTGUHTR',0),('ffrrrtggggtgtgtgtr',0),('rffrrtgg',0),('hbhytgvygv',0),('koko',0),('tthytt',0),('YEGEYGBFE',0),('gntujtrgi',0),('gggg',0),('rugjtuijgj',0),('yuyuyuyu',0);
/*!40000 ALTER TABLE `total_amt` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-18 16:08:18
