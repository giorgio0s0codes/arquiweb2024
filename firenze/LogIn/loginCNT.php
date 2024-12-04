<?php
require '../config/configDB.php';




if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['usuario'];
    $password = $_POST['password']; 

    try {
    
        $checkStmt = $CNX->prepare("SELECT COUNT(*) FROM usuarios WHERE password = ? AND username = ?");
        $checkStmt->execute([$_POST['password'],$_POST['usuario']]);
        $userExists = $checkStmt->fetchColumn() > 0;
    
        if ($userExists) {
            session_start();
            $_SESSION["log"] = true;
            $_SESSION["usuario"] = $username;
            $_SESSION["correo"] = "{$username}@firenzepasticceria.com";

            header("Location: adminTemplate3.php");
        } else {
            header("Location: login.php");
        }

        exit();

    } catch (Exception $e) {
        echo json_encode(['error' => 'Error al verificar el usuario', 'details' => $e->getMessage()]);
        exit();
    }

} else {
    header("Location: login.php");
    exit();
}
?>
