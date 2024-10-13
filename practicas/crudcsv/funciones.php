<?php

function borrarUsuario($usrsrch) {
    $usuarios = getUsuarios();

    // Buscar el usuario usando getUsuario
    $usuario = getUsuario($usrsrch);
    
    if ($usuario) {
        // Si el usuario es encontrado, buscar el índice del usuario para eliminarlo
        $usuarioIndex = array_search($usuario['usuario'], array_column($usuarios, 'usuario'));

        if ($usuarioIndex !== false) {
            // Eliminar el usuario del array
            unset($usuarios[$usuarioIndex]);

            // Reindexar el array
            $usuarios = array_values($usuarios);

            // Guardar la lista actualizada de usuarios en el archivo
            $file_handle = fopen("./DB/usuarios.csv", "w");
            foreach ($usuarios as $usuario) {
                fputcsv($file_handle, $usuario);
            }
            fclose($file_handle);

            return "Usuario eliminado exitosamente.";
        } else {
            return "Usuario no encontrado en la lista.";
        }
    } else {
        return "Usuario no encontrado.";
    }
}

function editarUsuario($usrsrch, $newData) {
    // Recuperar todos los usuarios
    $usuarios = getUsuarios();

    // Inicializar una variable para verificar si se encontró el usuario
    $usuarioFound = false;

    // Crear una lista actualizada de usuarios
    $updatedUsuarios = [];

    // Iterar a través de los usuarios y encontrar el que se va a actualizar
    foreach ($usuarios as $user) {
        // Realizar una comparación insensible a mayúsculas y minúsculas usando strtolower
        if (strtolower($user["usuario"]) == strtolower($usrsrch)) {
            // Actualizar los datos del usuario con los valores en $newData
            $user["nombre"] = isset($newData["nombre"]) ? $newData["nombre"] : $user["nombre"];
            $user["apellidoP"] = isset($newData["apellidoP"]) ? $newData["apellidoP"] : $user["apellidoP"];
            $user["apellidoM"] = isset($newData["apellidoM"]) ? $newData["apellidoM"] : $user["apellidoM"];
            $user["correo"] = isset($newData["correo"]) ? $newData["correo"] : $user["correo"];
            $user["password"] = isset($newData["password"]) ? $newData["password"] : $user["password"];
            $user["plan"] = isset($newData["plan"]) ? $newData["plan"] : $user["plan"];
            $usuarioFound = true;  // Marcar que el usuario fue encontrado
        }
        // Agregar cada usuario a la lista actualizada
        $updatedUsuarios[] = $user;
    }

    if (!$usuarioFound) {
        echo "Usuario no encontrado.\n";
        return false;  // Devolver falso si el usuario no fue encontrado
    }

    // Reconstruir el archivo CSV con los datos actualizados del usuario
    $file_handle = fopen('./DB/usuarios.csv', 'w');

    // Escribir todos los usuarios de nuevo en el archivo CSV
    foreach ($updatedUsuarios as $user) {
        if (!empty(trim($user["usuario"]))) {  // Evitar escribir líneas vacías
            $line = implode(",", array_map('trim', array_values($user))) . "\n";
            fwrite($file_handle, $line);
        }
    }

    fclose($file_handle);
    echo "Archivo escrito exitosamente.\n";

    return true;  // Devolver verdadero cuando el usuario sea actualizado exitosamente
}

function insertarUsuario($usuario){
	$usuarios = getUsuarios();
	array_push($usuarios,$usuario);
	guardarUsuarios($usuarios);
}

function guardarUsuarios($usuarios, $test = 0){
	$archivo = "./DB/usuarios.csv";
	if($test==1){
		$archivo = "./DB/usuarios_test.csv";
	}
	$data = "";
	foreach($usuarios as $usuario){
		$data .= implode(",",$usuario)."\n";
	}
	$data=substr($data,0,-1);
	$file_handle = fopen($archivo,"w");

	fwrite($file_handle,$data);
	fclose($file_handle);
}

