<?php
// usoget.php

// Mostrar los parámetros GET
var_dump($_GET);

// Acceder a un valor específico
if (isset($_GET['name'])) {
    echo "   Hola, " . htmlspecialchars($_GET['name']) . "!";
} else {
    echo "¡Hola, visitante!";
}

if (isset($_GET['anio'])) {
    echo "    Buen " . htmlspecialchars($_GET['anio']) . "!";
} else {
    echo "No hay fecha";
}
?>