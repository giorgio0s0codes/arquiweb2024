<?php
    session_start();

    if (!isset($_SESSION["log"]) || $_SESSION["log"] != true) {
        header("Location: /var/www/html/www.giorgio-oso.com/firenze/LogIn/login.php");
        exit();
    }
    $apiUrl = 'http://52.15.244.98/www.giorgio-oso.com/firenze/CRUD/readAll.php';
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

    require '../config/configDB.php'; // Include database connection

    $categories = [];

    try {
        // Fetch categories from the database
        $stmt = $CNX->prepare("SELECT id_categoria, description FROM categorias");
        $stmt->execute();
        $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "<p>Error fetching categories: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Firenze Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
          crossorigin="anonymous">
</head>
<body>
    
    <!-- Header -->
    <header class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Firenze</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-sm btn-outline-light" href="../LogIn/logout.php" onclick="return confirm('Are you sure you want to log out?')">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="container-fluid mt-3">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="bg-white p-3 border rounded">
                    <h5>Navigation</h5>
                    <ul class="list-unstyled">
                        <li class="mb-1">
                            <a href="home.php" class="btn btn-toggle align-items-center rounded">
                                Home
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="accounts.php" class="btn btn-toggle align-items-center rounded">
                                Accounts
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="orders.php" class="btn btn-toggle align-items-center rounded">
                                Orders
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="categories.php" class="btn btn-toggle align-items-center rounded">
                                Categories
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="search.php" class="btn btn-toggle align-items-center rounded">
                                Search
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9">
                <form method="POST" action="../CRUD/registerNewProduct.php" class="p-4 border rounded bg-white shadow-sm">
                    <h3 class="mb-4">Register a New Product</h3>
                    
                    <div class="form-group mb-3">
                        <label for="nombre" class="form-label">Name</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Enter Name" required />
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" id="price" name="price" class="form-control" placeholder="Enter Price" required />
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" id="description" name="description" class="form-control" placeholder="Enter Description" required />
                    </div>
                    
                    <div class="form-group mb-4">
                        <label for="category" class="form-label">Category</label>
                        <select id="category" name="category" class="form-select" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= htmlspecialchars($category['id_categoria']) ?>">
                                    <?= htmlspecialchars($category['description']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group text-center">
                        <input type="submit" value="Submit" class="btn btn-primary w-50" />
                    </div>
                </form>

                <h3>Product List</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= htmlspecialchars($product['id_articulo']) ?></td>
                                    <td><?= htmlspecialchars($product['name']) ?></td>
                                    <td><?= htmlspecialchars($product['precio']) ?></td>
                                    <td><?= htmlspecialchars($product['descripcion']) ?></td>
                                    <td><?= htmlspecialchars($product['category_description']) ?></td>
                                    <td>
                                        <!-- Edit Button -->
                                        <form method="GET" action="../CRUD/editProduct.php" style="display: inline;">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($product['id_articulo']) ?>">
                                            <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                                        </form>
                                        <!-- Delete Button -->
                                        <form method="POST" action="../CRUD/deleteProduct.php" onsubmit="return confirmDelete(event, this);" style="display: inline;">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($product['id_articulo']) ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
            crossorigin="anonymous"></script>
</body>
</html>