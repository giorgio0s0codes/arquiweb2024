<?php
require '../config/configDB.php';

try {
    // Fetch products with category description
    $stmt = $CNX->prepare("
        SELECT 
            articulos.id_articulo, 
            articulos.name, 
            articulos.precio, 
            articulos.descripcion, 
            categorias.description AS category_description
        FROM 
            articulos
        LEFT JOIN 
            categorias ON articulos.id_categoria = categorias.id_categoria
    ");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($products);
} catch (Exception $e) {
    header('Content-Type: application/json', true, 500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
