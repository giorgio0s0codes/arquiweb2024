<?php
    session_start();

    if (!isset($_SESSION["log"]) || $_SESSION["log"] != true) {
        header("Location: login2.php");
        exit();
    }



?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport">
        <title>Usando Bootstrap</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
        <link href="./css_adminTemplate3.css" rel="stylesheet">
    </head>
    <body>


        <div class="container-fluid">

            <section id="encabezado" class="row">
                <header class="col-md-12">
                    <h1>Administración de Firenze Pasticceria</h1>
                </header>
            </section>

            <section id="principal" class="row">

                <div id="navegacion" class="col-3 col-lg-2">
                    <div class="w-75 ms-3 my-5">
                        <a href="ventas.php">Ventas</a>
                    </div>
                </div>

                <div id="contenido" class="col-9 col-lg-10">
                    <h3>Ventas</h3>
                </div>

                <div class="w-75 ms-3 my-5">
                        <a href="logout.php">Log Out</a>
                    </div>


            </section>

        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous"></script>
    </body>
</html>