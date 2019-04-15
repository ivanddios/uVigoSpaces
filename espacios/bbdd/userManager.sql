-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 09-04-2019 a las 16:40:18
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `USER_MANAGER`
--
DROP DATABASE IF EXISTS `USER_MANAGER`;
CREATE DATABASE IF NOT EXISTS `USER_MANAGER` DEFAULT CHARACTER SET latin1 COLLATE latin1_spanish_ci;
USE `USER_MANAGER`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `IM_ACTION`
--

CREATE TABLE IF NOT EXISTS `IM_ACTION` (
  `im_idAction` int(11) NOT NULL AUTO_INCREMENT,
  `im_nameAction` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `im_descripAction` varchar(225) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`im_idAction`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `IM_ACTION`
--

INSERT INTO `IM_ACTION` (`im_idAction`, `im_nameAction`, `im_descripAction`) VALUES
(1, 'SHOWALL', 'SHOWALL'),
(2, 'ADD', 'ADD'),
(3, 'EDIT', 'EDIT'),
(4, 'DELETE', 'DELETE'),
(5, 'SHOW', 'SHOW'),
(6, 'SEARCH', 'SEARCH'),
(7, 'MY', 'MY REQUESTS'),
(8, 'RANKING', 'RANKING de notificadores'),
(9, 'ASIGN', 'ASIGN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `IM_FUNCTIONALITY_ACTION`
--

CREATE TABLE IF NOT EXISTS `IM_FUNCTIONALITY_ACTION` (
  `im_idAction` int(11) NOT NULL,
  `im_idFunction` int(11) NOT NULL,
  PRIMARY KEY (`im_idAction`,`im_idFunction`),
  KEY `FUNCTION` (`im_idFunction`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `IM_FUNCTIONALITY_ACTION`
--

INSERT INTO `IM_FUNCTIONALITY_ACTION` (`im_idAction`, `im_idFunction`) VALUES
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
-- Estructura de tabla para la tabla `IM_FUNCTIONALITY`
--

CREATE TABLE IF NOT EXISTS `IM_FUNCTIONALITY` (
  `im_idFunction` int(11) NOT NULL AUTO_INCREMENT,
  `im_nameFunction` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `im_descripFunction` varchar(225) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`im_idFunction`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `IM_FUNCTIONALITY`
--

INSERT INTO `IM_FUNCTIONALITY` (`im_idFunction`, `im_nameFunction`, `im_descripFunction`) VALUES
(1, 'BUILDING', 'Building Controller'),
(2, 'FLOOR', 'Floor Controller'),
(3, 'SPACE', 'Space Controller'),
(4, 'USERS', 'Users Controller'),
(5, 'INCIDENCES', 'Incidences Controller'),
(6, 'PERMISSIONS', 'PERMISSIONS Controller '),
(7, 'FUNCTIONALITY', 'Functionality Controller'),
(8, 'ACTION', 'ACTION Controller     '),
(9, 'GROUPS', 'GROUPS Controller');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `IM_GROUP`
--

CREATE TABLE IF NOT EXISTS `IM_GROUP` (
  `im_idGroup` int(11) NOT NULL AUTO_INCREMENT,
  `im_nameGroup` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `im_descripGroup` varchar(225) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`im_idGroup`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `IM_GROUP`
--

INSERT INTO `IM_GROUP` (`im_idGroup`, `im_nameGroup`, `im_descripGroup`) VALUES
(1, 'ADMIN', 'System administrator'),
(2, 'RESPINFR', 'Responsable de infraestructura'),
(3, 'UNITECNICA', 'Miembro de la Unidad Tecnica'),
(5, 'ADMINECONOM', 'ADMINECONOM'),
(9, 'prueba', 'prueba2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `IM_INCIDENCE`
--

CREATE TABLE IF NOT EXISTS `IM_INCIDENCE` (
  `im_idIncidence` int(11) NOT NULL AUTO_INCREMENT,
  `im_title` varchar(100) COLLATE latin1_spanish_ci DEFAULT NULL,
  `im_description` text COLLATE latin1_spanish_ci NOT NULL,
  `im_idLocation` int(11) NOT NULL,
  `im_images` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  `im_okInfraResp` tinyint(4) NOT NULL DEFAULT '0',
  `im_priority` int(11) DEFAULT '0',
  `im_budget` varchar(200) COLLATE latin1_spanish_ci DEFAULT NULL,
  `im_amount` int(11) DEFAULT NULL,
  `im_authorization` tinyint(4) NOT NULL DEFAULT '0',
  `im_finished` tinyint(4) NOT NULL DEFAULT '0',
  `im_username` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `im_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `im_updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`im_idIncidence`),
  KEY `username` (`im_username`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `IM_INCIDENCE`
--

INSERT INTO `IM_INCIDENCE` (`im_idIncidence`, `im_title`, `im_description`, `im_idLocation`, `im_images`, `im_okInfraResp`, `im_priority`, `im_budget`, `im_amount`, `im_authorization`, `im_finished`, `im_username`, `im_created_at`, `im_updated_at`) VALUES
(1, 'prueba', 'wewewewewea', 1, '', 0, 0, '0', 0, 0, 0, 'admin', '2019-03-20 15:46:48', '2019-03-20 15:46:48'),
(6, 'prueba2', 'wewewe', 1, '', 0, 0, '0', 0, 0, 0, 'pepe', '2019-03-20 15:37:39', '0000-00-00 00:00:00'),
(7, 'prueba', '3', 1, '', 0, 0, '0', 0, 0, 1, 'admin', '2019-03-20 15:37:39', '0000-00-00 00:00:00'),
(9, 'prueba', '4', 1, '', 0, 0, '0', 0, 0, 0, 'admin', '2019-03-20 15:37:39', '0000-00-00 00:00:00'),
(24, 'prueba', 'prueba', 2, 'IncidencesFiles/24/', 0, 0, '0', 0, 0, 0, 'admin', '2019-04-04 15:26:00', '0000-00-00 00:00:00'),
(26, 'prueba', 'prueba', 1, '', 0, 0, '0', 0, 0, 0, 'admin', '2019-04-04 15:35:03', '0000-00-00 00:00:00'),
(33, 'p1', 'p1', 1, '../IncidencesFiles/33/images/', 0, 0, '0', 0, 0, 0, 'admin', '2019-04-04 20:44:21', '0000-00-00 00:00:00'),
(34, '35', '35', 3, '../IncidencesFiles/34/images/', 0, 0, '0', 0, 0, 0, 'admin', '2019-04-08 12:57:27', '0000-00-00 00:00:00'),
(35, 'p35', '35', 1, '../IncidencesFiles/35/images', 0, 0, '0', 0, 0, 0, 'admin', '2019-04-08 15:16:22', '0000-00-00 00:00:00'),
(36, 'prueba', 'p', 1, '../IncidencesFiles/36/images', 0, 0, '../IncidencesFiles/36/docs', 0, 0, 0, 'admin', '2019-04-08 16:24:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `IM_NOTIFICATION`
--

CREATE TABLE IF NOT EXISTS `IM_NOTIFICATION` (
  `im_idNotification` int(11) NOT NULL AUTO_INCREMENT,
  `im_idIncidence` int(11) NOT NULL,
  `im_username` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`im_idNotification`),
  KEY `Incidence` (`im_idIncidence`),
  KEY `username` (`im_username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `IM_PERMISSION`
--

CREATE TABLE IF NOT EXISTS `IM_PERMISSION` (
  `im_idGroup` int(11) NOT NULL,
  `im_idFunction` int(11) NOT NULL,
  `im_idAction` int(11) NOT NULL,
  PRIMARY KEY (`im_idGroup`,`im_idFunction`,`im_idAction`),
  KEY `PERM-ACTION` (`im_idAction`),
  KEY `PERM-FUNC` (`im_idFunction`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `IM_PERMISSION`
--

INSERT INTO `IM_PERMISSION` (`im_idGroup`, `im_idFunction`, `im_idAction`) VALUES
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
-- Estructura de tabla para la tabla `IM_USER`
--

CREATE TABLE IF NOT EXISTS `IM_USER` (
  `im_username` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `im_passwd` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `im_name` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `im_surname` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `im_dni` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `im_birthdate` date NOT NULL,
  `im_email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `im_phone` int(15) DEFAULT NULL,
  `im_photo` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`im_username`),
  UNIQUE KEY `dni` (`im_dni`),
  UNIQUE KEY `email` (`im_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `IM_USER`
--

INSERT INTO `IM_USER` (`im_username`, `im_passwd`, `im_name`, `im_surname`, `im_dni`, `im_birthdate`, `im_email`, `im_phone`, `im_photo`) VALUES
('admin', 'admin', 'Iván', 'de Dios Fernández', '44488795X', '0000-00-00', 'ivanddf1994@hotmail.com', 617129241, ''),
('responsable', 'responsable', 'RespInfr1', 'Informatica', '232323232Y', '2019-03-03', 'info@responsable.es', 674949955, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `IM_USER_GROUP`
--

CREATE TABLE IF NOT EXISTS `IM_USER_GROUP` (
  `im_username` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `im_idGroup` int(11) NOT NULL,
  PRIMARY KEY (`im_username`,`im_idGroup`),
  KEY `GROUP` (`im_idGroup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `IM_USER_GROUP`
--

INSERT INTO `IM_USER_GROUP` (`im_username`, `im_idGroup`) VALUES
('admin', 1),
('admin', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SM_ACTION`
--

CREATE TABLE IF NOT EXISTS `SM_ACTION` (
  `sm_idAction` int(11) NOT NULL AUTO_INCREMENT,
  `sm_nameAction` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `sm_descripAction` varchar(225) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`sm_idAction`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `SM_ACTION`
--

INSERT INTO `SM_ACTION` (`sm_idAction`, `sm_nameAction`, `sm_descripAction`) VALUES
(1, 'SHOW ALL', 'Action to show all the content of an entity'),
(2, 'ADD', 'Action to add content to an entity'),
(3, 'EDIT', 'Action to edit content to an entity'),
(4, 'DELETE', 'Action to delete content to an entity'),
(5, 'SHOW', 'Action to show content to an entity');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SM_FUNCTIONALITY_ACTION`
--

CREATE TABLE IF NOT EXISTS `SM_FUNCTIONALITY_ACTION` (
  `sm_idFunction` int(11) NOT NULL,
    `sm_idAction` int(11) NOT NULL,
  PRIMARY KEY (`sm_idFunction`, `sm_idAction`),
  KEY `sm_idFunction` (`sm_idFunction`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `SM_FUNCTIONALITY_ACTION`
--

INSERT INTO `SM_FUNCTIONALITY_ACTION` (`sm_idFunction`,`sm_idAction`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(6, 3),
(7, 3),
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 4),
(7, 4),
(1, 5),
(2, 5),
(3, 5),
(4, 5),
(5, 5),
(6, 5),
(7, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SM_BUILDING`
--

CREATE TABLE IF NOT EXISTS `SM_BUILDING` (
  `sm_idBuilding` char(5) COLLATE utf8_spanish_ci NOT NULL,
  `sm_nameBuilding` varchar(225) COLLATE utf8_spanish_ci NOT NULL,
  `sm_addressBuilding` varchar(225) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sm_phoneBuilding` int(9) DEFAULT NULL,
  PRIMARY KEY (`sm_idBuilding`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `SM_BUILDING`
--

INSERT INTO `SM_BUILDING` (`sm_idBuilding`, `sm_nameBuilding`, `sm_addressBuilding`, `sm_phoneBuilding`) VALUES
('OSBI0', 'Biblioteca Universitaria Rosalía de Castro', 'Camino Seara B 4', 988387192);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SM_FLOOR`
--

CREATE TABLE IF NOT EXISTS `SM_FLOOR` (
  `sm_idBuilding` char(5) COLLATE utf8_spanish_ci NOT NULL,
  `sm_idFloor` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `sm_nameFloor` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `sm_planeFloor` varchar(500) COLLATE utf8_spanish_ci DEFAULT '',
  `sm_surfaceBuildingFloor` decimal(10,2) NOT NULL,
  `sm_surfaceUsefulFloor` decimal(10,2) NOT NULL,
  PRIMARY KEY (`sm_idFloor`,`sm_idBuilding`),
  KEY `idBuilding` (`sm_idBuilding`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `SM_FLOOR`
--

INSERT INTO `SM_FLOOR` (`sm_idBuilding`, `sm_idFloor`, `sm_nameFloor`, `sm_planeFloor`, `sm_surfaceBuildingFloor`, `sm_surfaceUsefulFloor`) VALUES
('OSBI0', '00', 'Planta Baixa', '../document/Buildings/OSBI0/OSBI000/Planta Baja.jpg', '1895.80', '1428.75'),
('OSBI0', '01', 'Primeira Planta', '../document/Buildings/OSBI0/OSBI001/Primera Planta.jpg', '818.30', '486.60'),
('OSBI0', '02', 'Segunda Planta', '../document/Buildings/OSBI0/OSBI002/Segunda, Tercera, Cuarta.jpg', '215.20', '181.25'),
('OSBI0', '03', 'Terceira Planta', '../document/Buildings/OSBI0/OSBI003/Segunda, Tercera, Cuarta.jpg', '214.80', '179.60'),
('OSBI0', '04', 'Cuarta Planta', '../document/Buildings/OSBI0/OSBI004/Segunda, Tercera, Cuarta.jpg', '215.20', '181.25'),
('OSBI0', 'S1', 'Soto -1', '', '1800.40', '894.20'),
('OSBI0', 'S2', 'Soto -2', '', '1338.40', '1226.70');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SM_FUNCTIONALITY`
--

CREATE TABLE IF NOT EXISTS `SM_FUNCTIONALITY` (
  `sm_idFunction` int(11) NOT NULL AUTO_INCREMENT,
  `sm_nameFunction` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `sm_descripFunction` varchar(225) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`sm_idFunction`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `SM_FUNCTIONALITY`
--

INSERT INTO `SM_FUNCTIONALITY` (`sm_idFunction`, `sm_nameFunction`, `sm_descripFunction`) VALUES
(1, 'USER', 'Actions on the set of users'),
(2, 'BUILDING', 'Actions on the set of buildings'),
(3, 'FLOOR', 'Actions on the set of floor'),
(4, 'SPACE', 'Actions on the set of spaces'),
(5, 'FUNCTIONALITY', 'Actions on the set of functionalities'),
(6, 'GROUP', 'Actions on the set of groups'),
(7, 'ACTION', 'Actions on the set of actions');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SM_GROUP`
--

CREATE TABLE IF NOT EXISTS `SM_GROUP` (
  `sm_idGroup` int(11) NOT NULL AUTO_INCREMENT,
  `sm_nameGroup` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `sm_descripGroup` varchar(225) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`sm_idGroup`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `SM_GROUP`
--

INSERT INTO `SM_GROUP` (`sm_idGroup`, `sm_nameGroup`, `sm_descripGroup`) VALUES
(1, 'ADMIN', 'System administrator');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SM_PERMISSION`
--

CREATE TABLE IF NOT EXISTS `SM_PERMISSION` (
  `sm_idGroup` int(11) NOT NULL,
  `sm_idFunction` int(11) NOT NULL,
  `sm_idAction` int(11) NOT NULL,
  PRIMARY KEY (`sm_idGroup`,`sm_idFunction`,`sm_idAction`),
  KEY `idFunction` (`sm_idFunction`),
  KEY `idAction` (`sm_idAction`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `SM_PERMISSION`
--

INSERT INTO `SM_PERMISSION` (`sm_idGroup`, `sm_idFunction`, `sm_idAction`) VALUES
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
(1, 5, 1),
(1, 5, 2),
(1, 5, 3),
(1, 5, 4),
(1, 5, 5),
(1, 6, 1),
(1, 6, 2),
(1, 6, 3),
(1, 6, 4),
(1, 6, 5),
(1, 7, 1),
(1, 7, 2),
(1, 7, 3),
(1, 7, 4),
(1, 7, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SM_SPACE`
--

CREATE TABLE IF NOT EXISTS `SM_SPACE` (
  `sm_idBuilding` char(5) COLLATE utf8_spanish_ci NOT NULL,
  `sm_idFloor` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `sm_idSpace` char(5) COLLATE utf8_spanish_ci NOT NULL,
  `sm_nameSpace` varchar(225) COLLATE utf8_spanish_ci NOT NULL,
  `sm_surfaceSpace` decimal(10,2) DEFAULT '0.00',
  `sm_numberInventorySpace` char(6) COLLATE utf8_spanish_ci DEFAULT '######',
  `sm_coordsPlane` varchar(225) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`sm_idFloor`,`sm_idBuilding`,`sm_idSpace`),
  KEY `idBuilding` (`sm_idBuilding`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `SM_SPACE`
--

INSERT INTO `SM_SPACE` (`sm_idBuilding`, `sm_idFloor`, `sm_idSpace`, `sm_nameSpace`, `sm_surfaceSpace`, `sm_numberInventorySpace`, `sm_coordsPlane`) VALUES
('OSBI0', '00', '00001', 'Escaleiras', '0.00', '######', ''),
('OSBI0', '00', '00002', 'Pasillo', '0.00', '######', ''),
('OSBI0', '00', '00003', 'Aseos', '0.00', '######', ''),
('OSBI0', '00', '00004', 'Aseos', '0.00', '######', ''),
('OSBI0', '00', '00005', 'Pasillo', '24.55', '######', ''),
('OSBI0', '00', '00007', 'Ascensor', '0.00', '######', ''),
('OSBI0', '00', '00008', 'Escaleiras', '0.00', '######', ''),
('OSBI0', '00', '00009', 'Grupo electróxeno', '11.50', '006743', ''),
('OSBI0', '00', '00010', 'Cadro Xeral', '5.65', '006744', ''),
('OSBI0', '00', '00011', 'Centro de transformación', '16.60', '006745', ''),
('OSBI0', '00', '00012', 'Alxibe', '9.50', '006746', ''),
('OSBI0', '00', '00013', 'Grupo de presión', '9.65', '006747', ''),
('OSBI0', '00', '00014', 'Sala de máquinas', '75.80', '006748', ''),
('OSBI0', '00', '00015', 'Pasillo', '34.45', '######', ''),
('OSBI0', '00', '00016', 'Pasillo', '127.15', '######', ''),
('OSBI0', '00', '00017', 'Pasillo', '0.00', '######', ''),
('OSBI0', '00', '00018', 'Depósito aberto', '90.15', '######', ''),
('OSBI0', '00', '00019', 'Sala de lectura', '273.15', '003754', ''),
('OSBI0', '00', '00020', 'Zona de prensa', '22.75', '######', ''),
('OSBI0', '00', '00021', 'Escaleiras', '12.35', '######', ''),
('OSBI0', '00', '00023', 'Ascensor', '0.00', '######', ''),
('OSBI0', '00', '00026', 'Escaleiras', '0.00', '######', ''),
('OSBI0', '00', '00027', 'Ascensor', '0.00', '######', ''),
('OSBI0', '00', '00028', 'Despacho de préstamos e devolucións', '53.10', '######', ''),
('OSBI0', '00', '00029', 'Sala de traballo', '16.60', '003752', ''),
('OSBI0', '00', '00030', 'Depósito TEBS', '15.20', '######', ''),
('OSBI0', '00', '00031', 'Pasillo', '0.00', '######', ''),
('OSBI0', '00', '00032', 'Pasillo', '0.00', '######', ''),
('OSBI0', '00', '00033', 'Despacho de Referencias', '19.40', '003751', ''),
('OSBI0', '00', '00034', 'Pasillo', '0.00', '######', ''),
('OSBI0', '00', '00035', 'Pasillo', '0.00', '######', ''),
('OSBI0', '00', '00036', 'Recepción', '18.70', '006728', ''),
('OSBI0', '00', '00037', 'Baños', '31.85', '######', ''),
('OSBI0', '00', '00038', 'Escaleiras', '0.00', '######', ''),
('OSBI0', '00', '00039', 'Sala de Referencias', '113.50', '003750', ''),
('OSBI0', '02', '00001', 'Escaleiras', '13.80', '######', ''),
('OSBI0', '02', '00002', 'Pasillo', '24.95', '######', ''),
('OSBI0', '02', '00003', 'Ascensor', '0.00', '######', ''),
('OSBI0', '02', '00005', 'Baño mulleres', '5.20', '######', ''),
('OSBI0', '02', '00006', 'Sala de audiovisuais', '137.30', '003745', ''),
('OSBI0', '03', '00001', 'Escaleiras', '13.80', '######', ''),
('OSBI0', '03', '00002', 'Pasillo', '23.00', '######', ''),
('OSBI0', '03', '00003', 'Ascensor', '0.00', '######', ''),
('OSBI0', '03', '00005', 'Baño homes', '5.20', '######', ''),
('OSBI0', '03', '00006', 'Sala de informática', '137.65', '003744', ''),
('OSBI0', '04', '00001', 'Escaleiras', '13.80', '######', ''),
('OSBI0', '04', '00002', 'Pasillo', '28.30', '######', ''),
('OSBI0', '04', '00003', 'Ascensor', '0.00', '######', ''),
('OSBI0', '04', '00005', 'Baño mulleres', '5.20', '######', ''),
('OSBI0', '04', '00006', 'Sala de usos múltiples', '133.90', '003743', ''),
('OSBI0', 'S1', '00001', 'Baños', '23.23', '######', ''),
('OSBI0', 'S1', '00002', 'Pasillo', '26.70', '######', ''),
('OSBI0', 'S1', '00004', 'Ascensor', '0.00', '######', ''),
('OSBI0', 'S1', '00005', 'Escaleiras', '6.70', '######', ''),
('OSBI0', 'S1', '00006', 'Sala de estudio', '171.00', '006740', ''),
('OSBI0', 'S1', '00007', 'Escaleiras', '0.00', '######', ''),
('OSBI0', 'S1', '00008', 'Escaleiras', '0.00', '######', ''),
('OSBI0', 'S1', '00009', 'Pasillo', '0.00', '######', ''),
('OSBI0', 'S1', '00010', 'Pasillo', '0.00', '######', ''),
('OSBI0', 'S1', '00011', 'Ascensor', '0.00', '######', ''),
('OSBI0', 'S1', '00012', 'Depósito', '291.20', '003749', ''),
('OSBI0', 'S1', '00014', 'Almacén limpieza', '14.50', '006738', ''),
('OSBI0', 'S1', '00015', 'Almacén biblioteca', '73.95', '006739', ''),
('OSBI0', 'S1', '00017', 'Ascensor', '0.00', '######', ''),
('OSBI0', 'S1', '00018', 'Pasillo', '64.80', '######', ''),
('OSBI0', 'S1', '00019', 'RACK', '25.60', '003748', ''),
('OSBI0', 'S2', '00001', 'Baños', '23.25', '######', ''),
('OSBI0', 'S2', '00002', 'Pasillo', '30.85', '######', ''),
('OSBI0', 'S2', '00004', 'Ascensor', '0.00', '######', ''),
('OSBI0', 'S2', '00005', 'Escaleiras', '0.00', '######', ''),
('OSBI0', 'S2', '00006', 'Escaleiras', '0.00', '######', ''),
('OSBI0', 'S2', '00007', 'Vestíbulo', '3.10', '######', ''),
('OSBI0', 'S2', '00008', 'Depósito Hemeroteca', '119.43', '003741', ''),
('OSBI0', 'S2', '00009', 'Hemeroteca', '270.82', '006741', ''),
('OSBI0', 'S2', '00010', 'Deposito aberto', '103.47', '######', ''),
('OSBI0', 'S2', '00011', 'Zona de consulta', '126.74', '######', ''),
('OSBI0', 'S2', '00012', 'Sala de lectura', '314.77', '######', ''),
('OSBI0', 'S2', '00013', 'Escaleiras', '0.00', '######', ''),
('OSBI0', 'S2', '00015', 'Ascensor', '0.00', '######', ''),
('OSBI0', 'S2', '00016', 'Pasillo', '41.52', '######', ''),
('OSBI0', 'S2', '00017', 'Escaleiras', '0.00', '######', ''),
('OSBI0', 'S2', '00018', 'Sala técnica do ascensor', '18.20', '003747', ''),
('OSBI0', 'S2', '00020', 'Escaleiras', '0.00', '######', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SM_USER`
--

CREATE TABLE IF NOT EXISTS `SM_USER` (
  `sm_photo` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `sm_username` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `sm_passwd` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `sm_name` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `sm_surname` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `sm_dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `sm_birthdate` date NOT NULL,
  `sm_email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `sm_phone` int(9) DEFAULT NULL,
  PRIMARY KEY (`sm_username`),
  UNIQUE KEY `dni` (`sm_dni`),
  UNIQUE KEY `email` (`sm_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `SM_USER`
--

INSERT INTO `SM_USER` (`sm_photo`, `sm_username`, `sm_passwd`, `sm_name`, `sm_surname`, `sm_dni`, `sm_birthdate`, `sm_email`, `sm_phone`) VALUES
('../document/Users/admin/ivan.jpg', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Iván', 'de Dios Fernández', '44488795X', '1994-03-26', 'ivanddf1994@hotmail.com', 617129241);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SM_USER_GROUP`
--

CREATE TABLE IF NOT EXISTS `SM_USER_GROUP` (
  `sm_username` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `sm_idGroup` int(11) NOT NULL,
  PRIMARY KEY (`sm_username`,`sm_idGroup`),
  KEY `idGroup` (`sm_idGroup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `SM_USER_GROUP`
--

INSERT INTO `SM_USER_GROUP` (`sm_username`, `sm_idGroup`) VALUES
('admin', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `IM_FUNCTIONALITY_ACTION`
--
ALTER TABLE `IM_FUNCTIONALITY_ACTION`
   ADD CONSTRAINT `IM_FUNCTIONALITY_ACTION_ibfk_1` FOREIGN KEY (`im_idAction`) REFERENCES `IM_ACTION` (`im_idAction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `IM_FUNCTIONALITY_ACTION_ibfk_2` FOREIGN KEY (`im_idFunction`) REFERENCES `IM_FUNCTIONALITY` (`im_idFunction`) ON DELETE CASCADE ON UPDATE CASCADE;
--
-- Filtros para la tabla `IM_NOTIFICATION`
--
ALTER TABLE `IM_NOTIFICATION`
  ADD CONSTRAINT `Incidence` FOREIGN KEY (`im_idIncidence`) REFERENCES `IM_INCIDENCE` (`im_idIncidence`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `username` FOREIGN KEY (`im_username`) REFERENCES `IM_USER` (`im_username`);

--
-- Filtros para la tabla `IM_PERMISSION`
--
ALTER TABLE `IM_PERMISSION`
  ADD CONSTRAINT `IM_PERMISSION_ibfk_1` FOREIGN KEY (`im_idGroup`) REFERENCES `IM_GROUP` (`im_idGroup`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `IM_PERMISSION_ibfk_2` FOREIGN KEY (`im_idFunction`) REFERENCES `IM_FUNCTIONALITY` (`im_idFunction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `IM_PERMISSION_ibfk_3` FOREIGN KEY (`im_idAction`) REFERENCES `IM_ACTION` (`im_idAction`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `IM_USER_GROUP`
--
ALTER TABLE `IM_USER_GROUP`
  ADD CONSTRAINT `GROUP` FOREIGN KEY (`im_idGroup`) REFERENCES `IM_GROUP` (`im_idGroup`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `USER` FOREIGN KEY (`im_username`) REFERENCES `IM_USER` (`im_username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `SM_FUNCTIONALITY_ACTION`
--
ALTER TABLE `SM_FUNCTIONALITY_ACTION`
  ADD CONSTRAINT `SM_FUNCTIONALITY_ACTION_ibfk_1` FOREIGN KEY (`sm_idFunction`) REFERENCES `SM_FUNCTIONALITY` (`sm_idFunction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SM_FUNCTIONALITY_ACTION_ibfk_2` FOREIGN KEY (`sm_idAction`) REFERENCES `SM_ACTION` (`sm_idAction`) ON DELETE CASCADE ON UPDATE CASCADE;
  

--
-- Filtros para la tabla `SM_FLOOR`
--
ALTER TABLE `SM_FLOOR`
  ADD CONSTRAINT `SM_FLOOR_ibfk_1` FOREIGN KEY (`sm_idBuilding`) REFERENCES `SM_BUILDING` (`sm_idBuilding`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `SM_PERMISSION`
--
ALTER TABLE `SM_PERMISSION`
  ADD CONSTRAINT `SM_PERMISSION_ibfk_1` FOREIGN KEY (`sm_idGroup`) REFERENCES `SM_GROUP` (`sm_idGroup`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SM_PERMISSION_ibfk_2` FOREIGN KEY (`sm_idFunction`) REFERENCES `SM_FUNCTIONALITY` (`sm_idFunction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SM_PERMISSION_ibfk_3` FOREIGN KEY (`sm_idAction`) REFERENCES `SM_ACTION` (`sm_idAction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SM_PERMISSION_ibfk_4` FOREIGN KEY (`sm_idFunction`) REFERENCES `SM_FUNCTIONALITY_ACTION` (`sm_idFunction`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `SM_SPACE`
--
ALTER TABLE `SM_SPACE`
  ADD CONSTRAINT `SM_SPACE_ibfk_1` FOREIGN KEY (`sm_idBuilding`) REFERENCES `SM_BUILDING` (`sm_idBuilding`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SM_SPACE_ibfk_2` FOREIGN KEY (`sm_idFloor`) REFERENCES `SM_FLOOR` (`sm_idFloor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `SM_USER_GROUP`
--
ALTER TABLE `SM_USER_GROUP`
  ADD CONSTRAINT `SM_USER_GROUP_ibfk_1` FOREIGN KEY (`sm_username`) REFERENCES `SM_USER` (`sm_username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SM_USER_GROUP_ibfk_2` FOREIGN KEY (`sm_idGroup`) REFERENCES `SM_GROUP` (`sm_idGroup`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