function getUsuarios() {
    // Open the CSV file
    $file_handle = fopen("./DB/usuarios.csv", "r");
    $data = fread($file_handle, filesize('./DB/usuarios.csv'));
    fclose($file_handle);
    
    // Split data into lines and filter out any empty lines
    $lineas = array_filter(explode("\n", trim($data)));

    $users = array();
    foreach ($lineas as $linea) {
        // Trim each line and avoid empty or malformed entries
        $values = array_map('trim', explode(",", $linea));

        // Ensure we have exactly 7 values (corresponding to the CSV format)
        if (count($values) == 7) {
            $user = array(
                "usuario"    => $values[0],
                "nombre"     => $values[1],
                "apellidoP"  => $values[2],
                "apellidoM"  => $values[3],
                "correo"     => $values[4],
                "password"   => $values[5],
                "plan"       => $values[6]
            );
            array_push($users, $user);
        }
    }
    
    return $users;
}

function getUsuario($usrsrch){
	$usuarios = getUsuarios();
	
	// Use array_filter to find the user, but reset the indices
    $usuario = array_filter($usuarios, function($usuario) use($usrsrch) {
        return $usuario["usuario"] == $usrsrch;
    });

    // If the user is found, reset the array and return the first element
    if (!empty($usuario)) {
        $usuario = array_values($usuario);  // Reset the array indices
        return $usuario[0];  // Return the first (and only) user found
    }

    return null;  // Return null if no user is found

}

if(isset($_GET["prueba"]) && isset($_GET["method"]) && $_GET["method"] == "getUsuarios"){
	//Probar el método getUsuarios:
	
	echo "probando getUSuarios";
	var_dump(getUsuarios());
	
}

if(isset($_GET["prueba"]) && isset($_GET["method"]) && $_GET["usr"] && $_GET["method"] == "getUsuario"){
	//Probar el método getUsuarios:
	
	echo "probando getUSuario";
	var_dump(getUsuario($_GET["usr"]));
	
}

if(isset($_GET["prueba"]) && isset($_GET["method"]) && $_GET["method"] == "guardarUsuarios"){
	//Probar el método getUsuarios:
	
	echo "probando guardarUsuarios";
	$usuarios = array(
		array("usuario" => "asland12",
				"nombre" => "Franz",
				"apellidoP" => "Ferdinand",
				"apellidoM" => "Farió",
				"correo" => "fff@gmail.com",
				"password" => "1234",
				"plan" => "2")

	);
	guardarUsuarios($usuarios, 1); 
	echo "archivo creado";
	
}

if (isset($_GET["prueba"]) && isset($_GET["method"])) {

    if ($_GET["method"] == "getUsuario" && isset($_GET["usr"])) {
        // Test the getUsuario method
        echo "Testing getUsuario:\n";
        var_dump(getUsuario($_GET["usr"]));
    }

    if ($_GET["method"] == "editarUsuario" && isset($_GET["usr"])) {
        // Test the editarUsuario method
        echo "Testing editarUsuario:\n";
        
        // Create an associative array with the new data for the user
        $newData = array();
        
        // Check for each possible field in the URL
        if (isset($_GET["nombre"])) {
            $newData["nombre"] = $_GET["nombre"];
        }
        if (isset($_GET["apellidoP"])) {
            $newData["apellidoP"] = $_GET["apellidoP"];
        }
        if (isset($_GET["apellidoM"])) {
            $newData["apellidoM"] = $_GET["apellidoM"];
        }
        if (isset($_GET["correo"])) {
            $newData["correo"] = $_GET["correo"];
        }
        if (isset($_GET["password"])) {
            $newData["password"] = $_GET["password"];
        }
        if (isset($_GET["plan"])) {
            $newData["plan"] = $_GET["plan"];
        }

        // Call the editarUsuario function and check if the update was successful
        $success = editarUsuario($_GET["usr"], $newData);
        
        if ($success) {
            echo "User successfully updated.";
        } else {
            echo "User not found or update failed.";
        }
    }
}

if (isset($_GET["prueba"]) && isset($_GET["method"]) && $_GET["usr"] && $_GET["method"] == "borrarUsuario") {
    // Probar el método borrarUsuario:
    
    echo "probando borrarUsuario";
    echo borrarUsuario($_GET["usr"]);
}
