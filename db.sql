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
-- Table structure for table `equip`
--

DROP TABLE IF EXISTS `equip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equip` (
  `idequip` int(10) unsigned NOT NULL COMMENT '装备id,唯一',
  `ekey` varchar(20) DEFAULT NULL COMMENT '装备栏的key项目,暂时不知道怎么用',
  `equip_name` varchar(45) DEFAULT NULL COMMENT '插入的时候从hv读取一次,之后只供查询和删除.\n',
  PRIMARY KEY (`idequip`),
  UNIQUE KEY `idequip_UNIQUE` (`idequip`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equip`
--

LOCK TABLES `equip` WRITE;
/*!40000 ALTER TABLE `equip` DISABLE KEYS */;
INSERT INTO `equip` VALUES (30064006,'f68c14387e',' Legendary Ruby Plate Helmet of Protection'),(34697761,'928899a3e1','Legendary Shocking Wakizashi of Slaughter'),(37738038,'14f7d57b4e','Legendary Shocking Wakizashi of Slaughter'),(41511415,'8d5c31f898','Legendary Mystic Phase Cap of Fenrir'),(42312559,'fee9c51011','Legendary Zircon Phase Robe of Fenrir'),(42353614,'83191af044','Legendary Tempestuous Willow Staff of Destruc'),(42646343,'da19118cec','Legendary Tempestuous Wakizashi of the Nimble'),(42938030,'f544ac8581','Magnificent Fiery Club of the Banshee'),(43120719,'4d3a81dca0','Average Axe of the Vampire');
/*!40000 ALTER TABLE `equip` ENABLE KEYS */;
UNLOCK TABLES;

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
INSERT INTO `item` VALUES (11112,'Lesser Health Potion'),(11114,'Greater Health Potion'),(11116,'Heroic Health Potion'),(11199,'Health Elixir'),(11212,'Lesser Mana Potion'),(11214,'Greater Mana Potion'),(11215,'Superior Mana Potion'),(11216,'Heroic Mana Potion'),(11299,'Mana Elixir'),(11312,'Lesser Spirit Potion'),(11314,'Greater Spirit Potion'),(11316,'Heroic Spirit Potion'),(11399,'Spirit Elixir'),(11401,'Energy Drink'),(11501,'Last Elixir'),(12101,'Infusion of Flames'),(12201,'Infusion of Frost'),(12301,'Infusion of Lightning'),(12401,'Infusion of Storms'),(12501,'Infusion of Divinity'),(12601,'Infusion of Darkness'),(13101,'Scroll of Swiftness'),(13111,'Scroll of Protection'),(13199,'Scroll of the Avatar'),(13201,'Scroll of Absorption'),(13211,'Scroll of Shadows'),(13221,'Scroll of Life'),(13299,'Scroll of the Gods'),(19101,'Soul Stone'),(19111,'Flower Vase'),(19131,'Bubble-Gum'),(20001,'Precursor Artifact'),(30017,'Holy Hand Grenade of Antioch'),(30018,'Mithra\'s Flower'),(30019,'Dalek Voicebox'),(30020,'Lock of Blue Hair'),(30021,'Bunny-Girl Costume'),(30022,'Hinamatsuri Doll'),(30023,'Broken Glasses'),(30032,'Noodly Appendage'),(50001,'Crystal of Vigor'),(50002,'Crystal of Finesse'),(50003,'Crystal of Swiftness'),(50004,'Crystal of Fortitude'),(50005,'Crystal of Cunning'),(50006,'Crystal of Knowledge'),(50011,'Crystal of Flames'),(50012,'Crystal of Frost'),(50013,'Crystal of Lightning'),(50014,'Crystal of Tempest'),(50015,'Crystal of Devotion'),(50016,'Crystal of Corruption'),(51001,'Monster Chow'),(51002,'Monster Edibles'),(51003,'Monster Cuisine'),(51011,'Happy Pills'),(60001,'Low-Grade Cloth'),(60002,'Mid-Grade Cloth'),(60003,'High-Grade Cloth'),(60004,'Low-Grade Leather'),(60005,'Mid-Grade Leather'),(60006,'High-Grade Leather'),(60007,'Low-Grade Metals'),(60008,'Mid-Grade Metals'),(60009,'High-Grade Metals'),(60010,'Low-Grade Wood'),(60011,'Mid-Grade Wood'),(60012,'High-Grade Wood'),(60051,'Scrap Cloth'),(60052,'Scrap Leather'),(60053,'Scrap Metal'),(60054,'Scrap Wood'),(60101,'Crystallized Phazon'),(60102,'Shade Fragment'),(60104,'Repurposed Actuator'),(60105,'Defense Matrix Modulator'),(60201,'Binding of Slaughter'),(60202,'Binding of Balance'),(60203,'Binding of Destruction'),(60204,'Binding of Focus'),(60205,'Binding of Protection'),(60206,'Binding of the Fleet'),(60207,'Binding of the Barrier'),(60208,'Binding of the Nimble'),(60209,'Binding of the Elementalist'),(60210,'Binding of the Heaven-sent'),(60211,'Binding of the Demon-fiend'),(60212,'Binding of the Curse-weaver'),(60213,'Binding of the Earth-walker'),(60215,'Binding of Surtr'),(60216,'Binding of Niflheim'),(60217,'Binding of Mjolnir'),(60218,'Binding of Freyr'),(60219,'Binding of Heimdall'),(60220,'Binding of Fenrir'),(60221,'Binding of Dampening'),(60222,'Binding of Stoneskin'),(60223,'Binding of Deflection'),(60224,'Binding of the Fire-eater'),(60225,'Binding of the Frost-born'),(60226,'Binding of the Thunder-child'),(60227,'Binding of the Wind-waker'),(60228,'Binding of the Thrice-blessed'),(60229,'Binding of the Spirit-ward'),(60230,'Binding of the Ox'),(60231,'Binding of the Raccoon'),(60232,'Binding of the Cheetah'),(60233,'Binding of the Turtle'),(60234,'Binding of the Fox'),(60235,'Binding of the Owl'),(60236,'Binding of Warding'),(60237,'Binding of Negation'),(60238,'Binding of Isaac'),(60239,'Binding of Friendship'),(61001,'Voidseeker Shard'),(61101,'Aether Shard'),(61501,'Featherweight Shard'),(65001,'Amnesia Shard'),(70002,'Rainbow Dash Figurine'),(70003,'Applejack Figurine'),(70004,'Fluttershy Figurine'),(70005,'Pinkie Pie Figurine'),(70006,'Rarity Figurine'),(70007,'Trixie Figurine'),(70008,'Princess Celestia Figurine'),(70009,'Princess Luna Figurine'),(70010,'Apple Bloom Figurine'),(70011,'Scootaloo Figurine'),(70012,'Sweetie Belle Figurine'),(70013,'Big Macintosh Figurine'),(70015,'Derpy Hooves Figurine'),(70016,'Lyra Heartstrings Figurine'),(70017,'Octavia Figurine'),(70018,'Zecora Figurine'),(70019,'Cheerilee Figurine'),(70020,'Vinyl Scratch Figurine'),(70021,'Daring Do Figurine'),(70022,'Doctor Whooves Figurine'),(70023,'Berry Punch Figurine'),(70024,'Bon-Bon Figurine'),(70025,'Fluffle Puff Figurine'),(70101,'Angel Bunny Figurine'),(70102,'Gummy Figurine'),(4200000,'IW Service'),(4250000,'Crystal Pack'),(4250001,'Crystal Pack(big)');
/*!40000 ALTER TABLE `item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `idwtb` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `enable` tinyint(1) DEFAULT '1',
  `type` tinyint(1) DEFAULT '0' COMMENT '类型: wtb=0,wts=1,wtt=2 买还是卖还是交换',
  `obj` tinyint(1) DEFAULT '0' COMMENT '物品类型,道具item还是装备equip,item则查item表 ,equip则查equip表 .0道具 1装备',
  `idplayer` int(11) NOT NULL,
  `iditem` int(11) DEFAULT NULL,
  `idequip` int(11) NOT NULL,
  `qty` int(11) DEFAULT '1' COMMENT '买卖的数量,整数.对于装备,应该忽略数量',
  `c` int(11) DEFAULT NULL,
  `hath` float DEFAULT NULL,
  `src` varchar(256) DEFAULT NULL,
  `note` varchar(1024) DEFAULT NULL,
  `timestamp` int(11) DEFAULT NULL COMMENT '时间戳',
  PRIMARY KEY (`idwtb`),
  UNIQUE KEY `idwtb_UNIQUE` (`idwtb`)
) ENGINE=InnoDB AUTO_INCREMENT=273 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` VALUES (1,1,1,1,0,0,42353614,1,1000,0,'','',1396758461),(17,1,0,0,11111,70025,0,10,1000,0,'http://forums.e-hentai.org/',NULL,NULL),(97,1,1,0,1198948,20001,0,25,15000,0,'http://forums.e-hentai.org/index.php?showtopic=107561','wts test',1396360857),(101,1,1,0,1027298,11216,0,30000,9,0,'http://forums.e-hentai.org/index.php?showtopic=138426','ä¾‹å¦‚ æ¯ä¸ªidé™è´­å¤šå°‘ç“¶ä¹‹ç±»',1396362039),(102,1,1,0,1027298,13299,0,500,700,0,'http://forums.e-hentai.org/index.php?showtopic=138426','',1396362085),(137,1,2,0,0,11112,0,1,0,0,'','æµ‹è¯•wttç±»åˆ«',1396423037),(138,1,0,0,0,11112,0,1,0,0,'','æµ‹è¯•wttç±»åˆ«',1396429747),(141,1,0,0,156648,60205,0,17,40000,0,'http://forums.e-hentai.org/index.php?showtopic=164361','',1396443584),(142,1,0,0,156648,60102,0,20,20000,0,'http://forums.e-hentai.org/index.php?showtopic=164361','',1396443598),(143,1,0,0,1139412,20001,0,200,12500,0,'http://forums.e-hentai.org/index.php?showtopic=163904','',1396443688),(144,1,0,0,1139412,60101,0,20,200000,0,'http://forums.e-hentai.org/index.php?showtopic=163904','',1396443761),(145,1,0,0,1139412,11401,0,30,29000,0,'http://forums.e-hentai.org/index.php?showtopic=163904','',1396443794),(146,1,0,0,368893,30032,0,0,0,5.5,'http://forums.e-hentai.org/index.php?showtopic=103057','',1396443890),(147,1,0,0,368893,11401,0,0,0,3,'http://forums.e-hentai.org/index.php?showtopic=103057','',1396443948),(148,1,0,0,368893,60201,0,0,160000,16,'http://forums.e-hentai.org/index.php?showtopic=103057','',1396444093),(149,1,0,0,836631,60104,0,8,18000,0,'http://forums.e-hentai.org/index.php?showtopic=113301','',1396444242),(150,1,0,0,434157,60009,0,48,7000,0,'http://forums.e-hentai.org/index.php?showtopic=157034','',1396444302),(151,1,0,0,434157,11401,0,20,28000,0,'http://forums.e-hentai.org/index.php?showtopic=157034','',1396444357),(152,1,0,0,1388874,60203,0,2,130000,0,'http://forums.e-hentai.org/index.php?showtopic=164194','',1396444432),(153,1,0,0,1388874,60012,0,19,20000,0,'http://forums.e-hentai.org/index.php?showtopic=164194','',1396444463),(154,1,0,0,629266,51011,0,250,1120,0,'http://forums.e-hentai.org/index.php?showtopic=164287','',1396444547),(155,1,1,0,120864,11216,0,35000,8,0,'http://forums.e-hentai.org/index.php?showtopic=161512','',1396446742),(156,1,1,0,120864,60203,0,2,155000,0,'http://forums.e-hentai.org/index.php?showtopic=161512','Credits or primary crystals only',1396446840),(164,1,0,0,0,11112,0,1,0,0,'','demo',1396506738),(165,1,1,0,0,11112,0,1,0,0,'','demo',1396506740),(166,1,2,0,0,11112,0,1,0,0,'','demo',1396506742),(167,1,0,0,0,11112,0,1,0,0,'','',1396507317),(171,1,0,0,1308950,60101,0,30,190000,0,'http://forums.e-hentai.org/index.php?showtopic=163055','',1396509921),(172,1,0,0,1308950,60235,0,40,30000,0,'http://forums.e-hentai.org/index.php?showtopic=163055','',1396509983),(173,1,0,0,1308950,60012,0,80,20000,0,'http://forums.e-hentai.org/index.php?showtopic=163055','',1396510013),(174,1,0,0,1308950,20001,0,300,12500,0,'http://forums.e-hentai.org/index.php?showtopic=163055','',1396510044),(175,1,0,0,1308950,60234,0,30,30000,0,'http://forums.e-hentai.org/index.php?showtopic=163055','',1396510093),(181,1,0,0,0,70102,0,1,1000000,0,'','',1396513660),(182,1,0,0,636841,30020,0,1,450,0,'http://forums.e-hentai.org/index.php?showtopic=163314','',1396513985),(183,1,0,0,636841,30021,0,0,600,0,'http://forums.e-hentai.org/index.php?showtopic=163314','',1396514028),(184,1,0,0,636841,30021,0,0,600,0,'http://forums.e-hentai.org/index.php?showtopic=163314','',1396514040),(185,1,0,0,636841,30022,0,0,600,0,'http://forums.e-hentai.org/index.php?showtopic=163314','',1396514049),(186,1,0,0,636841,30023,0,0,600,0,'http://forums.e-hentai.org/index.php?showtopic=163314','',1396514053),(187,1,0,0,118065,70101,0,1,75000,0,'http://forums.e-hentai.org/index.php?showtopic=164408','',1396514117),(188,1,0,0,118065,70023,0,1,75000,0,'http://forums.e-hentai.org/index.php?showtopic=164408','',1396514135),(189,1,0,0,118065,70019,0,1,75000,0,'http://forums.e-hentai.org/index.php?showtopic=164408','',1396514144),(190,1,0,0,118065,70022,0,1,75000,0,'http://forums.e-hentai.org/index.php?showtopic=164408','',1396514153),(191,1,0,0,118065,70025,0,1,75000,0,'http://forums.e-hentai.org/index.php?showtopic=164408','',1396514189),(192,1,0,0,472360,60012,0,20,20000,0,'http://forums.e-hentai.org/index.php?showtopic=64611','',1396539466),(193,1,0,0,472360,65001,0,50,8500,0,'http://forums.e-hentai.org/index.php?showtopic=64611','',1396528226),(194,1,0,0,472360,12601,0,300,50,0,'http://forums.e-hentai.org/index.php?showtopic=64611','',1396528245),(195,1,0,0,472360,51011,0,50,1000,0,'http://forums.e-hentai.org/index.php?showtopic=64611','',1396528280),(196,1,0,0,472360,4250000,0,5,80000,0,'http://forums.e-hentai.org/index.php?showtopic=64611','',1396528319),(197,1,0,0,1160049,11401,0,100,29000,0,'http://forums.e-hentai.org/index.php?showtopic=147520','',1396528397),(198,1,0,0,422507,60101,0,10,180000,0,'http://forums.e-hentai.org/index.php?showtopic=164032','',1396528453),(199,1,0,0,422507,60203,0,10,100000,0,'http://forums.e-hentai.org/index.php?showtopic=164032','',1396528478),(200,1,0,0,422507,60201,0,20,170000,0,'http://forums.e-hentai.org/index.php?showtopic=164032','',1396528517),(202,1,0,0,1308950,60234,0,30,30000,0,'http://forums.e-hentai.org/index.php?showtopic=163055','',1396528578),(203,1,0,0,1308950,60235,0,40,30000,0,'http://forums.e-hentai.org/index.php?showtopic=163055','',1396528594),(204,1,0,0,836631,60104,0,4,18000,0,'http://forums.e-hentai.org/index.php?showtopic=113301','',1396528668),(205,1,0,0,1168408,13111,0,4800,260,0,'http://forums.e-hentai.org/index.php?showtopic=163000','',1396528729),(206,1,0,0,1244012,60201,0,5,200000,0,'http://forums.e-hentai.org/index.php?showtopic=164040','',1396528844),(207,1,0,0,1244012,60009,0,18,8000,0,'http://forums.e-hentai.org/index.php?showtopic=164040','COD Preferred.',1396536610),(208,1,0,0,1335632,60052,0,21,200,0,'http://forums.e-hentai.org/index.php?showtopic=163848','',1396528955),(209,1,0,0,434157,60009,0,48,7000,0,'http://forums.e-hentai.org/index.php?showtopic=157034','',1396529041),(210,1,0,0,0,0,0,0,0,0,'','',1396583253),(211,1,0,0,0,0,0,0,0,0,'src','note',NULL),(212,1,0,0,0,0,0,0,0,0,'src','note',NULL),(213,1,0,0,0,0,0,0,0,0,'src','note',NULL),(214,1,0,0,0,0,0,0,0,0,'src','note',NULL),(215,1,0,0,0,0,0,0,0,0,'src','note',NULL),(229,1,1,0,0,11401,0,1,1000,1,'','',1396685544),(231,1,2,0,0,11401,0,1,1000,0,'','test',1396536474),(232,1,1,0,924276,20001,0,10,13000,0,'http://forums.e-hentai.org/index.php?showtopic=89609','',1396536831),(233,1,1,0,924276,60003,0,50,20000,0,'http://forums.e-hentai.org/index.php?showtopic=89609','',1396536860),(234,1,1,0,924276,60009,0,100,10000,0,'http://forums.e-hentai.org/index.php?showtopic=89609','',1396536887),(235,1,1,0,924276,60012,0,7,21000,0,'http://forums.e-hentai.org/index.php?showtopic=89609','',1396536907),(236,1,1,0,924276,60205,0,15,50000,0,'http://forums.e-hentai.org/index.php?showtopic=89609','',1396536954),(237,1,1,0,924276,4200000,0,0,22,0,'http://forums.e-hentai.org/index.php?showtopic=89609','',1396537162),(238,1,1,0,309874,51001,0,3000,3,0,'http://forums.e-hentai.org/index.php?showtopic=90087','',1396537230),(239,1,1,0,309874,51002,0,500,8,0,'http://forums.e-hentai.org/index.php?showtopic=90087','',1396537245),(240,1,1,0,309874,51003,0,3000,8,0,'http://forums.e-hentai.org/index.php?showtopic=90087','',1396537272),(241,1,1,0,351219,51001,0,10000,10,0,'http://forums.e-hentai.org/index.php?showtopic=79874','below Lv205, Free, limit 100 per day',1396537328),(242,1,1,0,351219,51002,0,10000,10,0,'http://forums.e-hentai.org/index.php?showtopic=79874','',1396537341),(243,1,1,0,351219,51003,0,10000,10,0,'http://forums.e-hentai.org/index.php?showtopic=79874','',1396537349),(244,1,1,0,351219,51011,0,30,1500,0,'http://forums.e-hentai.org/index.php?showtopic=79874','or 1 Hath for 6 Pills',1396537387),(245,1,1,0,351219,4250000,0,2,105000,12,'http://forums.e-hentai.org/index.php?showtopic=79874','',1396537434),(246,1,1,0,351219,11216,0,10000,10,0,'http://forums.e-hentai.org/index.php?showtopic=79874','8c for below Lv330',1396537478),(247,1,1,0,351219,60009,0,170,9000,1,'http://forums.e-hentai.org/index.php?showtopic=79874','',1396537557),(248,1,1,0,120864,11501,0,40,1000,0,'http://forums.e-hentai.org/index.php?showtopic=161512','',1396537673),(249,1,0,0,106168,11401,0,1,27000,0,'http://forums.e-hentai.org/index.php?showtopic=106168','',1396597339),(250,1,0,0,106168,61001,0,1,700,0,'http://forums.e-hentai.org/index.php?showtopic=106168','',1396597419),(251,1,0,0,106168,60006,0,500,2000,0,'http://forums.e-hentai.org/index.php?showtopic=106168','',1396597442),(252,1,0,0,106168,60205,0,0,35000,3.5,'http://forums.e-hentai.org/index.php?showtopic=106168','',1396597468),(253,1,0,0,845532,60101,0,5,200000,0,'http://forums.e-hentai.org/index.php?showtopic=159264','',1396664900),(254,1,0,0,845532,60012,0,0,20000,0,'http://forums.e-hentai.org/index.php?showtopic=159264','',1396665190),(255,1,0,0,845532,60219,0,0,3000,0,'http://forums.e-hentai.org/index.php?showtopic=159264','',1396664951),(256,1,0,0,845532,60206,0,50,15000,0,'http://forums.e-hentai.org/index.php?showtopic=159264','',1396665697),(257,1,0,0,845532,60232,0,10,38000,0,'http://forums.e-hentai.org/index.php?showtopic=159264','',1396668272),(258,1,0,0,304927,11401,0,50,29000,0,'http://forums.e-hentai.org/index.php?showtopic=162560','',1396669346),(259,1,0,0,751774,51011,0,50,900,0,'http://forums.e-hentai.org/index.php?showtopic=162560','',1396669500),(260,1,0,0,751774,4250000,0,1,0,9,'http://forums.e-hentai.org/index.php?showtopic=162560','',1396669736),(261,1,0,0,932943,60201,0,0,0,17,'http://forums.e-hentai.org/index.php?showtopic=100118','',1396669780),(262,1,0,0,932943,60101,0,0,0,17,'http://forums.e-hentai.org/index.php?showtopic=100118','',1396670100),(263,1,0,0,932943,60234,0,0,0,3,'http://forums.e-hentai.org/index.php?showtopic=100118','',1396670120),(264,1,0,0,932943,60235,0,0,0,3,'http://forums.e-hentai.org/index.php?showtopic=100118','',1396670132),(265,1,0,0,932943,30032,0,0,55000,5.5,'http://forums.e-hentai.org/index.php?showtopic=100118','',1396670166),(267,1,2,0,0,70003,0,1,1000,1,'','',1396685575),(268,1,1,1,368893,NULL,34697761,1,1000000,0,'','MMAX WD, LMAX-0.1 Crit, LMAX AGI, 3PABS',1396772298),(269,1,1,1,368893,NULL,42646343,1,1000000,0,'','LMAX-0.8 WD, MMAX ACC, LMAX Parry,',1396772336),(270,1,1,1,368893,NULL,37738038,1,6000000,0,'','MMAX EDB, EXMAX Evade',1396772472),(271,1,1,1,368893,NULL,30064006,1,2000000,0,'http://forums.e-hentai.org/index.php?showtopic=105400','',1396772745),(272,1,1,1,351219,NULL,41511415,1,6000000,650,'http://forums.e-hentai.org/index.php?showtopic=79874','',1396772658);
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
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
INSERT INTO `play` VALUES (0,' [demo] '),(1,' [demo2]'),(5375,'hentai_inu'),(11057,'something'),(26854,'mike23'),(50079,'HNTI'),(106168,'wannaf'),(118065,'CZer'),(120864,'piyin'),(141102,'FarFaraway'),(156648,'sumu'),(214475,'Tearlow'),(230598,'eeveelugia'),(301767,'varst'),(304927,'holy_demon'),(309874,'arialinnoc'),(351219,'ST-Ru'),(363949,'lastbeer'),(367780,'å°äº‘æœ€çˆ±ç™¾åˆ'),(368893,'Teana Lanster'),(372523,'lichtenlade'),(409722,'danixxx'),(422507,'FermiSea'),(434157,'Hito Shura'),(465941,'Laboq'),(472360,'register1997'),(531274,'Jarun'),(629266,'ffbonic'),(631809,'q1z2x3'),(636841,'kaien123456'),(640958,'simrock87'),(646621,'dkarcher'),(681123,'tychocelchu'),(700155,'crass1'),(707354,'Treesion'),(751774,'limitbreak'),(755740,'xyzjarod'),(776386,'SinBear'),(836631,'åƒçŸ³ æ’«å­'),(845532,'hihentai'),(896192,'ace_amuro'),(924276,'Mantra64'),(932943,'StonyCat'),(967846,'ConfusedPerv'),(989808,'ctxl'),(1027298,'åšéº— éœŠå¤¢'),(1068395,'wolfgirl of autumn92'),(1139412,'atest1'),(1158525,'na2ver'),(1160049,'skywaterboy'),(1168408,'EinstÂ·Alchimie'),(1198948,'JoElementalist'),(1232071,'treesloth16'),(1244012,'traficantj'),(1267121,'avalhcz'),(1308950,'gzzhongqi'),(1310977,'Yakamoz moon'),(1335632,'Elven Ranger'),(1388874,'r1270'),(1397157,'tsukikoazusa'),(1431900,'Dreamophobia'),(1463495,'Ariahs'),(1513872,'soso7410'),(1606436,'LOL50015'),(1790314,'FreeSHop');
/*!40000 ALTER TABLE `play` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-04-06 16:30:32
