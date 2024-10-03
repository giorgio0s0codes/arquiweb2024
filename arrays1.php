<?php
$personas = array(0 =>
		array("nombre"=> "Giorgio", "apellido" => "Oso"), 
		  1 =>
		array("nombre"=> "Max", "apellido" => "Memije"),
		2 =>
		array("nombre"=> "Marlene", "apellido" => "Serrano")
	);

echo "<ul>\n";
foreach ($personas as $value) {
    echo "<li>" . $value['nombre'] . " " . $value['apellido'] . "<\li>\n";
}
 echo "<\ul>";
