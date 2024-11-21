<?php
     //conexión a BD
     include "./config/db_con.php";

     //Consultas sin parámetros;
     try{
     $result = $CNX->query("SELECT      id_articulo,
                                        descripcion,
                                        precio,
                                        id_categoria,
                                        stock
                            FROM      arqwebo2024.articulos
                            ORDER BY  id_categoria");
     }catch(Exception $e){
        echo "Error de consulta";
        $e->getMessage();
        exit();
     }
    
?>
<?php include("header.php"); ?>
<pre>
     <?php var_dump($result->fetchAll()); ?>
</pre>
<?php include("footer.php"); ?>