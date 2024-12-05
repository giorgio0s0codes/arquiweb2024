<?php
session_start();
session_destroy(); // Destroy the session
header("Location: http://52.15.244.98/www.giorgio-oso.com/firenze/LogIn/login.php"); // Redirect to login page
exit();
?>
