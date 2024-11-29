<?php
    //conexión a DB
    include "./config/db_con.php";
    include "./model/Articulo.php";

    //Validaciones
    if(!isset($_POST['id_articulo']) || !is_numeric($_POST['id_articulo'])){
        echo "Código de artículo no válido o no especificado";
        exit();
      }

      if(!isset($_POST['descripcion']) || !preg_match("/^[0-9A-zÀ-ú\"'-,\()\.& ]{1,100}$/", $_POST['descripcion'])){
        echo "Descripción inválida: (caracteres especiales permitidos -.,\"()&')";
        exit();
      }

      if(!isset($_POST["id_categoria"]) || !is_numeric($_POST["id_categoria"])){
         echo "Categoría inválida";
         exit();
      }

     if(!isset($_POST["precio"]) || !is_numeric($_POST["precio"])){
        echo "Precio inválido";
        exit();
     }

     if(!isset($_POST["stock"]) || !is_numeric($_POST["stock"])){
        echo "Stock inválido";
        exit();
     } 


    //Instanciar un objeto de  la clase Árticulo:
    $articulo = new Articulo($CNX, $_POST['id_articulo']);

    $articulo -> descripcion = $_POST['descripcion'];
    $articulo -> id_categoria = $_POST['id_categoria'];
    $articulo -> precio = $_POST['precio'];
    $articulo -> stock = $_POST['stock'];

    #$articulo-> save();

    header("Location:articulo.php");