<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve user input from the form
    $username = $_POST['usuario'];
    $password = $_POST['password']; // Just retrieved here, you can add further validation if needed

    // Validate the username
    if ($username === 'ogiorgio') {
        // Successful login - you can redirect or show a success message
        header("Location: /www.giorgio-oso.com/apuntes/adminTemplate2.html");

    } else {
        // Unsuccessful login - display an error message
        header("Location: login.php");
    }
} else {
    // Redirect back if accessed directly (optional)
    header("Location: login.php");
    exit();
}
?>
