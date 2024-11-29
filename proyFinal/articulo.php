<?php
     //conexión a BD
     include "./config/db_con.php";

     include "model/Articulo.php";

     //Consultas con parámetros;
     try{

        $result = $CNX->query("SELECT       id_categoria,
                                            descripcion
                                FROM        categorias");

        $categorias = $result->fetchAll();
        


     }catch(Exception $e){
        echo "Error de consulta";
        echo "<br>" . $e->getMessage();
        exit();
     }
    
?>
<?php include("header.php"); ?>
<!-- Horizontal form -->

<form method="POST" action="articuloCNT.php">
    <div class="row my-5">
        <input name="id_articulo" type="hidden" value="0">
        <label for="descripcion" class="col-2 col-form-label">Descripción</label>
        <div class="col-4">
            <input class="form-control" id="descripcion" name="descripcion" type="text">
        </div>
    </div>
    <div class="row my-5">
        <label for="precio" class="col-2 col-form-label">Precio</label>
        <div class="col-4">
            <input class="form-control" id="precio" name="precio" type="text">
        </div>
    </div>
    <div class="row my-5">
        <label for="stock" class="col-2 col-form-label">Stock</label>
        <div class="col-4">
            <input class="form-control" id="stock" name="stock" type="text">
        </div>
    </div>
    <div class="row my-5">
        <label for="id_categoria" class="col-2 col-form-label">Categoría</label>
        <div class="col-4">
            <select name="id_categoria" class="form-select" id="id_categoria">
                <option value="0">Seleccione una categoría</option>
                <?php foreach($categorias as $categoria){?>
                    <option value="<?= $categoria["id_categoria"]?>">
                        <?= $categoria["descripcion"]?>
                    </option>
                <?php } ?>
                </select>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Consultar</button>
</form>

<?php include("footer.php"); ?>