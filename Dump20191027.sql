-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: royal_academy
-- ------------------------------------------------------
-- Server version	5.7.19-log

USE royal_academy;

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
-- Table structure for table `administrador`
--

DROP TABLE IF EXISTS `administrador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `administrador` (
  `Nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `idAdministrador` int(11) NOT NULL AUTO_INCREMENT,
  `Usuario_idUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAdministrador`),
  UNIQUE KEY `UNIQ_44F9A52195440347` (`Usuario_idUsuario`),
  CONSTRAINT `FK_44F9A52195440347` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `administrador`
--

LOCK TABLES `administrador` WRITE;
/*!40000 ALTER TABLE `administrador` DISABLE KEYS */;
INSERT INTO `administrador` VALUES ('Jose','algo@mail.com',1,1);
/*!40000 ALTER TABLE `administrador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno`
--

DROP TABLE IF EXISTS `alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno` (
  `Nombre` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `DNI` bigint(20) NOT NULL,
  `Edad` int(11) NOT NULL,
  `Sexo` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `idAlumno` int(11) NOT NULL AUTO_INCREMENT,
  `Sede_idSede` int(11) DEFAULT NULL,
  `Usuario_idUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAlumno`),
  UNIQUE KEY `UNIQ_1435D52D95440347` (`Usuario_idUsuario`),
  KEY `fk_Alumno_Sede1_idx` (`Sede_idSede`),
  CONSTRAINT `FK_1435D52D19A83F38` FOREIGN KEY (`Sede_idSede`) REFERENCES `sede` (`idSede`),
  CONSTRAINT `FK_1435D52D95440347` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno`
--

LOCK TABLES `alumno` WRITE;
/*!40000 ALTER TABLE `alumno` DISABLE KEYS */;
INSERT INTO `alumno` VALUES ('Jose',1213441,39,'M','pepe@mail.com',1,1,1),('Juan',212121,30,'M','otro@mail.com',2,1,2);
/*!40000 ALTER TABLE `alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno_has_fechaexamen`
--

DROP TABLE IF EXISTS `alumno_has_fechaexamen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno_has_fechaexamen` (
  `Alumno_idAlumno` int(11) NOT NULL,
  `FechaExamen_idFechaExamen` int(11) NOT NULL,
  PRIMARY KEY (`Alumno_idAlumno`,`FechaExamen_idFechaExamen`),
  KEY `IDX_ED9B5F8A8E7ED1BD` (`Alumno_idAlumno`),
  KEY `IDX_ED9B5F8AE3AC9324` (`FechaExamen_idFechaExamen`),
  CONSTRAINT `FK_ED9B5F8A8E7ED1BD` FOREIGN KEY (`Alumno_idAlumno`) REFERENCES `alumno` (`idAlumno`),
  CONSTRAINT `FK_ED9B5F8AE3AC9324` FOREIGN KEY (`FechaExamen_idFechaExamen`) REFERENCES `fechaexamen` (`idFechaExamen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno_has_fechaexamen`
--

LOCK TABLES `alumno_has_fechaexamen` WRITE;
/*!40000 ALTER TABLE `alumno_has_fechaexamen` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumno_has_fechaexamen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumno_has_materia`
--

DROP TABLE IF EXISTS `alumno_has_materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumno_has_materia` (
  `Alumno_idAlumno` int(11) NOT NULL,
  `Materia_idMateria` int(11) NOT NULL,
  PRIMARY KEY (`Alumno_idAlumno`,`Materia_idMateria`),
  KEY `IDX_D3DC4C4F8E7ED1BD` (`Alumno_idAlumno`),
  KEY `IDX_D3DC4C4FB8365375` (`Materia_idMateria`),
  CONSTRAINT `FK_D3DC4C4F8E7ED1BD` FOREIGN KEY (`Alumno_idAlumno`) REFERENCES `alumno` (`idAlumno`),
  CONSTRAINT `FK_D3DC4C4FB8365375` FOREIGN KEY (`Materia_idMateria`) REFERENCES `materia` (`idMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumno_has_materia`
--

LOCK TABLES `alumno_has_materia` WRITE;
/*!40000 ALTER TABLE `alumno_has_materia` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumno_has_materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carrera`
--

DROP TABLE IF EXISTS `carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrera` (
  `Nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `idCarrera` int(11) NOT NULL AUTO_INCREMENT,
  `Sede_idSede` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCarrera`),
  KEY `fk_Carrera_Sede1_idx` (`Sede_idSede`),
  CONSTRAINT `FK_CF1ECD3019A83F38` FOREIGN KEY (`Sede_idSede`) REFERENCES `sede` (`idSede`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrera`
--

LOCK TABLES `carrera` WRITE;
/*!40000 ALTER TABLE `carrera` DISABLE KEYS */;
/*!40000 ALTER TABLE `carrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examen`
--

DROP TABLE IF EXISTS `examen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examen` (
  `idExamen` int(11) NOT NULL AUTO_INCREMENT,
  `FechaExamen_idFechaExamen` int(11) DEFAULT NULL,
  PRIMARY KEY (`idExamen`),
  KEY `fk_Examen_FechaExamen1_idx` (`FechaExamen_idFechaExamen`),
  CONSTRAINT `FK_514C8FECE3AC9324` FOREIGN KEY (`FechaExamen_idFechaExamen`) REFERENCES `fechaexamen` (`idFechaExamen`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examen`
--

LOCK TABLES `examen` WRITE;
/*!40000 ALTER TABLE `examen` DISABLE KEYS */;
INSERT INTO `examen` VALUES (1,1),(2,2);
/*!40000 ALTER TABLE `examen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examenrealizado`
--

DROP TABLE IF EXISTS `examenrealizado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examenrealizado` (
  `estaCompletado` tinyint(1) DEFAULT NULL,
  `nota` int(11) DEFAULT NULL,
  `informado` tinyint(1) DEFAULT NULL,
  `turno` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `fechaInicio` datetime DEFAULT NULL,
  `idExamenRealizado` int(11) NOT NULL AUTO_INCREMENT,
  `Alumno_idAlumno` int(11) DEFAULT NULL,
  `Examen_idExamen` int(11) DEFAULT NULL,
  PRIMARY KEY (`idExamenRealizado`),
  KEY `fk_ExamenRealizado_Alumno1_idx` (`Alumno_idAlumno`),
  KEY `FK_idAlumno_idx` (`Examen_idExamen`),
  CONSTRAINT `FK_E5E9DE3D8E7ED1BD` FOREIGN KEY (`Alumno_idAlumno`) REFERENCES `alumno` (`idAlumno`),
  CONSTRAINT `FK_idAlumno` FOREIGN KEY (`Examen_idExamen`) REFERENCES `examen` (`idExamen`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examenrealizado`
--

LOCK TABLES `examenrealizado` WRITE;
/*!40000 ALTER TABLE `examenrealizado` DISABLE KEYS */;
INSERT INTO `examenrealizado` VALUES (0,0,0,1,'2019-12-10','2019-12-10 00:00:00',1,1,1),(0,0,0,2,'2019-12-11','2019-12-12 00:00:00',2,1,2),(0,0,0,1,'2019-12-10','2019-12-10 00:00:00',3,2,1);
/*!40000 ALTER TABLE `examenrealizado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `examenrealizado_has_respuesta`
--

DROP TABLE IF EXISTS `examenrealizado_has_respuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examenrealizado_has_respuesta` (
  `respuesta_idrespuesta` int(11) NOT NULL,
  `ExamenRealizado_idExamenRealizado` int(11) NOT NULL,
  PRIMARY KEY (`respuesta_idrespuesta`,`ExamenRealizado_idExamenRealizado`),
  KEY `IDX_2EEF0B2A48EBC852` (`respuesta_idrespuesta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `examenrealizado_has_respuesta`
--

LOCK TABLES `examenrealizado_has_respuesta` WRITE;
/*!40000 ALTER TABLE `examenrealizado_has_respuesta` DISABLE KEYS */;
/*!40000 ALTER TABLE `examenrealizado_has_respuesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fechaexamen`
--

DROP TABLE IF EXISTS `fechaexamen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fechaexamen` (
  `CantMax` int(11) NOT NULL,
  `CantActual` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `idFechaExamen` int(11) NOT NULL,
  `Materia_idMateria` int(11) DEFAULT NULL,
  `Sede_idSede` int(11) DEFAULT NULL,
  PRIMARY KEY (`idFechaExamen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fechaexamen`
--

LOCK TABLES `fechaexamen` WRITE;
/*!40000 ALTER TABLE `fechaexamen` DISABLE KEYS */;
INSERT INTO `fechaexamen` VALUES (10,2,'2019-12-10',1,1,1),(15,3,'2019-12-11',2,2,1);
/*!40000 ALTER TABLE `fechaexamen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia`
--

DROP TABLE IF EXISTS `materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia` (
  `Nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `CantMax` int(11) NOT NULL,
  `CantActual` int(11) NOT NULL,
  `idMateria` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idMateria`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia`
--

LOCK TABLES `materia` WRITE;
/*!40000 ALTER TABLE `materia` DISABLE KEYS */;
INSERT INTO `materia` VALUES ('Informatica',100,20,1),('Ingles',100,23,2);
/*!40000 ALTER TABLE `materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `materia_has_carrera`
--

DROP TABLE IF EXISTS `materia_has_carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `materia_has_carrera` (
  `Materia_idMateria` int(11) NOT NULL,
  `Carrera_idCarrera` int(11) NOT NULL,
  PRIMARY KEY (`Materia_idMateria`,`Carrera_idCarrera`),
  KEY `IDX_821CD05B8365375` (`Materia_idMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `materia_has_carrera`
--

LOCK TABLES `materia_has_carrera` WRITE;
/*!40000 ALTER TABLE `materia_has_carrera` DISABLE KEYS */;
/*!40000 ALTER TABLE `materia_has_carrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pais`
--

DROP TABLE IF EXISTS `pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pais` (
  `Nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `idPais` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idPais`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pais`
--

LOCK TABLES `pais` WRITE;
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` VALUES ('ARGENTINA',1);
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pregunta` (
  `descripcion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idPregunta` int(11) NOT NULL AUTO_INCREMENT,
  `Examen_idExamen` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPregunta`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pregunta`
--

LOCK TABLES `pregunta` WRITE;
/*!40000 ALTER TABLE `pregunta` DISABLE KEYS */;
INSERT INTO `pregunta` VALUES ('Nombre mascota',1,1),('Nombre Equipo',2,1),('Nombre Perro',3,1),('De que color es el caballo blanco SanMartin',4,1),('Goles de pepe Sand en Lanus',5,1),('Who are you?',6,2);
/*!40000 ALTER TABLE `pregunta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `realizar_examen`
--

DROP TABLE IF EXISTS `realizar_examen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `realizar_examen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `realizar_examen`
--

LOCK TABLES `realizar_examen` WRITE;
/*!40000 ALTER TABLE `realizar_examen` DISABLE KEYS */;
/*!40000 ALTER TABLE `realizar_examen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respuesta`
--

DROP TABLE IF EXISTS `respuesta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `respuesta` (
  `idrespuesta` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `esCorrecta` tinyint(1) DEFAULT NULL,
  `Pregunta_idPregunta` int(11) DEFAULT NULL,
  PRIMARY KEY (`idrespuesta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respuesta`
--

LOCK TABLES `respuesta` WRITE;
/*!40000 ALTER TABLE `respuesta` DISABLE KEYS */;
INSERT INTO `respuesta` VALUES (1,'Gato',1,1),(2,'Mono',0,1),(3,'Lanus',1,2),(4,'Talleres',0,2),(5,'Topa',1,3),(6,'Lalo',0,3),(7,'blanco',1,4),(8,'Negro',0,4),(9,'gris topo',0,4),(10,'121',1,5),(11,'good',1,6);
/*!40000 ALTER TABLE `respuesta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rolusuario`
--

DROP TABLE IF EXISTS `rolusuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rolusuario` (
  `Rol` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `idRolUsuario` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idRolUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rolusuario`
--

LOCK TABLES `rolusuario` WRITE;
/*!40000 ALTER TABLE `rolusuario` DISABLE KEYS */;
INSERT INTO `rolusuario` VALUES ('AG',1);
/*!40000 ALTER TABLE `rolusuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sede`
--

DROP TABLE IF EXISTS `sede`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sede` (
  `Nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `idSede` int(11) NOT NULL,
  `Pais_idPais` int(11) DEFAULT NULL,
  PRIMARY KEY (`idSede`),
  UNIQUE KEY `UNIQ_2A9BE2D196FCEA96` (`Pais_idPais`),
  KEY `fk_Sede_Pais_idx` (`Pais_idPais`),
  CONSTRAINT `FK_2A9BE2D196FCEA96` FOREIGN KEY (`Pais_idPais`) REFERENCES `pais` (`idPais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sede`
--

LOCK TABLES `sede` WRITE;
/*!40000 ALTER TABLE `sede` DISABLE KEYS */;
INSERT INTO `sede` VALUES ('ARG1',1,1);
/*!40000 ALTER TABLE `sede` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `Usuario` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Contrasenia` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `RolUsuario_idRolUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `fk_Usuario_RolUsuario1_idx` (`RolUsuario_idRolUsuario`),
  CONSTRAINT `FK_2265B05DA91E6425` FOREIGN KEY (`RolUsuario_idRolUsuario`) REFERENCES `rolusuario` (`idRolUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES ('Pepe','1234',1,1),('Juan','1234',2,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'royal_academy'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_get_ultima_pregunta_examen_realizado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_get_ultima_pregunta_examen_realizado`(IN _idExamenEnCurso int, OUT _ultima int)
BEGIN
	SELECT MAX(idPregunta) into _ultima FROM `royal_academy`.pregunta 
	inner join respuesta on pregunta.idPregunta=respuesta.Pregunta_idPregunta
	inner join examenrealizado_has_respuesta on respuesta.idrespuesta = examenrealizado_has_respuesta.respuesta_idrespuesta
	where examenrealizado_has_respuesta.ExamenRealizado_idExamenRealizado=1
	order by pregunta.idPregunta;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_guardar_respuestas_realizadas` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_guardar_respuestas_realizadas`(IN p_idex INT,
  IN p_rta INT)
BEGIN
	 insert into examenrealizado_has_respuesta(respuesta_idrespuesta, ExamenRealizado_idExamenRealizado) values (p_idex, p_rta);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-27 23:38:12
