<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport">
        <title>Usando Bootstrap</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous">
        <link href="../sesiones/css_adminTemplate3.css" rel="stylesheet">
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
                    <div class="w-75 ms-5 my-5">
                        <a href="ventas.php">Ventas</a>
                    </div>

                    <div class="w-75 ms-5 my-5">
                        <a href="logout.php">Log Out</a>
                    </div>

                </div>

                <div id="contenido" class="col-9 col-lg-10">
                    <form class="row mt-5">
                        <div class="col-12">
                            <label for="tarea">Nueva Tarea</label>
                            <input name="tarea" id="tarea">
                        </div>
                        <div class="col">
                            <button class="btn btn-success" type="button" id="addTarea">Agregar</button>
                        </div>
                    </form>

                    <form class="row mt-5">
                        <div class="col-8">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th scope="col">Tareas Pendientes</th>
                                    <th scope="col">Realizadas</th>
                                </tr>
                                <tr>
                                    <td>Avanzar proyecto</td>
                                    <td><input type="checkbox" name="chktarea"></td>
                                </tr>
                            </table>
                        </div>
                    </form>

                    <form class="row mt-5">
                        <div class="col-8">
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <th scope="col">Tareas Realizadas</th>
                                </tr>
                                <tr class="table-info">
                                    <td>Creación base de datos</td>
                                </tr>
                            </table>
                        </div>
                    </form>


                </div>
            </section>

        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
        crossorigin="anonymous"></script>
        <script src="js/todo.js"></script>
    </body>
</html>
