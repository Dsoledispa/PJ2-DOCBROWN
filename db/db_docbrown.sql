-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-11-2021 a las 19:45:09
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_historial`
--

CREATE TABLE `tbl_historial` (
  `id_historial` int(11) NOT NULL,
  `id_mesa` int(11) DEFAULT NULL,
  `dia_historial` date DEFAULT NULL,
  `inicio_historial` time DEFAULT NULL,
  `fin_historial` time DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_historial`
--

INSERT INTO `tbl_historial` (`id_historial`, `id_mesa`, `dia_historial`, `inicio_historial`, `fin_historial`, `nombre`) VALUES
(9, 1, '2021-11-05', '16:08:22', '16:08:24', 'Xavi'),
(10, 3, '2021-11-05', '17:10:02', '17:10:08', 'Xavi'),
(11, 2, '2021-11-05', '17:10:05', '17:10:09', 'Xavi'),
(12, 2, '2021-11-05', '17:45:57', '17:46:03', 'Diego'),
(13, 3, '2021-11-05', '17:46:05', '17:46:25', 'Diego'),
(15, 1, '2021-11-05', '19:17:56', '19:17:58', 'Xavi'),
(16, 3, '2021-11-05', '19:32:48', '19:33:07', 'Xavi'),
(17, 104, '2021-11-05', '19:40:42', '19:40:53', 'Xavi');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_localizacion`
--

CREATE TABLE `tbl_localizacion` (
  `id_localizacion` int(11) NOT NULL,
  `nombre_localizacion` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `tbl_mesa` (
  `id_mesa` int(11) NOT NULL,
  `mesa` int(11) DEFAULT NULL,
  `silla` int(11) DEFAULT NULL,
  `disponibilidad` enum('si','no') DEFAULT NULL,
  `id_localizacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_mesa`
--

INSERT INTO `tbl_mesa` (`id_mesa`, `mesa`, `silla`, `disponibilidad`, `id_localizacion`) VALUES
(1, 1, 2, 'si', 1),
(2, 3, 8, 'si', 2),
(3, 1, 2, 'si', 3),
(4, 1, 4, 'si', 1),
(5, 2, 4, 'si', 1),
(6, 2, 6, 'si', 1),
(7, 3, 8, 'si', 1),
(8, 3, 10, 'si', 1),
(9, 4, 12, 'si', 1),
(10, 4, 16, 'si', 1),
(11, 5, 18, 'si', 1),
(12, 5, 20, 'si', 1),
(13, 1, 2, 'si', 2),
(14, 2, 4, 'si', 2),
(15, 2, 6, 'si', 2),
(16, 3, 10, 'si', 2),
(17, 4, 12, 'si', 2),
(18, 2, 4, 'si', 3),
(19, 2, 6, 'si', 3),
(20, 2, 6, 'si', 3),
(21, 3, 8, 'si', 3),
(101, 3, 10, 'si', 3),
(102, 4, 12, 'si', 3),
(103, 4, 16, 'si', 3),
(104, 5, 18, 'si', 3),
(105, 5, 20, 'si', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `nombre` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contraseña` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`nombre`, `email`, `contraseña`) VALUES
('Diego', 'diegosoledispa@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055'),
('Xavi', 'xaviergomez@docbrown.com', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_historial`
--
ALTER TABLE `tbl_historial`
  ADD PRIMARY KEY (`id_historial`),
  ADD KEY `fk_historial_mesa_idx` (`id_mesa`),
  ADD KEY `fk_historial_usuario_idx` (`nombre`);

--
-- Indices de la tabla `tbl_localizacion`
--
ALTER TABLE `tbl_localizacion`
  ADD PRIMARY KEY (`id_localizacion`);

--
-- Indices de la tabla `tbl_mesa`
--
ALTER TABLE `tbl_mesa`
  ADD PRIMARY KEY (`id_mesa`),
  ADD KEY `fk_mesa_localizacion_idx` (`id_localizacion`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`nombre`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_historial`
--
ALTER TABLE `tbl_historial`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tbl_localizacion`
--
ALTER TABLE `tbl_localizacion`
  MODIFY `id_localizacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_mesa`
--
ALTER TABLE `tbl_mesa`
  MODIFY `id_mesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_historial`
--
ALTER TABLE `tbl_historial`
  ADD CONSTRAINT `fk_historial_mesa` FOREIGN KEY (`id_mesa`) REFERENCES `tbl_mesa` (`id_mesa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_historial_usuario` FOREIGN KEY (`nombre`) REFERENCES `tbl_usuario` (`nombre`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_mesa`
--
ALTER TABLE `tbl_mesa`
  ADD CONSTRAINT `fk_mesa_localizacion` FOREIGN KEY (`id_localizacion`) REFERENCES `tbl_localizacion` (`id_localizacion`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
