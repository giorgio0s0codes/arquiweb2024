<?php


function insertarUsuario($usuario){

}

function getUsuarios(){
	//Retorna arreglo de arreglos asociativos
	$file_handle = fopen("../DB/usuarios.csv","r");
	$data = fread($file_handle, filesize('../DB/usuarios.csv'));
	fclose($file_handle);
	$lineas = explode("\n",$data);
	$users = array();
	foreach($lineas as $linea){
		$values = explode(",", $linea);
		if(!count($values)==7){
			continue;
		}
		$user = array("usuario" => $values[0],
				"nombre" => $values[1],
				"apellidoP" => $values[2],
				"apellidoM" => $values[3],
				"correo" => $values[4],
				"password" => $values[5],
				"plan" => $values[6]);
		array_push($users,$user);
	}
	 return $users;
}

function getUsuario($usrsrch){
	$usrsrch = getUsuarios();
	/*
    foreach ($usuario as $usarios) {
        if ($usrsrch== $usuario["usuario"]) {
            return $user;
        }
    }
	*/

	array_filter($usuarios, function($usuario) use($usrsrch){
		return $usuario["usuario"] == $usrsrch;
	});
	return null;

}

if(isset($_GET["prueba"]) && isset($_GET["method"]) && $_GET["method"] == "getUsuarios"){
	//Probar el método getUsuarios:
	
	echo "probando getUSuarios";
	var_dump(getUsuarios());
	
}

if(isset($_GET["prueba"]) && isset($_GET["method"]) && $_GET["usr"] && $_GET["method"] == "getUsuarios"){
	//Probar el método getUsuarios:
	
	echo "probando getUSuario";
	var_dump(getUsuario($_GET["usr"]));
	
}