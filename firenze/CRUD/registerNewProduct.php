<?php
require '../config/configBakeDB.php'; // Include database connection

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Only POST requests are allowed']);
    exit();
}

// Validate the required fields in $_POST
if (!isset($_POST['nombre'], $_POST['price'], $_POST['description'], $_POST['category'])) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Missing required fields: nombre, price, description, category']);
    exit();
}

try {
    // Check if a product with the same name already exists
    $checkStmt = $CNX->prepare("SELECT COUNT(*) FROM articulos WHERE name = ?");
    $checkStmt->execute([$_POST['nombre']]);
    $productExists = $checkStmt->fetchColumn() > 0;

    if ($productExists) {
        http_response_code(409); // Conflict
        echo json_encode(['error' => 'A product with the same name already exists']);
        exit();
    }

    // Prepare the INSERT statement
    $stmt = $CNX->prepare("INSERT INTO articulos (name, precio, descripcion, id_categoria) VALUES (?, ?, ?, ?)");

    // Execute the query with the provided data
    $stmt->execute([
        $_POST['nombre'],
        $_POST['price'],
        $_POST['description'],
        $_POST['category'] // Assuming the frontend sends the category ID
    ]);

    // Redirect to siteBake.php after successful insertion
    header('Location: ../siteBake.php');
    exit(); // Ensure no further processing happens
} catch (Exception $e) {
    // Handle database errors
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Error al crear el producto', 'details' => $e->getMessage()]);
}
?>
