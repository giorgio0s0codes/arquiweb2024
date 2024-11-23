<?php
// URL to the API endpoint
$apiUrl = 'http://52.15.244.98/www.giorgio-oso.com/pruebaTec/CRUD/readAll.php';
$products = [];

try {
    // Fetch data from the API
    $response = file_get_contents($apiUrl);

    // Check if the response is false
    if ($response === false) {
        throw new Exception('Failed to fetch data from the API.');
    }

    // Decode the JSON response into a PHP array
    $products = json_decode($response, true);

    // Check if decoding was successful
    if ($products === null) {
        throw new Exception('Failed to decode JSON.');
    }
} catch (Exception $e) {
    echo "<p>Error loading products: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>




<!DOCTYPE html>
<html>
<head>
    <title>Product Registry</title>
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
        h2, h3 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: block;
            margin: 0 auto;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-group input[type="submit"] {
            background-color: #17a2b8;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #138496;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        .action-buttons button {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .edit-button {
            background-color: #28a745;
            color: white;
        }
        .delete-button {
            background-color: #dc3545;
            color: white;
        }
        .edit-button:hover {
            background-color: #218838;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Product Registry</h2>
        <div class="col-md-6" style="margin:0 auto; float:none;">
            <form method="POST" action="./CRUD/registerNewProduct.php">
                <h3>Product Info</h3>
                <?php if (!empty($error)) echo "<p>$error</p>"; ?>
                <div class="form-group">
                    <label for="nombre">Name</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Enter Name" value="" required />
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" placeholder="Enter Price" value="" required />
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" placeholder="Enter Description" value="" required />
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category" required>
                        <option value="1">Bread</option>
                        <option value="2">Pastries</option>
                        <option value="3">Cakes</option>
                        <option value="4">Cookies</option>
                        <option value="5">Drinks</option>
                    </select>
                </div>
                <div class="form-group" align="center">
                    <input type="submit" name="submit" value="Submit" />
                </div>
            </form>
        </div>

        <!-- Product List Table -->
        <h3>Product List</h3>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
            <?php if (!empty($products)): ?>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['id_articulo']) ?></td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['precio']) ?></td>
                        <td><?= htmlspecialchars($product['descripcion']) ?></td>
                        <td><?= htmlspecialchars($product['id_categoria']) ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="./CRUD/editProduct.php?id=<?= urlencode($product['id_articulo']) ?>" class="edit-button">Edit</a>
                                <a href="./CRUD/deleteProduct.php?id=<?= urlencode($product['id_articulo']) ?>" class="delete-button">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No products found</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
