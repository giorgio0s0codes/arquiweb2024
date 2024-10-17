<?php
include "funcionesplanes.php";
// Initialize variables
$id = $nombre = "";
$error = "";

// Process form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "Entro a 1.\n";
    if(isset($_POST['edit'])){
        echo "Entro a editar.\n";
        $newData = [
            "id" => $_POST['id'],
            "nombre" => $_POST['nombre']
        ];
        editarPlan($_POST['id'], $newData);
    }

    else {
        echo "Entro a guardar.\n";
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];

        // Validate form data
            // Store data in CSV file
            $file = fopen('./DB/planes.csv', 'a');
            fputcsv($file, [$id, $nombre]);
            fclose($file);

            // Clear form data
            $id = $nombre = "";
    }
}
else {  
    echo "Entro a borrar.\n";
    if(isset($_GET['action'])){
        borrarId($_GET['id']);
    }
}


header('Location: planes.php');

// Display form and user data
include 'planes.php';
?>
