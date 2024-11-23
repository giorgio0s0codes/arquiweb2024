<?php
require '../config/configBakeDB.php';

try {
    $stmt = $CNX->prepare("SELECT * FROM articulos");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');
    echo json_encode($products);
} catch (Exception $e) {
    header('Content-Type: application/json', true, 500);
    echo json_encode(['error' => $e->getMessage()]);
}
