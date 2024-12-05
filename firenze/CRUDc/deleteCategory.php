<?php
require '../config/configDB.php';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the ID from POST data
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($id) {
        try {
            // Prepare and execute the delete query
            $stmt = $CNX->prepare("DELETE FROM categorias WHERE id_categoria = ?");
            $stmt->execute([$id]);

            // Redirect back to siteBake.php on success
            header('Location: ../templates/categories.php?message=Producto+eliminado+con+éxito');
            exit();
        } catch (Exception $e) {
            // Redirect back with an error message
            header('Location: ../templates/categories.php?error=' . urlencode('Error al eliminar el producto: ' . $e->getMessage()));
            exit();
        }
    } else {
        // Redirect back with an invalid ID error
        header('Location: ../templates/categories.php?error=ID+inválido+o+no+proporcionado');
        exit();
    }
} else {
    // Redirect back with an invalid request method error
    header('Location: ../templates/categories.php?error=Solo+se+permiten+solicitudes+POST');
    exit();
}
?>
