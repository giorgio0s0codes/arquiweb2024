<?php
require '../config/configDB.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    echo "<p>Invalid or missing order ID</p>";
    exit();
}

$order = null;

try {
    $stmt = $CNX->prepare("SELECT id_order, product_name, delivery_date, status FROM orders WHERE id_order = ?");
    $stmt->execute([$id]);
    $order = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        echo "<p>Order not found</p>";
        exit();
    }
} catch (Exception $e) {
    echo "<p>Error fetching order: " . htmlspecialchars($e->getMessage()) . "</p>";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = trim($_POST['product_name']);
    $delivery_date = trim($_POST['delivery_date']);
    $status = trim($_POST['status']);

    if ($product_name && $delivery_date && $status) {
        try {
            $stmt = $CNX->prepare("UPDATE orders SET product_name = ?, delivery_date = ?, status = ? WHERE id_order = ?");
            $stmt->execute([$product_name, $delivery_date, $status, $id]);

            header('Location: ../templates/orders.php?message=Order+updated+successfully');
            exit();
        } catch (Exception $e) {
            echo "<p>Error updating order: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p>All fields are required</p>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 65%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group input[type="submit"] {
            background-color: #17a2b8;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #138496;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Order</h2>
        <form method="POST">
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" id="product_name" name="product_name" value="<?= htmlspecialchars($order['product_name']) ?>" required />
            </div>
            <div class="form-group">
                <label for="delivery_date">Delivery Date</label>
                <input type="date" id="delivery_date" name="delivery_date" value="<?= htmlspecialchars($order['delivery_date']) ?>" required />
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" name="status" required>
                    <option value="Not Delivered" <?= $order['status'] == 'Not Delivered' ? 'selected' : '' ?>>Not Delivered</option>
                    <option value="Delivered" <?= $order['status'] == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Update Order" />
            </div>
        </form>
    </div>
</body>
</html>

