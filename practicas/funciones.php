<?php


function insertarUsuario($usuario){

}

function getUsuarios(){
	//Retorna arreglo de arreglos asociativos
	$file_handle = fopen("../DB/usuarios.csv","r");
	$users = fread($file_handle, filesize('../DB/usuarios.csv'));
	$lineas = explode("\n",$users);
	var_dump($lineas);
}

function getUsuario(){

}

if(isset($_GET["prueba"]) && isset($_GET["method"]) && $_GET["method"] == "getUsuarios"){
	//Probar el método getUsuarios:
	
	echo "probando getUSuarios";
	getUsuarios();
	
}
