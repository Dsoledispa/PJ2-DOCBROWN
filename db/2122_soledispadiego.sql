-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 20-12-2021 a las 19:40:16
-- Versión del servidor: 10.5.12-MariaDB
-- Versión de PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id18155242_2122_soledispadiego`
--
CREATE DATABASE IF NOT EXISTS `id18155242_2122_soledispadiego` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `id18155242_2122_soledispadiego`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_mesa`
--

CREATE TABLE `tbl_mesa` (
  `id_m` int(11) NOT NULL,
  `silla_m` int(11) DEFAULT NULL,
  `disponibilidad_m` enum('si','no') DEFAULT NULL,
  `id_s` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_mesa`
--

INSERT INTO `tbl_mesa` (`id_m`, `silla_m`, `disponibilidad_m`, `id_s`) VALUES
(1, 4, 'si', 1),
(2, 8, 'si', 2),
(3, 4, 'si', 3),
(4, 4, 'si', 1),
(5, 4, 'si', 1),
(6, 4, 'si', 1),
(7, 8, 'si', 1),
(8, 10, 'si', 1),
(9, 12, 'si', 1),
(10, 16, 'si', 1),
(11, 18, 'si', 1),
(12, 4, 'si', 1),
(13, 2, 'si', 2),
(14, 4, 'no', 2),
(15, 6, 'no', 2),
(16, 10, 'no', 2),
(17, 12, 'si', 2),
(18, 4, 'si', 3),
(19, 6, 'si', 3),
(20, 6, 'si', 3),
(21, 8, 'si', 3),
(22, 10, 'no', 3),
(23, 12, 'si', 3),
(24, 16, 'si', 3),
(25, 18, 'si', 3),
(26, 20, 'si', 3),
(28, 8, 'si', 2),
(30, 6, 'si', 1),
(31, 10, 'si', 2),
(32, 12, 'si', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_mesa/reserva`
--

CREATE TABLE `tbl_mesa/reserva` (
  `id_mesa/reserva` int(11) NOT NULL,
  `id_mesa` int(11) DEFAULT NULL,
  `id_reserva` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_mesa/reserva`
--

INSERT INTO `tbl_mesa/reserva` (`id_mesa/reserva`, `id_mesa`, `id_reserva`) VALUES
(24, 4, 24),
(25, 16, 25),
(26, 21, 26),
(27, 15, 27),
(28, 22, 28),
(29, 14, 29),
(30, 16, 29);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reserva`
--

CREATE TABLE `tbl_reserva` (
  `id_r` int(11) NOT NULL,
  `nombre_r` varchar(45) DEFAULT NULL,
  `apellido_r` varchar(45) DEFAULT NULL,
  `telefono_r` int(9) DEFAULT NULL,
  `fecha_r` date DEFAULT NULL,
  `num_personas_r` int(11) DEFAULT NULL,
  `franja_horaria_r` tinyint(4) DEFAULT NULL,
  `hora_cierre_r` time DEFAULT NULL,
  `activa_r` enum('si','no') NOT NULL,
  `id_u` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_reserva`
--

INSERT INTO `tbl_reserva` (`id_r`, `nombre_r`, `apellido_r`, `telefono_r`, `fecha_r`, `num_personas_r`, `franja_horaria_r`, `hora_cierre_r`, `activa_r`, `id_u`) VALUES
(24, 'Alex', 'Salas', 678456234, '2021-12-23', 4, 4, '19:23:19', 'no', 5),
(25, 'Carlos', 'Piedras', 678345754, '2021-12-22', 10, 5, '19:24:41', 'no', 5),
(26, 'Sara', 'Connor', 678234768, '2021-12-26', 8, 6, '19:27:34', 'no', 5),
(27, 'Amancio', 'Ortega', 678476234, '2021-12-28', 6, 1, NULL, 'si', 17),
(28, 'Antonio', 'Manolete', 679823445, '2022-01-07', 10, 3, NULL, 'si', 17),
(29, 'Pol', 'Garcia', 677853667, '2021-12-21', 12, 1, NULL, 'si', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_sala`
--

CREATE TABLE `tbl_sala` (
  `id_s` int(11) NOT NULL,
  `nombre_s` varchar(45) DEFAULT NULL,
  `descripcion_s` varchar(100) DEFAULT NULL,
  `img_s` varchar(100) DEFAULT NULL,
  `disponibilidad_s` enum('si','no') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_sala`
--

INSERT INTO `tbl_sala` (`id_s`, `nombre_s`, `descripcion_s`, `img_s`, `disponibilidad_s`) VALUES
(1, 'Terraza', 'Zona del restaurante con terraza', '../img/terraza.jpg', 'si'),
(2, 'Comedor', 'Zona del restaurante con comedor', '../img/comedor.jpg', 'si'),
(3, 'Sala Privada', 'Zona del restaurante con sala privada', '../img/sala_privada.jpg', 'si');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `id_u` int(11) NOT NULL,
  `nombre_u` varchar(45) DEFAULT NULL,
  `apellido_u` varchar(45) DEFAULT NULL,
  `correo_u` varchar(100) DEFAULT NULL,
  `contraseña_u` varchar(45) DEFAULT NULL,
  `tipo_u` enum('camarero','administrador') DEFAULT NULL,
  `disponibilidad_u` enum('si','no') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`id_u`, `nombre_u`, `apellido_u`, `correo_u`, `contraseña_u`, `tipo_u`, `disponibilidad_u`) VALUES
(1, 'Agnes', 'Plans', 'agnesplans@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055', 'administrador', 'si'),
(2, 'Arnau', 'Balart', 'arnaubalart@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055', 'camarero', 'si'),
(3, 'Carlos', 'Piedra', 'carlospiedra@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055', 'administrador', 'si'),
(4, 'Danny', 'Larrea', 'dannylarrea@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055', 'administrador', 'si'),
(5, 'Diego', 'Soledispa', 'diegosoledispa@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055', 'administrador', 'si'),
(6, 'Ignasi', 'Romero', 'ignasiromero@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055', 'administrador', 'si'),
(7, 'Javier', 'Soledispa', 'javiersoledispa@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055', 'camarero', 'si'),
(8, 'Josep', 'Marti', 'josepmarti@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055', 'camarero', 'si'),
(9, 'Miquel', 'Andreu', 'miquelandreu@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055', 'administrador', 'no'),
(10, 'Sergio', 'Jimenez', 'sergiojimenez@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055', 'administrador', 'si'),
(11, 'Sergio23', 'Sergio23', 'sergio23@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055', 'administrador', 'si'),
(12, 'Xavi', 'Gomez', 'xaviergomez@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055', 'camarero', 'si'),
(13, 'Pedro', 'Garcia', 'pedrogarcia@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055', 'camarero', 'no'),
(16, 'admin', 'admin', 'admin@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055', 'administrador', 'si'),
(17, 'camarero', 'camarero', 'camarero@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055', 'camarero', 'si');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_mesa`
--
ALTER TABLE `tbl_mesa`
  ADD PRIMARY KEY (`id_m`),
  ADD KEY `fk_tbl_mesa_tbl_localizacion_idx` (`id_s`);

--
-- Indices de la tabla `tbl_mesa/reserva`
--
ALTER TABLE `tbl_mesa/reserva`
  ADD PRIMARY KEY (`id_mesa/reserva`),
  ADD KEY `fk_tbl_mesa/reserva_tbl_mesa_idx` (`id_mesa`),
  ADD KEY `fk_tbl_mesa/reserva_tbl_reserva_idx` (`id_reserva`);

--
-- Indices de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  ADD PRIMARY KEY (`id_r`),
  ADD KEY `fk_tbl_reserva_tbl_usuario_idx` (`id_u`);

--
-- Indices de la tabla `tbl_sala`
--
ALTER TABLE `tbl_sala`
  ADD PRIMARY KEY (`id_s`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`id_u`),
  ADD UNIQUE KEY `correo_u` (`correo_u`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_mesa`
--
ALTER TABLE `tbl_mesa`
  MODIFY `id_m` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `tbl_mesa/reserva`
--
ALTER TABLE `tbl_mesa/reserva`
  MODIFY `id_mesa/reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  MODIFY `id_r` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `tbl_sala`
--
ALTER TABLE `tbl_sala`
  MODIFY `id_s` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `id_u` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_mesa`
--
ALTER TABLE `tbl_mesa`
  ADD CONSTRAINT `fk_tbl_mesa_tbl_localizacion` FOREIGN KEY (`id_s`) REFERENCES `tbl_sala` (`id_s`);

--
-- Filtros para la tabla `tbl_mesa/reserva`
--
ALTER TABLE `tbl_mesa/reserva`
  ADD CONSTRAINT `fk_tbl_mesa/reserva_tbl_mesa` FOREIGN KEY (`id_mesa`) REFERENCES `tbl_mesa` (`id_m`),
  ADD CONSTRAINT `fk_tbl_mesa/reserva_tbl_reserva` FOREIGN KEY (`id_reserva`) REFERENCES `tbl_reserva` (`id_r`);

--
-- Filtros para la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  ADD CONSTRAINT `fk_tbl_reserva_tbl_usuario` FOREIGN KEY (`id_u`) REFERENCES `tbl_usuario` (`id_u`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
