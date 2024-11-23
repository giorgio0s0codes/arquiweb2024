<?php
require '../config/configBakeDB.php'; // Include the database connection

// Get the ID from the query string
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    echo "<p>Invalid or missing product ID</p>";
    exit();
}

$product = null;

// Fetch the product details
try {
    $stmt = $CNX->prepare("SELECT * FROM articulos WHERE id_articulo = ?");
    $stmt->execute([$id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "<p>Product not found</p>";
        exit();
    }
} catch (Exception $e) {
    echo "<p>Error fetching product: " . htmlspecialchars($e->getMessage()) . "</p>";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $precio = trim($_POST['precio']);
    $descripcion = trim($_POST['descripcion']);
    $id_categoria = trim($_POST['id_categoria']);

    if ($name && $precio && $descripcion && $id_categoria) {
        try {
            $stmt = $CNX->prepare("UPDATE articulos SET name = ?, precio = ?, descripcion = ?, id_categoria = ? WHERE id_articulo = ?");
            $stmt->execute([$name, $precio, $descripcion, $id_categoria, $id]);

            header('Location: ../siteBake.php?message=Producto+actualizado+con+éxito');
            exit();
        } catch (Exception $e) {
            echo "<p>Error updating product: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p>All fields are required</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
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
        <h2>Edit Product</h2>
        <form method="POST">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required />
            </div>
            <div class="form-group">
                <label for="precio">Price</label>
                <input type="number" id="precio" name="precio" value="<?= htmlspecialchars($product['precio']) ?>" required />
            </div>
            <div class="form-group">
                <label for="descripcion">Description</label>
                <input type="text" id="descripcion" name="descripcion" value="<?= htmlspecialchars($product['descripcion']) ?>" required />
            </div>
            <div class="form-group">
                <label for="id_categoria">Category</label>
                <select id="id_categoria" name="id_categoria" required>
                    <option value="1" <?= $product['id_categoria'] == 1 ? 'selected' : '' ?>>Bread</option>
                    <option value="2" <?= $product['id_categoria'] == 2 ? 'selected' : '' ?>>Pastries</option>
                    <option value="3" <?= $product['id_categoria'] == 3 ? 'selected' : '' ?>>Cakes</option>
                    <option value="4" <?= $product['id_categoria'] == 4 ? 'selected' : '' ?>>Cookies</option>
                    <option value="5" <?= $product['id_categoria'] == 5 ? 'selected' : '' ?>>Drinks</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Update Product" />
            </div>
        </form>
    </div>
</body>
</html>
