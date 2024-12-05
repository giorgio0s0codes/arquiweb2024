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
            <a class="navbar-brand" href="#">Mi Admin Template</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
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
                            <a href="/home" class="btn btn-toggle align-items-center rounded">
                                Home
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="/dashboard" class="btn btn-toggle align-items-center rounded">
                                Dashboard
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="/orders" class="btn btn-toggle align-items-center rounded">
                                Orders
                            </a>
                        </li>
                        <li class="mb-1">
                            <a href="/account" class="btn btn-toggle align-items-center rounded">
                                Account
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9">
                <div class="bg-white p-4 border rounded">
                    <h2>Área de Contenido</h2>
                    <p>Aquí va mi contenido y esta es el área donde debe aparecer:</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in neque et nisl tempus aliquam.</p>
                </div>
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
                                    <td><?= htmlspecialchars($product['id_categoria']) ?></td>
                                    <td>
                                        <!-- Edit Button -->
                                        <form method="GET" action="./CRUD/editProduct.php" style="display: inline;">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($product['id_articulo']) ?>">
                                            <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                                        </form>
                                        <!-- Delete Button -->
                                        <form method="POST" action="./CRUD/deleteProduct.php" onsubmit="return confirmDelete(event, this);" style="display: inline;">
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