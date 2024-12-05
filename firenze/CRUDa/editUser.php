<?php
require '../config/configDB.php'; // Include the database connection

// Get the ID from the query string
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    echo "<p>Invalid or missing user ID</p>";
    exit();
}

$user = null;

// Fetch the user details
try {
    $stmt = $CNX->prepare("SELECT id_usuario, username, password, tipo FROM usuarios WHERE id_usuario = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "<p>User not found</p>";
        exit();
    }
} catch (Exception $e) {
    echo "<p>Error fetching user: " . htmlspecialchars($e->getMessage()) . "</p>";
    exit();
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $tipo = trim($_POST['tipo']);
    $password = trim($_POST['password']);

    if ($username && $tipo) {
        try {
            if ($password) {
                // Update with a new password
                $stmt = $CNX->prepare("UPDATE usuarios SET username = ?, tipo = ?, password = ? WHERE id_usuario = ?");
                $stmt->execute([$username, $tipo, $password, $id]);
            } else {
                // Update without changing the password
                $stmt = $CNX->prepare("UPDATE usuarios SET username = ?, tipo = ? WHERE id_usuario = ?");
                $stmt->execute([$username, $tipo, $id]);
            }

            header('Location: ../templates/accounts.php?message=User+updated+successfully');
            exit();
        } catch (Exception $e) {
            echo "<p>Error updating user: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
    } else {
        echo "<p>All fields except password are required</p>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
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
        <h2>Edit User</h2>
        <form method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" id="password" name="password" placeholder="Enter new password (leave blank to keep current)" />
            </div>
            <div class="form-group">
                <label for="tipo">User Type</label>
                <select id="tipo" name="tipo" required>
                    <option value="1" <?= $user['tipo'] == 1 ? 'selected' : '' ?>>Admin</option>
                    <option value="2" <?= $user['tipo'] == 2 ? 'selected' : '' ?>>User</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Update User" />
            </div>
        </form>
    </div>
</body>
</html>
