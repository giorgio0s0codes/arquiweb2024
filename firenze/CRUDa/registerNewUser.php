<?php
require '../config/configDB.php'; // Include database connection

// Ensure the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Only POST requests are allowed']);
    exit();
}

// Validate the required fields in $_POST
if (!isset($_POST['username'], $_POST['password'], $_POST['type'])) {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Missing required fields: username, password, type']);
    exit();
}

try {
    // Check if a user with the same username already exists
    $checkStmt = $CNX->prepare("SELECT COUNT(*) FROM usuarios WHERE username = ?");
    $checkStmt->execute([$_POST['username']]);
    $userExists = $checkStmt->fetchColumn() > 0;

    if ($userExists) {
        http_response_code(409); // Conflict
        echo json_encode(['error' => 'A user with the same username already exists']);
        exit();
    }


    // Prepare the INSERT statement
    $stmt = $CNX->prepare("INSERT INTO usuarios (username, password, tipo) VALUES (?, ?, ?)");

    // Execute the query with the provided data
    $stmt->execute([
        $_POST['username'],
        $_POST['password'],
        $_POST['type']
    ]);

    // Redirect to the user list page after successful insertion
    header('Location: ../templates/accounts.php?success=User+registered+successfully');
    exit();
} catch (Exception $e) {
    // Handle database errors
    http_response_code(500); // Internal Server Error
    echo json_encode(['error' => 'Error creating user', 'details' => $e->getMessage()]);
}
