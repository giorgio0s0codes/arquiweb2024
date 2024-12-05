<?php
require '../config/configDB.php'; // Include the database connection

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the product name from the POST data
    $productName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($productName) {
        try {
            // Prepare and execute the query
            $stmt = $CNX->prepare("SELECT * FROM articulos WHERE name = ?");
            $stmt->execute([$productName]);

            // Fetch the result and return as JSON
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            header('Content-Type: application/json');
            echo json_encode($product ? $product : ['message' => 'Product not found']);
        } catch (Exception $e) {
            // Handle database errors
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Error fetching product', 'details' => $e->getMessage()]);
        }
    } else {
        // Handle missing or invalid product name
        http_response_code(400);
        header('Content-Type: application/json');
        echo json_encode(['error' => 'Product name is required']);
    }
} else {
    // Handle invalid request method
    http_response_code(405);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Only POST requests are allowed']);
}
?>
