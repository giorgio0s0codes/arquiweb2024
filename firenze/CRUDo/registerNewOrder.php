<?php
require '../config/configDB.php'; // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = trim($_POST['product_name']);
    $delivery_date = trim($_POST['delivery_date']);
    $status = trim($_POST['status']);

    if ($product_name && $delivery_date && $status) {
        try {
            $stmt = $CNX->prepare("INSERT INTO orders (product_name, delivery_date, status) VALUES (?, ?, ?)");
            $stmt->execute([$product_name, $delivery_date, $status]);

            header('Location: ../templates/orders.php?success=Order+registered+successfully');
            exit();
        } catch (Exception $e) {
            echo "<p>Error creating order: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p>All fields are required</p>";
    }
}
?>
