-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: digital
-- ------------------------------------------------------
-- Server version	8.3.0

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
-- Table structure for table `dig_agenda`
--

DROP TABLE IF EXISTS `dig_agenda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dig_agenda` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `titulo` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `link` varchar(200) DEFAULT NULL,
  `target` varchar(100) DEFAULT NULL,
  `fkCliente` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dig_agenda`
--

LOCK TABLES `dig_agenda` WRITE;
/*!40000 ALTER TABLE `dig_agenda` DISABLE KEYS */;
INSERT INTO `dig_agenda` VALUES (1,'2024-05-28','20:00:00','Voley Playero','Veniam nulla numqua Veniam nulla numqua Veniam nulla numqua',NULL,'_self',1),(3,'2024-05-09','18:19:00','Aliquam necessitatib','Eos do optio amet','https://www.nejivivudasoneq.in','_blank',1),(4,'2024-05-29','10:00:00','asdasdas','dasdasdasd','http://admin.digital.localhost/agenda/listar','_self',1),(5,'2024-05-03','22:00:00','Teatro: “El amateur, segunda vuelta”','Una grata oportunidad de disfrutar de una pieza teatral multipremiada. Dirigida por Mauricio Dayub.','http://digital.localhost/leer/teatro-el-amateur-segunda-vuelta/12','_self',1);
/*!40000 ALTER TABLE `dig_agenda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dig_archivos`
--

DROP TABLE IF EXISTS `dig_archivos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dig_archivos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ruta` varchar(600) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `descripcion` varchar(600) DEFAULT NULL,
  `autor` varchar(100) DEFAULT NULL,
  `fkNota` int NOT NULL,
  `principal` int DEFAULT NULL,
  `baja` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dig_archivos`
--

