-- Script para la creación de la base de datos para la adopción de mascotas

DROP DATABASE IF EXISTS petAdoption;
CREATE DATABASE petAdoption;

USE petAdoption;

DROP TABLE IF EXISTS tipoMascota;
CREATE TABLE tipoMascota(
    idTipoMascota INT NOT NULL AUTO_INCREMENT,
    tipo VARCHAR(48),
    CONSTRAINT idTipoMascota PRIMARY KEY (idTipoMascota, tipo)
);

DROP TABLE IF EXISTS razaMascota;
CREATE TABLE razaMascota(
    idRazaMascota INT NOT NULL AUTO_INCREMENT,
    tipoMascota INT,
    raza VARCHAR(48),
    FOREIGN KEY (tipoMascota) REFERENCES tipoMascota(idTipoMascota) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT idRazaMascota PRIMARY KEY (idRazaMascota, tipoMascota, raza)
);

DROP TABLE IF EXISTS mascota;
CREATE TABLE mascota(
    idMascota INT NOT NULL AUTO_INCREMENT,
    foto VARCHAR(48),
    tipo INT,
    nombre VARCHAR(64),
    edad INT,
    raza INT,
    descripcion VARCHAR(255),
    FOREIGN KEY (tipo) REFERENCES tipoMascota(idTipoMascota) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (raza) REFERENCES razaMascota(idRazaMascota) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT idMascota PRIMARY KEY (idMascota, tipo, nombre, edad, raza)
);

DROP TABLE IF EXISTS cliente;
CREATE TABLE cliente(
    idCliente INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(128),
    telefono VARCHAR(24),
    ciudad VARCHAR(128),
    email VARCHAR(128),
    edad INT,
    genero VARCHAR(24),
    adopciones INT,
    CONSTRAINT idCliente PRIMARY KEY(idCliente, nombre)
);

DROP TABLE IF EXISTS adopcion;
CREATE TABLE adopcion(
    idAdopcion INT NOT NULL AUTO_INCREMENT,
    cliente INT,
    mascota INT,
    FOREIGN KEY (cliente) REFERENCES cliente(idCliente) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (mascota) REFERENCES mascota(idMascota) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT idAdopcion PRIMARY KEY (idAdopcion, cliente, mascota)
);

-- Creación de datos para las tablas
USE petAdoption;

INSERT INTO tipoMascota(tipo) VALUES ('Perro');
INSERT INTO tipoMascota(tipo) VALUES ('Gato');
INSERT INTO tipoMascota(tipo) VALUES ('Conejo');
INSERT INTO tipoMascota(tipo) VALUES ('Dinosaurio');

INSERT INTO razaMascota(tipoMascota, raza) VALUES (1, 'Pastor Alemán');-- 1
INSERT INTO razaMascota(tipoMascota, raza) VALUES (1, 'Labrador retriever');-- 2
INSERT INTO razaMascota(tipoMascota, raza) VALUES (1, 'Husky Siberiano');-- 3
INSERT INTO razaMascota(tipoMascota, raza) VALUES (1, 'Rottweiler');-- 4
INSERT INTO razaMascota(tipoMascota, raza) VALUES (2, 'Gato Persa');-- 5
INSERT INTO razaMascota(tipoMascota, raza) VALUES (2, 'Bengala');-- 6
INSERT INTO razaMascota(tipoMascota, raza) VALUES (2, 'Gato siamés');-- 7
INSERT INTO razaMascota(tipoMascota, raza) VALUES (2, 'Ragdoll');-- 8
INSERT INTO razaMascota(tipoMascota, raza) VALUES (3, 'Belier Holandés');-- 9
INSERT INTO razaMascota(tipoMascota, raza) VALUES (3, 'Conejo de Angora');-- 10
INSERT INTO razaMascota(tipoMascota, raza) VALUES (3, 'Cabeza de león');-- 11
INSERT INTO razaMascota(tipoMascota, raza) VALUES (3, 'Mini Lop');-- 12
INSERT INTO razaMascota(tipoMascota, raza) VALUES (4, 'Velociraptor');-- 13
INSERT INTO razaMascota(tipoMascota, raza) VALUES (4, 'Triceratops');-- 14
INSERT INTO razaMascota(tipoMascota, raza) VALUES (4, 'Tyrannosaurus rex');-- 15
INSERT INTO razaMascota(tipoMascota, raza) VALUES (4, 'Apatosaurus');-- 16

INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('pastorAleman.jpg', 1, 'Tyson', 4, 1, 'Pequeño Pastor Alemán en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('pastorAleman2.jpeg', 1, 'Cancerbero', 10, 1, 'Pastor Alemán en busca de hogar, divertido y cariñoso.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('pastorAleman3.jpg', 1, 'Doggy', 9, 1, 'Pastor Alemán en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('labradorRetriever.jpg', 1, 'Trafalgar', 3, 2, 'Pequeño Labrador Retriever en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('labradorRetriever2.jpg', 1, 'Chop', 13, 2, 'Labrador Retriever en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('labradorRetriever3.jpg', 1, 'Labry', 16, 2, 'Labrador Retriever en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('huskySiberiano.jpg', 1, 'Akamaru', 4, 3, 'Pequeño Husky Siberiano en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('huskySiberiano2.jpg', 1, 'Wolf', 2, 3, 'Pequeño Husky Siberiano en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('huskySiberiano3.png', 1, 'Savage', 14, 3, 'Husky Siberiano en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('gatoPersa.jpg', 2, 'Bolita', 3, 5, 'Pequeño gato Persa en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('gatoPersa2.jpg', 2, 'Honey', 4, 5, 'Pequeño gato Persa en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('gatoPersa3.jpeg', 2, 'Thing', 2, 5, 'Pequeño gato Persa en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('gatoBengala.jpg', 2, 'Bengi', 2, 6, 'Pequeño gato Bengala en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('gatoBengala2.jpg', 2, 'Light', 4, 6, 'Pequeño gato Bengala en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('gatoBengala3.jpg', 2, 'Yagami', 3, 6, 'Pequeño gato Bengala en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('gatoSiames.jpg', 2, 'Blueyes', 3, 7, 'Pequeño gato Siamés en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('gatoSiames2.jpg', 2, 'Blind', 3, 7, 'Pequeño gato Siamés en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('gatoSiames3.jpeg', 2, 'Xiaomi', 5, 7, 'Pequeño gato Siamés en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('belierHolandes.jpg', 3, 'Beli', 2, 9, 'Pequeño conejo Belier Holandes en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('belierHolandes2.jpg', 3, 'Darky', 6, 9, 'Pequeño conejo Belier Holandes en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('belierHolandes3.jpg', 3, 'Shinny', 5, 9, 'Pequeño conejo Belier Holandes en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('conejoDeAngora.jpg', 3, 'Angi', 2, 10, 'Pequeño conejo de Angora en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('conejoDeAngora2.jpg', 3, 'Algodón', 3, 10, 'Pequeño conejo de Angora en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('conejoDeAngora3.jpg', 3, 'White', 2, 10, 'Pequeño conejo de Angora en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('cabezaLeon.jpg', 3, 'Leon', 3, 11, 'Pequeño conejo cabeza de León en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('cabezaLeon2.jpg', 3, 'Simba', 3, 11, 'Pequeño conejo cabeza de León en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('cabezaLeon3.jpg', 3, 'Bestia', 3, 11, 'Pequeño conejo cabeza de León en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('velociraptor.jpg', 4, 'Rapidin', 48, 13, 'Velociraptor en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('velociraptor2.jpg', 4, 'Furia', 58, 13, 'Velociraptor en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('velociraptor3.png', 4, 'Speed', 46, 13, 'Velociraptor en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('triceratops.png', 4, 'Tricer', 56, 14, 'Triceratops en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('triceratops2.png', 4, 'Thops', 46, 14, 'Triceratops en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('triceratops3.jpg', 4, 'Cuernos', 66, 14, 'Triceratops en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('tyrannosaurusRex.jpg', 4, 'Rex', 112, 15, 'Tyrannosaurus Rex en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('tyrannosaurusRex2.jpg', 4, 'King', 115, 15, 'Tyrannosaurus Rex en busca de hogar.');
INSERT INTO mascota (foto, tipo, nombre, edad, raza, descripcion) VALUES ('tyrannosaurusRex3.jpg', 4, 'Boss', 118, 15, 'Tyrannosaurus Rex en busca de hogar.');

INSERT INTO cliente (nombre, telefono, ciudad, email, edad, genero, adopciones) VALUES ('Jesus', '2224736251', 'Puebla', 'jesus@gmail.com', 22, 'masculino', 0);
INSERT INTO cliente (nombre, telefono, ciudad, email, edad, genero, adopciones) VALUES ('Alexia', '2224184726', 'Puebla', 'alee@gmail.com', 23, 'femenino', 0);
INSERT INTO cliente (nombre, telefono, ciudad, email, edad, genero, adopciones) VALUES ('Cristina', '2224154627', 'Puebla', 'cris@gmail.com', 23, 'femenino', 0);
INSERT INTO cliente (nombre, telefono, ciudad, email, edad, genero, adopciones) VALUES ('Tyler', '2224765424', 'Puebla', 'tyler@gmail.com', 25, 'masculino', 0);

-- Creación de Stored Procedure para consultar las mascotas de cada cliente
USE petAdoption;
DROP PROCEDURE IF EXISTS sp_MascotasCliente;
delimiter //
CREATE PROCEDURE sp_MascotasCliente(IN idCliente INT)
BEGIN
	SELECT * FROM mascota WHERE idMascota IN (SELECT mascota FROM adopcion WHERE cliente = idCliente);
END;
//
delimiter ;

-- Creación de Trigger para validar el máximo de adopcines
USE petAdoption;

DROP TRIGGER IF EXISTS validarAdopciones;
delimiter //
CREATE TRIGGER validarAdopciones
BEFORE INSERT ON adopcion
FOR EACH ROW 
BEGIN
	declare msg varchar(128);
    if (SELECT c.adopciones FROM cliente c WHERE c.idCliente = NEW.cliente) >=2 then
	    set msg = concat('Has alcanzado el máximo de adopciones ');
        signal sqlstate '45000' set message_text = msg;
    end if;
    UPDATE cliente SET adopciones = adopciones+1 WHERE idCliente = NEW.cliente;
END
//
delimiter ;
