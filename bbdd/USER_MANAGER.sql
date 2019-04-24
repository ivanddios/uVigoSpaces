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
  `im_email` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `im_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `im_updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`im_idIncidence`),
  KEY `email` (`im_email`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `IM_INCIDENCE`
--

INSERT INTO `IM_INCIDENCE` (`im_idIncidence`, `im_title`, `im_description`, `im_idLocation`, `im_images`, `im_okInfraResp`, `im_priority`, `im_budget`, `im_amount`, `im_authorization`, `im_finished`, `im_email`, `im_created_at`, `im_updated_at`) VALUES
(1, 'prueba', 'wewewewewea', 1, '', 0, 0, '0', 0, 0, 0, 'ivanddf1994@hotmail.com', '2019-03-20 15:46:48', '2019-03-20 15:46:48'),
(6, 'prueba2', 'wewewe', 1, '', 0, 0, '0', 0, 0, 0, 'pepe', '2019-03-20 15:37:39', '0000-00-00 00:00:00'),
(7, 'prueba', '3', 1, '', 0, 0, '0', 0, 0, 1, 'ivanddf1994@hotmail.com', '2019-03-20 15:37:39', '0000-00-00 00:00:00'),
(9, 'prueba', '4', 1, '', 0, 0, '0', 0, 0, 0, 'ivanddf1994@hotmail.com', '2019-03-20 15:37:39', '0000-00-00 00:00:00'),
(24, 'prueba', 'prueba', 2, 'IncidencesFiles/24/', 0, 0, '0', 0, 0, 0, 'ivanddf1994@hotmail.com', '2019-04-04 15:26:00', '0000-00-00 00:00:00'),
(26, 'prueba', 'prueba', 1, '', 0, 0, '0', 0, 0, 0, 'ivanddf1994@hotmail.com', '2019-04-04 15:35:03', '0000-00-00 00:00:00'),
(33, 'p1', 'p1', 1, '../IncidencesFiles/33/images/', 0, 0, '0', 0, 0, 0, 'ivanddf1994@hotmail.com', '2019-04-04 20:44:21', '0000-00-00 00:00:00'),
(34, '35', '35', 3, '../IncidencesFiles/34/images/', 0, 0, '0', 0, 0, 0, 'ivanddf1994@hotmail.com', '2019-04-08 12:57:27', '0000-00-00 00:00:00'),
(35, 'p35', '35', 1, '../IncidencesFiles/35/images', 0, 0, '0', 0, 0, 0, 'ivanddf1994@hotmail.com', '2019-04-08 15:16:22', '0000-00-00 00:00:00'),
(36, 'prueba', 'p', 1, '../IncidencesFiles/36/images', 0, 0, '../IncidencesFiles/36/docs', 0, 0, 0, 'ivanddf1994@hotmail.com', '2019-04-08 16:24:24', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `IM_NOTIFICATION`
--

CREATE TABLE IF NOT EXISTS `IM_NOTIFICATION` (
  `im_idNotification` int(11) NOT NULL AUTO_INCREMENT,
  `im_idIncidence` int(11) NOT NULL,
  `im_email` varchar(25) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`im_idNotification`),
  KEY `Incidence` (`im_idIncidence`),
  KEY `email` (`im_email`)
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
  `im_email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`im_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `IM_USER`
--

INSERT INTO `IM_USER` (`im_email`) VALUES
('ivanddf1994@hotmail.com'),
('info@responsable.es');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `IM_USER_GROUP`
--

CREATE TABLE IF NOT EXISTS `IM_USER_GROUP` (
  `im_email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `im_idGroup` int(11) NOT NULL,
  PRIMARY KEY (`im_email`,`im_idGroup`),
  KEY `GROUP` (`im_idGroup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `IM_USER_GROUP`
--

INSERT INTO `IM_USER_GROUP` (`im_email`, `im_idGroup`) VALUES
('ivanddf1994@hotmail.com', 1),
('ivanddf1994@hotmail.com', 3);

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
(5, 'SHOW', 'Action to show content to an entity'),
(6, 'SEARCH', 'Action to search by any field for an entity');

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
(7, 5),
(1, 6);

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
('OSBI0', 'Biblioteca Universitaria Rosalía de Castro', 'Camino Seara B 4', 988387192),
('OSFE0', 'Edificio de Ferro', 'Campus As Lagoas, Edificio de Ferro', 988387101),
('OSPO0', 'Edificio Politécnico ', 'Edificio Politécnico s/n', 988387000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SM_FLOOR`
--

CREATE TABLE IF NOT EXISTS `SM_FLOOR` (
  `sm_idBuilding` char(5) COLLATE utf8_spanish_ci NOT NULL,
  `sm_idFloor` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `sm_nameFloor` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `sm_planFloor` varchar(500) COLLATE utf8_spanish_ci DEFAULT '',
  `sm_surfaceBuildingFloor` decimal(10,2) NOT NULL,
  `sm_surfaceUsefulFloor` decimal(10,2) NOT NULL,
  PRIMARY KEY (`sm_idFloor`,`sm_idBuilding`),
  KEY `idBuilding` (`sm_idBuilding`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `SM_FLOOR`
--

INSERT INTO `SM_FLOOR` (`sm_idBuilding`, `sm_idFloor`, `sm_nameFloor`, `sm_planFloor`, `sm_surfaceBuildingFloor`, `sm_surfaceUsefulFloor`) VALUES
('OSBI0', '00', 'Planta Baixa', '../document/Buildings/OSBI0/OSBI000/Planta Baja.jpg', '1895.80', '1428.75'),
('OSPO0', '00', 'Planta Baixa', '../document/Buildings/OSPO0/OSPO000/Poli.PlantaBaja_page-0001.jpg', '3200.00', '29.45'),
('OSBI0', '01', 'Primeira Planta', '../document/Buildings/OSBI0/OSBI001/Primera Planta.jpg', '818.30', '486.60'),
('OSBI0', '02', 'Segunda Planta', '../document/Buildings/OSBI0/OSBI002/Segunda, Tercera, Cuarta.jpg', '215.20', '181.25'),
('OSBI0', '03', 'Terceira Planta', '../document/Buildings/OSBI0/OSBI003/Segunda, Tercera, Cuarta.jpg', '214.80', '179.60'),
('OSBI0', '04', 'Cuarta Planta', '../document/Buildings/OSBI0/OSBI004/Segunda, Tercera, Cuarta.jpg', '215.20', '181.25'),
('OSBI0', 'S1', 'Soto -1', '', '1800.40', '894.20'),
('OSFE0', 'S1', 'Soto -1', '../document/Buildings/OSFE0/OSFE0S1/Ferro.Sotano1_page-0001.jpg', '1867.45', '1662.35'),
('OSPO0', 'S1', 'Soto -1', '../document/Buildings/OSPO0/OSPO0S1/Poli.Sotano1_page-0001.jpg', '2362.90', '1966.05'),
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
(1, 1, 6),
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
  `sm_coordsplan` varchar(5000) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`sm_idFloor`,`sm_idBuilding`,`sm_idSpace`),
  KEY `idBuilding` (`sm_idBuilding`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `SM_SPACE`
--

INSERT INTO `SM_SPACE` (`sm_idBuilding`, `sm_idFloor`, `sm_idSpace`, `sm_nameSpace`, `sm_surfaceSpace`, `sm_numberInventorySpace`, `sm_coordsplan`) VALUES
('OSBI0', '00', '00001', 'Escaleiras', '0.00', '######', '442 590, 538 590, 536 661, 440 663'),
('OSBI0', '00', '00002', 'Pasillo', '0.00', '######', '464 389, 464 487, 272 488, 273 389'),
('OSBI0', '00', '00003', 'Aseos', '0.00', '######', '191 552, 255 553, 250 665, 188 667'),
('OSBI0', '00', '00004', 'Aseos', '0.00', '######', '256 582, 317 582, 315 666, 256 667'),
('OSBI0', '00', '00005', 'Pasillo', '24.55', '######', '441 665, 320 666, 323 503, 462 502, 460 588, 442 589'),
('OSBI0', '00', '00007', 'Ascensor', '0.00', '######', '461 536, 539 537, 538 589, 460 588'),
('OSBI0', '00', '00008', 'Escaleiras', '0.00', '######', '386 489, 272 490, 272 441, 385 444'),
('OSBI0', '00', '00009', 'Grupo electróxeno', '11.50', '006743', '541 345, 638 345, 636 440, 539 439, 538 431, 533 433, 532 396, 539 394'),
('OSBI0', '00', '00010', 'Cadro Xeral', '5.65', '006744', '643 343, 691 345, 690 439, 641 440'),
('OSBI0', '00', '00011', 'Centro de transformación', '16.60', '006745', '838 440, 743 440, 694 440, 696 345, 839 344'),
('OSBI0', '00', '00012', 'Alxibe', '9.50', '006746', '845 346, 926 346, 925 438, 843 440'),
('OSBI0', '00', '00013', 'Grupo de presión', '9.65', '006747', '930 345, 1073 345, 1070 438, 976 441, 929 441'),
('OSBI0', '00', '00014', 'Sala de máquinas', '75.80', '006748', '1077 344, 1486 346, 1484 493, 1117 493, 1117 448, 1075 447'),
('OSBI0', '00', '00015', 'Pasillo', '34.45', '######', '1048 495, 467 494, 461 482, 463 447, 1048 445'),
('OSBI0', '00', '00016', 'Pasillo', '127.15', '######', '1503 607, 538 606, 536 673, 570 677, 615 682, 812 684, 812 672, 891 675, 891 684, 1130 684, 1130 671, 1501 676'),
('OSBI0', '00', '00017', 'Pasillo', '0.00', '003753', ''),
('OSBI0', '00', '00018', 'Depósito aberto', '90.15', '######', '646 521, 647 565, 901 563, 903 590, 947 590, 948 568, 1217 561, 1218 589, 1249 589, 1248 566, 1485 565, 1487 518'),
('OSBI0', '00', '00019', 'Sala de lectura', '273.15', '003754', '811 684, 572 682, 559 1350, 835 1352, 837 1294, 1091 1291, 1093 1209, 803 1207'),
('OSBI0', '00', '00020', 'Zona de prensa', '22.75', '######', '890 682, 1127 681, 1128 726, 891 728'),
('OSBI0', '00', '00021', 'Escaleiras', '12.35', '######', '1550 514, 1638 513, 1637 550, 1646 549, 1646 585, 1548 587'),
('OSBI0', '00', '00023', 'Ascensor', '0.00', '######', '1717 502, 1770 502, 1770 555, 1719 556'),
('OSBI0', '00', '00026', 'Escaleiras', '0.00', '######', '1334 677, 1448 676, 1446 744, 1329 743'),
('OSBI0', '00', '00027', 'Ascensor', '0.00', '######', '1508 696, 1555 697, 1555 756, 1507 756'),
('OSBI0', '00', '00028', 'Despacho de préstamos e devolucións', '53.10', '######', '1779 521, 1777 561, 1775 580, 1801 581, 2055 579, 2055 520'),
('OSBI0', '00', '00029', 'Sala de traballo', '16.60', '003752', '2058 520, 2144 519, 2143 653, 2072 654, 2073 580, 2057 578'),
('OSBI0', '00', '00030', 'Depósito TEBS', '15.20', '######', '2146 521, 2215 520, 2213 653, 2145 654'),
('OSBI0', '00', '00031', 'Pasillo', '0.00', '######', ''),
('OSBI0', '00', '00032', 'Pasillo', '0.00', '######', ''),
('OSBI0', '00', '00033', 'Despacho de Referencias', '19.40', '003751', '1707 682, 1798 681, 1797 827, 1704 827'),
('OSBI0', '00', '00034', 'Pasillo', '0.00', '######', ''),
('OSBI0', '00', '00035', 'Pasillo', '0.00', '######', ''),
('OSBI0', '00', '00036', 'Recepción', '18.70', '006728', '1802 681, 1869 682, 1871 829, 1799 828'),
('OSBI0', '00', '00037', 'Baños', '31.85', '######', '2059 674, 2223 671, 2223 838, 2056 840'),
('OSBI0', '00', '00038', 'Escaleiras', '0.00', '######', ''),
('OSBI0', '00', '00039', 'Sala de Referencias', '113.50', '003750', '1695 750, 1580 750, 1575 835, 1520 836, 1515 1241, 1690 1241'),
('OSBI0', '00', '90000', 'Entrada', '34.14', '######', '2054 846, 2220 846, 2220 1016, 2056 1016'),
('OSBI0', '00', '90001', 'Vestíbulo', '107.55', '######', '1705 844, 1705 925, 1692 928, 1693 1006, 1821 1008, 1821 1017, 2051 1016, 2054 835, 1888 835, 1888 847'),
('OSBI0', '00', '90002', 'Referencia', '216.00', '######', '1324 743, 1444 742, 1446 763, 1492 763, 1493 835, 1386 836, 1385 886, 1440 888, 1436 1351, 1314 1352, 1314 1208, 1180 1205, 1179 1188, 1200 1188, 1205 770, 1322 771'),
('OSPO0', '00', '90001', 'Despacho Decano de Ciencias', '32.65', '######', '173 464, 248 463, 250 632, 169 634'),
('OSPO0', '00', '90002', 'Secretaría Dirección', '21.90', '######', '250 463, 323 464, 323 580, 251 581'),
('OSPO0', '00', '90003', 'Despacho asuntos económicos Ciencias', '17.00', '######', '327 464, 387 464, 387 582, 324 581'),
('OSPO0', '00', '90004', 'Administración Ciencias', '29.85', '######', '389 465, 487 464, 487 580, 389 579'),
('OSPO0', '00', '90005', 'Pasillo', '30.90', '######', '251 583, 487 581, 487 635, 249 632'),
('OSPO0', '00', '90006', 'Salón de Grados', '88.35', '######', '176 637, 487 634, 487 745, 175 744'),
('OSPO0', '00', '90007', 'Sala de Xuntas', '27.95', '######', '495 385, 573 384, 573 519, 491 519'),
('OSPO0', '00', '90008', 'Sala de Estudio', '114.20', '######', '576 383, 807 383, 807 569, 555 571, 553 521, 574 521'),
('OSPO0', '00', '90009', 'Distruibuidor', '17.35', '######', '490 522, 490 592, 489 632, 494 633, 494 657, 530 658, 530 572, 555 570, 554 520'),
('OSPO0', '00', '90010', 'Escaleiras', '23.25', '######', '625 573, 626 616, 619 615, 620 688, 532 688, 532 574'),
('OSPO0', '00', '90011', 'Vestíbulo/Ascensores', '19.15', '######', '627 574, 626 616, 618 615, 620 687, 725 689, 723 573'),
('OSPO0', '00', '90012', 'Fotocopiadora', '24.75', '######', '725 573, 807 573, 807 688, 725 689'),
('OSPO0', '00', '90013', 'Aseo homes', '29.05', '######', '813 464, 883 464, 883 573, 893 574, 893 625, 815 627'),
('OSPO0', '00', '90014', 'Aseo mulleres', '33.70', '######', '884 464, 972 464, 973 628, 895 625, 896 575, 884 573'),
('OSPO0', '00', '90015', 'Vestíbulo aseo homes', '3.50', '######', '814 627, 843 627, 845 669, 814 670'),
('OSPO0', '00', '90016', 'Aseo minusválidos', '6.65', '######', '844 627, 908 627, 909 670, 844 670'),
('OSPO0', '00', '90017', 'Almacén', '3.35', '######', '908 628, 940 627, 941 670, 910 671'),
('OSPO0', '00', '90018', 'Vestíbulo aseo mulleres', '3.30', '######', '943 628, 971 628, 972 670, 943 671'),
('OSPO0', '00', '90019', 'Aula B1', '85.55', '######', '976 464, 1132 464, 1131 680, 1020 680, 1020 669, 977 670'),
('OSPO0', '00', '90020', 'Aula B2', '86.00', '######', '1134 464, 1291 463, 1291 671, 1247 669, 1245 681, 1135 682'),
('OSPO0', '00', '90021', 'Aula B3', '78.30', '######', '1294 464, 1450 464, 1451 663, 1340 662, 1340 650, 1294 651'),
('OSPO0', '00', '90022', 'Aula B4', '78.70', '######', '1453 465, 1611 465, 1610 651, 1566 649, 1567 664, 1454 664'),
('OSPO0', '00', '90023', 'Aula B5', '172.90', '######', '1614 464, 1928 465, 1926 670, 1886 670, 1885 682, 1659 680, 1659 669, 1614 669'),
('OSPO0', '00', '90024', 'Cafetería', '219.30', '######', '1930 464, 2406 464, 2405 603, 2168 604, 2166 684, 1933 683'),
('OSPO0', '00', '90025', 'Cociña', '48.40', '######', '2168 607, 2354 606, 2355 721, 2251 722, 2251 685, 2169 685'),
('OSPO0', '00', '90026', 'Almacén', '14.30', '######', '2356 605, 2406 605, 2406 720, 2357 721'),
('OSPO0', '00', '90027', 'Pasillo central', '406.70', '######', '814 670, 971 672, 1014 670, 1015 688, 1253 688, 1253 671, 1289 671, 1295 670, 1295 653, 1334 651, 1334 669, 1571 669, 1573 652, 1609 652, 1610 670, 1655 670, 1654 688, 1890 687, 1890 670, 1926 670, 1927 686, 2050 686, 2244 688, 2245 727, 2253 727, 2251 766, 1841 768, 1839 836, 1764 838, 1766 830, 1705 830, 1714 755, 1714 748, 1194 749, 1194 1269, 1238 1268, 1239 1356, 1133 1356, 1134 750, 816 749'),
('OSPO0', '00', '90028', 'Escaleiras', '28.55', '######', '1769 829, 1806 829, 1806 840, 1877 841, 1877 949, 1769 949'),
('OSPO0', '00', '90029', 'Almacén Marie Curie', '34.55', '######', '1361 755, 1362 784, 1335 787, 1231 892, 1232 918, 1202 918, 1200 755'),
('OSPO0', '00', '90030', 'Aula Magna 1 - Salón Marie Curie ', '260.80', '######', '1380 755, 1361 756, 1361 786, 1336 786, 1232 894, 1232 920, 1199 919, 1201 1141, 1308 1123, 1377 1093, 1442 1052, 1499 992, 1547 912, 1571 836, 1581 755, 1418 753'),
('OSPO0', '00', '90031', 'Aula Magna 2 - Extrato alto', '229.20', '######', '1199 1265, 1233 1264, 1296 1253, 1365 1234, 1419 1213, 1465 1188, 1521 1146, 1573 1097, 1617 1040, 1661 966, 1682 910, 1696 852, 1705 788, 1707 755, 1581 755, 1577 815, 1566 856, 1556 889, 1533 942, 1501 990, 1458 1039, 1397 1084, 1317 1122, 1201 1143'),
('OSPO0', '00', '90032', 'Escaleiras', '29.30', '######', '1195 1358, 1197 1480, 1309 1480, 1309 1366, 1239 1368, 1240 1356'),
('OSPO0', '00', '90033', 'Vestíbulo Péndulo', '325.60', '######', '530 658, 494 658, 493 749, 497 762, 491 770, 490 790, 547 790, 547 1031, 491 1031, 489 1049, 495 1056, 495 1129, 529 1129, 808 1128, 808 1120, 815 1118, 814 1070, 814 749, 814 696, 807 696, 807 688, 682 690, 530 689'),
('OSPO0', '00', '90034', 'Vestíbulo Previo', '35.30', '######', '491 792, 547 792, 547 1032, 490 1031'),
('OSPO0', '00', '90035', 'Conserxería', '25.75', '######', '724 1130, 808 1129, 807 1247, 724 1248'),
('OSPO0', '00', '90036', 'Vestíbulo Ascensores', '23.60', '######', '621 1129, 725 1129, 725 1249, 627 1247, 627 1208, 575 1206, 575 1169, 622 1169'),
('OSPO0', '00', '90037', 'Escaleiras', '23.15', '######', '529 1128, 530 1249, 627 1248, 628 1207, 574 1207, 573 1168, 622 1168, 621 1130'),
('OSPO0', '00', '90038', 'Aseo', '5.50', '######', '744 1250, 807 1250, 807 1285, 741 1284'),
('OSPO0', '00', '90039', 'Pasillo', '25.85', '######', '497 1130, 530 1129, 530 1248, 745 1250, 746 1285, 489 1283, 488 1213, 498 1213'),
('OSPO0', '00', '90040', 'Almacén', '18.30', '######', '722 1286, 808 1287, 809 1367, 721 1367'),
('OSPO0', '00', '90041', 'Asuntos Económicos Informática', '17.70', '######', '634 1285, 719 1286, 719 1368, 632 1368'),
('OSPO0', '00', '90042', 'Secretario Informática', '25.55', '######', '507 1287, 633 1288, 632 1368, 510 1369'),
('OSPO0', '00', '90043', 'Administración Informática', '44.35', '######', '331 1210, 488 1210, 488 1284, 508 1286, 509 1314, 467 1313, 467 1321, 332 1320'),
('OSPO0', '00', '90044', 'Despacho Decano de Informática', '32.75', '######', '210 1212, 330 1210, 331 1319, 208 1319'),
('OSPO0', '00', '90045', 'Secretaria Informática', '28.20', '######', '209 1120, 340 1121, 341 1171, 342 1185, 325 1208, 210 1210'),
('OSPO0', '00', '90046', 'Vestíbulo Informática', '43.35', '######', '341 1121, 494 1122, 494 1211, 327 1211, 343 1185'),
('OSBI0', '01', '00001', 'Climatización', '35.26', '######', '265 1101, 625 1098, 621 1462, 259 1466'),
('OSBI0', '01', '00002', 'Vestíbulo', '16.50', '######', '655 1117, 818 1118, 820 1285, 763 1285, 760 1364, 869 1367, 867 1438, 650 1445'),
('OSBI0', '01', '00003', 'Ascensor', '0.00', '######', '837 1187, 956 1187, 956 1278, 837 1278'),
('OSBI0', '01', '00004', 'Escaleiras', '29.70', '######', '446 804, 670 801, 670 885, 447 889, 446 1001, 665 1001, 669 1086, 443 1088, 284 1089, 287 802'),
('OSBI0', '01', '00005', 'Escaleiras', '3.95', '######', '765 1292, 955 1290, 955 1357, 766 1359'),
('OSBI0', '01', '00006', 'Cociña', '7.75', '######', '1175 1098, 1392 1096, 1393 1241, 1179 1243'),
('OSBI0', '01', '00007', 'Cafetería', '134.95', '######', '1178 1246, 1174 1440, 2554 1440, 2560 1093, 2341 1091, 1395 1099, 1394 1244'),
('OSBI0', '01', '00008', 'Vestíbulo cafetría', '20.20', '######', '979 1116, 1163 1115, 1159 1243, 1175 1245, 1171 1439, 956 1443, 957 1290, 975 1289'),
('OSBI0', '01', '00009', 'Escaleiras', '13.25', '######', '2902 1129, 3182 1132, 3181 1284, 2901 1282'),
('OSBI0', '01', '00010', 'Vestíbulo', '29.35', '######', '2888 1285, 2886 1432, 2907 1435, 2908 1479, 2927 1479, 2926 1496, 3003 1496, 3003 1476, 3055 1478, 3057 1499, 3158 1504, 3158 1435, 3307 1433, 3309 1129, 3182 1128, 3182 1282'),
('OSBI0', '01', '00011', 'Ascensor', '0.00', '######', '2906 1498, 3000 1496, 3001 1615, 2907 1614'),
('OSBI0', '01', '00013', 'Aseos', '5.70', '######', '3157 1444, 3264 1442, 3263 1625, 3157 1623'),
('OSBI0', '01', '00014', 'Aseos', '3.50', '######', '3057 1503, 3150 1504, 3148 1622, 3053 1624'),
('OSBI0', '01', '00015', 'Ascensor', '0.00', '######', '3325 1110, 3428 1110, 3429 1213, 3323 1214'),
('OSBI0', '01', '00016', 'Área de traballo', '46.75', '######', '3476 1134, 3474 1257, 3443 1260, 3442 1224, 3313 1226, 3310 1431, 3322 1433, 3321 1446, 3648 1446, 3648 1430, 4012 1429, 4098 1428, 4102 1132'),
('OSBI0', '01', '00017', 'Administración e xestión económica', '14.05', '######', '4111 1133, 4336 1133, 4336 1297, 4107 1298'),
('OSBI0', '01', '00018', 'Despacho de proceso técnico', '14.05', '######', '4108 1307, 4334 1306, 4333 1502, 4104 1498'),
('OSBI0', '01', '00019', 'Despacho de subdirección', '14.05', '######', '4104 1505, 4103 1702, 4330 1702, 4333 1506'),
('OSBI0', '01', '00020', 'Despacho de subdirección de adquisicións', '14.25', '######', '4103 1710, 4331 1712, 4330 1906, 4100 1905'),
('OSBI0', '01', '00022', 'Sala de reunións', '28.40', '######', '3876 1912, 4326 1913, 4325 2115, 3872 2117'),
('OSBI0', '01', '00023', 'Dirección', '22.25', '######', '3646 1792, 3871 1793, 3866 2115, 3638 2118'),
('OSBI0', '01', '00024', 'Pasillo/Circulacións', '45.55', '######', '3875 1794, 3873 1908, 4094 1907, 4098 1431, 4012 1430, 4008 1791'),
('OSBI0', '01', '90001', 'Escaleiras', '2.05', '######', '869 1365, 956 1367, 954 1443, 870 1445'),
('OSBI0', '02', '00001', 'Escaleiras', '13.80', '######', '1211 693, 1393 694, 1393 802, 1210 803'),
('OSBI0', '02', '00002', 'Pasillo', '24.95', '######', '1394 694, 1448 691, 1447 807, 1459 806, 1458 878, 1447 880, 1446 931, 1397 930, 1396 904, 1323 904, 1319 931, 1209 931, 1207 882, 1195 881, 1195 808, 1208 807, 1208 799, 1394 801'),
('OSBI0', '02', '00003', 'Ascensor', '0.00', '######', '1207 945, 1269 946, 1271 1024, 1206 1024'),
('OSBI0', '02', '00005', 'Baño mulleres', '5.20', '######', '1323 907, 1391 911, 1391 1029, 1324 1031'),
('OSBI0', '02', '00006', 'Sala de audiovisuais', '137.30', '003745', '1398 933, 1395 1034, 1317 1037, 1316 1146, 1194 1146, 1184 1835, 1451 1833, 1460 933'),
('OSBI0', '03', '00001', 'Escaleiras', '13.80', '######', '2409 692, 2592 694, 2589 801, 2404 799'),
('OSBI0', '03', '00002', 'Pasillo', '23.00', '######', '2591 692, 2646 690, 2642 905, 2523 904, 2517 929, 2407 931, 2406 800, 2590 798'),
('OSBI0', '03', '00004', 'Ascensor', '0.00', '######', '2404 943, 2465 945, 2466 1024, 2404 1024'),
('OSBI0', '03', '00005', 'Baño homes', '5.20', '######', '2520 906, 2591 906, 2592 1033, 2518 1034'),
('OSBI0', '03', '00006', 'Sala de informática', '137.65', '003744', '2594 906, 2592 1034, 2389 1035, 2378 1830, 2646 1831, 2642 904'),
('OSBI0', '04', '00001', 'Escaleiras', '13.80', '######', '2803 690, 2987 690, 2986 799, 2800 800'),
('OSBI0', '04', '00002', 'Pasillo', '28.30', '######', '2788 808, 2788 877, 2801 879, 2800 931, 2919 929, 2915 903, 2984 906, 2990 906, 2989 1029, 3037 1032, 3037 877, 3050 878, 3052 806, 3039 806, 3042 684, 2987 682, 2987 801, 2802 797, 2802 808'),
('OSBI0', '04', '00004', 'Ascensor', '0.00', '######', '2799 943, 2863 942, 2864 1021, 2799 1021'),
('OSBI0', '04', '00005', 'Baño mulleres', '5.20', '######', '2917 906, 2987 906, 2988 1032, 2917 1034'),
('OSBI0', '04', '00006', 'Sala de usos múltiples', '133.90', '003743', '2798 1034, 2796 1263, 2782 1265, 2781 1336, 2794 1340, 2792 1492, 2779 1494, 2777 1565, 2791 1569, 2787 1651, 2774 1649, 2775 1826, 3043 1831, 3043 1645, 3030 1645, 3031 1336, 3047 1335, 3050 1181, 3035 1185, 3038 1031'),
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
('OSFE0', 'S1', '90001', 'Aseos', '28.95', '######', '408 129, 604 129, 604 260, 409 263'),
('OSFE0', 'S1', '90002', 'Aseos', '30.65', '######', '410 282, 409 406, 606 407, 605 268, 407 264'),
('OSFE0', 'S1', '90003', 'Vestiario', '6.95', '######', '605 128, 686 129, 686 205, 606 205'),
('OSFE0', 'S1', '90004', 'Paso', '18.70', '######', '604 202, 607 416, 686 414, 689 205'),
('OSFE0', 'S1', '90005', 'Cuarto de Máquinas', '222.50', '######', '694 127, 869 128, 870 206, 1037 206, 1036 217, 1576 218, 1654 294, 1622 324, 1623 409, 1529 411, 1528 295, 1519 293, 1520 406, 694 407'),
('OSFE0', 'S1', '90006', 'Instalacións', '13.65', '######', '871 128, 1037 128, 1037 206, 871 205'),
('OSFE0', 'S1', '90007', 'Paso', '49.10', '######', '605 418, 1153 417, 1153 488, 1064 487, 858 489, 859 498, 697 500, 695 485, 686 485, 684 498, 607 498'),
('OSFE0', 'S1', '90008', 'Almacén 1', '32.00', '######', '1154 415, 1154 485, 1357 488, 1360 500, 1520 499, 1521 414'),
('OSFE0', 'S1', '90009', 'Aula Informática 1', '142.85', '######', '410 416, 409 911, 685 913, 684 500, 601 501, 604 415'),
('OSFE0', 'S1', '90010', 'Aula Informática 2', '85.20', '######', '695 499, 875 500, 875 911, 694 913, 694 780, 684 779, 684 693, 695 693'),
('OSFE0', 'S1', '90011', 'Vestíbulo', '151.95', '######', '879 501, 1062 501, 1063 487, 1151 486, 1150 499, 1334 502, 1336 913, 1341 972, 875 972'),
('OSFE0', 'S1', '90012', 'Gabinete Pedagóxico', '24.60', '######', '1337 498, 1337 618, 1523 617, 1520 497'),
('OSFE0', 'S1', '90013', 'Seminario 3', '37.50', '######', '1337 617, 1337 801, 1337 806, 1520 806, 1520 617'),
('OSFE0', 'S1', '90014', 'Gabinete Pedagóxico', '21.50', '######', '1343 808, 1518 808, 1520 913, 1338 910'),
('OSFE0', 'S1', '90015', 'Vestíbulo', '45.65', '######', '397 915, 690 916, 692 1058, 408 1057, 408 972, 397 973'),
('OSFE0', 'S1', '90016', 'Vestíbulo', '28.10', '######', '689 913, 876 913, 875 981, 866 982, 869 1055, 688 1058'),
('OSFE0', 'S1', '90017', 'Vestíbulo', '27.80', '######', '1336 912, 1520 915, 1521 1055, 1345 1056, 1345 973, 1334 973'),
('OSFE0', 'S1', '90018', 'Ludoteca', '89.10', '######', '409 1059, 689 1057, 688 1344, 405 1344'),
('OSFE0', 'S1', '90019', 'Sala Polivalente', '249.75', '######', '1346 1057, 1345 1343, 693 1343, 694 1057, 869 1057, 868 981, 1346 980'),
('OSFE0', 'S1', '90020', 'Estrato', '55.75', '######', '1346 1058, 1476 1057, 1476 1139, 1481 1126, 1517 1125, 1521 1344, 1345 1341'),
('OSFE0', 'S1', '90021', 'Paso 1', '3.20', '######', '1476 1056, 1520 1056, 1520 1125, 1479 1126'),
('OSFE0', 'S1', '90022', 'Almacén 2', '33.20', '######', '1527 1239, 1803 1239, 1806 1346, 1526 1344'),
('OSFE0', 'S1', '90023', 'Vestiario 2', '20.70', '######', '1581 1154, 1803 1152, 1804 1239, 1580 1236'),
('OSFE0', 'S1', '90024', 'Vestiario 1', '20.25', '######', '1581 1057, 1803 1057, 1804 1149, 1582 1150'),
('OSFE0', 'S1', '90025', 'Paso 2', '10.80', '######', '1522 1060, 1523 1238, 1582 1237, 1583 1059'),
('OSFE0', 'S1', '90026', 'Seminario 2', '27.90', '######', '1582 942, 1803 943, 1802 1058, 1581 1058'),
('OSFE0', 'S1', '90027', 'Seminario 1', '33.75', '######', '1582 796, 1584 942, 1804 943, 1803 806, 1685 806, 1683 795'),
('OSFE0', 'S1', '90028', 'Paso 3', '11.90', '######', '1523 1057, 1584 1057, 1582 862, 1524 864'),
('OSFE0', 'S1', '90029', 'V PREV', '3.95', '######', '1583 865, 1582 796, 1525 795, 1525 867'),
('OSFE0', 'S1', '90030', 'Instalacións', '33.75', '######', '1565 737, 1687 736, 1686 795, 1565 795'),
('OSFE0', 'S1', '90031', 'Almacén', '19.95', '######', '1565 590, 1688 589, 1688 735, 1565 738'),
('OSFE0', 'S1', '90032', 'Paso', '5.00', '######', '1521 678, 1521 796, 1567 795, 1566 677'),
('OSFE0', 'S1', '90033', 'Instalacións', '11.85', '######', '1565 501, 1690 499, 1689 589, 1564 590'),
('OSFE0', 'S1', '90034', 'Instalacións', '11.85', '######', '1563 410, 1689 411, 1690 501, 1563 500'),
('OSFE0', 'S1', '90035', 'Paso', '10.70', '######', '1523 411, 1566 411, 1565 679, 1524 678'),
('OSFE0', 'S1', '90036', 'Instalacións', '7.00', '######', '1625 410, 1687 412, 1688 326, 1653 293, 1625 323'),
('OSFE0', 'S1', '90037', 'Rack', '6.60', '######', '1043 795, 988 795, 990 674, 1042 672'),
('OSFE0', 'S1', '90038', 'Instalacións', '6.60', '######', '1169 677, 1226 675, 1223 798, 1169 797'),
('OSFE0', 'S1', '90039', 'Ascensor', '2.63', '######', '1170 647, 1223 645, 1221 670, 1171 671'),
('OSPO0', 'S1', '90001', 'Despacho', '15.45', '######', '178 404, 254 404, 254 489, 179 490'),
('OSPO0', 'S1', '90002', 'Despacho', '15.85', '######', '256 404, 333 404, 333 489, 257 490'),
('OSPO0', 'S1', '90003', 'Despacho', '18.60', '######', '333 405, 429 405, 427 491, 333 491'),
('OSPO0', 'S1', '90004', 'Despacho', '8.40', '######', '429 404, 491 405, 493 454, 428 457'),
('OSPO0', 'S1', '90005', 'Pasillo', '45.70', '######', '179 493, 429 492, 430 457, 468 456, 469 507, 493 510, 493 550, 178 551'),
('OSPO0', 'S1', '90006', 'Laboratorio Xeodinánica', '109.85', '######', '178 551, 415 550, 493 551, 494 629, 469 631, 469 685, 177 687'),
('OSPO0', 'S1', '90007', 'Vestíbulo', '165.25', '######', '499 417, 812 417, 814 685, 473 687, 475 637, 501 635, 499 504, 474 502, 475 462, 500 461'),
('OSPO0', 'S1', '90008', 'Escaleiras', '23.25', '######', '536 513, 631 514, 631 555, 579 556, 579 585, 624 589, 627 627, 538 628'),
('OSPO0', 'S1', '90009', 'Aseos homes', '29.05', '######', '818 404, 887 405, 886 514, 898 514, 899 567, 819 567'),
('OSPO0', 'S1', '90010', 'Aseos mulleres', '33.70', '######', '888 404, 976 404, 977 567, 899 565, 899 513, 890 512'),
('OSPO0', 'S1', '90011', 'Vestíbulo aseos homes', '3.50', '######', '819 568, 849 567, 851 610, 818 610'),
('OSPO0', 'S1', '90012', 'Aseos minusválidos', '6.65', '######', '849 569, 914 568, 914 609, 851 609'),
('OSPO0', 'S1', '90013', 'Alacén', '3.35', '######', '913 569, 947 568, 946 611, 915 611'),
('OSPO0', 'S1', '90014', 'Vestíbulo aseo mulleres', '3.30', '######', '947 569, 975 569, 977 612, 947 610'),
('OSPO0', 'S1', '90015', 'Aula S1', '78.00', '######', '982 405, 1138 405, 1137 601, 1027 604, 1026 591, 983 592'),
('OSPO0', 'S1', '90016', 'Aula S2', '78.40', '######', '1140 405, 1296 405, 1295 594, 1254 593, 1253 603, 1141 602'),
('OSPO0', 'S1', '90017', 'Aula S3', '85.90', '######', '1301 406, 1455 405, 1455 621, 1345 621, 1345 608, 1301 611'),
('OSPO0', 'S1', '90018', 'Aula S4', '86.30', '######', '1459 405, 1616 405, 1615 609, 1573 609, 1572 621, 1460 621'),
('OSPO0', 'S1', '90019', 'S5', '85.20', '######', '1620 405, 1774 404, 1774 623, 1663 621, 1663 607, 1620 609'),
('OSPO0', 'S1', '90020', 'Aula S6', '85.35', '######', '1779 405, 1933 405, 1933 611, 1892 610, 1891 622, 1779 623'),
('OSPO0', 'S1', '90021', 'Servizo de Infraestructuras', '60.85', '######', '1937 405, 2073 403, 2039 568, 2039 604, 1937 607'),
('OSPO0', 'S1', '90022', 'Almacén Infraestrcuturas', '8.15', '######', '1937 608, 1994 608, 1995 663, 1938 663'),
('OSPO0', 'S1', '90023', 'SAI', '14.15', '######', '1995 609, 2095 609, 2096 665, 1996 663'),
('OSPO0', 'S1', '90024', 'Vestíbulo Infraestructuras', '5.00', '######', '2039 573, 2097 572, 2098 605, 2039 606'),
('OSPO0', 'S1', '90025', 'Almacén Infraestructuras', '49.00', '######', '2075 404, 2042 571, 2171 569, 2172 406'),
('OSPO0', 'S1', '90026', 'Sala de reunións', '35.20', '######', '2175 405, 2259 405, 2259 570, 2175 571'),
('OSPO0', 'S1', '90027', 'Sala de Informática', '102.75', '######', '2257 405, 2411 405, 2412 660, 2254 663, 2258 571'),
('OSPO0', 'S1', '90028', 'Distribuidor acceso libre', '52.60', '######', '2258 572, 2098 573, 2098 703, 2254 705'),
('OSPO0', 'S1', '90029', 'Pasillo central', '256.35', '######', '813 611, 977 611, 976 634, 983 635, 981 593, 1019 592, 1020 608, 1257 608, 1259 592, 1294 593, 1293 636, 1301 635, 1301 611, 1339 609, 1339 625, 1577 628, 1580 610, 1612 610, 1613 635, 1624 636, 1621 609, 1661 609, 1661 627, 1895 627, 1897 611, 1933 609, 1933 667, 2096 667, 2097 706, 1845 704, 1845 775, 1713 771, 1721 690, 1069 689, 1025 732, 981 687, 814 685'),
('OSPO0', 'S1', '90030', 'Escaleiras Aula Magna', '3.80', '######', '1038 718, 1068 690, 1092 713, 1063 745'),
('OSPO0', 'S1', '90031', 'Rampa Aula Magna', '1.55', '######', '1070 690, 1117 689, 1093 714'),
('OSPO0', 'S1', '90032', 'Vestíbulo Aula Magna', '76.95', '######', '1064 744, 1150 833, 1174 834, 1174 851, 1207 854, 1241 853, 1242 819, 1326 733, 1362 731, 1362 694, 1297 693, 1116 690'),
('OSPO0', 'S1', '90033', 'Rampa Aula Magna', '9.70', '######', '1025 731, 1140 853, 1175 854, 1174 833, 1151 833, 1039 720'),
('OSPO0', 'S1', '90034', 'Aula Magna ', '260.80', '######', '1589 695, 1585 763, 1571 813, 1549 865, 1521 915, 1479 966, 1432 1006, 1357 1049, 1256 1078, 1205 1082, 1203 854, 1246 855, 1247 821, 1329 738, 1362 736, 1361 696'),
('OSPO0', 'S1', '90035', 'Almacén Aula Magna', '220.20', '######', '1712 695, 1705 774, 1687 848, 1653 930, 1610 999, 1546 1071, 1482 1121, 1419 1155, 1332 1188, 1206 1205, 1207 1082, 1269 1075, 1363 1045, 1426 1008, 1480 963, 1529 902, 1569 818, 1590 695'),
('OSPO0', 'S1', '90036', 'Escaleiras', '28.55', '######', '1775 783, 1775 889, 1883 889, 1882 782'),
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
  `sm_email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`sm_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `SM_USER`
--

INSERT INTO `SM_USER` (`sm_email`) VALUES
('ivanddf1994@hotmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `SM_USER_GROUP`
--

CREATE TABLE IF NOT EXISTS `SM_USER_GROUP` (
  `sm_email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `sm_idGroup` int(11) NOT NULL,
  PRIMARY KEY (`sm_email`,`sm_idGroup`),
  KEY `idGroup` (`sm_idGroup`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `SM_USER_GROUP`
--

INSERT INTO `SM_USER_GROUP` (`sm_email`, `sm_idGroup`) VALUES
('ivanddf1994@hotmail.com', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USER`
--

CREATE TABLE IF NOT EXISTS `USER` (
  `photo` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `passwd` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `name` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `surname` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `birthdate` date NOT NULL,
  `phone` int(9) DEFAULT NULL,
  PRIMARY KEY (`email`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `USER`
--

INSERT INTO `USER` (`photo`, `email`, `passwd`, `name`, `surname`, `dni`, `birthdate`, `phone`) VALUES
('../../document/Users/ivanddf1994@hotmail.com/ivan.jpg', 'ivanddf1994@hotmail.com', 'bb4e90a7639add09cf8629499638760c', 'Iván', 'de Dios Fernández', '44488795X', '1994-03-26', 617129241),
(null, 'info@responsable.es', 'responsable', 'RespInfr1', 'Informatica', '232323232Y', '2019-03-03', 674949955);

-- --------------------------------------------------------

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
  ADD CONSTRAINT `email` FOREIGN KEY (`im_email`) REFERENCES `IM_USER` (`im_email`);

--
-- Filtros para la tabla `IM_PERMISSION`
--
ALTER TABLE `IM_PERMISSION`
  ADD CONSTRAINT `IM_PERMISSION_ibfk_1` FOREIGN KEY (`im_idGroup`) REFERENCES `IM_GROUP` (`im_idGroup`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `IM_PERMISSION_ibfk_2` FOREIGN KEY (`im_idFunction`) REFERENCES `IM_FUNCTIONALITY` (`im_idFunction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `IM_PERMISSION_ibfk_3` FOREIGN KEY (`im_idAction`) REFERENCES `IM_ACTION` (`im_idAction`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `IM_PERMISSION_ibfk_4` FOREIGN KEY (`im_idFunction`) REFERENCES `IM_FUNCTIONALITY_ACTION` (`im_idFunction`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `IM_USER`
--
ALTER TABLE `IM_USER`
  ADD CONSTRAINT `IM_USER_ibfk_1` FOREIGN KEY (`im_email`) REFERENCES `USER` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;


--
-- Filtros para la tabla `IM_USER_GROUP`
--
ALTER TABLE `IM_USER_GROUP`
  ADD CONSTRAINT `GROUP` FOREIGN KEY (`im_idGroup`) REFERENCES `IM_GROUP` (`im_idGroup`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `USER` FOREIGN KEY (`im_email`) REFERENCES `IM_USER` (`im_email`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Filtros para la tabla `SM_USER`
--
ALTER TABLE `SM_USER`
  ADD CONSTRAINT `SM_USER_ibfk_1` FOREIGN KEY (`sm_email`) REFERENCES `USER` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

--
-- Filtros para la tabla `SM_USER_GROUP`
--
ALTER TABLE `SM_USER_GROUP`
  ADD CONSTRAINT `SM_USER_GROUP_ibfk_1` FOREIGN KEY (`sm_email`) REFERENCES `SM_USER` (`sm_email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `SM_USER_GROUP_ibfk_2` FOREIGN KEY (`sm_idGroup`) REFERENCES `SM_GROUP` (`sm_idGroup`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

