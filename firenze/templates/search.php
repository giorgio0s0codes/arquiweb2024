<?php
    session_start();

    if (!isset($_SESSION["log"]) || $_SESSION["log"] != true) {
        header("Location: /var/www/html/www.giorgio-oso.com/firenze/LogIn/login.php");
        exit();
    }
    $apiUrl = 'http://52.15.244.98/www.giorgio-oso.com/firenze/CRUD/readAll.php';
    $searchApiUrl = 'http://52.15.244.98/www.giorgio-oso.com/firenze/CRUD/searchByName.php';
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
                <!-- Search Bar -->
                <form method="POST" action="" class="p-3 border rounded bg-white shadow-sm mb-4" style="max-width: 500px; margin: 0 auto;">
                    <h4 class="text-center mb-3">Search for a Product</h4>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control form-control-sm" placeholder="Enter product name" required />
                        <button type="submit" class="btn btn-primary btn-sm">Search</button>
                    </div>
                </form>

                <!-- Search Result -->
                <?php if ($searchResult): ?>
                    <h4 class="text-center mt-4">Search Result</h4>
                    <div class="table-responsive" style="max-width: 800px; margin: 0 auto;">
                        <table class="table table-striped table-hover table-sm table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= htmlspecialchars($searchResult['id_articulo']) ?></td>
                                    <td><?= htmlspecialchars($searchResult['name']) ?></td>
                                    <td><?= htmlspecialchars($searchResult['precio']) ?></td>
                                    <td><?= htmlspecialchars($searchResult['descripcion']) ?></td>
                                    <td><?= htmlspecialchars($searchResult['id_categoria']) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                    <p class="text-center text-danger mt-3">No results found for "<?= htmlspecialchars(trim($_POST['search'])) ?>".</p>
                <?php endif; ?>

                </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
            crossorigin="anonymous"></script>
</body>
</html>