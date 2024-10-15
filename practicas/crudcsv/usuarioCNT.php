<?php
include "funciones.php";
// Initialize variables
$usuario = $nombre = $apellido_paterno = $apellido_materno = $mail = $password = "";
$error = "";

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if this is an edit or delete request
    if (isset($_POST['edit'])) {
        // Edit user logic
        // Try to make it receive it as an asociative array, it looks like this editarUsuario($usrsrch, $newData)
        $newData = [
            "nombre" => $_POST['nombre'],
            "apellidoP" => $_POST['apellido_paterno'],
            "apellidoM" => $_POST['apellido_materno'],
            "correo" => $_POST['mail'],
            "password" => $_POST['password'],
            "plan" => $_POST['number_choice'] // Assuming this is the field you want to map to "plan"
        ];

        // Call the editarUsuario function, passing the user's username (to search) and the new data
        editarUsuario($_POST['usuario'], $newData);
    } 
    else {
        // Add new user logic (when neither edit nor delete is set)
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
}

    else{
     if(isset($_GET['action'])) {
        // Delete user logic
        borrarUsuario($_GET['user']);
     }
}
header('Location: usuarios.php');

// Display form and user data
include 'usuarios.php';
?>
