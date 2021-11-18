-- MySQL dump 10.13  Distrib 8.0.27, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: WhereIsMyBand
-- ------------------------------------------------------
-- Server version	8.0.27-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ad`
--

DROP TABLE IF EXISTS `ad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ad` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `musician_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ad_1_idx` (`musician_id`),
  CONSTRAINT `fk_ad_1` FOREIGN KEY (`musician_id`) REFERENCES `musician` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ad`
--

LOCK TABLES `ad` WRITE;
/*!40000 ALTER TABLE `ad` DISABLE KEYS */;
INSERT INTO `ad` VALUES (8,'Guitariste recherche groupe blues rock','Hello, je recherche un groupe blues rock pour participer avec moi au prochain Woodstock festival.',NULL,1),(9,'Chanteur pop célèbre cherche groupe','Je recherche 4 frères pour chanter et danser avec moi.',NULL,2),(10,'Recherche plusieurs musiciens pour projet rock progressif','Je souhaite reformer le groupe de mes débuts qui s\'appelait Genesis. Je recherche un guitariste, un clavier et un bassiste.',NULL,3),(11,'Groupe légendaire cherche son batteur','Nous recherchons un batteur ! Si vous pensez avoir les qualités nécessaires pour jouer avec nous. on est p$et à vous entendre.',NULL,4),(12,'Les papys du rock se réinventent','Comme il n\'est jamais trop tard pour évoluer artistiquement, les Breaking Stones, petit groupe rock connu mondialement recherche un accordeoniste style retro musette.',NULL,5),(13,'Recherche bassiste','Bonjour, je suis Frederic Mercure et je recherche un bassiste pour mon groupe \"King\". Urgent pour le prochain festival.',NULL,6),(14,'Recherche groupe aux influences diverses','Bonjour, je recherche un groupe de punk rock musette avec un touche de metal.',NULL,7),(15,'A la recherche d\'un groupe pour du soul','Salut à tous, je veux integré un groupe de soul, je suis fun, j\'adore ce que je fais et avec passion.',NULL,8),(16,'Percussioniste cherche un groupe de reggae','Bonjour, je veux appartenir à un groupe cool festif pour jouer et passer du bon temps',NULL,9),(17,'On n\'est jamais vieux pour se muscler','Salut les gars, on cherche un pianiste pour se muscler, ne soyez pas timide, on est ici pour s\'amuser, danser, rigoler. Allons-y !!!',NULL,10),(18,'Allons-y pour de nouvelles aventures','Je vous invite à nous joindre, nous cherchons un ou une accordéoniste qui manque à l\'appel dans notre groupe. si vous êtes chaude alors c\'est parti',NULL,11),(19,'Nous cherchons un chanteur','On cherche un chanteur pour remplacer l\'un des nôtre, si l\'envie de chanter vous vient, c\'est par ici que cela se passe. On espère vous entendre très prochainement.',NULL,12);
/*!40000 ALTER TABLE `ad` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-18 17:08:02
