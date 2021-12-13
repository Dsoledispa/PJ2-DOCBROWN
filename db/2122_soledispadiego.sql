CREATE DATABASE  IF NOT EXISTS `2122_soledispadiego` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `2122_soledispadiego`;
-- MySQL dump 10.13  Distrib 8.0.26, for Win64 (x86_64)
--
-- Host: localhost    Database: 2122_soledispadiego
-- ------------------------------------------------------
-- Server version	8.0.26

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
-- Table structure for table `tbl_localizacion`
--

DROP TABLE IF EXISTS `tbl_localizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_localizacion` (
  `id_l` int NOT NULL AUTO_INCREMENT,
  `nombre_l` varchar(45) DEFAULT NULL,
  `descripcion_l` varchar(100) DEFAULT NULL,
  `img_l` varchar(100) DEFAULT NULL,
  `disponibilidad_l` enum('si','no') DEFAULT NULL,
  PRIMARY KEY (`id_l`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_localizacion`
--

LOCK TABLES `tbl_localizacion` WRITE;
/*!40000 ALTER TABLE `tbl_localizacion` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_localizacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mesa`
--

DROP TABLE IF EXISTS `tbl_mesa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_mesa` (
  `id_m` int NOT NULL AUTO_INCREMENT,
  `silla_m` int DEFAULT NULL,
  `disponibilidad_m` enum('si','no') DEFAULT NULL,
  `id_l` int DEFAULT NULL,
  PRIMARY KEY (`id_m`),
  KEY `fk_tbl_mesa_tbl_localizacion_idx` (`id_l`),
  CONSTRAINT `fk_tbl_mesa_tbl_localizacion` FOREIGN KEY (`id_l`) REFERENCES `tbl_localizacion` (`id_l`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mesa`
--

LOCK TABLES `tbl_mesa` WRITE;
/*!40000 ALTER TABLE `tbl_mesa` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_mesa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_mesa/reserva`
--

DROP TABLE IF EXISTS `tbl_mesa/reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_mesa/reserva` (
  `id_mesa/reserva` int NOT NULL AUTO_INCREMENT,
  `id_m` int DEFAULT NULL,
  `id_r` int DEFAULT NULL,
  PRIMARY KEY (`id_mesa/reserva`),
  KEY `fk_tbl_mesa/reserva_tbl_mesa_idx` (`id_m`),
  KEY `fk_tbl_mesa/reserva_tbl_reserva_idx` (`id_r`),
  CONSTRAINT `fk_tbl_mesa/reserva_tbl_mesa` FOREIGN KEY (`id_m`) REFERENCES `tbl_mesa` (`id_m`),
  CONSTRAINT `fk_tbl_mesa/reserva_tbl_reserva` FOREIGN KEY (`id_r`) REFERENCES `tbl_reserva` (`id_r`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_mesa/reserva`
--

LOCK TABLES `tbl_mesa/reserva` WRITE;
/*!40000 ALTER TABLE `tbl_mesa/reserva` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_mesa/reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_reserva`
--

DROP TABLE IF EXISTS `tbl_reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_reserva` (
  `id_r` int NOT NULL AUTO_INCREMENT,
  `nombre_r` varchar(45) DEFAULT NULL,
  `apellido_r` varchar(45) DEFAULT NULL,
  `telefono_r` int DEFAULT NULL,
  `fecha_r` date DEFAULT NULL,
  `num_personas_r` int DEFAULT NULL,
  `hora_inicio_r` time DEFAULT NULL,
  `hora_final_r` time DEFAULT NULL,
  `id_u` int DEFAULT NULL,
  PRIMARY KEY (`id_r`),
  KEY `fk_tbl_reserva_tbl_usuario_idx` (`id_u`),
  CONSTRAINT `fk_tbl_reserva_tbl_usuario` FOREIGN KEY (`id_u`) REFERENCES `tbl_usuario` (`id_u`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_reserva`
--

LOCK TABLES `tbl_reserva` WRITE;
/*!40000 ALTER TABLE `tbl_reserva` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_usuario`
--

DROP TABLE IF EXISTS `tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_usuario` (
  `id_u` int NOT NULL AUTO_INCREMENT,
  `nombre_u` varchar(45) DEFAULT NULL,
  `apellido_u` varchar(45) DEFAULT NULL,
  `correo_u` varchar(100) DEFAULT NULL,
  `contraseña_u` varchar(45) DEFAULT NULL,
  `tipo_u` enum('camarero','administrador') DEFAULT NULL,
  `disponibilidad_u` enum('si','no') DEFAULT NULL,
  PRIMARY KEY (`id_u`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_usuario`
--

LOCK TABLES `tbl_usuario` WRITE;
/*!40000 ALTER TABLE `tbl_usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-09 19:56:13
