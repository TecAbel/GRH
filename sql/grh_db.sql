-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 09-09-2019 a las 17:49:34
-- Versión del servidor: 5.6.37
-- Versión de PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `grh_db`
--
CREATE DATABASE IF NOT EXISTS `grh_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `grh_db`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--
-- Creación: 06-09-2019 a las 02:59:34
--

DROP TABLE IF EXISTS `actividades`;
CREATE TABLE `actividades` (
  `num_actividad` int(8) NOT NULL,
  `nombre_act` char(30) NOT NULL,
  `num_usuario` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`num_actividad`, `nombre_act`, `num_usuario`) VALUES
(9, 'Desarrollo', 1),
(10, 'Servicio', 1),
(11, 'Guardia', 2),
(12, 'Cualquiera', 4),
(13, 'Pruebas', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calculos`
--
-- Creación: 03-09-2019 a las 00:18:42
--

DROP TABLE IF EXISTS `calculos`;
CREATE TABLE `calculos` (
  `num_cal` int(10) NOT NULL,
  `num_usuario` int(8) NOT NULL,
  `num_emp` int(8) NOT NULL,
  `num_actividad` int(8) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora_ent` time DEFAULT NULL,
  `hora_sal` time DEFAULT NULL,
  `horas_tra` int(11) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `transporte` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `calculos`
--

INSERT INTO `calculos` (`num_cal`, `num_usuario`, `num_emp`, `num_actividad`, `fecha`, `hora_ent`, `hora_sal`, `horas_tra`, `descripcion`, `transporte`) VALUES
(1, 1, 1, 9, '2019-09-06', '09:00:00', '12:26:00', 3, '', 0),
(2, 1, 2, 10, '2019-09-05', '15:00:00', '16:00:00', 1, 'Respaldo de servidor', 0),
(3, 4, 6, 12, '2019-09-06', '12:56:00', '19:56:00', 7, '', 0),
(4, 1, 3, 10, '2019-09-06', '17:00:00', '18:57:00', 2, 'Servicio semanal', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleadores`
--
-- Creación: 03-09-2019 a las 19:19:40
--

DROP TABLE IF EXISTS `empleadores`;
CREATE TABLE `empleadores` (
  `num_emp` int(8) NOT NULL,
  `num_usuario` int(8) NOT NULL,
  `nombre_emp` char(40) NOT NULL,
  `nombre_emp_emp` varchar(50) DEFAULT NULL,
  `correo_emp` char(40) DEFAULT NULL,
  `tel_emp` char(10) DEFAULT NULL,
  `num_empleado` char(20) DEFAULT NULL,
  `rfc_emp` char(13) DEFAULT NULL,
  `cuota` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleadores`
--

INSERT INTO `empleadores` (`num_emp`, `num_usuario`, `nombre_emp`, `nombre_emp_emp`, `correo_emp`, `tel_emp`, `num_empleado`, `rfc_emp`, `cuota`) VALUES
(1, 1, 'Carlos Sosa', 'Grupo Columbia', 'columbiacel@gmail.com', '5524004205', 'T02', '', 70),
(2, 1, 'Alfredo GutiÃ©rrez', '', 'alfredo@mail.com', '', '', '', 100),
(3, 1, 'Cristina', 'Pauem', 'pauem753@hotmail.com', '', '', '', 100),
(4, 2, 'Hospital general', '', '', '', '', '', 120),
(5, 2, 'Troncoso', 'Hospital Troncoso', 'troncoso.hospital@mail.com', '', 'E123', 'VKRKVIEBVI091', 70),
(6, 4, 'Xd', 'Anibalito', '', '', '', '', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--
-- Creación: 03-09-2019 a las 00:18:31
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `num_usuario` int(8) NOT NULL,
  `correo` char(40) NOT NULL,
  `nombre_user` char(40) NOT NULL,
  `numero` char(10) NOT NULL,
  `rfc` char(13) DEFAULT NULL,
  `pase` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`num_usuario`, `correo`, `nombre_user`, `numero`, `rfc`, `pase`) VALUES
(1, 'abelardo@mail.com', 'Abelardo Aqui Arroyo', '5578444332', NULL, '$2y$10$RB78iNelicy/YSA1cdWBmOXUnwv/HuZQ7zTwORvLRtfpf8TQwA7km'),
(2, 'diana@mail.com', 'Diana Hermosa AragÃ³n', '5511223399', NULL, '$2y$10$nzZRGMTZWT1NkIYD10VIBOOoXYTqYXclDDRZCMMaBlHP/x8nemhyK'),
(3, 'nuevouser@mail.com', 'Nuevo Usuario', '6838687427', NULL, '$2y$10$opSR27z6kUp8bQjKIQPhxOVxVsYH.8a9O2KcrCEJXn2/.SOwQhj0m'),
(4, 'anibalitoaqui@gmail.com', 'Anibal', '5540833795', NULL, '$2y$10$NYC0EvxNnoP/Uxt5VOjofefOrFiuQZOPDCVj33OgPzu/iHOptAd1i');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`num_actividad`),
  ADD UNIQUE KEY `num_actividad` (`num_actividad`),
  ADD KEY `act_usuarios_idx` (`num_usuario`);

--
-- Indices de la tabla `calculos`
--
ALTER TABLE `calculos`
  ADD PRIMARY KEY (`num_cal`),
  ADD UNIQUE KEY `num_cal` (`num_cal`),
  ADD KEY `num_usuario` (`num_usuario`),
  ADD KEY `num_emp` (`num_emp`),
  ADD KEY `num_actividad` (`num_actividad`);

--
-- Indices de la tabla `empleadores`
--
ALTER TABLE `empleadores`
  ADD PRIMARY KEY (`num_emp`),
  ADD UNIQUE KEY `num_emp` (`num_emp`),
  ADD KEY `num_usuario` (`num_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`num_usuario`),
  ADD UNIQUE KEY `num_usuario` (`num_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `num_actividad` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `calculos`
--
ALTER TABLE `calculos`
  MODIFY `num_cal` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `empleadores`
--
ALTER TABLE `empleadores`
  MODIFY `num_emp` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `num_usuario` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `act_usuarios` FOREIGN KEY (`num_usuario`) REFERENCES `usuarios` (`num_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `calculos`
--
ALTER TABLE `calculos`
  ADD CONSTRAINT `calculos_ibfk_1` FOREIGN KEY (`num_usuario`) REFERENCES `usuarios` (`num_usuario`),
  ADD CONSTRAINT `calculos_ibfk_2` FOREIGN KEY (`num_emp`) REFERENCES `empleadores` (`num_emp`),
  ADD CONSTRAINT `calculos_ibfk_3` FOREIGN KEY (`num_actividad`) REFERENCES `actividades` (`num_actividad`);

--
-- Filtros para la tabla `empleadores`
--
ALTER TABLE `empleadores`
  ADD CONSTRAINT `empleadores_ibfk_1` FOREIGN KEY (`num_usuario`) REFERENCES `usuarios` (`num_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