LOCK TABLES `dig_archivos` WRITE;
/*!40000 ALTER TABLE `dig_archivos` DISABLE KEYS */;
INSERT INTO `dig_archivos` VALUES (1,'661427188d348.png','IMAGEN',NULL,NULL,3,1,'2024-08-07 09:38:58'),(2,'dsCl2kXJca4','VIDEO','video de youtube',NULL,4,NULL,'2024-08-07 09:11:36'),(3,'255048263','AUDIO','un audio bla bla',NULL,4,NULL,'2024-08-07 09:11:36'),(4,'661531e2a5ac4.png','IMAGEN',NULL,NULL,4,1,'2024-08-07 09:11:36'),(5,'dsCl2kXJca4','VIDEO','asdas dasd',NULL,4,NULL,'2024-08-07 09:11:36'),(6,'dsCl2kXJca4','VIDEO','asdas dasd',NULL,4,NULL,'2024-08-07 09:11:36'),(7,'ePDYMr7Yp8Y','VIDEO','otro video',NULL,4,NULL,'2024-08-07 09:11:36'),(8,'255048263','AUDIO','una descripcion',NULL,4,NULL,'2024-08-07 09:11:36'),(9,'250301552','AUDIO','otra descripcion',NULL,4,NULL,'2024-08-07 09:11:36'),(10,'66155a02df88f.png','IMAGEN',NULL,NULL,4,0,'2024-08-07 09:11:36'),(11,'66155a02e0a2b.png','IMAGEN',NULL,NULL,4,1,'2024-08-07 09:11:36'),(12,'66155d590fd5f.png','IMAGEN',NULL,NULL,5,1,'2024-04-16 10:59:53'),(13,'dsCl2kXJca4','VIDEO','asdasd',NULL,6,NULL,'2024-07-31 12:03:32'),(14,'255048263','AUDIO','asdasd',NULL,6,NULL,'2024-07-31 12:03:32'),(15,'66156fb23c602.png','IMAGEN',NULL,NULL,6,0,'2024-07-31 12:03:32'),(16,'66156fb23da4b.png','IMAGEN',NULL,NULL,6,1,'2024-07-31 12:03:32'),(17,'dsCl2kXJca4','VIDEO','asdas dasd',NULL,6,NULL,'2024-07-31 12:03:32'),(18,'255048263','AUDIO','una descripcion',NULL,6,NULL,'2024-07-31 12:03:32'),(19,'6619363ab434c.png','IMAGEN',NULL,NULL,6,1,'2024-07-31 12:03:32'),(20,'6619363abbdc7.png','IMAGEN',NULL,NULL,6,1,'2024-07-31 12:03:32'),(21,'dsCl2kXJca4','VIDEO','asdas dasd',NULL,6,NULL,'2024-07-31 12:03:32'),(22,'255048263','AUDIO','una descripcion',NULL,6,NULL,'2024-07-31 12:03:32'),(23,'66193dea82d6e.png','IMAGEN',NULL,NULL,6,1,'2024-07-31 12:03:32'),(24,'66193dea84348.png','IMAGEN',NULL,NULL,6,1,'2024-07-31 12:03:32'),(25,'dsCl2kXJca4','VIDEO','asdas dasd',NULL,6,NULL,'2024-07-31 12:03:32'),(26,'255048263','AUDIO','una descripcion',NULL,6,NULL,'2024-07-31 12:03:32'),(27,'6619676e4b349.png','IMAGEN',NULL,NULL,6,1,'2024-07-31 12:03:32'),(28,'6619676e4bf46.png','IMAGEN',NULL,NULL,6,1,'2024-07-31 12:03:32'),(29,'661d9d4d8b76d.png','IMAGEN',NULL,NULL,7,1,'2024-08-07 08:59:46'),(30,'661d9f10049e9.png','IMAGEN',NULL,NULL,7,1,'2024-08-07 08:59:46'),(31,'dsCl2kXJca4','VIDEO','asdas dasd',NULL,6,NULL,'2024-07-31 12:03:32'),(32,'255048263','AUDIO','una descripcion',NULL,6,NULL,'2024-07-31 12:03:32'),(33,'661da0a921ad5.png','IMAGEN',NULL,NULL,6,1,'2024-07-31 12:03:32'),(34,'661da0a92a169.png','IMAGEN',NULL,NULL,6,1,'2024-07-31 12:03:32'),(35,'dsCl2kXJca4','VIDEO','asdas dasd',NULL,6,NULL,'2024-07-31 12:03:32'),(36,'255048263','AUDIO','una descripcion',NULL,6,NULL,'2024-07-31 12:03:32'),(37,'661da26a62d9c.png','IMAGEN',NULL,NULL,6,1,'2024-07-31 12:03:32'),(38,'661da26a64a73.png','IMAGEN',NULL,NULL,6,1,'2024-07-31 12:03:32'),(39,'661dc41e25701.png','IMAGEN',NULL,NULL,8,1,'2024-07-31 11:56:00'),(40,'661dc4425ed7b.png','IMAGEN',NULL,NULL,8,1,'2024-07-31 11:56:00'),(41,'661dc46a50c9d.png','IMAGEN',NULL,NULL,8,1,'2024-07-31 11:56:00'),(42,'661dd1ae0e011.png','IMAGEN',NULL,NULL,2,1,'2024-08-07 08:43:51'),(43,'661dd1e9df310.png','IMAGEN',NULL,NULL,2,1,'2024-08-07 08:43:51'),(44,'661dd74644445.png','IMAGEN',NULL,NULL,9,1,'2024-08-07 08:57:27'),(45,'661e6be335fd2.png','IMAGEN',NULL,NULL,9,1,'2024-08-07 08:57:27'),(46,'661e6c62d1d9d.png','IMAGEN',NULL,NULL,10,1,'2024-04-24 11:27:53'),(47,'661e6d8d9f7f8.png','IMAGEN',NULL,NULL,11,1,NULL),(48,'661e6d8dad43e.png','IMAGEN',NULL,NULL,11,0,NULL),(49,'661e6d8db5a2e.png','IMAGEN',NULL,NULL,11,0,NULL),(50,'661e6e5b22158.png','IMAGEN',NULL,NULL,12,0,'2024-04-24 10:26:51'),(51,'661e6e5b265b9.png','IMAGEN',NULL,NULL,12,1,'2024-04-24 10:26:51'),(52,'661e6e8b824fd.png','IMAGEN',NULL,NULL,12,1,'2024-04-24 10:26:51'),(53,'661e6e8b849f9.png','IMAGEN',NULL,NULL,12,0,'2024-04-24 10:26:51'),(54,'661e6f5867a0e.png','IMAGEN',NULL,NULL,7,1,'2024-08-07 08:59:46'),(55,'661e712b7eca0.png','IMAGEN',NULL,NULL,13,1,'2024-04-24 11:28:54'),(56,'661e83b6be228.png','IMAGEN',NULL,NULL,14,1,'2024-04-24 11:27:21'),(57,'661e83e23cdbd.png','IMAGEN',NULL,NULL,14,1,'2024-04-24 11:27:21'),(58,'661e8413aab99.png','IMAGEN',NULL,NULL,7,1,'2024-08-07 08:59:46'),(59,'661e8459c0c71.png','IMAGEN',NULL,NULL,5,1,NULL),(60,'661e90e6e79b7.png','IMAGEN',NULL,NULL,15,1,NULL),(61,'661e91713ab66.png','IMAGEN',NULL,NULL,16,1,NULL),(62,'661ea5af05e5a.png','IMAGEN',NULL,NULL,17,1,'2024-08-07 09:03:12'),(63,'661eaa957d9c9.png','IMAGEN',NULL,NULL,18,1,'2024-07-31 11:22:38'),(64,'661fb764300ed.png','IMAGEN',NULL,NULL,19,1,NULL),(65,'661fcdf8816ef.png','IMAGEN',NULL,NULL,20,1,'2024-08-07 09:00:29'),(66,'661fced8e0586.png','IMAGEN',NULL,NULL,21,1,'2024-04-24 11:26:49'),(67,'661fcef3b7b4c.png','IMAGEN',NULL,NULL,21,1,'2024-04-24 11:26:49'),(68,'66212fbd2f545.png','IMAGEN',NULL,NULL,12,1,'2024-04-24 10:26:51'),(69,'66212fbd3bcc4.png','IMAGEN',NULL,NULL,12,0,'2024-04-24 10:26:51'),(70,'66212fd6f3ac3.png','IMAGEN',NULL,NULL,12,0,'2024-04-24 10:26:51'),(71,'66212fd703482.png','IMAGEN',NULL,NULL,12,1,'2024-04-24 10:26:51'),(72,'662136ac81920.png','IMAGEN',NULL,NULL,12,1,'2024-04-24 10:26:51'),(73,'662136ac86037.png','IMAGEN',NULL,NULL,12,0,'2024-04-24 10:26:51'),(74,'yQ5GzlOuvVk','VIDEO','Trailer',NULL,12,NULL,'2024-04-24 10:26:51'),(75,'1693855326','AUDIO','Nota de audio',NULL,12,NULL,'2024-04-24 10:26:51'),(76,'66213b31935ec.png','IMAGEN',NULL,NULL,12,1,'2024-04-24 10:26:51'),(77,'66213b31960e0.png','IMAGEN',NULL,NULL,12,1,'2024-04-24 10:26:51'),(78,'yQ5GzlOuvVk','VIDEO','asdas dasd',NULL,12,NULL,'2024-04-24 10:26:51'),(79,'1693855326','AUDIO','una descripcion',NULL,12,NULL,'2024-04-24 10:26:51'),(80,'662149b86bb28.png','IMAGEN',NULL,NULL,12,1,'2024-04-24 10:26:51'),(81,'662149b86d07e.png','IMAGEN',NULL,NULL,12,1,'2024-04-24 10:26:51'),(82,'yQ5GzlOuvVk','VIDEO','asdas dasd',NULL,12,NULL,NULL),(83,'1693855326','AUDIO','una descripcion',NULL,12,NULL,NULL),(84,'6629089b7b95f.png','IMAGEN',NULL,NULL,12,1,NULL),(85,'6629089b7df62.png','IMAGEN',NULL,NULL,12,1,NULL),(86,'66290fdaa2389.png','IMAGEN',NULL,NULL,2,1,'2024-08-07 08:43:51'),(87,'6629105d771ae.png','IMAGEN',NULL,NULL,18,0,'2024-07-31 11:22:38'),(88,'662910a349347.png','IMAGEN',NULL,NULL,17,0,'2024-08-07 09:03:12'),(89,'6629152938179.png','IMAGEN',NULL,NULL,8,0,'2024-07-31 11:56:00'),(90,'6629154fe514f.png','IMAGEN',NULL,NULL,2,0,'2024-08-07 08:43:51'),(91,'662915797e39c.png','IMAGEN',NULL,NULL,9,0,'2024-08-07 08:57:27'),(92,'6629159f31db0.png','IMAGEN',NULL,NULL,20,0,'2024-08-07 09:00:29'),(93,'6629168641f75.png','IMAGEN',NULL,NULL,7,0,'2024-08-07 08:59:46'),(94,'662916a944cec.png','IMAGEN',NULL,NULL,21,0,NULL),(95,'662916c942c10.png','IMAGEN',NULL,NULL,14,0,NULL),(96,'662916e98fdf7.png','IMAGEN',NULL,NULL,10,1,NULL),(97,'6629172632e88.png','IMAGEN',NULL,NULL,13,0,NULL),(98,'6669c73761eb0.png','IMAGEN',NULL,NULL,23,1,NULL),(99,'66aa42284bf8e.png','IMAGEN',NULL,NULL,18,1,'2024-07-31 11:22:38'),(100,'66aa43b2d2830.png','IMAGEN',NULL,NULL,18,1,'2024-07-31 11:22:38'),(101,'66aa46485344a.png','IMAGEN',NULL,NULL,18,1,'2024-07-31 11:22:38'),(102,'66aa4837c7356.png','IMAGEN',NULL,NULL,3,1,'2024-08-07 09:38:58'),(103,'dsCl2kXJca4','VIDEO','asdas dasd',NULL,4,NULL,'2024-08-07 09:11:36'),(104,'ePDYMr7Yp8Y','VIDEO','asdas dasd',NULL,4,NULL,'2024-08-07 09:11:36'),(105,'255048263','AUDIO','una descripcion',NULL,4,NULL,'2024-08-07 09:11:36'),(106,'250301552','AUDIO','una descripcion',NULL,4,NULL,'2024-08-07 09:11:36'),(107,'66aa488a70c3c.png','IMAGEN',NULL,NULL,4,1,'2024-08-07 09:11:36'),(108,'66aa488a71d23.png','IMAGEN',NULL,NULL,4,1,'2024-08-07 09:11:36'),(109,'66aa48ae18d73.png','IMAGEN',NULL,NULL,18,1,NULL),(110,'66aa508026ba0.png','IMAGEN',NULL,NULL,8,1,NULL),(111,'dsCl2kXJca4','VIDEO','asdas dasd',NULL,6,NULL,NULL),(112,'255048263','AUDIO','una descripcion',NULL,6,NULL,NULL),(113,'66aa5244d87d7.png','IMAGEN',NULL,NULL,6,1,NULL),(114,'66aa5244d97a9.png','IMAGEN',NULL,NULL,6,1,NULL),(115,'66aa5250d193f.png','IMAGEN',NULL,NULL,17,1,'2024-08-07 09:03:12'),(116,'66b35b7340503.png','IMAGEN',NULL,NULL,20,1,'2024-08-07 09:00:29'),(117,'66b35dcd6be36.png','IMAGEN',NULL,NULL,2,1,'2024-08-07 08:43:51'),(118,'66b35df73fa30.png','IMAGEN',NULL,NULL,2,1,NULL),(119,'66b3612766a64.png','IMAGEN',NULL,NULL,9,1,NULL),(120,'66b361b2ec1e7.png','IMAGEN',NULL,NULL,7,1,NULL),(121,'66b361ddde11e.png','IMAGEN',NULL,NULL,20,1,NULL),(122,'66b36280a6d05.png','IMAGEN',NULL,NULL,17,1,NULL),(123,'dsCl2kXJca4','VIDEO','asdas dasd',NULL,4,NULL,NULL),(124,'ePDYMr7Yp8Y','VIDEO','asdas dasd',NULL,4,NULL,NULL),(125,'255048263','AUDIO','una descripcion',NULL,4,NULL,NULL),(126,'250301552','AUDIO','una descripcion',NULL,4,NULL,NULL),(127,'66b3647859c36.png','IMAGEN',NULL,NULL,4,1,NULL),(128,'66b364785daa5.png','IMAGEN',NULL,NULL,4,1,NULL),(129,'66b36ae258c56.png','IMAGEN',NULL,NULL,3,1,NULL);
/*!40000 ALTER TABLE `dig_archivos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dig_autores`
--

DROP TABLE IF EXISTS `dig_autores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dig_autores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudonimo` varchar(100) DEFAULT NULL,
  `foto` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `email` varchar(100) DEFAULT NULL,
  `fkUsuario` int NOT NULL,
  `baja` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dig_autores`
--

LOCK TABLES `dig_autores` WRITE;
/*!40000 ALTER TABLE `dig_autores` DISABLE KEYS */;
/*!40000 ALTER TABLE `dig_autores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dig_clientes`
--

DROP TABLE IF EXISTS `dig_clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dig_clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cliente` varchar(100) NOT NULL,
  `activo` int DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date NOT NULL,
  `referente` varchar(100) NOT NULL,
  `baja` datetime DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dig_clientes`
--

LOCK TABLES `dig_clientes` WRITE;
/*!40000 ALTER TABLE `dig_clientes` DISABLE KEYS */;
INSERT INTO `dig_clientes` VALUES (1,'Municipalidad de Chascomús',1,'pamela.abarca@chascomus.gob.ar','2024-02-20','2028-02-20','Pamela Abarca',NULL,'6333dc44-f742-11ee-bc68-8f0b888813c3'),(106,'Uppermind',1,'nicolas.galli@gmail.com','2024-03-22','2034-01-22','Nicolas galli',NULL,'63341a2e-f742-11ee-bc68-8f0b888813c3');
/*!40000 ALTER TABLE `dig_clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dig_notas`
--

DROP TABLE IF EXISTS `dig_notas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dig_notas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `volanta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `titulo` varchar(256) NOT NULL,
  `bajada` text NOT NULL,
  `texto` text NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `fechaPublicacion` date NOT NULL,
  `tags` varchar(256) DEFAULT NULL,
  `tipo` varchar(255) NOT NULL DEFAULT '0',
  `fkAutor` int DEFAULT NULL,
  `impresiones` int DEFAULT NULL,
  `lecturas` int DEFAULT NULL,
  `fkSeccion` int NOT NULL,
  `fkUsuario` bigint NOT NULL,
  `baja` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dig_notas_fwk_usuario_FK` (`fkUsuario`),
  KEY `dig_notas_dig_autores_FK` (`fkAutor`),
  FULLTEXT KEY `fulltext_index` (`titulo`,`bajada`,`texto`),
  CONSTRAINT `dig_notas_dig_autores_FK` FOREIGN KEY (`fkAutor`) REFERENCES `dig_autores` (`id`),
  CONSTRAINT `dig_notas_fwk_usuario_FK` FOREIGN KEY (`fkUsuario`) REFERENCES `fwk_usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dig_notas`
--

LOCK TABLES `dig_notas` WRITE;
/*!40000 ALTER TABLE `dig_notas` DISABLE KEYS */;
INSERT INTO `dig_notas` VALUES (1,'Volanta Uppermind','Titulo Uppermind','bajada uppermind','<p>texto uppermind</p>','2024-04-08 11:29:53','2024-04-08','chascomus,uppermind','pos1',NULL,0,37,32,106,NULL),(2,'Luego del temporal','NO SE REGISTRARON DAÑOS DURANTE LAS TORMENTAS','Durante el fin de semana con alerta meteorológica, la secretaría de Seguridad Ciudadana informó que se realizaron medidas de prevención desde el área de Defensa Civil y se recibieron distintos llamados al Centro de Monitoreo.','<p>Consultada esta mañana en el programa radial AM Show, la directora de Defensa Civil, Silvina Lantaño, manifestó que los registros de lluvias de este fin de semana alcanzaron “entre los 104 a 120 milímetros acumulado, depende la zona que tomemos como referencia, desde las horas temprana del día sábado hasta el momento”.<br></p><p>“Como se observó a través de las redes -explicó la funcionaria-, en los informes que hemos brindado, comenzamos el sábado haciendo prevención, solicitando a los vecinos la verificación de canaletas en sus viviendas, que estuvieran destapadas, que no estuvieran obstruidas por basura. Todas las recomendaciones que siempre brindamos para evitar inconvenientes”.</p><p>Respecto de las alertas meteorológicas, dijo que: “Fueron apareciendo, a través del Servicio Meteorológico Nacional, distintas placas. Comenzando con las alertas amarilla y, en el día de ayer (domingo), subieron a naranja. Por suerte los vientos anunciados no sucedieron en nuestra zona, pero sí las lluvias”.</p><p>Y continuó: “Durante el día de hoy, no hay cambios significativos del panorama meteorológico. Vamos a continuar registrando lluvias y tormentas, que hasta el momento están localizadas en el este de la provincia y van avanzando lentamente hacia el sur. Esto significa que la mejora paulatina la vamos a ver en la noche de hoy y en la mañana del martes. Por ello, tenemos que seguir con la prevención. Por supuesto hay sectores anegados, que cuesta el escurrimiento de agua, porque los suelos ya están húmedos”.</p><p>En referencia a las asistencias de su área, manifestó la directora Lantaño que “el sábado fue leve, porque tuvimos que asistir con nylon un sólo grupo familiar para solucionar temporalmente el inconveniente y, en la madrugada de anoche, donde la lluvia fue más abundante, tuvimos cinco intervenciones”.</p><p>También explicó que respondieron a llamados que daban cuenta de dos cables de alumbrado y un poste caídos y, en la madrugada de hoy, una planta caída sobre calle Castelar, que obstruía el tránsito, pero ya fue liberada esa arteria”.</p><p>Finalmente, advirtió que “debemos continuar con las medidas preventivas para afrontar las tormentas, sabiendo que el suelo no absorbe rápidamente, toda vez que se mantiene húmedo por las permanentes lluvias. Ante estas alertas debemos estar atentos y cuidarnos entre todos”.</p><p>Asimismo, recordó que está disponible la línea 103, de la Secretaría de Seguridad Ciudadana, donde se centralizan los llamados para agilizar las respuestas municipales.</p>','2024-04-08 11:30:33','2024-04-05','Chascomús','fija',NULL,218,36,32,106,NULL),(3,'Molestiae enim sit omnis nostrud ipsam','Deleniti voluptate et fugiat excepturi aliquam deserunt velit facilis aut aut voluptatibus in maxime labore ad','Earum veniam dolorem commodo dolore quia minus unde fuga Ut qui asperiores id molestiae ipsum dignissimos a','Irure amet velit al','2024-04-08 14:19:20','2011-11-01','Chascomús,Ut laboriosam nulla','general',NULL,0,36,32,1,NULL),(4,'Prueba con todos los archivos 2','prueba modificada','Qui ullam dolores atque iusto officiis neque 2','<p>Aut exercitationem e 2</p>','2024-04-09 09:17:38','1979-01-23','Chascomús,modificada','general',NULL,0,36,32,1,NULL),(5,'una nota de prueba','una nota de prueba','Atque fugit laborum accusantium expedita voluptate incididunt adipisicing cumque cumque voluptatem Quis eum aut consectetur dolor aute','Iste velit sint plac','2024-04-09 12:23:05','2024-04-16','Chascomús,Nostrud excepturi nu','general',NULL,181,36,3,106,NULL),(6,'Dolore non voluptatem qui dolore odit est in quis','Laboriosam eu ut porro expedita mollit quam ab ipsa sequi asperiores provident dolor doloribus velit numquam a magni repudiandae sit','Laborum Corporis quas numquam et numquam necessitatibus cupiditate omnis eos non laboris ea quis voluptatem Quo voluptatem','Deleniti mollit saep','2024-04-09 13:41:22','2024-02-01','Chascomús,Omnis iusto ad ad su','pos2',NULL,218,36,1,106,NULL),(7,'Encuentro de Pintura','SE ACERCA LA TERCERA EDICIÓN DE \"PINTANDO CHASCOMÚS\"','Viernes 10 y sábado 11 de mayo, en la Casa de Casco, se realizará el 3° Encuentro y Concurso de Manchas, paisajista al aire libre.','<p>La Municipalidad de Chascomús, en conjunto con la Sociedad Argentina de Artistas Plásticos (SAAP), convoca al 3° Encuentro y Concurso de Manchas, paisajista al aire libre, que se llevará a cabo en el marco de los festejos por el 245° aniversario de la fundación de la ciudad, que se realizarán durante todo el mes de mayo.</p><p>El evento contará con categorías para profesionales y aficionados (ambas para mayores de 18 años) y para niños y niñas hasta 12 años, quienes tomarán parte fuera de concurso y recibirán un certificado de participación.</p><p>Cada inscripto deberá presentar una obra que refleje el paisaje de Chascomús en un soporte rígido, montada sin marco ni vidrio.</p><p>Las técnicas de pintura son libres, y el lugar y tema serán la ciudad de Chascomús y sus alrededores. El concurso se llevará a cabo al aire libre permitiendo a los artistas explorar y capturar la esencia del paisaje local en sus creaciones.</p><p>La inscripción será en la Casa de Casco a partir de las 14 horas del viernes 10 de mayo y la participación será libre y gratuita.</p><p>El jurado, compuesto por profesionales de las artes plásticas y veedores en representación de los organizadores, otorgará premios y menciones.</p><p>En la Categoría “Profesionales”, el 1° Premio Adquisición será de $100.000; el 2° Premio Adquisición, de $70.000 y el 3° Premio Adquisición, de $40.000.</p><p>En tanto que, para “Aficionados”, el 1°Premio Adquisición recibirá $50.000, 2° Premio Adquisición, $30.000 y el 3° Premio Adquisición, $20.000.</p><p>Además, en la Casa de Casco se realizará una exposición con las obras premiadas y mencionadas, que formarán parte del patrimonio cultural local.</p><p>Los encuentros y concursos de manchas que se realizan en distintos puntos del país constituyen un espacio cultural que genera y propicia el intercambio de conocimientos y experiencias entre los pares y con el público que asiste a estas fiestas de creatividad, sensibilidad y vivencias, además de una actividad que fomenta el turismo.</p><p>Para más información e inscripciones, se puede contactar a través del correo electrónico: infosaap2@gmail.com.</p>','2024-04-12 09:41:33','2024-04-14','Chascomús,Expedita ad qui sint','general',NULL,79,36,32,106,NULL),(8,'Nesciunt qui rerum veniam ratione anim officiis','Fugiat aliqua Animi enim dolor inventore nostrum esse nisi eligendi vero facere suscipit','Voluptatem atque vero tempora fugiat in alias dolores esse distinctio Tenetur natus iure quis sed ut','Amet accusamus amet','2024-04-12 11:00:05','2024-01-25','Chascomús,Minima ex repudianda','pos3',NULL,218,36,32,106,NULL),(9,'ECO TRAIL','PRIMER TRAIL RUNNING CHASCOMÚS','Desde la Municipalidad de Chascomús, se realizan distintas propuestas para potenciar el turismo, el deporte y la cultura de nuestra ciudad, tanto para los vecinos como para quienes nos visitan.','<p>Dada las inclemencias climáticas, participaron 179 deportistas, quienes se mostraron agradecidos con el excelente trato y organización.</p><p>Consultado por el programa “Ataque de Radio”, el subsecretario de Deportes, Pablo Francese, manifestó que: “Estamos muy contento con esto que nos tocó vivir ayer. Nosotros en el caso del running, veníamos sosteniendo desde hace algunos años un circuito de calle, pero también queríamos darle una vuelta de rosca a eso. Y empezamos a trabajar, ya hace unos cuantos meses atrás, con los profesores en realizar una modificación a ese circuito y terminamos definiendo un calendario running, donde se contemplaron distintas modalidades de competencia”.</p><p>Y prosiguió: “En ese sentido, ayer tuvimos en esta primera fecha del calendario, con un trail que por primera vez organizamos desde la subsecretaría de Deportes y la verdad, como lo conversábamos ayer en La alameda, a quienes aprovecho también a agradecer por acompañar y la predisposición para poner las instalaciones y todos sus servicios para que salga un excelente evento, nosotros quedamos muy muy contentos, salió una hermosa fiesta y lo pudimos disfrutar todos”.</p><p>En cuanto al equipo municipal y todo el armado previo como el momento del trail, destacó que: “Es el trabajo silencioso y que no se ve, quiero destacar el enorme agradecimiento y felicitar a todo el equipo de la subsecretaría de Deportes, por la organización. Los competidores si bien hacen el enorme esfuerzo de participar, de correr y de ser parte fundamental de la competencia; hay todo un trabajito de hormiga previo, que no se resume al sábado anterior cuando hicimos todo el recorrido de los 12 kilómetros para facilitar la competencia; sino también destacar el recibimiento, la atención, la señalética de la carrera y la difusión de la misma. Creo que todo estuvo a la altura de las circunstancias, y eso a nosotros nos gratifica. Estamos muy felices por la devolución que tuvimos de los participantes”.</p><p>Por otra parte, el subsecretario dio a conocer como quedaron conformados los podios en la clasificación general.</p><p>En la categoría 6 km damas, el primer lugar fue para Natalia Santiago (Ranchos), 2° para Mónica Patricia Cafehe y el 3 puesto para la chascomunense Fernanda Nuñez.</p><p>En la categoría 6 km, masculinos, lideró el podio el chascomunense Martín Alegra, seguido por otro vecino de nuestra ciudad, Diego Cialceta; quedando en el tercer lugar, Gonzalo Monzón, de José León Suárez.</p><p>En la Categoría 12 km - damas, obtuvo el primer puesto Lidia Alejandra Pistonesi, de CABA, el 2° lugar fue para Daniela Cornell de la vecina localidad de Ranchos y completó el podio la chascomunense, Yamila Dorado.</p><p>En la categoría 12 km, masculinos, obtuvo el primer lugar el dolorense Diego Farías; el segundo puesto fue para Tomás Galán de CABA, un corredor de CABA, y tercero el chascomunense, Ramiro Arias.</p><p>A su vez, el funcionario municipal anticipó que ya tienen fechas del calendario anual donde se disputarán carreras de distintas modalidades. “Indudablemente ya tenemos próximas fechas, otro trail para septiembre, también el ecotrail en octubre, pero también queremos seguir trabajando sobre el circuito de calle, seguir potenciando los 21 km de Chascomús, queremos seguir apostando a las carreras de postas y, bueno, en ese sentido vamos trabajando las distintas propuestas para ofrecer desde la Municipalidad de Chascomús”.</p>','2024-04-15 22:41:26','2024-04-12','Chascomús','fija',NULL,218,36,32,106,NULL),(10,'Libre y gratuito','FESTIVAL DE MASCOTAS EN EL PARQUE LIBRES DEL SUR','Se realizará en adhesión al Día del Animal, el sábado 27 de abril. Actividad totalmente gratuita para disfrutar junto a nuestras mascotas, de 9 a 12 horas.','<p>En este marco, se anuncia una clase abierta de adiestramiento canino, que dictará Sergio González, director de “Ser Can Adiestramiento Canino” y, a su vez, diversas organizaciones y entidades locales presentarán una serie de actividades para concientizar sobre la importancia de proteger y respetar a los animales.</p><p>Esta actividad, donde las mascotas serán sin dudas las protagonistas, contará con la presencia de la dirección de Bromatología y Zoonosis municipal, que continuará en este espacio la campaña de vacunación antirrábica.</p><p>Asimismo, estarán participando integrantes de “Vyda Chascomús”, agrupación dedicada al rescate y reubicación de mascotas en situación de calle de esta ciudad.</p><p>Por otra parte, la Sociedad Argentina de Escritores - filial Chascomús (SADECH), brindará un espacio para la reflexión en torno a la tenencia responsable de mascotas, con propuestas de escritura.</p><p>También, participará el grupo de ciclistas \"Los exiliados MTB\", quienes darán una vuelta simbólica al parque por la tenencia responsable de las macotas y el respeto animal.</p>','2024-04-16 09:17:38','2024-04-16','Chascomús','general',NULL,181,36,40,106,NULL),(11,'Actividades Gratuitas','QUE VAS A HACER EL FINDE?','Se anuncia un finde para disfrutar de muchas alternativas en Chascomús, pasando por la aventura y el deporte hasta el ruido de los motores de los autos clásicos. Y entre estos, mucha diversión, entretenimientos, recitales solidarios y mucho','<p>A continuación, se brindan detalles de la agenda de actividades para disfrutar:</p><p><strong>-Viernes 12</strong></p><p>-VISITA GUIADA \"MUSEO PAMPEANO\". A las 11 horas. Actividad sin cargo. Previa inscripción, solicitando el link vía whatsApp al 2241-603414 o ingresando en el siguiente link: https://linktr.ee/visitasguiadas.turismoch</p><p>-MUESTRA FOTOGRÁFICA EN MIS OJOS, MALVINAS - DE RUBÉN DIGILIO. DE 9 a 15 hs. Casa de Casco.</p><p>-MUESTRA PICTÓRICA “ARROCEROS” DE CAROLINA ETCHEPARE. De 9 a 15 hs. Museo Pampeano.</p><p>-VISITA GUIADA “RAÚL DE CHASCOMÚS”. A las 15 horas. Actividad sin cargo. Previa inscripción, solicitando el link vía whatsApp al 2241-603414 o ingresando en el siguiente link: https://linktr.ee/visitasguiadas.turismoch</p><p>- CHARLA DE CAROLINA ETCHEPARE Y CIERRE DE LA MUESTRA DE PINTURAS “ARROCEROS”. A las 19 horas, en el Museo Pampeano, Avda. Lastra y Muñiz. Acceso libre y gratuito.</p><p>-TRIBUTO A FITO PÁEZ. A las 21 horas, en el Teatro Brazzola. Entrada un alimento no perecedero, a beneficio de los comedores de la ciudad.</p><p><br></p><p><strong>-Sábado 13</strong></p><p>-MUESTRA PICTÓRICA \"MUJERES\", DE SILVIA RODRÍGUEZ. De 10 a 16 horas. Centro Cultura Municipal “Vieja Estación”.</p><p>-VISITA GUIADA CAPILLA DE LOS NEGROS. A las 11 horas. Actividad sin cargo. Previa inscripción, solicitando el link vía whatsApp al 2241-603414 o ingresando en el siguiente link: https://linktr.ee/visitasguiadas.turismoch</p><p>-MUESTRA FOTOGRÁFICA EN MIS OJOS, MALVINAS - DE RUBÉN DIGILIO. DE 10 a 16 hs. Casa de Casco.</p><p>-VISITA GUIADA “CAMINO DE SANTIAGO”. A las 17 horas. Actividad sin cargo. Previa inscripción, solicitando el link vía whatsApp al 2241-603414 o ingresando en el siguiente link: https://linktr.ee/visitasguiadas.turismoch</p><p>- ISLA GASTRONÓMICA “LA CASUARINA”. De 10 a 24, en Av. Costanera España y Azul.</p><p>- ISLA GASTRONÓMICA “LAS PALMERAS”. De 10 a 24 hs. Av. Costanera España y Carmen de Areco.</p><p>- PASEO DE ARTESANOS Y EMPRENDEDORES. De 10 a 22 hs. Artesanías y productos locales. Pte. Perón y Costanera España.</p><p><br></p><p><strong>-Domingo 14</strong></p><p>-MUESTRA FOTOGRÁFICA EN MIS OJOS, MALVINAS - DE RUBÉN DIGILIO. DE 10 a 16 hs. Casa de Casco.</p><p>-MUESTRA PICTÓRICA \"MUJERES\", DE SILVIA RODRÍGUEZ. De 10 a 16 horas. Centro Cultura Municipal “Vieja Estación”.</p><p>-PRIMER TRAIL RUNNING CHASCOMÚS. A las 11 horas, en la Estancia “La Alameda”.</p><p>-VISITA GUIADA \"MUSEO FERROVIARIO\". A las 11 horas. Actividad sin cargo. Previa inscripción, solicitando el link vía whatsApp al 2241-603414 o ingresando en el siguiente link: https://linktr.ee/visitasguiadas.turismoch</p><p>-VISITA GUIADA “ECO GUIA DE LAS ENCANDENADAS”. A las 17 horas. Actividad sin cargo. Previa inscripción, solicitando el link vía whatsApp al 2241-603414 o ingresando en el siguiente link: https://linktr.ee/visitasguiadas.turismoch</p><p>- ISLA GASTRONÓMICA “LA CASUARINA”. De 10 a 24 hs. en Av. Costanera España y Azul.</p><p>- ISLA GASTRONÓMICA “LAS PALMERAS”. De 10 a 24 hs. Av. Costanera España y Carmen de Areco.</p><p>- PASEO DE ARTESANOS Y EMPRENDEDORES. De 10 a 22 hs. Artesanías y productos locales. Pte. Perón y Costanera España.</p>','2024-04-16 09:22:37','2024-04-16','Chascomús','general',NULL,181,36,34,106,NULL),(12,'Este Fin de Semana','Teatro: “El amateur, segunda vuelta”','El 12 de mayo, a las 20 horas, los chascomunenses tendremos la grata oportunidad de disfrutar de una pieza teatral multipremiada como lo es \"El amateur, segunda vuelta\", de Mauricio Dayub.','<p>El Pájaro y Lopecito, sus protagonistas, logran encontrar un objetivo común y arriesgan todo lo que tienen para lograrlo. Juntos producen un milagro: que el sueño de uno se transforme en el sueño del otro. La amistad, la pasión y dar la vida sin esperar nada a cambio. Esa es la esencia de El Amateur.</p><p>Los interesados, podrán adquirir las entradas en la boletería del Teatro Municipal Brazzola, en su horario habitual de atención, de 9 a 16:30 horas y por ENTRADAWEB.COM.AR en el siguiente link: https://www.entradaweb.com.ar/evento/ec5bbe24/step/1</p>','2024-04-16 09:26:02','2024-04-16','Chascomús,teatro,fin de semana','pos1',NULL,218,36,40,106,NULL),(13,'Cambios en Seguridad','NUEVO RESPONSABLE DE LA DELEGACIÓN DE NARCOCRIMINALIDAD','El intendente Javier Gastón mantuvo una reunión con el subcomisario Emiliano Rodríguez, recientemente designado al frente de la delegación local de Narcocriminalidad de la policía de la provincia de Buenos Aires.','<p>En el encuentro también estuvieron presentes la secretaria de Seguridad Ciudadana, Mariela Moscarella, y el director de Prevención del Delito y las Violencias municipal, Marcelo Opici.</p><p>Durante la reunión, el intendente expresó la disposición de todas las áreas municipales para colaborar en cuestiones relacionadas con la prevención de los consumos problemáticos.</p>','2024-04-16 09:38:03','2024-04-16','Chascomús','general',NULL,181,36,35,106,NULL),(14,'BASSAP','UNA HERRAMIENTA PARA BRINDAR RÁPIDA RESPUESTA ANTE EMERGENCIAS','Esta aplicación, disponible para su descarga gratuita desde cualquier teléfono celular, permite enviar alertas rápidas y efectivas ante situaciones críticas.','<p>Los vecinos de Chascomús cuentan con el servicio “Basapp”, una aplicación sin cargo diseñada para enviar alertas a las autoridades en casos de emergencias médicas o de seguridad.</p><p>Este servicio es de fácil acceso y muy simple de usar: ingresando en la pantalla de inicio se encuentran especificados con un botón cada situación que requiera intervención por parte de las fuerzas de seguridad, emergencias médicas, bomberos, entre otros.</p><p>Esta herramienta, que se utiliza en ciudades de todo el mundo, ha demostrado un alto grado de efectividad, y con su uso se pudieron prevenir casos de inseguridad y de violencia de género. Además, permitió la rápida llegada a incendios y siniestros viales, lo que permite brindar mayor seguridad al ciudadano en la prevención del delito.</p><p>Cada usuario se registra con nombre, apellido y ubicación geolocalizada y, las alertas generadas a través de Basapp son recibidas en el Centro de Monitoreo Municipal, donde se asegura una rápida respuesta.</p><p>Para utilizarlo se deben seguir los siguientes pasos: desde un teléfono celular ingresar a “playstore” y descargar la aplicación Basapp. Una vez descargada, se abrirá una pantalla en la que deberán seguirse los pasos indicados.</p><p>Primero se debe elegir el municipio (Chascomús) y aceptar los términos y condiciones. Luego, se debe ingresar el número de teléfono incluyendo primero el código de país (54) y el código de área (2241). El sistema enviará al celular un código de seis números que se debe ingresar para validar la cuenta.</p><p>Una vez instalado, para emitir un alerta se debe abrir la aplicación y presionar “alerta” en el menú, allí se abrirá una pantalla con las siguientes opciones: Defensa Civil, Incendio, Llegué Bien, Emergencia de Salud, Violencia de Género y Antipánico.</p><p>Al presionar durante dos segundos sobre cualquiera de estas opciones, el Centro de Monitoreo recibe un pedido de ayuda indicando el lugar desde el que se emite el alerta.</p>','2024-04-16 10:57:10','2024-04-15','Chascomús','general',NULL,2,36,35,106,NULL),(15,'TECHO PROPIO II','NUEVA REUNIÓN CON LA COOPERATIVA','El secretario de Gobierno, Cipriano Pérez del Cerro, y la directora de Políticas del Hábitat, Natalia Castellanos, se reunieron con representantes de la Cooperativa de Viviendas “Por un Techo Propio II”.','<p>El encuentro, realizado en el palacio municipal, estuvo orientado a avanzar en la renovación del convenio que estipula los plazos y la modalidad de la ejecución de las obras de infraestructura del loteo 2, situado en la zona norte de la ciudad, junto al barrio 30 de Mayo y el que se está construyendo por el Plan PROCREAR.</p><p>Al respecto, la Cooperativa planteó trabajar en estas obras de manera escalonada en las distintas manzanas y que se vayan levantando las interdicciones para construir en forma parcial.</p><p>Por parte de los cooperativistas, asistieron Víctor Arias (presidente de la entidad), Clara Retola y Belén Tula.</p><p>Los participantes acordaron continuar dialogando con el objetivo de suscribir a la mayor brevedad posible la adenda al convenio existente, y que se envié al Concejo Deliberante para su convalidación.</p>','2024-04-16 11:53:06','2024-04-16','Chascomús','general',NULL,181,36,38,106,NULL),(16,'Visitas Guiadas','CONOCIENDO EL CASCO HISTORICO','Desde la Secretaría de Desarrollo Turístico, Productivo y Cultural se ofrecen distintos city tours para el disfrute de nuestros vecinos como así también de quienes nos visitan, que invitan a conocer los tesoros que guarda nuestra ciudad.','<p>Entre ellos, la visita guiada “Casco histórico” permite descubrir, a través de la Plaza Independencia y su entorno, momentos importantes de nuestra historia, además de la riqueza cultural y patrimonial.</p><p>“El punto de encuentro es en el Monumento al General San Martín, ubicado en la Plaza Independencia. Esta plaza - espacio de uso social de los chascomunenses – es el lugar fundacional donde nace Chascomús el 30 de mayo de 1779 con el emplazamiento del Fuerte San Juan Bautista a cargo del comandante Pedro Nicolás Escribano”, explicó la guía de turismo Alejandra Daguerre.</p><p>“Luego describimos los atractivos turísticos y que giran en derredor de la Plaza Independencia”, agregó. Se comienza por la Iglesia Catedral Virgen de la Merced, cuya piedra fundacional es de 1832; “seguimos en sentido de las agujas del reloj, por la Casa de Vicente Casco, cuya construcción data de 1831; Club de Pelota, erigido en 1925 por la corriente migratoria vasca para practicar su deporte preferido la Pelota Vasca; el Teatro Municipal Brazzola, fundado en 1927 por la colonia italiana en su necesidad de manifestar las artes y la cultura; el Palacio Municipal de 1941 construido por el constructor italiano Francisco Salamone; la casa del Dr. Alfonsín, última propiedad de la familia Alfonsín donada por el Municipio siendo el Dr. Alfonsín presidente de la República, actualmente es propiedad privada y no se permite el ingreso; y el edificio del Banco Nación, de 1908 y de estilo francés” enumeró Daguerre.</p>','2024-04-16 11:55:45','2024-04-16','Chascomús','general',NULL,81,36,40,106,NULL),(17,'Pasó en la Ciudad','RECREO PASÓ POR CHASCOMÚS EL FIN DE SEMANA','Turismo de la Provincia visitó Chascomús, el último fin de semana, con ReCreo ofreciendo distintas actividades recreativas no sólo para los chascomunenses sino también para quienes nos eligen como destino turístico.','<p>En este marco, y para disfrutar también Chascomús en Modo Verano, se realizó el viernes el torneo de fútbol playa infantil libre, en el Parque del V Centenario, donde participaron con entusiasmo niños y niñas de 10 a 12 años, agrupados en equipos de 4.</p><p>En tanto en la jornada del día sábado, la actividad continuó con el torneo de beachvoley “4 Ciudades”, del cual tomaron parte un equipo femenino representando a Pila y otro a Ranchos, y Chascomús y Lezama presentaron 2 equipos femeninos cada ciudad. Por otra parte, en cuanto a los equipos masculinos, participaron 2 por cada ciudad.</p><p>La actividad, que comenzó a las 17 horas y se extendió hasta las 24 horas, se vivió en un clima festivo y de camaradería, arrojando los siguientes resultados: 1er puesto para los representantes de Ranchos, Nicolás Rey y Bernardo Peralta; 2do puesto Gastón Martínez y Bruno Casala (Ranchos) y el 3er puesto para Matías Ferreyra y Joaquín Palaoro (Pila).</p><p>En cuanto al podio femenino, el mismo quedó liderado también por las representantes de Ranchos, Julieta Ezeiza y Luna Wooley; 2do puesto Guadalupe Daddona y Francesca Brenna (Ranchos) y 3er puesto para Lucía Macías y Florencia Saldías.</p><p>A su vez, desde la dirección de Turismo se ofrecieron dos visitas guiadas gratuitas en combi, haciendo el city tour “Raúl de Chascomús” y del camino de circunvalación.</p><p>Por otra parte, durante la jornada del domingo, el stand de Recreo se trasladó al Parque Libres del Sur, donde se realizó el concierto inaugural de la 8va. edición del Festival SOIJAr, ofreciendo a los que se acercaron juegos, talleres y otras actividades recreativas.</p>','2024-04-16 13:22:06','2024-02-07','Chascomús','pos1',NULL,181,36,32,106,NULL),(18,'Actividad Gratuita','CHARLA INFORMATIVA SOBRE TÉCNICA MINDFULNESS','Se desarrollará el sábado 20 de abril, a cargo de Juan Pereyra Beltrán, de 16 a 17 horas, en el Museo Pampeano, Avda. Lastra y Muñiz. Será abierta, apta para todo público, y gratuita.','<p>Mindfulness (atención plena): autoentrenamiento del cuerpo y la mente, a través de ejercicios físicos y de meditación que nos acercan a un afinamiento de la conciencia, para promover y mantener así la salud general, y conectar con nuestra esencia.</p><p>Mindfulness es la capacidad que tenemos todos de estar en el momento presente de una manera equilibrada, con una actitud de aceptación y apertura. Esta habilidad nos ayuda a gestionar mejor nuestras emociones, a sentirnos más relajados, y conocer cómo funciona nuestra mente.</p><p>Por otra parte, cabe aclarar que el taller sobre técnica Mindfulness dará inicio en el mes de mayo.</p>','2024-04-16 13:43:01','2024-01-16','Chascomús','pos1',NULL,181,36,32,106,NULL),(19,'Para reír y emocionarse','EGOCÉNTRICOS','El sábado 27 de abril, se presentará en el Brazzola una comedia teatral, protagonizada por Melisa Granados y Gonzalo Giles, que promete llevar al público a un viaje de risas y entretenimiento sin igual.','<p>Desde las 21 horas, se tendrá oportunidad de disfrutar de dos grandes artistas, quienes interpretarán a personajes únicos que cautivarán al público desde el primer momento, a través de su química escénica y su innegable talento. Las entradas pueden adquirirse en la boletería del Teatro Municipal Brazzola, con un valor de 3500 pesos.</p><p>A través del Programa “Puentes Culturales” del Instituto Cultural de la Provincia de Buenos Aires, se realizará esta nueva presentación, que tiene por objetivo garantizar la accesibilidad de personas con discapacidad a la cultura, y promover su participación como protagonistas de la agenda cultural bonaerense, conjuntamente con la Jefatura Distrital de Educación Chascomús y la Secretaria de Desarrollo Turístico, Deportivo y Cultural de la Municipalidad de Chascomús.</p><p>“Puentes Culturales” es impulsado por la Dirección Provincial de Coordinación de Políticas Culturales a través de la Dirección de Programación Cultural e Integración Regional.</p><p>El eje del programa es el derecho con perspectiva de discapacidad y accesibilidad. Es reconocer a las personas con discapacidad como parte de la identidad y cultura bonaerense y marcar un rumbo en la accesibilidad de todas las personas a la cultura, cómo protagonistas del arte y como público; y en este marco se trabajó ello con las autoridades educativas y de la Dirección de Cultura local.</p><p>“Buscamos construir políticas públicas que fortalezcan nuestra cultura en perspectiva de derechos y diversidad. Quiero agradecer a la Municipalidad de Chascomús por la posibilidad de construir y acompañar. También, a la Jefa Distrital Julia Ugarte, a la docente Florencia Giles. por unirse a esta actividad”, manifestó la Directora de Programación Cultural e Integración Territorial del ICPBA, Cristina Otondo.</p>','2024-04-17 08:49:56','2024-04-17','Chascomús','general',NULL,181,36,34,106,NULL),(20,'Acción benéfica','IMPORTANTE DONACIÓN DE ALIMENTOS','Los productos, destinados a comedores barriales, fueron recaudados durante un recital benéfico realizado en el Teatro Municipal Brazzola.','<p>Gran cantidad de vecinos acercaron alimentos no perecederos el pasado viernes al tributo a Fito Páez realizado por el “Chino” Bobadilla y los hermanos Nápoli.</p><p>La donación fue recibida por la secretaria de Desarrollo Social y Educación, Yanina Gazzaniga, quien agradeció el aporte solidario de los artistas.</p><p>Tras el recital fueron recaudados más de 100 paquetes de fideos, además de polenta, arroz y legumbres, entre otros productos.</p><p>La mercadería, a la que se sumaron packs de leche y de harina aportados por el área municipal, fue distribuida en los comedores barriales La Vaca Lola (barrio 39 Viviendas), Poco a Poco (Iporá), Los Chicos (San Cayetano), Los Nenes (San Luis) y Corazones Felices (Gallo Blanco).</p>','2024-04-17 10:26:16','2024-04-13','Chascomús','pos1',NULL,181,36,32,106,NULL),(21,'PUNTO DIGITAL','CURSOS GRATUITOS Y AUTO ASISTIDOS','El punto digital es un espacio público de inclusión digital, ubicado en el CIC \"Dr. Quintín\" en el Bulevar 5 y calle 2 del barrio 30 de Mayo.','<p>En este espacio, a través de la plataforma Mi Argentina, vecinos y vecinas podrán acceder a los siguientes cursos: Habilidades Laborales, Inclusión Digital, Ciudadanía y Derecho. También se dictan otros cursos de capacitación técnica y profesional, talleres y actividades temáticas.</p><p>Para inscribirse, los interesados deberán concurrir al lugar, de lunes a viernes, de 8 a 16 hs. o enviar un correo electrónico a chascomus@puntodigital.gob.ar. Es importante destacar que no se requieren conocimientos previos para participar de los talleres, solo ganas de aprender y aprovechar las ventajas que ofrecen las nuevas tecnologías.</p><p>Los Puntos Digitales buscan brindar conectividad libre y gratuita a todos los vecinos, promoviendo la igualdad de condiciones en el acceso a las nuevas Tecnologías de la Información y de las Comunicaciones, permitiendo a las personas adquirir habilidades digitales que les serán útiles en su vida cotidiana y laboral. Asimismo, se pueden realizar todo tipo de trámites que necesiten conectividad y cuentan con un espacio de aprendizaje, de cine y de entretenimiento.</p><p>En esta ocasión, los talleres de alfabetización digital e informática inicial serán una excelente oportunidad para aquellos que deseen aprender o mejorar sus conocimientos en el uso de computadoras, internet y programas básicos.</p><p>Además, los vecinos, niños, jóvenes y adultos pueden participar de la proyección de películas y documentales, navegar libremente y, asimismo, se ofrecen distintas actividades de entretenimiento digital para todas las edades.</p>','2024-04-17 10:30:00','2024-04-14','Chascomús','pos1',NULL,181,36,36,106,NULL),(22,'nota de upmd','nota de upmd','nota de upmd','<p>nota de upmd</p>','2024-06-05 07:52:37','2024-06-05','Chascomús','general',NULL,0,33,32,106,NULL),(23,'Nam id et sunt dolor aliquid aut laboriosam obca','Delectus adipisci accusamus quia consequatur ipsum eligendi ea velit ullam in occaecat ipsam neque laudantium minim velit veniam reicie','Nisi blanditiis cumque tenetur non quia magna voluptas quos aut vel odit nostrum sunt soluta','Aut ut dolor maxime','2024-06-12 13:05:11','1974-05-20','Chascomús,Soluta nisi quia in','pos1',NULL,0,6,1,106,'2024-06-12 19:10:03'),(24,'// Verificar la validez del token (implementa tu l','// Verificar la validez del token (implementa tu lógica de validación aquí)','// Verificar la validez del token (implementa tu lógica de validación aquí)','<p>// Verificar la validez del token (implementa tu lógica de validación aquí)\r\n</p><p><br></p>','2024-08-07 08:59:31','2024-08-07','Chascomús','general',NULL,0,0,32,106,NULL);
/*!40000 ALTER TABLE `dig_notas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dig_notas_relacionadas`
--

DROP TABLE IF EXISTS `dig_notas_relacionadas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dig_notas_relacionadas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fkNota` int NOT NULL,
  `fkNotaRelacionada` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dig_notas_relacionadas_dig_notas_relacionadas_FK` (`fkNotaRelacionada`),
  CONSTRAINT `dig_notas_relacionadas_dig_notas_relacionadas_FK` FOREIGN KEY (`fkNotaRelacionada`) REFERENCES `dig_notas_relacionadas` (`id`),
  CONSTRAINT `dig_notas_relacionadas_digital_notas_FK` FOREIGN KEY (`id`) REFERENCES `dig_notas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dig_notas_relacionadas`
--

LOCK TABLES `dig_notas_relacionadas` WRITE;
/*!40000 ALTER TABLE `dig_notas_relacionadas` DISABLE KEYS */;
/*!40000 ALTER TABLE `dig_notas_relacionadas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dig_parametros`
--

DROP TABLE IF EXISTS `dig_parametros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dig_parametros` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `tipo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'Es el tipo de dato esperado',
  `nivel` varchar(100) DEFAULT NULL COMMENT 'Es quien puede administrar este dato: sistema, admin, usuario',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dig_parametros`
--

LOCK TABLES `dig_parametros` WRITE;
/*!40000 ALTER TABLE `dig_parametros` DISABLE KEYS */;
INSERT INTO `dig_parametros` VALUES (1,'PARAM_URL','Url del sitio del Cliente','URL','SISTEMA'),(2,'PARAM_WEB_PUSH','Habilita el envio de mensajes web push','CHECKBOX','SISTEMA'),(3,'GA_MEASUREMENT_ID','ID de Google Analitycs','TEXT','SISTEMA'),(4,'PARAM_METEORED_LOCALIDAD_ID','Meteored - Id de localidad de Meteored','NUMBER','SISTEMA'),(5,'PARAM_METEORED_AFFILIATE_ID','Meteored - Id de afiliado de Meteored','TEXT','SISTEMA');
/*!40000 ALTER TABLE `dig_parametros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dig_parametros_valor`
--

DROP TABLE IF EXISTS `dig_parametros_valor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dig_parametros_valor` (
  `id` int NOT NULL AUTO_INCREMENT,
  `fkParametro` int NOT NULL,
  `valor` varchar(200) NOT NULL,
  `fkCliente` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_uniq_cliente_parametro` (`fkParametro`,`fkCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=347 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dig_parametros_valor`
--

LOCK TABLES `dig_parametros_valor` WRITE;
/*!40000 ALTER TABLE `dig_parametros_valor` DISABLE KEYS */;
INSERT INTO `dig_parametros_valor` VALUES (1,3,'XXXX11',1),(2,5,'XXXX21',1),(3,4,'10001',1),(4,1,'http://digital.com.ar1',1),(5,2,'on',1),(6,3,'Irure sunt quis com',2),(7,5,'Incididunt voluptas ',2),(8,4,'1',2),(9,1,'https://www.nabukazad.mobi',2),(10,3,'Voluptates omnis ten',3),(11,5,'Eum occaecat beatae ',3),(12,4,'3',3),(13,1,'https://www.kejes.cc',3),(14,2,'on',3),(247,3,'Excepturi itaque per',6),(248,5,'Qui nulla cupiditate',6),(249,4,'45',6),(250,1,'https://www.wozagycax.cc',6),(251,2,'on',6),(257,3,'Voluptatem dolore d',7),(258,5,'Totam explicabo Sin',7),(259,4,'85',7),(260,1,'https://www.kumuki.cm',7);
/*!40000 ALTER TABLE `dig_parametros_valor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dig_secciones`
--

DROP TABLE IF EXISTS `dig_secciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dig_secciones` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `activa` int DEFAULT NULL,
  `descripcion` varchar(100) NOT NULL,
  `fkSeccionPadre` int DEFAULT NULL,
  `fkCliente` int NOT NULL,
  `borrable` int DEFAULT NULL,
  `borrado` datetime DEFAULT NULL,
  `orden` int DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dig_secciones_dig_secciones_FK` (`fkSeccionPadre`),
  KEY `dig_secciones_dig_cliente_FK` (`fkCliente`),
  CONSTRAINT `dig_secciones_dig_cliente_FK` FOREIGN KEY (`fkCliente`) REFERENCES `dig_clientes` (`id`),
  CONSTRAINT `dig_secciones_dig_secciones_FK` FOREIGN KEY (`fkSeccionPadre`) REFERENCES `dig_secciones` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dig_secciones`
--

LOCK TABLES `dig_secciones` WRITE;
/*!40000 ALTER TABLE `dig_secciones` DISABLE KEYS */;
INSERT INTO `dig_secciones` VALUES (1,'Agenda',1,'Información de Agenda',NULL,1,0,NULL,3,'agenda'),(2,'Contacto',0,'Información de Contacto',NULL,1,0,NULL,4,'contacto'),(3,'Gobierno',1,'Información General',NULL,1,1,NULL,2,'gobierno'),(4,'Institucional',1,'Información importante para la comunidad.',NULL,1,1,NULL,1,'institucional'),(32,'upmd - Seccion1',1,'upmd - Seccion1',NULL,106,1,NULL,NULL,'seccion1'),(33,'upmd - Seccion2',1,'upmd - Seccion2',NULL,106,1,NULL,NULL,'seccion2'),(34,'Salud',1,'Información de Salud',4,1,1,NULL,1,'salud'),(35,'Seguridad',1,'Información de Seguridad',4,1,1,NULL,2,'seguridad'),(36,'Desarrollo Social',1,'Información de Desarrollo Social',4,1,1,NULL,3,'desarrollo-social'),(37,'Ambiente',1,'Información de Ambiente',4,1,1,NULL,4,'ambiente'),(38,'Obras y Servicios',1,'Información de Obras y Servicios',4,1,1,NULL,5,'obras-y-servicios'),(39,'Deportes',1,'Información de Deportes',4,1,1,NULL,6,'deportes'),(40,'Cultura',1,'Información de Cultura',4,1,1,NULL,7,'cultura'),(41,'Turismo',1,'Información de Turismo',4,1,1,NULL,8,'turismo'),(42,'Producción',1,'Información de Producción',4,1,1,NULL,9,'produccion'),(43,'Hacienda',1,'Información de Hacienda',4,1,1,NULL,10,'hacienda');
/*!40000 ALTER TABLE `dig_secciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dig_usuario_cliente`
--

DROP TABLE IF EXISTS `dig_usuario_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dig_usuario_cliente` (
  `fkCliente` bigint NOT NULL,
  `fkUsuario` bigint NOT NULL,
  UNIQUE KEY `dig_usuario_cliente_fk_cliente_IDX` (`fkCliente`,`fkUsuario`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dig_usuario_cliente`
--

LOCK TABLES `dig_usuario_cliente` WRITE;
/*!40000 ALTER TABLE `dig_usuario_cliente` DISABLE KEYS */;
INSERT INTO `dig_usuario_cliente` VALUES (1,2),(1,117),(1,118),(1,120),(106,106),(106,116),(106,119);
/*!40000 ALTER TABLE `dig_usuario_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fwk_permiso`
--

DROP TABLE IF EXISTS `fwk_permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fwk_permiso` (
  `id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nombre` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `controlador` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `metodo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `activo` int DEFAULT NULL,
  `general` int NOT NULL DEFAULT '0',
  `fkPermiso` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `label` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `icon` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `visualizaEnMenu` int DEFAULT NULL,
  `orden` int DEFAULT NULL,
  UNIQUE KEY `fwk_permisos_unique` (`id`),
  UNIQUE KEY `fwk_permiso_id_IDX` (`id`) USING BTREE,
  KEY `fwk_permisos_fwk_permisos_FK` (`fkPermiso`) USING BTREE,
  CONSTRAINT `fwk_permiso_fwk_permiso_FK` FOREIGN KEY (`id`) REFERENCES `fwk_permiso` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fwk_permiso`
--

LOCK TABLES `fwk_permiso` WRITE;
/*!40000 ALTER TABLE `fwk_permiso` DISABLE KEYS */;
INSERT INTO `fwk_permiso` VALUES ('AGENDA','Adminsitrar Agenda','Adminsitrar Agenda','agenda','',1,0,'','Agenda','zmdi zmdi-calendar',1,5),('AGENDA_CREAR','Crear una fecha de Agenda','Crear una fecha de Agenda','agenda','crear',1,0,'AGENDA','Crear',NULL,0,NULL),('AGENDA_ELIMINAR','Permite eliminar un item de la agenda','Permite eliminar un item de la agenda','agenda','eliminar',1,0,'AGENDA','Eliminar',NULL,0,NULL),('AGENDA_LISTAR','Listar toda la agenda','Lista todos los eventos de la Agenda','agenda','listar',1,0,'AGENDA','Listar',NULL,1,NULL),('AGENDA_MODIFICAR','Permite modificar un item de la agenda','Permite modificar un item de la agenda','agenda','editar',1,0,'AGENDA','Editar',NULL,0,NULL),('AJAX_LOGIN','Login de Usuario','Permite realizar el login a los usuarios','login','validar',1,1,NULL,NULL,NULL,0,NULL),('CLIENTE','Administración de Clientes','Permite la administración de los clientes del sistema','cliente',NULL,1,0,NULL,'Clientes','zmdi zmdi-case',1,2),('CLIENTE_CREAR','Permite Crear un nuevo Cliente','Permite Crear un nuevo Cliente','cliente','crear',1,0,'CLIENTE','Crear',NULL,0,NULL),('CLIENTE_ELIMINAR','Permite eliminar un cliente del sistema','Permite eliminar un cliente del sistema','cliente','eliminar',1,0,'CLIENTE','Eliminar',NULL,0,NULL),('CLIENTE_LISTAR','Muestra el Listado de Clientes','Muestra el listado de clientes','cliente','listar',1,0,'CLIENTE','Listar','',1,1),('CLIENTE_MODIFICAR','Permite Modificar los datos de un cliente','Permite Modificar los datos de un cliente','cliente','editar',1,0,'CLIENTE','Editar',NULL,0,NULL),('CLIENTE_STATS','Muestra estadísticas de Clientes','Muestra estadísticas de Clientes','cliente','stats',1,0,'CLIENTE','Estadísticas',NULL,1,2),('DASHBOARD_PPAL','Dashboard Principal','Dashboard al que ingresan todos los usuarios luego de logearse','dashboard','principal',1,1,NULL,'Dashboard','zmdi zmdi-home',1,1),('LOGS_FILE','Logs File','Logs File','logs','file',1,0,NULL,'Logs File','zmdi zmdi-card-alert',1,99999),('NOTAS','Permite administrar las notas del sitio','Permite administrar las notas del sitio','nota',NULL,1,0,NULL,'Notas','zmdi zmdi-file',1,4),('NOTAS_CREAR','Permite la creacion de Notas','Permite la creacion de Notas','nota','crear',1,0,'NOTAS','Crear',NULL,0,NULL),('NOTAS_ELIMINAR','Permite Eliminar Notas','Permite Eliminar Notas','nota','eliminar',1,0,'NOTAS','Eliminar',NULL,0,NULL),('NOTAS_LISTAR','Muestra el listado de las notas','Muestra el listado de las notas','nota','listar',1,0,'NOTAS','Listar',NULL,1,1),('NOTAS_MODIFICAR','Permite la edicion de las notas','Permite la edicion de las notas','nota','editar',1,0,'NOTAS','Editar',NULL,0,NULL),('NOTAS_STATS','Estadisticas de notas','Estadisticas de notas','nota','stats',1,0,'NOTAS','Estadisticas',NULL,1,NULL),('USUARIO','Administracion de Usuarios','Permite la adminsitracion de usuarios','usuario',NULL,1,0,NULL,'Usuarios','zmdi zmdi-account',1,3),('USUARIO_CREAR','Permite crear un usuario','Permite crear un usuario','usuario','crear',1,0,'USUARIO',NULL,NULL,NULL,NULL),('USUARIO_ELIMINAR','Permite eliminar un usuario','Permite eliminar un usuario','usuario','eliminar',1,0,'USUARIO',NULL,NULL,NULL,NULL),('USUARIO_LISTAR','Lista los usuarios del sistema','Lista los usuarios del sistema','usuario','listar',1,0,'USUARIO','Listar',NULL,1,NULL),('USUARIO_MODIFICAR','Permite Modificar los datos de un usuario','Permite Modificar los datos de un usuario','usuario','editar',1,0,'USUARIO',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `fwk_permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fwk_rol`
--

DROP TABLE IF EXISTS `fwk_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fwk_rol` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `creadoPor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `modificadoPor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fechaEliminacion` datetime DEFAULT NULL,
  `eliminadoPor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fwk_rol_nombre_IDX` (`nombre`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Roles del sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fwk_rol`
--

LOCK TABLES `fwk_rol` WRITE;
/*!40000 ALTER TABLE `fwk_rol` DISABLE KEYS */;
INSERT INTO `fwk_rol` VALUES (1,'ROOT','Root','Administrador Uppermind','2024-03-09 14:00:00',NULL,'Uppermind',NULL,NULL,NULL),(2,'ADMIN','Administrador de Cliente','Administrador de Cliente','2024-03-09 14:00:00',NULL,'Uppermind',NULL,NULL,NULL),(3,'ESCRITOR','Usuario Escritor','Usuario Escritor','2024-03-09 14:00:00',NULL,'Uppermind',NULL,NULL,NULL),(4,'EDITOR','Usuario Editor','Usuario Editor','2024-03-09 14:00:00',NULL,'Uppermind',NULL,NULL,NULL);
/*!40000 ALTER TABLE `fwk_rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fwk_rol_permiso`
--

DROP TABLE IF EXISTS `fwk_rol_permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fwk_rol_permiso` (
  `fkRol` bigint NOT NULL,
  `fkPermiso` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  KEY `dfwk_rol_permisos_rol_FK` (`fkRol`) USING BTREE,
  KEY `fwk_rol_permisos_fwk_rol_permisos_FK` (`fkPermiso`) USING BTREE,
  CONSTRAINT `fwk_rol_permiso_fwk_permiso_FK` FOREIGN KEY (`fkPermiso`) REFERENCES `fwk_permiso` (`id`),
  CONSTRAINT `fwk_rol_permiso_fwk_rol_FK` FOREIGN KEY (`fkRol`) REFERENCES `fwk_rol` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fwk_rol_permiso`
--

LOCK TABLES `fwk_rol_permiso` WRITE;
/*!40000 ALTER TABLE `fwk_rol_permiso` DISABLE KEYS */;
INSERT INTO `fwk_rol_permiso` VALUES (2,'NOTAS'),(2,'NOTAS_CREAR'),(2,'NOTAS_LISTAR'),(2,'NOTAS_MODIFICAR'),(2,'USUARIO'),(2,'USUARIO_LISTAR'),(3,'NOTAS'),(3,'NOTAS_CREAR'),(3,'NOTAS_LISTAR'),(3,'NOTAS_MODIFICAR'),(4,'NOTAS'),(4,'NOTAS_CREAR'),(4,'NOTAS_LISTAR'),(4,'NOTAS_MODIFICAR'),(3,'NOTAS_ELIMINAR'),(4,'NOTAS_ELIMINAR'),(2,'NOTAS_STATS'),(3,'NOTAS_STATS'),(4,'NOTAS_STATS'),(2,'AGENDA'),(2,'AGENDA_LISTAR'),(2,'AGENDA_CREAR'),(2,'AGENDA_ELIMINAR'),(3,'AGENDA'),(4,'AGENDA'),(3,'AGENDA_LISTAR'),(3,'AGENDA_CREAR'),(3,'AGENDA_ELIMINAR'),(4,'AGENDA_LISTAR'),(4,'AGENDA_CREAR'),(4,'AGENDA_ELIMINAR'),(2,'AGENDA_MODIFICAR'),(3,'AGENDA_MODIFICAR'),(4,'AGENDA_MODIFICAR'),(2,'USUARIO_CREAR'),(2,'USUARIO_MODIFICAR'),(2,'USUARIO_ELIMINAR'),(2,'NOTAS_CREAR'),(2,'NOTAS_MODIFICAR'),(2,'NOTAS_ELIMINAR');
/*!40000 ALTER TABLE `fwk_rol_permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fwk_sesion`
--

DROP TABLE IF EXISTS `fwk_sesion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fwk_sesion` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `token` varchar(100) NOT NULL,
  `fkUsuario` bigint NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sesion_usuario_FK` (`fkUsuario`),
  CONSTRAINT `sesion_usuario_FK` FOREIGN KEY (`fkUsuario`) REFERENCES `fwk_usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=737 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='sesion de control de acceso unico de usuarios';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fwk_sesion`
--

LOCK TABLES `fwk_sesion` WRITE;
/*!40000 ALTER TABLE `fwk_sesion` DISABLE KEYS */;
INSERT INTO `fwk_sesion` VALUES (474,'c18ea232-f680-11ee-bc68-8f0b888813c3',119,'2024-04-09 11:52:15','2024-04-09 11:52:15'),(556,'f3f2ad8c-19ca-11ef-9e5c-64bc845f527b',117,'2024-05-24 09:41:33','2024-05-24 09:41:33'),(573,'3987b184-1f6c-11ef-9e5c-64bc845f527b',2,'2024-05-31 13:38:35','2024-05-31 13:38:35'),(584,'119084f2-28b9-11ef-aa24-63846c91932e',118,'2024-06-12 09:41:20','2024-06-12 09:41:20'),(736,'f4d8ad6d-54b9-11ef-b905-00ff1d332e54',1,'2024-08-07 09:38:32','2024-08-07 09:38:32');
/*!40000 ALTER TABLE `fwk_sesion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fwk_usuario`
--

DROP TABLE IF EXISTS `fwk_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fwk_usuario` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `apellido` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ultimoAcceso` datetime DEFAULT NULL,
  `fechaCreacion` datetime NOT NULL,
  `fechaModificacion` datetime DEFAULT NULL,
  `creadoPor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `modificadoPor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `fechaEliminacion` datetime DEFAULT NULL,
  `eliminadoPor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario_email_IDX` (`email`) USING BTREE,
  UNIQUE KEY `fwk_usuario_email_IDX` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='usuarios del sistema';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fwk_usuario`
--

LOCK TABLES `fwk_usuario` WRITE;
/*!40000 ALTER TABLE `fwk_usuario` DISABLE KEYS */;
INSERT INTO `fwk_usuario` VALUES (1,'admin','$2y$10$Q1ynvc3R2v1g1i7JvnaUu.yhjHcHWcHUTsrbFWbVzqMd/EfQeLjdG','Root','Uppermind','2024-08-07 09:38:32','2024-08-03 20:00:00',NULL,'Uppermind',NULL,NULL,NULL),(2,'digital@chascomus.gob.ar','$2y$10$G3/Ec03Rp2uTrF6YY0R4G.5/C7ActbvB.QpYJ3i/fjaNwmtw.2vom','Admin','Muni','2024-05-31 13:38:35','2024-08-03 20:00:00','2024-05-31 11:53:36','Uppermind','1',NULL,NULL),(106,'nicolas.galli@gmail.com','$2y$10$Q1ynvc3R2v1g1i7JvnaUu.yhjHcHWcHUTsrbFWbVzqMd/EfQeLjdG','Nicolas','Galli','2024-01-25 12:55:12','2024-03-22 19:12:18','2024-04-08 10:45:58','1','1',NULL,NULL),(117,'candela@chascomus.gob.ar','$2y$10$fTr1fyK1mlycoQA6zAbPzu1DNoI/dW7RPtIE8Vh2TV75A8YH7i4VO','Candela','Romo','2024-05-24 09:41:33','2024-04-08 11:10:27','2024-04-09 12:22:35','1','1',NULL,NULL),(118,'roxana@chascomus.gob.ar','$2y$10$GYfePikUaxo.6p/54ScFR.ZPhzcn6BmxXz6WuRnmbQHQP9HYzTz7C','Roxana','Zapata','2024-06-12 09:41:19','2024-04-08 11:13:50',NULL,'1',NULL,NULL,NULL),(119,'fran@uppermind.com','$2y$10$h4pGHN11KZbINvbvHbMCtet1SrvQpOW3xiOGYM9QiqVUcUuFrziji','Fran','Galli','2024-04-09 11:52:15','2024-04-08 11:17:43',NULL,'1',NULL,NULL,NULL),(120,'prueba@prueba.com','$2y$10$971rLXClt9wa4or0B0WdBeYKYDKpNcMTuVKN/ohB2A0HdANO.greu','Mati','Francisco',NULL,'2024-07-31 10:52:04','2024-07-31 10:52:43','1','1',NULL,NULL);
/*!40000 ALTER TABLE `fwk_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fwk_usuario_rol`
--

DROP TABLE IF EXISTS `fwk_usuario_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fwk_usuario_rol` (
  `fkUsuario` bigint NOT NULL,
  `fkRol` bigint NOT NULL,
  UNIQUE KEY `fwk_usuario_rol_unique` (`fkUsuario`,`fkRol`),
  KEY `usuario_rol_rol_FK` (`fkRol`),
  CONSTRAINT `usuario_rol_rol_FK` FOREIGN KEY (`fkRol`) REFERENCES `fwk_rol` (`id`),
  CONSTRAINT `usuario_rol_usuario_FK` FOREIGN KEY (`fkUsuario`) REFERENCES `fwk_usuario` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Relacion de rol con el usuario';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fwk_usuario_rol`
--

LOCK TABLES `fwk_usuario_rol` WRITE;
/*!40000 ALTER TABLE `fwk_usuario_rol` DISABLE KEYS */;
INSERT INTO `fwk_usuario_rol` VALUES (1,1),(2,2),(106,2),(118,3),(120,3),(117,4),(119,4);
/*!40000 ALTER TABLE `fwk_usuario_rol` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-07  9:40:45
