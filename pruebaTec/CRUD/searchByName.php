<?php
require '../config/configBakeDB.php'; // Include the database connection

// Get the product name from the URL
$productName = urldecode(basename($_SERVER['REQUEST_URI']));

// Prepare and execute the query
$stmt = $CNX->prepare("SELECT * FROM articulos WHERE name = ?");
$stmt->execute([$productName]);

// Fetch the result and return as JSON
header('Content-Type: application/json');
echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
