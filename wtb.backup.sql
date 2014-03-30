-- MySQL dump 10.13  Distrib 5.5.35, for debian-linux-gnu (i686)
--
-- Host: 127.0.0.1    Database: wtb
-- ------------------------------------------------------
-- Server version	5.5.35-2

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
  `iditem` int(11) NOT NULL,
  `item_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iditem`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item`
--

LOCK TABLES `item` WRITE;
/*!40000 ALTER TABLE `item` DISABLE KEYS */;
INSERT INTO `item` VALUES (11112,'Lesser Health Potion'),(11114,'Greater Health Potion'),(11116,'Heroic Health Potion'),(11199,'Health Elixir'),(11212,'Lesser Mana Potion'),(11214,'Greater Mana Potion'),(11215,'Superior Mana Potion'),(11216,'Heroic Mana Potion'),(11299,'Mana Elixir'),(11312,'Lesser Spirit Potion'),(11314,'Greater Spirit Potion'),(11316,'Heroic Spirit Potion'),(11399,'Spirit Elixir'),(11401,'Energy Drink'),(11501,'Last Elixir'),(12101,'Infusion of Flames'),(12201,'Infusion of Frost'),(12301,'Infusion of Lightning'),(12401,'Infusion of Storms'),(12501,'Infusion of Divinity'),(12601,'Infusion of Darkness'),(13101,'Scroll of Swiftness'),(13111,'Scroll of Protection'),(13199,'Scroll of the Avatar'),(13201,'Scroll of Absorption'),(13211,'Scroll of Shadows'),(13221,'Scroll of Life'),(13299,'Scroll of the Gods'),(19101,'Soul Stone'),(19111,'Flower Vase'),(19131,'Bubble-Gum'),(20001,'Precursor Artifact'),(30017,'Holy Hand Grenade of Antioch'),(30018,'Mithra\'s Flower'),(30019,'Dalek Voicebox'),(30020,'Lock of Blue Hair'),(30021,'Bunny-Girl Costume'),(30022,'Hinamatsuri Doll'),(30023,'Broken Glasses'),(30032,'Noodly Appendage'),(50001,'Crystal of Vigor'),(50002,'Crystal of Finesse'),(50003,'Crystal of Swiftness'),(50004,'Crystal of Fortitude'),(50005,'Crystal of Cunning'),(50006,'Crystal of Knowledge'),(50011,'Crystal of Flames'),(50012,'Crystal of Frost'),(50013,'Crystal of Lightning'),(50014,'Crystal of Tempest'),(50015,'Crystal of Devotion'),(50016,'Crystal of Corruption'),(51001,'Monster Chow'),(51002,'Monster Edibles'),(51003,'Monster Cuisine'),(51011,'Happy Pills'),(60001,'Low-Grade Cloth'),(60002,'Mid-Grade Cloth'),(60003,'High-Grade Cloth'),(60004,'Low-Grade Leather'),(60005,'Mid-Grade Leather'),(60006,'High-Grade Leather'),(60007,'Low-Grade Metals'),(60008,'Mid-Grade Metals'),(60009,'High-Grade Metals'),(60010,'Low-Grade Wood'),(60011,'Mid-Grade Wood'),(60012,'High-Grade Wood'),(60051,'Scrap Cloth'),(60052,'Scrap Leather'),(60053,'Scrap Metal'),(60054,'Scrap Wood'),(60101,'Crystallized Phazon'),(60102,'Shade Fragment'),(60104,'Repurposed Actuator'),(60105,'Defense Matrix Modulator'),(60201,'Binding of Slaughter'),(60202,'Binding of Balance'),(60203,'Binding of Destruction'),(60204,'Binding of Focus'),(60205,'Binding of Protection'),(60206,'Binding of the Fleet'),(60207,'Binding of the Barrier'),(60208,'Binding of the Nimble'),(60209,'Binding of the Elementalist'),(60210,'Binding of the Heaven-sent'),(60211,'Binding of the Demon-fiend'),(60212,'Binding of the Curse-weaver'),(60213,'Binding of the Earth-walker'),(60215,'Binding of Surtr'),(60216,'Binding of Niflheim'),(60217,'Binding of Mjolnir'),(60218,'Binding of Freyr'),(60219,'Binding of Heimdall'),(60220,'Binding of Fenrir'),(60221,'Binding of Dampening'),(60222,'Binding of Stoneskin'),(60223,'Binding of Deflection'),(60224,'Binding of the Fire-eater'),(60225,'Binding of the Frost-born'),(60226,'Binding of the Thunder-child'),(60227,'Binding of the Wind-waker'),(60228,'Binding of the Thrice-blessed'),(60229,'Binding of the Spirit-ward'),(60230,'Binding of the Ox'),(60231,'Binding of the Raccoon'),(60232,'Binding of the Cheetah'),(60233,'Binding of the Turtle'),(60234,'Binding of the Fox'),(60235,'Binding of the Owl'),(60236,'Binding of Warding'),(60237,'Binding of Negation'),(60238,'Binding of Isaac'),(60239,'Binding of Friendship'),(61001,'Voidseeker Shard'),(61101,'Aether Shard'),(61501,'Featherweight Shard'),(65001,'Amnesia Shard'),(70002,'Rainbow Dash Figurine'),(70003,'Applejack Figurine'),(70004,'Fluttershy Figurine'),(70005,'Pinkie Pie Figurine'),(70006,'Rarity Figurine'),(70007,'Trixie Figurine'),(70008,'Princess Celestia Figurine'),(70009,'Princess Luna Figurine'),(70010,'Apple Bloom Figurine'),(70011,'Scootaloo Figurine'),(70012,'Sweetie Belle Figurine'),(70013,'Big Macintosh Figurine'),(70015,'Derpy Hooves Figurine'),(70016,'Lyra Heartstrings Figurine'),(70017,'Octavia Figurine'),(70018,'Zecora Figurine'),(70019,'Cheerilee Figurine'),(70020,'Vinyl Scratch Figurine'),(70021,'Daring Do Figurine'),(70022,'Doctor Whooves Figurine'),(70023,'Berry Punch Figurine'),(70024,'Bon-Bon Figurine'),(70025,'Fluffle Puff Figurine'),(70101,'Angel Bunny Figurine'),(70102,'Gummy Figurine');
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `play`
--

DROP TABLE IF EXISTS `play`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `play` (
  `idplay` int(11) NOT NULL,
  `play_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idplay`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `play`
--

LOCK TABLES `play` WRITE;
/*!40000 ALTER TABLE `play` DISABLE KEYS */;
INSERT INTO `play` VALUES (646621,'dkarcher'),(896192,'ace_amuro'),(1139412,'atest1'),(1308950,'gzzhongqi'),(1310977,'Yakamoz moon'),(1397157,'tsukikoazusa');
/*!40000 ALTER TABLE `play` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wtb`
--

