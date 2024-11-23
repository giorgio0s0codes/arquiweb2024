<?php
// URL to the API endpoints
$apiUrl = 'http://52.15.244.98/www.giorgio-oso.com/pruebaTec/CRUD/readAll.php';
$searchApiUrl = 'http://52.15.244.98/www.giorgio-oso.com/pruebaTec/CRUD/searchByName.php';

$products = [];
$searchResult = null;

try {
    // Fetch all products from the API
    $response = file_get_contents($apiUrl);

    if ($response === false) {
        throw new Exception('Failed to fetch data from the API.');
    }

    $products = json_decode($response, true);

    if ($products === null) {
        throw new Exception('Failed to decode JSON.');
    }
} catch (Exception $e) {
    echo "<p>Error loading products: " . htmlspecialchars($e->getMessage()) . "</p>";
}

// Handle search query
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $searchQuery = trim($_POST['search']);
    if (!empty($searchQuery)) {
        try {
            // Use cURL to make a POST request to the search API
            $ch = curl_init($searchApiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, ['name' => $searchQuery]);

            $searchResponse = curl_exec($ch);
            curl_close($ch);

            if ($searchResponse === false) {
                throw new Exception('Failed to fetch search results from the API.');
            }

            $searchResult = json_decode($searchResponse, true);

            if ($searchResult === null) {
                throw new Exception('Failed to decode JSON from search.');
            }
        } catch (Exception $e) {
            echo "<p>Error searching product: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    }
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
        .form-group input, .form-group select {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: block;
            margin: 0 auto;
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

        <!-- Product Registration Form -->
        <div class="col-md-6" style="margin:0 auto; float:none;">
            <form method="POST" action="./CRUD/registerNewProduct.php">
                <h3>Register a New Product</h3>
                <div class="form-group">
                    <label for="nombre">Name</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Enter Name" required />
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" placeholder="Enter Price" required />
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" placeholder="Enter Description" required />
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
                    <input type="submit" value="Submit" />
                </div>
            </form>
        </div>

        <!-- Search Bar -->
        <form method="POST" class="form-group">
            <input type="text" name="search" placeholder="Search for a product by name" required />
            <input type="submit" value="Search" />
        </form>

        <!-- Search Result -->
        <?php if ($searchResult): ?>
            <h3>Search Result</h3>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Category</th>
                </tr>
                <tr>
                    <td><?= htmlspecialchars($searchResult['id_articulo']) ?></td>
                    <td><?= htmlspecialchars($searchResult['name']) ?></td>
                    <td><?= htmlspecialchars($searchResult['precio']) ?></td>
                    <td><?= htmlspecialchars($searchResult['descripcion']) ?></td>
                    <td><?= htmlspecialchars($searchResult['id_categoria']) ?></td>
                </tr>
            </table>
        <?php endif; ?>

        <!-- Product List -->
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
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['id_articulo']) ?></td>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['precio']) ?></td>
                    <td><?= htmlspecialchars($product['descripcion']) ?></td>
                    <td><?= htmlspecialchars($product['id_categoria']) ?></td>
                    <td>
                        <form method="POST" action="./CRUD/deleteProduct.php" onsubmit="return confirmDelete(event, this);">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($product['id_articulo']) ?>">
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <script>
        function confirmDelete(event, form) {
            event.preventDefault(); // Prevent the form from submitting immediately
            if (confirm('Are you sure you want to delete this product?')) {
                form.submit(); // Submit the form if confirmed
            }
        }
    </script>
</body>
</html>
