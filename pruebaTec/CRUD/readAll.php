<?php
//Connects to the DB using config file.
require '../config/configBakeDB.php';

try {
    // Recovers info with a query and saves it on stmt.
    $stmt = $CNX->prepare("SELECT * FROM articulos");
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    header('Content-Type: application/json');

    // JSON encodes the response.
    echo json_encode($products);

    // In case it Fails
} catch (Exception $e) {
    header('Content-Type: application/json', true, 500);
    echo json_encode(['error' => $e->getMessage()]);
}