DROP TABLE IF EXISTS `wtb`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wtb` (
  `idwtb` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `enable` tinyint(1) DEFAULT '1',
  `iditem` int(11) DEFAULT NULL,
  `idplayer` int(11) DEFAULT NULL,
  `num_now` int(11) DEFAULT '0',
  `num_want` int(11) DEFAULT '1' COMMENT ' ',
  `c` int(11) DEFAULT NULL,
  `hath` int(11) DEFAULT NULL,
  `src` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`idwtb`),
  UNIQUE KEY `idwtb_UNIQUE` (`idwtb`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wtb`
--

LOCK TABLES `wtb` WRITE;
/*!40000 ALTER TABLE `wtb` DISABLE KEYS */;
INSERT INTO `wtb` VALUES (1,1,11401,1397157,17,30,28000,NULL,'http://forums.e-hentai.org/index.php?showtopic=147618'),(2,1,20001,1310977,0,NULL,10000,1,'http://forums.e-hentai.org/index.php?showtopic=146322'),(3,1,60101,1139412,0,NULL,190000,NULL,'http://forums.e-hentai.org/index.php?showtopic=121096'),(4,1,61101,1139412,0,NULL,5000,NULL,'http://forums.e-hentai.org/index.php?showtopic=121096'),(5,1,70002,1397157,0,1,63000,NULL,'http://forums.e-hentai.org/index.php?showtopic=163658'),(6,1,70006,1397157,0,1,63000,NULL,'http://forums.e-hentai.org/index.php?showtopic=163658'),(7,1,70008,1397157,0,1,63000,NULL,'http://forums.e-hentai.org/index.php?showtopic=163658'),(8,1,70010,1397157,0,1,63000,NULL,'http://forums.e-hentai.org/index.php?showtopic=163658'),(9,1,70009,1397157,0,1,63000,NULL,'http://forums.e-hentai.org/index.php?showtopic=163658'),(10,1,70011,1397157,0,1,63000,NULL,'http://forums.e-hentai.org/index.php?showtopic=163658'),(11,1,70015,1397157,0,1,63000,NULL,'http://forums.e-hentai.org/index.php?showtopic=163658'),(12,1,70017,1397157,0,1,63000,NULL,'http://forums.e-hentai.org/index.php?showtopic=163658'),(13,1,70101,1397157,0,1,63000,NULL,'http://forums.e-hentai.org/index.php?showtopic=163658'),(14,1,60235,896192,70,80,30000,0,'http://forums.e-hentai.org/index.php?showtopic=97140'),(15,1,60101,896192,0,0,0,18,'http://forums.e-hentai.org/index.php?showtopic=97140'),(16,1,60101,1308950,0,30,180000,0,'http://forums.e-hentai.org/index.php?showtopic=163055'),(17,1,70025,11111,0,10,1000,0,'http://forums.e-hentai.org/');
/*!40000 ALTER TABLE `wtb` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-03-30 11:16:21
