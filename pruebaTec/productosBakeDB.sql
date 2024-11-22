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
    id_categoria INT,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);

INSERT INTO categorias (description) VALUES 
('Bread'), ('Pastries'), ('Cakes'), ('Cookies'), ('Drinks');

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



