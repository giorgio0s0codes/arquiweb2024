drop DATABASE if exists productosBake;
CREATE DATABASE productosBake;

USE productosBake;

CREATE TABLE categorias (
    id_categoria INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    description VARCHAR(35) NOT NULL
);

CREATE TABLE articulos (
    id_articulo INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    precio DECIMAL(15,2),
    descripcion VARCHAR(200) NOT NULL,
    id_categoria VARCHAR(50),
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);

