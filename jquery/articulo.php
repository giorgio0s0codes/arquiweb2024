<?php
     //conexión a BD
     include "./config/db_con.php";

     include "./model/Articulo.php";

     //Consultas con parámetros;
     try{

        $result = $CNX->query("SELECT       id_categoria,
                                            descripcion
                                FROM        categorias");

        $categorias = $result->fetchAll();

        $id_articulo = 0;

        if(isset($_GET['id_articulo']) && is_numeric($_GET['id_articulo'])){

            $id_articulo = $_GET['id_articulo'];
        }

        $articulo = new Articulo($CNX, $id_articulo);

        $articulos = Articulo::getAll($CNX);


     }catch(Exception $e){
        echo "Error de consulta";
        echo "<br>" . $e->getMessage();
        exit();
     }
    
?>
<!-- Horizontal form -->

<form method="POST" action="articuloMDL.php">
    <div class="row my-5">
        <input name="id_articulo" type="hidden" value="<?= $articulo->id_articulo ?>">
        <label for="descripcion" class="col-2 col-form-label">Descripción</label>
        <div class="col-4">
            <input class="form-control" id="descripcion" name="descripcion" type="text" value="<?= $articulo->descripcion ?>">
        </div>
    </div>
    <div class="row my-5">
        <label for="precio" class="col-2 col-form-label">Precio</label>
        <div class="col-4">
            <input class="form-control" id="precio" name="precio" type="text" value="<?= $articulo->precio ?>">
        </div>
    </div>
    <div class="row my-5">
        <label for="stock" class="col-2 col-form-label">Stock</label>
        <div class="col-4">
            <input class="form-control" id="stock" name="stock" type="text" value="<?= $articulo->stock ?>">
        </div>
    </div>
    <div class="row my-5">
        <label for="id_categoria" class="col-2 col-form-label">Categoría</label>
        <div class="col-4">
            <select name="id_categoria" class="form-select" id="id_categoria">
                <option value="0">Seleccione una categoría</option>
                <?php foreach($categorias as $categoria){?>
                    <option value="<?= $categoria["id_categoria"]?>" <?= $articulo->id_categoria == $categoria['id_categoria'] ? "selected" : "" ?>>
                        <?= $categoria["descripcion"]?>
                    </option>
                <?php } ?>
                </select>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>

<div class="row my-5 mx-3">
    <table class="table table-striped col-12">
        <tr>
            <th>Id</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Categoria</th>
            <th>Acciones</th>
        </tr>
        <?php foreach($articulos as $articulo){ ?>
        <tr>
            <td><?= $articulo['id_articulo'] ?></td>
            <td><?= $articulo['descripcion'] ?></td>
            <td><?= $articulo['precio'] ?></td>
            <td><?= $articulo['stock'] ?></td>
            <td><?= $articulo['categoria'] ?></td>
            <td>
                <a href="articulo.php?id_articulo=<?= $articulo["id_articulo"] ?>"
                   data-id="<?= $articulo["id_articulo"] ?>">Editar</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>