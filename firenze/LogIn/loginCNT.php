<?php
require '../config/configDB.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    $username = $_POST['usuario'];
    $password = $_POST['password']; 

    try {
        // Fetch user data, including type
        $stmt = $CNX->prepare("SELECT tipo FROM usuarios WHERE password = ? AND username = ?");
        $stmt->execute([$password, $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $_SESSION["log"] = true;
            $_SESSION["usuario"] = $username;
            $_SESSION["correo"] = "{$username}@firenzepasticceria.com";

            // Redirect based on user type
            if ($user['tipo'] == 1) {
                header("Location: ../templates/home.php");
            } elseif ($user['tipo'] == 2) {
                header("Location: ../normtemplates/home.php");
            } else {
                // Handle unexpected user types
                $_SESSION['error'] = 'User type not recognized.';
                header("Location: login.php");
            }
        } else {
            // Invalid username or password
            $_SESSION['error'] = '***Incorrect password or username.***';
            header("Location: login.php");
        }

        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = 'Error verifying the user.';
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
