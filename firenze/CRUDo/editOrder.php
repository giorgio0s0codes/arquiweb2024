<?php
require '../config/configDB.php'; // Include the database connection

// Get the ID from the query string
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    echo "<p>Invalid or missing category ID</p>";
    exit();
}

$category = null;

// Fetch the category details
try {
    $stmt = $CNX->prepare("SELECT id_categoria, description FROM categorias WHERE id_categoria = ?");
    $stmt->execute([$id]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$category) {
        echo "<p>Category not found</p>";
        exit();
    }
} catch (Exception $e) {
    echo "<p>Error fetching category: " . htmlspecialchars($e->getMessage()) . "</p>";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $description = trim($_POST['description']);

    if ($description) {
        try {
            // Update the category details
            $stmt = $CNX->prepare("UPDATE categorias SET description = ? WHERE id_categoria = ?");
            $stmt->execute([$description, $id]);

            header('Location: ../templates/categories.php?message=Category+updated+successfully');
            exit();
        } catch (Exception $e) {
            echo "<p>Error updating category: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p>Description is required</p>";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
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
        .form-group input {
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
        <h2>Edit Category</h2>
        <form method="POST">
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" id="description" name="description" value="<?= htmlspecialchars($category['description']) ?>" required />
            </div>
            <div class="form-group">
                <input type="submit" value="Update Category" />
            </div>
        </form>
    </div>
</body>
</html>
