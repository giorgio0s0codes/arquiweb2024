<?php


function insertarUsuario($usuario){

}

function getUsuarios(){
	//Retorna arreglo de arreglos asociativos
	$file_handle = fopen("../DB/usuarios.csv","r");
	$users = fread($file_handle, filesize('../DB/usuarios.csv'));
	$lineas = explode("\n",$users);
	foreach($lineas as $linea){
		$values = explode(",", $linea);
		$user = array("usuario" => $values[0],
				"nombre" => $values[1],
				"apellidoP" => $values[2],
				"apellidoM"
				"correo"
				"contraseña"
				"plan"
	}
}

function getUsuario(){

}

if(isset($_GET["prueba"]) && isset($_GET["method"]) && $_GET["method"] == "getUsuarios"){
	//Probar el método getUsuarios:
	
	echo "probando getUSuarios";
	getUsuarios();
	
}
