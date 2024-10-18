<?php
include "funciones.php";
include "funcionesplanes.php";

$planes = getPlanes();

$usuarios = getUsuarios();

if(isset($_GET['user'])){
    $usuario = getUsuario($_GET['user']);
}
else{
    $usuario = array("usuario" => "",
                        "nombre"     => "",
                        "apellidoP"  => "",
                        "apellidoM"  => "",
                        "correo"     => "",
                        "password"   => "",
                        "plan"       => 0);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 65%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: block;
            margin: 0 auto;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-group input[type="submit"] {
            background-color: #17a2b8;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .form-group input[type="submit"]:hover {
            background-color: #138496;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
        .action-buttons button {
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .edit-button {
            background-color: #28a745;
            color: white;
        }
        .delete-button {
            background-color: #dc3545;
            color: white;
        }
        .edit-button:hover {
            background-color: #218838;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Registry</h2>
        <div class="col-md-6" style="margin:0 auto; float:none;">
            <form method="POST" action="usuarioCNT.php">
                <?php if(isset($_GET['action'])&& $_GET['action']== 'edit'){?>
                    <input type="hidden" name = "edit" value="update">
                <?php }?>
                <h3>User Info</h3>
                <?php if (!empty($error)) echo "<p>$error</p>"; ?>
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Enter Usuario" value="<?= $usuario["usuario"]?>" />
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Enter Nombre" value="<?= $usuario["nombre"] ?>" />
                </div>
                <div class="form-group">
                    <label for="apellido_paterno">Apellido Paterno</label>
                    <input type="text" id="apellido_paterno" name="apellido_paterno" placeholder="Enter Apellido Paterno" value="<?= $usuario["apellidoP"] ?>" />
                </div>
                <div class="form-group">
                    <label for="apellido_materno">Apellido Materno</label>
                    <input type="text" id="apellido_materno" name="apellido_materno" placeholder="Enter Apellido Materno" value="<?= $usuario["apellidoM"]; ?>" />
                </div>
                <div class="form-group">
                    <label for="mail">Mail</label>
                    <input type="email" id="mail" name="mail" placeholder="Enter Mail" value="<?= $usuario["correo"] ?>" />
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Enter Contraseña" value="<?= $usuario["password"] ?>"/>
                </div>
                <div class="form-group">
                    <label for="number_choice">Choose a Number</label>
                    <select id="number_choice" name="number_choice">
                        <?php foreach($planes as $plan){ ?>
                        <option value="<?=$plan["id"]?>"><?=$plan["nombre"]?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group" align="center">
                    <input type="submit" name="submit" value="Submit" />
                </div>
            </form>
        </div>

        <table>
            <tr>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>ApellidoP</th>
                <th>ApellidoM</th>
                <th>Correo</th>
                <th>Plan</th>
                <th>Acciones</th>
            </tr>
            <?php foreach($usuarios as $usr){?>
                <tr>
                    <td><?= $usr["usuario"]?></td>
                    <td><?= $usr["nombre"]?></td>
                    <td><?= $usr["apellidoP"]?></td>
                    <td><?= $usr["apellidoM"]?></td>
                    <td><?= $usr["correo"]?></td>
                    <td><?= $usr["password"]?></td>
                    <td><?= $usr["plan"]?></td>
                    <td>
                        <a href='usuarios.php?user=<?=urlencode($usr["usuario"])?>&action=edit' class='edit-button'>Editar</a>
                        <a href='usuarioCNT.php?user=<?=urlencode($usr["usuario"])?>&action=delete' class='delete-button'>Borrar</a>
                    </td>
                </tr>
            <?php }?>
        </table>
    </div>
</body>
</html>
