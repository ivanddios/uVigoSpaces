DROP DATABASE IF EXISTS espacios;
CREATE DATABASE IF NOT EXISTS espacios;
USE espacios;
GRANT ALL PRIVILEGES ON * . * TO 'root'@'localhost';
FLUSH PRIVILEGES;

CREATE TABLE IF NOT EXISTS USER(
  username varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  passwd varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  name varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  surname varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  dni varchar(10) COLLATE utf8_spanish_ci NOT NULL UNIQUE,
  birthdate date NOT NULL,
  email varchar(50) COLLATE utf8_spanish_ci NOT NULL UNIQUE,
  phone int(15) DEFAULT NULL,
  photo varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY(username)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE=utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS `ACTION`(
  idAction int AUTO_INCREMENT NOT NULL,
  nameAction varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  descripAction varchar(225) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY(idAction)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS FUNCTIONALITY(
  idFunction int AUTO_INCREMENT NOT NULL,
  nameFunction varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  descripFunction varchar(225) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY(idFunction)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE=utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS ACTION_FUNCTIONALITY(
  idAction int NOT NULL,
  idFunction int NOT NULL,
  PRIMARY KEY(idAction, idFunction),
  FOREIGN KEY (idAction) REFERENCES ACTION (idAction),
  FOREIGN KEY (idFunction) REFERENCES FUNCTIONALITY (idFunction) 
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE=utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS `GROUP`(
  idGroup int AUTO_INCREMENT NOT NULL,
  nameGroup varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  descripGroup varchar(225) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY(idGroup)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE=utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS PERMISSION(
  idGroup int NOT NULL,
  idFunction int NOT NULL,
  idAction int NOT NULL,
  PRIMARY KEY(idGroup,idFunction,idAction),
  FOREIGN KEY (idGroup) REFERENCES `GROUP` (idGroup),
  FOREIGN KEY (idFunction) REFERENCES FUNCTIONALITY (idFunction),
  FOREIGN KEY (idAction) REFERENCES ACTION (idAction)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS USER_GROUP(
  username varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  idGroup int NOT NULL,
  PRIMARY KEY(username, idGroup),
  FOREIGN KEY (username) REFERENCES USER (username),
  FOREIGN KEY (idGroup) REFERENCES `GROUP` (idGroup) 
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE=utf8_spanish_ci;


CREATE TABLE IF NOT EXISTS BUILDING(
  idBuilding char(5) COLLATE utf8_spanish_ci NOT NULL,
  nameBuilding varchar(225) COLLATE utf8_spanish_ci NOT NULL,
  addressBuilding varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  phoneBuilding int(15) DEFAULT NULL,
  responsibleBuilding varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY(idBuilding)
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS FLOOR(
  idBuilding char(5) COLLATE utf8_spanish_ci NOT NULL,
  idFloor char(2) COLLATE utf8_spanish_ci NOT NULL,
  nameFloor varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  planeFloor varchar(500) COLLATE utf8_spanish_ci,
  surfaceBuildingFloor decimal(10,2) NOT NULL,
  surfaceUsefulFloor decimal(10,2) NOT NULL,
  PRIMARY KEY(idFloor ,idBuilding),
  FOREIGN KEY (idBuilding) REFERENCES BUILDING (idBuilding) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE=utf8_spanish_ci;

CREATE TABLE IF NOT EXISTS SPACE(
  idBuilding char(5) COLLATE utf8_spanish_ci NOT NULL,
  idFloor char(2) COLLATE utf8_spanish_ci NOT NULL,
  idSpace char(5) COLLATE utf8_spanish_ci NOT NULL,
  nameSpace varchar(225) COLLATE utf8_spanish_ci NOT NULL,
  surfaceSpace decimal(10,2) NOT NULL,
  numberInventorySpace varchar(10) DEFAULT '',
  PRIMARY KEY(idFloor ,idBuilding,idSpace),
  FOREIGN KEY (idBuilding) REFERENCES BUILDING (idBuilding)  ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (idFloor) REFERENCES FLOOR (idFloor) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8  COLLATE=utf8_spanish_ci;



INSERT INTO USER (username, passwd, name, surname, dni, birthdate, email, phone, photo) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Iván', 'de Dios Fernández', '44488795X', '26-03-1994', 'ivanddf1994@hotmail.com', 617129241,'');


INSERT INTO `GROUP` (idGroup, nameGroup, descripGroup) VALUES
('1', 'ADMIN', 'System administrator');

INSERT INTO USER_GROUP (username, idGroup) VALUES
('admin', '1');

INSERT INTO ACTION (idAction, nameAction, descripAction) VALUES 
('1', 'SHOWALL', 'SHOWALL'),
('2', 'ADD', 'ADD'),
('3', 'EDIT', 'EDIT'),
('4', 'DELETE', 'DELETE');


INSERT INTO FUNCTIONALITY(idFunction, nameFunction, descripFunction) VALUES 
('1', 'BUILDING', 'Building Controller'),
('2', 'FLOOR', 'Floor Controller');

INSERT INTO ACTION_FUNCTIONALITY (idAction, idFunction) VALUES
('1', '1'),
('2', '1'),
('3', '1'),
('4', '1'),
/*FLOOOR*/
('1', '2'),
('2', '2'),
('3', '2'),
('4', '2');

INSERT INTO PERMISSION (idGroup, idFunction, idAction) VALUES
('1', '1', '1'),
('1', '1', '2'),
('1', '1', '3'),
('1', '1', '4'),
/*FLOOR*/
('1', '2', '1'),
('1', '2', '2'),
('1', '2', '3'),
('1', '2', '4');



INSERT INTO BUILDING (idBuilding, nameBuilding, addressBuilding, phoneBuilding, responsibleBuilding) VALUES
('OSBI0', 'Biblioteca Universitaria Rosalía de Castro', 'Camino Seara B 4', 988387192, 'NO SE SABE');

INSERT INTO FLOOR (idBuilding, idFloor, nameFloor, planeFloor, surfaceBuildingFloor, surfaceUsefulFloor) VALUES
('OSBI0', '04', 'Cuarta Planta', '', 215.20, 181.25),
('OSBI0', '03', 'Terceira Planta', 's', 214.80, 179.60),
('OSBI0', '02', 'Segunda Planta', 's', 215.20, 181.25),
('OSBI0', '01', 'Primeira Planta', 's', 818.30, 486.60),
('OSBI0', '00', 'Planta Baixa', "../document/OSBI0/OSBI000/OSBI000.jpg", 1895.80, 1428.75),
('OSBI0', 'S1', 'Soto -1', 's', 1800.40, 894.20),
('OSBI0', 'S2', 'Soto -2', 's', 1338.40, 1226.70);

INSERT INTO SPACE (idBuilding, idFloor, idSpace, nameSpace, surfaceSpace, numberInventorySpace) VALUES
('OSBI0', '04', '00001', 'Escaleiras', 13.80, ''),
('OSBI0', '04', '00002', 'Pasillo', 28.30, ''),
('OSBI0', '04', '00003', 'Ascensor', 00.00, ''),  /* NO HAY DATOS*/
('OSBI0', '04', '00005', 'Baño mulleres', 5.20, ''), /* 5.20 o 5.28 */
('OSBI0', '04', '00006', 'Sala de usos múltiples', 133.90, '003743'),

('OSBI0', '03', '00001', 'Escaleiras', 13.80, ''),
('OSBI0', '03', '00002', 'Pasillo', 23.00, ''),
('OSBI0', '03', '00003', 'Ascensor', 00.00 , ''), /* NO HAY DATOS*/
('OSBI0', '03', '00005', 'Baño homes', 5.20, ''), /* 5.20 o 5.28 */
('OSBI0', '03', '00006', 'Sala de informática', 137.65, '003744'),

('OSBI0', '02', '00001', 'Escaleiras', 13.80, ''),
('OSBI0', '02', '00002', 'Pasillo', 24.95, ''),
('OSBI0', '02', '00003', 'Ascensor', 00.00 , ''), /* NO HAY DATOS*/
('OSBI0', '02', '00005', 'Baño mulleres', 5.20, ''), /* 5.20 o 5.28 */
('OSBI0', '02', '00006', 'Sala de audiovisuais', 137.30, '003745'),

('OSBI0', '00', '00001', 'Escaleiras', 00.00, ''), /* NO HAY DATOS*/
('OSBI0', '00', '00002', 'Pasillo', 00.00, ''), /* NO HAY DATOS*/
('OSBI0', '00', '00003', 'Aseos', 00.00, ''),/* NOS FALTA ESTA SUP*/
('OSBI0', '00', '00004', 'Aseos', 00.00, ''), /* NOS FALTA ESTA SUP*/
('OSBI0', '00', '00005', 'Pasillo', 24.55,''), 
('OSBI0', '00', '00007', 'Ascensor', 00.00, ''), /* NO HAY DATOS*/
('OSBI0', '00', '00008', 'Escaleiras', 00.00, ''), /* NO HAY DATOS*/
('OSBI0', '00', '00009', 'Grupo electróxeno', 11.50, '006743'),
('OSBI0', '00', '00010', 'Cadro Xeral', 5.65, '006744'),
('OSBI0', '00', '00011', 'Centro de transformación', 16.60, '006745'),
('OSBI0', '00', '00012', 'Alxibe', 9.50, '006746'),
('OSBI0', '00', '00013', 'Grupo de presión', 9.65, '006747'),
('OSBI0', '00', '00014', 'Sala de máquinas', 75.80, '006748'),
('OSBI0', '00', '00015', 'Pasillo', 34.45,''),
('OSBI0', '00', '00016', 'Pasillo', 127.15, ''),
('OSBI0', '00', '00017', 'Pasillo', 00.00,''), /* NO ESTA EN EL PLANO*/
('OSBI0', '00', '00018', 'Depósito aberto', 90.15, ''),
('OSBI0', '00', '00019', 'Sala de lectura', 273.15, '003754'),
('OSBI0', '00', '00020', 'Zona de prensa', 22.75,''),
('OSBI0', '00', '00021', 'Escaleiras', 12.35, ''),
('OSBI0', '00', '00023', 'Ascensor', 00.00,''), /* NO HAY DATOS*/
('OSBI0', '00', '00026', 'Escaleiras', 00.00,''), /* NO HAY DATOS*/
('OSBI0', '00', '00027', 'Ascensor', 00.00,''), /* NO HAY DATOS*/
('OSBI0', '00', '00028', 'Despacho de préstamos e devolucións', 53.10, ''),
('OSBI0', '00', '00029', 'Sala de traballo', 16.60, '003752'),
('OSBI0', '00', '00030', 'Depósito TEBS', 15.20, ''),
('OSBI0', '00', '00031', 'Pasillo', 00, ''), /* PROBLEMA CON EL INVENTARIO Y SUP */
('OSBI0', '00', '00032', 'Pasillo', 00, ''), /* PROBLEMA CON EL INVENTARIO Y SUP */
('OSBI0', '00', '00033', 'Despacho de Referencias', 19.40, '003751'), 
('OSBI0', '00', '00034', 'Pasillo', 00, ''), /* PROBLEMA CON EL INVENTARIO Y SUP */
('OSBI0', '00', '00035', 'Pasillo', 00, ''), /* PROBLEMA CON EL INVENTARIO Y SUP */
('OSBI0', '00', '00036', 'Recepción', 18.70, '006728'), 
('OSBI0', '00', '00037', 'Baños', 31.85, ''), 
('OSBI0', '00', '00038', 'Escaleiras', 00, ''), /* PROBLEMA CON EL INVENTARIO Y SUP */
('OSBI0', '00', '00039', 'Sala de Referencias', 113.50, '003750'),

('OSBI0', 'S1', '00001', 'Baños', 23.23, ''), 
('OSBI0', 'S1', '00002', 'Pasillo', 26.70, ''), 
('OSBI0', 'S1', '00004', 'Ascensor', 00.00, ''), /* NOS FALTA ESTA SUP*/
('OSBI0', 'S1', '00005', 'Escaleiras', 6.70, ''), 
('OSBI0', 'S1', '00006', 'Sala de estudio', 171.00,'006740'), 
('OSBI0', 'S1', '00007', 'Escaleiras', 00.00, ''), /* NO HAY DATOS*/
('OSBI0', 'S1', '00008', 'Escaleiras', 00.00, ''), /* NO HAY DATOS*/
('OSBI0', 'S1', '00009', 'Pasillo', 00.00, ''), /* NO HAY DATOS*/
('OSBI0', 'S1', '00010', 'Pasillo', 00.00, ''), /* NO HAY DATOS*/
('OSBI0', 'S1', '00011', 'Ascensor', 00.00, ''), /* NO HAY DATOS*/
('OSBI0', 'S1', '00012', 'Depósito', 291.20, '003749'),
('OSBI0', 'S1', '00014', 'Almacén limpieza', 14.50, '006738'),
('OSBI0', 'S1', '00015', 'Almacén biblioteca', 73.95, '006739'),
('OSBI0', 'S1', '00017', 'Ascensor', 00.00, ''),
('OSBI0', 'S1', '00018', 'Pasillo', 64.80, ''),
('OSBI0', 'S1', '00019', 'RACK', 25.60, '003748'),

('OSBI0', 'S2', '00001', 'Baños', 23.25, ''), 
('OSBI0', 'S2', '00002', 'Pasillo', 30.85, ''), 
('OSBI0', 'S2', '00004', 'Ascensor', 00.00, ''), /* NO HAY DATOS*/ 
('OSBI0', 'S2', '00005', 'Escaleiras', 00.00, ''), /* NO HAY DATOS*/ 
('OSBI0', 'S2', '00006', 'Escaleiras', 00.00,''), /* NO HAY DATOS*/
('OSBI0', 'S2', '00007', 'Vestíbulo', 3.10, ''), 
('OSBI0', 'S2', '00008', 'Depósito Hemeroteca', 119.43, '003741'), 
('OSBI0', 'S2', '00009', 'Hemeroteca', 270.82, '006741'), 
('OSBI0', 'S2', '00010', 'Deposito aberto', 103.47, ''), 
('OSBI0', 'S2', '00011', 'Zona de consulta', 126.74, ''), 
('OSBI0', 'S2', '00012', 'Sala de lectura', 314.77, ''),
('OSBI0', 'S2', '00013', 'Escaleiras', 00.00, ''), /* NO HAY DATOS*/
('OSBI0', 'S2', '00015', 'Ascensor', 00.00, ''), /* NO HAY DATOS*/
('OSBI0', 'S2', '00016', 'Pasillo', 41.52, ''),
('OSBI0', 'S2', '00017', 'Escaleiras', 00.00, ''), /* NO HAY DATOS*/
('OSBI0', 'S2', '00018', 'Sala técnica do ascensor', 18.20, '003747'),
('OSBI0', 'S2', '00020', 'Escaleiras', 00.00, ''); /* NO HAY DATOS*/