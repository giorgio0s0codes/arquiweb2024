<?php
require '../config/configDB.php';




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    $username = $_POST['usuario'];
    $password = $_POST['password']; 

    try {
    
        $checkStmt = $CNX->prepare("SELECT COUNT(*) FROM usuarios WHERE password = ? AND username = ?");
        $checkStmt->execute([$_POST['password'],$_POST['usuario']]);
        $userExists = $checkStmt->fetchColumn() > 0;
    
        if ($userExists) {
            $_SESSION["log"] = true;
            $_SESSION["usuario"] = $username;
            $_SESSION["correo"] = "{$username}@firenzepasticceria.com";

            header("Location: ../templates/home.php");
        } else {
            $_SESSION['error'] = '***Incorrect password or username.***';
            header("Location: login.php");
        }

        exit();

    } catch (Exception $e) {
        $_SESSION['error'] = 'Error al verificar el usuario.';
        exit();
    }

} else {
    header("Location: login.php");
    exit();
}
?>
