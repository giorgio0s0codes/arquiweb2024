<?php
    session_start();

    if (!isset($_SESSION["log"]) || $_SESSION["log"] != true) {
        header("Location: /var/www/html/www.giorgio-oso.com/firenze/LogIn/login.php");
        exit();
    }
    $apiUrl = 'http://52.15.244.98/www.giorgio-oso.com/firenze/CRUDc/readAll.php';
    $categories = [];
    $searchResult = null;

    try {
        // Fetch all products from the API
        $response = file_get_contents($apiUrl);

        if ($response === false) {
            throw new Exception('Failed to fetch data from the API.');
        }

        $categories = json_decode($response, true);

        if ($categories === null) {
            throw new Exception('Failed to decode JSON.');
        }
    } catch (Exception $e) {
        echo "<p>Error loading categories: " . htmlspecialchars($e->getMessage()) . "</p>";
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
            <a class="navbar-brand" href="home.php">Firenze</a>
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
            <form method="POST" action="../CRUDc/registerNewCategory.php" class="p-4 border rounded bg-white shadow-sm">
                <h3 class="mb-4">Register a New Category</h3>
                <div class="form-group mb-3">
                    <label for="description" class="form-label">Category Description</label>
                    <input type="text" id="description" name="description" class="form-control" placeholder="Enter Category Description" required />
                </div>

                <div class="form-group text-center">
                    <input type="submit" value="Add Category" class="btn btn-primary w-50" />
                </div>
            </form>

                <h3>Categories List</h3>
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $category): ?>
                                <tr>
                                    <td><?= htmlspecialchars($category['id_categoria']) ?></td>
                                    <td><?= htmlspecialchars($category['description']) ?></td>
                                    <td>
                                        <!-- Edit Button -->
                                        <form method="GET" action="../CRUDc/editCategory.php" style="display: inline;">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($category['id_categoria']) ?>">
                                            <button type="submit" class="btn btn-sm btn-primary">Edit</button>
                                        </form>
                                        <!-- Delete Button -->
                                        <form method="POST" action="../CRUDc/deleteCategory.php" onsubmit="return confirmDelete(event, this);" style="display: inline;">
                                            <input type="hidden" name="id" value="<?= htmlspecialchars($category['id_categoria']) ?>">
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