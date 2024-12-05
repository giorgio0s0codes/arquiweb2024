-- Erase data base if already exists to avoid handling errors then Create it
drop DATABASE if exists productosBake;
CREATE DATABASE productosBake;

-- Take the DB to work with
USE productosBake;

-- Create the table categories to work with
CREATE TABLE categorias (
    id_categoria INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    description VARCHAR(35) NOT NULL
);

-- Create the table for the articles to be entered
CREATE TABLE articulos (
    id_articulo INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    precio DECIMAL(15,2),
    descripcion VARCHAR(200) NOT NULL,
    id_categoria INT,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);

CREATE TABLE usuarios (
    id_usuario INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    tipo INT
);

CREATE TABLE orders (
    id_order INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    delivery_date DATE NOT NULL,
    status ENUM('Delivered', 'Not Delivered') DEFAULT 'Not Delivered'
);

INSERT INTO orders (product_name, delivery_date, status)
VALUES 
('Chocolate Muffin', '2024-12-23', 'Not Delivered'),
('Vanilla Milkshake', '2024-12-24', 'Delivered'),
('Apple Pie', '2024-12-25', 'Not Delivered'),
('Pumpkin Bread', '2024-12-26', 'Delivered'),
('Espresso', '2024-12-27', 'Not Delivered');

-- Categories are asigned using the auto increment
INSERT INTO categorias (description) VALUES 
('Bread'), ('Pastries'), ('Cakes'), ('Cookies'), ('Drinks');

-- Inserting the articles for the DB
INSERT INTO articulos (name, precio, descripcion, id_categoria) VALUES
('Baguette', 50.00, 'Traditional French bread with a crispy crust.', 1),
('Sourdough Loaf', 70.00, 'Tangy and chewy sourdough bread.', 1),
('Rye Bread', 60.00, 'Dense and flavorful rye loaf.', 1),
('Ciabatta', 55.00, 'Italian white bread with a porous texture.', 1),
('Cinnamon Roll', 50.00, 'Soft roll with cinnamon and sugar.', 2),
('Danish', 45.00, 'Layered pastry with fruit or custard filling.', 2),
('Puff Pastry Tart', 50.00, 'Light pastry with savory or sweet toppings.', 2),
('Chocolate Cake', 300.00, 'Rich and moist chocolate dessert.', 3),
('Vanilla Sponge Cake', 240.00, 'Classic vanilla-flavored layered cake.', 3),
('Chocolate Chip Cookie', 20.00, 'Soft cookie loaded with chocolate chips.', 4),
('Oatmeal Raisin Cookie', 17.00, 'Chewy cookie with oats and raisins.', 4),
('Snickerdoodle', 16.00, 'Sugar cookie coated with cinnamon and sugar.', 4),
('Peanut Butter Cookie', 22.00, 'Rich cookie with peanut butter flavor.', 4),
('Espresso', 50.00, 'Strong and concentrated coffee shot.', 5),
('Cappuccino', 60.00, 'Espresso with steamed milk and foam.', 5),
('Latte', 65.00, 'Espresso with more milk and a light foam.', 5);

INSERT INTO usuarios (username, password, tipo) VALUES
('admin', '1234', 1),
('user1', 'password1', 2),
('user2', 'password2', 2),
('user3', 'password3', 1),
('user4', 'password4', 2),
('user5', 'password5', 2);

