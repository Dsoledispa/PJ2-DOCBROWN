-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2021 a las 18:22:24
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_docbrown`
--
CREATE DATABASE IF NOT EXISTS `db_docbrown` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_docbrown`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_localizacion`
--

CREATE TABLE IF NOT EXISTS `tbl_localizacion` (
  `id_localizacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_localizacion` varchar(45) NOT NULL,
  PRIMARY KEY (`id_localizacion`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_localizacion`
--

INSERT INTO `tbl_localizacion` (`id_localizacion`, `nombre_localizacion`) VALUES
(1, 'Terraza'),
(2, 'Comedor'),
(3, 'Sala Privada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_mesa`
--

CREATE TABLE IF NOT EXISTS `tbl_mesa` (
  `id_mesa` int(11) NOT NULL AUTO_INCREMENT,
  `mesa` int(11) DEFAULT NULL,
  `silla` int(11) DEFAULT NULL,
  `id_localizacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mesa`),
  KEY `fk_mesa_localizacion_idx` (`id_localizacion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_mesa`
--

INSERT INTO `tbl_mesa` (`id_mesa`, `mesa`, `silla`, `id_localizacion`) VALUES
(1, 1, 2, 1),
(2, 3, 8, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reserva`
--

CREATE TABLE IF NOT EXISTS `tbl_reserva` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_localizacion` int(11) DEFAULT NULL,
  `id_mesa` int(11) DEFAULT NULL,
  `nombre_reserva` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `fk_reserva_mesa_idx` (`id_mesa`),
  KEY `fk_reserva_localizacion_idx` (`id_localizacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE IF NOT EXISTS `tbl_usuario` (
  `email` varchar(50) NOT NULL,
  `contraseña` varchar(100) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`email`, `contraseña`) VALUES
('diegosoledispa@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055'),
('xaviergomez@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_mesa`
--
ALTER TABLE `tbl_mesa`
  ADD CONSTRAINT `fk_mesa_localizacion` FOREIGN KEY (`id_localizacion`) REFERENCES `tbl_localizacion` (`id_localizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  ADD CONSTRAINT `fk_reserva_localizacion` FOREIGN KEY (`id_localizacion`) REFERENCES `tbl_localizacion` (`id_localizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_reserva_mesa` FOREIGN KEY (`id_mesa`) REFERENCES `tbl_mesa` (`id_mesa`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
