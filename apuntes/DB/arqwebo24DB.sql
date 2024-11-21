drop DATABASE if exists arqwebo2024;
CREATE DATABASE arqwebo2024;

USE arqwebo2024;

CREATE TABLE categorias (
    id_categoria INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    description VARCHAR(35) NOT NULL
);

CREATE TABLE articulos (
    id_articulo INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    descripcion VARCHAR(100) NOT NULL,
    precio DECIMAL(15,2),
    id_categoria INT,
    stock INT NOT NULL DEFAULT 0,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id_categoria)
);

-- Insert categories if not already present
INSERT INTO categorias (description) VALUES 
('Bread'), ('Pastries'), ('Cakes'), ('Cookies'), ('Drinks');

-- Insert 50 sample bakery items into `articulos`
INSERT INTO articulos (descripcion, precio, id_categoria, stock) VALUES
('Baguette', 2.50, 1, 20),
('Sourdough Loaf', 3.50, 1, 15),
('Croissant', 1.75, 2, 40),
('Pain au Chocolat', 2.00, 2, 30),
('Cinnamon Roll', 2.25, 2, 25),
('Chocolate Cake', 15.00, 3, 5),
('Vanilla Sponge Cake', 12.00, 3, 8),
('Red Velvet Cake', 18.00, 3, 4),
('Sugar Cookie', 0.75, 4, 100),
('Chocolate Chip Cookie', 1.00, 4, 80),
('Oatmeal Raisin Cookie', 0.90, 4, 60),
('Cappuccino', 3.00, 5, 50),
('Espresso', 2.50, 5, 60),
('Latte', 3.25, 5, 45),
('Iced Coffee', 3.00, 5, 40),
('Banana Bread', 2.50, 1, 30),
('Brioche Bun', 1.25, 1, 25),
('Apple Pie', 10.00, 3, 6),
('Cheesecake Slice', 4.50, 3, 15),
('Muffin', 1.75, 2, 40),
('Raspberry Danish', 2.00, 2, 30),
('Pumpkin Bread', 2.75, 1, 20),
('Focaccia', 2.50, 1, 15),
('Brownie', 1.50, 4, 50),
('Macaron', 1.25, 4, 80),
('Tiramisu', 5.00, 3, 10),
('Lemon Tart', 4.00, 3, 12),
('Eclair', 2.25, 2, 35),
('Blueberry Scone', 1.75, 2, 30),
('Matcha Latte', 3.75, 5, 25),
('Hot Chocolate', 2.75, 5, 40),
('Flat White', 3.25, 5, 50),
('Bagel', 1.50, 1, 60),
('Glazed Donut', 1.00, 2, 50),
('Carrot Cake', 14.00, 3, 5),
('Cupcake', 2.00, 3, 40),
('Almond Biscotti', 0.85, 4, 70),
('Fruit Tart', 4.50, 3, 8),
('Matcha Cookie', 1.00, 4, 55),
('Rugelach', 1.50, 4, 45),
('Pecan Pie', 10.00, 3, 6),
('Scone', 1.75, 2, 25),
('Flatbread', 2.25, 1, 20),
('Chocolate Mousse', 5.00, 3, 10),
('Mocha', 3.50, 5, 35),
('Espresso Macchiato', 2.75, 5, 50),
('Lemon Drizzle Cake', 15.00, 3, 5),
('Walnut Bread', 2.50, 1, 20),
('Pumpkin Pie', 10.00, 3, 5),
('Iced Tea', 2.50, 5, 50);

