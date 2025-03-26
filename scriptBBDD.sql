// CREATE DATABASE IF NOT EXISTS 'proyetoasir';
// USE DATABASE 'proyectoasir';

DROP TABLE IF EXISTS 'categorias';
CREATE TABLE IF NOT EXISTS 'categorias' (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL UNIQUE,
    descripcion VARCHAR(255) NOT NULL,
    imagen_categoria VARCHAR(255)
);

DROP TABLE IF EXISTS 'productos';
CREATE TABLE IF NOT EXISTS 'productos' (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    descripcion VARCHAR(255) NOT NULL,
    comentario VARCHAR(255) NOT NULL,   
    valoracion ENUM('1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
    likes INT DEFAULT 0,
    vistas INT DEFAULT 0,
    fecha DATE NOT NULL, -- La columna 'fecha' no tiene valor por defecto
    url_1 VARCHAR(255) NOT NULL,
    url_2 VARCHAR(255) NOT NULL,
   FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

DROP TABLE IF EXISTS 'usuarios';
CREATE TABLE IF NOT EXISTS 'usuarios' (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS 'comentarios';
CREATE TABLE IF NOT EXISTS 'comentarios' (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT,
    id_usuario INT,
    comentario VARCHAR(255) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_producto) REFERENCES productos(id),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);



DROP TABLE IF EXISTS 'vistas';
CREATE TABLE IF NOT EXISTS 'vistas' (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255),
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_producto) REFERENCES productos(id)
);


