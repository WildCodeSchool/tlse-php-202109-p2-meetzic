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
-- Table structure for table `musician`
--

DROP TABLE IF EXISTS `musician`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `musician` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nickname` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `experience` enum('beginner','advanced','expert') NOT NULL DEFAULT 'beginner',
  `description` text,
  `status` tinyint NOT NULL DEFAULT '1',
  `instrument_id` int DEFAULT NULL,
  `band_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nickname_UNIQUE` (`nickname`),
  KEY `fk_musician_1_idx` (`instrument_id`),
  KEY `fk_musician_2_idx` (`band_id`),
  CONSTRAINT `fk_musician_1` FOREIGN KEY (`instrument_id`) REFERENCES `instrument` (`id`),
  CONSTRAINT `fk_musician_2` FOREIGN KEY (`band_id`) REFERENCES `band` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `musician`
--

LOCK TABLES `musician` WRITE;
/*!40000 ALTER TABLE `musician` DISABLE KEYS */;
INSERT INTO `musician` VALUES (1,'JHendrix','jhendrix','jhendrix@wild.com','https://wikinabia.com/images/c/c9/Jimi_Hendrix.jpeg','beginner','Passionn?? de guitare depuis 60 ans',1,1,NULL),(2,'MJackson','mjackson','mjackson@wild.com','https://www.ilove80smusic.com/media/artists/michael-jackson.jpg','advanced','Bonjour ! Et non je ne suis pas mort !',1,4,NULL),(3,'Phil','phil','phil@wild.com','https://img.nrj.fr/bxQyBzdKjy-DvauD28Vp5xBiWKk=/https://image-api.nrj.fr/medias/2020/02/phil-collins_5e3838fa9f82c.jpg','expert','Hello, je suis Philippe Collins, un batteur et chanteur',0,2,NULL),(4,'Morrison','morrison','morrison@wild.com','https://static.lavenir.net/Assets/Images_Upload/Actu24/2021/07/02/5e7bd9c4-db46-11eb-b154-6a2692a76b0f_original.jpg?maxheight=280&maxwidth=400&scale=both','beginner','Hello, je suis Jim, chanteur du groupe \"les portes\"',1,4,1),(5,'Jagger','jagger','jagger@wild.com','https://www.leparisien.fr/resizer/hesFlzXimGPSHvs8CL2cuSK-aCc=/932x582/arc-anglerfish-eu-central-1-prod-leparisien.s3.amazonaws.com/public/IEEKJ5PNXYZSCBL33ABATLSMU4.jpg','advanced','Bonjour ! Je m\'appelle Mick, tr??s vieux chanteur de rock',1,4,2),(6,'FMercure','fmercure','fmercure@wild.com','https://www.metalzone.fr/wp-content/uploads/2020/05/freddie-mercury-1200x900.jpg','beginner','The show must go on !',1,4,3),(7,'Yvette','yvette','yvette@wild.com','https://file1.telestar.fr/var/telestar/storage/images/3/1/1/6/3116763/photos.-mort-yvette-horner-quand-accordeoniste-posait-pour-telestar.jpg?alias=original','expert','Accord??oniste pro avec cheveux orange',1,9,NULL),(8,'Prince','prince','prince@wild.com','https://framboisemood.files.wordpress.com/2016/04/prince.jpg','expert','Salut les gars! Guitariste dans l\'??me, n\'h??sitez pas ?? me contacter pour rocker ensemble',1,1,NULL),(9,'Mobley','leon','mleon@wild.com','https://smartbiography.com/wp-content/uploads/2019/12/Leon-Mobley.jpg','advanced','Hi les Bros!! j\'adore la percussion, je suis pr??t ?? mettre l\'ambiance',1,8,NULL),(10,'Chamboissier','Claude','chamb@wild.com','https://www.toutelatele.com/IMG/arton67292.jpg','beginner','Coucou les loulous! J\'affectionne le clavier',1,6,4),(11,'Slash','antislash','slash@wild.com','https://images.sk-static.com/images/media/profile_images/artists/44022/huge_avatar','expert','Holla, je me pr??nomme Slash qui suis pas mal ?? la guitare',1,1,6),(12,'Filip','filip','filip@wild.com','https://resize-elle.ladmedia.fr/r/625,,forcex/crop/625,804,center-middle,forcex,ffffff/img/var/plain_site/storage/images/people/la-vie-des-people/news/filip-des-2be3-est-mort/12255118-1-fre-FR/filip_des_2be3_est_mort.jpg','beginner','Bonjour , chanteur d\'un trio nomm?? les 2Be3',1,4,5);
/*!40000 ALTER TABLE `musician` ENABLE KEYS */;
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
