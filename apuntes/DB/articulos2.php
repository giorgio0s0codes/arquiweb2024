<?php
     //conexión a BD
     include "./config/db_con.php";

     if(!isset($_POST["categoria"]) || !is_numeric($_POST["categoria"])){

        $categoria = 0;

     } else {
        $categoria = $_POST["categoria"];
     }

     //Consultas con parámetros;
     try{
        $result = $CNX->query("SELECT       id_categoria,
                                            description
                                FROM        categorias");

        $categorias = $result->fetchAll();
        //Preparar la consulta
        $stmt = $CNX->prepare("SELECT       id_articulo,
                                            descripcion,
                                            precio,
                                            id_categoria,
                                            stock
                                FROM        arqwebo2024.articulos
                                WHERE       id_categoria = ?
                                ORDER BY  id_categoria");

        $stmt->execute(array($categoria));

        $rows = $stmt->fetchAll();


     }catch(Exception $e){
        echo "Error de consulta";
        echo "<br>" . $e->getMessage();
        exit();
     }
    
?>
<?php include("header.php"); ?>
<!-- Horizontal form -->

<form method="POST" action="articulos2.php">
    <div class="row my-5">
        <label for="categoria" class="col-2 col-form-label">Categoría</label>
        <div class="col-4">
            <select name="categoria" class="form-select" id="categoria">
                <option value="0">Seleccione una categoría</option>
                <?php foreach($categorias as $categoria){?>
                    <option value="<?= $categoria["id_categoria"]?>"><?=$categoria["id_categoria"]?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Consultar</button>
</form>
<pre><?php var_dump($rows); ?></pre>

<?php include("footer.php"); ?>