<?php
require '../config/configDB.php'; // Include database connection

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Only POST requests are allowed']);
    exit();
}

// Validate the required fields in $_POST
if (!isset($_POST['description'])) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Missing required fields: description']);
    exit();
}

try {
    // Check if a category with the same description already exists
    $checkStmt = $CNX->prepare("SELECT COUNT(*) FROM categorias WHERE description = ?");
    $checkStmt->execute([$_POST['description']]);
    $categoryExists = $checkStmt->fetchColumn() > 0;

    if ($categoryExists) {
        http_response_code(409); // Conflict
        echo json_encode(['error' => 'A category with the same description already exists']);
        exit();
    }

    // Prepare the INSERT statement
    $stmt = $CNX->prepare("INSERT INTO categorias (description) VALUES (?)");

    // Execute the query with the provided data
    $stmt->execute([$_POST['description']]);

    // Redirect to the categories list page after successful insertion
    header('Location: ../templates/categories.php?success=Category+added+successfully');
    exit();
} catch (Exception $e) {
    // Handle database errors
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Error creating category', 'details' => $e->getMessage()]);
}
?>
