-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 08-04-2019 a las 12:58:01
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

DROP DATABASE IF EXISTS userManager;
CREATE DATABASE IF NOT EXISTS userManager;
USE userManager;
GRANT ALL PRIVILEGES ON * . * TO 'root'@'localhost';
FLUSH PRIVILEGES;


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `userManager`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `action`
--

CREATE TABLE IF NOT EXISTS `action`(
  `idAction` int(11) NOT NULL,
  `nameAction` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripAction` varchar(225) COLLATE utf8_spanish_ci NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `action`
--

INSERT INTO `action` (`idAction`, `nameAction`, `descripAction`) VALUES
(1, 'SHOW ALL', 'Action to show all the content of an entity'),
(2, 'ADD', 'Action to add content to an entity'),
(3, 'EDIT', 'Action to edit content to an entity'),
(4, 'DELETE', 'Action to delete content to an entity'),
(5, 'SHOW', 'Action to show content to an entity'),
(6, 'SEARCH', 'Action to search content to an entity'),
(7, 'MY', 'MY REQUESTS'),
(8, 'RANKING', 'RANKING de notificadores'),
(9, 'ASIGN', 'ASIGN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `action_functionality`
--

CREATE TABLE IF NOT EXISTS `action_functionality`(
  `idAction` int(11) NOT NULL,
  `idFunction` int(11) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `action_functionality`
--

INSERT INTO `action_functionality` (`idAction`, `idFunction`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(2, 8),
(2, 9),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 7),
(3, 8),
(3, 9),
(4, 1),
(4, 2),
(4, 3),
(4, 4),
(4, 5),
(4, 7),
(4, 8),
(4, 9),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(5, 5),
(5, 7),
(5, 8),
(5, 9),
(6, 4),
(6, 5),
(6, 6),
(6, 7),
(6, 8),
(6, 9),
(7, 5),
(8, 5),
(9, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `building`
--

CREATE TABLE IF NOT EXISTS `building` (
  `idBuilding` char(5) COLLATE utf8_spanish_ci NOT NULL,
  `nameBuilding` varchar(225) COLLATE utf8_spanish_ci NOT NULL,
  `addressBuilding` varchar(225) COLLATE utf8_spanish_ci DEFAULT NULL,
  `phoneBuilding` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `building`
--

INSERT INTO `building` (`idBuilding`, `nameBuilding`, `addressBuilding`, `phoneBuilding`) VALUES
('OSBI0', 'Biblioteca Universitaria Rosalía de Castro', 'Camino Seara B 4', 988387192);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `floor`
--

CREATE TABLE IF NOT EXISTS `floor`(
  `idBuilding` char(5) COLLATE utf8_spanish_ci NOT NULL,
  `idFloor` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `nameFloor` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `planeFloor` varchar(500) COLLATE utf8_spanish_ci DEFAULT '',
  `surfaceBuildingFloor` decimal(10,2) NOT NULL,
  `surfaceUsefulFloor` decimal(10,2) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `floor`
--

INSERT INTO `floor` (`idBuilding`, `idFloor`, `nameFloor`, `planeFloor`, `surfaceBuildingFloor`, `surfaceUsefulFloor`) VALUES
('OSBI0', '04', 'Cuarta Planta', '../document/Buildings/OSBI0/OSBI004/Segunda, Tercera, Cuarta.jpg', 215.20, 181.25),
('OSBI0', '03', 'Terceira Planta', '../document/Buildings/OSBI0/OSBI003/Segunda, Tercera, Cuarta.jpg', 214.80, 179.60),
('OSBI0', '02', 'Segunda Planta', '../document/Buildings/OSBI0/OSBI002/Segunda, Tercera, Cuarta.jpg', 215.20, 181.25),
('OSBI0', '01', 'Primeira Planta', '../document/Buildings/OSBI0/OSBI001/Primera Planta.jpg', 818.30, 486.60),
('OSBI0', '00', 'Planta Baixa', "../document/Buildings/OSBI0/OSBI000/Planta Baja.jpg", 1895.80, 1428.75),
('OSBI0', 'S1', 'Soto -1', '', 1800.40, 894.20),
('OSBI0', 'S2', 'Soto -2', '', 1338.40, 1226.70);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `functionality`
--

CREATE TABLE IF NOT EXISTS `functionality`(
  `idFunction` int(11) NOT NULL,
  `nameFunction` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripFunction` varchar(225) COLLATE utf8_spanish_ci NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `functionality`
--

INSERT INTO `functionality` (`idFunction`, `nameFunction`, `descripFunction`) VALUES
(1, 'BUILDING', 'Actions on the set of buildings'),
(2, 'FLOOR', "Actions on the set of building's floor"),
(3, 'SPACE', "Actions on the set of floor's spaces"),
(4, 'USER', "Actions on the set of users"),
(5, 'INCIDENCE', 'Incidences Controller'),
(6, 'PERMISSION', 'PERMISSIONS Controller '),
(7, 'FUNCTIONALITY', 'Actions on the set of functionalities'),
(8, 'ACTION', "Actions on the set of actions"),
(9, 'GROUP', '"Actions on the set of groups"');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `group`
--

CREATE TABLE IF NOT EXISTS `group`(
  `idGroup` int(11) NOT NULL,
  `nameGroup` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `descripGroup` varchar(225) COLLATE utf8_spanish_ci NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `group`
--

INSERT INTO `group` (`idGroup`, `nameGroup`, `descripGroup`) VALUES
(1, 'ADMIN', 'System administrator'),
(2, 'RESPINFR', 'Responsable de infraestructura'),
(3, 'UNITECNICA', 'Miembro de la Unidad Tecnica'),
(5, 'ADMINECONOM', 'ADMINECONOM'),
(9, 'prueba', 'prueba2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `incidence`
--

CREATE TABLE IF NOT EXISTS `incidence` (
  `idIncidence` int(11) NOT NULL,
  `title` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `description` text COLLATE latin1_spanish_ci NOT NULL,
  `idLocation` int(11) NOT NULL,
  `images` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  `okInfraResp` tinyint(4) NOT NULL DEFAULT '0',
  `priority` int(11) DEFAULT '0',
  `budget` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `authorization` tinyint(4) NOT NULL DEFAULT '0',
  `finished` tinyint(4) NOT NULL DEFAULT '0',
  `username` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `incidence`
--

INSERT INTO `incidence` (`idIncidence`, `title`, `description`, `idLocation`, `images`, `okInfraResp`, `priority`, `budget`, `amount`, `authorization`, `finished`, `username`, `created_at`, `updated_at`) VALUES
(1, 'prueba', 'wewewewewea', 1, '', 0, 0, 0, 0, 0, 0, 'admin', '2019-03-20 15:46:48', '2019-03-20 15:46:48'),
(6, 'prueba2', 'wewewe', 1, '', 0, 0, 0, 0, 0, 0, 'pepe', '2019-03-20 15:37:39', '0000-00-00 00:00:00'),
(7, 'prueba', '3', 1, '', 0, 0, 0, 0, 0, 1, 'admin', '2019-03-20 15:37:39', '0000-00-00 00:00:00'),
(9, 'prueba', '4', 1, '', 0, 0, 0, 0, 0, 0, 'admin', '2019-03-20 15:37:39', '0000-00-00 00:00:00'),
(24, 'prueba', 'prueba', 2, 'IncidencesFiles/24/', 0, 0, 0, 0, 0, 0, 'admin', '2019-04-04 15:26:00', '0000-00-00 00:00:00'),
(26, 'prueba', 'prueba', 1, '', 0, 0, 0, 0, 0, 0, 'admin', '2019-04-04 15:35:03', '0000-00-00 00:00:00'),
(33, 'p1', 'p1', 1, '../IncidencesFiles/33/images/', 0, 0, 0, 0, 0, 0, 'admin', '2019-04-04 20:44:21', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notification`
--

CREATE TABLE IF NOT EXISTS `notification` (
  `idNotification` int(11) NOT NULL,
  `idIncidence` int(11) NOT NULL,
  `username` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission`
--

CREATE TABLE IF NOT EXISTS `permission`(
  `idGroup` int(11) NOT NULL,
  `idFunction` int(11) NOT NULL,
  `idAction` int(11) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `permission`
--

INSERT INTO `permission` (`idGroup`, `idFunction`, `idAction`) VALUES
(1, 1, 1),
(1, 1, 2),
(1, 1, 3),
(1, 1, 4),
(1, 1, 5),
(1, 2, 1),
(1, 2, 2),
(1, 2, 3),
(1, 2, 4),
(1, 2, 5),
(1, 3, 1),
(1, 3, 2),
(1, 3, 3),
(1, 3, 4),
(1, 3, 5),
(1, 4, 1),
(1, 4, 2),
(1, 4, 3),
(1, 4, 4),
(1, 4, 5),
(1, 4, 6),
(1, 5, 1),
(1, 5, 2),
(1, 5, 3),
(1, 5, 4),
(1, 5, 5),
(1, 5, 6),
(1, 5, 7),
(1, 5, 8),
(1, 6, 1),
(1, 6, 6),
(1, 6, 9),
(1, 7, 1),
(1, 7, 2),
(1, 7, 3),
(1, 7, 4),
(1, 7, 5),
(1, 7, 6),
(1, 8, 1),
(1, 8, 2),
(1, 8, 3),
(1, 8, 4),
(1, 8, 5),
(1, 8, 6),
(1, 9, 1),
(1, 9, 2),
(1, 9, 3),
(1, 9, 4),
(1, 9, 5),
(1, 9, 6),
(2, 5, 7),
(9, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `space`
--

CREATE TABLE IF NOT EXISTS `space`(
  `idBuilding` char(5) COLLATE utf8_spanish_ci NOT NULL,
  `idFloor` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `idSpace` char(5) COLLATE utf8_spanish_ci NOT NULL,
  `nameSpace` varchar(225) COLLATE utf8_spanish_ci NOT NULL,
  `surfaceSpace` decimal(10,2) DEFAULT '0.00',
  `numberInventorySpace` varchar(10) COLLATE utf8_spanish_ci DEFAULT '######',
  `coordsPlane` varchar(225) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `space`
--

INSERT INTO SPACE (idBuilding, idFloor, idSpace, nameSpace, surfaceSpace, numberInventorySpace, coordsPlane) VALUES
('OSBI0', '04', '00001', 'Escaleiras', 13.80, '######',''),
('OSBI0', '04', '00002', 'Pasillo', 28.30, '######',''),
('OSBI0', '04', '00003', 'Ascensor', 00.00, '######',''), 
('OSBI0', '04', '00005', 'Baño mulleres', 5.20, '######',''), 
('OSBI0', '04', '00006', 'Sala de usos múltiples', 133.90, '003743',''),
('OSBI0', '03', '00001', 'Escaleiras', 13.80, '######',''),
('OSBI0', '03', '00002', 'Pasillo', 23.00, '######',''),
('OSBI0', '03', '00003', 'Ascensor', 00.00 , '######',''), 
('OSBI0', '03', '00005', 'Baño homes', 5.20, '######',''), 
('OSBI0', '03', '00006', 'Sala de informática', 137.65, '003744',''),
('OSBI0', '02', '00001', 'Escaleiras', 13.80, '######',''),
('OSBI0', '02', '00002', 'Pasillo', 24.95, '######',''),
('OSBI0', '02', '00003', 'Ascensor', 00.00, '######',''), 
('OSBI0', '02', '00005', 'Baño mulleres', 5.20, '######',''), 
('OSBI0', '02', '00006', 'Sala de audiovisuais', 137.30, '003745',''),
('OSBI0', '00', '00001', 'Escaleiras', 00.00, '######',''), 
('OSBI0', '00', '00002', 'Pasillo', 00.00, '######',''), 
('OSBI0', '00', '00003', 'Aseos', 00.00, '######',''),
('OSBI0', '00', '00004', 'Aseos', 00.00, '######',''), 
('OSBI0', '00', '00005', 'Pasillo', 24.55,'######',''), 
('OSBI0', '00', '00007', 'Ascensor', 00.00, '######',''), 
('OSBI0', '00', '00008', 'Escaleiras', 00.00, '######',''),
('OSBI0', '00', '00009', 'Grupo electróxeno', 11.50, '006743',''),
('OSBI0', '00', '00010', 'Cadro Xeral', 5.65, '006744',''),
('OSBI0', '00', '00011', 'Centro de transformación', 16.60, '006745',''),
('OSBI0', '00', '00012', 'Alxibe', 9.50, '006746',''),
('OSBI0', '00', '00013', 'Grupo de presión', 9.65, '006747',''),
('OSBI0', '00', '00014', 'Sala de máquinas', 75.80, '006748',''),
('OSBI0', '00', '00015', 'Pasillo', 34.45,'######',''),
('OSBI0', '00', '00016', 'Pasillo', 127.15, '######',''),
('OSBI0', '00', '00017', 'Pasillo', 00.00,'######',''),
('OSBI0', '00', '00018', 'Depósito aberto', 90.15, '######',''),
('OSBI0', '00', '00019', 'Sala de lectura', 273.15, '003754',''),
('OSBI0', '00', '00020', 'Zona de prensa', 22.75,'######',''),
('OSBI0', '00', '00021', 'Escaleiras', 12.35, '######',''),
('OSBI0', '00', '00023', 'Ascensor', 00.00,'######',''),
('OSBI0', '00', '00026', 'Escaleiras', 00.00,'######',''),
('OSBI0', '00', '00027', 'Ascensor', 00.00,'######',''),
('OSBI0', '00', '00028', 'Despacho de préstamos e devolucións', 53.10, '######',''),
('OSBI0', '00', '00029', 'Sala de traballo', 16.60, '003752',''),
('OSBI0', '00', '00030', 'Depósito TEBS', 15.20, '######',''),
('OSBI0', '00', '00031', 'Pasillo', 00, '######',''),
('OSBI0', '00', '00032', 'Pasillo', 00, '######',''),
('OSBI0', '00', '00033', 'Despacho de Referencias', 19.40, '003751',''),
('OSBI0', '00', '00034', 'Pasillo', 00, '######',''),
('OSBI0', '00', '00035', 'Pasillo', 00, '######',''), 
('OSBI0', '00', '00036', 'Recepción', 18.70, '006728',''), 
('OSBI0', '00', '00037', 'Baños', 31.85, '######',''), 
('OSBI0', '00', '00038', 'Escaleiras', 00, '######',''),
('OSBI0', '00', '00039', 'Sala de Referencias', 113.50, '003750',''),
('OSBI0', 'S1', '00001', 'Baños', 23.23, '######',''), 
('OSBI0', 'S1', '00002', 'Pasillo', 26.70, '######',''), 
('OSBI0', 'S1', '00004', 'Ascensor', 00.00, '######',''),
('OSBI0', 'S1', '00005', 'Escaleiras', 6.70, '######',''), 
('OSBI0', 'S1', '00006', 'Sala de estudio', 171.00,'006740',''), 
('OSBI0', 'S1', '00007', 'Escaleiras', 00.00, '######',''),
('OSBI0', 'S1', '00008', 'Escaleiras', 00.00, '######',''),
('OSBI0', 'S1', '00009', 'Pasillo', 00.00, '######',''),
('OSBI0', 'S1', '00010', 'Pasillo', 00.00, '######',''), 
('OSBI0', 'S1', '00011', 'Ascensor', 00.00, '######',''),
('OSBI0', 'S1', '00012', 'Depósito', 291.20, '003749',''),
('OSBI0', 'S1', '00014', 'Almacén limpieza', 14.50, '006738',''),
('OSBI0', 'S1', '00015', 'Almacén biblioteca', 73.95, '006739',''),
('OSBI0', 'S1', '00017', 'Ascensor', 00.00, '######',''),
('OSBI0', 'S1', '00018', 'Pasillo', 64.80, '######',''),
('OSBI0', 'S1', '00019', 'RACK', 25.60, '003748',''),
('OSBI0', 'S2', '00001', 'Baños', 23.25, '######',''), 
('OSBI0', 'S2', '00002', 'Pasillo', 30.85, '######',''), 
('OSBI0', 'S2', '00004', 'Ascensor', 00.00, '######',''),
('OSBI0', 'S2', '00005', 'Escaleiras', 00.00, '######',''),
('OSBI0', 'S2', '00006', 'Escaleiras', 00.00,'######',''),
('OSBI0', 'S2', '00007', 'Vestíbulo', 3.10, '######',''), 
('OSBI0', 'S2', '00008', 'Depósito Hemeroteca', 119.43, '003741',''), 
('OSBI0', 'S2', '00009', 'Hemeroteca', 270.82, '006741',''), 
('OSBI0', 'S2', '00010', 'Deposito aberto', 103.47, '######',''), 
('OSBI0', 'S2', '00011', 'Zona de consulta', 126.74, '######',''), 
('OSBI0', 'S2', '00012', 'Sala de lectura', 314.77, '######',''),
('OSBI0', 'S2', '00013', 'Escaleiras', 00.00, '######',''), 
('OSBI0', 'S2', '00015', 'Ascensor', 00.00, '######',''),
('OSBI0', 'S2', '00016', 'Pasillo', 41.52, '######',''),
('OSBI0', 'S2', '00017', 'Escaleiras', 00.00, '######',''), 
('OSBI0', 'S2', '00018', 'Sala técnica do ascensor', 18.20, '003747',''),
('OSBI0', 'S2', '00020', 'Escaleiras', 00.00, '######','');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user`(
  `photo` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `username` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `passwd` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `phone` int(9) DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`photo`, `username`, `passwd`, `name`, `surname`, `dni`, `birthdate`, `email`, `phone`) VALUES
('../document/Users/admin/ivan.jpg', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Iván', 'de Dios Fernández', '44488795X', '1994-03-26', 'ivanddf1994@hotmail.com', 617129241),
(NULL, 'responsable', 'responsable', 'RespInfr1', 'Informatica', '232323232Y', '2019-03-03', 'info@responsable.es', 674949955);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group`(
  `username` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `idGroup` int(11) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user_group`
--

INSERT INTO `user_group` (`username`, `idGroup`) VALUES
('admin', 1),
('admin', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`idAction`);

--
-- Indices de la tabla `action_functionality``
--
ALTER TABLE `action_functionality`
  ADD PRIMARY KEY (`idAction`,`idFunction`),
  ADD KEY `FUNCTION` (`idFunction`);

--
-- Indices de la tabla `building`
--
ALTER TABLE `building`
  ADD PRIMARY KEY (`idBuilding`);

--
-- Indices de la tabla `floor`
--
ALTER TABLE `floor`
  ADD PRIMARY KEY (`idFloor`,`idBuilding`),
  ADD KEY `idBuilding` (`idBuilding`);

--
-- Indices de la tabla `functionality``
--
ALTER TABLE `functionality`
  ADD PRIMARY KEY (`idFunction`);

--
-- Indices de la tabla `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`idGroup`);

--
-- Indices de la tabla `incidence`
--
ALTER TABLE `incidence`
  ADD PRIMARY KEY (`idIncidence`),
  ADD KEY `username` (`username`);

--
-- Indices de la tabla `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`idNotification`),
  ADD KEY `Incidence` (`idIncidence`),
  ADD KEY `username` (`username`);

--
-- Indices de la tabla `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`idGroup`,`idFunction`,`idAction`),
  ADD KEY `PERM-ACTION` (`idAction`),
  ADD KEY `PERM-FUNC` (`idFunction`);

--
-- Indices de la tabla `space`
--
ALTER TABLE `space`
  ADD PRIMARY KEY (`idFloor`,`idBuilding`,`idSpace`),
  ADD KEY `idBuilding` (`idBuilding`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`username`,`idGroup`),
  ADD KEY `GROUP` (`idGroup`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `action`
--
ALTER TABLE `action`
  MODIFY `idAction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `functionality`
--
ALTER TABLE `functionality`
  MODIFY `idFunction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `group`
--
ALTER TABLE `group`
  MODIFY `idGroup` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `incidence`
--
ALTER TABLE `incidence`
  MODIFY `idIncidence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `notification`
--
ALTER TABLE `notification`
  MODIFY `idNotification` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `action_functionality`
--
ALTER TABLE `action_functionality`
  ADD CONSTRAINT `action` FOREIGN KEY (`idAction`) REFERENCES `action` (`idAction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `function` FOREIGN KEY (`idFunction`) REFERENCES `functionality` (`idFunction`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `incidence` FOREIGN KEY (`idIncidence`) REFERENCES `incidence` (`idIncidence`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `user` (`username`);

--
-- Filtros para la tabla `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `action-perm` FOREIGN KEY (`idAction`) REFERENCES `action` (`idAction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `function-perm` FOREIGN KEY (`idFunction`) REFERENCES `functionality` (`idFunction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `grupo` FOREIGN KEY (`idGroup`) REFERENCES `group` (`idGroup`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `user_group`
--
ALTER TABLE `user_group`
  ADD CONSTRAINT `group` FOREIGN KEY (`idGroup`) REFERENCES `group` (`idGroup`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
