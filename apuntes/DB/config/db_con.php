<?php

/*DSN Data Source Name <manejador>:host=<ip o nombre host>;dbname=<base de datos>;
                                   charset=<charset>*/

$dsn		= "mysql:host=localhost;dbname=arqwebo24;charset=utf8mb4";

$usuario 	= "arqwebo24";
$password	= "37863";

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