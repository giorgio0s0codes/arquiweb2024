<?php
require '../config/configBakeDB.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the ID from POST data
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($id) {
        try {
            // Prepare and execute the delete query
            $stmt = $CNX->prepare("DELETE FROM articulos WHERE id_articulo = ?");
            $stmt->execute([$id]);

            // Redirect back to siteBake.php on success
            header('Location: ../siteBake.php?message=Producto+eliminado+con+éxito');
            exit();
        } catch (Exception $e) {
            // Redirect back with an error message
            header('Location: ../siteBake.php?error=' . urlencode('Error al eliminar el producto: ' . $e->getMessage()));
            exit();
        }
    } else {
        // Redirect back with an invalid ID error
        header('Location: ../siteBake.php?error=ID+inválido+o+no+proporcionado');
        exit();
    }
} else {
    // Redirect back with an invalid request method error
    header('Location: ../siteBake.php?error=Solo+se+permiten+solicitudes+POST');
    exit();
}
?>
