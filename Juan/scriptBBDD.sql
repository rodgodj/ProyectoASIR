// CREATE DATABASE 'proyetoasir';
// USE DATABASE 'proyectoasir';

CREATE TABLE productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    valoracion ENUM('1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
    likes INT DEFAULT 0,
    vistas INT DEFAULT 0,
     fecha DATE NOT NULL -- La columna 'fecha' no tiene valor por defecto
);

CREATE TABLE comentarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT,
    comentario TEXT NOT NULL,
    usuario VARCHAR(255),
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);


CREATE TABLE vistas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES productos(id)
);
