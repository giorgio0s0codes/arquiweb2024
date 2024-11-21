<?php

/*DSN Data Source Name <manejador>:host=<ip o nombre host>;dbname=<base de datos>;
                                   charset=<charset>*/

$dsn		= "mysql:host=localhost;dbname=arqwebo2024;charset=utf8mb4";

$usuario 	= "arqwebo2024";
$password	= "210681";

$options	= array(
				PDO::ATTR_ERRMODE				=> PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE	=> PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES		=> true 
			  );


try{

	$CNX = new PDO($dsn, $usuario, $password, $options);

}catch(Exception $e){

	echo "Error de conexión a la base de datos:";
	echo $e->getMessage();
	exit();
}