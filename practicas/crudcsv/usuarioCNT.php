<?php
// Initialize variables
$usuario = $nombre = $apellido_paterno = $apellido_materno = $mail = $password = "";
$error = "";

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $number_choice = $_POST['number_choice'];

    // Validate form data
    if (empty($usuario) || empty($nombre) || empty($apellido_paterno) || empty($apellido_materno) || empty($mail) || empty($password) || empty($number_choice)) {
        $error = "All fields are required.";
    } else {
        // Store data in CSV file
        $file = fopen('./DB/usuarios.csv', 'a');
        fputcsv($file, [$usuario, $nombre, $apellido_paterno, $apellido_materno, $mail, $password, $number_choice]);
        fclose($file);

        // Clear form data
        $usuario = $nombre = $apellido_paterno = $apellido_materno = $mail = $password = "";

    }
}

// Display form and user data
include 'usuarios.php';
?>
