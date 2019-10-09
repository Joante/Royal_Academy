CREATE DATABASE  IF NOT EXISTS `royal_academy1.1` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `royal_academy1.1`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: royal_academy1.1
-- ------------------------------------------------------
-- Server version	5.7.21-log

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
  KEY `fk_Administrador_Usuario1_idx` (`Usuario_idUsuario`),
  CONSTRAINT `FK_44F9A52195440347` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `idAlumno` int(11) NOT NULL,
  `Sede_idSede` int(11) DEFAULT NULL,
  `Usuario_idUsuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAlumno`),
  UNIQUE KEY `UNIQ_1435D52D95440347` (`Usuario_idUsuario`),
  KEY `fk_Alumno_Sede1_idx` (`Sede_idSede`),
  KEY `fk_Alumno_Usuario1_idx` (`Usuario_idUsuario`),
  CONSTRAINT `FK_1435D52D19A83F38` FOREIGN KEY (`Sede_idSede`) REFERENCES `sede` (`idSede`),
  CONSTRAINT `FK_1435D52D95440347` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
-- Table structure for table `carrera`
--

DROP TABLE IF EXISTS `carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carrera` (
  `Nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `idCarrera` int(11) NOT NULL,
  `Sede_idSede` int(11) DEFAULT NULL,
  PRIMARY KEY (`idCarrera`),
  KEY `fk_Carrera_Sede1_idx` (`Sede_idSede`),
  CONSTRAINT `FK_CF1ECD3019A83F38` FOREIGN KEY (`Sede_idSede`) REFERENCES `sede` (`idSede`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `examen`
--

DROP TABLE IF EXISTS `examen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `examen` (
  `idExamen` int(11) NOT NULL,
  `FechaExamen_idFechaExamen` int(11) DEFAULT NULL,
  PRIMARY KEY (`idExamen`),
  KEY `fk_Examen_FechaExamen1_idx` (`FechaExamen_idFechaExamen`),
  CONSTRAINT `FK_514C8FECE3AC9324` FOREIGN KEY (`FechaExamen_idFechaExamen`) REFERENCES `fechaexamen` (`idFechaExamen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `idExamenRealizado` int(11) NOT NULL,
  `Alumno_idAlumno` int(11) DEFAULT NULL,
  PRIMARY KEY (`idExamenRealizado`),
  KEY `fk_ExamenRealizado_Alumno1_idx` (`Alumno_idAlumno`),
  CONSTRAINT `FK_E5E9DE3D8E7ED1BD` FOREIGN KEY (`Alumno_idAlumno`) REFERENCES `alumno` (`idAlumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  KEY `IDX_2EEF0B2A48EBC852` (`respuesta_idrespuesta`),
  KEY `IDX_2EEF0B2AA061E2AC` (`ExamenRealizado_idExamenRealizado`),
  CONSTRAINT `FK_2EEF0B2A48EBC852` FOREIGN KEY (`respuesta_idrespuesta`) REFERENCES `respuesta` (`idrespuesta`),
  CONSTRAINT `FK_2EEF0B2AA061E2AC` FOREIGN KEY (`ExamenRealizado_idExamenRealizado`) REFERENCES `examenrealizado` (`idExamenRealizado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  PRIMARY KEY (`idFechaExamen`),
  UNIQUE KEY `UNIQ_4F874DD2B8365375` (`Materia_idMateria`),
  UNIQUE KEY `UNIQ_4F874DD219A83F38` (`Sede_idSede`),
  KEY `fk_FechaExamen_Sede1_idx` (`Sede_idSede`),
  KEY `fk_FechaExamen_Materia1_idx` (`Materia_idMateria`),
  CONSTRAINT `FK_4F874DD219A83F38` FOREIGN KEY (`Sede_idSede`) REFERENCES `sede` (`idSede`),
  CONSTRAINT `FK_4F874DD2B8365375` FOREIGN KEY (`Materia_idMateria`) REFERENCES `materia` (`idMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  KEY `IDX_821CD05B8365375` (`Materia_idMateria`),
  KEY `IDX_821CD05CE879F79` (`Carrera_idCarrera`),
  CONSTRAINT `FK_821CD05B8365375` FOREIGN KEY (`Materia_idMateria`) REFERENCES `materia` (`idMateria`),
  CONSTRAINT `FK_821CD05CE879F79` FOREIGN KEY (`Carrera_idCarrera`) REFERENCES `carrera` (`idCarrera`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pregunta` (
  `descripcion` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idPregunta` int(11) NOT NULL,
  `Examen_idExamen` int(11) DEFAULT NULL,
  PRIMARY KEY (`idPregunta`),
  UNIQUE KEY `UNIQ_AEE0E1F786387D5E` (`Examen_idExamen`),
  KEY `fk_Pregunta_Examen1_idx` (`Examen_idExamen`),
  CONSTRAINT `FK_AEE0E1F786387D5E` FOREIGN KEY (`Examen_idExamen`) REFERENCES `examen` (`idExamen`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  PRIMARY KEY (`idrespuesta`),
  UNIQUE KEY `UNIQ_6C6EC5EE45A52D35` (`Pregunta_idPregunta`),
  KEY `fk_respuesta_Pregunta1_idx` (`Pregunta_idPregunta`),
  CONSTRAINT `FK_6C6EC5EE45A52D35` FOREIGN KEY (`Pregunta_idPregunta`) REFERENCES `pregunta` (`idPregunta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

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
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-10-09  1:20:52
