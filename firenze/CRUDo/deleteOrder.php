<?php
require '../config/configDB.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($id) {
        try {
            $stmt = $CNX->prepare("DELETE FROM orders WHERE id_order = ?");
            $stmt->execute([$id]);

            header('Location: ../templates/orders.php?message=Order+deleted+successfully');
            exit();
        } catch (Exception $e) {
            header('Location: ../templates/orders.php?error=' . urlencode('Error deleting order: ' . $e->getMessage()));
            exit();
        }
    } else {
        header('Location: ../templates/orders.php?error=Invalid+or+missing+ID');
        exit();
    }
} else {
    header('Location: ../templates/orders.php?error=Only+POST+requests+are+allowed');
    exit();
}
