<?php
require '../config/configBakeDB.php';

$stmt = $CNX->prepare("SELECT * FROM articulos");
$stmt->execute();

header('Content-Type: application/json');
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
?>
