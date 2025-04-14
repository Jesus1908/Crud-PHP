CREATE DATABASE Cursos;
USE Cursos;

CREATE TABLE categorias (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    categoria  VARCHAR(50)
)ENGINE = INNODB;

SELECT * FROM categorias;

CREATE TABLE cursos (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    idCategoria   INT NOT NULL,
    titulo        VARCHAR(50),
    duracion      TIME NOT NULL,
    nivel         VARCHAR(20),
    precio        FLOAT NOT NULL,
    fechaInicio   DATE NOT NULL,
    FOREIGN KEY (idCategoria) REFERENCES categorias(id)
)ENGINE = INNODB;;

--Insertar registros a las tablas correspondiente:

--Tabla categorias registros
INSERT INTO categorias (categoria) VALUES ('Matematica');
INSERT INTO categorias (categoria) VALUES ('Literatura');
INSERT INTO categorias (categoria) VALUES ('Informatica');

--Tabla cursos registros
INSERT INTO cursos (idCategoria, titulo, duracion, nivel, precio, fechaInicio) 
VALUES  
(1, 'Teorema de pitagoras', '01:30:00', 'Básico', 49.90, '2025-05-01'),
(2, 'Escritura creativa', '02:12:00', 'Intermedio', 60.00, '2025-04-06'),
(3, 'Redes', '05:47:00', 'Avanzado', 70.00, '2025-07-13');


--Creación de la vista
CREATE VIEW vista_cursos_todos 
AS
    SELECT
        C.id,
        CAT.categoria,
        C.titulo,
        C.duracion,
        C.nivel,
        C.precio,
        C.fechaInicio
    FROM cursos C
    INNER JOIN categorias CAT ON C.idCategoria = CAT.id
    ORDER BY C.id;


--Procedimiento almacenado para filtrar registros por categoria
DELIMITER //
CREATE PROCEDURE spu_cursos_filtrar_por_categoria(IN _idCategoria INT)
BEGIN
	SELECT 
		C.id,
		CAT.categoria,
		C.titulo,
		C.duracion,
		C.nivel,
		C.precio,
		C.fechaInicio
	FROM cursos C
	INNER JOIN categorias CAT ON C.idCategoria = CAT.id
	WHERE C.idCategoria = _idCategoria;
END //

--Procedimiento almacenado para registrar cursos
DELIMITER //
CREATE PROCEDURE spu_cursos_registrar(
	IN _idCategoria 	INT, 
    IN _titulo 			VARCHAR(50),
    IN _duracion 		TIME,
    IN _nivel 			VARCHAR(20),
    IN _precio 			FLOAT,
    IN _fechaInicio 	DATE
)
BEGIN
	INSERT INTO cursos (idCategoria, titulo, duracion, nivel, precio, fechaInicio)
	    VALUES 
    (_idCategoria, _titulo, _duracion, _nivel, _precio, _fechaInicio);
END //

