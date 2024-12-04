<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user input from the form
    $username = $_POST['usuario'];
    $password = $_POST['password']; // Just retrieved here, you can add further validation if needed

    // Validate the username
    if ($username === 'admin' && $password == '1234') {
        // Successful login - you can redirect or show a success message

        session_start();
        $_SESSION["log"] = true;
        $_SESSION["usuario"] = 'admin';
        $_SESSION["correo"] = 'admin@firenzepasticceria.com';

        header("Location: adminTemplate3.php");

    } else {
        // Unsuccessful login - display an error message
        header("Location: login2.php");
    }
} else {
    // Redirect back if accessed directly (optional)
    header("Location: login2.php");
    exit();
}
?>
